
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns ="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title><?php echo $title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="./templates/stylesheet.css" media="screen" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script language="javascript" type="text/javascript" src="./js/javascript.js"></script>
        <!--[if lte IE 8]>
            <style type="text/css">
                .colonne img {
                    filter:progid:DXImageTransform.Microsoft.Shadow(color='#555', Direction=135, Strength=12);
                    zoom: 1;
                } 
            </style>
        <![endif]-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="./js/zoombox.js"></script>
        <script type="text/javascript" src="./js/vote.js"></script>
        <link href="./templates/zoombox.css" rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript">
            jQuery(function($){
                $('a.zoombox').zoombox();

            });
        </script>
    </head>
    <body>
        <div id="header">
            <div id="menu_header">
                <?php
                if (@$_SESSION['user']) {
                    ?>
                    <ul>
                        <!--<li><img src="./templates/images/logo6.png" alt="logo du site" /></li>-->
                        <li <?php if($_GET['p'] == "home" || !isset($_GET['p'])) { echo 'id="current"'; } ?>><a title="accueil" accesskey="1" href="index.php"><span>Accueil</span></a></li>
                        <li <?php if($_GET['p'] == "photos") { echo 'id="current"'; } ?>><a title="photos" accesskey="2" href="#"><span>Photos</span></a></li>
                        <li <?php if($_GET['p'] == "concours") { echo 'id="current"'; } ?>><a title="concours" accesskey="3" href="#"><span>Concours</span></a></li>
                        <li <?php if($_GET['p'] == "forum") { echo 'id="current"'; } ?>><a title="forum" accesskey="4" href="#"><span>Forum</span></a></li>
                        <li <?php if($_GET['p'] == "contact") { echo 'id="current"'; } ?>><a title="contact" accesskey="2" href="#"><span>Contact</span></a></li>
                        <li <?php if($_GET['p'] == "profil") { echo 'id="current"'; } ?>><a title="mon profil" accesskey="3" href="index.php?p=profil&id=<?php echo $_SESSION['user']->getId(); ?>"><span>Mon profil</span></a></li>
                        <li <?php if($_GET['p'] == "deconnexion") { echo 'id="current"'; } ?>><a title="deconnexion" accesskey="4" href="index.php?p=deconnexion"><span>Deconnexion</span></a></li>
                    </ul>
                    <?php
                } else {
                    ?>
                    <ul>
                        <!--<li><img src="./templates/images/logo6.png" alt="logo du site" /></li>-->
                        <li <?php if($_GET['p'] == "home" || !isset($_GET['p'])) { echo 'id="current"'; } ?>><a title="accueil" accesskey="1" href="index.php"><span>Accueil</span></a></li>
                        <li <?php if($_GET['p'] == "photos") { echo 'id="current"'; } ?>><a title="photos" accesskey="2" href="#"><span>Photos</span></a></li>
                        <li <?php if($_GET['p'] == "concours") { echo 'id="current"'; } ?>><a title="concours" accesskey="3" href="#"><span>Concours</span></a></li>
                        <li <?php if($_GET['p'] == "forum") { echo 'id="current"'; } ?>><a title="forum" accesskey="4" href="#"><span>Forum</span></a></li>
                        <li <?php if($_GET['p'] == "contact") { echo 'id="current"'; } ?>><a title="contact" accesskey="2" href="#"><span>Contact</span></a></li>
                        <li <?php if($_GET['p'] == "inscription") { echo 'id="current"'; } ?>><a title="inscription" accesskey="3" href="index.php?p=inscription"><span>Inscription</span></a></li>
                        <li <?php if($_GET['p'] == "connexion") { echo 'id="current"'; } ?>><a title="connexion" accesskey="4" href="index.php?p=connexion"><span>Connexion</span></a></li>
                    </ul>  
                    <?php
                }
                ?>
            </div>
        </div>
        <div id="global">
            <div id="contenu">