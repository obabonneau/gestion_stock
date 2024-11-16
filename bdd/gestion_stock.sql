-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 16 nov. 2024 à 15:21
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `idfournisseur` int NOT NULL AUTO_INCREMENT,
  `societe` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `adresse` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `cp` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `ville` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `commentaire` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idfournisseur`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`idfournisseur`, `societe`, `adresse`, `cp`, `ville`, `commentaire`) VALUES
(1, 'BABO', 'Hirondelles', '49000', 'Val du Layon', 'A domicile'),
(3, 'CEFII', 'Semard', '49000', 'Angers', 'Centre de formation'),
(4, 'ESEO', 'Maine', '49100', 'Angers', 'Electronique');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `idproduit` int NOT NULL AUTO_INCREMENT,
  `idfournisseur` int NOT NULL,
  `reference` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `quantite` int NOT NULL,
  `commentaire` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idproduit`),
  KEY `idfournisseur` (`idfournisseur`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`idproduit`, `idfournisseur`, `reference`, `nom`, `quantite`, `commentaire`) VALUES
(5, 3, 'dev3', 'Olivier', 1, 'En devenir'),
(7, 4, 'elec', 'Inconnu', 1, 'Test'),
(11, 1, 'max', 'Maxence', 1, 'Test');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`idfournisseur`) REFERENCES `fournisseurs` (`idfournisseur`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
