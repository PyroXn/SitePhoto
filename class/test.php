<?php
    /*    LOGIN     */
    include('class_membre.php');
    // On reçoit le formulaire de connexion : mail et password
    $membre = new membre($_POST['mail'],$_POST['password']);
    if($membre->ifExist()) {
        $membre->isCo();
        $SESSION['users'] = $membre;
    }
    else {
        // On renvoit une erreur, sachant qu'on aura une class pour gérer les erreurs
    }
?>
