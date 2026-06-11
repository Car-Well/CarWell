<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ __('perfil.titulo') }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/login/perfil.css') }}"/>
</head>
<body>
  <div class="card">

    <!-- Cabeçalho com logo e botão de endereço -->
    <div class="top-row">
      <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo Carwell" style="width: 75px"/>
        <span class="logo-text">Carwell</span>
      </div>
      <button type="button" class="btn-endereco" onclick="openEnderecoModal()">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16">
          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
          <circle cx="12" cy="10" r="3"/>
        </svg>
        Meus Endereços
      </button>
    </div>

    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('perfil.update') }}"
          enctype="multipart/form-data" id="perfil-form">
      @csrf

      <!-- Foto -->
      <div class="photo-section">
        <p class="add-photo-label">{{ __('perfil.adicionar_foto') }}</p>
        <div class="photo-circle" id="photo-circle">
          @if($cliente->foto)
            <img id="preview-img" src="{{ storage_url($cliente->foto) }}"
                 alt="Foto de perfil" style="display:block"/>
            <span class="plus-icon" id="plus-icon" style="display:none">+</span>
          @else
            <img id="preview-img" src="" alt="Foto de perfil" style="display:none"/>
            <span class="plus-icon" id="plus-icon">+</span>
          @endif
        </div>
        <input type="file" id="photo-input" name="foto" accept="image/*"
               onchange="previewPhoto(event)" style="display:none"/>
      </div>

      @error('foto')
        <p style="color:#b91c1c;font-size:13px;text-align:center;margin:4px 0;">{{ $message }}</p>
      @enderror

      <!-- Nome Completo -->
      <div class="field-group">
        <input class="field-box editable" id="nome" name="name" type="text"
               placeholder="{{ __('perfil.placeholder_nome') }}"
               value="{{ old('name', $cliente->name) }}" readonly/>
      </div>

      <!-- Email -->
      <div class="field-group">
        <input class="field-box editable" id="email" name="email" type="email"
               placeholder="Email"
               value="{{ old('email', $cliente->email) }}" readonly/>
      </div>
      @error('email')
        <p style="color:#b91c1c;font-size:13px;text-align:center;margin:-8px 0 4px;">{{ $message }}</p>
      @enderror

      <!-- Telefone -->
      <div class="field-group">
        <input class="field-box editable" id="telefone" name="telefone" type="tel"
               placeholder="(11) 99999-9999"
               value="{{ old('telefone', $cliente->telefone) }}"
               oninput="maskTelefone(this)" readonly/>
      </div>

      <!-- Data de Nascimento -->
      <div class="field-group">
        <input class="field-box editable" id="nascimento-display" type="text"
               placeholder="Data de nascimento"
               value="{{ $cliente->nascimento ? $cliente->nascimento->format('d/m/Y') : old('nascimento') }}"
               oninput="maskData(this)" maxlength="10" readonly/>
        <input type="hidden" name="nascimento" id="nascimento-hidden"
               value="{{ old('nascimento', $cliente->nascimento ? $cliente->nascimento->format('Y-m-d') : '') }}"/>
      </div>

      <div class="btn-row">
        <button type="button" class="btn btn-back"
                onclick="window.location.href='{{ route('home') }}'">{{ __('perfil.voltar') }}</button>
        <button type="button" class="btn btn-edit" id="btn-edit"
                data-label-edit="{{ __('perfil.editar') }}"
                data-label-save="{{ __('perfil.salvar') }}"
                onclick="toggleEdit()">{{ __('perfil.editar') }}</button>
      </div>
    </form>

    <!-- Logout -->
    <form method="POST" action="{{ route('cliente.logout') }}" style="margin-top:12px;text-align:center;">
      @csrf
      <button type="submit"
              style="background:none;border:none;color:#b91c1c;font-size:13px;
                     font-family:inherit;font-weight:600;cursor:pointer;letter-spacing:1px;">
        {{ __('perfil.sair') }}
      </button>
    </form>

    <!-- Excluir conta -->
    <div style="text-align:center; margin-top:6px;">
      <button type="button" onclick="document.getElementById('modal-excluir').style.display='flex'"
              style="background:none;border:none;color:#9EA19C;font-size:11px;
                     font-family:inherit;font-weight:500;cursor:pointer;letter-spacing:0.5px;
                     text-decoration:underline;text-underline-offset:2px;">
        Excluir conta
      </button>
    </div>
  </div>

  <!-- Modal de confirmação -->
  <div id="modal-excluir"
       style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4);
              z-index:9999; align-items:center; justify-content:center; padding:24px;">
    <div style="background:#fff; border-radius:16px; padding:28px 24px; max-width:320px;
                width:100%; text-align:center; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
      <div style="width:48px;height:48px;background:#fef2f2;border-radius:50%;
                  display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#b91c1c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
          <path d="M10 11v6M14 11v6"/>
        </svg>
      </div>
      <p style="font-family:'Syne',sans-serif;font-size:0.95rem;font-weight:800;color:#1A1C19;margin-bottom:8px;">
        Excluir conta?
      </p>
      <p style="font-size:0.8rem;color:#6B6E69;line-height:1.5;margin-bottom:24px;">
        Todos os seus dados serão apagados permanentemente. Esta ação não pode ser desfeita.
      </p>
      <div style="display:flex;gap:10px;">
        <button type="button" onclick="document.getElementById('modal-excluir').style.display='none'"
                style="flex:1;padding:11px;border:1.5px solid #e5e7eb;border-radius:10px;
                       background:#fff;font-family:inherit;font-size:0.8rem;font-weight:600;
                       cursor:pointer;color:#6B6E69;">
          Cancelar
        </button>
        <form method="POST" action="{{ route('perfil.destroy') }}" style="flex:1;">
          @csrf
          @method('DELETE')
          <button type="submit"
                  style="width:100%;padding:11px;border:none;border-radius:10px;
                         background:#b91c1c;color:#fff;font-family:inherit;
                         font-size:0.8rem;font-weight:700;cursor:pointer;letter-spacing:0.02em;">
            Sim, excluir
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal de Endereço -->
  <div class="modal-overlay" id="modal-endereco" onclick="if(event.target===this) closeEnderecoModal()">
    <div class="modal-endereco">
      <div class="modal-endereco-header">
        <span>Meu Endereço</span>
        <button type="button" onclick="closeEnderecoModal()" class="modal-close-btn">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>

      @if(session('success_endereco'))
        <div class="alert-success" style="margin:0 0 12px;">{{ session('success_endereco') }}</div>
      @endif

      <form method="POST" action="{{ route('perfil.endereco.update') }}" id="form-endereco">
        @csrf

        <!-- CEP -->
        <div class="end-group">
          <label class="end-label">CEP *</label>
          <input class="end-input" type="text" name="cep" id="end-cep"
                 placeholder="00000-000" maxlength="9"
                 value="{{ old('cep', $cliente->cep) }}"
                 oninput="maskCep(this)"/>
        </div>

        <!-- Rua -->
        <div class="end-group">
          <label class="end-label">Endereço (Rua / Avenida) *</label>
          <div style="position:relative">
            <input class="end-input end-locked" type="text" name="rua" id="end-rua"
                   placeholder="Preenchido automaticamente pelo CEP"
                   value="{{ old('rua', $cliente->rua) }}" readonly/>
            <span class="lock-icon">
              <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
            </span>
          </div>
        </div>

        <!-- Bairro / Cidade / Estado -->
        <div class="end-row">
          <div class="end-group" style="flex:2">
            <label class="end-label">Bairro *</label>
            <div style="position:relative">
              <input class="end-input end-locked" type="text" name="bairro" id="end-bairro"
                     placeholder="Auto" value="{{ old('bairro', $cliente->bairro) }}" readonly/>
              <span class="lock-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
              </span>
            </div>
          </div>
          <div class="end-group" style="flex:2">
            <label class="end-label">Cidade *</label>
            <div style="position:relative">
              <input class="end-input end-locked" type="text" name="cidade" id="end-cidade"
                     placeholder="Auto" value="{{ old('cidade', $cliente->cidade) }}" readonly/>
              <span class="lock-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
              </span>
            </div>
          </div>
          <div class="end-group" style="flex:1">
            <label class="end-label">UF *</label>
            <div style="position:relative">
              <input class="end-input end-locked" type="text" name="estado" id="end-estado"
                     placeholder="UF" maxlength="2" value="{{ old('estado', $cliente->estado) }}" readonly/>
              <span class="lock-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
              </span>
            </div>
          </div>
        </div>

        <!-- Número / Complemento -->
        <div class="end-row">
          <div class="end-group" style="flex:1">
            <label class="end-label">Número</label>
            <input class="end-input" type="text" name="numero" id="end-numero"
                   placeholder="Ex: 455" value="{{ old('numero', $cliente->numero) }}"/>
            <label class="end-check">
              <input type="checkbox" id="sem-numero" onchange="toggleSemNumero(this)"> Sem número
            </label>
          </div>
          <div class="end-group" style="flex:2">
            <label class="end-label">Complemento</label>
            <input class="end-input" type="text" name="complemento" id="end-complemento"
                   placeholder="Ex: Apto 144, Torre 2"
                   value="{{ old('complemento', $cliente->complemento) }}"/>
            <label class="end-check">
              <input type="checkbox" id="sem-complemento" onchange="toggleSemComplemento(this)"> Sem complemento
            </label>
          </div>
        </div>

        <!-- Ponto de Referência -->
        <div class="end-group">
          <label class="end-label">Ponto de Referência</label>
          <input class="end-input" type="text" name="ponto_referencia" id="end-ref"
                 placeholder="Ex: Próximo ao Shopping"
                 value="{{ old('ponto_referencia', $cliente->ponto_referencia) }}"/>
        </div>

        <div class="modal-endereco-footer">
          <button type="button" class="btn-end-cancelar" onclick="closeEnderecoModal()">Voltar</button>
          <button type="submit" class="btn-end-confirmar">Confirmar</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    let editing = false;

    @if($errors->any())
      window.addEventListener('DOMContentLoaded', () => entrarEdicao());
    @endif

    @if(session('success_endereco'))
      window.addEventListener('DOMContentLoaded', () => openEnderecoModal());
    @endif

    function entrarEdicao() {
      editing = true;
      document.querySelectorAll('.editable').forEach(el => el.removeAttribute('readonly'));
      document.getElementById('photo-circle').style.cursor = 'pointer';
      document.getElementById('photo-circle').onclick = () => document.getElementById('photo-input').click();
      const btn = document.getElementById('btn-edit');
      btn.textContent = btn.dataset.labelSave;
      btn.style.background = '#1e4d8c';
    }

    function toggleEdit() {
      if (!editing) {
        entrarEdicao();
      } else {
        document.getElementById('perfil-form').submit();
      }
    }

    function previewPhoto(e) {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = ev => {
        const img = document.getElementById('preview-img');
        img.src = ev.target.result;
        img.style.display = 'block';
        document.getElementById('plus-icon').style.display = 'none';
      };
      reader.readAsDataURL(file);
    }

    // Modal de endereço
    function openEnderecoModal() {
      document.getElementById('modal-endereco').classList.add('open');
      document.body.style.overflow = 'hidden';
    }

    function closeEnderecoModal() {
      document.getElementById('modal-endereco').classList.remove('open');
      document.body.style.overflow = '';
    }

    // Máscara de data: DD/MM/AAAA
    function maskData(input) {
      let v = input.value.replace(/\D/g, '').slice(0, 8);
      if (v.length > 4) v = v.slice(0,2) + '/' + v.slice(2,4) + '/' + v.slice(4);
      else if (v.length > 2) v = v.slice(0,2) + '/' + v.slice(2);
      input.value = v;
      if (v.length === 10) {
        const p = v.split('/');
        document.getElementById('nascimento-hidden').value = p[2] + '-' + p[1] + '-' + p[0];
      } else {
        document.getElementById('nascimento-hidden').value = '';
      }
    }

    // Máscara de telefone: (11) 99999-9999 ou (11) 9999-9999
    function maskTelefone(input) {
      let v = input.value.replace(/\D/g, '').slice(0, 11);
      if (v.length > 10) {
        v = '(' + v.slice(0,2) + ') ' + v.slice(2,7) + '-' + v.slice(7);
      } else if (v.length > 6) {
        v = '(' + v.slice(0,2) + ') ' + v.slice(2,6) + '-' + v.slice(6);
      } else if (v.length > 2) {
        v = '(' + v.slice(0,2) + ') ' + v.slice(2);
      } else if (v.length > 0) {
        v = '(' + v;
      }
      input.value = v;
    }

    // Máscara + busca automática ao completar 8 dígitos
    async function maskCep(input) {
      let v = input.value.replace(/\D/g, '').slice(0, 8);
      if (v.length > 5) v = v.slice(0, 5) + '-' + v.slice(5);
      input.value = v;
      if (v.replace('-', '').length === 8) {
        try {
          const res = await fetch(`https://viacep.com.br/ws/${v.replace('-', '')}/json/`);
          const data = await res.json();
          if (data.erro) return;
          document.getElementById('end-rua').value    = data.logradouro || '';
          document.getElementById('end-bairro').value = data.bairro     || '';
          document.getElementById('end-cidade').value = data.localidade || '';
          document.getElementById('end-estado').value = data.uf         || '';
          document.getElementById('end-numero').focus();
        } catch (e) {}
      }
    }

    // Sem número
    function toggleSemNumero(cb) {
      const input = document.getElementById('end-numero');
      if (cb.checked) { input.value = 'S/N'; input.readOnly = true; }
      else { input.value = ''; input.readOnly = false; }
    }

    // Sem complemento
    function toggleSemComplemento(cb) {
      const input = document.getElementById('end-complemento');
      if (cb.checked) { input.value = 'S/C'; input.readOnly = true; }
      else { input.value = ''; input.readOnly = false; }
    }

    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') closeEnderecoModal();
    });
  </script>
</body>
</html>
