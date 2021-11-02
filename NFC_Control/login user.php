<?php
class Usuario
{
    public function login($usuario, $senha)
    {
        global $pdo;

        $sql = "SELECT id, usuario FROM 'login' WHERE usuario = ? AND senha = ?";
        $q = $pdo->prepare($sql);
        /* $sql->bindValue("usuario", $usuario);
        $sql->bindValue("senha", $senha); */
        $q->execute(array($usuario,$senha));

        if($q->rowCount() > 0){
            $dado = $q->fetch(PDO::FETCH_ASSOC);
            $_SESSION['idUser'] = $dado['id'];
            return true;
        }else{
            return false;
        }
    }
}
