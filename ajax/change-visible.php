<?php
    // Connexion à la base de données
    function dbConnect() {
        $srv = "localhost";
        $dbname = "house";
        $user = 'upjv';
        $password = 'upjv2021';
        $db = new PDO('mysql:host='.$srv.';dbname='.$dbname.';charset=utf8', $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
    $id = $_POST['id'];
    $visible = $_POST['statut'];
    
    $db = dbConnect();
    $changeVisible = $db->prepare('UPDATE logement SET visible = :visible WHERE id_logement = :id');
    $changeVisible->bindParam(':visible', $visible);
    $changeVisible->bindParam(':id', $id);
    $changeVisible->execute();
?>