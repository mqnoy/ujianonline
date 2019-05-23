-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 04:38 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujianonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_admin_aplikasi`
--

CREATE TABLE `master_admin_aplikasi` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_admin_aplikasi`
--

INSERT INTO `master_admin_aplikasi` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'azmi', '2251df3b7a7c55657526155222d2743a');

-- --------------------------------------------------------

--
-- Table structure for table `master_kunci_jawaban`
--

CREATE TABLE `master_kunci_jawaban` (
  `id_kunci_jawaban` int(11) NOT NULL,
  `soal_id` int(11) NOT NULL,
  `jawaban_pg` char(1) NOT NULL,
  `bobot` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_kunci_jawaban`
--

INSERT INTO `master_kunci_jawaban` (`id_kunci_jawaban`, `soal_id`, `jawaban_pg`, `bobot`) VALUES
(1, 1, 'B', 10);

-- --------------------------------------------------------

--
-- Table structure for table `master_pg_soal`
--

CREATE TABLE `master_pg_soal` (
  `id_pg` int(10) NOT NULL,
  `jawaban_pg` char(1) NOT NULL,
  `jawaban_text` text NOT NULL,
  `soal_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pg_soal`
--

INSERT INTO `master_pg_soal` (`id_pg`, `jawaban_pg`, `jawaban_text`, `soal_id`) VALUES
(1, 'A', '3', 1),
(2, 'B', '2', 1),
(4, 'C', '12', 1),
(7, 'D', '14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_soal`
--

CREATE TABLE `master_soal` (
  `id_soal` int(10) NOT NULL,
  `text_soal` text NOT NULL,
  `matpel` varchar(20) NOT NULL,
  `soal_kelas` enum('1','2','3') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_soal`
--

INSERT INTO `master_soal` (`id_soal`, `text_soal`, `matpel`, `soal_kelas`) VALUES
(1, '1+1 = ?', 'matematika', '1'),
(2, 'asdasd', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_nilai_peserta`
--

CREATE TABLE `tabel_nilai_peserta` (
  `id_siswa` int(10) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `total_nilai` int(9) NOT NULL,
  `siswa_kelas` char(10) NOT NULL,
  `soal_id` int(10) NOT NULL,
  `tanggal_pengerjaan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_nilai_peserta`
--

INSERT INTO `tabel_nilai_peserta` (`id_siswa`, `nis`, `total_nilai`, `siswa_kelas`, `soal_id`, `tanggal_pengerjaan`) VALUES
(1, 'd20182727', 80, '3', 1, '2019-05-21 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_admin_aplikasi`
--
ALTER TABLE `master_admin_aplikasi`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `master_kunci_jawaban`
--
ALTER TABLE `master_kunci_jawaban`
  ADD PRIMARY KEY (`id_kunci_jawaban`);

--
-- Indexes for table `master_pg_soal`
--
ALTER TABLE `master_pg_soal`
  ADD PRIMARY KEY (`id_pg`);

--
-- Indexes for table `master_soal`
--
ALTER TABLE `master_soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `tabel_nilai_peserta`
--
ALTER TABLE `tabel_nilai_peserta`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_admin_aplikasi`
--
ALTER TABLE `master_admin_aplikasi`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `master_kunci_jawaban`
--
ALTER TABLE `master_kunci_jawaban`
  MODIFY `id_kunci_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `master_pg_soal`
--
ALTER TABLE `master_pg_soal`
  MODIFY `id_pg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `master_soal`
--
ALTER TABLE `master_soal`
  MODIFY `id_soal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tabel_nilai_peserta`
--
ALTER TABLE `tabel_nilai_peserta`
  MODIFY `id_siswa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
