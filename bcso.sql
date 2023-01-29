-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Dim 29 jan. 2023 à 15:45
-- Version du serveur :  10.3.37-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3-4ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bcso`
--

-- --------------------------------------------------------

--
-- Structure de la table `amendes`
--

CREATE TABLE `amendes` (
  `ID` int(11) NOT NULL,
  `type` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `other` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `casiers`
--

CREATE TABLE `casiers` (
  `ID` int(255) NOT NULL,
  `civilid` int(11) NOT NULL,
  `crime` text NOT NULL,
  `sanction` varchar(255) NOT NULL,
  `officier` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `civil`
--

CREATE TABLE `civil` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `skin` varchar(255) NOT NULL,
  `hair` varchar(255) NOT NULL,
  `tel` varchar(14) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `picface` longblob DEFAULT NULL,
  `picback` longblob DEFAULT NULL,
  `picright` longblob DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `ID` int(11) NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `firstname` text NOT NULL,
  `grade` text NOT NULL,
  `password` text NOT NULL,
  `tel` varchar(14) NOT NULL,
  `pic` tinyint(4) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `recrutement` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wanted`
--

CREATE TABLE `wanted` (
  `ID` int(11) NOT NULL,
  `civilid` int(11) NOT NULL,
  `datetimepub` datetime NOT NULL,
  `datetime` datetime NOT NULL,
  `reason` text NOT NULL,
  `officier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amendes`
--
ALTER TABLE `amendes`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `casiers`
--
ALTER TABLE `casiers`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `civil`
--
ALTER TABLE `civil`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `wanted`
--
ALTER TABLE `wanted`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `amendes`
--
ALTER TABLE `amendes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `casiers`
--
ALTER TABLE `casiers`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `civil`
--
ALTER TABLE `civil`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `wanted`
--
ALTER TABLE `wanted`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
