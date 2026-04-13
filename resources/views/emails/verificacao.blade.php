<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8"/>
  <style>
    body { font-family: 'Segoe UI', Arial, sans-serif; background: #d6e4f0; margin: 0; padding: 40px 0; }
    .card { background: #fff; max-width: 480px; margin: 0 auto; border-radius: 12px; padding: 40px 36px; text-align: center; }
    .logo-text { font-size: 22px; font-weight: 900; color: #1a2e4a; letter-spacing: 2px; }
    h2 { color: #1a2e4a; margin: 24px 0 8px; font-size: 18px; }
    p  { color: #555; font-size: 14px; margin: 8px 0; }
    .code { font-size: 42px; font-weight: 900; letter-spacing: 10px; color: #1e4d8c;
            border: 2px dashed #1e4d8c; border-radius: 8px; padding: 12px 24px;
            display: inline-block; margin: 24px 0; }
    .note { font-size: 12px; color: #888; margin-top: 24px; }
  </style>
</head>
<body>
  <div class="card">
    <span class="logo-text">CARWELL</span>
    <h2>Confirme o seu e-mail</h2>
    <p>Use o código abaixo para concluir o seu cadastro:</p>
    <div class="code">{{ $code }}</div>
    <p>O código é válido por <strong>15 minutos</strong>.</p>
    <p class="note">Se você não solicitou este cadastro, ignore este e-mail.</p>
  </div>
</body>
</html>
