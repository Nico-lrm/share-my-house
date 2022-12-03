/* Message */
var test = null;
var id_conv = null;
var id_user = null;

function getMessage(get_conv, get_user) {
    id_conv = get_conv;
    id_user = get_user;
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "ajax/load-message.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onload = function() {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('main-message').innerHTML = "";
            document.getElementById('main-message').innerHTML += this.responseText;
            document.getElementById('main-message').scrollTo(document.querySelector('#main-message').scrollHeight, document.querySelector('#main-message').scrollHeight)
            if(document.getElementById('form-msg').classList.contains("d-none")) {
                document.getElementById('form-msg').classList.remove("d-none")
                document.getElementById('form-msg').classList.add("d-flex")
            }
        }
    }
    xhttp.send("id_conv="+id_conv+"&id_user="+id_user);
}

function refreshMessage() {
    getConversationList(id_user);
    getMessage(id_conv, id_user);
}

function getConversationList(get_user) {
    id_user = get_user;
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "ajax/load-conversation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onload = function() {
        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('main-conversation').innerHTML = "";
            document.getElementById('main-conversation').innerHTML += this.responseText;
        }
    }
    xhttp.send("id="+id_user);
}

document.getElementById('form-msg').addEventListener("submit", function(e) {
    e.preventDefault();
    refreshMessage();
    var content = document.getElementById('ta-msg').value;
    if(content != "") {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "ajax/insert-message.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onload = function() {
            if (this.status == 200 && this.readyState == 4) {
                getConversationList(id_user);
                getMessage(id_conv, id_user);
                document.getElementById('main-message').scrollTo(document.querySelector('#main-message').scrollHeight, document.querySelector('#main-message').scrollHeight)
                document.getElementById('ta-msg').value=""
            }
        }
        xhttp.send("content="+content+"&id_conv="+id_conv+"&id_user="+id_user);
    }
})