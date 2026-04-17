<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carwell – Criar Conta</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/login/registrar.css') }}"/>
</head>
<body>
  <div class="card">
    <div class="logo">
      <img src="{{ asset('img/logo.png') }}" alt="Logo Carwell" style="width: 95px"/>
      <span class="logo-text">Carwell</span>
    </div>

    <h1 class="greeting"><em style="font-style:normal">OLA ,</em> SEJA BEM VINDO</h1>
    <p class="subtitle">PREENCHA OS SEUS DADOS</p>

    <form method="POST" action="{{ route('registrar') }}" id="form-registrar">
      @csrf

      <div class="input-group {{ $errors->has('name') ? 'error' : '' }}">
        <input type="text" id="name" name="name" placeholder="NOME COMPLETO"
               autocomplete="name" value="{{ old('name') }}"/>
      </div>
      <span class="error-msg {{ $errors->has('name') ? 'show' : '' }}">
        {{ $errors->first('name', 'Nome completo é obrigatório') }}
      </span>

      <div class="input-group {{ $errors->has('telefone') ? 'error' : '' }}">
        <input type="tel" id="telefone" name="telefone" placeholder="(11) 99999-9999"
               autocomplete="tel" value="{{ old('telefone') }}"
               pattern="[\+\d\s\(\)\-]{10,20}"
               title="Digite um telefone válido com DDD. Ex: (11) 99999-9999"/>
      </div>
      <span class="error-msg {{ $errors->has('telefone') ? 'show' : '' }}">
        {{ $errors->first('telefone', 'Telefone é obrigatório') }}
      </span>

      <div class="input-group {{ $errors->has('email') ? 'error' : '' }}">
        <input type="email" id="email" name="email" placeholder="EMAIL"
               autocomplete="email" value="{{ old('email') }}"/>
      </div>
      <span class="error-msg {{ $errors->has('email') ? 'show' : '' }}" id="email-err">
        {{ $errors->first('email', 'Email inválido') }}
      </span>

      <div class="input-group {{ $errors->has('password') ? 'error' : '' }}">
        <input type="password" id="senha" name="password" placeholder="SENHA" autocomplete="new-password"/>
        <span class="eye-icon" onclick="toggle('senha','eye1')">
          <svg id="eye1" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
            <line x1="1" y1="1" x2="23" y2="23"/>
          </svg>
        </span>
      </div>
      <span class="error-msg {{ $errors->has('password') ? 'show' : '' }}" id="senha-err">
        {{ $errors->first('password', 'Senha deve ter no mínimo 8 caracteres') }}
      </span>

      <div class="input-group">
        <input type="password" id="confirmar" name="password_confirmation"
               placeholder="CONFIRMAR SENHA" autocomplete="new-password"/>
        <span class="eye-icon" onclick="toggle('confirmar','eye2')">
          <svg id="eye2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
            <line x1="1" y1="1" x2="23" y2="23"/>
          </svg>
        </span>
      </div>

      <div class="btn-row">
        <button type="button" class="btn btn-back"
                onclick="window.location.href='{{ route('login-cliente') }}'">VOLTAR</button>
        <button type="submit" class="btn btn-verify" id="btn-verify">
          <span class="btn-label">VERIFICAR EMAIL</span>
          <span class="spinner"></span>
        </button>
      </div>
    </form>

    <p class="terms">Ao prosseguir você está ciente e concorda em receber comunicações da CARWELL</p>
  </div>

  <script>
    function toggle(inputId) {
      const inp = document.getElementById(inputId);
      inp.type = inp.type === 'password' ? 'text' : 'password';
    }
  </script>
</body>
</html>
