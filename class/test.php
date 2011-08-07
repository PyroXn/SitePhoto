<?php
    /*    Inscription     */
    include('class_membre.php');
    // On reçoit le formulaire d'inscription
    $membre = new membre($_POST['mail'],$_POST['password']);
    $membre->setPseudo($_POST['pseudo']);
    $membre->setAvatar($_POST['avatar']);
    $membre->setSexe($_POST['sexe']);
    // ..
    
    if(!$membre->ifMailExist() && $membre->ifPseudoExist()) {
        // Ici on pourra mettre notre methodes d'insertion de l'objet
    }

?>
