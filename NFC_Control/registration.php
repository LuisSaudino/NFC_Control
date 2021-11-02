<?php
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('UIDContainer.php',$Write);
?>

<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<script src="jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				 $("#getUID").load("UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("UIDContainer.php");
				}, 500);
			});
		</script>
		
		<style>
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
			text-align: center;
		}
		
		textarea {
			resize: none;
		}

		body{
			background-color: #423E3B;
			color: #E3D3E4;
		}

		ul.topnav {
            list-style-type: none;
            margin: auto;
            padding: 0;
            overflow: hidden;
            background-color: #FF4242;
            width: 40%;
            border-radius: 10px;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        ul.topnav li {
            float: left;
            width: 100%;
        }

		ul.topnav li a {
			display: block;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		ul.topnav li a:hover:not(.active) {background-color: #FF5C7A;}

		ul.topnav li a.active {background-color: #8F0000;}

		ul.topnav li.right {float: right;}

		@media screen and (max-width: 600px) {
			ul.topnav li.right, 
			ul.topnav li {float: none;}
		}

		.redondo{
        background-color: #000;
        color: #FFF;
        border-radius: 30%;
        margin-bottom: 20px;
		
        }
		</style>
		
		<title>NFC_Control Registro</title>
	</head>
	
	<body>

		<br/>
   		<img src="img/logoNFC_Control.jpg" alt="" class="redondo" style="width:10%; ">	
		<ul class="topnav">
			<li><a href="home.php">Página Inicial</a></li>
			<li><a href="user data.php">Usuários</a></li>
			<li><a class="active" href="registration.php">Registrar</a></li>
			<li><a href="read tag.php">Pesquisar</a></li>
		</ul>

		<div class="container">
			<br>
			<div class="center" style="overflow: hidden; border-radius: 10px; background-color:#ACBEA3; margin: 0 auto; width:495px; border-style: solid; border-color: #f2f2f2; color:white;">
				<div style= "width: 520px; background-color:#ff4242" class="row">
					<h3 align="center">Informe os dados</h3>
				</div>
				<br>
				<form style = "color:black;"class="form-horizontal" action="insertDB.php" method="post" >
					<div class="control-group">
						<label class="control-label">UID</label>
						<div class="controls">
							<textarea name="id" id="getUID" placeholder="Escaneie seu cartão para adquirir o código" rows="1" cols="1" required></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Nome</label>
						<div class="controls">
							<input id="div_refresh" name="name" type="text"  placeholder="" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Genero</label>
						<div class="controls">
							<select name="gender">
								<option value="Masculino">Masculino</option>
								<option value="Feminino">Feminino</option>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Endereço de Email</label>
						<div class="controls">
							<input name="email" type="text" placeholder="" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">RA</label>
						<div class="controls">
							<input name="mobile" type="text"  placeholder="" required>
						</div>
					</div>
					
					<div style="background-color:#ACBEA3;" align="left" class="form-actions">
						<button type="submit" class="btn btn-success">Salvar</button>
                    </div>
				</form>
			</div>               
		</div>
	</body>
</html>