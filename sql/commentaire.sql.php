<?php
    /**
     *
     * @param int $idImage Id de l'image dont on sort les comments
     * @return Commentaire Retourne l'objet commentaire
     */
    function getComments($idImage) {
        $comments = array();
        $sql = 'SELECT * FROM commentaire WHERE idImage="'.$idImage.'" ORDER BY id ASC';
        $req = mysql_query($sql);
        if(mysql_num_rows($req) > 0) {
            $i = 0;
            while($data = mysql_fetch_assoc($req)) {
                $comments[$i] = new Commentaire($data['idMembre'],$data['message'],$data['timestamp'],$data['idImage']);
                $comments[$i]->setId($data['id']);
                $i++;
            }
            return $comments;
        } else {
            return null;
        }
    }
    
    /**
     * Permet d'insérer un nouveau commentaire
     */
    function submit(Commentaire $commentaire) {
        $sql = "INSERT INTO commentaire(idMembre,message,timestamp,idImage) VALUES ('" . $commentaire->getIdMembre() . "','" . $commentaire->getMessage() . "',NOW(),'" . $commentaire->getIdPhoto() . "')";
        $req = mysql_query($sql);
    }

?>
