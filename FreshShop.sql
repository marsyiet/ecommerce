-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 13 fév. 2023 à 10:27
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
  `photo` varchar(255) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `photo`, `login`, `password`, `etat`) VALUES
(1, 'me.jpg\r\n', 'marsyiet', 'ijokpl', 0),
(2, '', 'kiki', 'ijokpl', 0),
(3, '', 'toto', 'ijokpl', 0),
(4, 'moi.jpg', 'marius', 'ijokpl', 0);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `produit` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `nom`, `mail`, `produit`, `note`, `commentaire`) VALUES
(57, 'mbappe', 'mbappe@gmail.com', 10, 4, 'prems'),
(58, 'trent', 'trent@gmail.com', 8, 4, 'nice');

-- --------------------------------------------------------

--
-- Structure de la table `baner`
--

DROP TABLE IF EXISTS `baner`;
CREATE TABLE IF NOT EXISTS `baner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `alaune` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `baner`
--

INSERT INTO `baner` (`id`, `image`, `nom`, `alaune`) VALUES
(1, 'banner.jpg', 'legumes', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cathegories`
--

INSERT INTO `cathegories` (`id`, `libelle`, `etat`) VALUES
(1, 'jus', 0),
(2, 'fruits', 0),
(8, 'fastfood', 0),
(7, 'legumes', 0),
(6, 'viande', 0);

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
  PRIMARY KEY (`id`),
  KEY `ville` (`ville`),
  KEY `quartier` (`quartier`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `image`, `nom`, `mail`, `ville`, `quartier`, `password`) VALUES
(2, 'mbappe.jpg', 'mbappe', 'mbappe@gmail.com', 1, 1, 'ijokpl'),
(3, 'dem.jpg', 'dembouz', 'dembouz@dembouz.com', 3, 4, 'ijokpl'),
(4, 'trent.jpg', 'trent', 'trent@gmail.com', 1, 6, 'ijokpl');

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
-- Structure de la table `couleurs`
--

DROP TABLE IF EXISTS `couleurs`;
CREATE TABLE IF NOT EXISTS `couleurs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nomCouleur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `couleurs`
--

INSERT INTO `couleurs` (`id`, `nomCouleur`) VALUES
(1, 'rouge'),
(2, 'bleu'),
(3, 'vert'),
(4, 'blanc'),
(5, 'noir'),
(6, 'orange'),
(7, 'rose');

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
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dislikes`
--

INSERT INTO `dislikes` (`id`, `id_produit`, `id_client`) VALUES
(92, 9, 2),
(73, 7, 2),
(90, 6, 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `mail`, `ville`, `quartier`, `etat`) VALUES
(1, 'marius', 'etoundimarius237@gmail.com', 3, 1, 0),
(2, 'yoahn', 'yoahn@gmail.com', 3, 1, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `id_produit`, `id_client`) VALUES
(188, 4, 2),
(157, 3, 2),
(168, 2, 2),
(135, 3, 3);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livreurs`
--

INSERT INTO `livreurs` (`id`, `nom`, `mail`, `ville`, `quartier`, `etat`) VALUES
(1, 'marius', 'etoundimarius237@gmail.com', 3, 1, 0),
(3, 'yoahn', 'yoahn@gmail.com', 3, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `online`
--

DROP TABLE IF EXISTS `online`;
CREATE TABLE IF NOT EXISTS `online` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `ipuser` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `libelle`, `etat`) VALUES
(1, 'orange money', 0),
(2, 'mtn mobile money', 0),
(3, 'express-union', 0),
(10, 'moneygram', 0),
(7, 'paypal', 0),
(8, 'express-exchange', 0);

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
  `description` text NOT NULL,
  `couleur` int(11) NOT NULL,
  `taille` int(11) NOT NULL,
  `solde` tinyint(1) NOT NULL DEFAULT '0',
  `ancien_prix` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cathegorie` (`cathegorie`),
  KEY `fournisseur` (`fournisseur`),
  KEY `couleur` (`couleur`),
  KEY `taille` (`taille`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `image`, `nom`, `prix`, `cathegorie`, `fournisseur`, `date`, `qte`, `description`, `couleur`, `taille`, `solde`, `ancien_prix`) VALUES
(2, 'jusOrange.jpg', 'jus d\'oranges\r\n', 2000, 1, 1, '2022-05-12', 30, '', 0, 0, 1, 2500),
(3, 'raisins.jpg', 'raisins', 1000, 2, 1, '2022-11-22', 10, '', 0, 0, 0, 0),
(9, 'pomme.jpg', 'pommes', 3000, 2, 1, '2022-12-10', 0, '', 0, 0, 0, 0),
(4, 'jusRaisin.jpg', 'jus de raisins', 1500, 1, 1, '2022-11-28', 40, '', 0, 0, 0, 0),
(6, 'mangue.jpg', 'Mangue', 3000, 2, 1, '2022-11-12', 10, '', 0, 0, 0, 0),
(7, 'orange.jpg', 'Oranges', 3000, 2, 1, '2022-11-28', 50, '', 0, 0, 0, 0),
(8, 'pasteque.jpg', 'Pasteque', 3000, 2, 1, '2022-02-13', 30, 'La pastèque, aussi appelée melon d\'eau au Québec, est une espèce de plantes herbacées de la famille des Cucurbitacées, originaire d\'Afrique, largement cultivée pour ses gros fruits lisses, à chair rouge, jaune, verdâtre ou blanche et à graines noires ou rouges.', 0, 0, 0, 0),
(10, 'briqueJus.jpg', 'jus cocktail', 4000, 1, 1, '2022-12-14', 45, '', 0, 0, 0, 0),
(11, 'goyave.jpg', 'goyaves', 1500, 2, 1, '2022-11-21', 100, '', 0, 0, 0, 0),
(12, 'fruits.jpg', 'pack de fruits', 5000, 2, 1, '2023-01-08', 80, 'packet', 0, 0, 0, 0),
(13, 'viande.jpg', 'viande sans os\r\n', 5000, 6, 1, '2023-01-15', 60, 'viande ', 1, 1, 1, 7000),
(14, 'pd-2.jpg', 'pack legumes', 2000, 7, 1, '2023-02-05', 50, '', 3, 1, 0, 0),
(15, 'hamburger.jpg', 'Humberger pack de 5', 3000, 8, 1, '2023-02-12', 50, '', 1, 3, 1, 5000),
(16, 'poivron.jpg', 'poivrons', 1000, 7, 1, '2023-02-04', 41, 'pl', 3, 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `quartiers`
--

DROP TABLE IF EXISTS `quartiers`;
CREATE TABLE IF NOT EXISTS `quartiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomQuartier` varchar(255) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `quartiers`
--

INSERT INTO `quartiers` (`id`, `nomQuartier`, `etat`) VALUES
(1, 'emana', 0),
(2, 'nlongkak', 0),
(3, 'ngouso', 0),
(4, 'etoudi', 0),
(5, 'manguier', 0),
(6, 'bonamoussadi', 0);

-- --------------------------------------------------------

--
-- Structure de la table `taille`
--

DROP TABLE IF EXISTS `taille`;
CREATE TABLE IF NOT EXISTS `taille` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nomTaille` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `taille`
--

INSERT INTO `taille` (`id`, `nomTaille`) VALUES
(1, 'large'),
(2, 'medium'),
(3, 'small'),
(4, 'tiny\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

DROP TABLE IF EXISTS `villes`;
CREATE TABLE IF NOT EXISTS `villes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomVille` varchar(255) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `nomVille`, `etat`) VALUES
(1, 'douala', 0),
(2, 'soa', 0),
(3, 'yaounde', 0),
(4, 'bafoussam', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
