<?php $title = 'Profil - '.$profil['firstname'] ?>
<?php $style = '<link rel="stylesheet" href="public/css/profil.css">' ?>
<?php $script = '<script src="public/js/profil.js"></script>' ?>
<?php ob_start(); ?>
    <div class="container mt-5 mb-5">
        <div class="row mb-3">
            <div class="col-md-12">
                <form method="POST" action="?page=profil&id=<?= $_SESSION['id'] ?>&action=update" enctype="multipart/form-data"> <!--permet upload de fichier-->
                    <div class="col-md-12 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-4">
                            <?php if ($profil['photo'] == NULL): ?>
                                <img class="rounded-circle mt-5" width="150px" height="150" src="https://via.placeholder.com/150" style="margin-bottom: 1.25rem">
                            <?php else : ?>
                                <img class="rounded-circle mt-5" width="150px" height="150" style="margin-bottom: 1.25rem" src="uploads/users/<?=$profil['id_user']?>/<?=$profil['photo']?>">
                            <?php endif ?>
                            <span class="font-weight-bold"><?= $profil['firstname'] ?></span>
                            <?php if ($_SESSION['id'] == $profil['id_user']): ?>
                                <span class="text-black-50"><?= $profil['email'] ?></span>
                            <?php else: ?>
                                <a href="?page=messagerie&id_dest=<?= $profil['id_user'] ?>">
                                    <div class="btn btn-dark">Envoyer un message à <?= $profil['firstname'] ?></div>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-md-12 border-right">
                        <div class="px-3 pt-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profil</h4>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md">
                                    <label class="labels">Prénom</label>
                                    <?php if ($_SESSION['id'] == $profil['id_user']): ?>
                                        <input type="text" name="prenom-p" class="form-control" placeholder="Prénom" value="<?= $profil['firstname'] ?>">
                                    <?php else : ?>
                                        <input type="text" class="form-control" placeholder="Prénom" value="<?= $profil['firstname'] ?>" disabled>
                                    <?php endif ?>
                                </div>
                                <?php if ($_SESSION['id'] == $profil['id_user']): ?>
                                <div class="col-md">
                                    <label class="labels">Nom</label>
                                    <input type="text" name="nom-p" class="form-control" placeholder="Nom" value="<?= $profil['name'] ?>">                        
                                </div>
                                <?php endif ?>
                                <?php if ($_SESSION['id'] == $profil['id_user']): ?>
                                <div class="col-md">
                                    <label class="labels">Date de naissance</label>
                                    <input type="date" name="birthday-p" class="form-control" placeholder="Date de naissance" value="<?= $profil['birthday'] ?>">                        
                                </div>
                                <?php endif ?>
                                <?php if ($_SESSION['id'] == $profil['id_user']): ?>
                                <div class="col-md">
                                    <label class="labels">Photo</label>
                                    <input type="file" name="photo-p" class="form-control">                        
                                </div>
                                <?php endif ?>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md">
                                    <label class="labels">Pays</label>
                                    <?php if ($_SESSION['id'] == $profil['id_user']): ?>
                                        <input type="text" name="pays-p" class="form-control" placeholder="Pays" value="<?= $profil['pays'] ?>">
                                    <?php else : ?>
                                        <input type="text" class="form-control" placeholder="Pays" value="<?= $profil['pays'] ?>" disabled>
                                    <?php endif ?>
                                </div>
                                <div class="col-md">
                                    <label class="labels">Ville</label>
                                    <?php if ($_SESSION['id'] == $profil['id_user']): ?>
                                        <input type="text" name="ville-p" class="form-control" placeholder="Ville" value="<?= $profil['ville'] ?>">
                                    <?php else : ?>
                                        <input type="text" class="form-control" placeholder="Ville" value="<?= $profil['ville'] ?>" disabled>
                                    <?php endif ?>
                                </div>
                                <?php if ($_SESSION['id'] == $profil['id_user']): ?>
                                <div class="col-md">
                                    <label class="labels">Adresse e-mail</label>
                                    <input type="email" name="email-p" class="form-control" placeholder="email" value="<?= $profil['email'] ?>">                        
                                </div>
                                <?php endif ?>
                            </div>
                            <?php if ($_SESSION['id'] == $profil['id_user']): ?>
                                <div class="col-md-12 mt-3 d-grid">
                                    <input type="submit" class="btn btn-dark" value="Modifier le profil">
                                </div>
                            <?php endif ?>
                            
                        </div>
                    </div>
                </form>
                <hr style="margin: 3rem auto; width : 100%">
            </div>
            <div class="col-md-12 px-3">
                <h6 class="display-6 mb-5 text-center"><strong>APERCU DES LOCATIONS DU PROFIL</strong></h1>
                <?php if(count($locations) > 0): ?>
                    <div class="row container-fluid pb-4">
                        <?php for ($i = 0; $i < count($locations); $i++): ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
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
                                            <div class="col-5 d-flex justify-content-end">
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
                    </div>
                <?php else: ?>
                    <div class="row container-fluid">
                        <div class="col-12">
                            <p>Il n'y a aucun logement posté par cette utilisateur !</p>
                        </div>
                    </div>
                <?php endif ?>
                <hr style="margin: 3rem auto; width : 100%">
                </div>
            <div class="col-md-12 px-3">
                <?php if ($_SESSION['id'] != $profil['id_user']): ?>
                    <div class="px-3">
                        <h4 class="text-right">Ajouter un commentaire :</h4> 
                        <form id="form-commentaire" action="?page=note&action=send&id_user_note=<?= $profil['id_user']?>" method="post">
                            <textarea name="ta-note" id="ta-note" class="form-control" style="width: 100%; resize: none" rows="5"></textarea>
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
                    </div>
                    <hr style="margin: 3rem auto; width : 100%">
                <?php endif ?>
                    <h4 class="text-right px-3">Commentaires :</h4> 
                    <?php if(count($notes) > 0): ?>
                        <?php foreach ($notes as $note): ?>
                            <div class="col-12 my-4">
                                <div class="px-3">
                                    <textarea name="ta-note" id="ta-note" class="form-control" style="width: 100%; resize: none" disabled rows="5"><?= $note['commentaire'] ?></textarea>
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
                                                <img class="rounded-circle" width="30" height="30" style="margin-right: 0.25rem" src="uploads/users/<?= $note['id_user_noteur'] ?>/<?= $note['photo'] ?>">
                                            <?php endif ?>
                                            <?= $note['firstname'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else : ?>
                        <?php if ($_SESSION['id'] != $profil['id_user']): ?>
                            <div class="p-3">Il n'y a aucun commentaire sur ce profil !</div>
                        <?php else : ?>
                            <div class="p-3">Il n'y a aucun commentaire sur vous !</div>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>