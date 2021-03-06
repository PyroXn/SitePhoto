<?php

/**
 *
 * @return Bool Retourne vrai si utilisateur est sur son profil
 */
function isMyPage($id) {
    if (isset($_SESSION['user'])) {
        return $_SESSION['user']->getId() == $id;
    }
    return false;
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

    $title = 'Pixels Arts - ' . $membre->getPseudo() . '';
    $contenu = menuLeft($membre);
    $contenu .= '<h1>
                    Profil de ' . $membre->getPseudo() . '
                </h1>
                <div id="presentation">
                    <span id="caracteristique_gauche">
                        <span class="type">Sexe: </span><span  class="data">' . $membre->getSexeFormat() . '</span>
                    </span>
                    <span class="type">Date de naissance: </span><span class="data">' . $membre->getBirthdayFormat() . '</span>
                    <span id="caracteristique_droite">
                        <span class="type">Dernière visite: </span><span class="data">' . $membre->getLastVisit() . '</span>
                    </span>
                </div>
                <div id="img_profil">';
    if (havePhotoConcours($concours->getId(), $membre->getId()) == 1) {
        $image = imageConcour($concours->getId(), $membre->getId());
        if ($image->getEtat() == 1) {
            $contenu .= '<h3>Votre image est en cour de validation !</h3>';
            $contenu .= '<img src="./templates/images/photo_defaut.jpg" alt="Votre image est en cour de validation !"></img>';
            $contenu .= '</div><hr></hr>';
        } else {
            view($image);
            $contenu .= '<h3>' . $image->getTitre() . '</h3>';
            $contenu .= '<img src="' . $image->getUrl() . '" title="' . $image->getTitre() . '" alt="' . $image->getTitre() . '"></img>';
            $contenu .= '<div id="statistique">
                        <span class="statistique_cellule">
                            <img src="./templates/images/oeil.png" title="nombres de vues" alt="nombres de vues"></img><span class="res_stat">' . $image->getView() . '</span>
                        </span>                            
                        <span class="statistique_cellule">
                            <img src="./templates/images/classement.png" title="nombres de points" alt="nombres de points"></img><span class="res_stat">' . $image->getScore() . '</span>
                        </span>
                        <span class="statistique_cellule">
                            <img src="./templates/images/podium4.png" title="classement" alt="classement"></img><span class="res_stat">' . getClassement($image->getId(), $concours->getId()) . '</span>
                        </span>
                        <span id="vote">';
            if (!isOk() || @alreadyVoted($_SESSION['user']->getId(), $image->getId()) || isMyPage($_GET['id'])) {
                $contenu .= '<img src="./templates/images/positif2.png" id="positif" title="Merci d\'avoir voté." alt="Merci d\'avoir voté."></img>
                         <img src="./templates/images/negatif2.png" id="negatif" title="Merci d\'avoir voté." alt="Merci d\'avoir voté."></img>';
            } else {
                $contenu .= '<img src="./templates/images/positif.png" id="positif" title="vote positif" alt="vote positif" onclick="req_xhrVote(\'index.php?p=vote\',\'vote=1&id=' . $image->getId() . '\')"></img>
                         <img src="./templates/images/negatif.png" id="negatif" title="vote négatif" alt="vote négatif" onclick="req_xhrVote(\'index.php?p=vote\',\'vote=0&id=' . $image->getId() . '\')"></img>';
            }

            $contenu .= '</span>
                    </div>';
            $contenu .= '<p class="bulle_dialogue">' . $image->getDescription() . '</p>';
            $contenu .= '</div><hr></hr>';
            $contenu .= commentaire($image->getId());
        }
    } else {
        $contenu .= '<h3>Aucune image!</h3>';
        $contenu .= '<img src="./templates/images/photo_defaut.jpg" alt="Aucune photo pour ce concours"></img>';
        $contenu .= '</div><hr></hr>';
    }
    $contenu .= mosaiqueProfil($membre->getId());
    display($title, $contenu);
}

function mosaiqueProfil($id) {
    include_once 'sql/image.sql.php';
    include_once 'sql/actions.sql.php';

    // On recupère les 6 dernières images
    $listImage = array();
    $listImage = getLastImage($id);
    $contenu = '<hr></hr>
                <div id="colonne_gauche" class="colonne_profil">
                    <h2>
                        <a href="#" alt="Dernières photos">Dernières photos galeries</a>
                    </h2>';
    foreach ($listImage as $list) {
        $contenu .= '<a title="' . $list->getTitre() . '" name="' . $list->getId() . '" class="zoombox zgallery3" href="' . $list->getUrl() . '"><img src="thumb.php?src=' . $list->getUrl() . '&x=110&y=69&f=0"></img></a>';
    }

    // TODO : Pierre : Prevoir mise en page des dernières actions
    $contenu .= '</div>
                <div class="colonne_profil">
                    <h2>
                        <a href="#" alt="Dernières actions">Dernières actions</a>
                    </h2>
                    <ul>';
    $tabActions = getLastAction($id);
    foreach ($tabActions as $tab) {
        $contenu .= '<li class="lastActions">' . $tab->getActions() . ' <sup>' . $tab->intervalleTime() . '</sup></li>';
    }
    $contenu .= '  </ul>
                </div>';
    return $contenu;
}

function menuLeft($membre) {
    include_once 'sql/messagerie.sql.php';
    $contenu = '<div id="menu_gauche">
                    <a href="index.php?p=profil&id=' . $membre->getId() . '" alt="Mon profil"><img class="photo_article" src="' . $membre->getAvatar() . '" alt="' . $membre->getPseudo() . '"></img></a>';
    if (isMyPage($membre->getId())) {
        $contenu .= '<ul>
                        <li><a title="ajouter une photo" href="index.php?p=newPhoto">Ajouter une photo</a></li>
                        <li><a title="galerie" href="index.php?p=getAlbum&id=' . $membre->getId() . '">Galerie</a></li>
                        <li><a title="modifier profil" href="index.php?p=changeProfil">Modifier mon profil</a></li>
                        <li><a title="messagerie" href="index.php?p=messagerie">' . newMessage() . '</a></li>
                        <li><a title="statistiques" href="#">Statistiques</a></li>
                    </ul>';
    } else {
        $contenu .= '<ul>
                        <li><a title="galerie" href="index.php?p=getAlbum&id=' . $membre->getId() . '">Galerie</a></li>
                        <li><a title="messagerie" href="#">Contacter</a></li>
                        <li><a title="statistiques" href="#">Statistiques</a></li>
                    </ul>';
    }
    $contenu .= '</div>';
    return $contenu;
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
    $contenu = menuLeft($_SESSION['user']);
    $contenu .= '<h1>Ajouter une photo à votre galerie</h1>';
    $contenu .= '<form method="POST" action="index.php?p=newPhotoSuccess" name="formAjoutPhoto" enctype="multipart/form-data">';
    $contenu .= '<p>
                 <label for="titre">Titre</label>
                 <input type="text" name="titre" id="titre"><span class="error"></span>
                 <label for="description">Description</label>
                 <textarea name="description" rows="4" cols="40" id="description"></textarea><span class="error"></span>              
                 <label for="album">Album</label>';
    $contenu .= '<select name="album" id="loadAlbum">
                    <option value="">...</option>';
    $tabAlbums = getAlbums($_SESSION['user']->getId());
    foreach ($tabAlbums as $tabA) {
        $contenu .= '<option value="' . $tabA->getId() . '">' . $tabA->getTitre() . '<img src="templates/images/check-rouge.png"></img></option>';
    }
    $contenu .= '</select> <span class="error"></span> - <a href="#" class="createAlbum" id="formAlbum">Ajouter un album</a><span id="ajoutAlbum"></span>';
    $contenu .= '<label for="concours">Concours</label>';
    $concours = lastConcour();
    if (havePhotoConcours($concours->getId(), $_SESSION['user']->getId()) == 0) {
        $contenu .= '<select name="concours">
                     <option value="0">Aucun</option>
                     <option value="' . $concours->getId() . '">' . $concours->getTitre() . '</option>
                     </select>';
    } else {
        $contenu .= 'Vous avez déjà une photo pour le concours de ce mois ci..';
    }
    $contenu .= '<label for="photo">Photo : </label>
                <input type="file" name="photo" id="avatar"><span class="error"></span>
                <input class="submit" type="submit" value="Partager ma Photo" id="submitPhoto">
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
    $etat = 1; // Image qui devra être moderé

    if (!isset($_POST['concours'])) {
        $idConcour = 0;
        $etat = 0;
    }
    include('sql/image.sql.php');
    include('sql/albums.sql.php');
    include('sql/concours.sql.php');
    include_once 'sql/actions.sql.php';

    $image = new Image(null);
    $album = getThisAlbum($_POST['album']);
    $dest = "./pics/" . $_SESSION['user']->getPseudo() . "/" . $album->getTitre() . "/";
    $error = $image->upload($_FILES['photo']);
    if (!is_array($error)) {
        $image->setUrl($error);
    } else {
        $title = 'Pixels Arts - Erreur lors de l\'upload';
        $contenu = menuLeft($_SESSION['user']);
        $contenu .= '<h2>Erreur lors de l\'upload</h2>';
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
        $image->setEtat($etat);
        registerImage($image);
        if ($idConcour != 0) {
            membreParticipe($idConcour);
        }
        $album = getThisAlbum($image->getIdAlbum());
        $actions = $_SESSION['user']->getPseudoFormat() . ' a ajouté une photo dans son album <a href=\"index.php?p=getGalerie&album=' . $image->getIdAlbum() . '\">' . $album->getTitre() . '</a>';
        newAction($actions, $_SESSION['user']->getId());
        $title = 'Pixels Arts - Photo envoyé avec succès.';
        $contenu = menuLeft($_SESSION['user']);
        $contenu .= '<h1>Photo envoyé avec succès.</h1>';
        $contenu .= '<p>Votre Photo a été envoyé avec succès</p>';
        $contenu .= mosaique();
        display($title, $contenu);
    } else {
        accessForbidden();
    }
}

function newAlbum() {
    if (!isOk()) {
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
    display($title, $contenu);
}

function newAlbumSuccess() {
    if (!isOk()) {
        accessForbidden();
    }
    include('sql/albums.sql.php');

    $album = new Album(null, $_POST['titre'], $_SESSION['user']->getId());
    addAlbum($album);
    @mkdir('./pics/' . $_SESSION['user']->getPseudo() . '/' . $album->getTitre() . '');
}

function changeProfil() {
    if (!isOk()) {
        accessForbidden();
    }
    $title = 'Pixels Arts - Modifier mon profil';
    $contenu = menuLeft($_SESSION['user']);
    $contenu .= '<h1>Modifier mon profil</h1>
                <fieldset>
                    <legend>Modifier l\'avatar</legend>
                    <form method="POST" action="index.php?p=setAvatar" enctype="multipart/form-data">
                        <p>
                        <img src="' . $_SESSION['user']->getAvatar() . '" title="' . $_SESSION['user']->getPseudo() . '"></img>
                        <label for="avatar">Avatar</label>
                        <input type="file" name="photo" id="avatar"><span class="error"></span>
                        <input  type="submit" value="Modifier l\'avatar" id="submitAvatar" class="submit"/>
                        </p>
                    </form>
                </fieldset>
                <fieldset>
                    <legend>Modifier l\'e-mail</legend>
                    <form action="index.php?p=setMail" method="POST">
                        <p>
                        <label for="mail">E-mail</label>
                        <input type="text" name="mail" id="mail">
                        <span class="error"></span>
                        <label for="mail2">Confirmer e-mail</label>
                        <input type="text" name="mail2" id="mail2">
                        <span class="error"></span>
                        <input type="submit" value="Modifier le profil" id="submitMail" class="submit"/>
                        </p>
                    </form>
                </fieldset>
                <fieldset>
                    <legend>Modifier votre mot de passe</legend>
                    <form action="index.php?p=setPassword" method="POST">
                    <p>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password">
                        <span class="error"></span>
                        <label for="password2">Confirmer mot de passe</label>
                        <input type="password" name="password2" id="password2">
                        <span class="error"></span>
                        <input  type="submit" value="Modifier le mot de passe" id="submitPassword" class="submit"/>
                   </p>
                    </form>
               </fieldset>';
    display($title, $contenu);
}

function setAvatar() {

    include_once 'sql/membre.sql.php';
    include_once 'sql/image.sql.php';
    include_once 'sql/actions.sql.php';

    if (!isset($_FILES['photo']) || !isOk()) {
        accessForbidden();
    }
    $image = new Image(null);
    $dest = "./pics/" . $_SESSION['user']->getPseudo() . "/";
    $error = $image->upload($_FILES['photo']);
    if (!is_array($error)) {
        $image->setUrl($error);
    }
    if (is_dir($dest)) {
        if ($image->getRatio() == 0) {
            $image->setUrl(resizeImage::resize($image->getUrl(), $dest, $_FILES['photo']['name'], 128, 128, 173));
        } else {
            $image->setUrl(resizeImage::resize($image->getUrl(), $dest, $_FILES['photo']['name'], 0, 173, 128, 173));
        }
        // On supprime l'original
        resizeImage::deleteImage($error);
        updateAvatar($image->getUrl());
        $_SESSION['user']->setAvatar($image->getUrl());
        // On ajoute l'action
        $actions = $_SESSION['user']->getPseudoFormat() . ' a modifié son avatar';
        newAction($actions, $_SESSION['user']->getId());

        $title = 'Pixels Arts - Modifier mon profil';
        $contenu = menuLeft($_SESSION['user']);
        $contenu .= '<h1>Modifier mon profil</h1>
                    <p>Avatar modifié avec succès.</p><hr></hr>';
        $contenu .= mosaiqueProfil($_SESSION['user']->getId());
    }
    display($title, $contenu);
}

function setMail() {
    if (!isOk()) {
        accessForbidden();
    }
    include_once 'sql/membre.sql.php';
    $user = loadMembre($_SESSION['user']->getId());
    $user->setMail($_POST['mail']);
    $title = 'Pixels Arts - Modifier mon profil';
    $contenu = menuLeft($_SESSION['user']);
    if (!isMailExist($user)) {
        updateMail($user->getMail());
        $contenu .= '<h1>Modifier mon profil</h1>
                     <p>Votre adresse e-mail a été modifié avec succès.</p><hr></hr>';
    } else {
        $contenu .= '<h1>Modifier mon profil</h1>
                     <p>L\'adresse e-mail choisit éxiste déjà.</p><hr></hr>';
    }
    $contenu .= mosaiqueProfil($_SESSION['user']->getId());
    display($title, $contenu);
}

function setPassword() {
    if (!isOk()) {
        accessForbidden();
    }
    include_once 'sql/membre.sql.php';
    $user = loadMembre($_SESSION['user']->getId());
    $user->setPassword($_POST['password']);
    updatePassword($user->getPassword());
    $title = 'Pixels Arts - Modifier mon profil';
    $contenu = menuLeft($_SESSION['user']);
    $contenu .= '<h1>Modifier mon profil</h1>
                 <p>Votre mot de passe a bien été changé.</p><hr></hr>';
    $contenu .= mosaiqueProfil($_SESSION['user']->getId());
    display($title, $contenu);
}

function setCommentaire() {
    if (!isOk()) {
        accessForbidden();
    }
    include_once 'sql/commentaire.sql.php';
    include_once 'class/commentaire.class.php';
    include_once 'sql/membre.sql.php';
    include_once 'sql/actions.sql.php';
    include_once 'sql/image.sql.php';
    $image = loadImage($_POST['id_image']);
    $action = $_SESSION['user']->getPseudoFormat() . ' a commenté la photo intitulé <a href=\"index.php?p=getPhoto&id=' . $image->getId() . '\">' . $image->getTitre() . '</a>';
    newAction($action, $image->getIdMembre());
    $commentaire = new Commentaire($_POST['id_membre'], $_POST['message'], $_POST['timestamp'], $_POST['id_image']);
    submit($commentaire);
    $membre = loadMembre($_POST['id_membre']);
    echo '
        <li class="comment" id="comment_myself">
            <a href="index.php?p=profil&id=' . $membre->getId() . '"><img class="avatar" src="thumb.php?src=' . $membre->getAvatar() . '&x=37&y=50&f=0"></img></a>
            <div class="contenu_comment"><span class="name">' . $membre->getPseudo() . ' - <span class="message">' . nl2br(stripcslashes($_POST['message'])) . '</span></span></div>
            <span class="date" title="Posté il y a 1 secondes">Posté il y a 1 secondes</span>
        </li>';
}

function commentaire($idImage) {
    include_once 'sql/commentaire.sql.php';
    include_once 'sql/image.sql.php';

    $image = loadImage($idImage);
    $formulaire = '<ol id="update" class="timeline">';

    /*
     * On récupère les commentaires s'il y en a dans la BDD
     */
    $comments = getComments($idImage);
    if ($comments != null) {
        /*
         * Affichage des commentaires un par un
         */
        foreach ($comments as $c) {
            $membre = loadMembre($c->getIdMembre());
            if ($image->getIdMembre() == $c->getIdMembre()) {
                $formulaire .= '<li class="comment" id="comment_myself">';
            } else {
                $formulaire .= '<li class="comment">';
            }
            $formulaire .= '<a href="index.php?p=profil&id=' . $membre->getId() . '"><img class="avatar" src="thumb.php?src=' . $membre->getAvatar() . '&x=37&y=50&f=0"></img></a>
                <div class="contenu_comment"><span class="name">' . $membre->getPseudo() . ' - <span class="message">' . $c->getMessage() . '</span></span></div>
                <span class="date" title="Ajouté le ' . $c->getTimeStampFormat() . '">Posté il y a ' . $c->getTimeStampFormat() . '</span> 
                    </li>';
        }
    }
    $formulaire .= '</ol>';
    $formulaire .= pagination($idImage);
    if (isOk()) {
        $user = $_SESSION['user'];
        $formulaire .= '
            <div id="flash"></div>
            <div id="commentaireFormulaire">
                <form id="formCommentaire" method="post" action="#" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="id_membre" id="id_membre" value=' . $user->getId() . ' />
                    <input type="hidden" name="id_image" id="id_image" value=' . $idImage . ' />
                    <input type="hidden" name="timestamp" id="timestamp" value=' . time() . ' />
                    <p>
                        <label for="commentaires">Commentaire</label>
                        <textarea name="message" id="message"></textarea>
                        <input type="submit" id="submitCommentaire" value="Envoyer" />
                    </p>

                </form>
            </div>';
    }
    return $formulaire;
}

?>
