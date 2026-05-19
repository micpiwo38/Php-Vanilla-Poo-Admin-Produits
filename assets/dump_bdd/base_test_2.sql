-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 19 mai 2026 à 07:35
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `base_test_2`
--

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(255) NOT NULL,
  `description_produit` text NOT NULL,
  `prix_produit` float NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `description_produit`, `prix_produit`) VALUES
(27, 'Chaise de jardin', 'Chaise en bois pour exterieur tye IKEA', 85.35);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `email_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `role_user` int NOT NULL,
  `user_account_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `email_user`, `password_user`, `role_user`, `user_account_status`) VALUES
(2, 'autre@cool.fr', '$2y$10$s2wvc.Xz9GztIPdVbLScVu0B5byP9iCm3snlfe3.FNEawBCB1VjLe', 0, 0),
(3, 'encore@test.fr', '$2y$10$YKZnBv4XasXQPIovJugKheGxPkcD7LXs/wk7zhG.ah57rkROYxQ22', 1, 1),
(4, 'email@test.com', '$2y$10$Rz1tIFZyfMtHVypVjdW42Ofcr2JSglDbf1fypB9e42m84GvrhuCQ2', 0, 0),
(5, 'email_2@test.fr', '$2y$10$Xp05aRgUcST6reSh9TBW5.yFRPeSAJJqHvziZ1L.tQ3F986Xk5/mK', 0, 0),
(8, 'non@non.fr', '$2y$10$49bnvhiClh3Mk/Xj/WCpGO/5OuLRooXNAXqLnukrMJkNh0Pdp9zH2', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
