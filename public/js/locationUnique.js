//Ajoute la classe active à la première photo du carousel
var firstphoto = document.getElementsByClassName('carousel-item')
firstphoto[0].classList.add("active");

//Tableau de date déjà réservées
var dateRange = [];

//Requête AJAX pour récupérer les dates au format JSON
var xhttp = new XMLHttpRequest();
xhttp.open("POST", "ajax/date-reservation.php", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.onload = function() {
    if (this.status == 200 && this.readyState == 4) {
        var obj = JSON.parse(this.response);

        //Pour chaque date réservées
        for(i = 0; i < obj.length; i++) {
            for (var d = new Date(obj[i].date_debut); d <= new Date(obj[i].date_fin); d.setDate(d.getDate() + 1)) {
                dateRange.push($.datepicker.formatDate('dd-mm-yy', d));
            }
        }
    }
}
xhttp.send("id="+getUrlParam("id"));

//Création des datapickers - les dates déjà réservées
$('#reservation-debut-dt').datepicker({
    minDate: 1,
    dateFormat : 'dd-mm-yy',
    beforeShowDay: function (date) {
        var dateString = jQuery.datepicker.formatDate('dd-mm-yy', date);
        return [dateRange.indexOf(dateString) == -1];
    }
});
$('#reservation-fin-dt').datepicker({
    minDate: 1,
    dateFormat : 'dd-mm-yy',
    beforeShowDay: function (date) {
        var dateString = jQuery.datepicker.formatDate('dd-mm-yy', date);
        return [dateRange.indexOf(dateString) == -1];
    }
});

document.getElementById("form-reservation").addEventListener("submit", function(e) {
    if(document.getElementById("form-result").classList.contains("d-block")) {
        document.getElementById("form-result").classList.remove("d-block");
        document.getElementById("form-result").classList.add("d-none");
        document.getElementById("form-result").textContent = "";
    }
    
    date_debut = $('#reservation-debut-dt').datepicker('getDate')
    date_fin = $('#reservation-fin-dt').datepicker('getDate')
    
    if(date_debut != undefined && date_fin != undefined) {
        for(var d = new Date(date_debut); d <= new Date(date_fin); d.setDate(d.getDate() + 1)) {
            var dateString = jQuery.datepicker.formatDate('dd-mm-yy', d);
            if(dateRange.indexOf(dateString) != -1) {
                if(document.getElementById("form-result").classList.contains("d-none")) {
                    document.getElementById("form-result").classList.remove("d-none");
                    document.getElementById("form-result").classList.add("d-block");
                    document.getElementById("form-result").textContent = "La date ne peut pas être choisie";
                }
                e.preventDefault();
                return;
            }
        } 
        if(!confirm("Voulez-vous réserver ce logement du "+document.getElementById('reservation-debut-dt').value+" au "+document.getElementById('reservation-fin-dt').value+" ?")) {
            e.preventDefault();
        }
    }
})

document.getElementById("form-commentaire").addEventListener("submit", function(e) {
    var radioValue = $('input[name="note"]:checked').val();
    var textArea = $('#ta-note').val();
    
    if(radioValue == undefined || textArea == undefined) {
        alert("L'un des champs est mal renseigne");
        e.preventDefault();
    } else {
        if(!confirm("Voulez-vous poster votre commentaire ?")) {
            e.preventDefault();
        }
    }
})