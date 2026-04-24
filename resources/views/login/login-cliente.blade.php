<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('login.titulo_login') }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
</head>
<body>
  <div class="card">
    <div class="logo">
      <img src="{{ asset('img/logo.png') }}" alt="Logo Carwell" style="width: 110px"/>
      <span class="logo-text">Carwell</span>
    </div>

    <h1 class="greeting">{{ __('login.ola_bem_vindo') }}</h1>
    <p class="subtitle">{{ __('login.digite_email_senha') }}</p>

    <form method="POST" action="{{ route('login-cliente') }}">
      @csrf

      <div class="input-group">
        <input type="email" name="email" placeholder="{{ __('login.placeholder_email') }}" autocomplete="email"
               value="{{ old('email') }}" />
      </div>
      @error('email')
        <span class="error-text">{{ $message }}</span>
      @enderror

      <div class="input-group">
        <input type="password" name="password" placeholder="{{ __('login.placeholder_senha') }}"
               id="senha-input" autocomplete="current-password" />
        <span class="eye-icon" onclick="toggleSenha()">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
            <line x1="1" y1="1" x2="23" y2="23"/>
          </svg>
        </span>
      </div>

      <a href="{{ route('registrar') }}" class="forgot">{{ __('login.esqueci_senha') }}</a>

      <div class="btn-row">
        <button type="button" class="btn btn-back"
                onclick="window.location.href='{{ route('home') }}'">{{ __('login.voltar') }}</button>
        <button type="submit" class="btn btn-enter">{{ __('login.entrar') }}</button>
      </div>
    </form>

    <p class="signup-row">{{ __('login.nao_tem_conta') }}
      <a href="{{ route('registrar') }}">{{ __('login.crie_uma') }}</a>
    </p>
    <p class="terms">{{ __('login.termos') }}</p>
  </div>

  <script>
    function toggleSenha() {
      const inp = document.getElementById('senha-input');
      inp.type = inp.type === 'password' ? 'text' : 'password';
    }
  </script>
</body>
</html>
