$(function() {
    var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    $('#mail').blur(function() {
        var email = $(this).val();
        var email2 = $('#mail2').val();
        if (!ck_email.test(email) && (email != "" || email == null)) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Le mail n'est pas valide");
        } else if (ck_email.test(email) && email == email2) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
            $('#mail2').next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        } else if (ck_email.test(email)) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
            if (email2 != "" || email2 == null) {
                $('#mail2').next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Les mails ne sont pas identiques");
            }
        } else {
            $(this).next().show().html("");
        }
    });
    $('#mailLog').blur(function() {
        var email = $(this).val();
        if (!ck_email.test(email) || (email == "") && (email == null)) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Le mail n'est pas valide");
        }
        else {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        }
    });
    
    $('#mail2').blur(function() {
        var email = $('#mail').val();
        var email2 = $(this).val();
        if ((!ck_email.test(email2) || email != email2) && ck_email.test(email) && (email2 != "" || email2 == null)) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Les mails ne sont pas identiques");
        } else if (ck_email.test(email2) && email == email2) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
            $('#mail').next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        } else if (!ck_email.test(email2) || email2 == "") {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Le mail n'est pas valide");
        }
        else {
            $(this).next().show().html("");
        }
    });

    $('#password').blur(function() {
        var password = $(this).val();
        var password2 =  $('#password2').val();
        if (password.length < 6 && (password != "" || password == null)) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Votre mot de passe doit contenir au minimun 6 caractères");
        } else if (password.length >= 6 && password == password2) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
            $('#password2').next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        } else if (password.length >= 6) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
            if (password2 != "" || password2 == null) {
                $('#password2').next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Les mots de passe ne sont pas identique");
            }
        } else {
            $(this).next().show().html("");
        }
    });
    
    $('#passwordLog').blur(function () {
        var password = $(this).val();
        if (password.length < 6 || password == "") {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Votre mot de passe doit contenir au minimun 6 caractères");
        }
        else {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        }
    });
    
    $('#password2').blur(function() {
        var password = $('#password').val();
        var password2 = $(this).val();
        if ((password2.length < 6 || password != password2) && password.length >= 6 && (password2 != "" || password2 == null)) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Les mots de passe ne sont pas identiques");
        } else if (password2.length >= 6 && password == password2) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
            $('#password').next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        } else if (password2.length < 6) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Votre mot de passe doit contenir au minimun 6 caractères");
        }
          else {
            $(this).next().show().html("");
        }
    });
 
    $('#sexe').blur(function() {
        var sexe = $(this).val();
        if (sexe == "") {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'>");
        } else {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        }
    });

    $('#birthyear').blur(function() {
        var birthyear = $(this).val();
        var birthmonth = $('#birthmonth').val();
        var birthday = $('#birthday').val();
        if (birthday == "" || birthmonth == "" || birthyear == "") {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'>");
        } else {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        }
    });
    $('#birthmonth').blur(function() {
        var birthmonth = $(this).val();
        var birthyear = $('#birthyear').val();
        var birthday = $('#birthday').val();
        if (birthday == "" || birthmonth == "" || birthyear == "") {
            $('#birthyear').next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'>");
        } else {
            $('#birthyear').next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        }
    });
    $('#birthday').blur(function() {
        var birthday = $(this).val();
        var birthyear = $('#birthyear').val();
        var birthmonth = $('#birthmonth').val();
        if (birthday == "" || birthmonth == "" || birthyear == "") {
            $('#birthyear').next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'>");
        } else {
            $('#birthyear').next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        }
    });

    $('#pseudo').blur(function() {
        var pseudo = $(this).val();
        if (pseudo.length < 3 && (pseudo != "" || pseudo == null)) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Votre pseudo doit contenir au minimun 3 caractères");
        } else if (pseudo.length >= 3) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        } else {
            $(this).next().show().html("");
        }
    });

    $('#submit').click(function() {
        var mail = $("#mail").val();
        var mail2 = $("#mail2").val();
        var password = $("#password").val();
        var password2 = $("#password2").val();
        var sexe = $("#sexe").val();
        var birthday = $("#birthday").val();
        var birthmonth = $("#birthmonth").val();
        var birthyear = $("#birthyear").val();
        var pseudo = $("#pseudo").val();
                    
        if(ck_email.test(mail) && (mail == mail2) && (password.length >= 6) && (password == password2) 
            && (sexe != "") && (birthday != "") && (birthmonth != "") && (birthyear != "") && (pseudo.length >= 3)) {
            submit();
        }
        return false;
    });
    
    $('#submitMail').click(function() {
        var mail = $("#mail").val();
        var mail2 = $("#mail2").val();
                    
        if(ck_email.test(mail) && (mail == mail2) && mail != "" && mail != null) {
            submit();
        }
        return false;
    });
    
    $('#submitPassword').click(function() {
        var password = $("#password").val();
        var password2 = $("#password2").val();
                    
        if(password == password2 && password != "" && password != null) {
            submit();
        }
        return false;
    });
    
    $('#submitLog').click(function () {
        var mail = $('#mailLog').val();
        var password = $('#passwordLog').val();
        if(ck_email.test(mail) && password.length >= 6) {
            submit();
        }
        return false;
    });
    
    $('#titre').blur(function() {
        var titre = $(this).val();
        if (titre.length > 17 || titre == null || titre.length < 3) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Le titre de la photo doit contenir entre 3 et 17 caractères");
        } else if (titre.length >= 3) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        } else {
            $(this).next().show().html("");
        }
    });
    
    $('#description').blur(function() {
        var desc = $(this).val();
        if (desc == null || desc.length < 20) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> La description de la photo doit contenir au minimum 20 caractères");
        } else if (desc.length >= 20) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        } else {
            $(this).next().show().html("");
        }
    });
    
    $('#submitPhoto').click(function() {
        var titre = $("#titre").val();
        var desc = $("#description").val();
        var album = $("#loadAlbum").val();
        var photo = $("#avatar").val();
                    
        if(titre != "" && titre != null && desc != "" && desc != null
            && album != "" && album != null && photo != "" && photo != null) {
            submit();
        }
        return false;
    });
    
    $('#contenu img').bind("contextmenu",function(e){  
        return false;  
    });
    
    $('#loadAlbum').blur(function() {
        var album = $(this).val();
        if (album == null || album == "") {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Merci de bien vouloir choisir un album");
        } else if (album != null) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        } else {
            $(this).next().show().html("");
        }
    });
    
    $('#formAlbum').click(function() {
        var form = '<form method="POST" name="ajoutAlbum">\n\
                    <label for="titre">Titre de l\'album</label>\n\
                    <input type="text" name="titreAl" id="titreAlbum">\n\
                    <input type="button" value="Ajouter l\'album" onclick="req_xhr(\'index.php?p=newAlbumSuccess\',\'titre=\'+titreAlbum.value+\'\')">\n\
                    </form>';
        $(this).next().show().html(form);       
    });
    
    $('#avatar').change(function() {
        var photo = $(this).val();
        if(photo == null || photo == "") {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Merci de bien vouloir choisir une photo");       
        }
        else {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        }
    });
    
    $('#submitAvatar').click(function() {
        var photo = $('#avatar').val();
        if(photo != null && photo != "") {
            submit();       
        }
        return false;
    });
    $('.pagination').click(function() {
        var page = $(this).attr('name');
        var id_image = $("#id_image").val();
        $('a#current').removeAttr("id");
        $(this).attr("id","current");
        pa = 'page='+page+'&idImage='+id_image;
        $.ajax ({
            type: "POST",
            data: pa,
            url : "index.php?p=ajaxLoadComments",
            success: function(html) {
                $(".comment").remove();
                $("ol#update").append(html);
                $("ol#update li:first").fadeIn("slow");
            }
        })
    });
    
    loadAlbum = function() {
        $.ajax ({
            url : "index.php?p=loadAlbum",
            complete : function (xhr, result)
            {
                if(result != "success") return;
                var reponse = xhr.responseText;
                $('#loadAlbum').html('');
                $('#loadAlbum').append(reponse);
            }
        });
    }
    
    $('#deletePhoto').click(function() {
        if(confirm("Êtes-vous sur de vouloir supprimer votre photo ?")) {
            return true;
        }
        return false;
    });
    
    /* $('#submitCommentaire').click(function() {
        var comm = $('#body').val();
        if(comm != null && comm != "") {
            submit();
        }
        return false;
    });*/
    /* Le code qui suit est exécuté une fois que le DOM est chargé */

    /* cette variable empêche les posts intempestifs */
    $('#commentaireFormulaire #message').click(function() {
        $('#commentaireFormulaire #message').css('height',60);
        $('#commentaireFormulaire #message').css('width',684);
    });

    /* On récupère les événements du bouton submit */
    $('#submitCommentaire').click(function() {
        if($("#message").val() != null && $("#message").val() != "") {
            var id_membre = $("#id_membre").val();
            var id_image = $("#id_image").val();
            var timestamp = $("#timestamp").val();
            var message = $("#message").val(); 
            var reg = new RegExp('[+]', 'gi');
            message = message.replace(reg, "%2B");
            var dataString = 'id_membre='+ id_membre + '&id_image=' + id_image + '&timestamp=' + timestamp + '&message=' + message;
            $("#flash").show();
            $("#flash").fadeIn(400).html('Loading Comment...');
            $.ajax ({
                type: "POST",
                url : "index.php?p=setCommentaire",
                data: dataString,
                cache: false,
                success: function(html){
                    $("ol#update").append(html);
                    $("ol#update li:last").fadeIn("slow");
                    $("#flash").hide();
                    $('#message').val('');
                    $('#message').css('height',21);
                    $('#message').css('width',530);
                }
            });
        }
        return false;
    });

});

function getXHR()
{
    var xhr = null;
	
    try
    {
        xhr = new XMLHttpRequest();
    }
    catch(e)
    {
        try
        {
            xhr = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e)
        {
            try
            {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e)
            {
                alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
                return null;
            }
        }
    }
	
    return xhr;
}

function req_xhr( page, params)
{
    var xhr = getXHR();

    xhr.onreadystatechange = function()
    {	
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
        {
            // callback(xhr.responseText);
            return 0;
        }
        if (xhr.readyState == 4 && (xhr.status == 404))
        {
            alert('Erreur 404 : Page non trouvee');
        }		
    };
	
    xhr.open("POST", page, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(params);
    document.getElementById("ajoutAlbum").innerHTML = "Album ajouté.";
    loadAlbum();
}