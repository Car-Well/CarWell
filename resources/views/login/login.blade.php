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
        <form action="/login" method="POST">
            @csrf
            <div class="info_email ">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            </div>
            <div class="info_senha">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required><br><br>
            </div>
            <div class="botton">
            <button type="submit">Entrar</button> 
            </div>
        </form>     
    </div>
</body>
</html>