-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2021 at 05:13 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rfid`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `namapengguna` varchar(20) NOT NULL,
  `katalaluan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`namapengguna`, `katalaluan`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `kppengguna` varchar(12) NOT NULL,
  `rfid` varchar(30) NOT NULL,
  `nama` text NOT NULL,
  `notel` varchar(12) DEFAULT NULL,
  `emel` text DEFAULT NULL,
  `jantina` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`kppengguna`, `rfid`, `nama`, `notel`, `emel`, `jantina`) VALUES
('030320030493', '0001113554', 'MOHAMAD AMIRUL ASRI BIN AZMI', '01135020493', 'amirulasrix@gmail.com', 'Lelaki'),
('213131232', '0014296780', 'SITI FATIMAH NOR BINTI ADB KADER', '', '', 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `rekodkehadiran`
--

CREATE TABLE `rekodkehadiran` (
  `id` int(100) NOT NULL,
  `rfid` varchar(30) NOT NULL,
  `tarikh` varchar(20) NOT NULL,
  `masa` varchar(10) NOT NULL,
  `tempat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekodkehadiran`
--

INSERT INTO `rekodkehadiran` (`id`, `rfid`, `tarikh`, `masa`, `tempat`) VALUES
(576, '0014296780', '2021-05-05', '08:25 PM', 'Rumah'),
(578, '0001113554', '2021-05-05', '08:26 PM', 'Rumah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`kppengguna`),
  ADD UNIQUE KEY `rfid` (`rfid`);

--
-- Indexes for table `rekodkehadiran`
--
ALTER TABLE `rekodkehadiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rfid` (`rfid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rekodkehadiran`
--
ALTER TABLE `rekodkehadiran`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=579;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rekodkehadiran`
--
ALTER TABLE `rekodkehadiran`
  ADD CONSTRAINT `rekodkehadiran_ibfk_1` FOREIGN KEY (`rfid`) REFERENCES `pengguna` (`rfid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
