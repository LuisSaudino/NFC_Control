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
$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);
?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css_site/read tag.css">
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
	<title>NFC_Control Ler Cartão</title>
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
						<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Registrar</a>
						<ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="registration user.php">Usuario</a></li>
							<li><a class="dropdown-item" href="registration.php">Funcionario</a></li>
							<li><a class="dropdown-item" href="registration entp.php">Empresa</a></li>
						</ul>
					</li>

					<li class="nav-item"><a id="active" class="active nav-link" href="read tag.php">Pesquisar</a></li>
				</ul>
				<div class="navbar-nav login">
					<label><?php echo $_SESSION['nameUser']; ?></label>
					<a href="home.php?sair=true" class="sair btn btn-danger">Sair</a>
				</div>
			</nav>
		</div>
	</header>

	<div class="conteudo">

		<h3 align="center" id="blink"><b>POR FAVOR ESCANEAR SEU CARTÃO NO SENSOR.</b></h3>
	
		<p id="getUID" hidden></p>
	
		<br>
	
		<div id="show_user_data">
			<form>
				<table class="table table-striped table-bordered tabela">
					<tr class="table-dark">
						<td height="40" align="center" bgcolor="#ff4242">
							<font color="#FFFFFF">
								<b>Dados do Usuário</b>
							</font>
						</td>
					</tr>
					<tr class="table-light">
						<td bgcolor="#ACBEA3">
							<font color="#000000">
								<table width="452" border="0" align="center" cellpadding="5" cellspacing="0">
									<tr>
										<td width="113" align="left" class="lf">UID</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr bgcolor="#f2f2f2">
										<td align="left" class="lf">Nome</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr>
										<td align="left" class="lf">Empresa</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr>
										<td align="left" class="lf">Gênero</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr bgcolor="#f2f2f2">
										<td align="left" class="lf">Email</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr>
										<td align="left" class="lf">RG</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr>
										<td align="left" class="lf">CPF</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr>
										<td align="left" class="lf">CNH</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr>
										<td align="left" class="lf">Ultima Leitura</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
								</table>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

	<script>
		var myVar = setInterval(myTimer, 1000);
		var myVar1 = setInterval(myTimer1, 1000);
		var oldID = "";
		clearInterval(myVar1);

		function myTimer() {
			var getID = document.getElementById("getUID").innerHTML;
			oldID = getID;
			if (getID != "") {
				myVar1 = setInterval(myTimer1, 500);
				showUser(getID);
				clearInterval(myVar);
			}
		}

		function myTimer1() {
			var getID = document.getElementById("getUID").innerHTML;
			if (oldID != getID) {
				myVar = setInterval(myTimer, 500);
				clearInterval(myVar1);
			}
		}

		function showUser(str) {
			if (str == "") {
				document.getElementById("show_user_data").innerHTML = "";
				return;
			} else {
				if (window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();
				} else {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("show_user_data").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "read tag user data.php?id=" + str, true);
				xmlhttp.send();
			}
		}

		var blink = document.getElementById('blink');
		setInterval(function() {
			blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
		}, 750);
	</script>
</body>

</html>