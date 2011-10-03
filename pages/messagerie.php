<?php

function messagerie() {
    if(!isOk()) {
        accessForbidden();
    }
    include_once 'pages/profil.php';
    $title = 'Pixels Arts - Messagerie : Accueil';
    $contenu = menuLeft($_SESSION['user']);
    display($title,$contenu);
    
    
}
?>
