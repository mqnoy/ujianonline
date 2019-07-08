-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 07, 2019 at 10:40 AM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.1.30-1+ubuntu18.04.1+deb.sury.org+1

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
(4, 5, 'A', 0);

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
(5, 'Ipa', 1),
(6, 'Matematika', 2);

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
(17, 'A', 'Mata pelajaran', 5),
(18, 'B', 'Mata ikan', 5),
(19, 'C', 'Mata kaki', 5),
(20, 'D', 'Mata sapi', 5);

-- --------------------------------------------------------

--
-- Table structure for table `master_siswa`
--

CREATE TABLE `master_siswa` (
  `id_siswa` int(10) NOT NULL,
  `siswa_nis` varchar(20) NOT NULL,
  `siswa_nama` text NOT NULL,
  `siswa_kelas_id` int(11) NOT NULL DEFAULT '0',
  `email_siswa` varchar(50) DEFAULT NULL,
  `token_siswa` varchar(200) NOT NULL,
  `tgl_terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_siswa`
--

INSERT INTO `master_siswa` (`id_siswa`, `siswa_nis`, `siswa_nama`, `siswa_kelas_id`, `email_siswa`, `token_siswa`, `tgl_terdaftar`) VALUES
(1, '123', 'asd', 0, NULL, '123G1A23DH4BECF', '2019-06-30 18:25:30'),
(2, '201937', 'Aditya', 2, NULL, '201937G123CDF4BAEH', '2019-07-01 18:25:16'),
(3, '2056', 'Rifky', 1, 'gueadit01@gmail.com', '2056H1FEGAB4C3D2', '2019-07-01 18:25:16'),
(4, 'admin', 'admin', 0, NULL, 'adminDE23H4C1FABG', '2019-07-03 11:03:41'),
(5, '201643502057', 'Rifky azmi', 0, NULL, '201643502057G1FHD24CE3BA', '2019-07-03 11:04:08'),
(6, '201643500000', 'kelompok tiga', 0, NULL, '201643500000G24EB1DFHC3A', '2019-07-03 11:51:00'),
(7, '1', '1', 0, NULL, '1FC2H1BDG43AE', '2019-07-03 14:26:52'),
(8, '2057', 'asd', 1, NULL, '2057CEDG1A23H4FB', '2019-07-05 00:09:47'),
(9, '28101197', 'Topan ganteng', 1, 'muhamad.tofan.28@gmail.com', '28101197GBE3H24CD1FA', '2019-07-05 17:23:45'),
(10, '28101997', 'Topan ganteng', 0, NULL, '28101997G41DAH2EBC3F', '2019-07-05 17:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_nilai_siswa`
--

CREATE TABLE `tabel_nilai_siswa` (
  `id_nilai` int(10) NOT NULL,
  `siswa_id` int(10) NOT NULL,
  `total_nilai` int(9) NOT NULL,
  `matpel_id` int(10) NOT NULL,
  `tanggal_pengerjaan` datetime NOT NULL,
  `sent_email` enum('N','Y') NOT NULL DEFAULT 'N',
  `sent_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_nilai_siswa`
--

INSERT INTO `tabel_nilai_siswa` (`id_nilai`, `siswa_id`, `total_nilai`, `matpel_id`, `tanggal_pengerjaan`, `sent_email`, `sent_date`) VALUES
(1, 3, 0, 1, '2019-07-01 18:26:14', 'Y', '2019-07-01 18:26:54'),
(2, 8, 67, 1, '2019-07-05 00:11:00', 'N', NULL),
(3, 9, 0, 5, '2019-07-05 17:24:17', 'Y', '2019-07-05 17:27:44'),
(4, 9, 0, 5, '2019-07-05 17:27:33', 'Y', '2019-07-05 17:27:44');

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
(5, 1, '<p>ipa adalah?</p>\n', 5),
(6, 5, '<p>kenapa sapi bernafas ?</p>\n', 5),
(7, 6, '<p><strong>kenapa sapi bernafas ?</strong></p>\n', 5),
(8, 6, '<p><strong>kenapa sapi bernafas ? 1+1=?</strong></p>\n', 5),
(10, 1, '<p>13+2</p>\n', 6);

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
-- Indexes for table `master_siswa`
--
ALTER TABLE `master_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `siswa_nis` (`siswa_nis`);

--
-- Indexes for table `tabel_nilai_siswa`
--
ALTER TABLE `tabel_nilai_siswa`
  ADD PRIMARY KEY (`id_nilai`);

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
  MODIFY `id_kunci_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `master_matpel`
--
ALTER TABLE `master_matpel`
  MODIFY `id_matpel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `master_pg_soal`
--
ALTER TABLE `master_pg_soal`
  MODIFY `id_pg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `master_siswa`
--
ALTER TABLE `master_siswa`
  MODIFY `id_siswa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tabel_nilai_siswa`
--
ALTER TABLE `tabel_nilai_siswa`
  MODIFY `id_nilai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tabel_soal`
--
ALTER TABLE `tabel_soal`
  MODIFY `id_soal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
