<?php
/**
 *
 * @param int $idMembre id du membre
 * @return TabAlbums Retourne une collection d'album 
 */
function getAlbums($idMembre) {
    $tabAlbums = array();
    $sql = 'SELECT * FROM albums WHERE idMembres="'.$idMembre.'" ORDER BY titre';
    $req = mysql_query($sql);
    
    if(mysql_num_rows($req) > 0) {
        while ($data = mysql_fetch_assoc($req)) {
            $tabAlbums[] = new Album($data['id'],$data['titre'], $data['idMembres']);
        }
        return $tabAlbums;
    }
    else {
        return null;
    }
}

/**
 *
 * @param type $idAlbum
 * @return Album Retourne l'album dont on passe l'id
 */
function getThisAlbum($idAlbum) {
    $sql = 'SELECT * FROM albums WHERE id="'.$idAlbum.'"';
    $req = mysql_query($sql);
    $data = mysql_fetch_assoc($req);
    $album = new Album($data['id'],$data['titre'],$data['idMembres']);
    return $album;
}

/**
 *
 * @param int $idMembre id du membre 
 * @return int Retourne le nombre d'album
 */
function getNbAlbums($idMembre) {
    $sql = 'SELECT * FROM albums WHERE idMembres="'.$idMembre.'"';
    $req = mysql_query($sql);
    return mysql_num_rows($req);
}

function albumDefaut($idMembre) {
    $sql = 'INSERT INTO albums(titre,idMembres) VALUES ("defaut","'.$idMembre.'")';
    $req = mysql_query($sql);
}

function addAlbum(Album $album) {
    $sql = 'INSERT INTO albums (titre,idMembres) VALUES ("'.$album->getTitre().'","'.$album->getIdMembres().'")';
    $req = mysql_query($sql);
}

function loadAlbum() {
    // Affichage des ...
    echo '<option value="">...</option>';
    $sql = 'SELECT * FROM albums WHERE idMembres="'.$_SESSION['user']->getId().'" ORDER BY titre';
    $req = mysql_query($sql);
    while($data = mysql_fetch_assoc($req)) {
        $album = new Album($data['id'],$data['titre'],$data['idMembres']);
        echo '<option value="'.$album->getId().'">'.$album->getTitre().'</option>';
    }
}
?>
