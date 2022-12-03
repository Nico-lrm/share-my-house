//On applique le même style de traitement sur le mot de passe, mais pas les même test (on va pas tester un email ici mais la longueur)
document.getElementById("desc-add").addEventListener("focusout", function(e) {
    if(document.getElementById("desc-add").value != "") {
        if( document.getElementById("desc-add").value.match(regex)) {
            if(!(document.getElementById("desc-add").classList.contains("is-valid"))) {
                document.getElementById("desc-add").classList.remove("is-invalid")
                document.getElementById("desc-add").classList.add("is-valid")
            }
        } else {
            if(!(document.getElementById("desc-add").classList.contains("is-invalid"))) {
                document.getElementById("desc-add").classList.remove("is-valid")
                document.getElementById("desc-add").classList.add("is-invalid")
            }
        }
    } else {
        if(document.getElementById("desc-add").classList.contains("is-valid")) {
            document.getElementById("desc-add").classList.remove("is-valid")
        }
        if(document.getElementById("desc-add").classList.contains("is-invalid")) {
            document.getElementById("desc-add").classList.remove("is-invalid")
        }
    }
})

//On applique le même style de traitement sur le mot de passe, mais pas les même test (on va pas tester un email ici mais la longueur)
document.getElementById("pays-add").addEventListener("focusout", function(e) {
    if(document.getElementById("pays-add").value != "") {
        if(document.getElementById("pays-add").value.match(regex)) {
            if(!(document.getElementById("pays-add").classList.contains("is-valid"))) {
                document.getElementById("pays-add").classList.remove("is-invalid")
                document.getElementById("pays-add").classList.add("is-valid")
            }
        } else {
            if(!(document.getElementById("pays-add").classList.contains("is-invalid"))) {
                document.getElementById("pays-add").classList.remove("is-valid")
                document.getElementById("pays-add").classList.add("is-invalid")
            }
        }
    } else {
        if(document.getElementById("pays-add").classList.contains("is-valid")) {
            document.getElementById("pays-add").classList.remove("is-valid")
        }
        if(document.getElementById("pays-add").classList.contains("is-invalid")) {
            document.getElementById("pays-add").classList.remove("is-invalid")
        }
    }
})

//On applique le même style de traitement sur le mot de passe, mais pas les même test (on va pas tester un email ici mais la longueur)
document.getElementById("titre-add").addEventListener("focusout", function(e) {
    if(document.getElementById("titre-add").value != "") {
        if(document.getElementById("titre-add").value.match(regex)) {
            if(!(document.getElementById("titre-add").classList.contains("is-valid"))) {
                document.getElementById("titre-add").classList.remove("is-invalid")
                document.getElementById("titre-add").classList.add("is-valid")
            }
        } else {
            if(!(document.getElementById("titre-add").classList.contains("is-invalid"))) {
                document.getElementById("titre-add").classList.remove("is-valid")
                document.getElementById("titre-add").classList.add("is-invalid")
            }
        }
    } else {
        if(document.getElementById("titre-add").classList.contains("is-valid")) {
            document.getElementById("titre-add").classList.remove("is-valid")
        }
        if(document.getElementById("titre-add").classList.contains("is-invalid")) {
            document.getElementById("titre-add").classList.remove("is-invalid")
        }
    }
})

//On applique le même style de traitement sur le mot de passe, mais pas les même test (on va pas tester un email ici mais la longueur)
document.getElementById("ville-add").addEventListener("focusout", function(e) {
    if(document.getElementById("ville-add").value != "") {
        if(document.getElementById("ville-add").value.match(regex)) {
            if(!(document.getElementById("ville-add").classList.contains("is-valid"))) {
                document.getElementById("ville-add").classList.remove("is-invalid")
                document.getElementById("ville-add").classList.add("is-valid")
            }
        } else {
            if(!(document.getElementById("ville-add").classList.contains("is-invalid"))) {
                document.getElementById("ville-add").classList.remove("is-valid")
                document.getElementById("ville-add").classList.add("is-invalid")
            }
        }
    } else {
        if(document.getElementById("ville-add").classList.contains("is-valid")) {
            document.getElementById("ville-add").classList.remove("is-valid")
        }
        if(document.getElementById("ville-add").classList.contains("is-invalid")) {
            document.getElementById("ville-add").classList.remove("is-invalid")
        }
    }
})

//On applique le même style de traitement sur le mot de passe, mais pas les même test (on va pas tester un email ici mais la longueur)
document.getElementById("superficie-add").addEventListener("focusout", function(e) {
    console.log(document.getElementById("superficie-add").value)
    if(document.getElementById("superficie-add").value != "") {
        if(!isNaN(document.getElementById("superficie-add").value)) {
            if(!(document.getElementById("superficie-add").classList.contains("is-valid"))) {
                document.getElementById("superficie-add").classList.remove("is-invalid")
                document.getElementById("superficie-add").classList.add("is-valid")
            }
        } else {
            if(!(document.getElementById("superficie-add").classList.contains("is-invalid"))) {
                document.getElementById("superficie-add").classList.remove("is-valid")
                document.getElementById("superficie-add").classList.add("is-invalid")
            }
        }
    } else {
        if(document.getElementById("superficie-add").classList.contains("is-valid")) {
            document.getElementById("superficie-add").classList.remove("is-valid")
        }
        if(document.getElementById("superficie-add").classList.contains("is-invalid")) {
            document.getElementById("superficie-add").classList.remove("is-invalid")
        }
    }
})

//On applique le même style de traitement sur le mot de passe, mais pas les même test (on va pas tester un email ici mais la longueur)
document.getElementById("prix-add").addEventListener("focusout", function(e) {
    if(document.getElementById("prix-add").value != "") {
        if(!isNaN(document.getElementById("prix-add").value)) {
            if(!(document.getElementById("prix-add").classList.contains("is-valid"))) {
                document.getElementById("prix-add").classList.remove("is-invalid")
                document.getElementById("prix-add").classList.add("is-valid")
            }
        } else {
            if(!(document.getElementById("prix-add").classList.contains("is-invalid"))) {
                document.getElementById("prix-add").classList.remove("is-valid")
                document.getElementById("prix-add").classList.add("is-invalid")
            }
        }
    } else {
        if(document.getElementById("prix-add").classList.contains("is-valid")) {
            document.getElementById("prix-add").classList.remove("is-valid")
        }
        if(document.getElementById("prix-add").classList.contains("is-invalid")) {
            document.getElementById("prix-add").classList.remove("is-invalid")
        }
    }
})

document.getElementById("file-add").addEventListener("change", function(e) {
    document.getElementById("file-photo-name-add").innerHTML = "";
    var data = document.getElementById("file-add");
    console.log(data.files)
    for(var i =0; i < data.files.length; i++) {
        document.getElementById("file-photo-name-add").innerHTML += "<div class='col-12 my-2 d-flex justify-content-between'>"+data.files.item(i).name+'</div>'
    }
})

function changeVisibleRental(id, statut, id_target) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "ajax/change-visible.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onload = function() {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('change-performed').innerText = "Vos changements ont été pris en compte";
            document.getElementById('change-performed').style.border = "1px solid green";
            if(statut == 1) {
                document.getElementById(id_target).innerHTML = '<input type="checkbox" onclick="changeVisibleRental('+id+', 0, \''+id_target+'\')" checked="checked">'
            } else {
                document.getElementById(id_target).innerHTML = '<input type="checkbox" onclick="changeVisibleRental('+id+', 1, \''+id_target+'\')">'
            }
            setTimeout(function() {
                document.getElementById('change-performed').innerText = "";
                document.getElementById('change-performed').style.border = "none";
            }, 3000)
        }
    }
    xhttp.send("id="+id+"&statut="+statut);
}

function deleteLocation(id, title) {
    if(confirm("Voulez-vous supprimer votre location '"+title+"' ?")) {
        document.location.href = "?page=locations&action=delete&id="+id
    }
}