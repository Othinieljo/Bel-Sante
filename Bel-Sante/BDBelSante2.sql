-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 17 mai 2024 à 15:46
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
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
