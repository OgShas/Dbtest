-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 29, 2024 at 01:08 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `Id` int NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`Id`, `Name`) VALUES
(1, 'IT'),
(2, 'MATH'),
(3, 'BG'),
(4, 'EN'),
(5, 'Finance'),
(6, 'Medical'),
(7, 'Social');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Id` int NOT NULL,
  `Username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `townID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`Id`, `Username`, `Name`, `townID`) VALUES
(1, 'OGShas', 'Alexander Genov', 1),
(2, 'blinKeR', 'Alexander Karatsonev', 1),
(3, 'TheGoldenBoy', 'Stoyan Donchev', 6),
(4, 'TheBear', 'Hristo Stilianov', 5),
(5, 'PrinceCharls', 'Julian Bluskov', 4),
(6, 'CanadianWrestling', 'Kudret Kudi', 3),
(9, 'KKostov', 'KKostov', 1),
(10, 'MasteCheff', 'Nikolay Filipov', 4),
(12, 'Apostol', 'Apostol Karamitev', 3),
(13, 'NiK', 'Nikolay ', 6),
(14, 'Madafucker', 'Iliyan', 2),
(15, 'Kapitan', 'Petko|Voivoda', 4),
(18, 'Stefan ', 'Vuldobrev', 7),
(19, 'Stefan nikolov', 'Vuldobrev', 1),
(20, 'Margarit', 'Gari', 1),
(21, 'Margarit22', 'Gari22', 1),
(22, 'Ilarion', 'Makariopolski', 2),
(23, 'Serafim', 'todorot', 5),
(24, 'magardich', 'Halvadjian', 2),
(25, 'Master', 'LeChef', 1),
(26, 'Martin', 'Shterev', 1),
(27, 'Martin999', 'Shterev', 2),
(28, 'Djevdjet ', 'Chaakurov', 7),
(29, 'Petur', 'Stoyanov', 2),
(30, 'Apostol-22', 'Karamitev', 3),
(31, 'Django', 'Unchained', 1),
(32, 'Stoicho', 'Popchev', 1),
(33, 'halva', 'lubimka', 1),
(34, 'asdasdas', 'asdasd', 4);

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
(1, 2),
(2, 2),
(32, 2),
(33, 2),
(34, 2),
(1, 3),
(14, 3),
(29, 3),
(1, 4),
(12, 5),
(15, 5),
(28, 5),
(2, 6),
(9, 6),
(13, 6),
(24, 6),
(30, 6),
(1, 7),
(22, 7),
(31, 7),
(33, 7);

-- --------------------------------------------------------

--
-- Table structure for table `town`
--

CREATE TABLE `town` (
  `Id` int NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `town`
--

INSERT INTO `town` (`Id`, `Name`) VALUES
(1, 'Varna'),
(2, 'Sofia'),
(3, 'Plovdiv'),
(4, 'Burgas'),
(5, 'Montana'),
(6, 'Lom'),
(7, 'Vidin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`) USING BTREE,
  ADD KEY `townID` (`townID`);

--
-- Indexes for table `studentscourses`
--
ALTER TABLE `studentscourses`
  ADD UNIQUE KEY `studentID` (`studentID`,`courseID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `town`
--
ALTER TABLE `town`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`townID`) REFERENCES `town` (`Id`);

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
