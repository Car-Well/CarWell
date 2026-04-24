<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'DM Sans', Arial, sans-serif;
      background: #F4F5F3;
      margin: 0;
      padding: 40px 0;
    }

    .card {
      background: #fff;
      max-width: 480px;
      margin: 0 auto;
      border-radius: 12px;
      padding: 40px 36px;
      text-align: center;
      box-shadow: 0 4px 24px rgba(0,0,0,0.06);
    }

    .logo-text {
      font-family: 'Syne', Arial, sans-serif;
      font-size: 22px;
      font-weight: 900;
      color: #1A1C19;
      letter-spacing: 2px;
    }

    h2 {
      color: #1A1C19;
      margin: 24px 0 8px;
      font-size: 18px;
      font-family: 'Syne', Arial, sans-serif;
    }

    p {
      color: #6B6E69;
      font-size: 14px;
      margin: 8px 0;
    }

    .code {
      font-size: 42px;
      font-weight: 900;
      letter-spacing: 10px;
      color: #1D9E75;
      border: 2px dashed #1D9E75;
      border-radius: 8px;
      padding: 12px 24px;
      display: inline-block;
      margin: 24px 0;
      font-family: 'Syne', Arial, sans-serif;
    }

    .note {
      font-size: 12px;
      color: #9EA19C;
      margin-top: 24px;
    }

  </style>
</head>
<body>
  <div class="card">
    <span class="logo-text">CARWELL</span>
    <h2>{{ __('emails.confirme_email') }}</h2>
    <p>{{ __('emails.use_codigo') }}</p>
    <div class="code">{{ $code }}</div>
    <p>{!! __('emails.valido_por') !!}</p>
    <p class="note">{{ __('emails.nao_solicitou') }}</p>
  </div>
</body>
</html>
