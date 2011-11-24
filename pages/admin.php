<?php

function admin() {
    if (!isset($_SESSION['user']) || $_SESSION['user']->getAdmin() == 0) {
        accessForbidden();
    }
    
    include_once 'sql/membre.sql.php';
    include_once 'sql/image.sql.php';
    include_once 'sql/commentaire.sql.php';
    
    $nbMembre = getNbMembre();
    $nbImage = getNbImage();
    $nbComment = getNbComment();
    $nbAValider = count(getImageAValider());
    
    $title = 'Pixels Arts - Administration';
    $contenu = menuAdmin();
    $contenu .= '<h1>Bienvenue dans l\'administration</h1>';
    $contenu .= '<div id="presentation">
                    <span id="caracteristique_gauche">
                        <span class="type">Nombre d\'inscrits : </span><span  class="data">'.$nbMembre.'</span>
                    </span>
                    <span class="type">Nombre de photos : </span><span class="data">'.$nbImage.' / <font color="red">'.$nbAValider.'</font></span>
                    <span id="caracteristique_droite">
                        <span class="type">Nombre de commentaires : </span><span class="data">'.$nbComment.'</span>
                    </span>
                </div>';
    $contenu .= '<p>L\'administration vous permet de : <br /> - Editer les membres <br /> - Consulter les statistiques <br /> - Valider les photos pour le concours</p>';
    
    display($title, $contenu);
}

function menuAdmin() {
    $contenu = '<div id="menu_gauche">
                    <a href="index.php?p=admin" alt="Mon profil"><img class="photo_article" src="' . $_SESSION['user']->getAvatar() . '" alt="' . $_SESSION['user']->getPseudo() . '"></img></a>';
    $contenu .= '<ul>
                        <li><a title="administrer les membres" href="index.php?p=viewMembre">Editer membres</a></li>
                        <li><a title="Moderer les photos" href="index.php?p=imageAValider">Photos du concours</a></li>
                        <li><a title="statistiques" href="#">Statistiques</a></li>
                    </ul>';
    $contenu .= '</div>';
    return $contenu;
}

function viewMembre() {
    if (!isset($_SESSION['user']) || $_SESSION['user']->getAdmin() == 0) {
        accessForbidden();
    }
    
    include_once 'sql/membre.sql.php';
    $tabMembre = getTabMembre();
    
    $title = 'Pixels Arts - Modifier les membres';
    $contenu = menuAdmin();
    $contenu .= '<h1>Recherche par liste deroulante</h1>';
    $contenu .= '<form method="POST" action="index.php?p=editMembre">
                <p>
                <label for="liste">Choisir l\'utilisateur</label>
                <select name="listeMembre">
                    <option value="">...</option>';
    foreach($tabMembre as $tab) {
        $contenu .= '<option value="'.$tab->getPseudo().'">'.$tab->getPseudo().'</option>';
    }
    $contenu .= '</select>';
    $contenu .= '<input class="submit" type="submit" value="Modifier l\'utilisateur" name="parListMembre">
                 </p></form>';
    $contenu .= '<h1>Recherche par pseudo</h1>
                 <form method="POST" action="index.php?p=editMembre">
                 <p>
                 <label for="pseudo">Entrez le pseudo</label>
                 <input type="text" name="pseudo">
                 <input class="submit" type="submit" value="Modifier l\'utilisateur" name="parPseudo">
                 </p></form>';
    display($title,$contenu);
}

function editMembre() {
    if (!isset($_SESSION['user']) || $_SESSION['user']->getAdmin() == 0) {
        accessForbidden();
    }
    include_once 'sql/membre.sql.php';
    
    $title = 'Pixels Arts - Modifier un utilisateur';
    
    if(isset($_POST['parListMembre'])) {
        $pseudo = $_POST['listeMembre'];
    }
    else {
        $membre = new Membre($_POST['pseudo'],null);
        if(!isPseudoExist($membre)) {
            $contenu = menuAdmin();
            $contenu .= '<h1>Erreur !</h1> <p>L\'utilisateur recherché n\'éxiste pas.</p>';
            display($title,$contenu);
            exit();
        }
        $pseudo = $_POST['pseudo'];
    }
    
    $idMembre = getIdPseudo($pseudo);
    $membre = loadMembre($idMembre);
    
    $contenu = menuAdmin();
    $contenu .= '<h1>Modification de '.$pseudo.'</h1>';
    $contenu .= '<form method="POST" action="index.php?p=updateMembre">';
    $contenu .= '<p><label for="id">Id</label>
                '.$membre->getId().'
                 <label for="pseudo">Pseudo</label>
                 <input type="text" name="pseudo" value="'.$membre->getPseudo().'">
                 <label for="email">Email</label>
                 <input type="text" name="mail" value="'.$membre->getMail().'">
                 <label for="birthday">Date de naissance</label>
                 '.$membre->getBirthdayFormat().'
                 <label for="lastVisit">Dernière visite</label>
                 '.$membre->getLastVisit().'
                 <label for="admin">Administrateur</label>
                 <input type="text" maxlength="1" size="2" name="admin" value="'.$membre->getAdmin().'">
                 <i>0 : utilisateur standard / 1 : administrateur</i>
                 <input type="hidden" name="idMembre" value="'.$membre->getId().'">
                 <input class="submit" type="submit" value="Modifier"></p>';
    $contenu .= '</form>';
    display($title,$contenu);
    
}

function updateMembre() {
    if (!isset($_SESSION['user']) || $_SESSION['user']->getAdmin() == 0) {
        accessForbidden();
    }
    include_once 'sql/membre.sql.php';
    $membre = loadMembre($_POST['idMembre']);
    $membre->setMail($_POST['mail']);
    $membre->setPseudo($_POST['pseudo']);
    $membre->setAdmin($_POST['admin']);
    update($membre);
    
    $title = 'Pixels Arts - Mise à jour';
    $contenu = menuAdmin();
    $contenu .= '<h1>Mise à jour</h1>';
    $contenu .= '<p>Le profil de '.$membre->getPseudo().' a bien été mis à jour.</p>';
    display($title,$contenu);
    
}

function imageAValider() {
    if (!isset($_SESSION['user']) || $_SESSION['user']->getAdmin() == 0) {
        accessForbidden();
    }  
    
    $title = 'Pixels Arts - Validation des photos';
    include_once 'sql/image.sql.php';
    $tabImage = getImageAValider();
    
    $contenu = menuAdmin();
    $contenu .= '<h1>Validation des photos</h1>';
    $contenu .= '<div id="img_profil">
                    <img src="' . $tabImage[0]->getUrl() . '" title="' . $tabImage[0]->getTitre() . '" alt="' . $tabImage[0]->getTitre() . '"></img>
                    <div id="statistique">
                        <span class="statistique_cellule">
                        </span>                            
                        <span class="statistique_cellule">
                            <img src="./templates/images/positif.png" title="nombres de points" alt="nombres de points"></img>
                        </span>
                        <span class="statistique_cellule">
                            <img src="./templates/images/negatif.png" title="classement" alt="classement"></img>
                        </span>
                    </div>
                </div>';
    display($title,$contenu);
    
}
?>
