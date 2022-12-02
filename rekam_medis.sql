-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 04:29 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekam_medis`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id` int(11) NOT NULL,
  `pasien` varchar(50) NOT NULL,
  `nipe` varchar(50) NOT NULL,
  `noted` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`id`, `pasien`, `nipe`, `noted`) VALUES
(4, 'fddsf', 'fdsfdsf', 'fdsfdsf');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `name_dokter` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `spesialis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(300) NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `kadaluarsa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `stok`, `keterangan`, `kadaluarsa`) VALUES
(26, 'Paramex', 12, 'Obat Sakit Kepala', '20 Desember 2023'),
(27, 'Promag', 1, 'Obat Magh', '2 Februari 2023'),
(28, 'Paracetamol', 0, 'Obat Sakit Kepala', 'Nihil'),
(29, 'Minyak Kayu Putih', 10, 'Minyak Urut', '20 Desember 2023');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(200) NOT NULL,
  `tgl` varchar(200) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggungan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama_pasien`, `tgl`, `nip`, `jabatan`, `status`, `tanggungan`) VALUES
(100, 'Jodi Agustiawan', '2000-08-26', '19630510', 'Mahasiswa Magang', '', ''),
(101, 'Indra Darmawan', '2000-11-01', '19630550', 'Mahasiswa Magang', '', ''),
(103, 'Jo', '2000-08-26', '19635592', 'Mahasiswa Magang', '', ''),
(104, 'qwerty', '1992-01-23', '192775293', 'Mahasiswa Magang', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_pegawai` varchar(200) NOT NULL,
  `alamat` varchar(360) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `username`, `password`, `nama_pegawai`, `alamat`, `pekerjaan`) VALUES
(3, 'admin1', 'admin', 'Pimpinan', 'BJM', '1'),
(5, 'admin3', 'admin', 'Dokter', 'BJM', '3'),
(7, 'jodiadmin', 'qwerty', 'Jodi Agustiawan', 'BJM', '4');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_obat`
--

CREATE TABLE `riwayat_obat` (
  `id` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_obat`
--

INSERT INTO `riwayat_obat` (`id`, `id_penyakit`, `id_pasien`, `id_obat`, `jumlah`, `keterangan`) VALUES
(1, 0, 0, 1, 12, 'fr'),
(2, 0, 0, 1, 12, 'fr'),
(3, 0, 0, 1, 12, 'fr'),
(4, 0, 0, 1, 12, ''),
(5, 0, 0, 1, 0, ''),
(6, 0, 0, 1, 12, ''),
(7, 0, 0, 1, 0, ''),
(8, 0, 0, 1, 12, 'fr'),
(9, 0, 0, 2, 765, 'gjh');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_penyakit`
--

CREATE TABLE `riwayat_penyakit` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `name_pasien` varchar(50) NOT NULL,
  `identitas` varchar(50) NOT NULL,
  `keluhan` varchar(100) NOT NULL,
  `dokter` varchar(50) NOT NULL,
  `resep` varchar(500) NOT NULL,
  `rujukan` varchar(50) NOT NULL,
  `tgl` varchar(200) NOT NULL,
  `alergi_obat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_penyakit`
--

INSERT INTO `riwayat_penyakit` (`id`, `id_pasien`, `name_pasien`, `identitas`, `keluhan`, `dokter`, `resep`, `rujukan`, `tgl`, `alergi_obat`) VALUES
(173, 100, 'Jodi Agustiawan', 'Mahasiswa Magang', 'Sakit kepala', 'Dokter', 'Paramex 3x sehari', 'Tidak ada', '2022-11-11', 'Tidak ada'),
(174, 101, 'Indra Darmawan', 'Mahasiswa Magang', 'Sakit Perut', 'Dokter Umum', 'Minum Obat Diare di pagi hari', 'Tidak ada', '2022-11-11', 'Tidak Ada'),
(175, 100, 'Jodi Agustiawan', 'Mahasiswa Magang', 'Sakit Kepala', 'Dokter', 'paracetamol', 'Tidak ada', '2022-11-11', 'tidak ada'),
(176, 100, 'Jodi Agustiawan', 'Mahasiswa Magang', 'Sakit Kaki', 'Dokter Umum', 'Di pijet pijet saja', 'tidak ada', '2022-11-21', 'tidak ada'),
(177, 101, 'Indra Darmawan', 'Mahasiswa Magang', 'Sakit Kepala', 'Dokter Umum', 'Paramex 3x Sehari', 'Tidak ada', '2022-11-21', 'Tidak ada'),
(178, 101, 'Indra Darmawan', 'Mahasiswa Magang', 'Sakit Kaki', 'Dokter Umum', 'Di Pijat saja', 'Tidak ada', '2022-11-21', 'Tidak ada'),
(179, 101, 'Indra Darmawan', 'Mahasiswa Magang', 'Sakit Pergelangan Tangan karena rem mendadak saat ', 'Dokter Umum', 'Di Urut untuk pertolongan pertama menggunakan Minyak Kayu Putih', 'tidak ada', '2022-11-21', 'tidak ada'),
(180, 103, 'Jo', 'Mahasiswa Magang', 'Sakit Kepala', 'Dokter Umum', 'Paramex 3x sehari setelah makan', 'Tidak ada ', '2022-11-21', 'Tidak ada'),
(181, 103, 'Jo', 'Mahasiswa Magang', 'Sakit Perut', 'Dokter Umum', 'Minum Promag sebelum makan', 'tidak ada', '2022-11-21', 'tidak ada'),
(182, 100, 'aa', 'aa', 'aaa', 'aaa', 'aaa', 'aaa', '2022-11-21', 'aaaa'),
(183, 101, 'Indra Darmawan', 'Mahasiswa Magang', 'Sakit Telapak Kaki', 'Dokter Umum', 'Perbanyak Istirahat dan Olahraga Perenggangan', 'tidak ada', '2022-11-21', 'tidak ada'),
(184, 104, 'qwerty', 'Mahasiswa Magang', 'sakit perut', 'dokter umum', 'promag sebelum makan ', 'tidak ada', '2022-11-23', 'tidak ada');

-- --------------------------------------------------------

--
-- Table structure for table `suplai`
--

CREATE TABLE `suplai` (
  `id` int(11) NOT NULL,
  `toko` varchar(50) NOT NULL,
  `kurir` varchar(50) NOT NULL,
  `telpon` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id` int(11) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` int(15) NOT NULL,
  `barang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id`, `tempat`, `address`, `phone`, `barang`) VALUES
(4, 'Kimia Farma', 'BJB', 2147483647, 'Paracetamol');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_obat`
--
ALTER TABLE `riwayat_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_pasien_2` (`id_pasien`,`name_pasien`) USING BTREE;

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `riwayat_obat`
--
ALTER TABLE `riwayat_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
