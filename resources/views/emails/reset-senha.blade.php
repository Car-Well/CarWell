<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"/>
</head>
<body style="font-family:'DM Sans',Arial,sans-serif;background:#F4F5F3;margin:0;padding:40px 0;">
  <div style="background:#fff;max-width:480px;margin:0 auto;border-radius:12px;padding:40px 36px;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,0.06);">

    <span style="font-family:'Syne',Arial,sans-serif;font-size:22px;font-weight:900;color:#1A1C19;letter-spacing:2px;">CARWELL</span>

    <h2 style="color:#1A1C19;margin:24px 0 8px;font-size:18px;font-family:'Syne',Arial,sans-serif;">Redefinição de senha</h2>

    <p style="color:#6B6E69;font-size:14px;margin:8px 0;">Recebemos uma solicitação para redefinir a senha da sua conta CarWell.</p>
    <p style="color:#6B6E69;font-size:14px;margin:8px 0;">Clique no botão abaixo para criar uma nova senha:</p>

    <a href="{{ $url }}" style="display:inline-block;margin:28px 0;background:linear-gradient(135deg,#1D9E75,#0F6E56);color:#fff;font-family:'Syne',Arial,sans-serif;font-size:14px;font-weight:800;text-transform:uppercase;letter-spacing:0.08em;padding:14px 36px;border-radius:8px;text-decoration:none;">Redefinir senha</a>

    <p style="font-size:12px;color:#9EA19C;margin-top:8px;">Este link expira em <strong style="color:#9EA19C;">60 minutos</strong>.</p>
    <p style="font-size:12px;color:#9EA19C;margin-top:8px;">Se você não solicitou a redefinição, ignore este email — sua senha continua a mesma.</p>

    <hr style="border:none;border-top:1px solid #F0F1EF;margin:24px 0;">

    <p style="font-size:12px;color:#9EA19C;word-break:break-all;">
      Se o botão não funcionar, copie e cole este link no seu navegador:<br>
      <a href="{{ $url }}" style="color:#1D9E75;">{{ $url }}</a>
    </p>

  </div>
</body>
</html>
