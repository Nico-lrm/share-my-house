//Pour changer la couleur du logo des filtres lorsque la souris survole le bouton
//Pour l'entrée
document.getElementById("btn-filtre").addEventListener(("mouseover"), function(){
    document.getElementById("test").style.color = "white"
})
//et la pour la sortie
document.getElementById("btn-filtre").addEventListener(("mouseout"), function(){
    document.getElementById("test").style.color = "black"
})

/* On charge la valeur par défaut de la range */
document.getElementById("price-range-value").innerText = document.getElementById("price-range-f").value + '€'

/* Modification de la valeur de l'affichage du prix a chaque nouvelle valeur */
document.getElementById("price-range-f").addEventListener("input", function() {
    document.getElementById("price-range-value").innerText = document.getElementById("price-range-f").value + '€'

})

var page_num = 1;
load_page(page_num)
window.addEventListener('scroll', function()  {
    if (window.scrollY + window.innerHeight > document.getElementById('main-content').offsetHeight + 80) {
        page_num = page_num + 1;
        document.getElementById('main-content').innerHTML = "";
        load_page(page_num);
    }
})


// Fonction pour le chargement en continu des éléments
function load_page(page_num) {
    var lieu = document.getElementById("lieu-f").value;
    var maison = document.getElementById("maison-f").checked;
    var appart = document.getElementById("appart-f").checked;
    var chalet = document.getElementById("chalet-f").checked    ;
    var lit = document.getElementById("lit-f").value;
    var wifi = document.getElementById("wifi-f").checked;
    var piscine = document.getElementById("piscine-f").checked;
    var sdb = document.getElementById("sdb-f").value;
    var prix = document.getElementById("price-range-f").value;

    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "ajax/infinite-scroll.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onload = function() {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('main-content').innerHTML += this.responseText;
        }
    }
    xhttp.send("page="+page_num+"&lieu="+lieu+"&maison="+maison+"&appart="+appart+"&chalet="+chalet+"&lit="+lit+"&sdb="+sdb+"&prix="+prix+"&wifi="+wifi+"&piscine="+piscine);
}

document.getElementById("button-sf").addEventListener("click", function() {
    page_num = 1;
    document.getElementById('main-content').innerHTML = "";
    load_page(page_num);
    $('#modalFilters').modal('toggle');
})

document.getElementById("button-reset-sf").addEventListener("click", function() {
    document.getElementById("lieu-f").value = "";
    document.getElementById("maison-f").checked = false;
    document.getElementById("appart-f").checked = false;
    document.getElementById("chalet-f").checked = false;
    document.getElementById("lit-f").value = 1;
    document.getElementById("wifi-f").checked = false;;
    document.getElementById("piscine-f").checked = false;;
    document.getElementById("sdb-f").value = 1;
    document.getElementById("price-range-f").value = 1000;
    page_num = 1;
    document.getElementById('main-content').innerHTML = "";
    load_page(page_num);
    $('#modalFilters').modal('toggle');

})