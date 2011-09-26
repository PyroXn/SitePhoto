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
?>
