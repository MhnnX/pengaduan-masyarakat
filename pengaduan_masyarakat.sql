-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 02:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_masyarakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `Id_Masyarakat` int(11) NOT NULL,
  `NIK` char(16) NOT NULL,
  `Nama_Lengkap` varchar(50) NOT NULL,
  `Foto_Profil` varchar(255) NOT NULL,
  `Telp` varchar(13) NOT NULL,
  `Username` varchar(35) NOT NULL,
  `Password` varchar(35) NOT NULL,
  `Level` enum('Masyarakat') NOT NULL DEFAULT 'Masyarakat',
  `Blokir` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`Id_Masyarakat`, `NIK`, `Nama_Lengkap`, `Foto_Profil`, `Telp`, `Username`, `Password`, `Level`, `Blokir`) VALUES
(1, '91731212312', 'Muhammad Ali Irfan', '', '081282741310', 'ali', '0cc175b9c0f1b6a831c399e269772661', 'Masyarakat', 'No'),
(2, '001239121231', 'Gatau', '', '815311243', 'saya', '202cb962ac59075b964b07152d234b70', 'Masyarakat', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `Id_Modul` int(11) NOT NULL,
  `Nama_Modul` varchar(50) NOT NULL,
  `Link` varchar(100) NOT NULL,
  `Publish` enum('Yes','No') NOT NULL,
  `Akses` enum('Petugas','Admin','Masyarakat','All') NOT NULL,
  `Aktif` enum('Yes','No') NOT NULL,
  `Urutan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`Id_Modul`, `Nama_Modul`, `Link`, `Publish`, `Akses`, `Aktif`, `Urutan`) VALUES
(1, 'Data Petugas', '?module=data-petugas', 'Yes', 'Admin', 'Yes', 1),
(2, 'Lihat Pengaduan', '?module=show-pengaduan', 'Yes', 'Petugas', 'Yes', 2),
(3, 'Tanggapi Pengaduan', '?module=tanggapi-pengaduan', 'Yes', 'Petugas', 'Yes', 3),
(4, 'Data Masyarakat', '?module=data-masyarakat', 'Yes', 'Admin', 'Yes', 4),
(5, 'Pengaduan Masyarakat', '?module=pengaduan-masyarakat', 'Yes', 'Masyarakat', 'Yes', 5),
(6, 'Lihat Tanggapan', '?module=show-tanggapan', 'Yes', 'Masyarakat', 'Yes', 6),
(7, 'Manage Page', '?module=manage-page', 'Yes', 'Admin', 'Yes', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `Id_Pengaduan` int(11) NOT NULL,
  `Tanggal_Pengaduan` date NOT NULL,
  `Nama_Lengkap` varchar(50) NOT NULL,
  `Judul_Pengaduan` varchar(50) NOT NULL,
  `Pesan_Pengaduan` text NOT NULL,
  `Foto_Pengaduan` varchar(255) NOT NULL,
  `Status` enum('Proses','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `Id_Petugas` int(11) NOT NULL,
  `Nama_Petugas` varchar(50) DEFAULT NULL,
  `Foto_Petugas` varchar(255) NOT NULL,
  `Username` varchar(25) DEFAULT NULL,
  `Password` varchar(32) DEFAULT NULL,
  `Telp` varchar(13) DEFAULT NULL,
  `Level` enum('Admin','Petugas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`Id_Petugas`, `Nama_Petugas`, `Foto_Petugas`, `Username`, `Password`, `Telp`, `Level`) VALUES
(1, 'Administrator', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 'Admin'),
(2, 'SMK Informatika', '', 'infor', '300fd72d94299cf3b208e3f7b8973f7d', '', 'Petugas');

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `Id_Tanggapan` int(11) NOT NULL,
  `Id_Pengaduan` int(11) NOT NULL,
  `Tanggal_Pengaduan` date NOT NULL,
  `Tanggal_Tanggapan` date NOT NULL,
  `Nama_Petugas` varchar(50) NOT NULL,
  `Nama_Lengkap` varchar(50) NOT NULL,
  `Judul_Pengaduan` varchar(50) NOT NULL,
  `Pesan_Pengaduan` text NOT NULL,
  `Pesan_Tanggapan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`Id_Masyarakat`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`Id_Modul`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`Id_Pengaduan`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`Id_Petugas`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`Id_Tanggapan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `Id_Masyarakat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `Id_Modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `Id_Pengaduan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `Id_Petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `Id_Tanggapan` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
