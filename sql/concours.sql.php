<?php

/**
 *
 * @return Concours Retourne objet concours: last concours
 */
function lastConcour() {
    
    // On recherche l'id du dernier concour
    $sql = "SELECT * FROM concours ORDER BY id DESC LIMIT 1";
    $req = mysql_query($sql);
    $data = mysql_fetch_assoc($req);
    $concours = new Concours($data['titre'],$data['description']);
    $concours->setId($data['id']);
    $concours->setNbParticipant($data['nbParticipant']);
    $concours->setUrl($data['url']);
    return $concours;
}

/**
 *
 * @param int $idConcours Id du concour
 * @return Image Retourne un objet image
 */
function imageConcour($idConcours,$idMembre) {
    $sql = "SELECT * FROM images WHERE idMembres = '".$idMembre."' AND idConcours = '".$idConcours."'";
    $req = mysql_query($sql);
    $data = mysql_fetch_assoc($req);
    
    $image = new Image($data['url']);
    $image->setTitre($data['titre']);
    $image->setDescription($data['description']);
    $image->setIdMembre($data['idMembres']);
    $image->setIdAlbum($data['idAlbum']);
    $image->setIdConcour($data['idConcours']);
    $image->setScore($data['score']);
    $image->setView($data['view']);
    $image->setId($data['id']);
    
    return $image;
}

function havePhotoConcours($idConcours,$idMembre) {
    $sql = 'SELECT * FROM images WHERE idConcours="'.$idConcours.'" AND idMembres="'.$idMembre.'"';
    $req = mysql_query($sql);
    return mysql_num_rows($req);
}

function membreParticipe($idConcours) {
    $sql = "UPDATE concours SET nbParticipant=nbParticipant + 1 WHERE id='".$idConcours."'";
    $req = mysql_query($sql);
}
?>
