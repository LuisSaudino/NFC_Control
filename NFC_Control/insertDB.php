<?php
	session_start();
    require 'database.php';

    if ( !empty($_POST)) {
        // recebe os dados
        $id = $_POST['id'];
		$name = $_POST['name'];
		$enterprise = $_POST['empresa'];
		$gender = $_POST['gender'];
        $email = $_POST['email'];
        $rg = $_POST['rg'];
		$cpf = $_POST['cpf'];
		$cnh = $_POST['cnh'];
        
		// verifica se a foto esta correta
		if(isset($_FILES['foto'])){
			$formatosPermitidos = array("png", "jpeg", "jpg");
			$extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

			if(in_array($extensao, $formatosPermitidos)){
				$diretorio = "img_users/";
				$temporario = $_FILES['foto']['tmp_name'];
				$novoNome = $name.$cpf.".$extensao";

				if(move_uploaded_file($temporario, $diretorio.$novoNome)){
					//se a foto estiver correta, envia os outros dados junto da foto para o BD
					try {
						$pdo = Database::connect();
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = "INSERT INTO cartao (ID) values(?)";
						$q = $pdo->prepare($sql);
						$q->execute(array($id));
						$sql = "INSERT INTO usuarios(ID,Nome,Empresa,Genero,Email,RG,CPF,CNH,Foto) values(?,?,?,?,?,?,?,?,?)";
						$q = $pdo->prepare($sql);
						$q->execute(array($id,$name,$enterprise,$gender,$email,$rg,$cpf,$cnh,$novoNome));
						$sql = "UPDATE usuarios SET Leitura = NOW() WHERE ID = $id";
						$q = $pdo->prepare($sql);
						$q = $pdo->exec($sql);
						Database::disconnect();
						header("Location: user data.php");
						unset($_SESSION['Erro']);
					} catch (\Throwable $th) {
						$_SESSION['Erro'] = 'Insira dados válidos!';
						header("Location: registration.php");
					}
				}else
				header("Location: registration.php?foto=Falha ao salvar o arquivo");
			}else{
				header("Location: registration.php?foto=Foto Invalida, Fomatos Permitidos(PNG,JPG,JPEG)");
			}
		}
    }
?>