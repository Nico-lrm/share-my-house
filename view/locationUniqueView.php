<?php $title = 'Location - '.$location['title']  ?>
<?php $style = '<link rel="stylesheet" href="public/css/locationUnique.css">' ?>
<?php $script = '<script src="public/js/locationUnique.js"></script>' ?>
<?php ob_start(); ?>
    <?php if($_SESSION['id'] == $location['id_user'] || $location['visible'] == 1): ?>
        <div class="container my-3">
            <div class="row">
                <div class="offset-md-1 col-md-10 d-flex justify-content-center">
                    <div id="carouselPhoto" class="carousel slide w-100" data-bs-ride="carousel" style>
                        <div class="carousel-inner">
                            <?php foreach ($photos as $photo): ?>
                                <div class="carousel-item">
                                    <img src="uploads/location/<?= $photo['id_logement'] ?>/<?= $photo['nom_photo'] ?>" class="d-block w-100" alt="...">
                                </div>
                            <?php endforeach ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPhoto" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Précedent</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselPhoto" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <?php if($_SESSION['id'] != $location['id_user']) : ?>
                <div style="flex-direction: column" class="offset-md-1 col-md-5 d-flex justify-content-center mt-3">
                <?php else : ?>
                    <div style="flex-direction: column" class="offset-md-1 col-md-10 d-flex justify-content-center mt-3">
                <?php endif ?>
                    <h3 class="my-auto"><?= $location['title'] ?> - <?= $location['ville'] ?>, <?= $location['pays'] ?></h3>
                    <hr>
                    <p>
                        <?= $location['desc_log'] ?>
                    </p>
                    <hr>
                    <h4 class="mb-4">Informations du logement</h4>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="d-flex align-items-center">
                            <i class="bi bi-house-fill"></i>
                                <span>
                                    <?php if($location['type_id'] == 1): ?>
                                        Maison
                                    <?php elseif($location['type_id'] == 2): ?>
                                        Appartement
                                    <?php else: ?>
                                        Châlet
                                    <?php endif ?>
                                </span>
                            </div>
                            <small>
                                Le logement proposé est<?php if($location['type_id'] == 1): ?> une maison<?php elseif($location['type_id'] == 2): ?> un appartement<?php else: ?> un châlet<?php endif ?>
                            </small>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="d-flex align-items-center">
                            <i class="bi bi-person-fill"></i>
                                <span><?= $location['nb_lit'] ?> lit(s)</span>
                            </div>
                            <small>Le logement dispose de <?= $location['nb_lit'] ?> lit(s)</small>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-droplet"></i>
                                <span><?= $location['nb_sdb'] ?> salle(s) de bain</span>
                            </div>
                            <small>Le logement dispose de <?= $location['nb_sdb'] ?> salle(s) de bain</small>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-aspect-ratio"></i>
                                <span><?= $location['superficie'] ?> m²</span>
                            </div>
                            <small>Le logement fait <?= $location['superficie'] ?> m²</small>
                        </div>
                        <?php if($location['haveWifi'] == 1): ?>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-wifi"></i>
                                    <span>Wifi</span>
                                </div>
                                <small>Le logement possède le Wi-Fi</small>
                            </div>
                        <?php endif ?>
                        <?php if($location['havePiscine'] == 1): ?>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                <i class="bi bi-droplet"></i>
                                    <span>Piscine</span>
                                </div>
                                <small>Le logement possède une piscine (pour brûler au soleil)</small>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <?php if($_SESSION['id'] != $location['id_user']) : ?>
                <div class="col-md-5 mt-3">
                    <div class="card d-flex flex-column justify-content-center">
                        <div class="card-header">
                            <h6 class="card-title">Réservation</h6>
                        </div>
                        <div class="card-body">
                            <div class="p-3 d-none my-2" id="form-result"></div>
                            <form action="?page=reservation&action=send&id=<?= $_GET['id'] ?>" style="height:100%" class="d-flex flex-column justify-content-center" method="post" id="form-reservation">
                                <div class="d-flex flex-column">
                                    <label class="form-label" for="reservation-debut-dt">Date de début de réservation : </label>
                                    <input class="mb-2" placeholder="Arrivé(e) le..." name="reservation-debut-dt" id="reservation-debut-dt" required>
                                </div>
                                <div class="d-flex flex-column">
                                    <label class="form-label" for="reservation-fin-dt">Date de fin de réservation : </label>
                                    <input placeholder="Départ le..." name="reservation-fin-dt" id="reservation-fin-dt" required>
                                </div>
                                <input class="mt-3 btn w-100 btn-dark" type="submit" value="Réserver le logement">
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif ?>
            </div>
            <div class="row">
                <div class="offset-md-1 col-md-10">
                    <hr>
                </div>
                <div class="offset-md-1 col-md-10">
                    <?php if ($profil['photo'] != null): ?>
                        <img class="rounded-circle me-2" width="30" height="30" src="uploads/users/<?= $profil['id_user'] ?>/<?= $profil['photo'] ?>">
                    <?php else: ?>
                        <img class="rounded-circle me-2" width="30" height="30" src="https://via.placeholder.com/30">
                    <?php endif ?>
                    <span>Logement publié par </span>
                    <a style="text-decoration: none; color: #111" href="?page=profil&id=<?= $profil['id_user'] ?>">
                        <u>
                            <span><?= $profil['firstname'] ?></span>
                        </u>
                    </a>
                </div>
                <div class="offset-md-1 col-md-10 mt-3">
                    <?php if ($_SESSION['id'] != $profil['id_user']): ?>
                        <a href="?page=messagerie&id_dest=<?= $profil['id_user'] ?>">
                            <button class="btn btn-dark">Envoyer un message à <?= $profil['firstname'] ?></button>
                        </a>
                    <?php endif ?>
                </div>
                <div class="offset-md-1 col-md-10">
                    <hr class="mb-4">
                </div>
                <div class="offset-md-1 col-md-10">
                    <?php if ($_SESSION['id'] != $profil['id_user']): ?>
                        <h4 class="text-right">Ajouter un commentaire :</h4> 
                        <form id="form-commentaire" action="?page=notelogement&action=send&id_logement=<?= $location['id_logement']?>" method="post">
                            <textarea name="ta-note" id="ta-note" class="form-control ta-note" rows="5"></textarea>
                            <div class="row mt-3 ">
                                <div class="col-12 d-flex justify-content-between">
                                    <fieldset class="rate">
                                        <input id="rate1-star5" type="radio" name="note" value="5" required />
                                        <label for="rate1-star5" title="Parfait">5</label>
                                        <input id="rate1-star4" type="radio" name="note" value="4" required />
                                        <label for="rate1-star4" title="Très bien">4</label>
                                        <input id="rate1-star3" type="radio" name="note" value="3" required />
                                        <label for="rate1-star3" title="Satisfaisant">3</label>
                                        <input id="rate1-star2" type="radio" name="note" value="2" required />
                                        <label for="rate1-star2" title="Mauvais">2</label>
                                        <input id="rate1-star1" type="radio" name="note" value="1" required />
                                        <label for="rate1-star1" title="Atroce">1</label>
                                    </fieldset>
                                    <input type="submit" value="Envoyer le commentaire" class="btn btn-dark">
                                </div>
                            </div>
                        </form>
                        <hr class="my-5 w-100">
                    <?php endif ?>
                </div>
                <div class="offset-md-1 col-md-10">
                    <h4 class="text-right">Commentaires :</h4> 
                    <?php if(count($notes) > 0): ?>
                        <?php foreach ($notes as $note): ?>
                            <div class="col-12 my-4">
                                <textarea class="form-control ta-note" disabled rows="5"><?= $note['commentaire'] ?></textarea>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span style="display:flex; align-items:center;">
                                        <fieldset class="rate-note">
                                            <?php if($note['valeur'] == 5): ?>
                                                <input id="ratenote<?= $note['id_note']?>-star5" type="radio" value="5" checked="checked" disabled/>
                                            <?php else: ?>
                                                <input id="ratenote<?= $note['id_note']?>-star5" type="radio" value="5"/ disabled>
                                            <?php endif ?>
                                            <label for="ratenote<?= $note['id_note']?>-star5" title="Parfait">5</label>

                                            <?php if($note['valeur'] == 4): ?>
                                                <input id="ratenote<?= $note['id_note']?>-star4" type="radio" value="4" checked="checked"/>
                                            <?php else: ?>
                                                <input id="ratenote<?= $note['id_note']?>-star4" type="radio" value="4"/>
                                            <?php endif ?>
                                            <label for="ratenote<?= $note['id_note']?>-star4" title="Très bien">4</label>
                                            
                                            <?php if($note['valeur'] == 3): ?>
                                                <input id="ratenote<?= $note['id_note']?>-star3" type="radio" value="3" checked="checked"/>
                                            <?php else: ?>
                                                <input id="ratenote<?= $note['id_note']?>-star3" type="radio" value="3"/>
                                            <?php endif ?>
                                            <label for="ratenote<?= $note['id_note']?>-star3" title="Satisfaisant">3</label>

                                            <?php if($note['valeur'] == 2): ?>
                                                <input id="ratenote<?= $note['id_note']?>-star2" type="radio" value="2" checked="checked"/>
                                            <?php else: ?>
                                                <input id="ratenote<?= $note['id_note']?>-star2" type="radio" value="2"/>
                                            <?php endif ?>
                                            <label for="ratenote<?= $note['id_note']?>-star2" title="Mauvais">2</label>

                                            <?php if($note['valeur'] == 1): ?>
                                                <input id="ratenote<?= $note['id_note']?>-star3" type="radio" value="1" checked="checked"/>
                                            <?php else: ?>
                                                <input id="ratenote<?= $note['id_note']?>-star3" type="radio" value="1"/>
                                            <?php endif ?>
                                            <label for="ratenote<?= $note['id_note']?>-star1" title="Atroce">1</label>
                                        </fieldset>
                                    </span>
                                    <span> 
                                        <?php if ($note['photo'] == NULL): ?>
                                            <img class="rounded-circle" width="30" height="30" src="https://via.placeholder.com/150" style="margin-right: 0.25rem">
                                        <?php else : ?>
                                            <img class="rounded-circle" width="30" height="30" style="margin-right: 0.25rem" src="uploads/users/<?= $note['id_user'] ?>/<?= $note['photo'] ?>">
                                        <?php endif ?>
                                        <?= $note['firstname'] ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else : ?>
                        <div class="py-3">Il n'y a aucun commentaire sur ce logement !</div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container my-3">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mt-5">
                        Le logement demandé n'est plus disponible pour le moment.<br>
                    </p>
                    <button class="btn btn-dark mt-3" onclick="history.back()">Précédent</button>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>