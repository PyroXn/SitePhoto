<?php

function messagerie() {
    if(!isOk()) {
        accessForbidden();
    }
    include_once 'pages/profil.php';
    $title = 'Pixels Arts - Messagerie : Accueil';
    $contenu = menuLeft($_SESSION['user']);
    $contenu .= '<h1>Messagerie</h1>';
<<<<<<< HEAD
<<<<<<< HEAD
    $contenu .= '<a href="">Nouveaux messages</a>';
    $contenu .= '<a>Reçus</a>';
    $contenu .= '<a>Envoyès</a>';
    
    
=======
>>>>>>> parent of 4988c2f... pyro
    
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
    
    
<<<<<<< HEAD
=======
    $contenu .= mosaique();
    display($title,$contenu);
>>>>>>> parent of 3d93c2d... messagerie
    
    /*MESSAGE ENVOYES*/
    $messagesEnvoyes = getMessagesEnvoyes($user->getId());
    $contenu .= '<ul>';
    if ($messagesEnvoyes != null) {
        foreach($messagesEnvoyes as $messageEnvoyes){
            if ($messageEnvoyes->getEtat() == 1) {
                $contenu .= '<li class="new_message">';
            } else {
                $contenu .= '<li class="message">';
            }
            $contenu .= $messageEnvoyes->getDestinataire()->getPseudoFormat().' '.$messageEnvoyes->getSujet().' '.$messageEnvoyes->getTimestamp().'</li>';
        }
    }
    $contenu .= '</ul>';
    
    
    
    
    
    /*FORMULAIRE*/
    $contenu .= '
        <form id="formulaire_type" action="#" method="post">
            <fieldset>
                <label for="destinataire">A: </label>
                <input type="text" id="destinataire" name="destinataire"/>
                
                <label for="sujet">Sujet: </label>
                <input type="text" id="sujet" name="sujet"/>
                
                <label for="message">Message: </label>
                <textarea id="message"></textarea>
                
                <input type="submit" value="Envoyer"/>
            </fieldset>
	</form>';
    
    
=======
>>>>>>> parent of 4988c2f... pyro
    $contenu .= mosaique();
    display($title,$contenu);
    
    
}
?>
