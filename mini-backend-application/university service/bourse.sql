-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 19, 2022 at 11:35 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bourse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`) VALUES
(1, '243e61e9410a9f577d2d662c67025ee9');

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `matricule` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `Isdeleted` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`id`, `matricule`, `email`, `password`, `code`, `Isdeleted`) VALUES
(1, 151520, 'ok@gmail.com', '834dc0b93bcf792a7af27110f2466359', '834dc0b93bcf792a7af27110f2466359', 'false'),
(2, 151521, 'ok@gmail.com', '425493adff8a2d0886d075ee6796cfe7', '425493adff8a2d0886d075ee6796cfe7', 'false'),
(3, 1111111, 'ok@gmail.com', '7fa8282ad93047a4d6fe6111c93b308a', '7fa8282ad93047a4d6fe6111c93b308a', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `telephone` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `pays` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `banque` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `specilite` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `matricule` int(11) NOT NULL,
  `general` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etudiants`
--

INSERT INTO `etudiants` (`id`, `nom`, `prenom`, `address`, `telephone`, `pays`, `banque`, `specilite`, `matricule`, `general`, `type`, `status`, `image`) VALUES
(5, 'Ben ahmed', 'amel', 'sidi bel abbes, maconnais logts 200', '0778951456', 'algerie', '0020773551', 'SI', 151520, 'Etudiante en informatique pour etudier le system', 'Master', 'pending', '241136174_10165904404680717_371860988643748391_n.png'),
(6, 'Rais', 'Akram', 'Biskra, 07', '0560590777', 'algerie', '0020773551', 'BDD', 151521, 'ganger de la monnie et de l argent', 'License', 'end', '3660856.jpg'),
(7, 'zarbout', 'mrabet', 'sidi bel abbes , 18 logts algerie', '0790950487', 'algerie', '0020773551', 'RS', 1111111, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ', 'License', 'end', '3660856.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `formations`
--

CREATE TABLE `formations` (
  `id` int(11) NOT NULL,
  `s1` float NOT NULL,
  `s2` float NOT NULL,
  `s3` float NOT NULL,
  `s4` float NOT NULL,
  `s5` float NOT NULL,
  `s6` float NOT NULL,
  `pfe` float NOT NULL,
  `m1` float NOT NULL,
  `m2` float NOT NULL,
  `m3` float NOT NULL,
  `m4` float NOT NULL,
  `MG` float NOT NULL,
  `MM` float NOT NULL,
  `MME` float NOT NULL,
  `auto_decision` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `decision` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formations`
--

INSERT INTO `formations` (`id`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`, `pfe`, `m1`, `m2`, `m3`, `m4`, `MG`, `MM`, `MME`, `auto_decision`, `decision`) VALUES
(5, 15.5, 12.5, 13.33, 14.43, 15.8, 14.5, 18, 11.2, 11.25, 14.25, 16.17, 13.7804, 16.17, 11.2, 'accepted', 'null'),
(6, 15.5, 13.5, 12.5, 14.5, 18.5, 12.22, 19, 0, 0, 0, 0, 14.4533, 18.5, 12.22, 'accepted', 'accepted'),
(7, 11.5, 7.5, 2.5, 14.5, 18, 19, 7, 0, 0, 0, 0, 12.1667, 19, 2.5, 'rejected', 'accepted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
