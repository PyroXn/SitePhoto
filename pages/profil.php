<?php
/**
 *
 * @return Bool Retourne vrai si utilisateur est sur son profil
 */
function isMyPage($id) {
    return $_SESSION['user']->getId() == $id;
}

/**
 *
 * @param int $id id du membre à controler
 * @return Bool Retourne vrai sur l'id existe 
 */
function isRealId($id) {
    $sql = 'SELECT * FROM membres WHERE id = "'.$id.'"';
    $req = mysql_query($sql);
    $data = mysql_num_rows($req);
    return $data == 1;
}

function profil() {
    // On vérifie qu'un id est bien utilisé pour choisir le profile à afficher
    if(!isset($_GET['id']) || !isRealId($_GET['id'])) {
        accessForbidden();
    }
    
    // INCLUDES SQL
    include('sql/concours.sql.php');
    include('sql/commentaire.sql.php');
    include('sql/membre.sql.php');
    
    /* 
     * On a besoin de quoi pour cette page :
     * - Derniers concours : Ok
     * - Savoir si l'utilisateur est sur sa page : Ok
     * - Recuperer la photo du membres en fonction du dernier concours : Ok
     * - Recuperer les commentaires liés à la photo ci dessus : Ok
     * - 
     */
    $concours = lastConcour();
    $image = imageConcour($concours->getId());
    $membre = loadMembre($_GET['id']);
    $title = "Bienvenue sur la page de ".$membre->getPseudo()."";
    $contenu = '<div id="menu_gauche">
                    <img class="photo_article" src="./templates/images/img.jpeg" alt=""></img>
                    <ul>
                        <li><a title="ajouter une photo" href="index.php?p=newPhoto">Ajouter une photo</a></li>
                        <li><a title="modifier profil" href="#">Modifier mon profil</a></li>
                        <li><a title="galerie" href="#">Galerie</a></li>
                        <li><a title="messagerie" href="#">Messagerie</a></li>
                        <li><a title="statistiques" href="#">Statistiques</a></li>
                    </ul>
                </div>';
    $contenu .= '<h1>
                    Titre article
                </h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mollis orci sit amet mi egestas a tincidunt libero dignissim. Cras tincidunt rutrum sem, sit amet pharetra ante varius a. Praesent feugiat accumsan felis at dignissim. Cras nec elit vitae sapien ultrices volutpat. Nunc velit risus, volutpat ut tempus ut, tristique quis lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam eros diam, tincidunt ac hendrerit at, tempus at dolor. Fusce felis metus, imperdiet eu pellentesque sed, lacinia quis leo. Suspendisse ut ligula et magna lacinia pulvinar. Nunc lacinia enim sed elit venenatis vehicula. Praesent at massa dui. Nullam condimentum vulputate metus non euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In hac habitasse platea dictumst. Vestibulum a quam ante, sit amet fermentum orci.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mollis orci sit amet mi egestas a tincidunt libero dignissim. Cras tincidunt rutrum sem, sit amet pharetra ante varius a. Praesent feugiat accumsan felis at dignissim. Cras nec elit vitae sapien ultrices volutpat. Nunc velit risus, volutpat ut tempus ut, tristique quis lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam eros diam, tincidunt ac hendrerit at, tempus at dolor. Fusce felis metus, imperdiet eu pellentesque sed, lacinia quis leo. Suspendisse ut ligula et magna lacinia pulvinar. Nunc lacinia enim sed elit venenatis vehicula. Praesent at massa dui. Nullam condimentum vulputate metus non euismod. Vestibulum ante ipsum primis </p>
                
                <div id="img_profil">
                    <img src="" alt="photo du profil"></img>
                </div>
                <div id="colonne_gauche" class="colonne_profil">
                    <h2>
                        Dernières photos galeries
                    </h2>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                </div>
                <div class="colonne_profil">
                    <h2>
                        dernières actions
                    </h2>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                </div>';
    
    
    
    
    
    
       display($title,$contenu);   
    
    
    
}

function newPhoto() {
    if(!isOk()) {
        accessForbidden();
    }
    
    include('sql/albums.sql.php');

    $tabAlbums = array();
    
    $title = 'Pixels Arts - Ajouter une photo';
    $contenu = '<h2>Ajouter une photo à votre galerie</h2>';
    $contenu .= '<form method="POST" action="index.php?p=newPhotoSuccess" name="formAjoutPhoto" enctype="multipart/form-data">';
    $contenu .= '<p>
                 <label for="titre">Titre</label>
                 <input type="text" name="titre" onBlur="checkTitre()"><span id="titre"></span>
                 <label for="description">Description</label>
                 <textarea name="description" rows="4" cols="50" onBlur="checkDescription()"></textarea><span id="description"></span>              
                 <label for="album">Album</label>';
    if(getNbAlbums($_SESSION['user']->getId()) > 0) {
        $contenu .= '<select name="album" onBlur="checkAlbum">
                 <option value="">...</option>';
        $tabAlbums = getAlbums($_SESSION['user']->getId());
        for ($i = 0; $i < getNbAlbums($_SESSION['user']->getId()); $i++) {
            $contenu .= '<option value="'.$tabAlbums[$i]->getId().'">'.$tabAlbums[$i]->getTitre().'</option>';
        }
        $contenu .= '</select><span id="album"></span>';
    }
    else {
        $contenu .= '<a href="#" onClick="ouvrirPopup(\'index.php?p=home\',\'\',\'top=10, left=10\')">Créer un album</a><span id="album"></span>';
    }
    $contenu .= '<label for="photo">Photo : </label>
                <input type="file" name="photo" id="photo"><span id="photo"></span>
                <input class="submit" type="button" value="Partager ma Photo" onClick="checkUpload()">
                </p>
                </form>';
    display($title,$contenu);
}

function newPhotoSuccess() {
    if(!isset($_FILES['photo']) || !isOk()) {
        accessForbidden();
    }
    
    include('sql/image.sql.php');
    include('sql/albums.sql.php');
    
    $image = new Image(null);
    $album = getThisAlbum($_POST['album']);
    $dest = "./pics/".$_SESSION['user']->getPseudo()."/".$album->getTitre()."/";
    $error = $image->upload($_FILES['photo']);
    if(!is_array($error)) {
        $image->setUrl($error);
    }
    else {
        $title = 'Pixels Arts - Erreur lors de l\'upload';
        $contenu = '<h2>Erreur lors de l\'upload</h2>';
        $contenu .= '<p>Merci de bien vouloir vérifier que la photo répond aux différentes contraintes,à savoir :
                    <ul><li>- 3Mo</li><li>image</li></ul></p>';
        display($title,$contenu);
        exit();
    }
    if(is_dir($dest)) {
        if($image->getRatio() == 0) {
            $image->setUrl(resizeImage::resize($image->getUrl(), $dest, $_FILES['photo']['name'], 820));
        }
        else {
            $image->setUrl(resizeImage::resize($image->getUrl(), $dest, $_FILES['photo']['name'],0,500));
        }
        resizeImage::deleteImage($error);
        $image->setDescription($_POST['description']);
        $image->setTitre($_POST['titre']);
        $image->setIdAlbum($_POST['album']);
        $image->setIdMembre($_SESSION['user']->getId());
        registerImage($image);
        $title = 'Pixels Arts - Photo envoyé avec succès.';
        $contenu = '<h2>Photo envoyé avec succès.';
        $contenu .= '<p>Votre Photo a été envoyé avec succès</p>';
        $contenu .= mosaique();
        display($title,$contenu);
    }
    else {
        accessForbidden();
    }
}
?>
