-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 07:36 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tem_hum_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_history`
--

CREATE TABLE `activity_history` (
  `ID` int(10) NOT NULL,
  `Describe` mediumtext NOT NULL,
  `Type` varchar(100) NOT NULL,
  `Time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `ID` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Mode` varchar(100) NOT NULL,
  `Time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `remider`
--

CREATE TABLE `remider` (
  `ID` int(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Mode` varchar(100) NOT NULL,
  `Time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `ID` int(10) NOT NULL,
  `Temperature` varchar(100) NOT NULL,
  `Humid` varchar(100) NOT NULL,
  `Time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Birthday` varchar(100) NOT NULL,
  `Phonenumber` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Name`, `Birthday`, `Phonenumber`, `Email`, `Username`, `Password`) VALUES
(7, 'Phạm Công Hậu', '04/08/2000', '0943765795', 'haupham.hn3k64@gmail.com', 'hau.pham0408', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_history`
--
ALTER TABLE `activity_history`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `remider`
--
ALTER TABLE `remider`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_history`
--
ALTER TABLE `activity_history`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remider`
--
ALTER TABLE `remider`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
