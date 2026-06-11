<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ __('perfil.titulo') }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/login/login-cliente.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/login/perfil.css') }}"/>
</head>
<body>

  {{-- ===== PAINEL ESQUERDO ===== --}}
  <div class="login-visual perfil-visual">
    <div class="visual-brand">
      <div class="visual-brand-logo">
        <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
      </div>
      Car<strong>Well</strong>
    </div>

    <div class="perfil-avatar-area">
      <div class="perfil-avatar" id="photo-circle" onclick="if(editing) document.getElementById('photo-input').click()">
        @if($cliente->foto)
          <img id="preview-img" src="{{ asset('storage/' . $cliente->foto) }}" alt="Foto">
        @else
          <img id="preview-img" src="" alt="Foto" style="display:none">
          <svg id="avatar-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="1.5">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
          </svg>
        @endif
        <div class="perfil-avatar-overlay" id="avatar-overlay">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
            <circle cx="12" cy="13" r="4"/>
          </svg>
        </div>
      </div>
      <input type="file" id="photo-input" name="foto" accept="image/*" onchange="previewPhoto(event)" style="display:none" form="perfil-form"/>

      <p class="perfil-nome-left">{{ $cliente->name ?? 'Meu Perfil' }}</p>
      <p class="perfil-email-left">{{ $cliente->email }}</p>
    </div>

    <div class="perfil-left-actions">
      <button type="button" class="perfil-btn-endereco" onclick="openEnderecoModal()">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
        </svg>
        Meus Endereços
      </button>

      <form method="POST" action="{{ route('cliente.logout') }}" style="width:100%;">
        @csrf
        <button type="submit" class="perfil-btn-logout">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
          </svg>
          Sair da conta
        </button>
      </form>
    </div>
  </div>

  {{-- ===== PAINEL DIREITO ===== --}}
  <div class="login-form-side">
    <div class="login-box">

      <h1 class="login-title">Meu Perfil</h1>
      <p class="login-subtitle">Gerencie suas informações pessoais</p>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data" id="perfil-form">
        @csrf

        <div class="form-group">
          <label class="form-label">Nome completo</label>
          <input type="text" name="name" id="nome" class="form-control"
                 placeholder="{{ __('perfil.placeholder_nome') }}"
                 value="{{ old('name', $cliente->name) }}" readonly/>
        </div>

        <div class="form-group">
          <label class="form-label">E-mail</label>
          <input type="email" name="email" id="email" class="form-control"
                 placeholder="seu@email.com"
                 value="{{ old('email', $cliente->email) }}" readonly/>
          @error('email')<span class="error-text">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label class="form-label">Telefone</label>
          <input type="tel" name="telefone" id="telefone" class="form-control"
                 placeholder="(11) 99999-9999"
                 value="{{ old('telefone', $cliente->telefone) }}"
                 oninput="maskTelefone(this)" readonly/>
        </div>

        <div class="form-group">
          <label class="form-label">Data de nascimento</label>
          <input type="text" id="nascimento-display" class="form-control"
                 placeholder="DD/MM/AAAA"
                 value="{{ $cliente->nascimento ? $cliente->nascimento->format('d/m/Y') : old('nascimento') }}"
                 oninput="maskData(this)" maxlength="10" readonly/>
          <input type="hidden" name="nascimento" id="nascimento-hidden"
                 value="{{ old('nascimento', $cliente->nascimento ? $cliente->nascimento->format('Y-m-d') : '') }}"/>
        </div>

        <button type="button" class="btn-submit" id="btn-edit"
                data-label-edit="{{ __('perfil.editar') }}"
                data-label-save="{{ __('perfil.salvar') }}"
                onclick="toggleEdit()">
          {{ __('perfil.editar') }}
        </button>

      </form>

      <a href="{{ route('home') }}" class="btn-back">← Voltar ao site</a>

      <div style="text-align:center; margin-top:8px;">
        <button type="button" onclick="document.getElementById('modal-excluir').style.display='flex'"
                style="background:none;border:none;color:#9EA19C;font-size:12px;
                       font-family:inherit;font-weight:500;cursor:pointer;
                       text-decoration:underline;text-underline-offset:2px;">
          Excluir conta
        </button>
      </div>

    </div>
  </div>

  {{-- ===== MODAL EXCLUIR CONTA ===== --}}
  <div id="modal-excluir"
       style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45);
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
      <p style="font-family:'Syne',sans-serif;font-size:0.95rem;font-weight:800;color:#1A1C19;margin-bottom:8px;">Excluir conta?</p>
      <p style="font-size:0.8rem;color:#6B6E69;line-height:1.5;margin-bottom:24px;">
        Todos os seus dados serão apagados permanentemente. Esta ação não pode ser desfeita.
      </p>
      <div style="display:flex;gap:10px;">
        <button type="button" onclick="document.getElementById('modal-excluir').style.display='none'"
                style="flex:1;padding:11px;border:1.5px solid #e5e7eb;border-radius:10px;
                       background:#fff;font-family:inherit;font-size:0.8rem;font-weight:600;
                       cursor:pointer;color:#6B6E69;">Cancelar</button>
        <form method="POST" action="{{ route('perfil.destroy') }}" style="flex:1;">
          @csrf @method('DELETE')
          <button type="submit"
                  style="width:100%;padding:11px;border:none;border-radius:10px;
                         background:#b91c1c;color:#fff;font-family:inherit;
                         font-size:0.8rem;font-weight:700;cursor:pointer;">Sim, excluir</button>
        </form>
      </div>
    </div>
  </div>

  {{-- ===== MODAL ENDEREÇO ===== --}}
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
        <div class="alert-success" style="margin:0 0 12px;padding:10px 14px;border-radius:8px;background:#E1F5EE;color:#0F6E56;font-size:13px;">{{ session('success_endereco') }}</div>
      @endif

      <form method="POST" action="{{ route('perfil.endereco.update') }}" id="form-endereco">
        @csrf
        <div class="end-group">
          <label class="end-label">CEP *</label>
          <input class="end-input" type="text" name="cep" id="end-cep"
                 placeholder="00000-000" maxlength="9"
                 value="{{ old('cep', $cliente->cep) }}" oninput="maskCep(this)"/>
        </div>
        <div class="end-group">
          <label class="end-label">Endereço (Rua / Avenida) *</label>
          <div style="position:relative">
            <input class="end-input end-locked" type="text" name="rua" id="end-rua"
                   placeholder="Preenchido automaticamente pelo CEP"
                   value="{{ old('rua', $cliente->rua) }}" readonly/>
            <span class="lock-icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
          </div>
        </div>
        <div class="end-row">
          <div class="end-group" style="flex:2">
            <label class="end-label">Bairro *</label>
            <div style="position:relative">
              <input class="end-input end-locked" type="text" name="bairro" id="end-bairro" placeholder="Auto" value="{{ old('bairro', $cliente->bairro) }}" readonly/>
              <span class="lock-icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
            </div>
          </div>
          <div class="end-group" style="flex:2">
            <label class="end-label">Cidade *</label>
            <div style="position:relative">
              <input class="end-input end-locked" type="text" name="cidade" id="end-cidade" placeholder="Auto" value="{{ old('cidade', $cliente->cidade) }}" readonly/>
              <span class="lock-icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
            </div>
          </div>
          <div class="end-group" style="flex:1">
            <label class="end-label">UF *</label>
            <div style="position:relative">
              <input class="end-input end-locked" type="text" name="estado" id="end-estado" placeholder="UF" maxlength="2" value="{{ old('estado', $cliente->estado) }}" readonly/>
              <span class="lock-icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
            </div>
          </div>
        </div>
        <div class="end-row">
          <div class="end-group" style="flex:1">
            <label class="end-label">Número</label>
            <input class="end-input" type="text" name="numero" id="end-numero" placeholder="Ex: 123" value="{{ old('numero', $cliente->numero) }}"/>
            <label class="end-check"><input type="checkbox" id="sem-numero" onchange="toggleSemNumero(this)"> Sem número</label>
          </div>
          <div class="end-group" style="flex:2">
            <label class="end-label">Complemento</label>
            <input class="end-input" type="text" name="complemento" id="end-complemento"
                   placeholder="Ex: Apartamento 1, Torre 1"
                   value="{{ old('complemento', $cliente->complemento) }}"/>
            <label class="end-check"><input type="checkbox" id="sem-complemento" onchange="toggleSemComplemento(this)"> Sem complemento</label>
          </div>
        </div>
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
      document.querySelectorAll('#perfil-form .form-control').forEach(el => el.removeAttribute('readonly'));
      document.getElementById('photo-circle').style.cursor = 'pointer';
      document.getElementById('avatar-overlay').style.opacity = '1';
      const btn = document.getElementById('btn-edit');
      btn.textContent = btn.dataset.labelSave;
      btn.style.background = '#0F6E56';
    }

    function toggleEdit() {
      if (!editing) { entrarEdicao(); }
      else { document.getElementById('perfil-form').submit(); }
    }

    function previewPhoto(e) {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = ev => {
        const img = document.getElementById('preview-img');
        img.src = ev.target.result;
        img.style.display = 'block';
        const icon = document.getElementById('avatar-icon');
        if (icon) icon.style.display = 'none';
      };
      reader.readAsDataURL(file);
    }

    function openEnderecoModal() {
      document.getElementById('modal-endereco').classList.add('open');
      document.body.style.overflow = 'hidden';
    }
    function closeEnderecoModal() {
      document.getElementById('modal-endereco').classList.remove('open');
      document.body.style.overflow = '';
    }

    function maskData(input) {
      let v = input.value.replace(/\D/g, '').slice(0, 8);
      if (v.length > 4) v = v.slice(0,2) + '/' + v.slice(2,4) + '/' + v.slice(4);
      else if (v.length > 2) v = v.slice(0,2) + '/' + v.slice(2);
      input.value = v;
      if (v.length === 10) {
        const p = v.split('/');
        document.getElementById('nascimento-hidden').value = p[2]+'-'+p[1]+'-'+p[0];
      } else {
        document.getElementById('nascimento-hidden').value = '';
      }
    }

    function maskTelefone(input) {
      let v = input.value.replace(/\D/g, '').slice(0, 11);
      if (v.length > 10) v = '('+v.slice(0,2)+') '+v.slice(2,7)+'-'+v.slice(7);
      else if (v.length > 6) v = '('+v.slice(0,2)+') '+v.slice(2,6)+'-'+v.slice(6);
      else if (v.length > 2) v = '('+v.slice(0,2)+') '+v.slice(2);
      else if (v.length > 0) v = '('+v;
      input.value = v;
    }

    async function maskCep(input) {
      let v = input.value.replace(/\D/g, '').slice(0, 8);
      if (v.length > 5) v = v.slice(0,5)+'-'+v.slice(5);
      input.value = v;
      if (v.replace('-','').length === 8) {
        try {
          const res  = await fetch(`https://viacep.com.br/ws/${v.replace('-','')}/json/`);
          const data = await res.json();
          if (data.erro) return;
          document.getElementById('end-rua').value    = data.logradouro || '';
          document.getElementById('end-bairro').value = data.bairro     || '';
          document.getElementById('end-cidade').value = data.localidade || '';
          document.getElementById('end-estado').value = data.uf         || '';
          document.getElementById('end-numero').focus();
        } catch(e) {}
      }
    }

    function toggleSemNumero(cb) {
      const input = document.getElementById('end-numero');
      if (cb.checked) { input.value = 'S/N'; input.readOnly = true; }
      else { input.value = ''; input.readOnly = false; }
    }
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
