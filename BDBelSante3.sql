-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 17 mai 2024 à 16:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `BDBelSante`
--

-- --------------------------------------------------------

--
-- Structure de la table `CONSULTATION`
--

CREATE TABLE `CONSULTATION` (
  `IDCONSULTATION` int(11) NOT NULL,
  `NUMERODOSSIER` int(11) NOT NULL,
  `DIAGNOSTIC` text DEFAULT NULL,
  `PRESCRIPTION` text DEFAULT NULL,
  `ACTEMEDICAL` text DEFAULT NULL,
  `DATECONSULTATION` date DEFAULT NULL,
  `HEURECONSULTATION` datetime DEFAULT NULL,
  `DATECONTROLE` date DEFAULT NULL,
  `OBSERVATION` text DEFAULT NULL,
  `CONSTANTES` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CONSULTATION`
--

INSERT INTO `CONSULTATION` (`IDCONSULTATION`, `NUMERODOSSIER`, `DIAGNOSTIC`, `PRESCRIPTION`, `ACTEMEDICAL`, `DATECONSULTATION`, `HEURECONSULTATION`, `DATECONTROLE`, `OBSERVATION`, `CONSTANTES`) VALUES
(5, 17, 'DF NZXNCZXZJBKJCXNDA', ' hcxv mb,sdsdjksdb ', '', '2024-05-12', NULL, '2024-02-01', 'ds xzmcsjkcbkzxlska', 'dsh nxzhbkjcsdllckxzkcdsd');

-- --------------------------------------------------------

--
-- Structure de la table `DOSSIER`
--

CREATE TABLE `DOSSIER` (
  `NUMERODOSSIER` int(11) NOT NULL,
  `NOM` text DEFAULT NULL,
  `PRENOM` text DEFAULT NULL,
  `DATENAISSANCE` date DEFAULT NULL,
  `LIEUNAISSANCE` text DEFAULT NULL,
  `SEXE` text DEFAULT NULL,
  `PROFESSION` text DEFAULT NULL,
  `CONTACT` text DEFAULT NULL,
  `EMAIL` text DEFAULT NULL,
  `GROUPESANGUIN` text DEFAULT NULL,
  `ANTECEDANTS` text DEFAULT NULL,
  `HABITATION` text DEFAULT NULL,
  `STATUT` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `DOSSIER`
--

INSERT INTO `DOSSIER` (`NUMERODOSSIER`, `NOM`, `PRENOM`, `DATENAISSANCE`, `LIEUNAISSANCE`, `SEXE`, `PROFESSION`, `CONTACT`, `EMAIL`, `GROUPESANGUIN`, `ANTECEDANTS`, `HABITATION`, `STATUT`) VALUES
(17, 'KOUADIO', 'JACQUES ', '1885-01-23', 'ABIDJAN', 'M', 'Commercant', '0767215612', 'kkjacques@gmail.com', 'O+', '', 'Treichville', 1);

-- --------------------------------------------------------

--
-- Structure de la table `EXAMENCOMPLEMENTAIRE`
--

CREATE TABLE `EXAMENCOMPLEMENTAIRE` (
  `IDEXAMENCOMPL` int(11) NOT NULL,
  `IDSERVICE` int(11) NOT NULL,
  `LIBELLEEXAMCOMPL` char(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `EXAMENCOMPLEMENTAIRE`
--

INSERT INTO `EXAMENCOMPLEMENTAIRE` (`IDEXAMENCOMPL`, `IDSERVICE`, `LIBELLEEXAMCOMPL`) VALUES
(5, 1, 'Radiographie Thoracique'),
(6, 1, 'Échographie Abdominale'),
(7, 1, 'IRM Cérébrale'),
(8, 1, 'Scanner Abdomino-Pelvien');

-- --------------------------------------------------------

--
-- Structure de la table `NECESSITER`
--

CREATE TABLE `NECESSITER` (
  `IDNECESSITER` int(11) NOT NULL,
  `IDCONSULTATION` int(11) NOT NULL,
  `IDEXAMENCOMPL` int(11) NOT NULL,
  `DATEEXAMEN` date DEFAULT NULL,
  `CAUSEEXAMEN` text DEFAULT NULL,
  `RESULTATS` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `NECESSITER`
--

INSERT INTO `NECESSITER` (`IDNECESSITER`, `IDCONSULTATION`, `IDEXAMENCOMPL`, `DATEEXAMEN`, `CAUSEEXAMEN`, `RESULTATS`) VALUES
(2, 5, 5, '2024-05-17', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `PARTICIPER`
--

CREATE TABLE `PARTICIPER` (
  `IDPARTICIPER` int(11) NOT NULL,
  `IDCONSULTATION` int(11) NOT NULL,
  `IDSPECIALISTE` int(11) NOT NULL,
  `TACHE` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `PARTICIPER`
--

INSERT INTO `PARTICIPER` (`IDPARTICIPER`, `IDCONSULTATION`, `IDSPECIALISTE`, `TACHE`) VALUES
(4, 5, 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `SERVICE`
--

CREATE TABLE `SERVICE` (
  `IDSERVICE` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `NOMSERVICE` text NOT NULL,
  `RESPONSABLE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `SERVICE`
--

INSERT INTO `SERVICE` (`IDSERVICE`, `id_user`, `NOMSERVICE`, `RESPONSABLE`) VALUES
(1, 13, 'Radiologie et Imagerie medicale ', 'KOUASSI JEAN'),
(2, 14, 'Laboratoire et Biologie Medicale', 'KOUADIO YVES ');

-- --------------------------------------------------------

--
-- Structure de la table `SPECIALISTE`
--

CREATE TABLE `SPECIALISTE` (
  `IDSPECIALISTE` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `NOMSPECIALISTE` text DEFAULT NULL,
  `PRENOMSPECIALISTE` text DEFAULT NULL,
  `SEXESPECIALISTE` text NOT NULL,
  `SPECIALITEDUSPECIALISTE` text DEFAULT NULL,
  `GRADESPECIALISTE` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `SPECIALISTE`
--

INSERT INTO `SPECIALISTE` (`IDSPECIALISTE`, `id_user`, `NOMSPECIALISTE`, `PRENOMSPECIALISTE`, `SEXESPECIALISTE`, `SPECIALITEDUSPECIALISTE`, `GRADESPECIALISTE`) VALUES
(6, 2, 'Doe', 'John', '', 'Cardiologie', 'Cardiologue'),
(7, 6, 'N\'DA', 'CYRILLE JEAN', 'M', 'Chirurgie ', 'A3'),
(8, 11, 'Duk ', 'Kaborage', 'F', 'STEPBRO', 'A3');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text DEFAULT NULL,
  `password` text NOT NULL,
  `type` text DEFAULT NULL,
  `numero` text DEFAULT NULL,
  `photourl` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `type`, `numero`, `photourl`) VALUES
(1, 'Jojo225', '', '$2y$10$0qkkiK6wdY70TQk.Mt4XhuAaphh0EIxThnnNtP3L33jnrEvFO4sY.', 'admin', '0789413618', NULL),
(2, 'Sunking', '', '$2y$10$nNOTcix4WRRDfe7qapGR3.5qu7ZckPO7TVyX7CpCZoKn/uq0RAluS', 'specialiste', NULL, NULL),
(4, 'Esli', '', '$2y$10$k7DcdfNlDR.LohHDOh6VYO5fztPI4sBjO8gsQPqX3rv9yDQjt1zym', 'receptioniste', NULL, NULL),
(6, 'Cyril', 'cyril.nda@gmail.com', '$2y$10$pw3qXAXszlZaKHthCMNMzuPYEhXq6D2mYs0PPTMqWQIaiPlanfZ9C', 'specialiste', '0552113051', 'a8aa2796-667f-4935-b380-94a9e03a452e.JPG'),
(10, '', '', '$2y$10$sUn9mrPhL2rT50Z/ZRZsjeiMy4G6l8EUiXJeZ1ZDDCw9.05PUMY0a', 'specialiste', '', ''),
(11, 'duk', 'bahiliariel@gmail.com', '$2y$10$uX1lB6i7YLVOqje7XXi38eXM8Gb3XxcFQzngXrJm1yPmhG0cCAxAW', 'specialiste', '0777409491', '20-ESATIC0145AM.jpg'),
(13, 'kjean', NULL, '$2y$10$CHzylzBnFdQrSMImz1ucjeAccOVPDOBtYUY5TJy2aRO5phPt1IrPm', 'service', '0767409491', NULL),
(14, 'kyves', NULL, '$2y$10$t9gHR2pBe6kJDtYbLKnOYur65TbfVZmWSqYHDSTb1RFAK7jaYDL5.', 'service', '0777408491', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CONSULTATION`
--
ALTER TABLE `CONSULTATION`
  ADD PRIMARY KEY (`IDCONSULTATION`),
  ADD KEY `FK_CONCERNER` (`NUMERODOSSIER`);

--
-- Index pour la table `DOSSIER`
--
ALTER TABLE `DOSSIER`
  ADD PRIMARY KEY (`NUMERODOSSIER`);

--
-- Index pour la table `EXAMENCOMPLEMENTAIRE`
--
ALTER TABLE `EXAMENCOMPLEMENTAIRE`
  ADD PRIMARY KEY (`IDEXAMENCOMPL`),
  ADD KEY `FK_IDSERVICE` (`IDSERVICE`) USING BTREE;

--
-- Index pour la table `NECESSITER`
--
ALTER TABLE `NECESSITER`
  ADD PRIMARY KEY (`IDNECESSITER`),
  ADD KEY `FK_EXAMCOMPL` (`IDEXAMENCOMPL`) USING BTREE,
  ADD KEY `IDCONSULTATION` (`IDCONSULTATION`) USING BTREE;

--
-- Index pour la table `PARTICIPER`
--
ALTER TABLE `PARTICIPER`
  ADD PRIMARY KEY (`IDPARTICIPER`),
  ADD UNIQUE KEY `IDCONSULTATION` (`IDCONSULTATION`) USING BTREE,
  ADD KEY `FK_PARTICIPER` (`IDSPECIALISTE`);

--
-- Index pour la table `SERVICE`
--
ALTER TABLE `SERVICE`
  ADD PRIMARY KEY (`IDSERVICE`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Index pour la table `SPECIALISTE`
--
ALTER TABLE `SPECIALISTE`
  ADD PRIMARY KEY (`IDSPECIALISTE`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `CONSULTATION`
--
ALTER TABLE `CONSULTATION`
  MODIFY `IDCONSULTATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `DOSSIER`
--
ALTER TABLE `DOSSIER`
  MODIFY `NUMERODOSSIER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `EXAMENCOMPLEMENTAIRE`
--
ALTER TABLE `EXAMENCOMPLEMENTAIRE`
  MODIFY `IDEXAMENCOMPL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `NECESSITER`
--
ALTER TABLE `NECESSITER`
  MODIFY `IDNECESSITER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `PARTICIPER`
--
ALTER TABLE `PARTICIPER`
  MODIFY `IDPARTICIPER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `SERVICE`
--
ALTER TABLE `SERVICE`
  MODIFY `IDSERVICE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `SPECIALISTE`
--
ALTER TABLE `SPECIALISTE`
  MODIFY `IDSPECIALISTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `CONSULTATION`
--
ALTER TABLE `CONSULTATION`
  ADD CONSTRAINT `FK_CONCERNER` FOREIGN KEY (`NUMERODOSSIER`) REFERENCES `DOSSIER` (`NUMERODOSSIER`);

--
-- Contraintes pour la table `EXAMENCOMPLEMENTAIRE`
--
ALTER TABLE `EXAMENCOMPLEMENTAIRE`
  ADD CONSTRAINT `EXAMENCOMPLEMENTAIRE_ibfk_1` FOREIGN KEY (`IDSERVICE`) REFERENCES `SERVICE` (`IDSERVICE`);

--
-- Contraintes pour la table `NECESSITER`
--
ALTER TABLE `NECESSITER`
  ADD CONSTRAINT `FK_NECESSITER` FOREIGN KEY (`IDEXAMENCOMPL`) REFERENCES `EXAMENCOMPLEMENTAIRE` (`IDEXAMENCOMPL`),
  ADD CONSTRAINT `FK_NECESSITER2` FOREIGN KEY (`IDCONSULTATION`) REFERENCES `CONSULTATION` (`IDCONSULTATION`);

--
-- Contraintes pour la table `PARTICIPER`
--
ALTER TABLE `PARTICIPER`
  ADD CONSTRAINT `FK_PARTICIPER` FOREIGN KEY (`IDSPECIALISTE`) REFERENCES `SPECIALISTE` (`IDSPECIALISTE`),
  ADD CONSTRAINT `FK_PARTICIPER2` FOREIGN KEY (`IDCONSULTATION`) REFERENCES `CONSULTATION` (`IDCONSULTATION`);

--
-- Contraintes pour la table `SPECIALISTE`
--
ALTER TABLE `SPECIALISTE`
  ADD CONSTRAINT `SPECIALISTE_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
