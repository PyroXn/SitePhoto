<?php
if(!isset($_GET['p'])) { $_GET['p'] = "home"; }
elseif ($_GET['p'] == "inscription") { include('pages/log.php'); inscription(); }

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
?>
