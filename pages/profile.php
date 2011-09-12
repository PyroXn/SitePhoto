<?php
/**
 *
 * @return Bool Retourne vrai si utilisateur est sur son profil
 */
function isMyPage() {
    $id = @$_GET['key'];
    return $_SESSION['user'] == $id;
}

function profile() {
    // INCLUDES CLASS
    include('class/connexion.class.php');
    include('class/concours.class.php');
    include('class/commentaire.class.php');
    
    // INCLUDES SQL
    include('sql/concour.sql.php');
    include('sql/commentaire.sql.php');
    
    // CONNEXION BDD
    $connexion = new Connexion();
    
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
    
    
    
    
    
    
    
    
}

?>
