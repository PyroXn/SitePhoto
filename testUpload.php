<?php
// On inclue les class dont on a besoin
include("class/image.class.php");
include("class/resizeImage.class.php");
// On crée notre objet image
$img = new Image(null);
$img->setUrl($img->upload($_FILES['photo']));

// On a upload notre image, maintenant on redimensionne
// Destination du fichier
$dest = "pics/users/".$img->getName();
// On lui indique la largeur et il adaptera pour conserver le ratio
resizeImage::resize($img->getUrl(), $dest, 245);
// Il faut maintenant supprimer le fichier
resizeImage::deleteImage($img->getUrl());
?>
