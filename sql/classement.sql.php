<?php

function getClassement($idImage, $idConcours) {
    $classement = array();
    $sql = 'SELECT * FROM images WHERE idConcours = "'.$idConcours.'" ORDER BY score DESC';
    $req = mysql_query($sql);
    while($data = mysql_fetch_assoc($req)) {
        $classement[] = $data['id'];
    }
    for($i = 0; $i <= count($classement);$i++) {
        if ($classement[$i] == $idImage) {
            return $i+1;
        }
    }
}

function bestScore($idConcours) {
    $tabImage = array();
    $sql = 'SELECT * FROM images WHERE idConcours = "'.$idConcours.'" ORDER BY score DESC LIMIT 6';
    $req = mysql_query($sql);
    while($data = mysql_fetch_assoc($req)) {
        $image = new Image($data['url']);
        $image->setId($data['id']);
        $image->setTitre($data['titre']);
        $tabImage[] = $image;
    }
    return $tabImage;
    
}
?>
