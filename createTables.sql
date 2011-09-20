-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Mardi 20 Septembre 2011 à 21:08
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
  `titre` varchar(60) NOT NULL,
  `idMembres` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- 
-- Contenu de la table `albums`
-- 

INSERT INTO `albums` (`id`, `titre`, `idMembres`) VALUES 
(1, 'Animaux', 11),
(2, 'Ciboulette', 11),
(3, 'defaut', 0),
(32, 'defaut', 13),
(31, 'defaut', 13),
(30, 'a', 13),
(29, 'fredsq', 13),
(28, 'decvx', 13),
(27, 'animou', 13),
(26, 'testgfr', 13),
(25, 'guyli', 13),
(24, 'de', 13);

-- --------------------------------------------------------

-- 
-- Structure de la table `commentaires`
-- 

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL auto_increment,
  `message` longtext,
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
  `titre` varchar(80) NOT NULL,
  `description` longtext NOT NULL,
  `nbParticipant` int(10) NOT NULL default '0',
  `url` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `concours`
-- 

INSERT INTO `concours` (`id`, `titre`, `description`, `nbParticipant`, `url`) VALUES 
(1, 'Le mois d''août, la couleur jaune !', 'Le moi d’août, le mois des mirabelles ! C''est donc pour cela que nous avons tout simplement décidé de vous proposer un concours sur le thème de la couleur jaune. Bien entendu, il est interdit de retoucher les photos via l''ordinateur. A gagner, ce mois-ci : Un abonnement à la revue XY spécial photographe amateur, un abonement gold d''une durée de 3 mois et un abonement gold d''une durée d''un mois. Bon concours à tous ! ', 7, './templates/images/img.jpeg');

-- --------------------------------------------------------

-- 
-- Structure de la table `images`
-- 

CREATE TABLE `images` (
  `id` int(11) NOT NULL auto_increment,
  `url` varchar(255) default NULL,
  `titre` varchar(70) default NULL,
  `description` varchar(255) default NULL,
  `view` int(10) NOT NULL default '0',
  `score` decimal(10,1) NOT NULL default '0.0',
  `idMembres` int(11) NOT NULL,
  `idConcours` int(10) NOT NULL,
  `idAlbum` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_images_membres` (`idMembres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Contenu de la table `images`
-- 

INSERT INTO `images` (`id`, `url`, `titre`, `description`, `view`, `score`, `idMembres`, `idConcours`, `idAlbum`) VALUES 
(1, NULL, 'test kikou', 'test de kilou lol ++', 0, 0.0, 11, 0, 1),
(2, NULL, 'test kikou', 'test de kilou lol ++', 0, 0.0, 11, 0, 1),
(3, NULL, 'test kikou', 'test de kilou lol ++', 0, 0.0, 11, 0, 1),
(4, NULL, 'test kikou', 'test de kilou lol ++', 0, 0.0, 11, 0, 1),
(5, NULL, 'test kikou', 'test de kilou lol ++', 0, 0.0, 11, 0, 1),
(9, './pics/Flo/Animaux/SAM_0023.jpg', 'reedfrfrfrfrf', 'frrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 0, 0.0, 11, 1, 1);

-- --------------------------------------------------------

-- 
-- Structure de la table `membres`
-- 

CREATE TABLE `membres` (
  `id` int(11) NOT NULL auto_increment,
  `pseudo` varchar(45) default NULL,
  `password` varchar(45) default NULL,
  `mail` varchar(255) default NULL,
  `sexe` varchar(10) default NULL,
  `avatar` varchar(255) NOT NULL default './templates/images/Avatar_defaut.jpg',
  `birthday` date default NULL,
  `cle` varchar(55) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Contenu de la table `membres`
-- 

INSERT INTO `membres` (`id`, `pseudo`, `password`, `mail`, `sexe`, `avatar`, `birthday`, `cle`) VALUES 
(8, 'Zoz', 'ee8e921499f6b8051b7c6667985b4e62', 'florian.janson@gmail.com', '1', '', '1989-11-07', '224a1638f54243b5bccd8e6c9a38d3bb'),
(11, 'Flo', '56910c52ed70539e3ce0391edeb6d339', 'heberg.disocunt@gmail.com', '1', './templates/images/Avatar_defaut.jpg', '1917-01-18', '89000665051d12e173f1e56ebb5cbdb0'),
(12, 'Zozor', '56910c52ed70539e3ce0391edeb6d339', 'toto@toto.com', '1', '', '1989-11-07', '84df3e139094919a562cc8c4ae6f8e83'),
(13, 'test', 'cc03e747a6afbbcbf8be7668acfebee5', 'test@test.com', '1', './templates/images/Avatar_defaut.jpg', '1900-01-01', 'c72545aaccbb875d753f00f247ffbfb8'),
(14, '0000', '670b14728ad9902aecba32e22fa4f6bd', 'de@de.de', '1', './templates/images/Avatar_defaut.jpg', '1900-01-01', '1bcfb18a8ca2175339555c41efc0558e'),
(15, 'frigadel', '56910c52ed70539e3ce0391edeb6d339', 'fr@fr.fr', '1', './templates/images/Avatar_defaut.jpg', '1900-01-01', '8dc988b9b473eb1ae68838ba899b7e91');
