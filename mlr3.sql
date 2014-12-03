-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Client: localhost:3306
-- Généré le: Lun 17 Juin 2013 à 09:32
-- Version du serveur: 5.6.11
-- Version de PHP: 5.4.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `mlr3`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ID_ADMIN` int(11) NOT NULL AUTO_INCREMENT,
  `MAIL` char(32) COLLATE utf8_bin NOT NULL,
  `NOM` char(32) COLLATE utf8_bin NOT NULL,
  `PRENOM` char(32) COLLATE utf8_bin NOT NULL,
  `MDP` char(32) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID_ADMIN`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `MAIL`, `NOM`, `PRENOM`, `MDP`) VALUES
(1, 'yannis.rekkas@gmail.com', 'REKKAS', 'YANNIS', 'd2104a400c7f629a197f33bb33fe80c0'),
(2, 'rippmania@gmail.com', 'SIEGEL', 'Valentin', 'd2104a400c7f629a197f33bb33fe80c0');

-- --------------------------------------------------------

--
-- Structure de la table `association`
--

CREATE TABLE IF NOT EXISTS `association` (
  `ID_ASSOCIATION` int(11) NOT NULL AUTO_INCREMENT,
  `NO_ICOM` text COLLATE utf8_bin NOT NULL,
  `NOM` text COLLATE utf8_bin NOT NULL,
  `TELEPHONE` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID_ASSOCIATION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Contenu de la table `association`
--

INSERT INTO `association` (`ID_ASSOCIATION`, `NO_ICOM`, `NOM`, `TELEPHONE`) VALUES
(2, '1515', 'Association M5L', '0660447755'),
(4, '1995', 'Ligue du Nekfeu', '0660447756');

-- --------------------------------------------------------

--
-- Structure de la table `asso_formation`
--

CREATE TABLE IF NOT EXISTS `asso_formation` (
  `ID_ASSOCIATION` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_FORMATION` bigint(4) NOT NULL,
  `PRIORITE_ACCEPTATION` int(11) NOT NULL,
  PRIMARY KEY (`ID_ASSOCIATION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE IF NOT EXISTS `formation` (
  `ID_FORMATION` int(11) NOT NULL AUTO_INCREMENT,
  `NO_THEME` char(32) COLLATE utf8_bin NOT NULL,
  `NO_SALLE` int(11) NOT NULL,
  `LIBELLE` char(32) COLLATE utf8_bin NOT NULL,
  `DATE_DEB` date NOT NULL,
  `HEURE_DEB` time NOT NULL,
  `DATE_FIN` date NOT NULL,
  `HEURE_FIN` time NOT NULL,
  `INTERVENTION` char(126) COLLATE utf8_bin NOT NULL,
  `OBJECTIF` char(126) COLLATE utf8_bin NOT NULL,
  `PREREQUIS` char(126) COLLATE utf8_bin NOT NULL,
  `CONTENU` char(126) COLLATE utf8_bin NOT NULL,
  `PRIX_REPAS` int(11) NOT NULL,
  `NOMBRE_PLACE` int(11) NOT NULL,
  PRIMARY KEY (`ID_FORMATION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=105 ;

--
-- Contenu de la table `formation`
--

INSERT INTO `formation` (`ID_FORMATION`, `NO_THEME`, `NO_SALLE`, `LIBELLE`, `DATE_DEB`, `HEURE_DEB`, `DATE_FIN`, `HEURE_FIN`, `INTERVENTION`, `OBJECTIF`, `PREREQUIS`, `CONTENU`, `PRIX_REPAS`, `NOMBRE_PLACE`) VALUES
(1, '2', 2, 'Parcours de pro.', '2013-06-05', '08:00:00', '2013-06-11', '14:00:00', 'DAVID HASSELHOFF', 'PLEINS DE TRUCS', 'RIEN OU DES BOOBS', 'pas grand chose', 15, 2),
(2, '2', 2, 'Parcours du combattant', '2013-06-14', '08:00:00', '2013-06-20', '14:00:00', 'Pascalino le grand frére', 'Arreter d''insulter sa madre', 'Etre un connard', 'censuré la plupart du temps', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `NO_MEMBRE` bigint(4) NOT NULL AUTO_INCREMENT,
  `ID_ASSOCIATION` bigint(4) NOT NULL,
  `NOM_M` char(32) COLLATE utf8_bin NOT NULL,
  `PRENOM_M` char(32) COLLATE utf8_bin NOT NULL,
  `PRIORITE` tinyint(1) NOT NULL,
  PRIMARY KEY (`NO_MEMBRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`NO_MEMBRE`, `ID_ASSOCIATION`, `NOM_M`, `PRENOM_M`, `PRIORITE`) VALUES
(11, 4, 'Juve', 'Patrick', 2);

-- --------------------------------------------------------

--
-- Structure de la table `membre_formation`
--

CREATE TABLE IF NOT EXISTS `membre_formation` (
  `NO_MEMBRE` bigint(4) NOT NULL,
  `ID_FORMATION` bigint(4) NOT NULL,
  `FRAIS` bigint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `membre_formation`
--

INSERT INTO `membre_formation` (`NO_MEMBRE`, `ID_FORMATION`, `FRAIS`) VALUES
(2, 3, 0),
(1, 3, 0),
(2, 1, 0),
(2, 2, 0),
(1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `NO_SALLE` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` char(32) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`NO_SALLE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`NO_SALLE`, `TYPE`) VALUES
(1, 'Salle Leclerc'),
(2, 'Salle sauce au pistou');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE IF NOT EXISTS `stagiaire` (
  `NO_MEMBRE` bigint(4) NOT NULL AUTO_INCREMENT,
  `FONCTION` tinyint(1) DEFAULT NULL,
  `STATUT` char(32) COLLATE utf8_bin DEFAULT NULL,
  `NOM_M` char(32) COLLATE utf8_bin DEFAULT NULL,
  `PRENOM_M` char(32) COLLATE utf8_bin DEFAULT NULL,
  `PRIORITE` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`NO_MEMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `NO_THEME` char(32) COLLATE utf8_bin NOT NULL,
  `NOM_THEME` char(32) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
