<?php

include_once 'pages/profil.php';

function getAlbum() {

    if (!isset($_GET['id']) || !isRealId($_GET['id'])) {
        accessForbidden();
    }

    include_once 'sql/albums.sql.php';
    include_once 'sql/membre.sql.php';
    
    $membre = loadMembre($_GET['id']);
    $tabAlbums = getAlbums($_GET['id']);
    $title = 'Pixels Arts - Albums';
    $contenu = menuLeft($membre);
    $contenu .= '<h1>Choix de l\'album à consulter :</h1>
                 <div id="galerie">';
    foreach ($tabAlbums as $tab) {
        $sql = 'SELECT * FROM images WHERE idMembres="' . $_GET['id'] . '" AND idAlbum="' . $tab->getId() . '" ORDER BY id LIMIT 1';
        $req = mysql_query($sql);
        $data = mysql_fetch_assoc($req);
        $objet = new Image($data['url']);
        $objet->setTitre($data['titre']);
        $objet->setDescription($data['description']);
        $objet->setView($data['view']);
        $objet->setScore($data['score']);
        $objet->setIdAlbum($data['idAlbum']);
        $objet->setIdConcour(@$data['idConcour']);
        $objet->setIdMembre($data['idMembres']);
        if(mysql_num_rows($req) == 1) {
            $contenu .= '
                <a href="index.php?p=getGalerie&album='.$tab->getId().'">
                    <span class="cadre_album"></span>
                    <span class="titre_album">'.$tab->getTitre().'</span>
                    <img class="album" src="thumb.php?src='.$objet->getUrl().'&x=255&y=155&f=0" title="'.$tab->getTitre().'"></img>
                </a>';
            //'<a href="index.php?p=getGalerie&album='.$tab->getId().'"><span class="cadre_album"></span><span class="titre_album">'.$tab->getTitre().'</span><img class="album" src="thumb.php?src='.$objet->getUrl().'&x=240&y=240&f=0" title="'.$tab->getTitre().'"></img></a>';
        }
        unset($objet);
    }
    $contenu .= '</div>';
    $contenu .= mosaique();
    display($title, $contenu);
}

function getGalerie() {
    if(!isset($_GET['album'])) {
        accessForbidden();
    }
    include_once 'sql/membre.sql.php';
    
    $sql = 'SELECT idMembres FROM images WHERE idAlbum="'.$_GET['album'].'"';
    $req = mysql_query($sql);
    $infos = mysql_fetch_assoc($req);
    
    $membre = loadMembre($infos['idMembres']);
    $title = 'Pixels Arts - Galerie';
    $contenu = menuLeft($membre);
    $contenu .= '<h1>Choix de la photo à consulter :</h1>
                    <div id="galerie">';
    $sql = 'SELECT * FROM images WHERE idAlbum="'.$_GET['album'].'" ORDER BY id';
    $req = mysql_query($sql);
    while($data = mysql_fetch_assoc($req)) {
        $objet = new Image($data['url']);
        $objet->setTitre($data['titre']);
        $objet->setId($data['id']);
        $objet->setDescription($data['description']);
        $objet->setView($data['view']);
        $objet->setScore($data['score']);
        $objet->setIdAlbum($data['idAlbum']);
        $objet->setIdConcour(@$data['idConcour']);
        $objet->setIdMembre($data['idMembres']);
        $contenu .= '
            
                    <a href="index.php?p=getPhoto&id='.$objet->getId().'">
                        <span class="cadre_album"></span>
                        <span class="titre_album">'.$objet->getTitre().'</span>
                        <img class="album" src="thumb.php?src='.$objet->getUrl().'&x=255&y=155&f=0" title="'.$objet->getTitre().'"></img>
                    </a>
           
            ';
        //'<a href="index.php?p=getPhoto&id='.$objet->getId().'"><span class="cadre_album"></span><span class="titre_album">'.$objet->getTitre().'</span><img class="album" src="thumb.php?src='.$objet->getUrl().'&x=240&y=240&f=0" title="'.$objet->getTitre().'"></img></a>';
        unset($objet);
    }
    $contenu .= '</div>';
    $contenu .= mosaique();
    display($title,$contenu);
}

function getPhoto() {
    if(!isset($_GET['id']) || $_GET['id'] == null) {
        accessForbidden();
    }
    
    include_once 'sql/membre.sql.php';
    include_once 'sql/commentaire.sql.php';
    
    $sql = 'SELECT * FROM images WHERE id="'.$_GET['id'].'"';
    $req = mysql_query($sql);
    $data = mysql_fetch_assoc($req);
    $objet = new Image($data['url']);
    $objet->setTitre($data['titre']);
    $objet->setId($data['id']);
    $objet->setDescription($data['description']);
    $objet->setView($data['view']);
    $objet->setScore($data['score']);
    $objet->setIdAlbum($data['idAlbum']);
    $objet->setIdConcour(@$data['idConcour']);
    $objet->setIdMembre($data['idMembres']);
    
    $membre = loadMembre($objet->getIdMembre());
    
    $title = $objet->getTitre();
    $contenu = '<div id="menu_gauche">
                    <img class="photo_article" src="' . $membre->getAvatar() . '" alt="' . $membre->getPseudo() . '"></img>';
    if(isMyPage($membre->getId())) {
        $contenu .= '<ul>
                        <li><a title="ajouter une photo" href="index.php?p=deleteImage&id='.$objet->getId().'" id="deletePhoto">Supprimer la photo</a></li>
                    </ul>';
    } else {
        $contenu .= '<ul>
                        <li><a title="galerie" href="index.php?p=getAlbum&id='.$membre->getId().'">Galerie</a></li>
                        <li><a title="messagerie" href="#">Contacter</a></li>
                        <li><a title="statistiques" href="#">Statistiques</a></li>
                    </ul>';
    }
    $contenu .= '</div>';
    
    $contenu .= '<h1>Photo prise par '.$membre->getPseudoFormat().'</h1>';
    $contenu .= '<div id="img_profil">';
    $contenu .= '<h3>'.$objet->getTitre().'</h3>';
    $contenu .= '<img src="'.$objet->getUrl().'" title="'.$objet->getTitre().'"></img>';
    $contenu .= '<p class="bulle_dialogue">' . $objet->getDescription() . '</p>
                    <hr></hr>';
    $contenu .= '</div>';
    $contenu .= commentaire($objet->getId());
    display($title,$contenu);
}


function deleteImage() {
    include_once 'pages/profil.php';
    include_once 'sql/image.sql.php';
    
    if(!isOk() || !isset($_GET['id']) || isMyImage($_GET['id']) != 1) {
        accessForbidden();
    }
    $image = loadImage($_GET['id']);
    resizeImage::deleteImage($image->getUrl());
    delImage($image->getId());
    $title = 'Pixels Arts - Galerie';
    $contenu = menuLeft($_SESSION['user']);
    $contenu .= '<h1>Galerie - Image supprimé</h1>';
    $contenu .= '<p>Votre photo a été supprimé avec succès.</p><hr></hr>';
    $contenu .= mosaiqueProfil($_SESSION['user']->getId());
    display($title,$contenu);
    
    
}
?>
