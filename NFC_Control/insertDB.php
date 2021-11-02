<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // recebe os dados
        $id = $_POST['id'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
        $email = $_POST['email'];
        $ra = $_POST['mobile'];
        
		// envia para o banco
        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO cartao (ID) values(?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$sql = "INSERT INTO usuarios(ID,Nome,Genero,Email,RA) values(?,?,?,?,?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($id,$name,$gender,$email,$ra));
		Database::disconnect();
		header("Location: user data.php");
    }
?>