<?php

    /**
     * Tout ce qui est interaction avec la base de donnée se passe dans le model
     * La il s'agit des insertions & autre, donc pour ce qui est traitement et pas récupération
     * 
     * Pour la récupération de données de la bdd vers l'affichage, créer le fichier 'frontend.php' dans le dossier 
     * model/ 
    */

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

    /**
     * Insérer un utilisateur dans la base de données
    */
    function createUser($firstname, $name, $birthday, $email, $password, $pays, $ville) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $db = dbConnect();
        $users = $db->prepare('INSERT INTO user(firstname, name, birthday, email, password, role, pays, ville) VALUES(:firstname, :name, :birthday, :email, :password, "user", :pays, :ville)');
        $users->bindParam(':firstname', $firstname);
        $users->bindParam(':name', $name);
        $users->bindParam(':birthday', $birthday);
        $users->bindParam(':email', $email);
        $users->bindParam(':password', $password);
        $users->bindParam(':pays', $pays);
        $users->bindParam(':ville', $ville);
        $users->execute();

        $id = $db->lastInsertId();

        return $id;
    }

    /**
     * Changer la photo de l'utilisateur courant 
    */
    function changeUserPhoto($photo, $userid) {
        $db = dbConnect();
        $modif = $db->prepare('UPDATE user SET photo = :photo WHERE id_user = :iduser');
        $modif->bindParam(':photo', $photo);
        $modif->bindParam(':iduser', $userid);
        $modif->execute();
    }

    /**
     * Insérer une location dans la base de données
    */
    function insertNewLocation($cp, $ville, $pays, $nblits, $nbsdb, $type, $desc, $prix, $piscine, $wifi, $superficie, $titre) {
        $db = dbConnect();
        $location = $db->prepare('INSERT INTO logement(code_postal, ville, pays, nb_lit, nb_sdb, prix_nuit, haveWifi, havePiscine, type_id, id_user, desc_log, superficie, visible, title) VALUES(:code_postal, :ville, :pays, :nb_lit, :nb_sdb, :prix_nuit, :wifi, :piscine, :type_id, :id_user, :desc_log, :superficie, "1", :titre)');
        $location->bindParam(':code_postal', $cp);
        $location->bindParam(':ville', $ville);
        $location->bindParam(':pays', $pays);
        $location->bindParam(':nb_lit', $nblits);
        $location->bindParam(':nb_sdb', $nbsdb);
        $location->bindParam(':prix_nuit', $prix);
        $location->bindParam(':wifi', $wifi);
        $location->bindParam(':piscine', $piscine);
        $location->bindParam(':type_id', $type);
        $location->bindParam(':id_user', $_SESSION['id']);
        $location->bindParam(':desc_log', $desc);
        $location->bindParam(':superficie', $superficie);
        $location->bindParam(':titre', $titre);
        $location->execute();

        //On récupère l'ID du dernier élément inséré
        $id = $db->lastInsertId();

        //On le renvoie (pour gérer les photos)
        return $id;
    }

    /**
     * Insérer une nouvelle photo dans la base de donnée 
    */
    function insertNewLocationPhoto($id_logement, $photo) {
        $db = dbConnect();
        $loc_photo = $db->prepare('INSERT INTO photo_logement(nom_photo, id_logement) VALUES (:nom, :id_log)');
        $loc_photo->bindParam(':nom', $photo);
        $loc_photo->bindParam(':id_log', $id_logement);
        $loc_photo->execute();
    }

    /**
     * Supprimer une location 
    */
    function deleteLocation($id_logement) {
        $db = dbConnect();
        $deleteLocation = $db->prepare('DELETE FROM logement WHERE id_logement = :id');
        $deleteLocation->bindParam(':id', $id_logement);
        $deleteLocation->execute();
    }

    /**
     * Supprimer les photos d'une location 
    */
    function deleteLocationPhoto($id_logement) {
        $db = dbConnect();
        $deleteLocationPhoto = $db->prepare('DELETE FROM photo_logement WHERE id_logement = :id');
        $deleteLocationPhoto->bindParam(':id', $id_logement);
        $deleteLocationPhoto->execute();
    }

    /**
     * Vérifiez si une adresse e-mail est déjà prise -> Eviter les doublons 
    */
    function noTwinEmail($email) {
        $db = dbConnect();
        $users = $db->prepare('SELECT EXISTS(SELECT email FROM user WHERE email = :email) AS email');
        $users->bindParam(':email', $email);
        $users->execute();
        $user = $users->fetchAll(PDO::FETCH_ASSOC);
        return $user[0];
    }

    /**
     * Vérifiez qu'un utilisateur existe bien pour se connecter
    */
    function connectUser($email) {
        $db = dbConnect();
        $users = $db->prepare('SELECT * FROM user WHERE email = :email');
        $users->bindParam(':email', $email);
        $users->execute();
        $user = $users->fetchAll(PDO::FETCH_ASSOC);
        return $user[0];
    }

    /**
     * Insérer un commentaire + note sur un utilisateur 
    */
    function insertNote($note, $text, $id_note, $id_noteur) {
        $db = dbConnect();
        $insertNote = $db->prepare('INSERT INTO note(valeur, commentaire, id_user_note, id_user_noteur) VALUES (:valeur, :commentaire, :id_user_note, :id_user_noteur)');
        $insertNote->bindParam(':valeur', $note);
        $insertNote->bindParam(':commentaire', $text);
        $insertNote->bindParam(':id_user_note', $id_note);
        $insertNote->bindParam(':id_user_noteur', $id_noteur);
        $insertNote->execute();
    }    

    /**
     * Insérer un commentaire + note sur une location
    */
    function insertNoteLogement($note, $text, $id_user, $id_logement) {
        $db = dbConnect();
        $insertNote = $db->prepare('INSERT INTO note_logement(valeur, commentaire, id_user, id_logement) VALUES (:valeur, :commentaire, :id_user, :id_logement)');
        $insertNote->bindParam(':valeur', $note);
        $insertNote->bindParam(':commentaire', $text);
        $insertNote->bindParam(':id_user', $id_user);
        $insertNote->bindParam(':id_logement', $id_logement);
        $insertNote->execute();
    }

    /**
     * Mettre à jour son profil
    */
    function updateProfil($query) {
        $db = dbConnect();
        $updateProfil = $db->prepare($query);
        $updateProfil->execute();
    }

    /**
     *  Ajouter une réservation sur un logement 
    */
    function insertReservation($id_log, $id_user, $date_debut, $date_fin) {
        $db = dbConnect();
        $insertReservation = $db->prepare('INSERT INTO reservation(id_logement, id_user_reserv, date_debut, date_fin) VALUES (:id_logement, :id_user_reserv, :date_debut, :date_fin)');
        $insertReservation->bindParam(':id_logement', $id_log);
        $insertReservation->bindParam(':id_user_reserv', $id_user);
        $insertReservation->bindParam(':date_debut', $date_debut);
        $insertReservation->bindParam(':date_fin', $date_fin);
        $insertReservation->execute();
    }

    function deleteReservation($id_reservation) {
        $db = dbConnect();
        $deleteReservation = $db->prepare('DELETE FROM reservation WHERE id_reservation = :id');
        $deleteReservation->bindParam(':id', $id_reservation);
        $deleteReservation->execute();
    }

    /**
     * Insérer une nouvelle conversion entre deux utilisateur 
    */
    function insertConversation($id_1, $id_2) {
        $db = dbConnect();
        $conversation = $db->prepare('INSERT INTO conversation(id_user_1, id_user_2) VALUES (:id_user_1, :id_user_2)');
        $conversation->bindParam(':id_user_1', $id_1);
        $conversation->bindParam(':id_user_2', $id_2);
        $conversation->execute();

        //On récupère l'ID du dernier élément inséré
        $id = $db->lastInsertId();

        //On le renvoie (pour gérer les photos)
        return $id;
    }
?>