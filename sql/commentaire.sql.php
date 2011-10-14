<?php

/**
 *
 * @param int $idImage Id de l'image dont on sort les comments
 * @return Commentaire Retourne l'objet commentaire
 */
function getComments($idImage) {
    $p = 1;
    if (isset($_GET['page'])) {
        $p = $_GET['page'];
    }
    $nbComments = getNbComments($idImage);
    $firstComment = ($p - 1) * $_SESSION['nbParPage'];
    $comments = array();
    $sql = 'SELECT * FROM commentaire WHERE idImage="' . $idImage . '" ORDER BY id ASC LIMIT ' . $firstComment . ', ' . $_SESSION['nbParPage'];
    $req = mysql_query($sql);
    if (mysql_num_rows($req) > 0) {
        while ($data = mysql_fetch_assoc($req)) {
            $commentaire = new Commentaire($data['idMembre'], $data['message'], $data['timestamp'], $data['idImage']);
            $commentaire->setId($data['id']);
            $comments[] = $commentaire;
        }
        return $comments;
    } else {
        return null;
    }
}

function ajaxLoadComments() {
    include_once 'sql/membre.sql.php';

    $p = $_POST['page'];
    $nbComments = getNbComments($_POST['idImage']);
    $firstComment = ($p - 1) * $_SESSION['nbParPage'];
    $comments = array();
    $sql = 'SELECT * FROM commentaire WHERE idImage="' . $_POST['idImage'] . '" ORDER BY id ASC LIMIT ' . $firstComment . ', ' . $_SESSION['nbParPage'];
    $req = mysql_query($sql);
    if (mysql_num_rows($req) > 0) {
        while ($data = mysql_fetch_assoc($req)) {
            $commentaire = new Commentaire($data['idMembre'], $data['message'], $data['timestamp'], $data['idImage']);
            $commentaire->setId($data['id']);
            $comments[] = $commentaire;
        }
        $contenu = '';
        foreach ($comments as $c) {
            $membre = loadMembre($c->getIdMembre());
            $contenu .= '
                <li class="comment">
                    <a href="index.php?p=profil&id=' . $membre->getId() . '"><img class="avatar" src="thumb.php?src=' . $membre->getAvatar() . '&x=37&y=50&f=0"></img></a>
                    <span class="name">' . $membre->getPseudo() . ' - <span class="message">' . $c->getMessage() . '</span></span>
                    <span class="date" title="Ajouté le ' . $c->getTimeStampFormat() . '">Posté il y a ' . $c->getTimeStampFormat() . '</span> 
                </li>';
        }
        echo $contenu;
    }
}

function getNbComments($idImage) {
    $sql = 'SELECT COUNT(*) as nbComment FROM commentaire WHERE idImage="' . $idImage . '"';
    $req = mysql_query($sql);
    $data = mysql_fetch_assoc($req);
    return $data['nbComment'];
}

function pagination($idImage) {
    $nbComment = getNbComments($idImage);
    // calcul du nombre de page
    $nbPage = ceil($nbComment / $_SESSION['nbParPage']);
    $path = $_SERVER['PHP_SELF'];
    $file = basename($path);
    $contenu = 'Page ';
    for ($i = 1; $i <= $nbPage; $i++) {
       $contenu .= '<a class="pagination" name="'.$i.'">' . $i . '</a> ';
    }
    return $contenu;
}

/**
 * Permet d'insérer un nouveau commentaire
 */
function submit(Commentaire $commentaire) {
    $sql = "INSERT INTO commentaire(idMembre,message,idImage) VALUES ('" . $commentaire->getIdMembre() . "','" . $commentaire->getMessage() . "','" . $commentaire->getIdPhoto() . "')";
    $req = mysql_query($sql);
}

?>
