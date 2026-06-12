<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>
      <title>{{ __('login.titulo_esqueci') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login/login-cliente.css') }}"/>
  </head>
  <body>
    <div class="login-visual">
      <div class="visual-brand">
        <div class="visual-brand-logo">
          <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
        </div>
        Car<strong>Well</strong>
      </div>
      <div class="visual-hero">
        <h2>{{ __('login.recupere_acesso') }}<br><span>{{ __('login.link_nova_senha') }}</span></h2>
      </div>
      <div class="visual-stats">
        <div class="visual-stat"><div class="visual-stat-val">+2.400</div><div class="visual-stat-label">{{ __('login.stat_veiculos') }}</div></div>
        <div class="visual-stat"><div class="visual-stat-val">4.9★</div><div class="visual-stat-label">{{ __('login.stat_avaliacao') }}</div></div>
        <div class="visual-stat"><div class="visual-stat-val">+8.000</div><div class="visual-stat-label">{{ __('login.stat_clientes') }}</div></div>
        <div class="visual-stat"><div class="visual-stat-val">100%</div><div class="visual-stat-label">{{ __('login.stat_seguro') }}</div></div>
      </div>
    </div>

    <div class="login-form-side">
      <div class="login-box">
        <h1 class="login-title">{{ __('login.esqueci_titulo') }}</h1>
        <p class="login-subtitle">{{ __('login.esqueci_subtitulo') }}</p>

        @if(session('status'))
          <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('esqueci-senha.enviar') }}">
          @csrf
          <div class="form-group">
            <label class="form-label">{{ __('login.label_email') }}</label>
            <input type="email" name="email" class="form-control" placeholder="{{ __('login.placeholder_seu_email') }}" value="{{ old('email') }}" autofocus>
          </div>

          <button type="submit" class="btn-submit">{{ __('login.enviar_link') }}</button>
        </form>

        <a href="{{ route('login-cliente') }}" class="btn-back">{{ __('login.voltar_login') }}</a>
      </div>
    </div>
  </body>
</html>
