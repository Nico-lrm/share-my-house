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

    function selectLocationUniquePhoto($id, $photos) {
        $db = dbConnect();
        $photoUnique = $db->prepare('SELECT photo_logement.* FROM photo_logement INNER JOIN logement ON photo_logement.id_logement = logement.id_logement WHERE photo_logement.id_logement = :id ORDER BY logement.id_logement DESC LIMIT 0, 1');
        $photoUnique->bindParam(':id', $id);
        $photoUnique->execute();
        $photoUnique = $photoUnique->fetchAll(PDO::FETCH_ASSOC);
        
        
        array_push($photos, $photoUnique[0]);
        
        return $photos;
    }

    function selectAllLocations() {
        //Récupérer les informations
        $lieu = $_POST['lieu'];
        $maison = $_POST['maison'];
        $appart = $_POST['appart'];
        $chalet = $_POST['chalet'];
        $lit = $_POST['lit'];
        $sdb = $_POST['sdb'];
        $prix = $_POST['prix'];
        $piscine = $_POST['piscine'];
        $wifi = $_POST['wifi'];

        //Afficher les locations 15 par 15
        $db_logement = dbConnect();

        //Gestion des pages
        $per_page = 15;
        if (isset($page)) {
            $page = $page;
        } else {
            $page = 1;
        }
        $page_start =  ($page - 1) * $per_page;

        //Début de la requête logement
        $requete = "SELECT * FROM logement WHERE ";
        if(!empty($lieu)) {
            $requete = $requete." (ville LIKE('$lieu%') OR pays LIKE ('$lieu%')) AND ";
        }
        if($maison == "true") {
            $requete = $requete." (type_id = 1";
            if($appart == "true" || $chalet == "true")
            {
                $requete = $requete." OR ";
            } else {
                $requete = $requete.") AND ";
            }
        }
        if($appart == "true") {
            if($maison != "true") {
                $requete = $requete." (";
            }
            $requete = $requete."type_id = 2";
            if($chalet == "true") {
                $requete = $requete." OR ";
            } else {
                $requete = $requete.") AND ";
            }
        }
        if($chalet == "true") {
            $requete = $requete."type_id = 3 ";
            if($appart == "true" || $maison == "true") {
                $requete = $requete.") AND ";
            } else {
                $requete = $requete."AND ";
            }
        }
        if(!empty($lit)) {
            $requete = $requete."nb_lit >= $lit AND ";
        }
        if(!empty($sdb)) {
            $requete = $requete."nb_sdb >= $sdb AND ";
        }
        if(!empty($prix)) {
            $requete = $requete."prix_nuit <= $prix AND ";
        }
        if($piscine == "true") {
            $requete = $requete."havePiscine = 1 AND ";
            if($wifi == "true") {
                $requete = $requete."haveWifi = 1 AND ";
            }
        } else if($wifi == "true") {
            $requete = $requete."haveWifi = 1 AND ";
        } 

        $requete = $requete."visible = 1 ";
        $requete = $requete."ORDER BY logement.id_logement DESC LIMIT $page_start, $per_page";
        $locations = $db_logement->prepare($requete);
        $locations->execute();
        $locations = $locations->fetchAll(PDO::FETCH_ASSOC);
        return $locations;
    }

    $locations = selectAllLocations();

    //Récupérer la première photo de chaque logement
    $photos = array();

    for($i = 0; $i < count($locations); $i++) {
        $photos = selectLocationUniquePhoto($locations[$i]['id_logement'], $photos);
    }    
?>
<?php if (count($locations) > 0): ?>
    <?php for($i = 0; $i < count($locations); $i++): ?>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
            <div class="card" id="card<?= $locations[$i]['id_logement'] ?>">
                <img class="d-block w-100" src="uploads/location/<?= $locations[$i]['id_logement'] ?>/<?= $photos[$i]['nom_photo'] ?>" alt="">
                <div class="card-body"> 
                    <h5 class="card-title"><?= $locations[$i]['ville'] ?>, <?= $locations[$i]['pays'] ?></h5>
                    <div class="row">
                        <div class="col-7">
                            <p class="card-text text-truncate">
                                <i class="bi bi-person-fill"></i>
                                <?= $locations[$i]['nb_lit'] ?> lit(s) 
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="card-text card-price">
                                <?= $locations[$i]['prix_nuit'] ?>€ / nuit
                            </p>
                        </div>
                    </div>
                    <a href="?page=locations&action=list&id=<?= $locations[$i]['id_logement'] ?>" class="stretched-link"></a>
                </div>
            </div>
        </div>
    <?php endfor ?>
<?php else : ?>
    <div class="col-12 text-align-center">
        Aucun résultat trouvé !
        Veuillez utiliser d'autres filtres pour votre recherche.
    </div>
<?php endif ?>
