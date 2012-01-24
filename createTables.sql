-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 24 Janvier 2012 à 13:47
-- Version du serveur: 5.1.58
-- Version de PHP: 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sitephoto`
--

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idMembre` int(10) NOT NULL,
  `actions` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `actions`
--

INSERT INTO `actions` (`id`, `idMembre`, `actions`, `timestamp`) VALUES
(1, 1, '<img src="thumb.php?src=./pics/Zozor/ecommerce.png&x=30&y=30&f=0"></img><a class="pseudo_homme" href="index.php?p=profil&id=1">Zozor</a> a modifié son avatar', '2012-01-20 13:50:01'),
(2, 1, '<img src="thumb.php?src=./pics/Zozor/design.png&x=30&y=30&f=0"></img><a class="pseudo_homme" href="index.php?p=profil&id=1">Zozor</a> a modifié son avatar', '2012-01-20 13:50:22'),
(3, 1, '<img src="thumb.php?src=./pics/Zozor/design.png&x=30&y=30&f=0"></img><a class="pseudo_homme" href="index.php?p=profil&id=1">Zozor</a> a ajouté une photo dans son album <a href="index.php?p=getGalerie&album=1">defaut</a>', '2012-01-20 13:51:19'),
(4, 1, '<img src="thumb.php?src=./pics/Zozor/design.png&x=30&y=30&f=0"></img><a class="pseudo_homme" href="index.php?p=profil&id=1">Zozor</a> a modifié son avatar', '2012-01-20 13:52:35'),
(5, 1, '<img src="thumb.php?src=./pics/Zozor/design.png&x=30&y=30&f=0"></img><a class="pseudo_homme" href="index.php?p=profil&id=1">Zozor</a> a ajouté une photo dans son album <a href="index.php?p=getGalerie&album=1">defaut</a>', '2012-01-20 13:53:06'),
(6, 1, '<img src="thumb.php?src=./pics/Zozor/statueliberte1.jpg&x=30&y=30&f=0"></img><a class="pseudo_homme" href="index.php?p=profil&id=1">Zozor</a> a modifié son avatar', '2012-01-20 13:56:39');

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(60) CHARACTER SET utf8 NOT NULL,
  `idMembres` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `albums`
--

INSERT INTO `albums` (`id`, `titre`, `idMembres`) VALUES
(1, 'defaut', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext CHARACTER SET utf8,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idMembre` int(11) NOT NULL,
  `idImage` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commentaires_membres1` (`idMembre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `concours`
--

CREATE TABLE IF NOT EXISTS `concours` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(80) CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `nbParticipant` int(10) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `concours`
--

INSERT INTO `concours` (`id`, `titre`, `description`, `nbParticipant`, `url`) VALUES
(1, 'The Wild', 'L''objectif de ce concours est de présenter des photographies sur le thème de la nature.\r\nA gagner ce mois-ci :\r\n- 2 abonnements au magasine "La photographie pour les nuls"\r\n- 1 week end à la campagne\r\n\r\nComme d''habitude, les photos seront soumises à l''administrateur qui décidera ou non de les accepter dans le concours', 1, 'http://media.smashingmagazine.com/images/nature-wallpapers/33.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `titre` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `view` int(10) NOT NULL DEFAULT '0',
  `score` int(10) NOT NULL DEFAULT '0',
  `idMembres` int(11) NOT NULL,
  `idConcours` int(10) NOT NULL,
  `idAlbum` int(10) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_images_membres` (`idMembres`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `url`, `titre`, `description`, `view`, `score`, `idMembres`, `idConcours`, `idAlbum`, `etat`) VALUES
(2, './pics/Zozor/defaut/vallee.jpg', 'La nature', 'Une photo de la nature pour coller au thème :)', 3, 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sexe` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT './templates/images/Avatar_defaut.jpg',
  `birthday` date DEFAULT NULL,
  `cle` varchar(55) CHARACTER SET utf8 NOT NULL,
  `lastVisit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `password`, `mail`, `sexe`, `avatar`, `birthday`, `cle`, `lastVisit`, `admin`) VALUES
(1, 'Zozor', '56910c52ed70539e3ce0391edeb6d339', 'florian.janson@mydevhouse.com', '1', './pics/Zozor/statueliberte1.jpg', '1989-11-07', 'b956bcc8249525d2b0557b107d94799d', '2012-01-24 08:39:06', 1),
(2, 'test', '05a671c66aefea124cc08b76ea6d30bb', 'test@test.com', '2', './templates/images/Avatar_defaut.jpg', '2012-01-01', '0dfc92ec7bd0e9b3523cf32eb2c8d21a', '2012-01-20 14:33:46', 0);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE IF NOT EXISTS `messagerie` (
  `id` int(10) NOT NULL,
  `expediteur` int(10) NOT NULL,
  `destinataire` int(10) NOT NULL,
  `sujet` varchar(50) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etat` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `expediteur`, `destinataire`, `sujet`, `message`, `timestamp`, `etat`) VALUES
(1, 2, 1, 'test', 'Salut ! Je voulais te proposer de voter pour moi ! Donc n''hésite pas ! Merci !', '2012-01-20 14:05:51', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` char(10) CHARACTER SET utf8 NOT NULL,
  `idImage` int(10) NOT NULL,
  `idMembre` int(10) NOT NULL,
  `vote` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `vue`
--

CREATE TABLE IF NOT EXISTS `vue` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `date` char(10) CHARACTER SET utf8 NOT NULL,
  `ip` char(25) CHARACTER SET utf8 NOT NULL,
  `idImage` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `vue`
--

INSERT INTO `vue` (`id`, `date`, `ip`, `idImage`) VALUES
(3, '24-01-2012', '127.0.0.1', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
