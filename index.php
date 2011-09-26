<?php
// INCLUDES CLASS
include('class/membre.class.php');
include('class/connexion.class.php');
include('class/concours.class.php');
include('class/commentaire.class.php');
include('class/image.class.php');
include('class/resizeImage.class.php');
include('class/albums.class.php');

session_start();

// BDD
$connexion = new Connexion();

/*
 * TODO : Mettre en place la verification de la cle
 */
if(!isset($_GET['p'])) { $_GET['p'] = "home"; home(); }
elseif ($_GET['p'] == "home") { home(); }

elseif ($_GET['p'] == "inscription") { include('pages/log.php'); inscription(); }
elseif ($_GET['p'] == "inscriptionSuccess") { include('pages/log.php'); inscriptionSuccess(); }
elseif ($_GET['p'] == "checkCle") { include('pages/log.php'); checkCle(); }
elseif ($_GET['p'] == "connexion") { include('pages/log.php'); connexion(); }
elseif ($_GET['p'] == "connexionSuccess") { include('pages/log.php'); connexionSuccess(); }
elseif ($_GET['p'] == "deconnexion") { include('pages/log.php'); deconnexion(); }

elseif ($_GET['p'] == "profil") { include('pages/profil.php'); profil(); }
elseif ($_GET['p'] == "newPhoto") { include('pages/profil.php'); newPhoto(); }
elseif ($_GET['p'] == "newPhotoSuccess") { include('pages/profil.php'); newPhotoSuccess(); }
elseif ($_GET['p'] == "newAlbum") { include('pages/profil.php'); newAlbum(); }
elseif ($_GET['p'] == "newAlbumSuccess") { include('pages/profil.php'); newAlbumSuccess(); }
elseif ($_GET['p'] == "vote") { include('pages/profil.php'); vote(); }

elseif ($_GET['p'] == "getGalerie") { include('pages/galerie.php'); getGalerie(); }

/**
 * Sert à afficher la page
 * @param String $titre Titre de la page
 * @param String $contenu Contenu de la page
 */
function display($title,$contenu) {
    include("templates/haut.php");
    echo $contenu;
    include("templates/bas.php");
}

/**
 * Permet d'afficher une page interdisant  l'utilisateur de continuer
 */
function accessForbidden() {
    $title = "Vous n'avez rien à faire ici !";
    $contenu = "Il semblerait que vous vous soyez égarés ! Vous pouvez retourner à <a href='index.php'>l'accueil</a>.";
    display($title,$contenu);
    exit();
}

/**
 *
 * @return Bool True si user connecté
 */
function isOk() {
    return isset($_SESSION['user']);
}

function home() {
    $title = "Bienvenue !";
    $contenu = '<div id="menu_gauche">
                    <img class="photo_article" src="./templates/images/img.jpeg" alt=""></img>
                </div>
                <h1>
                    Titre article
                </h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mollis orci sit amet mi egestas a tincidunt libero dignissim. Cras tincidunt rutrum sem, sit amet pharetra ante varius a. Praesent feugiat accumsan felis at dignissim. Cras nec elit vitae sapien ultrices volutpat. Nunc velit risus, volutpat ut tempus ut, tristique quis lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam eros diam, tincidunt ac hendrerit at, tempus at dolor. Fusce felis metus, imperdiet eu pellentesque sed, lacinia quis leo. Suspendisse ut ligula et magna lacinia pulvinar. Nunc lacinia enim sed elit venenatis vehicula. Praesent at massa dui. Nullam condimentum vulputate metus non euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In hac habitasse platea dictumst. Vestibulum a quam ante, sit amet fermentum orci.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mollis orci sit amet mi egestas a tincidunt libero dignissim. Cras tincidunt rutrum sem, sit amet pharetra ante varius a. Praesent feugiat accumsan felis at dignissim. Cras nec elit vitae sapien ultrices volutpat. Nunc velit risus, volutpat ut tempus ut, tristique quis lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam eros diam, tincidunt ac hendrerit at, tempus at dolor. Fusce felis metus, imperdiet eu pellentesque sed, lacinia quis leo. Suspendisse ut ligula et magna lacinia pulvinar. Nunc lacinia enim sed elit venenatis vehicula. Praesent at massa dui. Nullam condimentum vulputate metus non euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In hac habitasse platea dictumst. Vestibulum a quam ante, sit amet fermentum orci.
                </p>';
    $contenu .= mosaique();
    display($title,$contenu);
}

function mosaique() {
    $contenu = '<div class="colonne">
                    <h2>
                        <a href="#" alt="Les mieux notées">Les mieux notées</a>
                    </h2>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                </div>
                <div class="colonne">
                    <h2>
                        <a href="#" alt="Les dernières photos de nos gold">Les dernières photos de nos gold</a>
                    </h2>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                    <a title="" href="#"><img src="./templates/images/miniaturecontenu.jpg" alt=""></img></a>
                </div>';
    return $contenu;
}

function getFooterImage() {
    $tabImage = array();
    $sql = 'SELECT * FROM images ORDER BY id DESC LIMIT 3';
    $req = mysql_query($sql);
    while($data = mysql_fetch_assoc($req)) {
        $image = new Image($data['url']);
        $image->setTitre($data['titre']);
        $tabImage[] = $image;
    }
    return $tabImage;
}

function getFooterMembre() {
    $tabMembre = array();
    $sql = 'SELECT * FROM membres ORDER BY id DESC LIMIT 3';
    $req = mysql_query($sql);
    while($data = mysql_fetch_assoc($req)) {
        $membre = new Membre($data['mail'],null);
        $membre->setPseudo($data['pseudo']);
        $membre->setAvatar($data['avatar']);
        $membre->setId($data['id']);
        $tabMembre[] = $membre;
    }
    return $tabMembre;
}
?>
