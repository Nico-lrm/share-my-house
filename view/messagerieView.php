<?php $title = 'Messagerie' ?>
<?php $style = '' ?>
<?php $script = '<script src="public/js/messagerie.js"></script>' ?>
<?php ob_start(); ?>
    <div class="container my-3" >
        <div class="row bg-white" style="border: 1px solid white;">
            <div class="col-12 p-0">
                <strong>
                    <p style="background-color: #1f1f1fd9; color: white; padding: 2rem 0; border-radius: 0.25rem 0.25rem 0 0" class="text-center m-0">
                        Messagerie
                    </p>
                </strong>
            </div>
            <div class="col-12" >
                <div class="row" style="height:650px">
                    <div class="col-md-3" style="border-right: 1px solid #CCC">  
                        <div id="main-conversation"></div>
                    </div>
                    <div class="col-md-9 p-0 d-flex flex-column justify-content-between">
                        <div id="main-message" style="overflow-y: scroll; overflow-x: hidden; max-height: 500px;" class="h-75"></div>
                        <form id="form-msg" class="d-none">
                            <textarea style="border-radius: 0px !important; resize:none; border-left: none" name="ta-msg" id="ta-msg" class="form-control w-100" rows="5"></textarea>
                            <input style="border-radius: 0px !important" type="submit" class="btn btn-dark" value="Envoyer" />
                            <div class="d-flex align-items-center btn btn-secondary" onclick="refreshMessage()">Rafraîchir</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            //Redéfinition de onload pour gérer les conversations & les messages
            var documentHeight = $(document).height()
            var windowHeight = $(window).height()
            if(documentHeight <= windowHeight) {
                $("#footer").toggleClass("fixed-bottom")
            }
            console.log(<?= $_SESSION['id'] ?>)
            getConversationList(<?= $_SESSION['id'] ?>)
            <?php if(isset($_GET['id_dest'])): ?>
                getMessage(<?= $id ?>, <?= $_SESSION['id'] ?>)
            <?php endif ?>
        }
    </script>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
