<?php

function addVue($id) {
    $sql = 'UPDATE images SET view = view + 1 WHERE id = "'.$id.'"';
    $req = mysql_query($sql);
}

function view(Image $image) {
    $now_Y = date("Y");
    $now_m = date("m");
    $now_d = date("d");
    $now = "$now_d-$now_m-$now_Y";
    
    // On efface les anciennes IP
    $sql = 'DELETE FROM vue WHERE date != "'.$now.'" AND idImage = "'.$image->getId().'"';
    $req = mysql_query($sql);
    
    // On regarde si l'ip est déjà enregistrée
    $sql = 'SELECT * FROM vue WHERE ip="'.$_SERVER['SERVER_ADDR'].'" AND idImage = "'.$image->getId().'"';
    $req = mysql_query($sql);
    $data = @mysql_fetch_assoc($req);
    if($data['ip'] != $_SERVER['SERVER_ADDR']) {
        addVue($image->getId());
        // On ajoute l'ip pour la journée
        $sql = 'INSERT INTO vue (date,ip,idImage) VALUES ("'.$now.'","'.$_SERVER['SERVER_ADDR'].'","'.$image->getId().'")';
        $req = mysql_query($sql);
    }
}
?>
