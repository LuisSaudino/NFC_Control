<?php
//Pagina responsavel por criar o perfil do usuario logado
session_start();
include 'database.php';
class Usuario
{
    public function login($usuario, $senha)
    {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM unip.login WHERE usuario = ?";
        $sql = $pdo->prepare($sql);
        $sql->execute(array($usuario));

        if($sql->rowCount() > 0){
            $dado = $sql->fetch();
            if(password_verify($senha,$dado['senha'])){
                $_SESSION['idUser'] = $dado['id'];
                $_SESSION['nameUser'] = $dado['usuario'];
            }
            return true;
        }else{
            return false;
        }
        Database::disconnect();
    }
}
