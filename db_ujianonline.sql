-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2019 at 10:23 AM
-- Server version: 10.1.40-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

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
(1, 1, 'A', 10),
(2, 2, 'B', 10),
(3, 3, 'A', 45),
(4, 4, 'A', 50),
(5, 5, 'A', 10),
(6, 6, 'B', 100);

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
(18, 'English', 2),
(19, 'Web design', 3),
(20, 'Karya ilmiah', 1);

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
(8, 'D', '', 2),
(9, 'A', '2', 3),
(10, 'B', '3', 3),
(11, 'C', '5', 3),
(12, 'D', '6', 3),
(13, 'A', '100biji', 4),
(14, 'B', '10000', 4),
(15, 'C', '6', 4),
(16, 'D', '55', 4),
(17, 'A', 'HyperTextMarkupLanguage', 5),
(18, 'B', 'Hyper buz', 5),
(19, 'C', 'Hypermart', 5),
(20, 'D', 'Hyper man', 5),
(21, 'A', 'Tugas', 6),
(22, 'B', 'Persyaratan S1', 6),
(23, 'C', 'Makalah', 6),
(24, 'D', 'Apa aja', 6);

-- --------------------------------------------------------

--
-- Table structure for table `master_siswa`
--

CREATE TABLE `master_siswa` (
  `id_siswa` int(10) NOT NULL,
  `siswa_nis` varchar(20) NOT NULL,
  `siswa_nama` text NOT NULL,
  `siswa_kelas_id` int(11) NOT NULL DEFAULT '0',
  `token_siswa` varchar(200) NOT NULL,
  `tgl_terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_siswa`
--

INSERT INTO `master_siswa` (`id_siswa`, `siswa_nis`, `siswa_nama`, `siswa_kelas_id`, `token_siswa`, `tgl_terdaftar`) VALUES
(1, '2057', 'rifky', 2, 'MjA1N0RGRTIxQTRDM0hHQg==', '2019-06-04 02:59:52'),
(2, '2016', 'rifky', 3, 'MjAxNkcxSEZBMkRDNDNFQg==', '2019-06-04 03:52:18'),
(3, '2056', 'Rifky', 3, 'MjA1NkE0MzJERkdIQkNFMQ==', '2019-06-04 05:25:07'),
(4, 'Tofan', '888888', 3, 'VG9mYW5FRjFINDNCQUdEQzI=', '2019-06-04 10:11:50'),
(5, 'Tofan test', '888888', 0, 'VG9mYW4gdGVzdDREQkFFMUcyQ0ZIMw==', '2019-06-04 10:14:04'),
(6, 'Rohma', '111111', 3, 'Um9obWFGMUVDMkgzNERHQUI=', '2019-06-04 10:14:25'),
(7, '\'', 'Ff', 3, 'XCcyNEFCQ0VGM0hERzE=', '2019-06-05 13:06:49'),
(8, '427777555', 'Rifky', 3, 'NDI3Nzc3NTU1RkRFSDRBQzFHQjIz', '2019-06-05 13:15:03'),
(9, '123', 'asd', 3, 'MTIzR0FEMkhGRUMzQjE0', '2019-06-09 17:47:57'),
(10, '2082', 'Erick', 1, 'MjA4MkhGRTFDMjM0QUJHRA==', '2019-06-19 20:43:24'),
(11, '20567', 'Adit', 3, 'MjA1Njc0RDFBQzNFSEYyR0I=', '2019-06-25 18:57:24'),
(12, '2567', 'Gshsisjsj', 0, 'MjU2NzM0MTJGQ0VCQURHSA==', '2019-06-25 18:57:44'),
(13, '201643502016', 'Lala dong', 1, 'MjAxNjQzNTAyMDE2SDJFRjNHRDQxQ0FC', '2019-06-25 20:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_nilai_siswa`
--

CREATE TABLE `tabel_nilai_siswa` (
  `id_nilai` int(10) NOT NULL,
  `siswa_id` int(10) NOT NULL,
  `total_nilai` int(9) NOT NULL,
  `matpel_id` int(10) NOT NULL,
  `tanggal_pengerjaan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_nilai_siswa`
--

INSERT INTO `tabel_nilai_siswa` (`id_nilai`, `siswa_id`, `total_nilai`, `matpel_id`, `tanggal_pengerjaan`) VALUES
(1, 1, 10, 15, '2019-06-04 03:00:45'),
(2, 1, 10, 15, '2019-06-04 03:00:45'),
(3, 2, 20, 15, '2019-06-04 03:52:48'),
(4, 1, 20, 15, '2019-06-04 04:31:56'),
(5, 1, 20, 15, '2019-06-04 04:33:42'),
(6, 3, 20, 15, '2019-06-04 05:25:50'),
(7, 1, 0, 15, '2019-06-04 05:36:24'),
(8, 4, 10, 15, '2019-06-04 10:12:18'),
(9, 6, 10, 15, '2019-06-04 10:14:58'),
(10, 1, 20, 15, '2019-06-04 18:46:36'),
(11, 1, 10, 15, '2019-06-04 20:17:32'),
(12, 3, 20, 15, '2019-06-05 13:01:54'),
(13, 3, 10, 15, '2019-06-05 13:03:03'),
(14, 3, 10, 15, '2019-06-05 13:03:03'),
(15, 3, 10, 15, '2019-06-05 13:03:03'),
(16, 3, 10, 15, '2019-06-05 13:03:03'),
(17, 3, 10, 15, '2019-06-05 13:03:03'),
(18, 3, 10, 15, '2019-06-05 13:03:04'),
(19, 3, 10, 15, '2019-06-05 13:03:04'),
(20, 3, 10, 15, '2019-06-05 13:03:04'),
(21, 3, 10, 15, '2019-06-05 13:03:04'),
(22, 3, 10, 15, '2019-06-05 13:03:04'),
(23, 3, 10, 15, '2019-06-05 13:03:04'),
(24, 3, 10, 15, '2019-06-05 13:03:04'),
(25, 3, 10, 15, '2019-06-05 13:03:04'),
(26, 3, 10, 15, '2019-06-05 13:03:04'),
(27, 3, 10, 15, '2019-06-05 13:03:04'),
(28, 7, 10, 15, '2019-06-05 13:07:28'),
(29, 8, 10, 15, '2019-06-05 13:17:47'),
(30, 8, 0, 15, '2019-06-05 13:20:16'),
(31, 8, 0, 15, '2019-06-05 13:20:16'),
(32, 8, 0, 15, '2019-06-05 13:20:16'),
(33, 8, 0, 15, '2019-06-05 13:20:16'),
(34, 1, 0, 15, '2019-06-06 18:06:56'),
(35, 1, 10, 15, '2019-06-06 18:07:10'),
(36, 1, 10, 15, '2019-06-06 18:07:11'),
(37, 1, 0, 15, '2019-06-06 18:12:22'),
(38, 1, 0, 15, '2019-06-06 18:12:22'),
(39, 9, 20, 15, '2019-06-12 01:40:05'),
(40, 10, 0, 1, '2019-06-19 20:44:05'),
(41, 10, 50, 1, '2019-06-19 20:47:56'),
(42, 11, 0, 19, '2019-06-25 18:59:05'),
(43, 11, 10, 19, '2019-06-25 18:59:56'),
(44, 13, 100, 20, '2019-06-25 20:31:57'),
(45, 9, 100, 20, '2019-06-25 23:41:33');

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
(2, 2, '<p>belum ada pg test</p>\n', 15),
(3, 1, '<p>1+1 = ?</p>\n', 17),
(4, 5, '<p>Hitunglah rambut erik</p>\n', 1),
(5, 1, '<p>HTML adalah ?</p>\n', 19),
(6, 1, '<p>Skripsi adalah?</p>\n', 20);

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
  MODIFY `id_kunci_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `master_matpel`
--
ALTER TABLE `master_matpel`
  MODIFY `id_matpel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `master_pg_soal`
--
ALTER TABLE `master_pg_soal`
  MODIFY `id_pg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `master_siswa`
--
ALTER TABLE `master_siswa`
  MODIFY `id_siswa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tabel_nilai_siswa`
--
ALTER TABLE `tabel_nilai_siswa`
  MODIFY `id_nilai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `tabel_soal`
--
ALTER TABLE `tabel_soal`
  MODIFY `id_soal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
