<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        
        $name = $_POST['name'];
		$id = $_POST['id'];
		$gender = $_POST['gender'];
        $email = $_POST['email'];
        $ra = $_POST['mobile'];
         
        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE usuarios  set Nome = ?, Genero =?, Email =?, RA =? WHERE ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($name,$gender,$email,$ra,$id));
		Database::disconnect();
		header("Location: user data.php");
    }
?>