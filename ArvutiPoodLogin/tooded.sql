-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 04:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arvutipood`
--

-- --------------------------------------------------------

--
-- Table structure for table `tooded`
--

CREATE TABLE `tooded` (
  `tootedID` int(11) NOT NULL,
  `nimi` varchar(150) NOT NULL,
  `hind` decimal(4,2) DEFAULT NULL,
  `kirjeldus` varchar(100) DEFAULT NULL,
  `linn` varchar(100) DEFAULT NULL,
  `photo` varchar(355) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tooded`
--

INSERT INTO `tooded` (`tootedID`, `nimi`, `hind`, `kirjeldus`, `linn`, `photo`) VALUES
(1, 'toode1', 19.99, 'Elegantne puidust tool', 'Tallinn', 'https://media.arvutitark.ee/fXvSk8VtToKT_2FywpD1-sP4IIE=/trim/fit-in/800x800/filters:format(webp)/https%3A%2F%2Fcms.arvutitark.ee%2Fstorage%2Fmedia-hu'),
(2, 'toode2', 29.99, 'Kaunis lauanõude komplekt', 'Tartu', '102'),
(3, 'toode3', 15.50, 'Väärikas laud', 'Pärnu', 'https://www.tthk.ee/wp-content/uploads/2022/08/tthk_logo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tooded`
--
ALTER TABLE `tooded`
  ADD PRIMARY KEY (`tootedID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tooded`
--
ALTER TABLE `tooded`
  MODIFY `tootedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
