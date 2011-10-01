$(function() {
    var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    $('#mail').keyup(function() {
        var email=$(this).val();
        if (!ck_email.test(email)) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'>");
        } else {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        }
    });
    $('#mail2').keyup(function() {
        var email = $('#mail').val();
        var email2 = $(this).val();
        if (!ck_email.test(email2) && email != email2) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'>");
        } else {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        }
    });

    $('#password').keyup(function() {
        var password=$(this).val();
        if (password.length < 6) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'>");
        } else {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
        }
    });
    $('#password2').keyup(function() {
        var password = $('#password').val();
        var password2=$(this).val();
        if (password != password2) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'>");
        } else {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
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

    $('#pseudo').keyup(function() {
        var pseudo = $(this).val();
        if (pseudo.length < 3) {
            $(this).next().show().html("<img src='templates/images/check-rouge.png' class='noBorder'>");
        } else {
            $(this).next().show().html("<img src='templates/images/check-vert.png' class='noBorder'>");
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
})

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
	document.getElementById("formAlbum").innerHTML = "Album ajouté. Actualisation...";
        setTimeout("location.reload(true);","1000");
}

