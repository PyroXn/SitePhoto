<?php
    /**
     * Permet d'insérer un nouveau commentaire
     */
    function isSubmit(Commentaire $commentaire) {
        $sql = "INSERT INTO commentaires(idMembre,message,timestamp,idPhoto) VALUES ('" . $commentaire->getIdMembre() . "','" . $commentaire->getMessage() . "','" . $commentaire->getTimeStamp() . "','" . $commentaire->getIdPhoto() . "')";
        $req = mysql_query($sql);
    }

?>
