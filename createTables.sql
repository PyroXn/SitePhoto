-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Jeudi 24 Novembre 2011 à 11:35
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- 
-- Contenu de la table `actions`
-- 

INSERT INTO `actions` (`id`, `idMembre`, `actions`, `timestamp`) VALUES 
(1, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=21">Meduses</a>', '2011-10-14 15:20:09'),
(2, 19, '<font color="#06C">Flo</font> a modifié son avatar', '2011-10-14 15:20:31'),
(3, 19, '<font color="#06C">Flo</font> a modifié son avatar', '2011-10-14 15:20:41'),
(4, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=21">Meduses</a>', '2011-10-14 15:20:54'),
(5, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=22">Phare</a>', '2011-10-14 15:26:11'),
(6, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=47">Une tortue en mer</a>', '2011-10-14 15:27:32'),
(7, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=21">Meduses</a>', '2011-10-14 15:39:32'),
(8, 19, '<font color="#06C">Flo</font> a ajouté une photo à sa <a href="index.php?p=getGalerie&album=55">gallerie</a>', '2011-10-14 15:49:04'),
(9, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=51">aaaaaaaaaaaaaaaaa</a>', '2011-10-14 15:49:49'),
(10, 19, '<font color="#06C">Flo</font> a ajouté une photo à sa <a href="index.php?p=getGalerie&album=71">gallerie</a>', '2011-10-14 15:53:27'),
(11, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=21">Meduses</a>', '2011-10-14 16:04:49'),
(12, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=21">Meduses</a>', '2011-10-14 16:05:59'),
(13, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=49">wwwwwwww</a>', '2011-10-14 17:53:57'),
(14, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=49">wwwwwwww</a>', '2011-10-14 17:54:00'),
(15, 19, '<font color="#06C">Flo</font> a modifié son avatar', '2011-10-14 18:57:24'),
(16, 19, '<font color="#06C">Flo</font> a modifié son avatar', '2011-10-14 18:58:45'),
(17, 19, '<font color="#06C">Flo</font> a ajouté une photo à sa <a href="index.php?p=getGalerie&album=55">gallerie</a>', '2011-10-15 13:22:42'),
(18, 19, '<font color="#06C">Flo</font> a modifié son avatar', '2011-10-15 14:57:46'),
(19, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=21">Meduses</a>', '2011-10-15 17:41:37'),
(20, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=21">Meduses</a>', '2011-10-15 17:41:54'),
(21, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=21">Meduses</a>', '2011-10-17 16:22:30'),
(22, 19, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=47">Une tortue en mer</a>', '2011-10-17 17:02:25'),
(23, 20, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=47">Une tortue en mer</a>', '2011-10-17 17:07:04'),
(24, 20, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=47">Une tortue en mer</a>', '2011-10-17 17:07:29'),
(25, 20, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=47">Une tortue en mer</a>', '2011-10-19 12:26:57'),
(26, 20, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=47">Une tortue en mer</a>', '2011-10-19 12:27:32'),
(27, 20, '<font color="#06C">Flo</font> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=47">Une tortue en mer</a>', '2011-10-19 12:27:37'),
(28, 19, '<a class="pseudo_homme" href="index.php?p=profil&id=19">Flo</a> a ajouté une photo dans son album <a href="index.php?p=getGalerie&album=56">Nature morte</a>', '2011-10-19 15:58:18'),
(29, 19, '<a class="pseudo_homme" href="index.php?p=profil&id=19">Flo</a> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=52">Une photo !</a>', '2011-10-19 15:58:41'),
(30, 19, '<img src="thumb.php?src=./pics/Flo/Creek.jpg&x=30&y=30&f=0"></img><a class="pseudo_homme" href="index.php?p=profil&id=19">Flo</a> a modifié son avatar', '2011-10-19 16:03:09'),
(31, 19, '<img src="thumb.php?src=./pics/Flo/Creek.jpg&x=30&y=30&f=0"></img><a class="pseudo_homme" href="index.php?p=profil&id=19">Flo</a> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=52">Une photo !</a>', '2011-10-19 16:37:32'),
(32, 19, '<img src="thumb.php?src=./pics/Flo/Creek.jpg&x=30&y=30&f=0"></img><a class="pseudo_homme" href="index.php?p=profil&id=19">Flo</a> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=52">Une photo !</a>', '2011-10-19 17:12:59'),
(33, 20, '<img src="thumb.php?src=./pics/Flo/Creek.jpg&x=30&y=30&f=0"></img><a class="pseudo_homme" href="index.php?p=profil&id=19">Flo</a> a commenté la photo intitulé <a href="index.php?p=getPhoto&id=47">Une tortue en mer</a>', '2011-10-19 17:15:15'),
(36, 22, '<img src="thumb.php?src=./templates/images/Avatar_defaut.jpg&x=30&y=30&f=0"></img><a class="pseudo_femme" href="index.php?p=profil&id=22">titi</a> a ajouté une photo dans son album <a href="index.php?p=getGalerie&album=72">defaut</a>', '2011-11-10 16:42:42');

-- --------------------------------------------------------

-- 
-- Structure de la table `albums`
-- 

CREATE TABLE `albums` (
  `id` int(10) NOT NULL auto_increment,
  `titre` varchar(60) character set utf8 NOT NULL,
  `idMembres` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

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
(72, 'defaut', 22),
(71, 'delete', 19),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- 
-- Contenu de la table `commentaire`
-- 

INSERT INTO `commentaire` (`id`, `message`, `timestamp`, `idMembre`, `idImage`) VALUES 
(1, 'Trop kikoo ta photo', '2011-10-14 15:20:54', 19, 21),
(2, 'j''aime bien :)', '2011-10-14 15:26:11', 19, 22),
(3, 'Pas mal du tout :)', '2011-10-14 15:27:32', 19, 47),
(4, 'test\navec\nsaut\nde\nligne', '2011-10-14 15:39:32', 19, 21),
(5, 'abc', '2011-10-14 15:49:49', 19, 51),
(6, 'éà j''aime les "eco" è ! ô û', '2011-10-14 16:04:49', 19, 21),
(7, 'test <br />\na<br />\nb<br />\nc', '2011-10-14 16:05:59', 19, 21),
(8, 'q', '2011-10-14 17:53:57', 19, 49),
(9, 'q', '2011-10-14 17:54:00', 19, 49),
(10, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2011-10-15 17:41:37', 19, 21),
(11, 'aaaaaaaaaaaaaaa', '2011-10-15 17:41:54', 19, 21),
(12, 'Je<br />\nvais<br />\ndonc<br />\ntester<br />\nle<br />\nsystème<br />\nde<br />\ncommentaire', '2011-10-17 16:22:30', 19, 21),
(13, 'cool :)', '2011-10-17 17:02:25', 19, 47),
(14, 'bisous bisous', '2011-10-17 17:07:29', 19, 47),
(15, 'test', '2011-10-19 12:26:57', 19, 47),
(16, 'test', '2011-10-19 12:27:32', 19, 47),
(17, 'test3', '2011-10-19 12:27:37', 19, 47),
(18, 'Test !', '2011-10-19 15:53:11', 19, 52),
(19, 'commentaire', '2011-10-19 15:53:34', 19, 52),
(20, 'test', '2011-10-19 15:58:41', 19, 52),
(21, 'ok', '2011-10-19 16:37:32', 19, 52),
(22, 'tesst', '2011-10-19 17:12:59', 19, 52),
(23, ':)', '2011-10-19 17:15:15', 19, 47),
(24, 'test 5', '2011-11-06 12:34:31', 19, 52),
(25, 'etoh !', '2011-11-06 12:35:04', 19, 52),
(26, 'test', '2011-11-06 13:00:15', 19, 52);

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
(1, 'Le mois d''août, la couleur jaune !', 'Le moi d?ao?t, le mois des mirabelles ! C''est donc pour cela que nous avons tout simplement d?cid? de vous proposer un concours sur le th?me de la couleur jaune. Bien entendu, il est interdit de retoucher les photos via l''ordinateur. A gagner, ce mois-ci : Un abonnement ? la revue XY sp?cial photographe amateur, un abonement gold d''une dur?e de 3 mois et un abonement gold d''une dur?e d''un mois. Bon concours ? tous ! ', 15, './templates/images/img.jpeg');

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
  `etat` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `fk_images_membres` (`idMembres`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

-- 
-- Contenu de la table `images`
-- 

INSERT INTO `images` (`id`, `url`, `titre`, `description`, `view`, `score`, `idMembres`, `idConcours`, `idAlbum`, `etat`) VALUES 
(17, './pics/Pyro/Test/Koala.jpg', 'Koala', 'Un koala monte à un arbre.', 0, 0, 17, 0, 52, 0),
(18, './pics/Pyro/Test/Tulips.jpg', 'Tulipes', 'Un champ de Tulipe', 5, 2, 17, 1, 52, 0),
(19, './pics/Bad/exemple/Penguins.jpg', 'Manchots', 'Trois manchots en ronde', 0, 0, 18, 0, 53, 0),
(20, './pics/Bad/exemple/Hydrangeas.jpg', 'Hortensias', 'Une jolie fleur.', 5, 0, 18, 1, 53, 0),
(22, './pics/Flo/defaut/Lighthouse.jpg', 'Phare', 'Phare breton au couché de soleil', 0, 0, 19, 0, 55, 0),
(23, './pics/Flo/defaut/Chrysanthemum.jpg', 'Chrysanthème', 'Une jolie fleur', 0, 0, 19, 0, 55, 0),
(24, './pics/Flo/Nature morte/aime.jpg', 'Photo de test', 'testtesttestrredecccccc', 0, 0, 19, 0, 56, 0),
(25, './pics/Flo/Nature morte/SAM_2509.JPG', 'testtttttttt', 'testttttttttttttttttttttttt', 0, 0, 19, 0, 56, 0),
(26, './pics/Flo/Nature morte/606SAM_2509.JPG', 'testtttttttt', 'testttttttttttttttttttttttt', 0, 0, 19, 0, 56, 0),
(30, './pics/Flo/Nature morte/SAM_2498.JPG', 'eeeeeeeeeeeeeeeeeeeeeeee', 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 0, 0, 19, 0, 56, 0),
(32, './pics/Flo/defaut/SAM_2472.JPG', 'testtttttt', 'testtttttttttttttttttttttttttttt', 0, 0, 19, 0, 55, 0),
(47, './pics/e-vasions/defaut/Green Sea Turtle.jpg', 'Une tortue en mer', 'Une tortue en pleine mer qui s''amuse à jouer à la corde à sauter', 5, 1, 20, 1, 68, 0),
(48, './pics/Flo/defaut/Dock.jpg', 'wwwwwwww', 'wwwwwwwwwwwwwwwwwwwwww', 0, 0, 19, 0, 55, 0),
(49, './pics/Flo/defaut/24386Dock.jpg', 'wwwwwwww', 'wwwwwwwwwwwwwwwwwwwwww', 0, 0, 19, 0, 55, 0),
(50, './pics/Flo/defaut/Garden.jpg', 'getGalerie&album=', 'getGalerie&album=55getGalerie&album=55', 0, 0, 19, 0, 55, 0),
(51, './pics/Flo/defaut/SAM_2506.JPG', 'aaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaa', 0, 0, 19, 0, 55, 0),
(52, './pics/Flo/defaut/Toco Toucan.jpg', 'Une photo !', 'Et voila ! Encore une nouvelle photo ! Héhé !', 5, 0, 19, 1, 55, 0),
(53, './pics/Flo/delete/Oryx Antelope.jpg', 'xxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxx', 0, 0, 19, 0, 71, 0),
(54, './pics/Flo/Nature morte/Forest Flowers.jpg', 'cccccccccccccccc', 'ccccccccccccccccccccccccccccccc', 0, 0, 19, 0, 56, 0),
(55, './pics/titi/defaut/Tree.jpg', 'Test d''image', 'Je test une image pour verifier', 1, 0, 22, 1, 72, 1);

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
  `admin` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- 
-- Contenu de la table `membres`
-- 

INSERT INTO `membres` (`id`, `pseudo`, `password`, `mail`, `sexe`, `avatar`, `birthday`, `cle`, `lastVisit`, `admin`) VALUES 
(17, 'Pyro', 'ab4f63f9ac65152575886860dde480a1', 'pierre.charrasse@gmail.com', '1', './pics/Pyro/Crash-thumb.jpg', '0000-00-00', 'ec16edf4feebc11983b25119f9c62571', '2011-10-03 02:23:21', 0),
(18, 'Bad', 'ab4f63f9ac65152575886860dde480a1', 'jerome.wautrin@gmail.com', '1', './pics/Bad/1155161879_027.jpg', '0000-00-00', '191cfc4ba378e7f961e754d3c1266cd4', '2011-10-03 02:09:11', 0),
(19, 'Flo', '56910c52ed70539e3ce0391edeb6d339', 'Janson.florian@gmail.com', '1', './pics/Flo/25144SAM_2509.JPG', '0000-00-00', '82f32da532ad14a8e6c3a97abded55aa', '2011-11-10 16:53:25', 1),
(20, 'e-vasions', '8308d6914dd8fae92d3fa395f63dcb1f', 'e-vasions@hotmail.com', '2', './pics/e-vasions/SAM_2509.JPG', '0000-00-00', '664fc9158674259e8e8906ffbb5ae023', '2011-10-10 20:30:27', 0),
(21, 'w@w.com', '56910c52ed70539e3ce0391edeb6d339', 'w@w.com', '1', './templates/images/Avatar_defaut.jpg', '2003-06-18', 'ed0f3cda79c014769320b4e3239ab9bd', '2011-10-12 22:25:10', 0),
(22, 'titi', '56910c52ed70539e3ce0391edeb6d339', 'tutu@toto.com', '2', './templates/images/Avatar_defaut.jpg', '1989-11-07', 'f394b36f599120345d57237ca8b77981', '2011-11-10 16:42:16', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- 
-- Contenu de la table `vue`
-- 

INSERT INTO `vue` (`id`, `date`, `ip`, `idImage`) VALUES 
(18, '08-10-2011', '127.0.0.1', 18),
(21, '10-10-2011', '127.0.0.1', 20),
(28, '17-10-2011', '127.0.0.1', 21),
(30, '19-10-2011', '127.0.0.1', 47),
(35, '10-11-2011', '127.0.0.1', 52),
(36, '10-11-2011', '127.0.0.1', 55);
