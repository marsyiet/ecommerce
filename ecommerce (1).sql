-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 27 déc. 2022 à 10:45
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `login`, `password`, `etat`) VALUES
(1, 'marsyiet', 'ijokpl', 0),
(2, 'kiki', 'ijokpl', 0);

-- --------------------------------------------------------

--
-- Structure de la table `cathegories`
--

DROP TABLE IF EXISTS `cathegories`;
CREATE TABLE IF NOT EXISTS `cathegories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cathegories`
--

INSERT INTO `cathegories` (`id`, `libelle`, `etat`) VALUES
(1, 'jus', 0),
(2, 'fruits', 0);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `ville` int(11) NOT NULL,
  `quartier` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ville` (`ville`),
  KEY `quartier` (`quartier`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `image`, `nom`, `mail`, `ville`, `quartier`, `password`, `etat`) VALUES
(2, 'mbappe.jpg', 'mbappe', 'mbappe@gmail.com', 1, 1, 'ijokpl', 0),
(3, 'dem.jpg', 'dembouz', 'dembouz@dembouz.com', 3, 4, 'ijokpl', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) NOT NULL,
  `produit` int(11) NOT NULL,
  `ville` int(11) NOT NULL,
  `quartier` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `client` (`client`),
  KEY `produit` (`produit`),
  KEY `ville` (`ville`),
  KEY `quartier` (`quartier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `dislikes`
--

DROP TABLE IF EXISTS `dislikes`;
CREATE TABLE IF NOT EXISTS `dislikes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `ville` int(11) NOT NULL,
  `quartier` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ville` (`ville`),
  KEY `quartier` (`quartier`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `mail`, `ville`, `quartier`, `etat`) VALUES
(1, 'marius', 'etoundimarius237@gmail.com', 3, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `id_produit`, `id_client`) VALUES
(28, 9, 2),
(27, 3, 2),
(26, 6, 2),
(25, 8, 2),
(23, 7, 3),
(20, 7, 2);

-- --------------------------------------------------------

--
-- Structure de la table `livreurs`
--

DROP TABLE IF EXISTS `livreurs`;
CREATE TABLE IF NOT EXISTS `livreurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `ville` int(11) NOT NULL,
  `quartier` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ville` (`ville`),
  KEY `quartier` (`quartier`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livreurs`
--

INSERT INTO `livreurs` (`id`, `nom`, `mail`, `ville`, `quartier`, `etat`) VALUES
(1, 'marius', 'etoundimarius237@gmail.com', 3, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
CREATE TABLE IF NOT EXISTS `paiements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `libelle`, `etat`) VALUES
(1, 'orange money', 0),
(2, 'mtn mobile money', 0),
(3, 'express-union', 0);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `cathegorie` int(11) NOT NULL,
  `fournisseur` int(11) NOT NULL,
  `date` date NOT NULL,
  `qte` int(11) NOT NULL,
  `alaune` tinyint(1) NOT NULL DEFAULT '0',
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `favori` tinyint(1) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cathegorie` (`cathegorie`),
  KEY `fournisseur` (`fournisseur`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `image`, `nom`, `prix`, `cathegorie`, `fournisseur`, `date`, `qte`, `alaune`, `etat`, `favori`, `description`) VALUES
(2, 'jusOrange.jpg', 'jus d\'orange', 0, 1, 1, '2022-05-12', 30, 0, 0, 1, 'jus d\'orange bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala bla bla bla bla bala \r\n'),
(3, 'raisins.jpg', 'raisins', 0, 2, 1, '2022-11-22', 10, 0, 0, 0, ''),
(9, 'pomme.jpg', 'pommes', 3000, 2, 1, '2022-12-10', 50, 0, 0, 0, ''),
(4, 'jusRaisin.jpg', 'jus de raisins', 1500, 1, 1, '2022-11-28', 40, 0, 0, 0, ''),
(6, 'mangue.jpg', 'Mangue', 3000, 2, 1, '2022-11-12', 10, 0, 0, 0, ''),
(7, 'orange.jpg', 'Oranges', 3000, 2, 1, '2022-11-28', 50, 0, 0, 1, 'oranges blabla blablablablablablablablablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla lablablablabla \r\n'),
(8, 'pasteque.jpg', 'Pasteque', 3000, 2, 1, '2022-02-13', 30, 1, 0, 0, ''),
(10, 'briqueJus.jpg', 'jus cocktail', 4000, 1, 1, '2022-12-14', 45, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `quartiers`
--

DROP TABLE IF EXISTS `quartiers`;
CREATE TABLE IF NOT EXISTS `quartiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `quartiers`
--

INSERT INTO `quartiers` (`id`, `nom`, `etat`) VALUES
(1, 'emana', 0),
(2, 'nlongkak', 0),
(3, 'ngouso', 0),
(4, 'etoudi', 0),
(5, 'manguier', 0);

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

DROP TABLE IF EXISTS `villes`;
CREATE TABLE IF NOT EXISTS `villes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `nom`, `etat`) VALUES
(1, 'douala', 0),
(2, 'soa', 0),
(3, 'yaounde', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
