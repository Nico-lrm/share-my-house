<?php $title = 'Accueil' ?>
<?php $style = '<link rel="stylesheet" href="public/css/home.css">' ?>
<?php $script = '' ?>
<?php ob_start(); ?>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-5">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/wnR6jgnepAc" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="offset-md-1 col-md-5 d-flex flex-column justify-content-center">
                <h6 class="display-6">Partagez vos logements</h6>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci cum ducimus itaque commodi doloremque reiciendis earum ipsum iusto odit odio, harum fuga architecto quisquam id a, expedita incidunt atque est.</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequatur illo, doloribus culpa minima, repudiandae dolorem earum nemo magnam beatae, hic expedita ad sit aliquam pariatur! Incidunt veritatis ullam nemo animi?</p>
                <?php if(!isset($_SESSION['loggedin'])): ?>
                    <a href="#modalConnexion" class="btn btn-dark" data-bs-toggle="modal">Parcourir les logements</a>
                <?php else: ?>
                    <a href="?page=locations&action=list" class="btn btn-dark">Parcourir les logements</a>
                <?php endif ?>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>