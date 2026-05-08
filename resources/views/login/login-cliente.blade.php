<!DOCTYPE html>
<html lang="pt-BR">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>CarWell — Entrar</title>
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
            <h2>O carro dos seus<br><span>sonhos te espera.</span></h2>
            <p>Encontre veículos premium com transparência, segurança e a melhor experiência de compra do Brasil.</p>
        </div>

        <div class="visual-stats">
            <div class="visual-stat">
                <div class="visual-stat-val">+2.400</div>
                <div class="visual-stat-label">Veículos vendidos</div>
            </div>
            <div class="visual-stat">
                <div class="visual-stat-val">4.9★</div>
                <div class="visual-stat-label">Avaliação média</div>
            </div>
            <div class="visual-stat">
                <div class="visual-stat-val">+8.000</div>
                <div class="visual-stat-label">Clientes satisfeitos</div>
            </div>
            <div class="visual-stat">
                <div class="visual-stat-val">100%</div>
                <div class="visual-stat-label">Seguro e confiável</div>
            </div>
        </div>
    </div>

    <div class="login-form-side">
        <div class="login-box">
            <h1 class="login-title">Bem-vindo de volta</h1>
            <p class="login-subtitle">Entre com sua conta para continuar</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login-cliente') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="seu@email.com"
                        value="{{ old('email') }}"
                        autocomplete="email"
                    >
                    @error('email') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Senha</label>
                    <div class="input-wrap">
                        <input
                            type="password"
                            name="password"
                            id="senhaInput"
                            class="form-control has-icon"
                            placeholder="••••••••"
                            autocomplete="current-password"
                        >
                        <button type="button" class="input-icon" onclick="toggleSenha()">
                            <svg id="eyeIcon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    @error('password') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-row">
                    <label class="remember-wrap">
                        <input type="checkbox" name="remember">
                        Lembrar de mim
                    </label>
                    <a href="{{ route('registrar') }}" class="forgot-link">Esqueci a senha</a>
                </div>

                <button type="submit" class="btn-submit">Entrar na minha conta</button>
            </form>

            <a href="{{ route('home') }}" class="btn-back">← Voltar ao site</a>

            <div class="divider">
                <div class="divider-line"></div>
                <span class="divider-text">Não tem uma conta?</span>
                <div class="divider-line"></div>
            </div>

            <p class="signup-row">
                <a href="{{ route('registrar') }}">Criar conta gratuita</a>
            </p>
        </div>
    </div>

    <script>
    function toggleSenha() {
        const input = document.getElementById('senhaInput');
        const icon  = document.getElementById('eyeIcon');
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