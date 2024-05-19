-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2024 at 05:47 AM
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
-- Database: `sistem_pengelolaan_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$bQ755kBPXmNVcCl82h74He3sefkz2kBuMY6Gs4A6jbBTt5Fx.ulv2');

-- --------------------------------------------------------

--
-- Table structure for table `informasi_surat`
--

CREATE TABLE `informasi_surat` (
  `id` int(11) NOT NULL,
  `kategori_surat` varchar(100) NOT NULL,
  `format_surat` varchar(100) NOT NULL,
  `prasyarat_surat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `informasi_surat`
--

INSERT INTO `informasi_surat` (`id`, `kategori_surat`, `format_surat`, `prasyarat_surat`) VALUES
(1, 'Surat Pengantar Penelitian', 'STMIK-002', 'Surat Keterangan, Surat Pengantar'),
(2, 'Surat Keterangan Mahasiswa', 'STMIK-001', 'Kartu Tanda Mahasiswa'),
(3, 'Surat Dispensasi', 'STMIK-003', 'Kartu Tanda Mahasiswa, Tanda Tangan Wali Dosen');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`) VALUES
(1, '1222301'),
(7, '1222302'),
(2, '1222303'),
(8, '1222308');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `id_informasi_surat` int(11) DEFAULT NULL,
  `keperluan` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pengajuan_surat`
--

INSERT INTO `pengajuan_surat` (`id`, `nim`, `id_informasi_surat`, `keperluan`, `status`, `tanggal_pengajuan`) VALUES
(1, '123', 1, 'Ingin meminta surat pengajuan penelitian skripsi saya dengan tema pengelolaan data kas negara.', 'Selesai', '2024-02-22'),
(2, '1222303', 3, 'Mengikuti Pekan Olahraga Antar Kampus SeIndonesia', 'Selesai', '2024-04-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informasi_surat`
--
ALTER TABLE `informasi_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`nim`),
  ADD KEY `id_informasi_surat` (`id_informasi_surat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `informasi_surat`
--
ALTER TABLE `informasi_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
