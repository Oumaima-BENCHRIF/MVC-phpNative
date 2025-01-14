-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 14 jan. 2025 à 11:59
-- Version du serveur : 8.0.30
-- Version de PHP : 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `etudiant`
--

-- --------------------------------------------------------

--
-- Structure de la table `listeetudiant`
--

CREATE TABLE `listeetudiant` (
  `id` int NOT NULL,
  `prenom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `note` float DEFAULT NULL,
  `nom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `moyenne` float DEFAULT NULL,
  `idFilier` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `listeetudiant`
--

INSERT INTO `listeetudiant` (`id`, `prenom`, `note`, `nom`, `moyenne`, `idFilier`) VALUES
(39, 'khawlati', 20, 'Benchrif ', 20, 2),
(40, 'Aya', 19, 'Benchrif ', 20, 2),
(43, 'Oumaima ', 19, 'Benchrif ', 89, 1),
(45, 'asmae', 20, 'Benchrif ', 20, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `listeetudiant`
--
ALTER TABLE `listeetudiant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_filier` (`idFilier`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `listeetudiant`
--
ALTER TABLE `listeetudiant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `listeetudiant`
--
ALTER TABLE `listeetudiant`
  ADD CONSTRAINT `Fk_filier` FOREIGN KEY (`idFilier`) REFERENCES `filier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
