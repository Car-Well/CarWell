<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carwell – Criar Conta</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg: #d6e4f0;
      --card-bg: #dce8f3;
      --dark-navy: #1a2e4a;
      --red: #b91c1c;
      --green: #166534;
      --blue: #1e4d8c;
      --input-bg: #c8daea;
      --input-border: #b0c8de;
      --text-muted: #4a6280;
      --font-main: 'Montserrat', sans-serif;
      --font-body: 'Open Sans', sans-serif;
    }
    body {
      min-height: 100vh;
      background: var(--bg);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: var(--font-body);
      padding: 24px;
    }
    .card {
      background: var(--card-bg);
      border-radius: 20px;
      padding: 36px 36px 28px;
      width: 100%;
      max-width: 480px;
      box-shadow: 0 8px 40px rgba(30,77,140,0.10);
    }
    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 28px;
    }
    .logo svg { width: 52px; height: 36px; }
    .logo-text {
      font-family: var(--font-main);
      font-size: 1.6rem;
      font-weight: 800;
      color: var(--dark-navy);
    }
    .greeting {
      font-family: var(--font-main);
      font-size: 1.1rem;
      font-weight: 800;
      color: var(--dark-navy);
      text-transform: uppercase;
      text-align: center;
      margin-bottom: 4px;
    }
    .subtitle {
      font-family: var(--font-main);
      font-size: 0.78rem;
      font-weight: 600;
      color: var(--dark-navy);
      text-transform: uppercase;
      letter-spacing: 0.06em;
      text-align: center;
      margin-bottom: 26px;
    }
    .input-group {
      position: relative;
      margin-bottom: 14px;
    }
    .input-group input {
      width: 100%;
      background: var(--input-bg);
      border: 1.5px solid var(--input-border);
      border-radius: 30px;
      padding: 14px 48px 14px 22px;
      font-family: var(--font-main);
      font-size: 0.82rem;
      font-weight: 700;
      color: var(--dark-navy);
      letter-spacing: 0.07em;
      text-transform: uppercase;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-group input::placeholder { color: var(--dark-navy); opacity: 0.65; }
    .input-group input:focus {
      border-color: var(--blue);
      box-shadow: 0 0 0 3px rgba(30,77,140,0.12);
    }
    .input-group input.error {
      border-color: var(--red);
      box-shadow: 0 0 0 3px rgba(185,28,28,0.10);
    }
    .eye-icon {
      position: absolute;
      right: 18px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: var(--text-muted);
      display: flex;
      align-items: center;
    }
    .error-msg {
      font-family: var(--font-body);
      font-size: 0.68rem;
      color: var(--red);
      margin: -8px 0 10px 18px;
      display: none;
    }
    .error-msg.show { display: block; }
    .btn-row {
      display: flex;
      gap: 16px;
      margin-top: 22px;
      margin-bottom: 20px;
    }
    .btn {
      flex: 1;
      padding: 14px 10px;
      border: none;
      border-radius: 30px;
      font-family: var(--font-main);
      font-size: 0.88rem;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      cursor: pointer;
      transition: filter 0.18s, transform 0.15s;
    }
    .btn:hover { filter: brightness(1.1); transform: translateY(-1px); }
    .btn:active { transform: translateY(0); }
    .btn-back { background: var(--red); color: #fff; }
    .btn-verify { background: #166534; color: #fff; }
    .terms {
      font-family: var(--font-body);
      font-size: 0.67rem;
      color: var(--text-muted);
      text-align: center;
      line-height: 1.5;
    }
    /* Loading spinner */
    .spinner {
      display: none;
      width: 18px; height: 18px;
      border: 2.5px solid rgba(255,255,255,0.4);
      border-top-color: #fff;
      border-radius: 50%;
      animation: spin 0.7s linear infinite;
      margin: 0 auto;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    .btn-verify.loading .btn-label { display: none; }
    .btn-verify.loading .spinner { display: block; }
 
    @media (max-width: 480px) {
      .card { padding: 28px 18px 22px; }
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="logo">
      <svg viewBox="0 0 80 52" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M10 30 Q20 12 40 12 Q60 12 70 30" stroke="#1a2e4a" stroke-width="3.5" fill="none" stroke-linecap="round"/>
        <rect x="8" y="28" width="64" height="12" rx="6" fill="#1a2e4a"/>
        <circle cx="22" cy="40" r="7" fill="#1a2e4a"/><circle cx="22" cy="40" r="4" fill="#d6e4f0"/>
        <circle cx="58" cy="40" r="7" fill="#1a2e4a"/><circle cx="58" cy="40" r="4" fill="#d6e4f0"/>
        <path d="M36 12 Q40 4 44 6" stroke="#1e4d8c" stroke-width="2.5" fill="none" stroke-linecap="round"/>
        <circle cx="44" cy="5.5" r="2.5" fill="#1e4d8c"/>
      </svg>
      <span class="logo-text">Carwell</span>
    </div>
 
    <h1 class="greeting"><em style="font-style:normal">OLA ,</em> SEJA BEM VINDO</h1>
    <p class="subtitle">DIGITE SEU EMAIL E SENHA</p>
 
    <div class="input-group">
      <input type="email" id="email" placeholder="EMAIL" autocomplete="email"/>
    </div>
    <span class="error-msg" id="email-err">Email inválido</span>
 
    <div class="input-group">
      <input type="password" id="senha" placeholder="SENHA" autocomplete="new-password"/>
      <span class="eye-icon" onclick="toggle('senha','eye1')">
        <svg id="eye1" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
          <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
          <line x1="1" y1="1" x2="23" y2="23"/>
        </svg>
      </span>
    </div>
    <span class="error-msg" id="senha-err">Senha deve ter no mínimo 8 caracteres</span>
 
    <div class="input-group">
      <input type="password" id="confirmar" placeholder="CONFIRMAR SENHA" autocomplete="new-password"/>
      <span class="eye-icon" onclick="toggle('confirmar','eye2')">
        <svg id="eye2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
          <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
          <line x1="1" y1="1" x2="23" y2="23"/>
        </svg>
      </span>
    </div>
    <span class="error-msg" id="confirmar-err">As senhas não coincidem</span>
 
    <div class="btn-row">
      <button class="btn btn-back" onclick="window.location.href='login.html'">VOLTAR</button>
      <button class="btn btn-verify" id="btn-verify" onclick="submitForm()">
        <span class="btn-label">VERIFICAR EMAIL</span>
        <span class="spinner"></span>
      </button>
    </div>
 
    <p class="terms">Ao prosseguir você está ciente e concorda em receber comunicações da CARWELL</p>
  </div>
 
  <script>
    function toggle(inputId, iconId) {
      const inp = document.getElementById(inputId);
      inp.type = inp.type === 'password' ? 'text' : 'password';
    }
 
    function showErr(id, show) {
      document.getElementById(id).classList.toggle('show', show);
    }
    function markField(id, error) {
      document.getElementById(id).classList.toggle('error', error);
    }
 
    function submitForm() {
      const email = document.getElementById('email').value.trim();
      const senha = document.getElementById('senha').value;
      const confirmar = document.getElementById('confirmar').value;
 
      const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      const senhaOk = senha.length >= 8;
      const confirmarOk = senha === confirmar && confirmar.length > 0;
 
      markField('email', !emailOk);
      showErr('email-err', !emailOk);
      markField('senha', !senhaOk);
      showErr('senha-err', !senhaOk);
      markField('confirmar', !confirmarOk);
      showErr('confirmar-err', !confirmarOk);
 
      if (!emailOk || !senhaOk || !confirmarOk) return;
 
      // Submit to backend
      const btn = document.getElementById('btn-verify');
      btn.classList.add('loading');
      btn.disabled = true;
 
      fetch('/api/register', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
        body: JSON.stringify({ email, password: senha, password_confirmation: confirmar })
      })
      .then(r => r.json())
      .then(data => {
        btn.classList.remove('loading');
        btn.disabled = false;
        if (data.success) {
          // Redireciona para confirmar email
          window.location.href = 'confirmar-email.html?email=' + encodeURIComponent(email);
        } else {
          // Exibe erros do servidor
          if (data.errors?.email) {
            markField('email', true);
            document.getElementById('email-err').textContent = data.errors.email[0];
            showErr('email-err', true);
          }
        }
      })
      .catch(() => {
        btn.classList.remove('loading');
        btn.disabled = false;
        alert('Erro de conexão. Tente novamente.');
      });
    }
  </script>
</body>
</html>