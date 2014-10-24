-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 24 Octobre 2014 à 14:08
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `stackode`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `view` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `id_users` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Structure de la table `article_tags`
--

CREATE TABLE IF NOT EXISTS `article_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `id_tags` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `typeComRep` tinyint(1) NOT NULL,
  `id_reponse` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE IF NOT EXISTS `favoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reponse` text NOT NULL,
  `note` int(11) NOT NULL,
  `best` tinyint(1) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`id`, `reponse`, `note`, `best`, `dateCreated`, `dateModified`, `id_users`, `id_article`) VALUES
(1, 'ah bon', 0, 0, '2014-10-24 10:32:25', '2014-10-24 10:32:25', 12, 2),
(3, 'Voici une question un peu plus longue ?12345678913456Voici une question un peu plus longue ?12345678913456Voici une question un peu plus longue ?12345678913456', 0, 0, '2014-10-24 11:17:31', '2014-10-24 11:17:31', 12, 2),
(4, 'ok\r\n', 0, 0, '2014-10-24 11:57:00', '2014-10-24 11:57:00', 12, 2),
(5, 'ok salut', 0, 0, '2014-10-24 12:03:16', '2014-10-24 12:03:16', 12, 2),
(6, '123132\r\n123123', 0, 0, '2014-10-24 12:19:55', '2014-10-24 12:19:55', 12, 7),
(7, '456789456\r\n', 0, 0, '2014-10-24 12:21:45', '2014-10-24 12:21:45', 12, 10),
(8, '1231321321321321321321321', 0, 0, '2014-10-24 12:29:32', '2014-10-24 12:29:32', 12, 10),
(9, 'rtgebtr"gez', 0, 0, '2014-10-24 13:47:03', '2014-10-24 13:47:03', 12, 10);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_article` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `name`, `id_article`) VALUES
(1, 'bébé', 2),
(2, 'comment', 2),
(3, 'pourquoi', 2),
(4, 'pomme', 0),
(5, 'beurk', 0),
(6, 'pomme', 3),
(7, 'beurk', 3),
(8, 'bidule', 0),
(9, 'bidule', 4),
(10, 'bidulebidule', 5),
(11, 'bidulebidulebidule', 0),
(12, 'bidulebidulebidulebidule', 6),
(13, '1234567789', 0),
(14, '123123', 0),
(15, '123', 7),
(16, '123123123123', 8),
(17, 'zizi', 9),
(18, 'zizizizi', 9),
(19, 'zizi', 10),
(20, '123', 10);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `metier` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `webSite` varchar(255) NOT NULL,
  `github` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `details` text NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `isBanned` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `pwd`, `salt`, `token`, `location`, `metier`, `avatar`, `webSite`, `github`, `score`, `status`, `details`, `dateCreated`, `dateModified`, `isActive`, `isBanned`) VALUES
(1, 'maxthetiger', 'maxthetiger@gmail.com', 'ca45f1aefe937959446e18fb6eada94adf1e567eca80bed1fca012fa2f0a23438d756304648d14b98863fb274f67458193dbe812a31650ffbd097e748fd22cd8', 'W7W87dw9qVc4TNdeWNWZPVlsdU844FeSpPSTnt0hX0kLef04sd', 'TGySC3jKfmJ4ddQRj31eIIKB2RUnaDoRvGhjJH69VUe7qRru25', 'Paris, France', 'Développeur Web', 'maxthetiger.jpg', 'www.maxthetiger@gmail.com', 'https://github.com/maxthetiger/', 0, 0, 'Welcome Everybody ! Don''t search, THE ANSWER IS 42', '2014-10-22 11:43:13', '2014-10-23 17:29:44', 0, 0),
(12, '123', '123@aa.fr', 'caf7b704ca98a7505d8d499d01c72877c8f3188e8f181df39bd7143f66dfca58f021b7f8189614f6f7618ccf974e9a80758587ce4ef7d96aa93803c06817342c', 'R3iG6KPkaRGGFTv5FrwyM2u5mE2piMRywgYZYj4W5gl8JubZDR', '8KmmoSrTYtEJTevGfRRlv0c0g1bdKU6tyKDURgCZyVITGXH7lY', 'Asnières-sur-Seine, France', 'compteur', '123.jpg', 'www.pompom.fr', 'www.github.com/123', 37, 0, '', '2014-10-23 14:48:39', '2014-10-24 14:03:07', 0, 0),
(13, '123123', '123123@aa.fr', '24f95047b045772c89308657eb80d66749837d6c0923af60b9716bfa7fdcee82b49c8b861150a8b231d68b729a0d10bed01b8f80375bf542d62abc7c32c89560', 'Fr6MxalZXu9YEIPKHrlUAaZ4xNOZJdeuHscTyzEfGLTJqmblJh', 'whBQvonUVnet904XmbAjKegRxkDtEbyUR12f3bkT5voMK10oyv', '', '', 'avatar/avatar_200.png', '', '', 0, 0, '', '2014-10-23 14:50:32', '2014-10-23 14:50:32', 0, 0),
(14, 'zizi', 'zizi@zi.zi', '27b8763863a6979240095fd2fad4b4d9850aeb99c37ec3219800d76cfab58a1ceb0f83bb6f996bdab9f7d8b20a91086c94d44cc52434dafe269aaced05ee5f23', 'b0EFHYnqy2DFmoZ8TtemsWtKA51wW9k7ut2DfsFhcR67pFzfb0', 'sXRNdKRQYOJK7K7W9g8vSyNwIaW98QBSaPU3VjSroGfMILuUUg', 'Žižice, République tchèque', 'zizi top', 'zizi.jpg', 'www.zizi.fr', 'www.github.com/zizi', 0, 0, 'zizi forever', '2014-10-24 10:22:32', '2014-10-24 10:25:06', 0, 0),
(15, 'zozo', 'zozo@zozo.fr', '476a23e9a2dd02d4efc926e65ba61affe9db728544e894a961f570c19c3877d312972315a066b8a68cff865d61bebe0dedf6a9e436263de475f5c4537f61e7da', 'KDwElfMcuf1zd6MJusqO5uTRGuqLYKNUJGZo3pG6P1MU7gO3lp', 'HwOZaYrbgM8Ev4ety1y4Q5Cyo1hGNgmiljQUB3CQ2Htugt72ox', 'Zozoranga, Loja, Ecuador', 'zoologue', 'zozo.jpg', 'www.zozo.fr', 'www.github.com/zozo', 1, 0, 'comme c''est zozozoli!!', '2014-10-24 12:06:25', '2014-10-24 12:16:03', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
