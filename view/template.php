<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?> - ShareMyHouse</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="public/css/style.css">
        <?= $style ?>
        <script src="public/js/script.js"></script>
    </head>
    <body class="bg-light">
        <header>
            <nav class="navbar navbar-dark bg-dark navbar-expand-lg px-sm-4">
                <div class="container-fluid m-auto">
                    <a class="navbar-brand" href="?page=home">ShareMyHouse</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar" aria-controls="menuNavbar" aria-expanded="false" aria-label="Afficher le menu">>
                        <span class="navbar-toggle-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="menuNavbar">
                        <ul class="navbar-nav align-items-lg-center">
                            <li class="nav-item">   
                                <a href="?page=home" class="nav-link"><i class="bi bi-house-fill"></i>Accueil</a>
                            </li>
                            <?php if(isset($_SESSION["loggedin"])):?>
                            <li class="nav-item">   
                                <a href="?page=locations&action=list" class="nav-link"><i class="bi bi-card-list"></i>Liste des locations</a>
                            </li>
                            <li class="nav-item">   
                                <a href="#sidebarMenu" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" class="nav-link">
                                    <?php if($_SESSION["photo"] != NULL):?>
                                        <img src="uploads/users/<?= $_SESSION['id'] ?>/<?= $_SESSION['photo'] ?>" style="border-radius:50%; margin-right:0.125rem; width:30px; height: 30px;" alt="">
                                    <?php else : ?>
                                        <img src="https://via.placeholder.com/30" class="rounded-circle" style="margin-right:0.125rem; width:30px; height: 30px;" alt="">   
                                    <?php endif ?>
                                    <?= $_SESSION['prenom'] ?>
                                </a>
                            </li>
                            <?php else: ?>
                            <li class="nav-item">
                                <a href="#modalConnexion" class="nav-link" data-bs-toggle="modal"><i class="bi bi-person-fill"></i>Connexion</a>
                            </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php if(!isset($_SESSION["loggedin"])) :?>
                <!-- Modal de connexion-->
                <div class="modal fade" id="modalConnexion" tabindex="-1" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Connexion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="?page=signin" method="post" id="form-si">
                                        <div class="mb-2">
                                            <label for="email-si" class="form-label">Adresse e-mail</label>
                                            <input type="email" class="form-control" id="email-si" name="email-si" required>
                                            <div class="invalid-feedback">Adresse e-mail incorrecte</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="password-si" class="form-label">Mot de passe</label>
                                            <input type="password" class="form-control" id="password-si" name="password-si" required>
                                            <div class="invalid-feedback">Taille de mot de passe incorrecte</div>
                                        </div>
                                        <button id="button-si" type="submit" class="btn-form btn btn-dark mt-3">
                                            <span id="spinner-si" class="spinner-grow hidden"></span>
                                            <span id="button-text-si">Se connecter</span>
                                        </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a href="" data-bs-target="#modalInscription" data-bs-toggle="modal">Créer son compte</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal d'inscription -->
                <div class="modal fade" id="modalInscription" tabindex="-1" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Créer son compte</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="?page=signup" method="post" id="form-su" enctype="multipart/form-data">
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="firstname-su" class="form-label">Prénom</label>
                                                <input type="text" class="form-control" id="firstname-su" name="firstname-su" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="name-su" class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="name-su" name="name-su" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2">
                                                <label for="birthday-su" class="form-label">Date de naissance</label>
                                                <input type="date" class="form-control" id="birthday-su" name="birthday-su" required>
                                                <div class="invalid-feedback">Il faut avoir au moins 18 ans pour pouvoir accéder au site</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="email-su" class="form-label">Adresse e-mail</label>
                                                <input type="text" class="form-control" id="email-su" name="email-su" required>
                                                <div class="invalid-feedback">Adresse e-mail incorrecte</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="pays-su" class="form-label">Pays</label>
                                                <input type="text" class="form-control" id="pays-su" name="pays-su" required>
                                                <div class="invalid-feedback" id="pays-su-i-fb">Champ incomplet</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="ville-su" class="form-label">Ville</label>
                                                <input type="text" class="form-control" id="ville-su" name="ville-su" required>
                                                <div class="invalid-feedback" id="ville-su-i-fb">Champ incomplet</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="password-su" class="form-label">Mot de passe</label>
                                                <input type="password" class="form-control" id="password-su" name="password-su" required>
                                                <div class="invalid-feedback" id="password-su-i-fb">Mot de passe incorrect</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="confirm-password-su" class="form-label">Confirmation Mot de passe</label>
                                                <input type="password" class="form-control" id="confirm-password-su" name="confirm-password-su" required>
                                                <div class="invalid-feedback" id="password-su-i-fb">Les mots de passes ne correspondent pas</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="photo-user" class="form-label">Photo utilisateur</label>
                                                <input type="file" class="form-control" name="photo-user" id="photo-user">
                                            </div>
                                        </div>
                                    </div>
                                    <button id="button-su" type="submit" class="btn-form btn btn-dark">
                                        <span id="spinner-su" class="spinner-grow hidden"></span>
                                        <span id="button-text-su">Créer son compte</span>
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a href="" data-bs-target="#modalConnexion" data-bs-toggle="modal">Se connecter</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>                   
                <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabel">Menu</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="row mb-5">
                            <div class="offset-1 col-lg-4">
                                <?php if($_SESSION['photo'] != null): ?>
                                    <img width="100" height="100" class="rounded-circle" src="uploads/users/<?= $_SESSION['id'] ?>/<?= $_SESSION['photo'] ?>" alt="">
                                <?php else: ?>
                                    <img width="100" height="100" class="rounded-circle" src="https://via.placeholder.com/150" alt="">
                                <?php endif ?>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center">
                                <span style="font-size: 24px">
                                    <?= $_SESSION['prenom'] ?>
                                </span>
                            </div>
                        </div>
                        <a href="?page=rental" class="nav-link">Mes locations</a>
                        <a href="?page=booked" class="nav-link">Mes réservations</a>
                        <a href="?page=messagerie" class="nav-link">Messagerie</a>
                        <a href="?page=profil&id=<?= $_SESSION['id'] ?>" class="nav-link">Mon profil</a>
                        <a href="?page=dc" class="nav-link">Déconnexion</a>
                    </div>
                </div>
            <?php endif ?>
        </header>
        <!-- Contenu principal, chargés dynamiquement via PHP -->
        <main>  
            <?= $content ?>
        </main>
        <!-- Pied de page -->
        <footer id="footer" class="bg-dark">
        </footer>   
        <?php if(!isset($_SESSION["loggedin"])):?>
            <script src="public/js/login.js"></script>
            <script src="public/js/signup.js"></script>
        <?php endif ?>
        <noscript>Mec faut du js</noscript>
        <?= $script ?>
    </body>
</html>