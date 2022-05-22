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
-- Database: `algerietelecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `achats`
--

CREATE TABLE `achats` (
  `id` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `date` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `prixCommand` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `permission` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `salt` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imageURL` varchar(500) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `prenom`, `nom`, `username`, `password`, `permission`, `salt`, `imageURL`) VALUES
(3, 'Kenyon', 'Johnston', 'kenyon.johnston@ethereal.email', '21232f297a57a5a743894a0e4a801fc3', 'ADMIN', '29e7396b6b7e8b8ab20daabcde1c7732', 'https://interactive-examples.mdn.mozilla.net/media/cc0-images/grapefruit-slice-332-332.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `carte`
--

CREATE TABLE `carte` (
  `n_serie` int(11) NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `idproduit` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `isChecked` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clientaccount`
--

CREATE TABLE `clientaccount` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `permission` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `idBank` int(11) NOT NULL,
  `isReset` varchar(25) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `naissance` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `carte_national` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `paiement` double NOT NULL,
  `capaciteFinanciere` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `typeTravaille` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `auth` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

CREATE TABLE `demande` (
  `id` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `type_client` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nature` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `genre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_nais` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `wilayaoui` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `adresse` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `type_piece` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `num_piece` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `emetteur_piece` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_piece` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `reponse` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `reponseContent` varchar(500) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `idpropritaire` int(11) NOT NULL,
  `contenue` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `envoyez_le` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `suject` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modem`
--

CREATE TABLE `modem` (
  `n_serie` int(11) NOT NULL,
  `idproduit` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `output_images`
--

CREATE TABLE `output_images` (
  `Id` int(11) NOT NULL,
  `imageType` varchar(255) NOT NULL,
  `imageData` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nature` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `totalreveue` double NOT NULL,
  `nombretotal` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `n_achats` int(11) NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_images`
--

CREATE TABLE `profile_images` (
  `Id` int(11) NOT NULL,
  `imageType` varchar(255) NOT NULL,
  `imageData` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `messageid` int(11) NOT NULL,
  `content` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `envoyez_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statistique`
--

CREATE TABLE `statistique` (
  `id` int(11) NOT NULL,
  `nombreProduit` int(11) NOT NULL,
  `nombreClient` int(11) NOT NULL,
  `nombreMessage` int(11) NOT NULL,
  `revenueADSL_carte` double NOT NULL,
  `revenue4G_carte` double NOT NULL,
  `revenue_ADSL_m` double NOT NULL,
  `revenue_4G_m` double NOT NULL,
  `revenueTotal` double NOT NULL,
  `annee` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nombreModemAdsl` int(11) NOT NULL,
  `nombreModem4G` int(11) NOT NULL,
  `nombreCarteAdsl` int(11) NOT NULL,
  `nombreCarte4G` int(11) NOT NULL,
  `nombreModem` int(11) NOT NULL,
  `nombreCarte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dependOnProduct` (`idProduct`),
  ADD KEY `dependOnClient` (`idClient`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`n_serie`),
  ADD KEY `idproduit` (`idproduit`);

--
-- Indexes for table `clientaccount`
--
ALTER TABLE `clientaccount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idBank` (`idBank`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD KEY `id` (`id`);

--
-- Indexes for table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientID` (`clientID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpropritaire` (`idpropritaire`);

--
-- Indexes for table `modem`
--
ALTER TABLE `modem`
  ADD PRIMARY KEY (`n_serie`),
  ADD KEY `idproduit` (`idproduit`);

--
-- Indexes for table `output_images`
--
ALTER TABLE `output_images`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `messageid` (`messageid`);

--
-- Indexes for table `statistique`
--
ALTER TABLE `statistique`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achats`
--
ALTER TABLE `achats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carte`
--
ALTER TABLE `carte`
  MODIFY `n_serie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clientaccount`
--
ALTER TABLE `clientaccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demande`
--
ALTER TABLE `demande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modem`
--
ALTER TABLE `modem`
  MODIFY `n_serie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `dependOnClient` FOREIGN KEY (`idClient`) REFERENCES `clientaccount` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `dependOnProduct` FOREIGN KEY (`idProduct`) REFERENCES `produits` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `carte_ibfk_1` FOREIGN KEY (`idproduit`) REFERENCES `produits` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `clientaccount`
--
ALTER TABLE `clientaccount`
  ADD CONSTRAINT `clientaccount_ibfk_1` FOREIGN KEY (`idBank`) REFERENCES `algerieccp`.`bankccp` (`numero_check`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clientaccount` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`clientID`) REFERENCES `clientaccount` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`idpropritaire`) REFERENCES `clientaccount` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `modem`
--
ALTER TABLE `modem`
  ADD CONSTRAINT `modem_ibfk_1` FOREIGN KEY (`idproduit`) REFERENCES `produits` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `output_images`
--
ALTER TABLE `output_images`
  ADD CONSTRAINT `output_images_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `produits` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD CONSTRAINT `profile_images_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `clientaccount` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`clientid`) REFERENCES `clientaccount` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`messageid`) REFERENCES `message` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
