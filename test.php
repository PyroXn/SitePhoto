<?php
session_start();
include_once 'class/connexion.class.php';
include_once 'class/albums.class.php';
$co = new Connexion();
$sql = 'SELECT * FROM albums WHERE idMembres="19"';
$req = mysql_query($sql);
while($data = mysql_fetch_assoc($req)) {
    $album = new Album($data['id'],$data['titre'],$data['idMembres']);
    echo '<option value="'.$album->getId().'">'.$album->getTitre().'</option>';
}
?>