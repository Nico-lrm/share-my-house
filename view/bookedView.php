<?php $title = 'Mes réservations' ?>
<?php $style = '<link rel="stylesheet" href="public/css/booked.css">' ?>
<?php $script = '<script src="public/js/booked.js"></script>' ?>
<?php $compteur = 1 ?>
<?php $today = new DateTime() ?>
<?php $alreadyShown = array() ?>
<?php ob_start(); ?>  
    <div class="container-fluid">
        <div class="row" id="card-cora">
            <div class="col-md">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">UN BRIN DE <b>NOSTALGIE ?</b>
                            </h1><br>
                            <div class="row">
                                <div class="col-md">
                                    <p class="card-text">
                                        Vous souhaitez changer d'air ?<br> Parcourez à nouveau la page des différentes Locations.
                                    </p>
                                    <a href="?page=locations&action=list" class="btn">
                                        <button class="btn" id="card-btn">
                                            <b>Réservez à nouveau</b>
                                        </button>
                                    </a>    
                                </div>
                                <div class="col-md">
                                    <p class="card-text">
                                        Envie de revivre vos expériences passées ?<br> Ne perdez pas plus de temps.
                                    </p>
                                    <a href="#last_booked" class="btn">
                                        <button class="btn" id="card-btn">
                                            <b>Mes Précédentes Réservations</b>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <!--Carousel-->
                <div id="carousel_pics" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carousel_pics" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carousel_pics" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="2000">
                            <img src="public/img/rental/carrousel_1.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Revisitez des contrées que vous avez tant adorées</h5>
                                <p>Elles n'attendent que vous.</p>
                            </div>
                        </div>
        
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="public/img/rental/carrousel_2.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Envie de nouveauté</h5>
                                <p>Découvrez tout nos logements via la fonctionnalité de recherche.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel_pics" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Précedent</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel_pics" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Suivant</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <h6 class="display-6 my-5 text-center" id="last_booked"><strong>MES RESERVATIONS</strong></h1>
    <div class="container-fluid">
        <div style="overflow-x: auto;">
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th width="3%">#</th>
                        <th width="7%">Titre</th>
                        <th width="7%">Type de bien</th>
                        <th width="7%">Ville</th>
                        <th width="7%">Pays</th>
                        <th width="10%">Nombre de lits</th>
                        <th width="12%">Nombre de salles de bain</th>
                        <th width="5%">Piscine</th>
                        <th width="5%">Wifi</th>
                        <th width="10%">Prix du bien en €/nuit</th>
                        <th width="5%">Superficie</th>
                        <th width="8%">Date de début</th>
                        <th width="8%">Date de fin</th>
                        <th width="10%">Statut</th>
                        <th width="10%">Annuler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($locations) > 0): ?>
                        <?php foreach($locations as $location): ?>
                            <?php $date_debut = new DateTime($location['date_debut']) ?>
                            <?php $date_fin = new DateTime($location['date_fin']) ?>
                            <tr>
                                <th scope="row"><?= $compteur ?></th>
                                <td>
                                    <span class="text-truncate">
                                        <?= $location['title'] ?>
                                    </span>
                                </td>
                                <td>                                
                                    <?php if($location['type_id'] == 1): ?>
                                        Maison
                                    <?php elseif ($location['type_id'] == 2): ?>
                                        Appartement
                                    <?php else : ?>
                                        Châlet
                                    <?php endif ?>
                                </td>
                                <td><?= $location['ville'] ?></td>
                                <td><?= $location['pays'] ?></td>
                                <td><?= $location['nb_lit'] ?> lit(s)</td>
                                <td><?= $location['nb_sdb'] ?> salle(s) de bain</td>
                                <td>
                                    <?php if($location['havePiscine'] == 1): ?>
                                        Oui
                                    <?php else : ?>
                                        Non
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if($location['haveWifi'] == 1): ?>
                                        Oui
                                    <?php else : ?>
                                        Non
                                    <?php endif ?>
                                </td>
                                <td><?= $location['prix_nuit'] ?> € / nuit</td>
                                <td><?= $location['superficie'] ?> m²</td>
                                <td><?= $date_debut->format('d/m/Y') ?></td>
                                <td><?= $date_fin->format('d/m/Y') ?></td>
                                <td>
                                    <?php if($date_debut->format('Y-m-d') > $today->format('Y-m-d') && $date_fin->format('Y-m-d') > $today->format('Y-m-d')): ?>
                                        A venir
                                    <?php elseif($date_debut->format('Y-m-d') <= $today->format('Y-m-d') && $date_fin->format('Y-m-d') >= $today->format('Y-m-d')) : ?>
                                        En cours
                                    <?php elseif($date_debut->format('Y-m-d') < $today->format('Y-m-d') && $date_fin->format('Y-m-d') < $today->format('Y-m-d'))  : ?>
                                        Fini
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if($today->format('Y-m-d') <= date_sub($date_debut, date_interval_create_from_date_string("3 days"))->format('Y-m-d')): ?>
                                        <a style="cursor:pointer;" class="text-white text-underline" onclick="deleteReservation(<?= $location['id_reservation'] ?>, '<?= $location['title'] ?>', '<?= $date_debut->format('d/m/Y') ?>', '<?= $date_fin->format('d/m/Y') ?>')">Supprimer</a>
                                    <?php else: ?>
                                        <a class="indisponible text-decoration-none text-white">Indisponible</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php $compteur++ ?>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="15">Vous n'avez pas de réservations</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if(count($locations) > 0): ?>
        <h6 class="display-6 my-5 text-center"><strong>APERCU DE MES RESERVATIONS</strong></h1>
        <div class="row container-fluid mb-3" id="card-nico">
            <?php for ($i = 0; $i < count($locations); $i++): ?>
                <?php if(!in_array($locations[$i]['id_logement'], $alreadyShown)): ?>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="card">
                            <img src="uploads/location/<?= $locations[$i]['id_logement'] ?>/<?= $photos[$i]['nom_photo']?>">
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
                    <?php array_push($alreadyShown, $locations[$i]['id_logement']) ?>
                <?php endif ?>
            <?php endfor ?>
        </div>
    <?php endif ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>