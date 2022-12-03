document.getElementById("form-commentaire").addEventListener("submit", function(e) {
    var radioValue = $('input[name="note"]:checked').val();
    var textArea = document.getElementById('ta-note').value;
    
    if(radioValue == undefined || textArea == undefined) {
        alert("L'un des champs est mal renseigne")
        e.preventDefault();
    } else {
        if(!confirm("Voulez-vous poster votre commentaire ?")) {
            e.preventDefault();
        }
    }
})