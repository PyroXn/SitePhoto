<?php

/**
 *
 * @return type Retourne le nombre de new message
 */
function newMessage() {
    $sql = 'SELECT * FROM messagerie WHERE destinataire="'.$_SESSION['user']->getId().'" AND etat=1';
    $req = mysql_query($sql);
    if(mysql_num_rows($req) != 0) {
    return 'Messagerie ('.mysql_num_rows($req).')';
    } else {
        return 'Messagerie';
    }
}
?>
