<?php

function messagerie() {
    if(!isOk()) {
        accessForbidden();
    }
    include_once 'pages/profil.php';
    $title = 'Pixels Arts - Messagerie : Accueil';
    $contenu = menuLeft($_SESSION['user']);
    $contenu .= '<h1>Messagerie</h1>';
    
    $user = $_SESSION['user'];
    $messagesRecus = getMessagesRecus($user->getId());
    $contenu .= '<ul>';
    if ($messagesRecus != null) {
        foreach($messagesRecus as $messageRecus){
            $contenu .= '
                <li class="message">
                    '.$user->getPseudoFormat().'
                </li>';
        }   
    }
    $contenu .= '</ul>';
    
    
    $contenu .= mosaique();
    display($title,$contenu);
    
    
}
?>
