<?php

/**
 *
 * @return type Retourne le nombre de new message
 */
function newMessage() {
    $sql = 'SELECT * FROM messagerie WHERE destinataire="'.$_SESSION['user']->getId().'" AND etat=1';
    $req = mysql_query($sql);
    if(@mysql_num_rows($req) != 0) {
    return 'Messagerie ('.mysql_num_rows($req).')';
    } else {
        return 'Messagerie';
    }
}


function getMessagesRecus($idDestinataire) {
    $sql = 'SELECT * FROM messagerie WHERE destinataire="'.$idDestinataire.'" ORDER BY id DESC';
    $req = mysql_query($sql);
    $messagesRecus = array();
    if (mysql_num_rows($req) > 0) {
        while ($data = mysql_fetch_assoc($req)) {
            $messageRecus = new Messagerie($data['id'],$data['expediteur'], $data['destinataire'], $data['sujet'], $data['message'], $data['timestamp'], $data['etat']);
            $messagesRecus[] = $messageRecus;
        }
        return $messagesRecus;
    } else {
        return null;
    }
}

function getMessagesEnvoyes($idExpediteur) {
    $sql = 'SELECT * FROM messagerie WHERE expediteur="'.$idExpediteur.'" ORDER BY id DESC';
    $req = mysql_query($sql);
    $messagesEnvoyes = array();
    if (mysql_num_rows($req) > 0) {
        while ($data = mysql_fetch_assoc($req)) {
            $messageEnvoyes = new Messagerie($data['expediteur'], $data['destinataire'], $data['sujet'], $data['message'], $data['timestamp']);
            $messagesEnvoyes[] = $messageEnvoyes;
        }
        return $messagesEnvoyes;
    } else {
        return null;
    }
}

function nomExpediteur($id) {
    $sql = 'SELECT * FROM membres WHERE id="'.$id.'"';
    $req = mysql_query($sql);
    $data = mysql_fetch_assoc($req);
    return $data['pseudo'];
}
?>
