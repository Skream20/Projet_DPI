-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 01 avr. 2025 à 10:38
-- Version du serveur : 8.0.33
-- Version de PHP : 8.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_frais`
--

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `ETA_ID` char(2) NOT NULL,
  `ETA_LIB` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`ETA_ID`, `ETA_LIB`) VALUES
('CL', 'Saisie clôturée'),
('CR', 'Fiche créée, saisie en cours'),
('RB', 'Remboursée'),
('VA', 'Validée et mise en paiement');

-- --------------------------------------------------------

--
-- Structure de la table `fiche_frais`
--

CREATE TABLE `fiche_frais` (
  `FFR_ID` int NOT NULL,
  `VIS_ID` char(4) NOT NULL,
  `ETA_ID` char(2) NOT NULL,
  `FFR_ANNEE` char(4) NOT NULL,
  `FFR_MOIS` enum('JANVIER','FEVRIER','MARS','AVRIL','MAI','JUIN','JUILLET','AOUT','SEPTEMBRE','OCTOBRE','NOVEMBRE','DECEMBRE') NOT NULL,
  `FFR_MONTANT_VALIDE` decimal(10,2) NOT NULL,
  `FFR_NB_JUSTIFICATIF` int NOT NULL,
  `FFR_DATE_MODIF` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `frais_forfait`
--

CREATE TABLE `frais_forfait` (
  `FOR_ID` char(3) NOT NULL,
  `FOR_LIB` char(20) NOT NULL,
  `FOR_MONTANT` decimal(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `frais_forfait`
--

INSERT INTO `frais_forfait` (`FOR_ID`, `FOR_LIB`, `FOR_MONTANT`) VALUES
('ETP', 'Forfait Etape', 110.00),
('KM', 'Frais Kilométrique', 0.62),
('NUI', 'Nuitée Hôtel', 80.00),
('REP', 'Repas Restaurant', 25.00);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_frais_forfait`
--

CREATE TABLE `ligne_frais_forfait` (
  `FFR_ID` int NOT NULL,
  `FOR_ID` char(3) NOT NULL,
  `LIG_QTE` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ligne_frais_forfait`
--

INSERT INTO `ligne_frais_forfait` (`FFR_ID`, `FOR_ID`, `LIG_QTE`) VALUES
(1, 'ETP', 3),
(1, 'KM', 500),
(1, 'NUI', 15),
(1, 'REP', 15),
(2, 'ETP', 4),
(2, 'KM', 750),
(2, 'NUI', 20),
(2, 'REP', 15),
(3, 'km', 24),
(3, 'NUI', 24),
(3, 'ETP', 452),
(3, 'REP', 24);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` tinyint NOT NULL,
  `U_login` varchar(255) NOT NULL,
  `U_password` varchar(255) NOT NULL,
  `dteConnexion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(50) DEFAULT NULL,
  `VIS_ID` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `U_login`, `U_password`, `dteConnexion`, `role`, `VIS_ID`) VALUES
(1, 'admin', 'password123', '2025-03-28 08:47:41', 'admin', 'AD'),
(2, 'gestionnaire', 'password123', '2025-03-28 08:47:41', 'gestionnaire', 'GE'),
(3, 'comptable', 'password123', '2025-03-28 08:47:41', 'comptable', 'CE');

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE `visiteur` (
  `VIS_ID` char(4) NOT NULL,
  `VIS_PRENOM` varchar(60) NOT NULL,
  `VIS_NOM` varchar(60) NOT NULL,
  `VIS_ADRESSE` varchar(60) NOT NULL,
  `VIS_CP` char(5) NOT NULL,
  `VIS_VILLE` varchar(60) NOT NULL,
  `VIS_DATE_EMBAUCHE` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `visiteur`
--

INSERT INTO `visiteur` (`VIS_ID`, `VIS_PRENOM`, `VIS_NOM`, `VIS_ADRESSE`, `VIS_CP`, `VIS_VILLE`, `VIS_DATE_EMBAUCHE`) VALUES
('BP', 'Baptiste', 'Paul', '36 r Champagne', '29200', 'BREST', '2024-02-08'),
('CM', 'Constant', 'Martinez', '18 r Duhamel', '29200', 'BREST', '2024-02-08'),
('CN', 'Constant', 'Navarro', '2 r Louis Tiercelin', '29200', 'BREST', '2024-02-08'),
('FJ', 'Florian', 'Julien', '83 r Suzanne Guiganton', '29200', 'BREST', '2024-02-08'),
('GL', 'Gabriel', 'Lejeune', '27 r Kermaria', '29200', 'BREST', '2024-02-08'),
('KG', 'Kilian', 'Georges', '11 sq Luxembourg', '29200', 'BREST', '2024-02-08'),
('RH', 'Robin', 'Huet', '3 r Recteur Paul Henry S', '29200', 'BREST', '2024-02-08'),
('ED', 'Delorme', 'elban', '8 r Yves Collet', '29200', 'landerneau', '2024-02-08'),
('TY', 'Delorme', 'elban', '8 r Yves Collet', '29200', 'landerneau', '2024-02-08');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`ETA_ID`);

--
-- Index pour la table `fiche_frais`
--
ALTER TABLE `fiche_frais`
  ADD PRIMARY KEY (`FFR_ID`),
  ADD KEY `VIS_ID` (`VIS_ID`),
  ADD KEY `ETA_ID` (`ETA_ID`);

--
-- Index pour la table `frais_forfait`
--
ALTER TABLE `frais_forfait`
  ADD PRIMARY KEY (`FOR_ID`);

--
-- Index pour la table `ligne_frais_forfait`
--
ALTER TABLE `ligne_frais_forfait`
  ADD PRIMARY KEY (`FFR_ID`,`FOR_ID`),
  ADD KEY `FOR_ID` (`FOR_ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`VIS_ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Index pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD PRIMARY KEY (`VIS_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `fiche_frais`
--
ALTER TABLE `fiche_frais`
  MODIFY `FFR_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
