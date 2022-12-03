<?php $title = 'Mes locations' ?>
<?php $style = '<link rel="stylesheet" href="public/css/locations.css">' ?>
<?php $script = '<script src="public/js/rental.js"></script>' ?>
<?php $compteur = 1 ?>
<?php ob_start(); ?>
    <h6 class="display-6 my-5 text-center"><strong>AJOUTER UN BIEN</strong></h1>
    <div class="bg-dark py-5">
        <div id="addLocationForm" class="w-75 mx-auto mb-4" style="background-color: white; border-radius: 0.25rem; border: 1px solid white;">
            <strong>
                <p style="background-color: #1f1f1fd9; color: white; padding: 2rem 0; border-radius: 0.25rem 0.25rem 0 0" class="text-center">
                    Merci de référer les caractéristiques de votre bien dans les champs ci-dessous.
                </p>
            </strong>
            <form action="?page=locations&action=send" method="post" enctype="multipart/form-data">
                <div class="container-fluid py-2">
                    <div class="row">
                        <div class="col-8 mb-3">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="desc-add">Description du bien</label>
                                    <textarea name="desc-add" class="form-control" id="desc-add" style="width: 100%; resize:none;" rows="5" required></textarea>
                                    <div class="invalid-feedback">Caractères spéciaux non autorisés</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="type-add">Type de bien</label>
                                    <select class="form-select" name="type-add" id="type-add" required>
                                        <option selected value="1">Maison</option>
                                        <option value="2">Appartement</option>
                                        <option value="3">Châlets</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="pays-add">Pays</label>
                                    <input type="text" class="form-control" name="pays-add" id="pays-add" required>
                                    <div class="invalid-feedback">Caractères spéciaux non autorisés</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="titre-add">Titre</label>
                                    <input type="text" class="form-control" name="titre-add" id="titre-add" required>
                                    <div class="invalid-feedback">Caractères spéciaux non autorisés</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="ville-add">Ville</label>
                                    <input type="text" class="form-control" name="ville-add" id="ville-add" required>
                                    <div class="invalid-feedback">Caractères spéciaux non autorisés</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="cp-add">Code postal - ZIP</label>
                                    <input type="text" class="form-control" maxlength="5" name="cp-add" id="cp-add" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="lit-add">Nombre de lit(s)</label>
                                    <select class="form-select" name="lit-add" id="lit-add" required>
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="sdb-add">Nombre de salle(s) de bain</label>
                                    <select class="form-select" name="sdb-add" id="sdb-add" required>
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prix-add" class="form-label">Prix par nuit</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" min="25" max="1000" placeholder="(min : 25, max : 1000)" name="prix-add" id="prix-add" required>
                                        <span class="input-group-text">€</span>
                                        <div class="invalid-feedback">Valeur non numérique</div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="superficie-add" class="form-label">Superficie</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" min="0" placeholder="(min : 0)" name="superficie-add" id="superficie-add" required>
                                        <span class="input-group-text">m²</span>
                                        <div class="invalid-feedback">Valeur non numérique</div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 d-flex align-items-end">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="piscine-label-add" class="form-label me-2">
                                                Piscine :
                                            </label>
                                            <div id="piscine-label-add" class="d-flex align-items-center">
                                                <div class="form-check me-2">
                                                    <input type="radio" value="1" class="form-check-input" name="piscine-add" id="piscine-y-add" required>
                                                    <label class="form-check-label" for="piscine-y-add">Oui</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" value="0" class="form-check-input" name="piscine-add" id="piscine-n-add" required>
                                                    <label class="form-check-label" for="piscine-n-add">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="wifi-label-add" class="form-label me-2">
                                                Wifi :
                                            </label>
                                            <div id="wifi-label-add" class="d-flex align-items-center">
                                                <div class="form-check me-2">
                                                    <input type="radio" value="1" class="form-check-input" name="wifi-add" id="wifi-y-add" required>
                                                    <label class="form-check-label" for="wifi-y-add">Oui</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" value="0" class="form-check-input" name="wifi-add" id="wifi-n-add" required>
                                                    <label class="form-check-label" for="wifi-n-add">Non</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex pt-2">
                                <input type="submit" value="Poster l'annonce" class="btn btn-dark me-2">
                                <button onclick="history.back()" class="btn btn-danger">Annuler la saisie</button>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card h-100">
                                <div class="card-title text-center" style="background-color: #1f1f1fd9; color: white; padding: 2.5rem 0; border-radius: 0.25rem 0.25rem 0 0">
                                    <strong>Importez vos photos ici</strong>
                                </div>
                                <div class="card-text h-100" >
                                    <div class="container-fluid">
                                        <div class="row" id="file-photo-name-add">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input class="form-control text-truncate" type="file" name="file-add[]" id="file-add" multiple required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h6 class="display-6 my-5 text-center"><strong>MES LOCATIONS</strong></h1>
    <div class="container-fluid">
        <div style="overflow-x: auto;">
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th width="5%">#</th>
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
                        <th width="5%">Disponible</th>
                        <th width="10%">Supprimer l'annonce</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($locations) > 0): ?>
                        <?php foreach($locations as $location): ?>
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
                                <td id="statutVisible<?= $location['id_logement'] ?>">
                                    <?php if($location['visible'] == 1): ?>
                                        <input type="checkbox" onclick="changeVisibleRental(<?= $location['id_logement'] ?>, 0, 'statutVisible<?= $location['id_logement'] ?>')" checked="checked">
                                    <?php else : ?>
                                        <input type="checkbox" onclick="changeVisibleRental(<?= $location['id_logement'] ?>, 1, 'statutVisible<?= $location['id_logement'] ?>')">
                                    <?php endif ?>
                                </td>
                                <td>
                                    <a style="cursor: pointer" onclick="deleteLocation(<?= $location['id_logement'] ?>, '<?= $location['title'] ?>')" class="text-white text-underline">Supprimer</a>
                                </td>
                            </tr>
                            <?php $compteur++ ?>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="13">Vous n'avez pas de locations</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <p id="change-performed"></p>
            </div>
        </div>
    </div>
    <?php if(count($locations) > 0): ?>
        <h6 class="display-6 my-5 text-center"><strong>APERCU DE MES LOCATIONS</strong></h1>
        <div class="row container-fluid pb-4">
            <?php for ($i = 0; $i < count($locations); $i++): ?>
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
            <?php endfor ?>
        </div>
    <?php endif ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>