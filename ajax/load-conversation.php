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
    function selectConversations($id) {
        $db = dbConnect();
        $conversations = $db->prepare('SELECT conversation.* FROM conversation WHERE conversation.id_user_1 = :id OR conversation.id_user_2 = :id');
        $conversations->bindParam(':id', $id);
        $conversations->execute();
        $conversations = $conversations->fetchAll(PDO::FETCH_ASSOC);
        return $conversations;
    }

    function selectUserFromConversation($id, $users) {
        $db = dbConnect();
        $listUsers = $db->prepare('SELECT user.firstname, user.photo, user.id_user FROM user WHERE id_user = :id');
        $listUsers->bindParam(':id', $id);
        $listUsers->execute();
        $listUsers = $listUsers->fetchAll(PDO::FETCH_ASSOC);

        array_push($users, $listUsers[0]);
        return $users;
    }

    //Récupérer l'ID de l'utilisateur courant
    $id = $_POST['id'];

    $users = array();
    $conversations = selectConversations($id);
    /* On récupère chaque utilisateur différent de notre profil */
    foreach($conversations as $conversation) {
        if($conversation['id_user_1'] != $id) {
            $users = selectUserFromConversation($conversation['id_user_1'], $users);
        } else {
            $users = selectUserFromConversation($conversation['id_user_2'], $users);
        }
    }
?>
<div class="row" style="overflow-x : hidden; overflow-y: auto">
    <?php for($i = 0; $i < count($users); $i++): ?>
        <div class="col-12 d-flex py-3">
            <?php if($users[$i]['photo'] != NULL): ?>
                <img class="rounded-circle me-2" style="width:30px; height: 30px;" src="uploads/users/<?= $users[$i]['id_user'] ?>/<?= $users[$i]['photo'] ?>" alt="">
            <?php else : ?>
                <img src="https://via.placeholder.com/30" class="rounded-circle me-2" style="width:30px; height: 30px;" alt="">   
            <?php endif ?>
            <a style="color: inherit; text-decoration: underline; cursor : pointer" onclick="getMessage(<?= $conversations[$i]['id_conversation'] ?>, <?= $id ?>)">
                <?= $users[$i]['firstname'] ?>
            </a>
        </div>
        <?php if($i != count($users)-1): ?>
            <hr>
        <?php endif ?>
    <?php endfor ?>
</div>