-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 03 Octobre 2011 à 10:20
-- Version du serveur: 5.1.53
-- Version de PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `actions`
--


-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(60) NOT NULL,
  `idMembres` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Contenu de la table `albums`
--

INSERT INTO `albums` (`id`, `titre`, `idMembres`) VALUES
(51, '', 17),
(52, 'Test', 17),
(53, 'exemple', 18),
(55, 'defaut', 19);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext,
  `timestamp` timestamp NULL DEFAULT NULL,
  `idMembres` int(11) NOT NULL,
  `idImage` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commentaires_membres1` (`idMembres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `commentaires`
--


-- --------------------------------------------------------

--
-- Structure de la table `concours`
--

CREATE TABLE IF NOT EXISTS `concours` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(80) NOT NULL,
  `description` longtext NOT NULL,
  `nbParticipant` int(10) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `concours`
--

INSERT INTO `concours` (`id`, `titre`, `description`, `nbParticipant`, `url`) VALUES
(1, 'Le mois d''août, la couleur jaune !', 'Le moi d’août, le mois des mirabelles ! C''est donc pour cela que nous avons tout simplement décidé de vous proposer un concours sur le thème de la couleur jaune. Bien entendu, il est interdit de retoucher les photos via l''ordinateur. A gagner, ce mois-ci : Un abonnement à la revue XY spécial photographe amateur, un abonement gold d''une durée de 3 mois et un abonement gold d''une durée d''un mois. Bon concours à tous ! ', 12, './templates/images/img.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `titre` varchar(70) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `view` int(10) NOT NULL DEFAULT '0',
  `score` int(10) NOT NULL DEFAULT '0',
  `idMembres` int(11) NOT NULL,
  `idConcours` int(10) NOT NULL,
  `idAlbum` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_images_membres` (`idMembres`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `url`, `titre`, `description`, `view`, `score`, `idMembres`, `idConcours`, `idAlbum`) VALUES
(17, './pics/Pyro/Test/Koala.jpg', 'Koala', 'Un koala monte Ã  un arbre.', 0, 0, 17, 0, 52),
(18, './pics/Pyro/Test/Tulips.jpg', 'Tulipes', 'Un champ de Tulipe', 2, 0, 17, 1, 52),
(19, './pics/Bad/exemple/Penguins.jpg', 'Manchots', 'Trois manchots en ronde', 0, 0, 18, 0, 53),
(20, './pics/Bad/exemple/Hydrangeas.jpg', 'Hortensias', 'Une jolie fleur.', 2, 0, 18, 1, 53),
(21, './pics/Flo/defaut/Jellyfish.jpg', 'Meduses', 'Meduses du pacifique nord', 2, 1, 19, 1, 55),
(22, './pics/Flo/defaut/Lighthouse.jpg', 'Phare', 'Phare breton au couchÃ© de soleil', 0, 0, 19, 0, 55),
(23, './pics/Flo/defaut/Chrysanthemum.jpg', 'ChrysanthÃ¨me', 'Une jolie fleur', 0, 0, 19, 0, 55);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `sexe` varchar(10) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT './templates/images/Avatar_defaut.jpg',
  `birthday` date DEFAULT NULL,
  `cle` varchar(55) NOT NULL,
  `lastVisit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `password`, `mail`, `sexe`, `avatar`, `birthday`, `cle`, `lastVisit`) VALUES
(17, 'Pyro', 'ab4f63f9ac65152575886860dde480a1', 'pierre.charrasse@gmail.com', '1', './pics/Pyro/Crash-thumb.jpg', '0000-00-00', 'ec16edf4feebc11983b25119f9c62571', '2011-10-03 02:23:21'),
(18, 'Bad', 'ab4f63f9ac65152575886860dde480a1', 'jerome.wautrin@gmail.com', '1', './pics/Bad/1155161879_027.jpg', '0000-00-00', '191cfc4ba378e7f961e754d3c1266cd4', '2011-10-03 02:09:11'),
(19, 'Flo', 'ab4f63f9ac65152575886860dde480a1', 'Janson.florian@gmail.com', '1', './pics/Flo/images.jpg', '0000-00-00', '82f32da532ad14a8e6c3a97abded55aa', '2011-10-03 09:14:01');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` char(10) NOT NULL,
  `idImage` int(10) NOT NULL,
  `idMembre` int(10) NOT NULL,
  `vote` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `vote`
--

INSERT INTO `vote` (`id`, `date`, `idImage`, `idMembre`, `vote`) VALUES
(8, '03-10-2011', 20, 17, 0),
(7, '03-10-2011', 21, 17, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vue`
--

CREATE TABLE IF NOT EXISTS `vue` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `date` char(10) NOT NULL,
  `ip` char(25) NOT NULL,
  `idImage` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `vue`
--

INSERT INTO `vue` (`id`, `date`, `ip`, `idImage`) VALUES
(11, '03-10-2011', '127.0.0.1', 18),
(10, '03-10-2011', '127.0.0.1', 20),
(9, '03-10-2011', '127.0.0.1', 21);
