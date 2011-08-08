<?php
function get_extension($nom) {
    $nom = explode(".", $nom);
    $nb = count($nom);
    return strtolower($nom[$nb-1]);
}

// --------------------- Options diverses //

// Extensions images autorisÃ© (pour le moment, que du jpeg)
$extensions_ok = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
// MimeType autorisÃ©
/* 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF (Ordre des octets Intel), 8 = TIFF (Ordre des octets Motorola), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF */
$typeimages_ok = array(5);

$taille_ko = 5120; // Taille en kilo octect (ko)
$taille_max = $taille_ko*1024; // En octects
$dest_dossier = 'pics/'; // Creez ce dossier et chmoodez le !
    if(isset($_FILES['photo'])) // Formulaire envoyÃ©
    {
        // Les erreurs que PHP renvoi
        if($_FILES['photo']['error'] !== "0") {
                switch ($_FILES['photo']['error']) {
                case 1:
                    $erreurs[] = "Votre image doit faire moins de $taille_ko Ko !";
                    break;
                case 2:
                    $erreurs[] = "Votre image doit faire moins de $taille_ko Ko !";
                    break;
                case 3:
                    $erreurs[] = "L'image n'a Ã©tÃ© que partiellement tÃ©lÃ©chargÃ©.";
                    break;
                case 4:
                    $erreurs[] = "Aucun fichier n'a Ã©tÃ© tÃ©lÃ©chargÃ©.";
                    break; // Pas de 5, ne pas demander pourquoi ^^ (voir doc PHP)
                case 6:
                    $erreur[] = "Un dossier temporaire est manquant.";
                    break;
                case 7:
                    $erreurs[] = "Ã‰chec de l'Ã©criture du fichier sur le disque.";
                    break;
            }
        }
        // getimagesize arrive Ã  traiter le fichier ?
        if(!$getimagesize = getimagesize($_FILES['photo']['tmp_name'])) {
            $erreurs[] = "Le fichier n'est pas une image valide.";
        }
        // on vÃ©rifie le type de l'image
        if( (!in_array( get_extension($_FILES['photo']['name']), $extensions_ok ))
           or (!in_array($getimagesize[2], $typeimages_ok )))
        {
            foreach($extensions_ok as $text) { $extensions_string .= $text.', '; }
            $erreurs[] = 'Veuillez sÃ©lectionner un fichier de type '.substr($extensions_string, 0, -2).' !';
        }
        // on vÃ©rifie le poids de l'image
        if( file_exists($_FILES['photo']['tmp_name']) 
                  and filesize($_FILES['photo']['tmp_name']) > $taille_max)
        {
            $erreurs[] = "Votre fichier doit faire moins de $taille_ko Ko !";
        }

        // copie du fichier si aucune erreur !
        if(!isset($erreurs) or empty($erreurs))
        {
            $dest_fichier = basename($_FILES['photo']['name']);
            $dest_fichier = strtr($dest_fichier, 'Ã€ÃÃ‚ÃƒÃ„Ã…Ã‡ÃˆÃ‰ÃŠÃ‹ÃŒÃÃŽÃÃ’Ã“Ã”Ã•Ã–Ã™ÃšÃ›ÃœÃÃ Ã¡Ã¢Ã£Ã¤Ã¥Ã§Ã¨Ã©ÃªÃ«Ã¬Ã­Ã®Ã¯Ã°Ã²Ã³Ã´ÃµÃ¶Ã¹ÃºÃ»Ã¼Ã½Ã¿', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            // un chtit regex pour remplacer tous ce qui n'est ni chiffre ni lettre par "_"
            $dest_fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $dest_fichier);
            
            // pour ne pas ecraser un fichier existant
            while(file_exists($dest_dossier . $dest_fichier)) {
                $dest_fichier = rand().$dest_fichier;
            }
            
            // copie du fichier
            if(move_uploaded_file($_FILES['photo']['tmp_name'], $dest_dossier . $dest_fichier)) {
                $valid[] = "Image uploadÃ© avec succÃ©s (<a href='".$dest_dossier . $dest_fichier."'>Voir</a>)";
            } else {
                $erreurs[] = "Impossible d'uploader le fichier.<br />Veuillez vÃ©rifier que le dossier ".$dest_dossier." existe avec un chmod 755 (ou 777).";
            }
        }
    }
?>

<form method="POST" action="" enctype="multipart/form-data">
<?php
if(!empty($erreurs)) {
    echo '<ul class="erreur">';
    foreach($erreurs as $erreur) {
        echo '<li>'.$erreur.'</li>';
    }
    echo '</ul>';
}
if(!empty($valid)) {
    echo '<ul class="validation">';
    foreach($valid as $text) {
        echo '<li>'.$text.'</li>';
    }
    echo '</ul>';
}

?>
    <fieldset>
    <legend>Envoi d'image</legend>
        <p>
            <label for="photo">Image : </label>
            <input type="file" name="photo" id="photo" />
        </p>
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $taille_max; ?>" />
            <input type="submit" name="envoi" value="Envoyer l'image" />
        </p>
    </fieldset>
</form>