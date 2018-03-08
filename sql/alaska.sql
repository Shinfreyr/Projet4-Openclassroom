-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 08 mars 2018 à 10:57
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `base_alaska`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

CREATE TABLE `account` (
  `idAccount` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `firstName` varchar(25) DEFAULT NULL,
  `lastName` varchar(25) DEFAULT NULL,
  `eMail` varchar(60) NOT NULL,
  `avatar` varchar(60) DEFAULT NULL,
  `pass` char(60) NOT NULL,
  `accountStatue` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `account`
--

INSERT INTO `account` (`idAccount`, `pseudo`, `firstName`, `lastName`, `eMail`, `avatar`, `pass`, `accountStatue`) VALUES
(1, 'TESTOR', 'Test', 'TEST', 'test@test.fr', 'defautUser.jpg', 'test', 'Admin'),
(2, 'Test', 'Inscription', 'Numéro1', 'test@test.test', 'defautUser.jpg', '$2y$10$xyjxWg9K/mcbLf4qHMzK2O/GNRick5nDxoh9DLYJ.AQIeJa7KN4au', 'User'),
(3, 'test2', 'Nouveau', 'TEST', 'test2@test2.test2', 'defautUser.jpg', '$2y$10$IDp6xzwd/Ml7vwfM12vJy.HXdSoIoeplx9x./Hc.sKAFEncPyDI4m', 'User');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `idComments` int(11) NOT NULL,
  `contentComment` text NOT NULL,
  `dateComment` datetime NOT NULL,
  `alertComment` int(11) DEFAULT '0',
  `statueComment` varchar(25) NOT NULL,
  `idAccount` int(11) NOT NULL,
  `idPost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`idComments`, `contentComment`, `dateComment`, `alertComment`, `statueComment`, `idAccount`, `idPost`) VALUES
(1, 'Ceci est un comment test', '2018-02-26 00:00:00', 0, 'Post', 1, 1),
(2, 'Ceci est un autre commentaires test', '2018-03-05 00:00:00', 0, 'Post', 1, 1),
(3, 'Un commentaire pour tester la correct répartition de ces premiers vis a vis des posts associé', '2018-03-05 07:42:41', 4, 'Post', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `idPost` int(11) NOT NULL,
  `titlePost` text NOT NULL,
  `contentPost` longtext,
  `imagePost` varchar(60) DEFAULT NULL,
  `datePost` datetime NOT NULL,
  `postStatue` varchar(25) NOT NULL,
  `idAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`idPost`, `titlePost`, `contentPost`, `imagePost`, `datePost`, `postStatue`, `idAccount`) VALUES
(1, 'Ceci est un Post Test', 'zefzeùflùzfeùfl\r\nfkpekùre pk ozjfpo jorej posj prqeor trpoq rtiqr^tp poqt i pojtikqjlzjtz \r\nrtjq jqpojoz jokpaei rej mze \r\n koejprgp oj pzto\r\nz zeoj t ekrmlrpoieije e \r\n <ez pzr^o ^ppekpkpe^kjogmoiùrzm;;meo  \r\nze ze kepkpor^k pzz^zelz\r\nqg^p\r\nzolf^$.', 'defautPost.jpg', '2018-02-22 12:48:36', 'Post', 1),
(2, 'Ceci  est un autre poste test', 'qmdqpk po oiepou pepmuop ipe ùefkmikf ùpfkpekùk lm jfojihfoe fmjdi ih ilrieyry\"y_yohrkeh izeorujelkljfn kjf kqf \r\nf\r\nqflqjdqmljd jmq q kfmf f \r\nîp jq$f q\r\nf q q f\r\nq p^jqspkspqpçujl m dl;', 'defautPost.jpg', '2018-02-22 12:48:38', 'Post', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`idAccount`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idComments`),
  ADD KEY `FK_comments_idAccount` (`idAccount`),
  ADD KEY `FK_comments_idPost` (`idPost`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`idPost`),
  ADD KEY `FK_posts_idAccount` (`idAccount`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `account`
--
ALTER TABLE `account`
  MODIFY `idAccount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `idComments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_comments_idAccount` FOREIGN KEY (`idAccount`) REFERENCES `account` (`idAccount`),
  ADD CONSTRAINT `FK_comments_idPost` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_posts_idAccount` FOREIGN KEY (`idAccount`) REFERENCES `account` (`idAccount`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
