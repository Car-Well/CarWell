<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ __('login.titulo_confirmar') }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/login/login-cliente.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/login/confirmar-email.css') }}"/>
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

      <h1 class="login-title">{{ __('login.ola_confirme') }}</h1>
      <p class="login-subtitle">{{ __('login.escreva_codigo') }}</p>

      @if(session('reenvio'))
        <div class="alert alert-success">{{ session('reenvio') }}</div>
      @endif

      <form method="POST" action="{{ route('confirmar-email') }}">
        @csrf

        <div class="code-input-wrap">
          <input class="code-input {{ $errors->has('code') ? 'is-invalid' : '' }}"
                 type="text" name="code" maxlength="6" placeholder="000000"
                 id="code-field" inputmode="numeric" autocomplete="one-time-code"
                 value="{{ old('code') }}"/>
        </div>

        @error('code')
          <span class="error-text" style="text-align:center; display:block; margin-bottom:12px;">{{ $message }}</span>
        @enderror

        <button type="submit" class="btn-submit">{{ __('login.confirmar_codigo') }}</button>
      </form>

      <p class="no-code">
        {{ __('login.codigo_nao_chegou') }}
        <form method="POST" action="{{ route('reenviar-codigo') }}" style="display:inline">
          @csrf
          <button type="submit" class="resend-btn">{{ __('login.reenviar_codigo') }}</button>
        </form>
      </p>

    </div>
  </div>

  <script>
    const codeField = document.getElementById('code-field');
    codeField.addEventListener('input', () => {
      codeField.value = codeField.value.replace(/\D/g, '').slice(0, 6);
    });
  </script>
</body>
</html>
