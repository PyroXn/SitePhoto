<?php
include('pages/profil.php');

function getGalerie() {
    
    if(!isset($_GET['id']) || !isRealId($_GET['id'])) {
        accessForbidden();
    }
    
    include('sql/albums.sql.php');

    $tabPhoto = array();
    $tabAlbums = getAlbums($_GET['id']);
    $title = 'Galerie test';
    $contenu = '<h2>Choix de l\'album à consulter :</h2>';
    $u = 1;
    foreach($tabAlbums as $tab) {
        $sql = 'SELECT * FROM images WHERE idMembres="'.$_GET['id'].'" AND idAlbum="'.$tab->getId().'"';
        $req = mysql_query($sql);
        while($data = mysql_fetch_assoc($req)) {
            $objet = new Image($data['url']);
            $objet->setTitre($data['titre']);
            $objet->setDescription($data['description']);
            $objet->setView($data['view']);
            $objet->setScore($data['score']);
            $objet->setIdAlbum($data['idAlbum']);
            $objet->setIdConcour($data['idConcour']);
            $objet->setIdMembre($data['idMembre']);
            $tabPhoto[] = $objet;         
        }
        $i = 0;
        foreach($tabPhoto as $tabph) {
            if($i == 0) {
                $contenu .= '<div id="album"><a href="'.$tabph->getUrl().'" class="zoombox zgallery'.$u.'">';
                $contenu .= '<img src="thumb.php?src='.$tabph->getUrl().'&x=240&y=240&f=0"></a><p>'.$tab->getTitre().'</p></div>';      
            }
            else {
                $contenu .= '<div id="albumInvisible"><a href="'.$tabph->getUrl().'" class="zoombox zgallery'.$u.'"></a></div>';
            }
            $i++;
        }
        unset($tabPhoto);
        $u++;
    }
    //$contenu .= '</div>';
    display($title,$contenu);
}
?>
