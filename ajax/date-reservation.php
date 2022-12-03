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
    
    $db = dbConnect();
    $dates = $db->prepare('SELECT * FROM reservation WHERE id_logement = '.$id);
    $dates->execute();
    $dates = $dates->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($dates);
?>