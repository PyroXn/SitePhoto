<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns ="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title> Site photo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="./templates/stylesheet.css" media="screen" />
    </head>
    <body>
        <div id="header">
            <img src="logo.png" alt="logo du site" />
            <?php
            if (@$_SESSION['user']) {
                ?>
                <ul>
                    <li><a title="accueil" accesskey="1" href="#">Accueil</a></li>
                    <li><a title="photos" accesskey="2" href="#">Photos</a></li>
                    <li><a title="concours" accesskey="3" href="#">Concours</a></li>
                    <li><a title="forum" accesskey="4" href="#">Forum</a></li>
                    <li><a title="contact" accesskey="5" href="#">Contact</a></li>
                    <li><a title="inscription" accesskey="6" href="#">Inscription</a></li>
                    <li><a title="connexion" accesskey="7" href="#">Connexion</a></li>
                </ul>
                <?php
            } else {
                ?>
                <ul>
                    <li><a title="accueil" accesskey="1" href="#">Accueil</a></li>
                    <li><a title="photos" accesskey="2" href="#">Photos</a></li>
                    <li><a title="concours" accesskey="3" href="#">Concours</a></li>
                    <li><a title="forum" accesskey="4" href="#">Forum</a></li>
                    <li><a title="contact" accesskey="5" href="#">Contact</a></li>
                    <li><a title="inscription" accesskey="6" href="#">Inscription</a></li>
                    <li><a title="connexion" accesskey="7" href="#">Connexion</a></li>
                </ul>    
                <?php
            }
            ?>
        </div>
        <div id="global">
            <div id="contenu">