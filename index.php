<?php
session_start();

/*
 * TODO : Mettre en place la verification de la cle
 */
if(!isset($_GET['p'])) { $_GET['p'] = "home"; home(); }
elseif ($_GET['p'] == "inscription") { include('pages/log.php'); inscription(); }
elseif ($_GET['p'] == "inscriptionSuccess") { include('pages/log.php'); inscriptionSuccess(); }
elseif ($_GET['p'] == "checkCle") { include('pages/log.php'); checkCle(); }
elseif ($_GET['p'] == "connexion") { include('pages/log.php'); connexion(); }
elseif ($_GET['p'] == "connexionSuccess") { include('pages/log.php'); connexionSuccess(); }
elseif ($_GET['p'] == "deconnexion") { include('pages/log.php'); deconnexion(); }

/**
 * Sert à afficher la page
 * @param String $titre Titre de la page
 * @param String $contenu Contenu de la page
 */
function display($title,$contenu) {
    include("templates/haut.php");
    echo $contenu;
    include("templates/bas.php");
}

function home() {
    $title = "Bienvenue !";
    $contenu = 'Blablablabla';
    display($title,$contenu);
}
?>
