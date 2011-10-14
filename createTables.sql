-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Vendredi 14 Octobre 2011 à 11:50
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Contenu de la table `actions`
-- 

INSERT INTO `actions` (`id`, `idMembre`, `actions`, `timestamp`) VALUES 
(9, 19, '<font color="#06C">Flo</font> a modifié son avatar', '2011-10-12 20:30:39'),
(8, 19, '<font color="#06C">Flo</font> a ajouté une photo à sa <a href="index.php?p=getGalerie&album=55">gallerie</a>', '2011-10-12 19:31:58'),
(6, 19, '<font color="#06C">Flo</font> a ajouté une photo à sa <a href="index.php?p=getAlbum&id=19">gallerie</a>', '2011-10-12 18:25:07'),
(7, 19, '<font color="#06C">Flo</font> a modifié son avatar', '2011-10-12 18:28:52');

-- --------------------------------------------------------

-- 
-- Structure de la table `albums`
-- 

CREATE TABLE `albums` (
  `id` int(10) NOT NULL auto_increment,
  `titre` varchar(60) character set utf8 NOT NULL,
  `idMembres` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

-- 
-- Contenu de la table `albums`
-- 

INSERT INTO `albums` (`id`, `titre`, `idMembres`) VALUES 
(51, '', 17),
(52, 'Test', 17),
(53, 'exemple', 18),
(55, 'defaut', 19),
(56, 'Nature morte', 19),
(57, 'n', 19),
(58, 's', 19),
(59, 'plok', 19),
(70, 'new01', 20),
(69, 'bhftd', 20),
(68, 'defaut', 20),
(67, 'new2', 19);

-- --------------------------------------------------------

-- 
-- Structure de la table `commentaire`
-- 

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL auto_increment,
  `message` longtext character set utf8,
  `timestamp` timestamp NULL default CURRENT_TIMESTAMP,
  `idMembre` int(11) NOT NULL,
  `idImage` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_commentaires_membres1` (`idMembre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Contenu de la table `commentaire`
-- 

INSERT INTO `commentaire` (`id`, `message`, `timestamp`, `idMembre`, `idImage`) VALUES 
(1, 'test', '2011-10-14 11:09:13', 19, 21),
(2, 'test2', '2011-10-14 11:19:17', 19, 21),
(3, 'test4', '2011-10-14 11:19:36', 19, 21),
(4, 'test21', '2011-10-14 11:20:09', 19, 21);

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
(1, 'Le mois d''août, la couleur jaune !', 'Le moi d?ao?t, le mois des mirabelles ! C''est donc pour cela que nous avons tout simplement d?cid? de vous proposer un concours sur le th?me de la couleur jaune. Bien entendu, il est interdit de retoucher les photos via l''ordinateur. A gagner, ce mois-ci : Un abonnement ? la revue XY sp?cial photographe amateur, un abonement gold d''une dur?e de 3 mois et un abonement gold d''une dur?e d''un mois. Bon concours ? tous ! ', 13, './templates/images/img.jpeg');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

-- 
-- Contenu de la table `images`
-- 

INSERT INTO `images` (`id`, `url`, `titre`, `description`, `view`, `score`, `idMembres`, `idConcours`, `idAlbum`) VALUES 
(17, './pics/Pyro/Test/Koala.jpg', 'Koala', 'Un koala monte à un arbre.', 0, 0, 17, 0, 52),
(18, './pics/Pyro/Test/Tulips.jpg', 'Tulipes', 'Un champ de Tulipe', 5, 2, 17, 1, 52),
(19, './pics/Bad/exemple/Penguins.jpg', 'Manchots', 'Trois manchots en ronde', 0, 0, 18, 0, 53),
(20, './pics/Bad/exemple/Hydrangeas.jpg', 'Hortensias', 'Une jolie fleur.', 5, 0, 18, 1, 53),
(21, './pics/Flo/defaut/Jellyfish.jpg', 'Meduses', 'Meduses du pacifique nord', 8, 1, 19, 1, 55),
(22, './pics/Flo/defaut/Lighthouse.jpg', 'Phare', 'Phare breton au couché de soleil', 0, 0, 19, 0, 55),
(23, './pics/Flo/defaut/Chrysanthemum.jpg', 'Chrysanthème', 'Une jolie fleur', 0, 0, 19, 0, 55),
(24, './pics/Flo/Nature morte/aime.jpg', 'Photo de test', 'testtesttestrredecccccc', 0, 0, 19, 0, 56),
(25, './pics/Flo/Nature morte/SAM_2509.JPG', 'testtttttttt', 'testttttttttttttttttttttttt', 0, 0, 19, 0, 56),
(26, './pics/Flo/Nature morte/606SAM_2509.JPG', 'testtttttttt', 'testttttttttttttttttttttttt', 0, 0, 19, 0, 56),
(30, './pics/Flo/Nature morte/SAM_2498.JPG', 'eeeeeeeeeeeeeeeeeeeeeeee', 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 0, 0, 19, 0, 56),
(32, './pics/Flo/defaut/SAM_2472.JPG', 'testtttttt', 'testtttttttttttttttttttttttttttt', 0, 0, 19, 0, 55),
(33, './pics/Flo/n/SAM_2471.JPG', 'aaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaa', 0, 0, 19, 0, 57),
(34, './pics/Flo/n/4759SAM_2471.JPG', 'aaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaa', 0, 0, 19, 0, 57),
(35, './pics/Flo/n/SAM_2492.JPG', 'ttttttttttttttt', 'ttttttttttttttttttttttttttttttttt', 0, 0, 19, 0, 57),
(44, './pics/Flo/plok/Autumn Leaves.jpg', 'test du logo sur image', 'test du logo sur image ++', 0, 0, 19, 0, 59),
(46, './pics/Flo/Nature morte/Autumn Leaves.jpg', 'aaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaa', 0, 0, 19, 0, 56),
(47, './pics/e-vasions/defaut/Green Sea Turtle.jpg', 'Une tortue en mer', 'Une tortue en pleine mer qui s''amuse à jouer à la corde à sauter', 2, 1, 20, 1, 68),
(48, './pics/Flo/defaut/Dock.jpg', 'wwwwwwww', 'wwwwwwwwwwwwwwwwwwwwww', 0, 0, 19, 0, 55),
(49, './pics/Flo/defaut/24386Dock.jpg', 'wwwwwwww', 'wwwwwwwwwwwwwwwwwwwwww', 0, 0, 19, 0, 55),
(50, './pics/Flo/defaut/Garden.jpg', 'getGalerie&album=', 'getGalerie&album=55getGalerie&album=55', 0, 0, 19, 0, 55);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- 
-- Contenu de la table `membres`
-- 

INSERT INTO `membres` (`id`, `pseudo`, `password`, `mail`, `sexe`, `avatar`, `birthday`, `cle`, `lastVisit`) VALUES 
(17, 'Pyro', 'ab4f63f9ac65152575886860dde480a1', 'pierre.charrasse@gmail.com', '1', './pics/Pyro/Crash-thumb.jpg', '0000-00-00', 'ec16edf4feebc11983b25119f9c62571', '2011-10-03 02:23:21'),
(18, 'Bad', 'ab4f63f9ac65152575886860dde480a1', 'jerome.wautrin@gmail.com', '1', './pics/Bad/1155161879_027.jpg', '0000-00-00', '191cfc4ba378e7f961e754d3c1266cd4', '2011-10-03 02:09:11'),
(19, 'Flo', '56910c52ed70539e3ce0391edeb6d339', 'Janson.florian@gmail.com', '1', './pics/Flo/6297Toco Toucan.jpg', '0000-00-00', '82f32da532ad14a8e6c3a97abded55aa', '2011-10-14 10:46:50'),
(20, 'e-vasions', '8308d6914dd8fae92d3fa395f63dcb1f', 'e-vasions@hotmail.com', '2', './pics/e-vasions/SAM_2509.JPG', '0000-00-00', '664fc9158674259e8e8906ffbb5ae023', '2011-10-10 20:30:27'),
(21, 'w@w.com', '56910c52ed70539e3ce0391edeb6d339', 'w@w.com', '1', './templates/images/Avatar_defaut.jpg', '2003-06-18', 'ed0f3cda79c014769320b4e3239ab9bd', '2011-10-12 22:25:10');

-- --------------------------------------------------------

-- 
-- Structure de la table `messagerie`
-- 

CREATE TABLE `messagerie` (
  `id` int(10) NOT NULL,
  `expediteur` int(10) NOT NULL,
  `destinataire` int(10) NOT NULL,
  `sujet` varchar(50) character set utf8 NOT NULL,
  `message` text character set utf8 NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `etat` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Contenu de la table `messagerie`
-- 


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Contenu de la table `vote`
-- 

INSERT INTO `vote` (`id`, `date`, `idImage`, `idMembre`, `vote`) VALUES 
(15, '12-10-2011', 47, 19, 1),
(7, '03-10-2011', 21, 17, 1),
(14, '10-10-2011', 20, 19, 1),
(12, '05-10-2011', 18, 19, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- 
-- Contenu de la table `vue`
-- 

INSERT INTO `vue` (`id`, `date`, `ip`, `idImage`) VALUES 
(18, '08-10-2011', '127.0.0.1', 18),
(21, '10-10-2011', '127.0.0.1', 20),
(25, '14-10-2011', '127.0.0.1', 21),
(24, '12-10-2011', '127.0.0.1', 47);
