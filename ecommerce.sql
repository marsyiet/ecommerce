-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 16 nov. 2022 à 18:38
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`idAdmin`, `login`, `password`) VALUES
(1, 'marsyiet', 'ijokpl'),
(2, 'kiko', 'ijokpl');

-- --------------------------------------------------------

--
-- Structure de la table `cathegories`
--

DROP TABLE IF EXISTS `cathegories`;
CREATE TABLE IF NOT EXISTS `cathegories` (
  `idCathegorie` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`idCathegorie`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cathegories`
--

INSERT INTO `cathegories` (`idCathegorie`, `libelle`) VALUES
(1, 'jus');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `idClient` int(11) NOT NULL,
  `ville` int(11) DEFAULT NULL,
  `quartier` int(11) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`idClient`),
  KEY `ville` (`ville`),
  KEY `quartier` (`quartier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `idCommande` int(11) NOT NULL,
  `numCommande` int(11) NOT NULL,
  `client` int(11) DEFAULT NULL,
  `produit` int(11) DEFAULT NULL,
  `paiement` int(11) DEFAULT NULL,
  `ville` int(11) DEFAULT NULL,
  `quartier` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `client` (`client`),
  KEY `produit` (`produit`),
  KEY `paiement` (`paiement`),
  KEY `ville` (`ville`),
  KEY `quartier` (`quartier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `idFournisseur` int(11) NOT NULL,
  `ville` int(11) DEFAULT NULL,
  `quartier` int(11) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`idFournisseur`),
  KEY `ville` (`ville`),
  KEY `quartier` (`quartier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `livreurs`
--

DROP TABLE IF EXISTS `livreurs`;
CREATE TABLE IF NOT EXISTS `livreurs` (
  `idLivreur` int(11) NOT NULL,
  `ville` int(11) DEFAULT NULL,
  `quartier` int(11) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`idLivreur`),
  KEY `ville` (`ville`),
  KEY `quartier` (`quartier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
CREATE TABLE IF NOT EXISTS `paiements` (
  `idPaiement` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idPaiement`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `idProduit` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `cathegorie` int(11) DEFAULT NULL,
  `fournisseur` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `cathegorie` (`cathegorie`),
  KEY `fournisseur` (`fournisseur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `quartiers`
--

DROP TABLE IF EXISTS `quartiers`;
CREATE TABLE IF NOT EXISTS `quartiers` (
  `idQuartier` int(11) NOT NULL AUTO_INCREMENT,
  `nomQuartier` varchar(255) NOT NULL,
  PRIMARY KEY (`idQuartier`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `quartiers`
--

INSERT INTO `quartiers` (`idQuartier`, `nomQuartier`) VALUES
(1, 'Emana');

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

DROP TABLE IF EXISTS `villes`;
CREATE TABLE IF NOT EXISTS `villes` (
  `idVille` int(11) NOT NULL AUTO_INCREMENT,
  `nomVille` varchar(255) NOT NULL,
  PRIMARY KEY (`idVille`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`idVille`, `nomVille`) VALUES
(1, 'Yaoundé');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
