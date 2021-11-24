<?php
require 'database.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST)) {

    $name = $_POST['name'];
    $id = $_POST['id'];
    $gender = $_POST['gender'];
    $enterprise = $_POST['empresa'];
    $email = $_POST['email'];
    $rg = $_POST['rg'];
    $cpf = $_POST['cpf'];
    $cnh = $_POST['cnh'];

    if (isset($_FILES['foto'])) {
        $formatosPermitidos = array("png", "jpeg", "jpg");
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

        if (in_array($extensao, $formatosPermitidos)) {
            $diretorio = "img_users/";
            $temporario = $_FILES['foto']['tmp_name'];
            $novoNome = $name . $cpf . ".$extensao";


            $arquivo = 'img_users/'.$novoNome;
            if(file_exists($arquivo)){
                unlink($arquivo);
            }

            if (move_uploaded_file($temporario, $diretorio.$novoNome)) {

                try {
                    $pdo = Database::connect();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE usuarios  set Nome = ?,Empresa =?, Genero =?, Email =?, RG =?, CPF =?, CNH =?, Foto =? WHERE ID = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($name, $enterprise, $gender, $email, $rg, $cpf, $cnh, $novoNome, $id));
                    Database::disconnect();
                    header("Location: user data.php");
                } catch (Throwable $th) {
                    $_SESSION['Erro'] = 'Insira dados válidos!';
                    header("Location: user data edit page.php?id=$id");
                }
            } else
                header("Location: user data edit page.php?id=$id&foto=Falha ao salvar o arquivo");
        } else {
            header("Location: user data edit page.php?id=$id&foto=Foto Invalida, Fomatos Permitidos(PNG,JPG,JPEG)");
        }
    }
}
?>