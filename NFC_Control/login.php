<?php
require 'database.php';
require 'login user.php';


try {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro:" . $e->getMessage();
    exit;
}

global $pdo;

if (isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
    $u = new Usuario();

    $usuario = addslashes($_POST['usuario']);
    $senha = addslashes($_POST['senha']);

    if($u->login($usuario,$senha) == true){
        if(isset($_SESSION['idUser'])){
            header("Location: home.php");
            Database::disconnect();
        }else{
            header("Location: login page.php");
        }
    }else{
        header("Location: login page.php");
    }

}else{
    header("Location: login page.php");
}
