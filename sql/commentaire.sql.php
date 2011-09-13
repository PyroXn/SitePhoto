<?php
    /**
     *
     * @param int $idImage Id de l'image dont on sort les comments
     * @return Commentaire Retourne l'objet commentaire
     */
    function getComments($idImage) {
        $sql = "SELECT * FROM commentaires WHERE idImage='".$idImage."' ORDER BY id DESC";
        $req = mysql_query($sql);
        $i = 0;
        while($data = mysql_fetch_assoc($req)) {
            $comments[$i] = new Commentaire($data['idMembres'],$data['message'],$data['timestamp'],$data['idImage']);
            $comments[$i]->setId($data['id']);
        }
        return $comments;
    }
    
    /**
     * Permet d'insérer un nouveau commentaire
     */
    function submit(Commentaire $commentaire) {
        $sql = "INSERT INTO commentaires(idMembre,message,timestamp,idPhoto) VALUES ('" . $commentaire->getIdMembre() . "','" . $commentaire->getMessage() . "','" . $commentaire->getTimeStamp() . "','" . $commentaire->getIdPhoto() . "')";
        $req = mysql_query($sql);
    }

?>
