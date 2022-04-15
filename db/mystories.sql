-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 15 avr. 2022 à 14:11
-- Version du serveur : 10.4.19-MariaDB
-- Version de PHP : 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mystories`
--

-- --------------------------------------------------------

--
-- Structure de la table `advancement`
--

CREATE TABLE `advancement` (
  `id_usr` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  `numChapter` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `chapters`
--

CREATE TABLE `chapters` (
  `id_story` int(11) NOT NULL,
  `numChapter` int(11) NOT NULL,
  `previousChoice` int(11) DEFAULT NULL,
  `previousChapter` int(11) NOT NULL,
  `chapterContent` longtext NOT NULL,
  `choice1` mediumtext DEFAULT NULL,
  `choice2` mediumtext DEFAULT NULL,
  `choice3` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `stories`
--

CREATE TABLE `stories` (
  `id_story` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `author` varchar(30) DEFAULT NULL,
  `nbChapters` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `date` date DEFAULT NULL,
  `hide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_usr` int(11) NOT NULL,
  `login_usr` varchar(30) DEFAULT NULL,
  `password_usr` varchar(30) DEFAULT NULL,
  `acces` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_usr`, `login_usr`, `password_usr`, `acces`) VALUES
(1, 'correcteur', 'mdp_correcteur_1234', 'classique'),
(2, 'correcteur_admin', 'mdp_correcteur_1234', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `advancement`
--
ALTER TABLE `advancement`
  ADD KEY `id_usr` (`id_usr`),
  ADD KEY `id_story` (`id_story`);

--
-- Index pour la table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`numChapter`),
  ADD KEY `id_story` (`id_story`);

--
-- Index pour la table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id_story`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_usr`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `numChapter` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stories`
--
ALTER TABLE `stories`
  MODIFY `id_story` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `advancement`
--
ALTER TABLE `advancement`
  ADD CONSTRAINT `advancement_ibfk_1` FOREIGN KEY (`id_usr`) REFERENCES `user` (`id_usr`),
  ADD CONSTRAINT `advancement_ibfk_2` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id_story`);

--
-- Contraintes pour la table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`id_story`) REFERENCES `stories` (`id_story`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
