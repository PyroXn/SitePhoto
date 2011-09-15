<?php

function registerImage(Image $img) {
    $sql = 'INSERT INTO images(url,titre,description,idMembres,idAlbum) VALUES ("'.$img->getUrl().'", "'.$img->getTitre().'", "'.$img->getDescription().'","'.$img->getIdMembre().'","'.$img->getIdAlbum().'")';
    $req = mysql_query($sql);
    
}
?>