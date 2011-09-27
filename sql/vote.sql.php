<?php

/**
 *
 * @param type $idMembre
 * @return type Return true si déjà voté
 */
function alreadyVoted($idMembre,$idPhoto) {
    $now_Y = date("Y");
    $now_m = date("m");
    $now_d = date("d");
    $now = "$now_d-$now_m-$now_Y";
    $sql = 'SELECT * FROM vote WHERE date = "'.$now.'" AND idMembre = "'.$idMembre.'" AND idImage = "'.$idPhoto.'"';
    $req = mysql_query($sql);
    
    return mysql_num_rows($req) == 1;
}

?>
