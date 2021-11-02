<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM usuarios where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
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
			background-color: #4CAF50;
			width: 70%;
		}

		ul.topnav li {float: left;}

		ul.topnav li a {
			display: block;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		ul.topnav li a:hover:not(.active) {background-color: #3e8e41;}

		ul.topnav li a.active {background-color: #333;}

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
		
		<title>NFC_Control Editar</title>
		
	</head>
	
	<body>
		<br/>
        <img src="img/logoNFC_Control.jpg" alt="" class="redondo" style="width:10%; ">
		<div class="container">
     
			<div class="center" style="color:black; background-color:#ACBEA3; border-radius:10px; overflow: hidden; margin: 0 auto; width:495px; border-style: solid; border-color: #f2f2f2;">
				<div style="color: white; width:520px; background-color:#ff4242; margin-bottom: 5px;" class="row">
					<h3 align="center">Alterar Dados</h3>
					<p id="defaultGender" hidden><?php echo $data['Genero'];?></p>
				</div>
		 
				<form class="form-horizontal" action="user data edit tb.php?id=<?php echo $id?>" method="post">
					<div class="control-group">
						<label class="control-label">UID</label>
						<div class="controls">
							<input name="id" type="text"  placeholder="" value="<?php echo $data['ID'];?>" readonly>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Nome</label>
						<div class="controls">
							<input name="name" type="text"  placeholder="" value="<?php echo $data['Nome'];?>" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Genero</label>
						<div class="controls">
							<select name="gender" id="mySelect">
								<option value="Masculino">Masculino</option>
								<option value="Feminino">Feminino</option>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Endereço de Email</label>
						<div class="controls">
							<input name="email" type="text" placeholder="" value="<?php echo $data['Email'];?>" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">RA</label>
						<div class="controls">
							<input name="mobile" type="text"  placeholder="" value="<?php echo $data['RA'];?>" required>
						</div>
					</div>
					
					<div style="background-color:#ACBEA3;" class="form-actions">
						<button type="submit" class="btn btn-success">Atualizar</button>
						<a class="btn" href="user data.php">Voltar</a>
					</div>
				</form>
			</div>               
		</div> 	
		
		<script>
			var g = document.getElementById("defaultGender").innerHTML;
			if(g=="Male") {
				document.getElementById("mySelect").selectedIndex = "0";
			} else {
				document.getElementById("mySelect").selectedIndex = "1";
			}
		</script>
	</body>
</html>