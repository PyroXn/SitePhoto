function checkMail() {
    var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    if (document.formInscription.mail.value == "" || !reg.test(document.formInscription.mail.value)) {
        document.getElementById("checkMail").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("checkMail").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}

function checkMail2() {
    var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    if (document.formInscription.mail2.value != document.formInscription.mail.value || document.formInscription.mail2.value == "" || !reg.test(document.formInscription.mail2.value)) {
        document.getElementById("checkMail2").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("checkMail2").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}

function checkPassword() {
    if (document.formInscription.password.value == "" || document.formInscription.password.value.length < 6) {
        document.getElementById("checkPassword").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("checkPassword").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}

function checkPassword2() {
    if (document.formInscription.password2.value != document.formInscription.password.value || document.formInscription.password2.value == "") {
        document.getElementById("checkPassword2").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("checkPassword2").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}

function checkBirthday() {
    if (document.formInscription.birthday.value == "" || document.formInscription.birthmonth.value == "" || document.formInscription.birthyear.value == "") {
        document.getElementById("checkBirthday").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("checkBirthday").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    } 
}

function checkPseudo() {
    if(document.formInscription.pseudo.value.length < 3) {
        document.getElementById("checkPseudo").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("checkPseudo").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}

function checkInscription() {
    var mail = document.getElementById("checkMail").innerHTML;
    var mail2 = document.getElementById("checkMail2").innerHTML;
    var password = document.getElementById("checkPassword").innerHTML;
    var password2 = document.getElementById("checkPassword2").innerHTML;
    var birthday = document.getElementById("checkBirthday").innerHTML;
    var pseudo = document.getElementById("checkPseudo").innerHTML;
    
    var rouge = "<img src=\"templates/images/check-rouge.png\" class=\"noBorder\">";
    
    checkMail();
    checkMail2();
    checkPassword();
    checkPassword2();
    checkBirthday();
    checkPseudo();
    
    if (mail == rouge || mail2 == rouge || password == rouge || password2 == rouge || birthday == rouge || pseudo == rouge) {
        alert("Merci de bien vouloir corriger le formulaire.");
    }
    else if (mail == "" || mail2 == "" || password == "" || password2 == "" || birthday == "" || pseudo == "") {
        alert("Merci de bien vouloir remplir tous les champs.");
    }
    else {
        document.formInscription.submit();
        
    }
    
}

function ouvrirPopup(page,nom,option) {
    window.open(page,nom,option);
}

function checkTitre() {
    if(document.formAjoutPhoto.titre.value.length < 3) {
        document.getElementById("titre").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("titre").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}

function checkDescription() {
    if(document.formAjoutPhoto.description.value.length < 15) {
        document.getElementById("description").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("description").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}

function checkAlbum() {
    if(document.formAjoutPhoto.album.value == "") {
        document.getElementById("album").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("album").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}

function checkPhoto() {
    if(document.formAjoutPhoto.photo.value == "") {
        document.getElementById("photo").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("photo").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}
function checkUpload() {
    
    checkTitre();
    checkDescription();
    checkAlbum();
    checkPhoto();
    
    var titre = document.getElementById("titre").innerHTML;
    var description = document.getElementById("description").innerHTML;
    var album = document.getElementById("album").innerHTML;
    var photo = document.getElementById("photo").innerHTML;
    
    var rouge = "<img src=\"templates/images/check-rouge.png\" class=\"noBorder\">";
    
    if(titre == rouge || description == rouge || album == rouge || photo == rouge) {
        alert("Merci de bien vouloir corriger le formulaire.");
    }
    else {
        document.formAjoutPhoto.submit();
        document.getElementsByName(formAjoutPhoto)[0].submit();
    }
}

