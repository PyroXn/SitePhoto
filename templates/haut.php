
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns ="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title> Site photo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="./templates/stylesheet.css" media="screen" />
        <script language="javascript" type="text/javascript" src="./js/javascript.js"></script>
        <!--[if lte IE 8]>
            <style type="text/css">
                .colonne img {
                    filter:progid:DXImageTransform.Microsoft.Shadow(color='#555', Direction=135, Strength=12);
                    zoom: 1;
                } 
            </style>
        <![endif]-->
    </head>
    <body>
        <div id="header">

            <?php
            if (@$_SESSION['user']) {
                ?>
                <ul>
                    <li><img src="./templates/images/logo6.png" alt="logo du site" /></li>
                    <li><a title="accueil" accesskey="1" href="index.php">Accueil</a></li>
                    <li><a title="photos" accesskey="2" href="#">Photos</a></li>
                    <li><a title="concours" accesskey="3" href="#">Concours</a></li>
                    <li><a title="forum" accesskey="4" href="#">Forum</a></li>
                    <li><a title="contact" accesskey="5" href="#">Contact</a></li>
                    <li><a title="mon profil" accesskey="6" href="#">Mon profil</a></li>
                    <li><a title="connexion" accesskey="7" href="index.php?p=deconnexion">Deconnexion</a></li>
                </ul>
                <?php
            } else {
                ?>
                <ul>
                    <li><img src="./templates/images/logo6.png" alt="logo du site" /></li>
                    <li><a title="accueil" accesskey="1" href="index.php">Accueil</a></li>
                    <li><a title="photos" accesskey="2" href="#">Photos</a></li>
                    <li><a title="concours" accesskey="3" href="#">Concours</a></li>
                    <li><a title="forum" accesskey="4" href="#">Forum</a></li>
                    <li><a title="contact" accesskey="5" href="#">Contact</a></li>
                    <li><a title="inscription" accesskey="6" href="index.php?p=inscription">Inscription</a></li>
                    <li><a title="connexion" accesskey="7" href="index.php?p=connexion">Connexion</a></li>
                </ul>    
                <?php
            }
            ?>
        </div>
        <div id="global">
            <div id="contenu">