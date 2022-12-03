<?php $title = 'Liste des locations' ?>
<?php $style = '<link rel="stylesheet" href="public/css/locations.css">' ?>
<?php $script = '<script src="public/js/locations.js"></script>' ?>
<?php ob_start(); ?>
    <div id="recherche" class="container-fluid gy-3 sy-sm-0 shadow-sm bg-light sticky-top">
        <div class="row px-sm-4 align-items-center">
            <div class="offset-sm-8 col-sm-4 d-flex align-items-center justify-content-sm-end justify-content-center">
                <div>
                    <a id="btn-filtre" href="#modalFilters" data-bs-toggle="modal" class="btn btn-outline-dark"><i id="test" class="bi bi-sliders"></i><span>Filtres</span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFilters" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filtres</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form-sf">
                        <div>
                            <h4 class="mb-4">Lieu</h4>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" placeholder="Ville ou pays..." class="form-control mb-4" name="lieu-f" id="lieu-f">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="py-4">
                            <h4 class="mb-4">Type de logement</h4>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input bg-dark" type="checkbox" value="1" id="maison-f">
                                        <label class="form-check-label" for="maison-f">
                                            Maison
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input bg-dark" type="checkbox" value="2" id="appart-f">
                                        <label class="form-check-label" for="appart-f">
                                            Appartement
                                        </label>
                                    </div>  
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input bg-dark" type="checkbox" value="3" id="chalet-f">
                                        <label class="form-check-label" for="chalet-f">
                                            Châlet
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="py-4">
                            <h4 class="mb-4">Lits & Salles de bain</h4>
                            <div class="row mb-2">
                                <div class="col-8">
                                    <span>Lits</span>
                                </div>
                                <div class="col-4">
                                    <select name="lit-f" id="lit-f" class="form-select">
                                        <option selected value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                        <option value="4">4+</option>
                                        <option value="5">5+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <span>Salles de bain</span>
                                </div>
                                <div class="col-4">
                                    <select name="sdb-f" id="sdb-f" class="form-select">
                                        <option selected value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                        <option value="4">4+</option>
                                        <option value="5">5+</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="py-4">
                            <h4 class="mb-4">Options</h4>
                            <div class="row mb-2">
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input bg-dark" type="checkbox" value="1" id="wifi-f">
                                        <label class="form-check-label" for="wifi-f">
                                            Wifi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input bg-dark" type="checkbox" value="2" id="piscine-f">
                                        <label class="form-check-label" for="piscine-f">
                                            Piscine
                                        </label>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="pt-4">
                            <h4 class="mb-4">Prix</h4>
                            <div class="row">
                                <div class="col-7">
                                    <input type="range" class="form-range mb-4" name="price-range-f" min="25" value="1000" max="1000" id="price-range-f">
                                </div>
                                <div class="offset-1 col-4">
                                    <div>
                                        Jusqu'à <span id="price-range-value" class="badge bg-secondary"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-between">
                    <button id="button-reset-sf" class="btn-form btn btn-dark">
                        <span id="spinner-reset-sf" class="spinner-grow hidden"></span>
                        <span id="button-reset-text-sf">Effacer</span>
                    </button>
                    <button id="button-sf" type="submit" class="btn-form btn btn-dark">
                        <span id="spinner-sf" class="spinner-grow hidden"></span>
                        <span id="button-text-sf">Appliquer les filtres</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row gy-3 mt-3 mb-3 px-sm-4" id="main-content" style="position: relative; z-index: 1;">
            <!-- Contenu chargé via AJAX -->
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>