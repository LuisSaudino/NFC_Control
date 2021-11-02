<?php
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        
        $id = $_POST['id'];
         
        
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM usuarios  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $sql = "DELETE FROM cartao  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: user data.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <title>NFC_Control Deletar</title>
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
        .form-actions {
            background-color: #423E3B;
        }
        
        .form-actions button {
            margin-left: 135px;
            float: left;
        }
        .form-actions a{
            float: left;
            margin-left: 15px;
        }
        .redondo{
        background-color: #000;
        color: #FFF;
        border-radius: 30%;
        margin-bottom: 20px;
        }
    </style>
</head>
 
<body>
    <br/>
    <img src="img/logoNFC_Control.jpg" alt="" class="redondo" style="width:10%; ">
    <div class="container">
     
        <div class="span10 offset1 form">
            <div class="row">
                <h3 align="center">Deletar Usuário</h3>
            </div>

            <form class="form-horizontal" action="user data delete page.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>"/>
                <p class="alert alert-error">Tem certeza de que deseja excluir este usuário ?</p>
                <div class="form-actions">
                    <button type="submit" class="btn btn-danger">Sim</button>
                    <a class="btn" href="user data.php">Não</a>
                </div>
            </form>
        </div>
                 
    </div> 
  </body>
</html>