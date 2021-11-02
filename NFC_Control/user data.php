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
		<style>
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
			text-align: center;
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
		
		.table {
			margin: auto;
			width: 90%;
			background-color: #ACBEA3;
			color: #423E3B;
		}
		
		thead {
			color: #FFFFFF;
			background-color: #FF4242;
		}
		.redondo{
        background-color: #000;
        color: #FFF;
        border-radius: 30%;
        margin-bottom: 20px;
        }
		</style>
		
		<title>NFC_Control Dados dos Usuarios</title>
	</head>
	
	<body>
		<br/>
    	<img src="img/logoNFC_Control.jpg" alt="" class="redondo" style="width:10%; ">    
        <br/>
		<ul class="topnav">
			<li><a href="home.php">Página Inicial</a></li>
			<li><a class="active" href="user data.php">Usuários</a></li>
			<li><a href="registration.php">Registrar</a></li>
			<li><a href="read tag.php">Pesquisar</a></li>
		</ul>
		<br>
		<div class="container">
            <div class="row">
                <h3>Usuários Cadastrados</h3>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr bgcolor="#ff4242" color="#FFFFFF">
                      <th>ID</th>
                      <th>Nome</th>
					  <th>Genero</th>
					  <th>Email</th>
                      <th>RA</th>
					  <th>------</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM usuarios';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['ID'] . '</td>';
                            echo '<td>'. $row['Nome'] . '</td>';
                            echo '<td>'. $row['Genero'] . '</td>';
							echo '<td>'. $row['Email'] . '</td>';
							echo '<td>'. $row['RA'] . '</td>';
							echo '<td><a class="btn btn-success" href="user data edit page.php?id='.$row['ID'].'">Editar</a>';
							echo ' ';
							echo '<a class="btn btn-danger" href="user data delete page.php?id='.$row['ID'].'">Deletar</a>';
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