-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2020 at 07:49 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simonyet`
--

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_aset` int(11) NOT NULL,
  `id_tarif` int(11) NOT NULL,
  `token` varchar(10) NOT NULL,
  `durasi` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `tgl_selesai` date NOT NULL,
  `jam_selesai` time NOT NULL,
  `harga_sewa` float NOT NULL,
  `total_harga_sewa` float NOT NULL,
  `status_bayar` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `keterangan` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`id`, `id_pengguna`, `id_aset`, `id_tarif`, `token`, `durasi`, `tgl_mulai`, `jam_mulai`, `tgl_selesai`, `jam_selesai`, `harga_sewa`, `total_harga_sewa`, `status_bayar`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(15, 2, 1, 1, 'waRvT', 2, '2020-06-20', '12:19:00', '2020-06-20', '14:19:00', 2000000, 4000000, 0, 0, 'sad', '2020-06-20 05:19:32', '2020-06-20 05:19:32'),
(16, 2, 2, 1, 'waRvT', 1, '2020-06-20', '12:20:00', '2020-06-20', '13:20:00', 10000000, 10000000, 0, 0, 'asd', '2020-06-20 05:20:31', '2020-06-20 05:20:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id`,`id_pengguna`,`id_aset`,`id_tarif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
