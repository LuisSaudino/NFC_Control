<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css_site/login.css">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
        @font-face {
            font-family: lastica;
            src: url("fonts/Lastica.ttf");
        }
    </style>
</head>
<body>
    <form class="form" action="logar.php">
        <div class="card">
            <div class="card-top">
                <img src="img/logoNFC_Control.jpg" class="redondo" alt="NFC_Control Logo">
                <h2>Login</h2>
            </div>
            <div class="card-group">
                <label for="">Usuario</label>
                <input type="text" name="usuario" placeholder="Digite seu usuário" required>
            </div>
            <div class="card-group">
                <label for="">Senha</label>
                <input type="password" name="senha" id="" placeholder="Digite sua senha" required>
            </div>
            <div class="card-group btn-card">
                <input class="btn" type="submit" value="Entrar">
            </div>
        </div>
    </form>
</body>
</html>