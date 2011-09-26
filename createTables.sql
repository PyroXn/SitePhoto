-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Lundi 26 Septembre 2011 à 17:43
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;


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
(1, 'Le mois d''août, la couleur jaune !', 'Le moi d’août, le mois des mirabelles ! C''est donc pour cela que nous avons tout simplement décidé de vous proposer un concours sur le thème de la couleur jaune. Bien entendu, il est interdit de retoucher les photos via l''ordinateur. A gagner, ce mois-ci : Un abonnement à la revue XY spécial photographe amateur, un abonement gold d''une durée de 3 mois et un abonement gold d''une durée d''un mois. Bon concours à tous ! ', 9, './templates/images/img.jpeg');

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
  `score` int(10) NOT NULL default '0',
  `idMembres` int(11) NOT NULL,
  `idConcours` int(10) NOT NULL,
  `idAlbum` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_images_membres` (`idMembres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

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
  `lastVisit` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `vote`
-- 

CREATE TABLE `vote` (
  `id` int(10) NOT NULL auto_increment,
  `date` char(10) NOT NULL,
  `idImage` int(10) NOT NULL,
  `idMembre` int(10) NOT NULL,
  `vote` int(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `vue`
-- 

CREATE TABLE `vue` (
  `id` int(50) NOT NULL auto_increment,
  `date` char(10) NOT NULL,
  `ip` char(25) NOT NULL,
  `idImage` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

