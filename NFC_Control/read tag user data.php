<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM usuarios where ID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    
    $msg = null;
    if (@is_null ($data['ID'])) {
        $msg = "O ID deste cartão não esta registrado!!!";
        $data['ID']=$id;
        $data['Nome']="--------";
        $data['Genero']="--------";
        $data['Email']="--------";
        $data['RA']="--------";
    } else {
        $msg = null;
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <style>
        html {
            font-family: Arial;
            display: inline-block;
            margin: 0px auto;
            text-align: center;
        }
        td.lf {
            padding-left: 15px;
            padding-top: 12px;
            padding-bottom: 12px;
        }
        body{
            background-color: #423E3B;
            color: #E3D3E4;
        }
        .redondo{
        background-color: #000;
        color: #FFF;
        border-radius: 30%;
        margin-bottom: 20px;
        }
		.form{
			color: black;
		}
    </style>
</head>
 
    <body>    
        <div>
            <br/>    
            <form>
                <table  width="452" border="1" bordercolor="#10a0c5" align="center"  cellpadding="0" cellspacing="1"  bgcolor="#000" style="padding: 2px">
                    <tr>
                        <td  height="40" align="center"  bgcolor="#ff4242"><font  color="#FFFFFF">
                        <b>Dados do Usuário</b></font></td>
                    </tr>
                    <tr class="form">
                        <td bgcolor="#ACBEA3" >
                            <table width="452"  border="0" align="center" cellpadding="5"  cellspacing="0">
                                <tr>
                                    <td width="113" align="left" class="lf">UID</td>
                                    <td style="font-weight:bold">:</td>
                                    <td align="left"><?php echo $data['ID'];?></td>
                                </tr>
                                <tr bgcolor="#f2f2f2">
                                    <td align="left" class="lf">Nome</td>
                                    <td style="font-weight:bold">:</td>
                                    <td align="left"><?php echo $data['Nome'];?></td>
                                </tr>
                                <tr>
                                    <td align="left" class="lf">Genero</td>
                                    <td style="font-weight:bold">:</td>
                                    <td align="left"><?php echo $data['Genero'];?></td>
                                </tr>
                                <tr bgcolor="#f2f2f2">
                                    <td align="left" class="lf">Email</td>
                                    <td style="font-weight:bold">:</td>
                                    <td align="left"><?php echo $data['Email'];?></td>
                                </tr>
                                <tr>
                                    <td align="left" class="lf">RA</td>
                                    <td style="font-weight:bold">:</td>
                                    <td align="left"><?php echo $data['RA'];?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <p style="color:red;"><?php echo $msg;?></p>
    </body>
</html>