-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 24 juil. 2019 à 11:07
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fruit_stocks`
--

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_product` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_product`, `name`, `ref`, `qty`, `price`) VALUES
(1, 'Pommes', '001', 10, 5),
(2, 'Melons', '002', 6, 10),
(3, 'Ananas', '003', 12, 20),
(7, 'momo', 'AAB01', 14, 15),
(8, 'momo', 'AAB01', 14, 15),
(9, 'momo', 'AAB01', 14, 15),
(10, 'momo', 'AAB01', 14, 15),
(11, 'mo', 'AAB01', 14, 15),
(12, 'mo', 'AAB01', 14, 15),
(13, 'mo', 'AAB01', 14, 15),
(14, 'mo', 'AAB01', 14, 15),
(15, 'mo', 'AAB01', 14, 15),
(16, 'mo', 'AAB01', 14, 15),
(17, 'mohyh', 'AAB01', 14, 15),
(18, 'mohyh', 'AAB01', 14, 15),
(19, 'mohyh', 'AAB01', 14, 15),
(20, 'mohyh', 'AAB01', 14, 15),
(21, 'pppph', 'AAB01', 14, 15),
(22, 'roro', 'ad124', 14, 25),
(23, 'Tom', 'tom', 500, 2),
(24, 'ppppjkivguivh', 'AAB01', 14, 15),
(25, 'uyuy', 'uydud', 14, 25),
(26, 'htru', 'kfuk', 14, 12),
(27, 'popo', 'yui', 14, 69),
(28, 'momo', 'ppp', 100, 12);

-- --------------------------------------------------------

--
-- Structure de la table `produits_users`
--

CREATE TABLE `produits_users` (
  `id_produit` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `titre` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_product`);

--
-- Index pour la table `produits_users`
--
ALTER TABLE `produits_users`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD UNIQUE KEY `id_role` (`id_role`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits_users`
--
ALTER TABLE `produits_users`
  ADD CONSTRAINT `produits_users_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `produits_users_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_product`);

--
-- Contraintes pour la table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
