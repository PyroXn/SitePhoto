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
    $('#mail2').blur(function() {
        var email = $('#mail').val();
        var email2 = $(this).val();
        if ((!ck_email.test(email2) || email != email2) && ck_email.test(email) && (email2 != "" || email2 == null)) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Les mails ne sont pas identiques");
        } else if (ck_email.test(email2) && email == email2) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
            $('#mail').next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        } else {
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
    $('#password2').blur(function() {
        var password = $('#password').val();
        var password2 = $(this).val();
        if ((password2.length < 6 || password != password2) && password.length >= 6 && (password2 != "" || password2 == null)) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Les mots de passe ne sont pas identiques");
        } else if (password2.length >= 6 && password == password2) {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
            $('#password').next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        } else {
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
                    
        if(ck_email.test(mail) && (mail == mail2)) {
            submit();
        }
        return false;
    });
    
    $('#submitPassword').click(function() {
        var password = $("#password").val();
        var password2 = $("#password2").val();
                    
        if(password == password2) {
            submit();
        }
        return false;
    });
    
    $('#titre').blur(function() {
        var titre = $(this).val();
        if (titre.length > 25 || titre == null || titre.length < 3) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'> Le titre de la photo doit contenir entre 3 et 25 caractères");
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
                    
        if(titre != "" && titre != null && desc != "" && desc != null
                && album != "" && album != null) {
            submit();
        }
        return false;
    });
    
    $('#loadAlbum').mouseover(function() {
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
    });
    
    $('#loadAlbum').focus(function() {
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
    
})

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

function formAlbum() {
    form = '<form method="POST" name="ajoutAlbum">';
    form = form + '<label for="titre">Titre de l\'album</label>\n\
                   <input type="text" name="titreAl" id="titreAlbum">\n\
                   <input type="button" value="Ajouter l\'album" onclick="req_xhr(\'index.php?p=newAlbumSuccess\',\'titre=\'+titreAlbum.value+\'\')">\n\
                   </form>';
    <!--  -->
    document.getElementById("formAlbum").innerHTML = form;
}

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
	document.getElementById("formAlbum").innerHTML = "Album ajouté.";
}

