<?php
    /**
     * Sélectionner les locations émise par un utilisateur 
    */
    function selectLocationsRental($order, $id, $requete) {
        $db = dbConnect();
        $locations = $db->prepare('SELECT logement.* FROM logement WHERE logement.id_user = :id'.$requete.'ORDER BY logement.id_logement');
        $locations->bindParam(':id', $id);
        $locations->execute();
        $locations = $locations->fetchAll(PDO::FETCH_ASSOC);
        return $locations;
    }

    /**
     * Sélectionner les réservations d'un utilisateur 
    */
    function selectLocationsBooked($order, $id) {
        $db = dbConnect();
        $locations = $db->prepare('SELECT DISTINCT logement.*, reservation.id_reservation, reservation.date_debut, reservation.date_fin FROM logement, reservation WHERE logement.id_logement IN (SELECT id_logement FROM reservation WHERE id_user_reserv = :id) AND logement.id_logement = reservation.id_logement ORDER BY reservation.date_debut');
        $locations->bindParam(':id', $id);
        $locations->execute();
        $locations = $locations->fetchAll(PDO::FETCH_ASSOC);
        return $locations;
    }

    /**
     * Récupérer les informations d'un logement, hormis les photos 
    */
    function selectLocationUnique($id) {
        $db = dbConnect();
        $location = $db->prepare('SELECT logement.* FROM logement WHERE logement.id_logement = :id ORDER BY logement.id_logement DESC;');
        $location->bindParam(':id', $id);
        $location->execute();
        $location = $location->fetchAll(PDO::FETCH_ASSOC);
        return $location[0];
    }

    /**
     * Récupérer toutes les photos associées à un logement 
    */
    function selectLocationUniquePhoto($id) {
        $db = dbConnect();
        $photos = $db->prepare('SELECT photo_logement.* FROM photo_logement INNER JOIN logement ON photo_logement.id_logement = logement.id_logement WHERE photo_logement.id_logement = :id ORDER BY logement.id_logement DESC;');
        $photos->bindParam(':id', $id);
        $photos->execute();
        $photos = $photos->fetchAll(PDO::FETCH_ASSOC);
        return $photos;
    }

    /**
     * Récupérer une photo associées à un logement 
     */
    function selectLocationUniquePhotoUnique($id, $photos) {
        $db = dbConnect();
        $photoUnique = $db->prepare('SELECT photo_logement.* FROM photo_logement INNER JOIN logement ON photo_logement.id_logement = logement.id_logement WHERE photo_logement.id_logement = :id ORDER BY logement.id_logement DESC LIMIT 0, 1');
        $photoUnique->bindParam(':id', $id);
        $photoUnique->execute();
        $photoUnique = $photoUnique->fetchAll(PDO::FETCH_ASSOC);
        
        array_push($photos, $photoUnique[0]);
        
        return $photos;
    }

    /**
     * Récupérer le profil d'un utilisateur 
    */
    function selectProfil($id) {
        $db = dbConnect();
        $users = $db->prepare('SELECT * FROM user WHERE id_user = :id');
        $users->bindParam(':id', $id);
        $users->execute();
        $user = $users->fetchAll(PDO::FETCH_ASSOC);
        return $user[0];
    }

    /**
     * Récupérer les notes d'un utilisateur 
    */
    function selectNotes($id) {
        $db = dbConnect();
        $notes = $db->prepare('SELECT note.*, user.firstname, user.photo FROM note, user WHERE note.id_user_note = :id AND note.id_user_noteur = user.id_user ORDER BY note.id_note DESC');
        $notes->bindParam(':id', $id);
        $notes->execute();
        $notes = $notes->fetchAll(PDO::FETCH_ASSOC);
        return $notes;
    }

    /**
     * Récupérer les notes d'un logement 
    */
    function selectNotesLogement($id) {
        $db = dbConnect();
        $notes = $db->prepare('SELECT note_logement.*, user.firstname, user.photo FROM note_logement, user WHERE note_logement.id_logement = :id AND note_logement.id_user = user.id_user ORDER BY note_logement.id_note DESC');
        $notes->bindParam(':id', $id);
        $notes->execute();
        $notes = $notes->fetchAll(PDO::FETCH_ASSOC);
        return $notes;
    }

    /**
     * Sélectionner les dates de réservations d'un logement 
    */
    function selectReservationByLogement($id_logement) {
        $db = dbConnect();
        $reservations = $db->prepare('SELECT date_debut, date_fin FROM reservation WHERE id_logement = :id');
        $reservations->bindParam(':id', $id_logement);
        $reservations->execute();
        $reservations = $reservations->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;
    }

    /**
     * Sélectionner une réservation grâce à son ID 
    */
    function selectReservationById($id_reservation) {
        $db = dbConnect();
        $reservations = $db->prepare('SELECT * FROM reservation WHERE id_reservation = :id');
        $reservations->bindParam(':id', $id_reservation);
        $reservations->execute();
        $reservations = $reservations->fetchAll(PDO::FETCH_ASSOC);
        return $reservations[0];
    }
    
    /**
     * Sélectionner une conversation entre deux utilisateur
    */
    function selectConversationUnique($id_1, $id_2) {
        $db = dbConnect();
        $conversation = $db->prepare('SELECT conversation.* FROM conversation WHERE (conversation.id_user_1 = :id_2 AND conversation.id_user_2 = :id_1) OR (conversation.id_user_1 = :id_1 AND conversation.id_user_2 = :id_2)');
        $conversation->bindParam(':id_1', $id_1);
        $conversation->bindParam(':id_2', $id_2);
        $conversation->execute();
        $conversation = $conversation->fetchAll(PDO::FETCH_ASSOC);
        return $conversation;
    }
?>