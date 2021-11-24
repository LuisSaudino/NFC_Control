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
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('UIDContainer.php',$Write);
?>

<!DOCTYPE html>
<html lang="pt">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css_site/registration_user.css">
		<script src="js/bootstrap.min.js"></script>
		<script src="jquery.min.js"></script>
		
		<title>NFC_Control Registro</title>
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
			<form class="form-horizontal" action="insertUser.php" method="post">
				<fieldset>
					<div class="card">
						<div class="card-header bg-dark text-white"><h5>Cadastrar Empresa</h5></div>
						<div class="panel-body m-3">
							<div class="form-group text-start">
								<label for="Usuario" class="control-label"><b>Nome</label>
								<input class="form-control" type="text" name="nome" id="">
							</div>
							<div class="form-group text-start">
								<label for="Usuario" class="control-label">CNPJ</label>
								<input class="form-control" type="text" name="cnpj" id="">
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-success mt-3 mb-3">Salvar</button>
                    		</div>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</body>
</html>