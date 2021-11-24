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

if (isset($_GET['erro'])) {
    echo "<script>alert('Erro ao editar o usuario')</script>";
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
	<link rel="stylesheet" href="css_site/user data.css">
	<script src="js/bootstrap.min.js"></script>
	<title>NFC_Control Dados dos Funcionarios</title>
</head>

<body>
	<header>
		<div class="container" id="nav-container">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
				<ul class="navbar-nav">
					<a href="#" class="navbar-brand">
						<img src="img/logoNFC_Control.jpg" alt="NFC_Control" class="logo">
					</a>
					<li class="nav-item"><a class="nav-link" href="home.php">Página Inicial</a></li>
					<li class="nav-item"><a id="active" class="active nav-link" href="user data.php">Funcionarios</a></li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Registrar</a>
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
		<div class="row">
			<h3><b>Funcionarios Cadastrados</b></h3>
		</div>
		<div class="row">
			<table  class="table table-striped table-bordered table-hover table-fixed">
				<thead class="table-dark">
					<tr>
						<th>ID</th>
						<th>Foto</th>
						<th>Nome</th>
						<th>Empresa</th>
						<th>Genero</th>
						<th>Email</th>
						<th>RG</th>
						<th>CPF</th>
						<th>CNH</th>
						<th>Ultima Leitura</th>
						<th>------</th>
					</tr>
				</thead>
				<tbody class="table-light">
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = 'SELECT * FROM usuarios ORDER BY Nome';
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>' . $row['ID'] . '</td>';
						echo '<td>' . 
										'<img height="70" width="70" alt="userPhoto" class="userPhoto" id="imgUser" src="img_users/'.$row['Foto'].'">'.
							'</td>';
						echo '<td>' . $row['Nome'] . '</td>';
						echo '<td>' . $row['Empresa'] . '</td>';
						echo '<td>' . $row['Genero'] . '</td>';
						echo '<td>' . $row['Email'] . '</td>';
						echo '<td>' . $row['RG'] . '</td>';
						echo '<td>' . $row['CPF'] . '</td>';
						echo '<td>' . $row['CNH'] . '</td>';
						echo '<td>' . $row['Leitura'] . '</td>';
						echo '<td><a class="btn btn-success" href="user data edit page.php?id=' . $row['ID'] . '">Editar</a>';
						echo ' ';
						echo '<a class="btn btn-danger" href="user data delete page.php?id=' . $row['ID'] . '">Deletar</a>';
						echo '</td>';
						echo '</tr>';
					}
					Database::disconnect();
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>

</html>