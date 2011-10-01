<?php

// Fichier regroupant les pages inscription, connexion, oublie mot de passe...

function inscription() {
    // TODO : Améliorer mise en page
    $title = "Inscrivez-vous et devenez photographe !";
    $content = "<h1>Inscrivez vous - Partagez vos galleries !</h1>";
    $content .= "<form method='post' action='index.php?p=inscriptionSuccess'>";
    $content .= "<p>
        <label for='mail'>E-mail </label>
        <input type='text' id='mail' name='mail'>
        <span class='error'></span>
        
        <label for='mail2'> Confirmer e-mail </label>
        <input type='text' id='mail2' name='mail2'>
        <span class='error'></span>
                            
        <label for='password'>Mot de passe </label>
        <input type='password' id='password' name='password'>
        <span class='error'></span>
        <label for='password2'>Confirmer mot de passe </label>
        <input type='password' id='password2' name='password2'>
        <span class='error'></span>
                                    
        <label for='sexe'>Je suis </label>
        <select id='sexe' name='sexe'>
            <option value=''>Sexe</option>
            <option value='2'>Femme</option>
            <option value='1'>Homme</option>
        </select>
        <span class='error'></span>
        
        <label for='birthday'>Date de naissance </label> 
        <select id='birthday' name='birthday'>
        <option value=''>Jour</option>";
    for ($i = 01; $i <= 31; $i++) {
        $content .= "<option value=$i>$i</option>";
    }
    $content .= "</select> ";
    
    $content .= "<select id='birthmonth' name='birthmonth'>
             <option value=''>Mois</option>
             <option value='01'>Janvier</option>
             <option value='02'>Fevrier</option>
             <option value='03'>Mars</option>
             <option value='04'>Avril</option>
             <option value='05'>Mai</option>
             <option value='06'>Juin</option>
             <option value='07'>Juillet</option>
             <option value='08'>Aout</option>
             <option value='09'>Septembre</option>
             <option value='10'>Octobre</option>
             <option value='11'>Novembre</option>
             <option value='12'>Decembre</option>";
    $content .= "</select> ";
    
    $content .= "<select id='birthyear' name='birthyear'>
             <option value=''>Année</option>";
    for ($i = 1900; $i <= Date("Y"); $i++) {
        $content .= "<option value=$i>$i</option>";
    }
    $content .= "</select><span class='error'></span>";
    
    $content .= "
        <label for='pseudo'>Pseudo </label>
        <input type='text' id='pseudo' name='pseudo'>
        <span class='error'></span>
        
        <input  type='submit' value='Inscription' id='submit' class='submit' onSubmit='checkInscription()'/>";
    $content .= "</p></form>";
    $content .= mosaique();
    display($title, $content);
}

function inscriptionSuccess() {
    // TODO : Améliorer mise en page
    include('sql/membre.sql.php');
    include('sql/albums.sql.php');
    $users = new Membre($_POST['mail'], $_POST['password']);
    $users->setPseudo($_POST['pseudo']);
    $users->setSexe($_POST['sexe']);
    $birthday = $_POST['birthyear'] . '-' . $_POST['birthmonth'] . '-' . $_POST['birthday'];
    $users->setBirthday($birthday);
    if (!isPseudoExist($users) && !isMailExist($users)) {
        $title = 'Inscription terminée';
        $contenu = '<p>Votre inscription s\'est terminée avec succès. Vous recevrez d\'ici quelques minutes un e-mail vous permettant de valider votre compte.</p>';
        $cle = md5(microtime(TRUE) * 100000);
        $users->setCle($cle);
        $users->setAvatar('./templates/images/Avatar_defaut.jpg');
        //sendMail($users);
        register($users);
        @mkdir ("./pics/".$users->getPseudo()."",0777);
        @mkdir ("./pics/".$users->getPseudo()."/defaut", 0777);

    } elseif (isPseudoExist($users)) {
        $title = 'Inscription impossible';
        $contenu = 'Le pseudo choisit existe déjà. Merci de bien vouloir en choisir un autre. <a href="javascript:history.back()">Retour</a>';
    } elseif (isMailExist($users)) {
        $title = 'Inscription impossible';
        $contenu = 'L\'adresse e-mail choisit existe déjà. Merci de bien vouloir en choisir une autre. <a href="javascript:history.back()">Retour</a>';
    }
    display($title, $contenu);
}

function sendMail(Membre $membre) {
    // TODO : Modifier les données liés au mail
    $headers = 'From: "Pixels Arts"<inscription@pixels-arts.com>' . "\n";
    $headers .='Reply-To: inscription@pixels-arts.com' . "\n";
    $headers .='Content-Type: text/html; charset="iso-8859-1"' . "\n";
    $headers .='Content-Transfer-Encoding: 8bit';
    $destinataire = $membre->getMail();
    $objet = "Confirmation de l'inscription sur XXX";
    $message = "Bonjour ".$membre->getPseudo().",<br /><br />
            Vous venez de vous inscrire sur http://www.pixels-arts.com et nous vous en remercions.<br /><br />
            Vous devez valider votre incription afin de pouvoir utiliser votre compte.<br /><br />
            Cliquez sur le lien suivant : <a href='http://www.pixels-arts.com/index.php?p=checkcle&code=".$membre->getCle()."'>http://www.pixels-arts.com/index.php?p=checkCle&code=".$membre->getCle()."</a><br /><br />
            (si le lien n'est pas cliquable, copier le et coller le dans la barre d'adresse de votre navigateur)<br /><br />
            Merci de votre confiance envers http://www.pixels-arts.com.<br /><br />
            Cordialement, l'équipe de Pixels Arts";
    mail($destinataire, $objet, $message, $headers);
}

function checkCle() {
    // TODO : Verifier la mise en page
    $cle = @$_GET['code'];
    $sql = "SELECT id FROM membres WHERE cle = '" . $cle . "'";
    $req = mysql_query($sql);
    if (mysql_num_rows($req) == 1) {
        $data = mysql_fetch_assoc($req);
        $sqlUpdate = "UPDATE membres SET cle = 0 WHERE id = '" . $data['id'] . "'";
        $reqUpdate = mysql_query($sqlUpdate);
        $title = "Compte validé !";
        $contenu = "Votre compte a été validé avec succès. Vous pouvez maintenant vous connecter à votre espace personnel.";
        display($title, $contenu);
    } else {
        $title = "Erreur !";
        $contenu = "Erreur ! Merci de bien vouloir revenir  l'accueil.";
        display($title, $contenu);
    }
}

function connexion() {
    // TODO : Améliorer mise en page
    $title = "Connectez-vous à votre espace perso !";
    $content = "<h1>Connexion</h1>";
    $content .= "<form method='POST' action='index.php?p=connexionSuccess'>
                <p>
                <label for='mail'>E-mail</label>
                <input type='text' name='mail' />
                <label for='password'>Mot de passe</label>
                <input type='password' name='password' />
                <input class='submit' type='submit' name='Submit' value='Connexion'>
                </p>
                </form>";
    $content .= mosaique();
    display($title, $content);
}

function connexionSuccess() {
    // TODO : Améliorer mise en page
    include('sql/membre.sql.php');
    include('sql/albums.sql.php');
    
    $user = new Membre($_POST['mail'], $_POST['password']);
    if (isExist($user)) {
        $user = getMembre($user);
        $_SESSION['user'] = $user;
        updateLastVisit();
        if(getNbAlbums($user->getId() < 1)) { albumDefaut($user->getId()); }
        header('Location: index.php?p=profil&id='.$user->getId().'');
    } else {
        $title = "Connexion impossible !";
        $contenu = "<p>Adresse e-mail et/ou Mot de passe érroné.</p>";
        display($title, $contenu);
    }
}

function deconnexion() {
    session_destroy();
    header("Location: index.php");
}

?>