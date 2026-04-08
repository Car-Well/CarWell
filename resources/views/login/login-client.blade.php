<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carwell – Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  </head>
  <body>
    <div class="card">
      <!-- Logo -->
      <div class="logo">
        <img src="img/logo.png" alt="Logo Carwell" style="width: 150px" />
        <span class="logo-text">Carwell</span>
      </div>

      <h1 class="greeting"><em>OLA ,</em> SEJA BEM VINDO</h1>
      <p class="subtitle">DIGITE SEU EMAIL E SENHA</p>

      <div class="input-group">
        <input type="email" placeholder="EMAIL" autocomplete="email" />
      </div>

      <div class="input-group">
        <input
          type="password"
          placeholder="SENHA"
          id="senha-input"
          autocomplete="current-password"
        />
        <span class="eye-icon" onclick="toggleSenha()">
          <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path
              d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"
            />
            <path
              d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"
            />
            <line x1="1" y1="1" x2="23" y2="23" />
          </svg>
        </span>
      </div>

      <a href="#" class="forgot">ESQUECI MINHA SENHA</a>

      <div class="btn-row">
        <button
          class="btn btn-back"
          onclick="window.location.href = 'login-admin.html'"
        >
          VOLTAR
        </button>
        <button class="btn btn-enter">ENTRAR</button>
      </div>

      <p class="signup-row">Não tem uma conta? <a href="#">CRIE UMA</a></p>
      <p class="terms">
        Ao prosseguir você está ciente e concorda em receber comunicações da
        CARWELL
      </p>
    </div>

    <script>
      function toggleSenha() {
        const inp = document.getElementById("senha-input");
        inp.type = inp.type === "password" ? "text" : "password";
      }
    </script>
  </body>
</html>
