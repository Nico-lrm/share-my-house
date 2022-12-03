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

    //Récupérer les informations
    $id_user = $_POST['id_user'];
    $id_conv = $_POST['id_conv'];

    $db = dbConnect();

    $messages = $db->prepare('SELECT messagerie.*, user.firstname, user.id_user user_id, user.photo FROM messagerie, user WHERE id_conversation = :id AND messagerie.id_user = user.id_user');
    $messages->bindParam(':id', $id_conv);
    $messages->execute();
?>
<?php if ($messages->rowCount() > 0): ?>
    <div class="row p-3">
        <?php foreach ($messages as $message): ?>
            <?php if($message['id_user'] == $id_user): ?>
                <div class="col-5 my-3 offset-7 d-flex flex-column justify-content-end">
                    <p class="p-3 m-0" style="border: 1px solid #ccc; border-radius: 0.25rem"><?= $message['content'] ?></p>
                    <div class="mt-2 d-flex flex-row-reverse align-items-center">
                        <?php if($message['photo'] != null): ?>
                            <img class="rounded-circle ms-2" style="width:30px; height: 30px;" src="uploads/users/<?= $message['user_id'] ?>/<?= $message['photo'] ?>" alt="">
                        <?php else: ?>  
                            <img src="https://via.placeholder.com/30" class="rounded-circle ms-2" style="width:30px; height: 30px;" alt="">   
                        <?php endif ?>
                        <small style="text-align: right; color: grey"><?= $message['firstname'] ?></small>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-5 ms-3 my-3 d-flex flex-column justify-content-start">
                    <p class="p-3 m-0" style="border: 1px solid #ccc; border-radius: 0.25rem"><?= $message['content'] ?></p>
                    <div class="mt-2 d-flex align-items-center">
                        <?php if($message['photo'] != null): ?>
                            <img class="rounded-circle me-2" style="width:30px; height: 30px;" src="uploads/users/<?= $message['user_id'] ?>/<?= $message['photo'] ?>" alt="">
                        <?php else: ?>  
                            <img src="https://via.placeholder.com/30" class="rounded-circle me-2" style="width:30px; height: 30px;" alt="">   
                        <?php endif ?>
                        <small style="text-align: left;color: grey"><?= $message['firstname'] ?></small>
                    </div>
                </div>
                <div class="offset-7"></div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
<?php else : ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-3 text-align-center">
                Aucun message trouvé avec cet utilisateur !
            </div>
        </div>
    </div>
<?php endif ?>