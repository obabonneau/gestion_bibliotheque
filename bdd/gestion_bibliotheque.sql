-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 14 déc. 2024 à 15:40
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
-- Base de données : `gestion_bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

DROP TABLE IF EXISTS `emprunts`;
CREATE TABLE IF NOT EXISTS `emprunts` (
  `id_emprunt` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int DEFAULT NULL,
  `id_livre` int DEFAULT NULL,
  `debut` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  PRIMARY KEY (`id_emprunt`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_livre` (`id_livre`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`id_emprunt`, `id_utilisateur`, `id_livre`, `debut`, `fin`) VALUES
(1, 1, 1, '2024-01-01', '2024-02-01'),
(2, 2, 2, '2024-01-15', '2024-02-15'),
(3, 3, 3, '2024-01-20', '2024-02-20'),
(4, 4, 4, '2024-02-01', '2024-03-01'),
(5, 5, 5, '2024-02-05', '2024-03-05'),
(6, 6, 6, '2024-02-10', '2024-03-10'),
(7, 7, 7, '2024-03-01', '2024-04-01'),
(8, 8, 8, '2024-03-05', '2024-04-05'),
(9, 9, 9, '2024-03-10', '2024-04-10'),
(10, 10, 10, '2024-03-15', '2024-04-15'),
(14, 1, 2, '2024-11-29', '2024-12-01'),
(15, 10, 4, '2024-11-29', '2024-12-01'),
(16, 7, 3, '2024-12-01', '2024-12-02'),
(17, 2, 10, '2024-12-01', '2024-12-01'),
(18, 5, 8, '2024-12-01', '2024-12-01'),
(19, 7, 1, '2024-12-01', NULL),
(20, 9, 5, '2024-12-01', '2024-12-01'),
(21, 11, 2, '2024-12-01', '2024-12-03'),
(22, 11, 9, '2024-12-02', NULL),
(23, 10, 7, '2024-12-03', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `id_livre` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auteur` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `genre` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `annee` int DEFAULT NULL,
  `etat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_livre`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id_livre`, `titre`, `auteur`, `genre`, `annee`, `etat`) VALUES
(1, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 'Fiction', 1943, 0),
(2, '1984', 'George Orwell', 'Dystopie', 1949, 1),
(3, 'Les Misérables', 'Victor Hugo', 'Classique', 1862, 1),
(4, 'Moby Dick', 'Herman Melville', 'Aventure', 1851, 1),
(5, 'Le Seigneur des Anneaux', 'J.R.R. Tolkien', 'Fantasy', 1954, 1),
(6, 'Don Quichotte', 'Miguel de Cervantes', 'Classique', 1605, 1),
(7, 'Le Rouge et le Noir', 'Stendhal', 'Roman', 1830, 0),
(8, 'L’Étranger', 'Albert Camus', 'Philosophique', 1942, 1),
(9, 'La Peste', 'Albert Camus', 'Philosophique', 1947, 0),
(10, 'Anna Karenine', 'Léon Tolstoï', 'Classique', 1877, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nom` char(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mail` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `mail`) VALUES
(1, 'Alice', 'Dupont', 'alice.dupont@email.com'),
(2, 'Bob', 'Martin', 'bob.martin@email.com'),
(3, 'Charlie', 'Petit', 'charlie.petit@email.com'),
(4, 'David', 'Lemoine', 'david.lemoine@email.com'),
(5, 'Emma', 'Robert', 'emma.robert@email.com'),
(6, 'François', 'Lemoine', 'francois.lemoine@email.com'),
(7, 'Géraldine', 'Bernard', 'geraldine.bernard@email.com'),
(8, 'Hugo', 'Rousseau', 'hugo.rousseau@email.com'),
(9, 'Isabelle', 'Meyer', 'isabelle.meyer@email.com'),
(10, 'Jules', 'Lemoine', 'jules.lemoine@email.com'),
(11, 'Olivier', 'Babonneau', 'obabonneau@gmail.com');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `emprunts_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `emprunts_ibfk_2` FOREIGN KEY (`id_livre`) REFERENCES `livres` (`id_livre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
