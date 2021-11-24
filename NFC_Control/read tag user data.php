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
require 'database.php';
$id = null;
if (!empty($_GET['id'])) {
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
if (@is_null($data['ID'])) {
    $msg = "O ID deste cartão não esta registrado!!!";
    $data['ID'] = $id;
    $data['Nome'] = "--------";
    $data['Genero'] = "--------";
    $data['Email'] = "--------";
    $data['RG'] = "--------";
    $data['CPF'] = "--------";
    $data['CNH'] = "--------";
    $data['Leitura'] = "--------";
} else {
    $msg = null;
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css_site/read tag.css">
    <script src="js/bootstrap.min.js"></script>
    <style>
        html::-webkit-scrollbar {
            width: 12px;
            border: 2px solid #212429;
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

        td.lf {
            padding-left: 15px;
            padding-top: 12px;
            padding-bottom: 12px;
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

        .form {
            color: black;
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

        .tabela {
            display: block;
            margin-top: 20%;
        }
    </style>
</head>

<body>
    <div>
        <br />
        <form>
            <table class="table table-striped table-bordered tabela">
                <tr class="table-dark">
                    <td height="40" align="center" bgcolor="#ff4242">
                        <font color="#FFFFFF">
                            <b>Dados do Usuário</b>
                        </font>
                    </td>
                </tr>
                <tr class="table-light form">
                    <td bgcolor="#ACBEA3">
                        <table width="452" border="0" align="center" cellpadding="5" cellspacing="0">
                            <tr>
                                <td width="113" align="left" class="lf">UID</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['ID']; ?></td>
                            </tr>
                            <tr bgcolor="#f2f2f2">
                                <td align="left" class="lf">Foto</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left">
                                    <div class="imageContainer">
                                        <img src="img_users/<?php echo $data['Foto']; ?>" alt="userPhoto" class="userPhoto" id="imgUser">
                                    </div>
                                </td>
                            </tr>
                            <tr bgcolor="#f2f2f2">
                                <td align="left" class="lf">Nome</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['Nome']; ?></td>
                            </tr>
                            <tr>
                                <td align="left" class="lf">Empresa</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['Empresa']; ?></td>
                            </tr>
                            <tr>
                                <td align="left" class="lf">Genero</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['Genero']; ?></td>
                            </tr>
                            <tr bgcolor="#f2f2f2">
                                <td align="left" class="lf">Email</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['Email']; ?></td>
                            </tr>
                            <tr>
                                <td align="left" class="lf">RG</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['RG']; ?></td>
                            </tr>
                            <tr>
                                <td align="left" class="lf">CPF</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['CPF']; ?></td>
                            </tr>
                            <tr>
                                <td align="left" class="lf">CNH</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['CNH']; ?></td>
                            </tr>
                            <tr>
                                <td align="left" class="lf">Ultima Leitura</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['Leitura']; ?></td>
                            </tr>
                            <tr>
                                <td><a class="btn btn-success" href="user data edit page.php?id=<?php echo $data['ID'] ?>">Editar</a></td>
                                <td><a class="btn btn-danger" href="user data delete page.php?id=<?php echo $data['ID'] ?>">Deletar</a></td>
                                <td><a class="btn btn-primary" href="update.php?atualizar=<?php echo $data['ID'] ?>">Atualizar Leitura</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <p style="color:red;"><?php echo $msg; ?></p>
</body>

</html>