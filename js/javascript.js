function checkMailInscription() {
    var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    if (document.formInscription.mail.value == "" || !reg.test(document.formInscription.mail.value)) {
        document.getElementById("checkMail").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("checkMail").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}

function checkMail2Inscription() {
    var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    if (document.formInscription.mail2.value != document.formInscription.mail.value || document.formInscription.mail2.value == "" || !reg.test(document.formInscription.mail2.value)) {
        document.getElementById("checkMail2").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("checkMail2").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}

function checkPasswordInscription() {
    if (document.formInscription.password.value == "" || document.formInscription.password.value.length < 6) {
        document.getElementById("checkPassword").innerHTML = "<img src='templates/images/check-rouge.png' class='noBorder'>";
    }
    else {
        document.getElementById("checkPassword").innerHTML = "<img src='templates/images/check-vert.png' class='noBorder'>";
    }
}

function checkPassword2Inscription() {
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
    
    if (mail == rouge || mail2 == rouge || password == rouge || password2 == rouge || birthday == rouge || pseudo == rouge) {
        alert("Merci de bien vouloir corriger le formulaire.");
    }
    else {
        document.formInscription.submit();
        
    }
    
}