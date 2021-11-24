<?php

session_start();
if (!isset($_SESSION['idUser'])) {
	header("Location: login.php");
}
if (isset($_GET['sair'])) {
	unset($_SESSION['idUser']);
	unset($_SESSION['nameUser']);
	header("Location: login.php");
}

if (isset($_GET['foto'])) {
	echo "<script>alert('{$_GET['foto']}')</script>";
}
$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);


?>
<!DOCTYPE html>
<html lang="pt">
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css_site/registration.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#getUID").load("UIDContainer.php");
			setInterval(function() {
				$("#getUID").load("UIDContainer.php");
			}, 500);
		});
	</script>

	<title>NFC_Control Registro</title>
</head>

<body>
	<header>
		<div class="container" id="nav-container">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top ">
				<ul class="navbar-nav">
					<a href="#" class="navbar-brand">
						<img src="img/logoNFC_Control.jpg" alt="NFC_Control" class="logo">
					</a>
					<li class="nav-item"><a class="nav-link" href="home.php">Página Inicial</a></li>
					<li class="nav-item"><a class="nav-link" href="user data.php">Funcionarios</a></li>
					<li class="nav-item dropdown">
						<a id="active" class="active nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Registrar</a>
						<ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="registration user.php">Usuario</a></li>
							<li><a class="dropdown-item" href="registration.php">Funcionario</a></li>
							<li><a class="dropdown-item" href="registration entp.php">Empresa</a></li>
						</ul>
					</li>

					<li class="nav-item"><a class="nav-link" href="read tag.php">Pesquisar</a></li>
				</ul>
				<div class="navbar-nav login">
					<label><?php echo $_SESSION['nameUser']; ?></label>
					<a href="home.php?sair=true" class="sair btn btn-danger">Sair</a>
				</div>
			</nav>
		</div>
	</header>

	<div class="conteudo">
		<br>
		<div class="form card" style="width: 500px;">
			<div class="card-header bg-dark text-white">
				<h3>Informe os dados</h3>
			</div>
			<br>
			<form style="color:black;" class="form-horizontal text-start m-3 formulario" action="insertDB.php" method="post" enctype="multipart/form-data">

				<p><b><?php if(isset($_SESSION['Erro'])){echo $_SESSION['Erro'];}?></b></p>
				<div class="control-group">
					<label class="form-label"><b>UID</label>
					<div class="controls">
						<textarea class="form-control" name="id" id="getUID" placeholder="Escaneie seu cartão para adquirir o código" rows="1" cols="1" required></textarea>
					</div>
				</div>

				<label class="form-label mt-3" for="foto">Foto</label>
				<div class="input-group mb-3">
					<input type="file" class="form-control" id="foto" name="foto" required>
					<label class="input-group-text" for="inputGroupFile02">Upload</label>
				</div>

				<div class="imageContainer">
					<img src="img/user.png" alt="userPhoto" class="userPhoto" id="imgUser">
				</div>

				<div class="control-group">
					<label class="form-label">Nome</label>
					<div class="controls">
						<input class="form-control" id="div_refresh" name="name" type="text" placeholder="" required>
					</div>
				</div>
				
				<div class="control-group">
					<label class="form-label">Empresa</label>
					<div class="controls">
						<select class="form-select" name="empresa" id="select">

						</select>
					</div>
				</div>

				<div class="control-group">
					<label class="form-label">Genero</label>
					<div class="controls">
						<select class="form-select" name="gender">
							<option value="Masculino">Masculino</option>
							<option value="Feminino">Feminino</option>
						</select>
					</div>
				</div>

				<div class="control-group">
					<label class="form-label">Endereço de Email</label>
					<div class="controls">
						<input class="form-control" name="email" type="text" placeholder="" required>
					</div>
				</div>

				<div class="control-group">
					<label class="form-label">RG</label>
					<div class="controls">
						<input class="form-control" name="rg" type="text" placeholder="" required>
					</div>
				</div>

				<div class="control-group">
					<label class="form-label">CPF</label>
					<div class="controls">
						<input class="form-control" name="cpf" type="text" placeholder="" required>
					</div>
				</div>

				<div class="control-group">
					<label class="form-label">CNH</label>
					<div class="controls">
						<input class="form-control" name="cnh" type="text" placeholder="" required>
					</div>
				</div>

				<div class="form-actions text-center">
					<button type="submit" class="btn btn-success mt-3 mb-3">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</body>
<script>
	let img = document.getElementById('imgUser')
	let foto = document.getElementById('foto')
	foto.addEventListener('change', (event) => {
		let reader = new FileReader()
		reader.onload = () => {
			img.src = reader.result
			console.log(img.src)
		}

		reader.readAsDataURL(foto.files[0])
	})
</script>
<?php
require 'database.php';


$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT nome FROM empresa";
foreach ($pdo->query($sql) as $empresas) {

	echo "<script>
			var select = document.getElementById('select');
		
			var option = document.createElement('option');
			option.text = '{$empresas[0]}';
			option.value = '{$empresas[0]}';
		
			select.add(option);
			</script>";
}
Database::disconnect();

?>

</html>