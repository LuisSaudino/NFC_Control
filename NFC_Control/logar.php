<?php
//Pagina responsavel por criar o sistema de login
include "user.class.php";

if(isset($_REQUEST['usuario']) && !empty($_REQUEST['usuario']) 
    && isset($_REQUEST['senha']) && !empty($_REQUEST['senha'])){


    $u = new Usuario();

    $usuario = addslashes($_REQUEST['usuario']);
    $senha = addslashes($_REQUEST['senha']);
    
    if($u->login($usuario,$senha)){
        if(isset($_SESSION['idUser'])){
            header("Location: home.php");
        }else{
            header("Location: login.php");
        }
    }else{
        header("Location: login.php"); 
    }
}else{
    header("Location: login.php"); 
}
?>