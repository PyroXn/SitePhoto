<?php

function registerImage(Image $img) {
    $sql = 'INSERT INTO images(url,titre,description,idMembres,idAlbum,Idconcours) VALUES ("' . $img->getUrl() . '", "' . $img->getTitre() . '", "' . $img->getDescription() . '","' . $img->getIdMembre() . '","' . $img->getIdAlbum() . '","' . $img->getIdConcour() . '")';
    $req = mysql_query($sql);
}

function loadImage($id) {
    $sql = 'SELECT * FROM images WHERE id = "'.$id.'"';
    $req = mysql_query($sql);
    $data = mysql_fetch_assoc($req);
    $image = new Image($data['url']);
    $image->setDescription($data['description']);
    $image->setId($data['id']);
    $image->setIdAlbum($data['idAlbum']);
    $image->setIdConcour($data['idConcours']);
    $image->setIdMembre($data['idMembres']);
    $image->setScore($data['score']);
    $image->setView($data['view']);
    $image->setTitre($data['titre']);
    return $image;
}

function voteImage($vote, $idImage) {
    if ($vote == "1") {
        $sql = 'UPDATE images SET score = score + 1 WHERE id ="' . $idImage . '"';
    } else {
        $sql = 'UPDATE images SET score = score - 1 WHERE id ="' . $idImage . '"';
    }
    $req = mysql_query($sql);
}

function score(Image $image,$vote) {
    $now_Y = date("Y");
    $now_m = date("m");
    $now_d = date("d");
    $now = "$now_d-$now_m-$now_Y";
    
    // On efface les anciens votes
    $sql = 'DELETE FROM vote WHERE date != "'.$now.'" AND idImage = "'.$image->getId().'"';
    $req = mysql_query($sql);
    
    // On regarde si le vote journalié est déjà enregistré
    $sql = 'SELECT * FROM vote WHERE date="'.$now.'" AND idImage = "'.$image->getId().'" AND idMembre = "'.$_SESSION['user']->getId().'"';
    $req = mysql_query($sql);
    if(mysql_num_rows($req) < 1) {
        // On ajoute l'ip pour la journée
        $sql = 'INSERT INTO vote (date,idImage,idMembre,vote) VALUES ("'.$now.'","'.$image->getId().'","'.$_SESSION['user']->getId().'","'.$vote.'")';
        $req = mysql_query($sql);
    }
}

/**
 * Permet de retourner un tableau d'image des 6 dernières images de l'user
 */
function getLastImage($idMembre) {
    $tabImage = array();
    $sql = 'SELECT * FROM images WHERE idMembres ="'.$idMembre.'" ORDER BY id DESC LIMIT 6';
    $req = mysql_query($sql);
    while($data = mysql_fetch_assoc($req)) {
        $image = new Image($data['url']);
        $image->setDescription($data['description']);
        $image->setTitre($data['titre']);
        $image->setId($data['id']);
        $image->setIdAlbum($data['idAlbum']);
        $image->setIdConcour($data['idConcours']);
        $image->setIdMembre($data['idMembres']);
        $image->setScore($data['score']);
        $image->setView($data['view']);
        $tabImage[] = $image;
    }
    return $tabImage;
}

/**
 * Permet de retourner des photos de galerie
 */
function getImageGalerie() {
    $tabImage = array();
    $sql = 'SELECT * FROM images WHERE idConcours=0 ORDER BY RAND() LIMIT 6';
    $req = mysql_query($sql);
    while($data = mysql_fetch_assoc($req)) {
        $image = new Image($data['url']);
        $image->setTitre($data['titre']);
        $image->setId($data['id']);
        $tabImage[] = $image;
    }
    return $tabImage;
}

function vote() {
    if(!isOk()) {
        accessForbidden();
    }
    
    $vote = $_POST['vote'];
    $idImage = $_POST['id'];
    
    $image = loadImage($idImage);
    $now_Y = date("Y");
    $now_m = date("m");
    $now_d = date("d");
    $now = "$now_d-$now_m-$now_Y";
    
    // On efface les anciens votes
    $sql = 'DELETE FROM vote WHERE date != "'.$now.'" AND idImage = "'.$image->getId().'"';
    $req = mysql_query($sql);

    // On regarde si le vote journalié est déjà enregistré
    $sql = 'SELECT * FROM vote WHERE date="'.$now.'" AND idImage = "'.$image->getId().'" AND idMembre = "'.$_SESSION['user']->getId().'"';
    $req = mysql_query($sql);
    $nb = mysql_num_rows($req);

    if($nb < 1) {
        // On ajoute l'ip pour la journée
        $sql = 'INSERT INTO vote (date,idImage,idMembre,vote) VALUES ("'.$now.'","'.$image->getId().'","'.$_SESSION['user']->getId().'","'.$vote.'")';
        $req = mysql_query($sql);
        voteImage($vote, $idImage);
    }
}

function isMyImage($id) {
    $sql = 'SELECT * FROM images WHERE id="'.$id.'" AND idMembres="'.$_SESSION['user']->getId().'"';
    $req = mysql_query($sql);
    return mysql_num_rows($req);
    
}

function delImage($id) {
    $sql = 'DELETE FROM images WHERE id="'.$id.'"';
    $sql2 = 'DELETE FROM commentaire WHERE idImage="'.$id.'"';
    $req = mysql_query($sql);
    $req2 = mysql_query($sql2);
}
?>