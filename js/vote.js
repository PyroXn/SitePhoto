function getXHRVote()
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

function req_xhrVote( page, params)
{
	var xhr = getXHRVote();

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
	document.getElementById("vote").innerHTML = "Merci d'avoir voté.";
}