-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 28 avr. 2023 à 16:33
-- Version du serveur : 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `intranet_as`
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
-- Structure de la table `casiers_bcso`
--

CREATE TABLE `casiers_bcso` (
  `ID` int(255) NOT NULL,
  `civilid` int(11) NOT NULL,
  `crime` text NOT NULL,
  `sanction` varchar(255) NOT NULL,
  `officier` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `casiers_lspd`
--

CREATE TABLE `casiers_lspd` (
  `ID` int(255) NOT NULL,
  `civilid` int(11) NOT NULL,
  `crime` text NOT NULL,
  `sanction` varchar(255) NOT NULL,
  `officier` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `note` text DEFAULT NULL,
  `saisie` text DEFAULT NULL,
  `officiers_presents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `civils_bcso`
--

CREATE TABLE `civils_bcso` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `skin` varchar(255) NOT NULL,
  `hair` varchar(255) NOT NULL,
  `tel` varchar(14) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picface` varchar(255) DEFAULT NULL,
  `picback` varchar(255) DEFAULT NULL,
  `picright` varchar(255) DEFAULT NULL,
  `note` text DEFAULT '/'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `civils_lspd`
--

CREATE TABLE `civils_lspd` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `tel` varchar(14) NOT NULL,
  `job` varchar(255) DEFAULT NULL,
  `picface` varchar(255) DEFAULT NULL,
  `picback` varchar(255) DEFAULT NULL,
  `picright` varchar(255) DEFAULT NULL,
  `note` text DEFAULT '/'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `complaints_bcso`
--

CREATE TABLE `complaints_bcso` (
  `ID` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `req` varchar(255) NOT NULL,
  `violator` varchar(255) NOT NULL,
  `officier` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `object` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dispatch_units_bcso`
--

CREATE TABLE `dispatch_units_bcso` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dispatch_units_lspd`
--

CREATE TABLE `dispatch_units_lspd` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enquetes_bcso`
--

CREATE TABLE `enquetes_bcso` (
  `ID` int(11) NOT NULL,
  `Subject` tinytext NOT NULL,
  `Date` datetime NOT NULL,
  `Object` longtext DEFAULT NULL,
  `Rapport` longtext DEFAULT NULL,
  `Officier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `externs`
--

CREATE TABLE `externs` (
  `ID` int(11) NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `firstname` text NOT NULL,
  `grade` text NOT NULL,
  `password` text NOT NULL,
  `pic` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `members_bcso`
--

CREATE TABLE `members_bcso` (
  `ID` int(11) NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `firstname` text NOT NULL,
  `grade` text NOT NULL,
  `password` text NOT NULL,
  `tel` varchar(14) NOT NULL,
  `pic` tinyint(4) DEFAULT NULL,
  `note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `division` text DEFAULT 'Aucune',
  `ppa1` tinyint(1) DEFAULT 0,
  `ppa2` tinyint(1) NOT NULL DEFAULT 0,
  `copilote` tinyint(1) NOT NULL DEFAULT 0,
  `pilote` tinyint(1) NOT NULL DEFAULT 0,
  `bls` tinyint(1) NOT NULL DEFAULT 0,
  `be` tinyint(1) NOT NULL DEFAULT 0,
  `sahpmary` tinyint(1) NOT NULL DEFAULT 0,
  `sahpvir` tinyint(1) NOT NULL DEFAULT 0,
  `pr` tinyint(1) NOT NULL DEFAULT 0,
  `swat` tinyint(1) NOT NULL DEFAULT 0,
  `dispatch_unit` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `members_lspd`
--

CREATE TABLE `members_lspd` (
  `ID` int(11) NOT NULL,
  `matricule` int(11) NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `firstname` text NOT NULL,
  `grade` text NOT NULL,
  `gradevalue` int(11) DEFAULT NULL,
  `password` text NOT NULL,
  `tel` varchar(14) NOT NULL,
  `pic` tinyint(4) DEFAULT NULL,
  `note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `division` text DEFAULT 'Aucune',
  `ppa` tinyint(1) NOT NULL DEFAULT 0,
  `conduite` tinyint(1) NOT NULL DEFAULT 0,
  `negociateur` tinyint(1) NOT NULL DEFAULT 0,
  `dispatcheur` tinyint(1) NOT NULL DEFAULT 0,
  `recruteur` tinyint(1) NOT NULL DEFAULT 0,
  `dispatch_unit` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifications_lspd`
--

CREATE TABLE `notifications_lspd` (
  `ID` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `civilid` int(11) NOT NULL,
  `text` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `markasread` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `ID` int(11) NOT NULL,
  `recrutement_bcso` tinyint(1) DEFAULT NULL,
  `recrutement_lspd` tinyint(1) NOT NULL,
  `freq_bcso` double DEFAULT NULL,
  `freq_lspd` double DEFAULT NULL,
  `freq_lspd_op` double NOT NULL,
  `freq_ems` double DEFAULT NULL,
  `freq_harmony` double DEFAULT NULL,
  `maintenance` tinyint(1) NOT NULL,
  `defcon_bcso` int(11) NOT NULL,
  `defcon_lspd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vehicles_bcso`
--

CREATE TABLE `vehicles_bcso` (
  `ID` int(11) NOT NULL,
  `model` varchar(20) NOT NULL,
  `plate` varchar(10) NOT NULL,
  `label` varchar(50) NOT NULL,
  `owner` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vehicles_lspd`
--

CREATE TABLE `vehicles_lspd` (
  `ID` int(11) NOT NULL,
  `model` varchar(20) NOT NULL,
  `plate` varchar(10) NOT NULL,
  `label` varchar(50) NOT NULL,
  `owner` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wanted_bcso`
--

CREATE TABLE `wanted_bcso` (
  `ID` int(11) NOT NULL,
  `civilid` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `reason` text NOT NULL,
  `officier` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `public` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wanted_lspd`
--

CREATE TABLE `wanted_lspd` (
  `ID` int(11) NOT NULL,
  `civilid` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `reason` text NOT NULL,
  `officier` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `public` tinyint(1) DEFAULT 0
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
-- Index pour la table `casiers_bcso`
--
ALTER TABLE `casiers_bcso`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `casiers_lspd`
--
ALTER TABLE `casiers_lspd`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `civils_bcso`
--
ALTER TABLE `civils_bcso`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `civils_lspd`
--
ALTER TABLE `civils_lspd`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `complaints_bcso`
--
ALTER TABLE `complaints_bcso`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `dispatch_units_bcso`
--
ALTER TABLE `dispatch_units_bcso`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `dispatch_units_lspd`
--
ALTER TABLE `dispatch_units_lspd`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `enquetes_bcso`
--
ALTER TABLE `enquetes_bcso`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `externs`
--
ALTER TABLE `externs`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `members_bcso`
--
ALTER TABLE `members_bcso`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `members_lspd`
--
ALTER TABLE `members_lspd`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `notifications_lspd`
--
ALTER TABLE `notifications_lspd`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `vehicles_bcso`
--
ALTER TABLE `vehicles_bcso`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `vehicles_lspd`
--
ALTER TABLE `vehicles_lspd`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `wanted_bcso`
--
ALTER TABLE `wanted_bcso`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `wanted_lspd`
--
ALTER TABLE `wanted_lspd`
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
-- AUTO_INCREMENT pour la table `casiers_bcso`
--
ALTER TABLE `casiers_bcso`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `casiers_lspd`
--
ALTER TABLE `casiers_lspd`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `civils_bcso`
--
ALTER TABLE `civils_bcso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `civils_lspd`
--
ALTER TABLE `civils_lspd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `complaints_bcso`
--
ALTER TABLE `complaints_bcso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `dispatch_units_bcso`
--
ALTER TABLE `dispatch_units_bcso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `dispatch_units_lspd`
--
ALTER TABLE `dispatch_units_lspd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enquetes_bcso`
--
ALTER TABLE `enquetes_bcso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `externs`
--
ALTER TABLE `externs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `members_bcso`
--
ALTER TABLE `members_bcso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `members_lspd`
--
ALTER TABLE `members_lspd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications_lspd`
--
ALTER TABLE `notifications_lspd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vehicles_bcso`
--
ALTER TABLE `vehicles_bcso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vehicles_lspd`
--
ALTER TABLE `vehicles_lspd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `wanted_bcso`
--
ALTER TABLE `wanted_bcso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `wanted_lspd`
--
ALTER TABLE `wanted_lspd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
