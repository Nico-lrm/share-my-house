<?php 
    /**
     * Pour les views, vous avez juste besoin de créer une fonction qui a la même syntaxe et qui 
     * porte le nom de votre page avec le prefixe 'get'
     * ex: function getNomPage()
     * 
     *  Vous aurez sans doute besoin de plus de chose vu que vous récupérer des infos de la base
     *  sans AJAX, hésiter pas a consulter le dossier "support" pour des exemples
    */
    require('model/frontend.php');

    function getHome() {
        require('view/homeView.php');
    }

    function getLocations() {
        require('view/locationsView.php');
    }

    function getRental() {
        $locations = selectLocationsRental("ASC",$_SESSION['id'], " ");
        $photos = array();
        for ($i=0; $i < count($locations); $i++) { 
            $photos = selectLocationUniquePhotoUnique($locations[$i]['id_logement'], $photos);
        }
        require('view/rentalView.php');
    }
    function getBooked() {
        $locations = selectLocationsBooked("ASC", $_SESSION['id']);
        $photos = array();
        for ($i=0; $i < count($locations); $i++) { 
            $photos = selectLocationUniquePhotoUnique($locations[$i]['id_logement'], $photos);
        }
        require('view/bookedView.php');
    }

    function getLocationUnique($id_logement) {
        $location = selectLocationUnique($id_logement);
        $photos = selectLocationUniquePhoto($id_logement);
        $notes = selectNotesLogement($id_logement);
        $profil = selectProfil($location['id_user']);
        if ($location === null) {
            throw new Exception("L'annonce demandée n'existe pas.");
        } 
        require('view/locationUniqueView.php');
    }

    function getProfil($id_profil) {
        if($_SESSION['id'] == $id_profil) {
            $locations = selectLocationsRental("ASC", $id_profil, " ");
        } else {
            $locations = selectLocationsRental("ASC", $id_profil, " AND visible = 1 ");
        }
        $profil = selectProfil($id_profil);
        $notes = selectNotes($id_profil);
        $photos = array();
        for ($i=0; $i < count($locations); $i++) { 
            $photos = selectLocationUniquePhotoUnique($locations[$i]['id_logement'], $photos);
        }
        if ($profil === null) {
            throw new Exception("Utilisateur introuvable !");
        } else {
            require ('view/profilView.php');
        }
    }

    function getMessagerie($id_user_courant) {
        if(isset($_GET['id_dest'])) {
            $conversationUnique = selectConversationUnique($_GET['id_dest'], $id_user_courant);
            if(count($conversationUnique) == 0) {
                $id = insertConversation($id_user_courant, $_GET['id_dest']);
            } else {
                $id = $conversationUnique[0]['id_conversation'];
            }
        }
        require('view/messagerieView.php');
    }
?>