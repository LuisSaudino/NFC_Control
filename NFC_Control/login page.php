<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="./js/bootstrap.min.js"></script>
    <script src="jquery.min.js"></script>
    <style>
        body {

            background-color: #423E3B;
            color: #E3D3E4;
            font-size: 14px;
            text-align: center;
        }

        .simple-login-container {
            width: 300px;
            max-width: 100%;
            margin: 50px auto;
        }

        .simple-login-container h2 {
            text-align: center;
            font-size: 20px;
        }

        .simple-login-container .btn-login {
            background-color: #FF5964;
            color: #fff;
        }

        a {
            color: #fff;
        }

        .redondo {
            background-color: #000;
            color: #FFF;
            border-radius: 30%;
            margin-bottom: 20px;
        }
        .form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form div{
            margin: 2px;
        }

    </style>
</head>

<body>
        <form action="login.php" method="post" class="container text-center form">
        <img src="img/logoNFC_Control.jpg" alt="" class="redondo" style="width:15%; ">
            <div class="row">
                <div class="col-md-12 form-group">
                    <input name="usuario" type="text" class="form-control" placeholder="Usuário">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input name="senha" type="password" placeholder="Senha" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="submit" class="btn btn-login btn-danger" placeholder="Enter your Password" value="Entrar">
                </div>
            </div>
        </form>
</body>

</html>