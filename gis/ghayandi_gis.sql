-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2021 at 10:22 AM
-- Server version: 10.3.27-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ghayandi_gis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_kecamatan`
--

CREATE TABLE `tbl_data_kecamatan` (
  `id_data` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `luas_wilayah` varchar(20) NOT NULL,
  `jml_laki` int(11) NOT NULL,
  `jml_perempuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_data_kecamatan`
--

INSERT INTO `tbl_data_kecamatan` (`id_data`, `id_kecamatan`, `luas_wilayah`, `jml_laki`, `jml_perempuan`) VALUES
(1, 1, '31,42', 107890, 103180),
(2, 2, '21,96', 82430, 79790),
(3, 3, '49,99', 159170, 152420),
(4, 4, '23,76', 142010, 136180);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kecamatan`
--

CREATE TABLE `tbl_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nama_kecamatan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kecamatan`
--

INSERT INTO `tbl_kecamatan` (`id_kecamatan`, `nama_kecamatan`) VALUES
(1, 'denpasar utara'),
(2, 'denpasar timur'),
(3, 'denpasar selatan'),
(4, 'denpasar barat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_data_kecamatan`
--
ALTER TABLE `tbl_data_kecamatan`
  ADD PRIMARY KEY (`id_data`);

--
-- Indexes for table `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_data_kecamatan`
--
ALTER TABLE `tbl_data_kecamatan`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
