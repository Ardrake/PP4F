-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2017 at 01:49 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acmejeux`
--
CREATE DATABASE IF NOT EXISTS `acmejeux` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `acmejeux`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `achatJeux`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `achatJeux` (IN `clientid` VARCHAR(4), IN `jeuxid` VARCHAR(4))  NO SQL
INSERT INTO `clientjeux`(`JeuxID`, `ClientID`) 
VALUES (jeuxid, clientid)$$

DROP PROCEDURE IF EXISTS `insereClient`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insereClient` (IN `myid` VARCHAR(4), IN `lastname` VARCHAR(60), IN `firstname` VARCHAR(60), IN `address` VARCHAR(150), IN `city` VARCHAR(150), IN `province` VARCHAR(30), IN `postalcode` VARCHAR(7), IN `couriel` VARCHAR(150), IN `usager` VARCHAR(30))  NO SQL
INSERT INTO `Client` (`ClientID`, `LastName`, `FirstName`, `Address`, `City`, `Province`, `PostalCode`, `EmailAddress`, `UserName`) VALUES (myid, lastname, firstname, address, city, province, postalcode, couriel, usager)$$

DROP PROCEDURE IF EXISTS `InsereJeux`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsereJeux` (IN `id` VARCHAR(4), IN `nom` VARCHAR(120), IN `prix` DECIMAL(14,2))  NO SQL
INSERT INTO `jeux`(`JeuxID`, `JeuxNom`, `Prix`) VALUES (id,nom,prix)$$

DROP PROCEDURE IF EXISTS `insereUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insereUser` (IN `usager` VARCHAR(30), IN `mypass` VARCHAR(30))  NO SQL
INSERT INTO `users`(`UserName`, `Password`, `admin`) 
VALUES (usager, mypass, 0)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `ClientID` varchar(4) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(30) DEFAULT NULL,
  `Province` varchar(30) DEFAULT NULL,
  `PostalCode` varchar(7) DEFAULT NULL,
  `EmailAddress` varchar(50) DEFAULT NULL,
  `UserName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ClientID`, `LastName`, `FirstName`, `Address`, `City`, `Province`, `PostalCode`, `EmailAddress`, `UserName`) VALUES
('1132', 'Andre', 'Cooke', '123131 123123', 'aseasda', 'qc', 'J1W3E4', 'andrecooke@hotmail.com', 'Ardrake');

-- --------------------------------------------------------

--
-- Table structure for table `clientjeux`
--

DROP TABLE IF EXISTS `clientjeux`;
CREATE TABLE `clientjeux` (
  `JeuxID` varchar(4) NOT NULL,
  `ClientID` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clientjeux`
--

INSERT INTO `clientjeux` (`JeuxID`, `ClientID`) VALUES
('1101', '1132'),
('3101', '1132'),
('4101', '1132');

-- --------------------------------------------------------

--
-- Table structure for table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE `jeux` (
  `JeuxID` varchar(4) NOT NULL,
  `JeuxNom` varchar(60) NOT NULL,
  `Prix` decimal(14,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liste des cours ';

--
-- Dumping data for table `jeux`
--

INSERT INTO `jeux` (`JeuxID`, `JeuxNom`, `Prix`) VALUES
('1101', 'Risk', '17.50'),
('2101', 'Battelship', '25.00'),
('3101', 'Le Pendu', '3.25'),
('4101', 'La Ferme', '7.65'),
('5010', 'Concentration', '9.99'),
('6101', 'Nombres', '3.99'),
('7101', 'Serpent et Échelles', '7.49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserName`, `Password`, `admin`) VALUES
('Ardrake', '1234', 0),
('proprio', '1234', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ClientID`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `clientjeux`
--
ALTER TABLE `clientjeux`
  ADD PRIMARY KEY (`JeuxID`,`ClientID`),
  ADD KEY `studentid` (`ClientID`);

--
-- Indexes for table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`JeuxID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserName`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `username` FOREIGN KEY (`UserName`) REFERENCES `users` (`UserName`);

--
-- Constraints for table `clientjeux`
--
ALTER TABLE `clientjeux`
  ADD CONSTRAINT `courseid` FOREIGN KEY (`JeuxID`) REFERENCES `jeux` (`JeuxID`),
  ADD CONSTRAINT `studentid` FOREIGN KEY (`ClientID`) REFERENCES `client` (`ClientID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
