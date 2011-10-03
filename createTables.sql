-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Lundi 03 Octobre 2011 à 19:13
-- Version du serveur: 5.0.27
-- Version de PHP: 5.2.1
-- 
-- Base de données: `sitephoto`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `actions`
-- 

CREATE TABLE `actions` (
  `id` int(10) NOT NULL auto_increment,
  `idMembre` int(10) NOT NULL,
  `actions` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `actions`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `albums`
-- 

CREATE TABLE `albums` (
  `id` int(10) NOT NULL auto_increment,
  `titre` varchar(60) character set utf8 NOT NULL,
  `idMembres` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

-- 
-- Contenu de la table `albums`
-- 

INSERT INTO `albums` (`id`, `titre`, `idMembres`) VALUES 
(51, '', 17),
(52, 'Test', 17),
(53, 'exemple', 18),
(55, 'defaut', 19),
(56, 'Nature morte', 19);

-- --------------------------------------------------------

-- 
-- Structure de la table `commentaires`
-- 

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL auto_increment,
  `message` longtext character set utf8,
  `timestamp` timestamp NULL default NULL,
  `idMembres` int(11) NOT NULL,
  `idImage` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_commentaires_membres1` (`idMembres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `commentaires`
-- 


-- --------------------------------------------------------

-- 
-- Structure de la table `concours`
-- 

CREATE TABLE `concours` (
  `id` int(10) NOT NULL auto_increment,
  `titre` varchar(80) character set utf8 NOT NULL,
  `description` longtext character set utf8 NOT NULL,
  `nbParticipant` int(10) NOT NULL default '0',
  `url` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `concours`
-- 

INSERT INTO `concours` (`id`, `titre`, `description`, `nbParticipant`, `url`) VALUES 
(1, 'Le mois d''ao?t, la couleur jaune !', 'Le moi d?ao?t, le mois des mirabelles ! C''est donc pour cela que nous avons tout simplement d?cid? de vous proposer un concours sur le th?me de la couleur jaune. Bien entendu, il est interdit de retoucher les photos via l''ordinateur. A gagner, ce mois-ci : Un abonnement ? la revue XY sp?cial photographe amateur, un abonement gold d''une dur?e de 3 mois et un abonement gold d''une dur?e d''un mois. Bon concours ? tous ! ', 12, './templates/images/img.jpeg');

-- --------------------------------------------------------

-- 
-- Structure de la table `images`
-- 

CREATE TABLE `images` (
  `id` int(11) NOT NULL auto_increment,
  `url` varchar(255) character set utf8 default NULL,
  `titre` varchar(70) character set utf8 default NULL,
  `description` varchar(255) character set utf8 default NULL,
  `view` int(10) NOT NULL default '0',
  `score` int(10) NOT NULL default '0',
  `idMembres` int(11) NOT NULL,
  `idConcours` int(10) NOT NULL,
  `idAlbum` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_images_membres` (`idMembres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- 
-- Contenu de la table `images`
-- 

INSERT INTO `images` (`id`, `url`, `titre`, `description`, `view`, `score`, `idMembres`, `idConcours`, `idAlbum`) VALUES 
(17, './pics/Pyro/Test/Koala.jpg', 'Koala', 'Un koala monte à un arbre.', 0, 0, 17, 0, 52),
(18, './pics/Pyro/Test/Tulips.jpg', 'Tulipes', 'Un champ de Tulipe', 2, 0, 17, 1, 52),
(19, './pics/Bad/exemple/Penguins.jpg', 'Manchots', 'Trois manchots en ronde', 0, 0, 18, 0, 53),
(20, './pics/Bad/exemple/Hydrangeas.jpg', 'Hortensias', 'Une jolie fleur.', 2, -1, 18, 1, 53),
(21, './pics/Flo/defaut/Jellyfish.jpg', 'Meduses', 'Meduses du pacifique nord', 2, 1, 19, 1, 55),
(22, './pics/Flo/defaut/Lighthouse.jpg', 'Phare', 'Phare breton au couché de soleil', 0, 0, 19, 0, 55),
(23, './pics/Flo/defaut/Chrysanthemum.jpg', 'Chrysanthème', 'Une jolie fleur', 0, 0, 19, 0, 55);

-- --------------------------------------------------------

-- 
-- Structure de la table `membres`
-- 

CREATE TABLE `membres` (
  `id` int(11) NOT NULL auto_increment,
  `pseudo` varchar(45) character set utf8 default NULL,
  `password` varchar(45) character set utf8 default NULL,
  `mail` varchar(255) character set utf8 default NULL,
  `sexe` varchar(10) character set utf8 default NULL,
  `avatar` varchar(255) character set utf8 NOT NULL default './templates/images/Avatar_defaut.jpg',
  `birthday` date default NULL,
  `cle` varchar(55) character set utf8 NOT NULL,
  `lastVisit` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- 
-- Contenu de la table `membres`
-- 

INSERT INTO `membres` (`id`, `pseudo`, `password`, `mail`, `sexe`, `avatar`, `birthday`, `cle`, `lastVisit`) VALUES 
(17, 'Pyro', 'ab4f63f9ac65152575886860dde480a1', 'pierre.charrasse@gmail.com', '1', './pics/Pyro/Crash-thumb.jpg', '0000-00-00', 'ec16edf4feebc11983b25119f9c62571', '2011-10-03 02:23:21'),
(18, 'Bad', 'ab4f63f9ac65152575886860dde480a1', 'jerome.wautrin@gmail.com', '1', './pics/Bad/1155161879_027.jpg', '0000-00-00', '191cfc4ba378e7f961e754d3c1266cd4', '2011-10-03 02:09:11'),
(19, 'Flo', '56910c52ed70539e3ce0391edeb6d339', 'Janson.florian@gmail.com', '1', './pics/Flo/images.jpg', '0000-00-00', '82f32da532ad14a8e6c3a97abded55aa', '2011-10-03 17:47:22');

-- --------------------------------------------------------

-- 
-- Structure de la table `vote`
-- 

CREATE TABLE `vote` (
  `id` int(10) NOT NULL auto_increment,
  `date` char(10) character set utf8 NOT NULL,
  `idImage` int(10) NOT NULL,
  `idMembre` int(10) NOT NULL,
  `vote` int(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Contenu de la table `vote`
-- 

INSERT INTO `vote` (`id`, `date`, `idImage`, `idMembre`, `vote`) VALUES 
(8, '03-10-2011', 20, 17, 0),
(7, '03-10-2011', 21, 17, 1),
(9, '03-10-2011', 20, 19, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `vue`
-- 

CREATE TABLE `vue` (
  `id` int(50) NOT NULL auto_increment,
  `date` char(10) character set utf8 NOT NULL,
  `ip` char(25) character set utf8 NOT NULL,
  `idImage` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Contenu de la table `vue`
-- 

INSERT INTO `vue` (`id`, `date`, `ip`, `idImage`) VALUES 
(11, '03-10-2011', '127.0.0.1', 18),
(10, '03-10-2011', '127.0.0.1', 20),
(9, '03-10-2011', '127.0.0.1', 21);
