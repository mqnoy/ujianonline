-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2019 at 05:57 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `master_kelas`
--

CREATE TABLE `master_kelas` (
  `id_kelas` int(11) NOT NULL,
  `txt_kelas` text NOT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_kelas`
--

INSERT INTO `master_kelas` (`id_kelas`, `txt_kelas`, `kelas`) VALUES
(1, 'kelas 1 smk', 1),
(2, 'kelas 2 smk', 2),
(3, 'kelas 3 smk', 3);

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
(1, 1, 'A', 10),
(2, 2, 'B', 10);

-- --------------------------------------------------------

--
-- Table structure for table `master_matpel`
--

CREATE TABLE `master_matpel` (
  `id_matpel` int(10) NOT NULL,
  `nama_matpel` text NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_matpel`
--

INSERT INTO `master_matpel` (`id_matpel`, `nama_matpel`, `kelas_id`) VALUES
(1, 'matematika', 1),
(14, 'ppkn', 1),
(15, 'Bahasa Indonesia', 3),
(16, 'english', 2),
(17, 'matematika', 2),
(18, 'English', 2);

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
(1, 'A', 'adeknya rudi', 1),
(2, 'B', 'adeknya fani', 1),
(3, 'C', 'adeknya koko', 1),
(4, 'D', 'adeknya kiki', 1),
(5, 'A', 'ya ini cuma sampe b', 2),
(6, 'B', 'ya ini cuma sampe deh', 2),
(7, 'C', '', 2),
(8, 'D', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_nilai_siswa`
--

CREATE TABLE `tabel_nilai_siswa` (
  `id_siswa` int(10) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` text NOT NULL,
  `total_nilai` int(9) NOT NULL,
  `siswa_kelas` char(10) NOT NULL,
  `matpel_id` int(10) NOT NULL,
  `tanggal_pengerjaan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_nilai_siswa`
--

INSERT INTO `tabel_nilai_siswa` (`id_siswa`, `nis`, `nama_siswa`, `total_nilai`, `siswa_kelas`, `matpel_id`, `tanggal_pengerjaan`) VALUES
(1, '201643502057', 'rifkyazmi', 90, '1', 1, '2019-06-03 22:38:18'),
(2, '201643502058', 'rifkyazmi', 0, '1', 1, '2019-06-03 22:41:11'),
(3, '123', 'asd', 10, '3', 15, '2019-06-03 22:44:38'),
(4, '123', 'asd', 20, '3', 15, '2019-06-03 22:44:59'),
(5, '2018', 'qnoy', 10, '3', 15, '2019-06-03 22:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_soal`
--

CREATE TABLE `tabel_soal` (
  `id_soal` int(10) NOT NULL,
  `nomor_soal` int(100) NOT NULL,
  `text_soal` text NOT NULL,
  `matpel_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_soal`
--

INSERT INTO `tabel_soal` (`id_soal`, `nomor_soal`, `text_soal`, `matpel_id`) VALUES
(1, 1, '<p>siapakah andi ?</p>\n', 15),
(2, 2, '<p>belum ada pg test</p>\n', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_admin_aplikasi`
--
ALTER TABLE `master_admin_aplikasi`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `master_kelas`
--
ALTER TABLE `master_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `master_kunci_jawaban`
--
ALTER TABLE `master_kunci_jawaban`
  ADD PRIMARY KEY (`id_kunci_jawaban`);

--
-- Indexes for table `master_matpel`
--
ALTER TABLE `master_matpel`
  ADD PRIMARY KEY (`id_matpel`);

--
-- Indexes for table `master_pg_soal`
--
ALTER TABLE `master_pg_soal`
  ADD PRIMARY KEY (`id_pg`);

--
-- Indexes for table `tabel_nilai_siswa`
--
ALTER TABLE `tabel_nilai_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tabel_soal`
--
ALTER TABLE `tabel_soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_admin_aplikasi`
--
ALTER TABLE `master_admin_aplikasi`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_kelas`
--
ALTER TABLE `master_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_kunci_jawaban`
--
ALTER TABLE `master_kunci_jawaban`
  MODIFY `id_kunci_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_matpel`
--
ALTER TABLE `master_matpel`
  MODIFY `id_matpel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `master_pg_soal`
--
ALTER TABLE `master_pg_soal`
  MODIFY `id_pg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tabel_nilai_siswa`
--
ALTER TABLE `tabel_nilai_siswa`
  MODIFY `id_siswa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tabel_soal`
--
ALTER TABLE `tabel_soal`
  MODIFY `id_soal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
