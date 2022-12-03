<?php
    require('model/backend.php');

    /**
     * Ajouter un utilisateur - Vérification
    */ 
    function addUser($firstname, $name, $birthday, $email, $password, $photo, $pays, $ville) {
        $regex = "/^[A-Za-z0-9À-ÖØ-öø-ÿ\-\&_.\^]+$/";
        //Vérifié si les champs sont bien rempli
        if(!empty($firstname) && !empty($name) && !empty($birthday) && !empty($email) && !empty($password)) {
            //Vérifier si les champs ne contiennent pas de caractères bizarre
            if(!preg_match($regex, $password) || !preg_match($regex, $firstname) || !preg_match($regex, $name)) {
                throw new Exception("Caractères indésirables dans l'un des champs");
            }             
            //Vérifié s'il est majeur
            if(!verifAge($birthday)) {
                throw new Exception("Vous devez avoir 18 ans ou plus pour vos inscrire sur le site");
            }
            //Vérifié les doublons
            $data = noTwinEmail($email); 
            if ($data['email'] == true) {
                throw new Exception('Erreur : Adresse e-mail déjà utilisée');
            }

            //Ajout de l'utilisateur dans la base
            $userid = createUser($firstname, $name, $birthday, $email, $password, $pays, $ville);
            
            if(!empty($photo['name'])) {
                $filename = $photo['name'];
                $filesize = $photo['size'];
                $filetmploc = $photo['tmp_name'];
                $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
        
                //Tableau des extensions autorisées
                $extensions_autorisees = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'webp', 'PNG', 'WEBP');
        
                //Si le fichier est bien dans le dossier temporaire PHP
                if($filetmploc) {
                    //Si la taille n'excède pas 50 Mo
                    if($filesize <= (50 * 1000 * 1000)) {
                        //Si l'extension est bien la bonne
                        if(in_array($fileExtension, $extensions_autorisees)) {
                            //Si le dossier du logement n'est pas encore créé
                            if(!file_exists("uploads/users/$userid")) {
                                mkdir("uploads/users/$userid", 0777, true);
                            } else {
                                throw new Exception("Impossible de créer le dossier");
                            }
                            if(move_uploaded_file($filetmploc, "uploads/users/$userid/$filename")) {
                                //Le fichier à bien pu être ajouté, on peut donc ajouté la photo à la base de données
                                changeUserPhoto($filename, $userid);
                            } else {
                                throw new Exception("Impossible de déplacer le fichier ".$filename.".");
                            }
                        } else {
                            throw new Exception("Extension non autorisée.");
                        }
                    } else {
                        throw new Exception("Fichier trop volumineux");
                    }
                } else {
                    throw new Exception("Fichier temporaire introuvable");
                }
            }
        } else {
            throw new Exception("L'un des champs n'a pas été saisie");
        }
        header('Location: ?page=home');
    }

    /**
     * Ajouter une location - Vérification 
    */
    function addLocation($cp, $ville, $pays, $nblits, $nbsdb, $type, $photo, $desc, $prix, $piscine, $wifi, $superficie, $titre) {
        if(!empty($cp) && !empty($ville) && !empty($pays) && !empty($nblits) && !empty($nbsdb) && !empty($type) && !empty($desc) && !empty($prix) && !empty($superficie) && !empty($titre)) {
            //S'il y a au moins une photo
            if(($count = count($photo['name'])) > 0) {
                //On ajoute la location à la base
                $logement_id = insertNewLocation($cp, $ville, $pays, $nblits, $nbsdb, $type, $desc, $prix, $piscine, $wifi, $superficie, $titre);
                for($i=0; $i < $count; $i++) {
                    //Infos du fichier
                    $filename = $photo['name'][$i];
                    $filesize = $photo['size'][$i];
                    $filetmploc = $photo['tmp_name'][$i];
                    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

                    //Tableau des extensions autorisées
                    $extensions_autorisees = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'webp', 'PNG', 'WEBP');

                    if($filetmploc) {
                        if($filesize <= (50 * 1000 * 1000)) {
                            if(in_array($fileExtension, $extensions_autorisees)) {
                                //Si le dossier du logement n'est pas encore créé
                                if(!file_exists("uploads/location/$logement_id")) {
                                    mkdir("uploads/location/$logement_id", 0777, true);
                                }
                                if(move_uploaded_file($filetmploc, "uploads/location/$logement_id/$filename")) {
                                    //Le fichier à bien pu être ajouté, on peut donc ajouté la photo à la base de données
                                    insertNewLocationPhoto($logement_id, $filename);
                                } else {
                                    throw new Exception("Impossible de déplacer le fichier ".$filename.".");
                                }
                            } else {
                                throw new Exception("Extension non autorisée.");
                            }
                        } else {
                            throw new Exception("Fichier trop volumineux");
                        }
                    } else {
                        throw new Exception("Fichier temporaire introuvable");
                    }
                }
            } else {
                throw new Exception("Vous devez au moins ajouter une photo.");
            }
        } else {
            throw new Exception("Champs incomplets.");
        }
        //Redirection après l'insertion
        header('Location: ?page=locations&action=list');
    }

    function removeLocation($id_logement) {
        $location = selectLocationUnique($id_logement);
        $reservations = selectReservationByLogement($id_logement);
        if($location != null) {
            if($_SESSION['id'] == $location['id_user']) {

                $today = new DateTime();
                foreach ($reservations as $reservation) {
                    //On récupère les dates
                    $date_debut = new DateTime($reservation['date_debut']);
                    $date_fin = new DateTime($reservation['date_fin']);

                    //On vérifie que la date d'aujourd'hui est bien supérieur à chaque date de réservation
                    if($today->format('Y-m-d') <= $date_debut->format('Y-m-d') || $today->format('Y-m-d') <= $date_fin->format('Y-m-d')) {
                        //On renvoie une exception si une réservation est a venir
                        throw new Exception("Impossible de supprimer le logement : Des réservations sont prévues.");
                    }
                }
                //Si c'est bon, on supprime l'annonce du logement ainsi que ses photos
                deleteLocation($id_logement);
                deleteLocationPhoto($id_logement);
                header('Location: ?page=rental');
            } else {
                throw new Exception("Vous ne pouvez pas supprimer les annonces des autres utilisateurs");
            }
        } else {
            throw new Exception("Le logement à supprimer n'existe pas");
        }
    }

    /**
     * Vérification de l'âge pour l'inscription 
    */
    function verifAge($date) { 
        $date_birthday = date_create($date);
        $date_local = date_create("now");

        //date_sub(date_local, date a soustraire)
        //date_interval_create_from_date_string("text") -> Vous pouvez directement créer une date a partir de texte
        date_sub($date_local, date_interval_create_from_date_string("18 years"));
        return ($date_local > $date_birthday);
    } 

    /**
     * Connexion d'un utilisateur - Vérification 
    */
    function loginUser($email, $password) {
        $user[0] = connectUser($email);

        //Si notre utilisateur n'existe pas et renvoie null
        if ($user[0] === null) {
            throw new Exception("Utilisateur introuvable.");
        } else {
            //Sinon, on le connecte et on le redirige
            if (password_verify($password, $user[0]['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['photo'] = $user[0]['photo'];
                $_SESSION['prenom'] = $user[0]['firstname'];
                $_SESSION['nom'] = $user[0]['name'];
                $_SESSION['id'] = $user[0]['id_user'];
                $_SESSION['email'] = $user[0]['email'];
                $_SESSION['role'] = $user[0]['role'];
                header('Location: ?page=home');
            } else {
                throw new Exception("Mot de passe incorrect.");
            }
        }
    }

    /**
     * Ajout d'une note et d'un commentaire à un utilisateur 
    */
    function addNote($note, $text, $id_note, $id_noteur) {
        if(!empty($note) && !empty($text) && !empty($id_note) && !empty($id_noteur)) {
            if(selectProfil($id_note) != null && selectProfil($id_noteur) != null) {
                if($id_note != $id_noteur) {
                    if($note >= 1 && $note <= 5) {
                        insertNote($note, $text, $id_note, $id_noteur);
                    } else {
                        throw new Exception("La note doit être comprise entre 1 et 5");
                    }
                } else {
                    throw new Exception("Vous ne pouvez pas vous commenter vous-même !");
                }
            }
            else {
                throw new Exception("L'un des utilisateur n'existe pas");
            }
        } else {
            throw new Exception("L'un des champs n'est pas saisi");
        }
        header('Location: ?page=profil&id='.$id_note);
    }

    /**
     * Ajout d'une note et d'un commentaire à un logement 
    */
    function addNoteLogement($note, $text, $id_user, $id_logement) {
        if(!empty($note) && !empty($text) && !empty($id_user) && !empty($id_logement)) {
            $user = selectProfil($id_user);
            $location = selectLocationUnique($id_logement);
            if($user != null && $location != null) {
                if($user['id'] != $location['id_user']) {
                    if($note >= 1 && $note <= 5) {
                        insertNoteLogement($note, $text, $id_user, $id_logement);
                    } else {
                        throw new Exception("La note doit être comprise entre 1 et 5");
                    }
                } else {
                    throw new Exception("Vous ne pouvez pas noter votre propre logement !");
                }
            }
            else {
                throw new Exception("L'un des utilisateur n'existe pas");
            }
        } else {
            throw new Exception("L'un des champs n'est pas saisi");
        }
        header('Location: ?page=locations&action=list&id='.$id_logement);
    }

    /**
     * Modifier le profil d'un utilisateur
    */
    function modifyProfil($nom, $prenom, $date, $email, $photo, $ville, $pays) {
        $requete = "UPDATE user SET ";
        if (!empty($nom)) {
            $requete = $requete."name = '$nom', ";
        }
        if (!empty($prenom)) {
            $requete = $requete."firstname = '$prenom', ";
        }
        if (!empty($birthday)) {
            if(verifAge($birthday)) {
                $requete = $requete."birthday = '$birthday', ";
            }
        }
        if(!empty($email)) {
            if($_SESSION['email'] != $email) {
                $data = noTwinEmail($email); 
                if ($data['email'] == true) {
                    throw new Exception('Erreur : Adresse e-mail déjà utilisée');
                } else {
                    $requete = $requete."email = '$email', ";
                }
            }
        }
        if(!empty($photo['name'])) {
            $filename = $photo['name'];
            $filesize = $photo['size'];
            $filetmploc = $photo['tmp_name'];
            $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

            //Tableau des extensions autorisées
            $extensions_autorisees = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'webp', 'PNG', 'WEBP');

            if($filetmploc) {
                if($filesize <= (50 * 1000 * 1000)) {
                    if(in_array($fileExtension, $extensions_autorisees)) {
                        //Si le dossier du logement n'est pas encore créé
                        if(!file_exists("uploads/users/".$_SESSION['id'])) {
                            mkdir("uploads/users/".$_SESSION['id'], 0777, true);
                        }
                        if(move_uploaded_file($filetmploc, "uploads/users/".$_SESSION['id']."/$filename")) {
                            //Le fichier à bien pu être ajouté, on peut donc ajouté la photo à la base de données
                            $requete = $requete."photo = '$filename', ";
                            $_SESSION['photo'] = $filename;
                        } else {
                            throw new Exception("Impossible de déplacer le fichier ".$filename.".");
                        }
                    } else {
                        throw new Exception("Extension non autorisée.");
                    }
                } else {
                    throw new Exception("Fichier trop volumineux");
                }
            } else {
                throw new Exception("Fichier temporaire introuvable");
            }
        }
        if(!empty($ville)) {
            $requete = $requete."ville = '$ville', ";
        }
        if(!empty($pays)) {
            $requete = $requete."pays = '$pays' ";
        }

        $requete = $requete."WHERE id_user = ".$_SESSION['id'];
        updateProfil($requete);
        header('Location: ?page=profil&id='.$_SESSION['id']);
    }

    /**
     * Ajouter une réservation 
    */
    function addReservation($id_log, $id_user, $date_debut, $date_fin) {
        //On récupère d'abord le logement pour savoir si l'utilisateur n'essaie pas de remplir les réservations
        $location = selectLocationUnique($id_log);
        
        if($location['id_user'] != $id_user) {
            $reservations = selectReservationByLogement($id_log);
        
            $date_debut = new DateTime($date_debut);
            $date_fin = new DateTime($date_fin);
        
            if(!empty($id_log) && !empty($id_user) && !empty($date_debut) && !empty($date_fin) && $date_debut <= $date_fin) {
                foreach ($reservations as $reservation) {
                    if(($date_debut->format('Y-m-d') <= $reservation['date_debut'] && $date_fin->format('Y-m-d') >= $reservation['date_fin']) || ($date_debut->format('Y-m-d') >= $reservation['date_debut'] && $date_debut->format('Y-m-d') <= $reservation['date_fin']) || ($date_fin->format('Y-m-d') >= $reservation['date_debut'] && $date_fin->format('Y-m-d') <= $reservation['date_fin'])) {
                        throw new Exception("Date de réservation invalide");
                    }
                }
                //Si tout est OK, on peut ajouter la réservation
                insertReservation($id_log, $id_user, $date_debut->format("Y-m-d"), $date_fin->format("Y-m-d"));
                header('Location: ?page=booked#last_booked');
            } else {
                throw new Exception("L'un des champs est mal renseigné");
            }
        } else {
            throw new Exception("Vous ne pouvez pas vous louez vos propres logements !");
        }
    }

    /**
     * Supprimer une réservation (si la date de suppression >= 3 avant la date de location) 
    */
    function removeReservation($id_reservation) {
        $reservation = selectReservationById($id_reservation);
        
        if($_SESSION['id'] == $reservation['id_user_reserv']) {
            if($reservation != null) {
                //Date d'aujourd'hui
                $today = new DateTime();
                $today = $today->format('Y-m-d');

                //La date de suppression limite
                $dateLimit = new DateTime($reservation['date_debut']);
                $dateLimit = date_sub($dateLimit, date_interval_create_from_date_string("3 days"));
                $dateLimit = $dateLimit->format('Y-m-d');
    
                if($today <= $dateLimit) {
                    deleteReservation($id_reservation);
                    header('Location: ?page=booked');
                } else {
                    throw new Exception("La période pour supprimer votre réservation est dépassé, veuillez contacter le support pour plus d'informations.");
                }
            } else {
                throw new Exception("La réservation à supprimer n'existe pas.");
            }
        } else {
            throw new Exception("Vous ne pouvez pas supprimer les réservations de quelqu'un d'autre que vous.");
        }
    }

    /**
     * Se déconnecter
    */
    function sessionDestroy() {
        session_destroy();
        header('Location: ?page=home');
    }

?>