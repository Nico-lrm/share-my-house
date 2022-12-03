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
    //Récupérer les informations
    $id_user = intval($_POST['id_user']);
    $id_conv = intval($_POST['id_conv']);
    $content = $_POST['content'];
    $date = new DateTime();

    $db = dbConnect();
    
    $message = $db->prepare('INSERT INTO messagerie(content, id_conversation, id_user, date_message) VALUES (:content, :id_conv, :id_user, :today)');
    $message->bindParam(':content', $content);
    $message->bindParam(':id_conv', $id_conv);
    $message->bindParam(':id_user', $id_user);
    $message->bindParam(':today', $date->format("Y-m-d H:i:s"));
    $message->execute();
?>