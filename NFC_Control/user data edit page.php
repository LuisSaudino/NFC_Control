<?php
session_start();
if (!isset($_SESSION['idUser'])) {
	header("Location: login.php");
}
require 'database.php';
$id = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM usuarios where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();

if (isset($_GET['foto'])) {
	echo "<script>alert('{$_GET['foto']}')</script>";
}
?>

<!DOCTYPE html>
<html lang="pt">
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>

	<style>
		html::-webkit-scrollbar {
			width: 12px;
			border: 2px solid #212429;
			border-radius: 10px;
			background-color: lightgray;
		}

		html::-webkit-scrollbar-thumb {
			background-color: #212429;
			border-radius: 10px;
		}
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
			text-align: center;
		}

		textarea {
			resize: none;
		}

		body {
			background-color: #6b6b6a;
			color: #E3D3E4;
		}

		.redondo {
			background-color: #000;
			color: #FFF;
			border-radius: 30%;
			margin-bottom: 20px;
		}

		.imageContainer {
			display: flex;
			border: 5px solid #ccc;
			background-color: #eee;
			justify-content: center;
			width: 70%;
		}

		.userPhoto {
			width: 50%;
			height: 50%;
		}
	</style>

	<title>NFC_Control Editar</title>

</head>

<body>
	<br />
	<img src="img/logoNFC_Control.jpg" alt="" class="redondo" style="width:10%; ">
	<div class="container">

		<div class="center container" style="color:black; background-color:#ACBEA3; border-radius:10px; overflow: hidden; margin: 0 auto; width:495px; border-style: solid; border-color: #f2f2f2;">
			<div style="color: white; width:520px; background-color:#212429; margin-bottom: 5px;" class="row">
				<h3 align="center">Alterar Dados</h3>
				<p id="defaultGender" hidden><?php echo $data['Genero']; ?></p>
			</div>

			<form class="form-horizontal" action="user data edit tb.php ?>" method="post" enctype="multipart/form-data">
				<p><b><?php if (isset($_SESSION['Erro'])) {
							echo $_SESSION['Erro'];
						} ?></b></p>
				<div class="control-group">
					<label class="form-label">UID</label>
					<div class="controls">
						<input class="form-control" name="id" type="text" placeholder="" value="<?php echo $data['ID']; ?>" readonly>
					</div>
				</div>

				<label class="form-label mt-3" for="foto">Foto</label>
				<div class="input-group mb-3">
					<input type="file" class="form-control" id="foto" name="foto" src="img_users/<?php echo $data['Foto']; ?>">
					<label class="input-group-text" for="inputGroupFile02">Upload</label>
				</div>

				<div class="imageContainer">
					<img src="img_users/<?php echo $data['Foto']; ?>" alt="userPhoto" class="userPhoto" id="imgUser">
				</div>

				<div class="control-group">
					<label class="form-label">Nome</label>
					<div class="controls">
						<input class="form-control" name="name" type="text" placeholder="" value="<?php echo $data['Nome']; ?>" required>
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
						<select class="form-select" name="gender" id="mySelect">
							<option value="Masculino">Masculino</option>
							<option value="Feminino">Feminino</option>
						</select>
					</div>
				</div>

				<div class="control-group">
					<label class="form-label">Endereço de Email</label>
					<div class="controls">
						<input class="form-control" name="email" type="text" placeholder="" value="<?php echo $data['Email']; ?>" required>
					</div>
				</div>

				<div class="control-group">
					<label class="form-label">RG</label>
					<div class="controls">
						<input class="form-control" name="rg" type="text" placeholder="" value="<?php echo $data['RG']; ?>" required>
					</div>
				</div>

				<div class="control-group">
					<label class="form-label">CPF</label>
					<div class="controls">
						<input class="form-control" name="cpf" type="text" placeholder="" value="<?php echo $data['CPF']; ?>" required>
					</div>
				</div>

				<div class="control-group">
					<label class="form-label">CNH</label>
					<div class="controls">
						<input class="form-control" name="cnh" type="text" placeholder="" value="<?php echo $data['CNH']; ?>" required>
					</div>
				</div>

				<div style="background-color:#ACBEA3;" class="form-actions mt-3 mb-3">
					<button type="submit" class="btn btn-success">Atualizar</button>
					<a class="btn btn-secondary" href="user data.php">Voltar</a>
				</div>
			</form>
		</div>
	</div>

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

		var g = document.getElementById("defaultGender").innerHTML;
		if (g == "Male") {
			document.getElementById("mySelect").selectedIndex = "0";
		} else {
			document.getElementById("mySelect").selectedIndex = "1";
		}
	</script>
</body>
<?php
$pdoc = Database::connect();
$pdoc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = "SELECT empresa.nome FROM unip.empresa";
foreach ($pdoc->query($query) as $empresas) {

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