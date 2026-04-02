<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se </title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <h2>Olá, seja bem-vindo!</h2>
        <form action="/login" method="POST">
            @csrf
            <div class="login-container ">
            <input type="email" id="email" placeholder="example@email.com" name="email" required><br><br>
            <input type="password" placeholder="password "id="password" name="password" required><br>
            <h3 class="conta">
                Nao possui uma conta? <a href="Create-Account">Criar uma</a>
            </h3>
            <button type="submit">entrar</button> 
            </div>
        </form>     
    </div>
</body>
</html>