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
    <div class="top-row">
      <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo Carwell" style="width: 75px"/>
        <span class="logo-text">Carwell</span>
      </div>
    </div>

    <form method="POST" action="{{ route('perfil.update') }}"
          enctype="multipart/form-data" id="perfil-form">
      @csrf

      <!-- Foto -->
      <div class="photo-section">
        <p class="add-photo-label">{{ __('perfil.adicionar_foto') }}</p>
        <div class="photo-circle" id="photo-circle">
          @if($cliente->foto)
            <img id="preview-img" src="{{ asset('storage/' . $cliente->foto) }}"
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

      <!-- Telefone -->
      <div class="field-group">
        <input class="field-box editable" id="telefone" name="telefone" type="tel"
               placeholder="{{ __('perfil.placeholder_tel') }}"
               pattern="[\+\d\s\(\)\-]{10,20}"
               title="Digite um telefone válido com DDD. Ex: (11) 99999-9999"
               value="{{ old('telefone', $cliente->telefone) }}" readonly/>
      </div>

      <!-- Endereço -->
      <div class="field-group">
        <textarea class="field-box address editable" id="endereco" name="endereco"
                  rows="2" readonly
                  placeholder="{{ __('perfil.placeholder_end') }}">{{ old('endereco', $cliente->endereco) }}</textarea>
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
  </div>

  <script>
    let editing = false;

    @if($errors->any())
      // Se voltou com erros, entra em modo edição automaticamente
      window.addEventListener('DOMContentLoaded', () => entrarEdicao());
    @endif

    @if(session('success'))
      window.addEventListener('DOMContentLoaded', () => showToast());
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

    function showToast() {
      const t = document.getElementById('toast');
      t.classList.add('show');
      setTimeout(() => t.classList.remove('show'), 2800);
    }
  </script>
</body>
</html>
