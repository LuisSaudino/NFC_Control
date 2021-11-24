<?php
    require 'database.php';

    $pdo = Database::connect();
    //Atualiza a hora dos registros no BD
    if (isset($_GET['atualizar'])) {
        $sql = "UPDATE usuarios SET Leitura = NOW() WHERE ID = {$_GET['atualizar']}";
        $q = $pdo->prepare($sql);
        $q = $pdo->exec($sql);
        header("Location: read tag.php");
    }
?>