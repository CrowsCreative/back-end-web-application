-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2021 at 12:39 AM
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
-- Database: `algerieccp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankccp`
--

CREATE TABLE `bankccp` (
  `numero_check` int(50) NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `compte` double NOT NULL,
  `nouvelleavoir` double NOT NULL,
  `consultation` double NOT NULL,
  `consultationdate` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bankccp`
--

INSERT INTO `bankccp` (`numero_check`, `prenom`, `nom`, `compte`, `nouvelleavoir`, `consultation`, `consultationdate`, `code`) VALUES
(1878527379, 'Adel', 'Toumouh', 150000, 0, 0, 'Wed Jun 02 2021 11:22:52 GMT-1200 (GMT-12:00)', '0722'),
(1878927359, 'Mohammed', 'Berabah', 70000, 0, 0, 'Wed Jun 02 2021 11:22:52 GMT-1200 (GMT-12:00)', '1112'),
(1878927379, 'Farah', 'Benaaoum', 70000, 0, 0, 'Wed Jun 02 2021 11:22:52 GMT-1200 (GMT-12:00)', '2510');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bankccp`
--
ALTER TABLE `bankccp`
  ADD PRIMARY KEY (`numero_check`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
