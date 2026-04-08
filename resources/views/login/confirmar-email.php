<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carwell – Confirmar Email</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="css/confirmar-email.css">


  </head>
<body>
  <div class="card">
    <!-- Logo -->
    <div class="logo">
        <img src="img/logo.png" alt="Logo Carwell" style="width: 150px" />
        <span class="logo-text">Carwell</span>
      </div>

    <h1 class="greeting">OLA , CONFIRME O SEU EMAIL</h1>
    <p class="subtitle">Escreva aqui o código que chegou no seu email</p>

    <div class="code-input-wrap">
      <input class="code-input" type="text" maxlength="6" placeholder="XXXXXX" id="code-field"/>
    </div>

    <p class="no-code">O código não chegou? <a href="#">CHAMAR SUPORTE</a></p>

    <div class="btn-row">
      <button class="btn-enter">ENTRAR</button>
    </div>
  </div>

  <script>
    const codeField = document.getElementById('code-field');
    codeField.addEventListener('input', () => {
      codeField.value = codeField.value.toUpperCase();
    });
  </script>
</body>
</html>
