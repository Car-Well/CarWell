<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ __('login.titulo_registrar') }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/login/login-cliente.css') }}"/>
</head>
<body>

  {{-- ===== PAINEL ESQUERDO ===== --}}
  <div class="login-visual">
    <div class="visual-brand">
      <div class="visual-brand-logo">
        <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
      </div>
      Car<strong>Well</strong>
    </div>

    <div class="visual-hero">
      <h2>{{ __('login.hero_titulo') }}</h2>
      <p>{{ __('login.hero_subtitulo') }}</p>
    </div>

    <div class="visual-stats">
      <div class="visual-stat">
        <div class="visual-stat-val">+2.400</div>
        <div class="visual-stat-label">{{ __('login.stat_veiculos') }}</div>
      </div>
      <div class="visual-stat">
        <div class="visual-stat-val">4.9★</div>
        <div class="visual-stat-label">{{ __('login.stat_avaliacao') }}</div>
      </div>
      <div class="visual-stat">
        <div class="visual-stat-val">+8.000</div>
        <div class="visual-stat-label">{{ __('login.stat_clientes') }}</div>
      </div>
      <div class="visual-stat">
        <div class="visual-stat-val">100%</div>
        <div class="visual-stat-label">{{ __('login.stat_seguro') }}</div>
      </div>
    </div>
  </div>

  {{-- ===== PAINEL DIREITO ===== --}}
  <div class="login-form-side">
    <div class="login-box">

      <h1 class="login-title">{{ __('login.ola_bem_vindo') }}</h1>
      <p class="login-subtitle">{{ __('login.preencha_dados') }}</p>

      @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('registrar') }}">
        @csrf

        <div class="form-group">
          <label class="form-label">{{ __('login.placeholder_nome') }}</label>
          <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                 placeholder="Seu nome completo" value="{{ old('name') }}" autocomplete="name"/>
          @error('name') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
          <label class="form-label">{{ __('login.placeholder_telefone') }}</label>
          <input type="tel" name="telefone" class="form-control {{ $errors->has('telefone') ? 'is-invalid' : '' }}"
                 placeholder="(11) 99999-9999" value="{{ old('telefone') }}" autocomplete="tel"
                 oninput="maskTelefone(this)"/>
          @error('telefone') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
          <label class="form-label">{{ __('login.placeholder_email') }}</label>
          <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                 placeholder="seu@email.com" value="{{ old('email') }}" autocomplete="email"/>
          @error('email') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
          <label class="form-label">{{ __('login.placeholder_senha') }}</label>
          <div class="input-wrap">
            <input type="password" name="password" id="senhaInput"
                   class="form-control has-icon {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="••••••••" autocomplete="new-password"/>
            <button type="button" class="input-icon" onclick="toggleSenha('senhaInput','eyeIcon1')">
              <svg id="eyeIcon1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
          @error('password') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
          <label class="form-label">{{ __('login.placeholder_conf_senha') }}</label>
          <div class="input-wrap">
            <input type="password" name="password_confirmation" id="confirmarInput"
                   class="form-control has-icon"
                   placeholder="••••••••" autocomplete="new-password"/>
            <button type="button" class="input-icon" onclick="toggleSenha('confirmarInput','eyeIcon2')">
              <svg id="eyeIcon2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
        </div>

        <button type="submit" class="btn-submit">{{ __('login.verificar_email') }}</button>
      </form>

      <a href="{{ route('login-cliente') }}" class="btn-back">{{ __('login.voltar_login') }}</a>

      <div class="divider">
        <div class="divider-line"></div>
        <span class="divider-text">{{ __('login.ja_tem_conta') }}</span>
        <div class="divider-line"></div>
      </div>

      <p class="signup-row">
        <a href="{{ route('login-cliente') }}">{{ __('login.entrar_conta') }}</a>
      </p>

    </div>
  </div>

  <script>
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

  function toggleSenha(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    if (input.type === 'password') {
      input.type = 'text';
      icon.innerHTML = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`;
    } else {
      input.type = 'password';
      icon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    }
  }
  </script>
</body>
</html>
