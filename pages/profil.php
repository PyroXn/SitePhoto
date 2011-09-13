<?php
/**
 *
 * @return Bool Retourne vrai si utilisateur est sur son profil
 */
function isMyPage() {
    $id = @$_GET['id'];
    return $_SESSION['user'] == $id;
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
    $contenu = '<img src="'.$concours->getUrl().'" alt="'.$concours->getTitre().'"></img>
                <h1>'.$concours->getTitre().'</h1>
                <p>'.$concours->getDescription().'
                    '.$concours->getDescription().'
                <img src="#" alt="" class="imgProfil"></img>
                
                </p>';
    
    
    
    
    
    
    
    
    
    display($title,$contenu);
    
    
    
}

?>
