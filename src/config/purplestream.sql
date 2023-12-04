-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 04 déc. 2023 à 08:29
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `purplestream`
--

-- --------------------------------------------------------

--
-- Structure de la table `anime`
--

CREATE TABLE `anime` (
  `animeID` int(11) NOT NULL,
  `animeName` varchar(100) DEFAULT NULL,
  `animeDescription` text,
  `animeImage` varchar(255) DEFAULT NULL,
  `animeCategoryID` int(11) DEFAULT NULL,
  `animeSeasonID` int(11) DEFAULT NULL,
  `animeReview` int(11) DEFAULT NULL,
  `animeLanguageID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `animeCategory`
--

CREATE TABLE `animeCategory` (
  `animeCategoryID` int(11) NOT NULL,
  `animeCategoryName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `animeEpisode`
--

CREATE TABLE `animeEpisode` (
  `episodeID` int(11) NOT NULL,
  `animeID` int(11) DEFAULT NULL,
  `animeSeasonID` int(11) DEFAULT NULL,
  `episodeName` varchar(100) DEFAULT NULL,
  `episodeDescription` text,
  `episodeIMG` varchar(255) DEFAULT NULL,
  `episodeTime` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `animeLanguage`
--

CREATE TABLE `animeLanguage` (
  `animeLanguageID` int(11) NOT NULL,
  `animeLanguageName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `animeSeason`
--

CREATE TABLE `animeSeason` (
  `animeSeasonID` int(11) NOT NULL,
  `animeSeasonName` varchar(100) DEFAULT NULL,
  `animeSeasonDescritption` text,
  `animeSeasonImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `userProfiles`
--

CREATE TABLE `userProfiles` (
  `userProfileID` int(11) NOT NULL,
  `userdID` int(11) DEFAULT NULL,
  `userProfileName` varchar(30) DEFAULT NULL,
  `userProfileAvatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `userdID` int(11) NOT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `userName` varchar(100) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`animeID`),
  ADD KEY `animeCategoryID` (`animeCategoryID`),
  ADD KEY `animeSeasonID` (`animeSeasonID`),
  ADD KEY `animeLanguageID` (`animeLanguageID`);

--
-- Index pour la table `animeCategory`
--
ALTER TABLE `animeCategory`
  ADD PRIMARY KEY (`animeCategoryID`);

--
-- Index pour la table `animeEpisode`
--
ALTER TABLE `animeEpisode`
  ADD PRIMARY KEY (`episodeID`),
  ADD KEY `animeID` (`animeID`),
  ADD KEY `animeSeasonID` (`animeSeasonID`);

--
-- Index pour la table `animeLanguage`
--
ALTER TABLE `animeLanguage`
  ADD PRIMARY KEY (`animeLanguageID`);

--
-- Index pour la table `animeSeason`
--
ALTER TABLE `animeSeason`
  ADD PRIMARY KEY (`animeSeasonID`);

--
-- Index pour la table `userProfiles`
--
ALTER TABLE `userProfiles`
  ADD PRIMARY KEY (`userProfileID`),
  ADD KEY `userdID` (`userdID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userdID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `anime`
--
ALTER TABLE `anime`
  MODIFY `animeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `animeCategory`
--
ALTER TABLE `animeCategory`
  MODIFY `animeCategoryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `animeEpisode`
--
ALTER TABLE `animeEpisode`
  MODIFY `episodeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `animeLanguage`
--
ALTER TABLE `animeLanguage`
  MODIFY `animeLanguageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `animeSeason`
--
ALTER TABLE `animeSeason`
  MODIFY `animeSeasonID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `userProfiles`
--
ALTER TABLE `userProfiles`
  MODIFY `userProfileID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `userdID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `anime`
--
ALTER TABLE `anime`
  ADD CONSTRAINT `anime_ibfk_1` FOREIGN KEY (`animeCategoryID`) REFERENCES `animeCategory` (`animeCategoryID`),
  ADD CONSTRAINT `anime_ibfk_2` FOREIGN KEY (`animeCategoryID`) REFERENCES `animeCategory` (`animeCategoryID`),
  ADD CONSTRAINT `anime_ibfk_3` FOREIGN KEY (`animeSeasonID`) REFERENCES `animeSeason` (`animeSeasonID`),
  ADD CONSTRAINT `anime_ibfk_4` FOREIGN KEY (`animeLanguageID`) REFERENCES `animeLanguage` (`animeLanguageID`);

--
-- Contraintes pour la table `animeEpisode`
--
ALTER TABLE `animeEpisode`
  ADD CONSTRAINT `animeepisode_ibfk_1` FOREIGN KEY (`animeID`) REFERENCES `anime` (`animeID`),
  ADD CONSTRAINT `animeepisode_ibfk_2` FOREIGN KEY (`animeID`) REFERENCES `anime` (`animeID`),
  ADD CONSTRAINT `animeepisode_ibfk_3` FOREIGN KEY (`animeSeasonID`) REFERENCES `animeSeason` (`animeSeasonID`);

--
-- Contraintes pour la table `userProfiles`
--
ALTER TABLE `userProfiles`
  ADD CONSTRAINT `userprofiles_ibfk_1` FOREIGN KEY (`userdID`) REFERENCES `users` (`userdID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
