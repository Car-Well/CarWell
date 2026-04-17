<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carwell – Confirmar Email</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/login/confirmar-email.css') }}"/>
</head>
<body>
  <div class="card">
    <div class="logo">
      <img src="{{ asset('img/logo.png') }}" alt="Logo Carwell" style="width: 90px"/>
      <span class="logo-text">Carwell</span>
    </div>

    <h1 class="greeting">OLA , CONFIRME O SEU EMAIL</h1>
    <p class="subtitle">Escreva aqui o código que chegou no seu email</p>

    @if(session('reenvio'))
      <p style="color:#166534; font-size:13px; margin-bottom:8px;">{{ session('reenvio') }}</p>
    @endif

    <form method="POST" action="{{ route('confirmar-email') }}">
      @csrf

      <div class="code-input-wrap">
        <input class="code-input {{ $errors->has('code') ? 'error' : '' }}"
               type="text" name="code" maxlength="6" placeholder="000000"
               id="code-field" inputmode="numeric" autocomplete="one-time-code"
               value="{{ old('code') }}"/>
      </div>

      @error('code')
        <p style="color:#b91c1c; font-size:13px; margin: 6px 0 0; text-align:center;">
          {{ $message }}
        </p>
      @enderror

      <div class="btn-row">
        <button type="submit" class="btn-enter">ENTRAR</button>
      </div>
    </form>

    <p class="no-code">
      O código não chegou?
      <form method="POST" action="{{ route('reenviar-codigo') }}" style="display:inline">
        @csrf
        <button type="submit" style="background:none;border:none;cursor:pointer;
                color:#1D9E75;font-weight:700;font-size:inherit;padding:0;
                font-family:inherit;">REENVIAR CÓDIGO</button>
      </form>
    </p>
  </div>

  <script>
    const codeField = document.getElementById('code-field');
    codeField.addEventListener('input', () => {
      codeField.value = codeField.value.replace(/\D/g, '').slice(0, 6);
    });
  </script>
</body>
</html>
