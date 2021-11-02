<?php
$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);
?>

<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <style>
        html {
            font-family: Arial;
            display: inline-block;
            margin: 0px auto;
            text-align: center;
        }

        body {
            background-color: #423E3B;
            color: #E3D3E4;
        }

        ul.topnav {
            list-style-type: none;
            margin: auto;
            padding: 0;
            overflow: hidden;
            background-color: #FF4242;
            width: 40%;
            border-radius: 10px;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        ul.topnav li {
            float: left;
            width: 100%;
        }

        ul.topnav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.topnav li a:hover:not(.active) {
            background-color: #FF5C7A;
        }

        ul.topnav li a.active {
            background-color: #8F0000;
        }

        ul.topnav li.right {
            float: right;
        }

        @media screen and (max-width: 600px) {

            ul.topnav li.right,
            ul.topnav li {
                float: none;
            }
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .redondo {
            background-color: #000;
            color: #FFF;
            border-radius: 30%;
            margin-bottom: 20px;
        }
        h4{
            display: inline-block;
            width: 50%;
        }
    </style>

    <title>NFC_Control Pagina Inicial</title>

</head>

<body>
    <br />
    <img src="img/logoNFC_Control.jpg" alt="" class="redondo" style="width:10%; ">
    <ul class="topnav">
        <li><a class="active" href="home.php">Página Inicial</a></li>
        <li><a href="user data.php">Usuários</a></li>
        <li><a href="registration.php">Registrar</a></li>
        <li><a href="read tag.php">Pesquisar</a></li>
    </ul>

    <br>
    <h3>Bem vindo a NFC Control! <br />A tecnologia do futuro.</h3>
    <img src="img/progamacao.jpg" alt="" style="width:30%; border-radius:3%">
    <h3>O que o NFC Control faz?</h3>
    <h4>O nosso programa foca no sistema de presença dos usuarios via cartões NFC. Com isso a empresa, escola ou agência poden identificar, gerenciar e ter acesso as informações necessarias de cada usuario. </h4>
</body>

</html>