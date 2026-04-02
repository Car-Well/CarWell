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
            <input type="password" id="password" placeholder="password" name="password" required><br>
            <input type="number" placeholder="Enter your ID" id=" " name="id" required><br>
            <h3>
                Esqueceu a senha? <a href="#">Chamar suporte</a>
            </h3>
            <button type="submit">entrar</button> 
            </div>
        </form>     
    </div>
</body>
</html>