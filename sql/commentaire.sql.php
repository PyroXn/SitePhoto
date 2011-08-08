<?php
    /**
     * Permet d'insérer un nouveau commentaire
     */
    function isSubmit($membre) {
        $sql = "INSERT INTO commentaires(idMembre,message,timestamp,idPhoto) VALUES ('" . $membre->getIdMembre() . "','" . $membre->getMessage() . "','" . $membre->getTimestamp() . "','" . $membre->getIdPhoto() . "')";
        $req = mysql_query($sql);
    }

?>
