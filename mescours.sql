-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2016 at 02:30 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mescours`
--

DELIMITER $$
--
-- Procedures
--
CREATE DATABASE `mescours`;
CREATE DEFINER=`root`@`localhost` PROCEDURE `achatCours` (IN `studentid` VARCHAR(4), IN `coursid` VARCHAR(4))  NO SQL
INSERT INTO `studentscourses`(`CourseID`, `StudentID`) 
VALUES (coursid,studentid)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsereCour` (IN `id` VARCHAR(4), IN `nom` VARCHAR(120), IN `price` DECIMAL(14,2), IN `tuteur` VARCHAR(60))  NO SQL
INSERT INTO `courses`(`CourseID`, `CourseName`, `Price`, `Tutor`) VALUES (id,nom,price,tuteur)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insereEtudiant` (IN `myid` VARCHAR(4), IN `lastname` VARCHAR(60), IN `firstname` VARCHAR(60), IN `address` VARCHAR(150), IN `city` VARCHAR(150), IN `province` VARCHAR(30), IN `postalcode` VARCHAR(7), IN `couriel` VARCHAR(150), IN `usager` VARCHAR(30))  NO SQL
INSERT INTO `students` (`StudentID`, `LastName`, `FirstName`, `Address`, `City`, `Province`, `PostalCode`, `EmailAddress`, `UserName`) VALUES (myid, lastname, firstname, address, city, province, postalcode, couriel, usager)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insereUser` (IN `usager` VARCHAR(30), IN `mypass` VARCHAR(30))  NO SQL
INSERT INTO `users`(`UserName`, `Password`, `admin`) 
VALUES (usager, mypass, 0)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` varchar(4) NOT NULL,
  `CourseName` varchar(60) NOT NULL,
  `Price` decimal(14,2) DEFAULT NULL,
  `Tutor` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liste des cours ';

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `CourseName`, `Price`, `Tutor`) VALUES
('1101', 'Caligraphy', '175.00', 'Jones'),
('2101', 'Writing For Fun and Profit', '250.00', 'Rodrigues'),
('3101', 'Tracing Your Ancestory', '325.00', 'Lane');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` varchar(4) NOT NULL,
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
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `LastName`, `FirstName`, `Address`, `City`, `Province`, `PostalCode`, `EmailAddress`, `UserName`) VALUES
('1111', 'Starr', 'Mona', '256 Tananger Way', 'High River', 'AL', 'A1A 1A1', 'imastarr@myisp.ca', 'imastarr5'),
('1112', 'Ash', 'Mary', '156 East Street', 'Wexford', 'PE', 'B2B 2B2', 'ashtree@cable.net', 'imasuccess6'),
('1131', 'Aprea', 'James', '11 North Road', 'Parry Sound', 'ON', 'L1L 1L1', 'apreaciate@highspeed.com', 'phoenix9');

-- --------------------------------------------------------

--
-- Table structure for table `studentscourses`
--

CREATE TABLE `studentscourses` (
  `CourseID` varchar(4) NOT NULL,
  `StudentID` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentscourses`
--

INSERT INTO `studentscourses` (`CourseID`, `StudentID`) VALUES
('1101', '1112'),
('2101', '1111'),
('3101', '1131');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserName`, `Password`, `admin`) VALUES
('imastarr5', 'eggcel', 0),
('imasuccess6', 'wizard', 0),
('proprio', '1234', 1),
('phoenix9', '5aces', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `studentscourses`
--
ALTER TABLE `studentscourses`
  ADD PRIMARY KEY (`CourseID`,`StudentID`),
  ADD KEY `studentid` (`StudentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserName`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `username` FOREIGN KEY (`UserName`) REFERENCES `users` (`UserName`);

--
-- Constraints for table `studentscourses`
--
ALTER TABLE `studentscourses`
  ADD CONSTRAINT `courseid` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `studentid` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
