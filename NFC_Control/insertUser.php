<?php
    require 'database.php';
 
    if ( !empty($_POST)) {
        // recebe os dados de usuario
        $usuario = $_POST['usuario'];
		$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        // recebe os dados da empresa
        $nome_empresa = $_POST['nome'];
        $cnpj = $_POST['cnpj'];
        //cadastra um novo usuario
        if(isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
            // envia para o banco
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO unip.login (usuario,senha) values(?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($usuario,$senha));
            Database::disconnect();
            header("Location: user data.php");
        }
        //Cadastra o nome da emrpesa
        if(isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['cnpj']) && !empty($_POST['cnpj'])) {
            // envia para o banco
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO unip.empresa (nome,cnpj) values(?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome_empresa,$cnpj));
            Database::disconnect();
            header("Location: user data.php");
        }
        }
?>