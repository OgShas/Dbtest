-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2024 at 08:15 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystudentsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `studentscourses`
--

CREATE TABLE `studentscourses` (
  `studentID` int NOT NULL,
  `courseID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `studentscourses`
--

INSERT INTO `studentscourses` (`studentID`, `courseID`) VALUES
(1, 1),
(2, 1),
(13, 1),
(14, 1),
(31, 1),
(38, 1),
(39, 1),
(40, 1),
(1, 2),
(2, 2),
(32, 2),
(33, 2),
(34, 2),
(38, 2),
(1, 3),
(14, 3),
(29, 3),
(38, 3),
(1, 4),
(12, 5),
(15, 5),
(28, 5),
(35, 5),
(37, 5),
(2, 6),
(9, 6),
(13, 6),
(24, 6),
(30, 6),
(1, 7),
(22, 7),
(31, 7),
(33, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `studentscourses`
--
ALTER TABLE `studentscourses`
  ADD UNIQUE KEY `studentID` (`studentID`,`courseID`),
  ADD KEY `courseID` (`courseID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `studentscourses`
--
ALTER TABLE `studentscourses`
  ADD CONSTRAINT `studentscourses_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `courses` (`Id`),
  ADD CONSTRAINT `studentscourses_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `students` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
