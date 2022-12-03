<?php
    //On a toujours un session_start() au tout début, et dans l'index car on commence toujours pas l'index sur un site (et dans notre cas celui-ci charge les autres pages)
    session_start();

    require('controller/frontend.php');
    require('controller/backend.php');

    //try/Catch pour la gestion de nos erreur, dès qu'il y a une Exception il renvoie le msg associé
    try {

        // Récupérer la valeur de la variable page pour rediriger sur une vue via sa fonction associé dans controller/frontend.php
        if(isset($_GET['page'])) {
            //Un switch pour éviter un vieux if/else - if/ else
            //N'oubliez pas de mettre votre page ici et d'ajouter son lien dans la navbar ! (et renvoyer une exception par exemple pour les zones restreinte a un utilisateur connecté, s'il n'est pas co -> alors Exception)
            switch($_GET['page']) {
                case "signin" :
                    if(!isset($_SESSION["loggedin"])) {
                        loginUser(filter_input(INPUT_POST, 'email-si', FILTER_VALIDATE_EMAIL), $_POST['password-si']);
                    } else {
                        throw new Exception("Impossible de se connecter 2 fois");
                    }
                break;
                case "signup" :
                    if(!isset($_SESSION["loggedin"])) {
                        if($_POST["password-su"] == $_POST["confirm-password-su"]) {
                            addUser(htmlspecialchars($_POST['firstname-su']), htmlspecialchars($_POST['name-su']), $_POST['birthday-su'], filter_input(INPUT_POST, 'email-su', FILTER_VALIDATE_EMAIL), $_POST['password-su'], $_FILES['photo-user'], $_POST['pays-su'], $_POST['ville-su']);
                        } else {
                            throw new Exception("Le mots de passe sont différents");
                        }
                    } else {
                        throw new Exception("Impossible de créer un compte une fois connecté(e)");
                    }
                break;
                case "locations" : 
                    if(isset($_SESSION["loggedin"])) {
                        //Vu que les locations sont au même endroit, autant juste rajouter une variable a vérifié pour la redirection, la page changera de contenu a la fin en regardant la valeur de l'ID de la location (Pareil pour les réservations/locations)
                        if(isset($_GET['action'])) {
                            if($_GET['action'] == "list") {
                                if(isset($_GET['id'])) {
                                    getLocationUnique($_GET['id']);
                                } else {
                                    getLocations();
                                }
                            }
                            else if ($_GET['action'] == "send") {
                                addLocation($_POST["cp-add"], $_POST["ville-add"], $_POST["pays-add"], $_POST["lit-add"], $_POST["sdb-add"], $_POST["type-add"], $_FILES['file-add'], $_POST['desc-add'], $_POST['prix-add'], $_POST['piscine-add'], $_POST['wifi-add'], $_POST['superficie-add'], $_POST['titre-add']);
                            } 
                            else if ($_GET['action'] == "delete") {
                                if(isset($_GET['id'])) {
                                    removeLocation($_GET['id']);
                                }
                            } 
                        } else {
                            throw new Exception("Sélectionner une action à effectuer");
                        }
                    } else {
                        throw new Exception("Veuillez-vous connecter avant de parcourir le site");
                    }
                break;
                case "dc" :
                    if(isset($_SESSION["loggedin"])) {
                        sessionDestroy();
                    } else {
                        throw new Exception("Veuillez-vous connecter avant de vous déconnecter (Inception style)");
                    }
                break;
                case "profil":
                    if(isset($_SESSION["loggedin"])) {
                        if(isset($_GET['id'])) {
                            if(isset($_GET['action'])) {
                                if($_GET['action'] == "update") {
                                    modifyProfil($_POST['nom-p'], $_POST['prenom-p'], $_POST['birthday-p'], $_POST['email-p'], $_FILES['photo-p'], $_POST['ville-p'], $_POST['pays-p']);
                                }
                            } else {
                                getProfil($_GET['id']);
                            }
                        }
                    } else {
                        throw new Exception("Veuillez-vous connecter avant de parcourir le site");
                    }
                break;
                case "note":
                    if(isset($_SESSION["loggedin"])) {
                        if (isset($_GET['action'])) {
                            if($_GET['action'] == "send") {
                                addNote($_POST['note'], $_POST['ta-note'], $_GET['id_user_note'], $_SESSION['id']);
                            }
                        }
                    } else {
                        throw new Exception("Veuillez-vous connecter avant de parcourir le site");
                    }
                break;
                case "notelogement":
                    if(isset($_SESSION["loggedin"])) {
                        if (isset($_GET['action'])) {
                            if($_GET['action'] == "send") {
                                addNoteLogement($_POST['note'], $_POST['ta-note'], $_SESSION['id'], $_GET['id_logement']);
                            }
                        }
                    } else {
                        throw new Exception("Veuillez-vous connecter avant de parcourir le site");
                    }
                break;
                case "reservation" :
                    if(isset($_SESSION["loggedin"])) {
                        if (isset($_GET['action'])) {
                            if($_GET['action'] == "send") {
                                addReservation($_GET['id'], $_SESSION['id'], $_POST['reservation-debut-dt'], $_POST['reservation-fin-dt']);
                            }
                            else if($_GET['action'] == "delete") {
                                removeReservation($_GET['id']);
                            }
                        }
                    } else {
                        throw new Exception("Veuillez-vous connecter avant de parcourir le site");
                    }
                break;
                case "rental":
                    if(isset($_SESSION["loggedin"])) {
                        getRental();
                    } else {
                        throw new Exception("Veuillez-vous connecter avant de parcourir le site");
                    }
                break;
                case "messagerie":
                    if(isset($_SESSION["loggedin"])) {
                        getMessagerie($_SESSION['id']);
                    } else {
                        throw new Exception("Veuillez-vous connecter avant de parcourir le site");
                    }
                break;
                case "booked":
                    if(isset($_SESSION["loggedin"])) {
                        getBooked();
                    } else {
                        throw new Exception("Veuillez-vous connecter avant de parcourir le site");
                    }
                break;
                //Par défault, on renvoie la page d'accueil (on renverra plus tard l'erreur ici pour la jolie page d'Alex et Cora !)
                default: 
                    getHome();
                break;
            }
        } else {
            getHome();
        }
    } catch(Exception $e) {
        $e->getMessage();
        require('view/errorView.php');
    }
?>