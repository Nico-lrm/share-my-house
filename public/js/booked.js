jQuery(document).ready(function() {
    var indispoList = document.getElementsByClassName("indisponible");
    if(indispoList != null) {
        $('.indisponible').popover({
           title: 'Pourquoi ?',
           trigger:'hover',
           content:'La date limite pour annuler votre réservation est dépassée, pour plus d\'informations, contactez le support.',
           placement:'left'
       });
    }
});

function deleteReservation(id, title, date_debut, date_fin) {
    if(confirm("Voulez-vous supprimer votre réservation au logement '"+title+"' du "+date_debut+" au "+date_fin+" ?")) {
        document.location.href = "?page=reservation&action=delete&id="+id
    }
}