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
    $sql = 'SELECT * FROM membres WHERE id = "' . $id . '"';
    $req = mysql_query($sql);
    $data = mysql_num_rows($req);
    return $data == 1;
}

function profil() {
    // On vérifie qu'un id est bien utilisé pour choisir le profile à afficher
    if (!isset($_GET['id']) || !isRealId($_GET['id'])) {
        accessForbidden();
    }

    // INCLUDES SQL
    include('sql/concours.sql.php');
    include('sql/commentaire.sql.php');
    include('sql/membre.sql.php');
    include('sql/vue.sql.php');
    include('sql/classement.sql.php');
    include('sql/image.sql.php');
    include('sql/vote.sql.php');

    $concours = lastConcour();
    $membre = loadMembre($_GET['id']);
    
    $title = "Bienvenue sur la page de " . $membre->getPseudo() . "";
    $contenu = '<div id="menu_gauche">
                    <img class="photo_article" src="' . $membre->getAvatar() . '" alt="' . $membre->getPseudo() . '"></img>';
    if(isMyPage($_GET['id'])) {
        $contenu .= '<ul>
                        <li><a title="ajouter une photo" href="index.php?p=newPhoto">Ajouter une photo</a></li>
                        <li><a title="galerie" href="index.php?p=getAlbum&id='.$membre->getId().'">Galerie</a></li>
                        <li><a title="modifier profil" href="#">Modifier mon profil</a></li>
                        <li><a title="messagerie" href="#">Messagerie</a></li>
                        <li><a title="statistiques" href="#">Statistiques</a></li>
                    </ul>';
    } else {
        $contenu .= '<ul>
                        <li><a title="galerie" href="index.php?p=getAlbum&id='.$membre->getId().'">Galerie</a></li>
                        <li><a title="messagerie" href="#">Contacter</a></li>
                        <li><a title="statistiques" href="#">Statistiques</a></li>
                    </ul>';
    }
    $contenu .= '</div>';
    $contenu .= '<h1>
                    Présentation
                </h1>
                <div id="presentation">
                    <span id="caracteristique_gauche">
                        <span class="type">Sexe: </span><span  class="data">'.$membre->getSexeFormat().'</span>
                    </span>
                    <span class="type">Date de naissance: </span><span class="data">'.$membre->getBirthday().'</span>
                    <span id="caracteristique_droite">
                        <span class="type">Dernière visite: </span><span class="data">'.$membre->getLastVisit().'</span>
                    </span>
                </div>
                <div id="img_profil">';
    if (havePhotoConcours($concours->getId(),$membre->getId()) == 1) {
        $image = imageConcour($concours->getId(),$membre->getId());
        view($image);
        $contenu .= '<h3>' . $image->getTitre() . '</h3>';
        $contenu .= '<img src="' . $image->getUrl() . '" title="' . $image->getTitre() . '" alt="' . $image->getTitre() . '"></img>';
        $contenu .= '<div id="statistique">
                        <img src="./templates/images/oeil.png" title="nombres de vues" alt="nombres de vues"></img><span class="res_stat">'.$image->getView().'</span>
                        <img src="./templates/images/classement.png" title="nombres de points" alt="nombres de points"></img><span class="res_stat">'.$image->getScore().'</span>
                        <img src="./templates/images/podium4.png" title="classement" alt="classement"></img><span class="res_stat">'.getClassement($image->getId(), $concours->getId()).'</span>
                        <span id="vote">';
        if(alreadyVoted($_SESSION['user']->getId(),$image->getId()) || isMyPage($_GET['id'])) {
            $contenu .= '<img src="./templates/images/positif2.png" id="positif" title="Merci d\'avoir voté." alt="Merci d\'avoir voté."></img>
                         <img src="./templates/images/negatif2.png" id="negatif" title="Merci d\'avoir voté." alt="Merci d\'avoir voté."></img>';
        }
        else {
            $contenu .= '<img src="./templates/images/positif.png" id="positif" title="vote positif" alt="vote positif" onclick="req_xhrVote(\'index.php?p=vote\',\'vote=1&id='.$image->getId().'\')"></img>
                         <img src="./templates/images/negatif.png" id="negatif" title="vote négatif" alt="vote négatif" onclick="req_xhrVote(\'index.php?p=vote\',\'vote=0&id='.$image->getId().'\')"></img>';
        }

        $contenu .= '</span>
                    </div>';
        $contenu .= '<p class="bulle_dialogue">' . $image->getDescription() . '</p>';
        
    } else {
        $contenu .= '<h3>Aucune image!</h3>';
        $contenu .= '<img src="./templates/images/photo_defaut.jpg" alt="Aucune photo pour ce concours"></img>';
    }
    // On recupère les 6 dernières images
    $listImage = array();
    $listImage = getLastImage($membre->getId());
    $contenu .= '</div>
                <hr></hr>
                <div id="colonne_gauche" class="colonne_profil">
                    <h2>
                        <a href="#" alt="Dernières photos">Dernières photos galeries</a>
                    </h2>';
    for($i = 0; $i <= count($listImage)-1;$i++) {
        $contenu .= '<a title="'.$listImage[$i]->getTitre().'" class="zoombox" href="'.$listImage[$i]->getUrl().'"><img src="thumb.php?src='.$listImage[$i]->getUrl().'&x=110&y=69&f=0"></img></a>';
    }

    // TODO : Pierre : Prevoir mise en page des dernières actions
    $contenu .= '</div>
                <div class="colonne_profil">
                    <h2>
                        <a href="#" alt="Dernières actions">Dernières actions</a>
                    </h2>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenuprofil.jpg" alt=""></img></a>
                </div>';






    display($title, $contenu);
}

function newPhoto() {
    // TODO : Mettre en place les contrôles (javascript + PhP) pour verifier que le formulaire est bien remplie
    // TODO : Améliorer mise en page
    if (!isOk()) {
        accessForbidden();
    }

    include('sql/albums.sql.php');
    include('sql/concours.sql.php');

    $concours = lastConcour();
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
    $contenu .= '<select name="album" onBlur="checkAlbum">
                 <option value="">...</option>';
    $tabAlbums = getAlbums($_SESSION['user']->getId());
    for ($i = 0; $i < getNbAlbums($_SESSION['user']->getId()); $i++) {
        $contenu .= '<option value="' . $tabAlbums[$i]->getId() . '">' . $tabAlbums[$i]->getTitre() . '</option>';
    }
    $contenu .= '</select><span id="album"></span> - <a href="#" class="createAlbum" onClick="formAlbum()">Créer un album</a><span id="formAlbum"></span>';
    $contenu .= '<label for="concours">Concours</label>';
    $concours = lastConcour();
    if (havePhotoConcours($concours->getId(),$_SESSION['user']->getId()) == 0) {
        $contenu .= '<select name="concours">
                     <option value="0">Aucun</option>
                     <option value="' . $concours->getId() . '">' . $concours->getTitre() . '</option>
                     </select>';
    } else {
        $contenu .= 'Vous avez déjà une photo.';
    }
    $contenu .= '<label for="photo">Photo : </label>
                <input type="file" name="photo" id="photo"><span id="photo"></span>
                <input class="submit" type="button" value="Partager ma Photo" onClick="checkUpload()">
                </p>
                </form>';
    display($title, $contenu);
}

function newPhotoSuccess() {
    // TODO : Terminer la page d'erreur lors de l'upload
    if (!isset($_FILES['photo']) || !isOk()) {
        accessForbidden();
    }
    $idConcour = @$_POST['concours'];
    if (!isset($_POST['concours'])) {
        $idConcour = 0;
    }
    include('sql/image.sql.php');
    include('sql/albums.sql.php');
    include('sql/concours.sql.php');

    $image = new Image(null);
    $album = getThisAlbum($_POST['album']);
    $dest = "./pics/" . $_SESSION['user']->getPseudo() . "/" . $album->getTitre() . "/";
    $error = $image->upload($_FILES['photo']);
    if (!is_array($error)) {
        $image->setUrl($error);
    } else {
        $title = 'Pixels Arts - Erreur lors de l\'upload';
        $contenu = '<h2>Erreur lors de l\'upload</h2>';
        $contenu .= '<p>Merci de bien vouloir vérifier que la photo répond aux différentes contraintes,à savoir :
                    <ul><li>- 3Mo</li><li>image</li></ul></p>';
        display($title, $contenu);
        exit();
    }
    if (is_dir($dest)) {
        if ($image->getRatio() == 0) {
            $image->setUrl(resizeImage::resize($image->getUrl(), $dest, $_FILES['photo']['name'], 820));
        } else {
            $image->setUrl(resizeImage::resize($image->getUrl(), $dest, $_FILES['photo']['name'], 0, 500));
        }
        resizeImage::deleteImage($error);
        $image->setDescription($_POST['description']);
        $image->setTitre($_POST['titre']);
        $image->setIdAlbum($_POST['album']);
        $image->setIdMembre($_SESSION['user']->getId());
        $image->setIdConcour($idConcour);
        registerImage($image);
        if ($idConcour != 0) {
            membreParticipe($idConcour);
        }
        $title = 'Pixels Arts - Photo envoyé avec succès.';
        $contenu = '<h2>Photo envoyé avec succès.';
        $contenu .= '<p>Votre Photo a été envoyé avec succès</p>';
        $contenu .= mosaique();
        display($title, $contenu);
    } else {
        accessForbidden();
    }
}

function newAlbum() {
    if(!isOk()) {
        accessForbidden();
    }
    
    $title = 'Pixels Arts - Ajouter un nouvel album';
    $contenu .= '<h2>Ajouter un album</h2>';
    $contenu .= '<form method="POST" action="index.php?p=newAlbumSuccess">
                <p>
                <label for="titre">Titre</label>
                <input type="text" name="titre">
                <input type="submit" value="Valider">
                </p></form>';
    display($title,$contenu);
}

function newAlbumSuccess() {
    if(!isOk()) {
        accessForbidden();
    }
    include('sql/albums.sql.php');
    
    $album = new Album(null,$_POST['titre'],$_SESSION['user']->getId());
    addAlbum($album);
    @mkdir('./pics/'.$_SESSION['user']->getPseudo().'/'.$album->getTitre().'');    
}

function vote() {
    if(!isOk()) {
        accessForbidden();
    }
    include('sql/image.sql.php');
    
    $vote = $_POST['vote'];
    $idImage = $_POST['id'];
    
    $image = loadImage($idImage);
    $now_Y = date("Y");
    $now_m = date("m");
    $now_d = date("d");
    $now = "$now_d-$now_m-$now_Y";
    
    // On efface les anciens votes
    $sql = 'DELETE FROM vote WHERE date != "'.$now.'" AND idImage = "'.$image->getId().'"';
    $req = mysql_query($sql);

    // On regarde si le vote journalié est déjà enregistré
    $sql = 'SELECT * FROM vote WHERE date="'.$now.'" AND idImage = "'.$image->getId().'" AND idMembre = "'.$_SESSION['user']->getId().'"';
    $req = mysql_query($sql);
    $nb = mysql_num_rows($req);

    if($nb < 1) {
        // On ajoute l'ip pour la journée
        $sql = 'INSERT INTO vote (date,idImage,idMembre,vote) VALUES ("'.$now.'","'.$image->getId().'","'.$_SESSION['user']->getId().'","'.$vote.'")';
        $req = mysql_query($sql);
        voteImage($vote, $idImage);
    }
}
?>
