<?php
session_start();
if (!isset($_SESSION['idUser'])) {
    header("Location: login.php");
}
if (isset($_GET['sair'])) {
    unset($_SESSION['idUser']);
    unset($_SESSION['nameUser']);
    header("Location: login.php");
}
$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);
?>

<!DOCTYPE html>
<html lang="pt">
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css_site/home.css">
    <script src="js/bootstrap.min.js"></script>

    <title>NFC_Control Pagina Inicial</title>

</head>

<body>
    <header>
        <div class="container" id="nav-container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <ul class="navbar-nav">
                    <a href="#" class="navbar-brand">
                        <img src="img/logoNFC_Control.jpg" alt="NFC_Control" class="logo">
                    </a>
                    <li class="nav-item"><a id="active" class="active nav-link" href="home.php">Página Inicial</a></li>
                    <li class="nav-item"><a class="nav-link" href="user data.php">Funcionarios</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Registrar</a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="registration user.php">Usuario</a></li>
                            <li><a class="dropdown-item" href="registration.php">Funcionario</a></li>
                            <li><a class="dropdown-item" href="registration entp.php">Empresa</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="read tag.php">Pesquisar</a></li>
                </ul>
                <div class="navbar-nav login">
                    <label><?php echo $_SESSION['nameUser']; ?></label>
                    <a href="home.php?sair=true" class="sair btn btn-danger">Sair</a>
                </div>
            </nav>
        </div>
    </header>
    <div class="conteudo">
        <h3><b>Bem vindo a NFC Control!</b> <br />A tecnologia do futuro.</h3>
        <img src="img/progamacao.jpg" alt="" style="width:30%; border-radius:3%">
        <h3><b>O que o NFC Control faz?</b></h3>
        <h4>O nosso programa foca no sistema de presença dos usuarios via cartões NFC. Com isso a empresa, escola ou agência podem identificar, gerenciar e ter acesso as informações necessarias de cada usuario. </h4>
    </div>
</body>

</html>