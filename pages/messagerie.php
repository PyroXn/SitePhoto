<?php

function menu() {
    include_once 'sql/messagerie.sql.php';
    $contenu = '<div id="menu_gauche">
                    <a href="index.php?p=profil&id=' . $_SESSION['user']->getId() . '" alt="Mon profil"><img class="photo_article" src="' . $_SESSION['user']->getAvatar() . '" alt="' . $_SESSION['user']->getPseudo() . '"></img></a>';
    $contenu .= '<ul>
                                <li><a href="index.php?p=messagerie" title="Boite de reception">Boite de réception</a></li>
                                <li><a href="index.php?p=nouveauMessage" title="Nouveau message">Nouveau message</a></li>
                            </ul></div>';
    return $contenu;
}

function messagerie() {
    if (!isOk()) {
        accessForbidden();
    }
    include_once 'pages/profil.php';
    include_once 'sql/membre.sql.php';
    $title = 'Pixels Arts - Messagerie : Accueil';
    $contenu = menu();
    $contenu .= '<h1>Messagerie</h1>';

    $user = $_SESSION['user'];
    $messagesRecus = getMessagesRecus($user->getId());
    if ($messagesRecus != null) {
        $contenu .= '<ul>';
        foreach ($messagesRecus as $messageRecus) {
            $membre = loadMembre($messageRecus->getExpediteur());
            $contenu .= '<li class="messagerie">
                                    <img src="thumb.php?src=' . $membre->getAvatar() . '&x=50&y=31&f=0" alt="' . $membre->getPseudo() . '"></img>
                                   <span class="objetMessagerie"> ' . $messageRecus->getSujet() . '</span>
                                   <span class="messagerie">' . substr($messageRecus->getMessage(), 0, 30) . '</span>
                                   <span class="dateMessage">' . $messageRecus->getTimestamp() . '</span>
                               </li>';
        }
        $contenu .= '</ul>';
    }
    $contenu .= mosaique();
    display($title, $contenu);
}

function nouveauMessage() {
    $title = 'Pixels Arts - Envoyer un message';
    $contenu = '<h1>Envoyer un nouveau message</h1>
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

    $contenu .= mosaique();
    display($title, $contenu);
}

//    /*MESSAGE ENVOYES*/
//    $messagesEnvoyes = getMessagesEnvoyes($user->getId());
//    $contenu .= '<ul>';
//    if ($messagesEnvoyes != null) {
//        foreach($messagesEnvoyes as $messageEnvoyes){
//            if ($messageEnvoyes->getEtat() == 1) {
//                $contenu .= '<li class="new_message">';
//            } else {
//                $contenu .= '<li class="message">';
//            }
//            $contenu .= $messageEnvoyes->getDestinataire()->getPseudoFormat().' '.$messageEnvoyes->getSujet().' '.$messageEnvoyes->getTimestamp().'</li>';
//        }
//    }
//    $contenu .= '</ul>';
//    
//    
//    
//    
//    
//    /*FORMULAIRE*/
//    $contenu .= '
//        <form id="formulaire_type" action="#" method="post">
//            <fieldset>
//                <label for="destinataire">A: </label>
//                <input type="text" id="destinataire" name="destinataire"/>
//                
//                <label for="sujet">Sujet: </label>
//                <input type="text" id="sujet" name="sujet"/>
//                
//                <label for="message">Message: </label>
//                <textarea id="message"></textarea>
//                
//                <input type="submit" value="Envoyer"/>
//            </fieldset>
//	</form>';
//    
//    $contenu .= mosaique();
//    display($title,$contenu);
?>
