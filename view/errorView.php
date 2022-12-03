<?php $title = 'Erreur' ?>
<?php $style = '' ?>
<?php $script = '' ?>
<?php ob_start(); ?>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col text-center">
                <div class="d-flex justify-content-center">
                    <span class="text-red">Erreur :</span>&nbsp;
                    <span><?= $e->getMessage() ?></span> <!-- Par exemple ici, on a une fonction de base des Exceptions qui est getMessage(), donc on affiche la valeur de e qui récupère les données de getMessage() -->
                </div>
                <button class="btn btn-dark mt-3" onclick="history.back()">Précédent</button>
            </div>    
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>