<?php
require 'database.php';
session_start();
if (!isset($_SESSION['idUser'])) {
    header("Location: login.php");
}
$id = 0;

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST)) {

    $id = $_POST['id'];


    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    $arquivo = 'img_users/' . $data['Foto'];
    if (file_exists($arquivo)) {
        unlink($arquivo);
    }

    $sql = "DELETE FROM usuarios  WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));




    $sql = "DELETE FROM cartao  WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Database::disconnect();
    header("Location: user data.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <title>NFC_Control Deletar</title>
    <style>
        html {
            font-family: Arial;
            display: inline-block;
            margin: 0px auto;
            text-align: center;
        }
        .content{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        body {
            background-color: #6b6b6a;
            color: #E3D3E4;
        }

        .form {
            display: flex;
            justify-content: center;
        }

        .redondo {
            background-color: #000;
            color: #FFF;
            border-radius: 30%;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="content mt-3">
        <img src="img/logoNFC_Control.jpg" alt="" class="redondo" style="width:10%; ">
        <div class="container">
            <div class="span10 offset1 form">
                <form class="form-horizontal" action="user data delete page.php" method="post">
                    <h3 align="center">Deletar Usuário</h3>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <p class="alert alert-error"><b>Deseja realmente deletar este funcionario?<b></p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-secondary">Sim</button>
                        <a class="btn btn-danger" href="user data.php">Não</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>