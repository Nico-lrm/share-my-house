//Regex
var regexEmail = /^[A-Za-z0-9._\-]+@[A-Za-z._\-]+\.[a-z]{2,4}$/;
var regex = /^[A-Za-z0-9À-ÖØ-öø-ÿ\-_&^$!°%§?"*$£,',;\.:\* /\n\t\r]+$/

//Fonction qui défini si le pied de page se colle en bas de la fenêtre 
//en fonction de la taille de celle ci par rapport au contenu (au chargement de la page)
window.onload = function() {
    var documentHeight = $(document).height()
    var windowHeight = $(window).height()
    if(documentHeight <= windowHeight) {
        $("#footer").toggleClass("fixed-bottom")
    }
}

//Merci monsieur Tomalak pour le parse d'URL (récupérer l'ID du logement pour les dates de réservations) https://stackoverflow.com/revisions/814628/3
function getUrlParam(param)
{
    param = param.replace(/([\[\](){}*?+^$.\\|])/g, "\\$1");
    var regex = new RegExp("[?&]" + param + "=([^&#]*)");
    var url   = decodeURIComponent(window.location.href);
    var match = regex.exec(url);
    return match ? match[1] : "";
}

//Fonction qui défini si le pied de page se colle en bas de la fenêtre 
//en fonction de la taille de celle ci par rapport au contenu (au resize de la fenêtre)
window.onresize = function() {
    documentHeight = $(document).height()
    windowHeight = $(window).height()
    if(documentHeight <= windowHeight) {
        if(!($("#footer").hasClass("fixed-bottom")))
        $("#footer").addClass("fixed-bottom")
    } else {
        if($("#footer").hasClass("fixed-bottom")) {
            $("#footer").removeClass("fixed-bottom")
        }
    }
}