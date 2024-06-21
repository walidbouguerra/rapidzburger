-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 16 juin 2024 à 17:42
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rapidzburger`
--
CREATE DATABASE IF NOT EXISTS `rapidzburger` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `rapidzburger`;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `prix` int NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_commande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `id_utilisateur`, `prix`, `adresse`, `telephone`, `date_commande`) VALUES
(8, 1, 25, '2 rue du test', '0600000000', '2024-06-06 14:16:54'),
(9, 1, 26, '2 rue du test', '0600000000', '2024-06-16 19:08:57');

-- --------------------------------------------------------

--
-- Structure de la table `commande_menu`
--

CREATE TABLE `commande_menu` (
  `id_commande` int NOT NULL,
  `id_menu` tinyint NOT NULL,
  `quantite` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande_menu`
--

INSERT INTO `commande_menu` (`id_commande`, `id_menu`, `quantite`) VALUES
(8, 1, 1),
(8, 2, 1),
(9, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id` int NOT NULL,
  `id_livreur` int NOT NULL,
  `id_commande` int NOT NULL,
  `date_debut` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_fin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id`, `id_livreur`, `id_commande`, `date_debut`, `date_fin`) VALUES
(12, 3, 8, '2024-06-06 14:18:15', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `id` tinyint NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` decimal(4,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `nom`, `prix`, `description`, `image`) VALUES
(1, 'Steakhouse', 12.00, 'Le plaisir d\'une viande de bœuf grillée à la flamme, d\'une sauce barbecue, de bacon, des tranches de cheddar fondu et d\'oignons croustillants.\r\n<ul class=\"list-group list-group-flush\"><li class=\"list-group-item\">1x Steakhouse</li><li class=\"list-group-item\">1x Moyennes frites</li><li class=\"list-group-item\">1x Coca-Cola sans sucres (40cl)</li></ul>', 'menu-steakhouse.webp'),
(2, 'Double Cheese Bacon', 13.00, 'Ce sandwich va à l\'essentiel. Deux viandes de bœuf grillées à la flamme, des tranches de cheddar fondu et du bacon.\r\n<ul class=\"list-group list-group-flush\"><li class=\"list-group-item\">1x Steakhouse</li><li class=\"list-group-item\">1x Moyennes frites</li><li class=\"list-group-item\">1x Coca-Cola sans sucres (40cl)</li></ul>', 'menu-double-cheese.webp'),
(3, 'Chicken Spicy', 12.00, 'Une sauce Spicy Andalouse (relevée), un pain avec éclats de maïs, des tranches de cheddar fondu et un poulet 100% issu de filet.\r\n<ul class=\"list-group list-group-flush\"><li class=\"list-group-item\">1x Steakhouse</li><li class=\"list-group-item\">1x Moyennes frites</li><li class=\"list-group-item\">1x Coca-Cola sans sucres (40cl)</li></ul>', 'menu-chicken-spicy.webp'),
(4, 'Indian Chicken Steakhouse', 13.00, 'Un pain moelleux, une sauce curry, des oignons croustillants, des tranches de bacon, des tranches de cheddar fondu et un poulet 100% issu de filet !\r\n<ul class=\"list-group list-group-flush\"><li class=\"list-group-item\">1x Steakhouse</li><li class=\"list-group-item\">1x Moyennes frites</li><li class=\"list-group-item\">1x Coca-Cola sans sucres (40cl)</li></ul>', 'menu-chicken-steakhouse.webp');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_utilisateur` int NOT NULL,
  `id_menu` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role_utilisateur`
--

CREATE TABLE `role_utilisateur` (
  `id` tinyint NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role_utilisateur`
--

INSERT INTO `role_utilisateur` (`id`, `nom`) VALUES
(1, 'client'),
(2, 'livreur'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int NOT NULL,
  `id_role` tinyint NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `id_role`, `prenom`, `nom`, `email`, `password`) VALUES
(1, 1, 'Walid', 'Bouguerra', 'test@gmail.com', '$2y$10$B59cqsRcC03643fDgFX6MO1o8sTpzey/iifoLdAm2KkoyeEtyaJRa'),
(2, 3, 'admin', 'admin', 'admin@gmail.com', '$2y$10$pkvKpbMIgtzdqgqqARg.Quvxj7Jz2ygoFaZBdv2gwZtf1rjOz2TSy'),
(3, 2, 'Jean', 'Pierre', 'livreur@gmail.com', '$2y$10$DHr1ljMHvlg6aYQ2/I//aexEAMsAAzW4GWiczGq9gSR7BqXybLbqW');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `commande_menu`
--
ALTER TABLE `commande_menu`
  ADD PRIMARY KEY (`id_commande`,`id_menu`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_livreur` (`id_livreur`),
  ADD KEY `id_commande` (`id_commande`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Index pour la table `role_utilisateur`
--
ALTER TABLE `role_utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `role_utilisateur`
--
ALTER TABLE `role_utilisateur`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `commande_menu`
--
ALTER TABLE `commande_menu`
  ADD CONSTRAINT `commande_menu_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `commande_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`);

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `livraison_ibfk_1` FOREIGN KEY (`id_livreur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `livraison_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role_utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
