-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 03:50 AM
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
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `nama`, `userid`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Gundam', 2, 'Gundam adalah waralaba media Jepang yang mencakup serangkaian model kit plastik, manga, anime, dan permainan video. Gundam terkenal dengan robot raksasanya yang disebut \"Mobile Suit,\" yang digunakan dalam pertempuran fiksi di berbagai seri cerita yang menggambarkan konflik futuristik di luar angkasa.', '2024-01-20 13:31:35', '2024-02-08 05:32:35'),
(2, 'Koleksi Buku', 2, 'Buku adalah medium tulisan yang terikat, biasanya terbuat dari kertas, dengan informasi atau cerita yang disusun dalam bentuk halaman.', '2024-01-20 13:31:35', '2024-02-04 09:16:19'),
(3, 'Meme', 2, 'Meme adalah bentuk pesan atau ide yang disebarkan secara luas melalui media digital, seringkali dalam bentuk gambar, teks, atau video pendek, dengan tujuan menghibur atau menyampaikan pesan tertentu.', '2024-01-20 13:31:35', '2024-02-08 17:01:09'),
(4, 'Bisnis', 2, 'Bisnis adalah kegiatan ekonomi yang bertujuan untuk memperoleh keuntungan dengan menyediakan barang atau jasa kepada pasar.', '2024-01-20 13:31:35', '2024-01-27 02:42:53'),
(6, 'rasis', 4, 'www.bintangrasis.com', '2024-02-04 19:59:17', '2024-02-04 19:59:17'),
(9, 'Ibe', 2, 'Punya Ibe Badar', '2024-02-08 17:02:06', '2024-02-08 17:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `albumid` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `judul`, `deskripsi`, `file`, `albumid`, `userid`, `created_at`, `updated_at`) VALUES
(35, 'Aerial', 'The WItch From Mercury', '1705847678_Anime Wallpaper.jfif', 1, 2, '2024-01-21 07:34:38', '2024-02-04 08:48:30'),
(36, 'Unicorn Red', 'Unicorn RE: 0096', '1705847737_b1202fb3-9806-431d-afcf-5a3b57026968.jfif', 1, 2, '2024-01-21 07:35:38', '2024-02-04 08:48:32'),
(37, 'Unicorn', 'Normal Mode', '1705847763_bf5aad68-be1b-4669-8da8-facce9834bb9.jfif', 1, 2, '2024-01-21 07:36:03', '2024-02-04 08:48:34'),
(38, 'Exia Green', '00 Gundam', '1705847792_download (1).jfif', 1, 2, '2024-01-21 07:36:32', '2024-02-04 08:48:36'),
(39, 'Barbatos', 'One Hand', '1705847811_download (2).jfif', 1, 2, '2024-01-21 07:36:51', '2024-02-04 08:48:37'),
(40, 'Red', 'Original', '1705847828_download (3).jfif', 1, 2, '2024-01-21 07:37:08', '2024-02-04 08:48:40'),
(41, 'Vintage', 'Sepia', '1705847851_download (4).jfif', 1, 2, '2024-01-21 07:37:31', '2024-02-04 08:48:42'),
(42, 'Cartoon', 'Ehehehe', '1705847865_download (5).jfif', 1, 2, '2024-01-21 07:37:45', '2024-02-04 08:48:44'),
(43, 'Prowler', 'SFX', '1705847881_download (6).jfif', 1, 2, '2024-01-21 07:38:01', '2024-02-04 08:48:46'),
(44, 'Solo Barbatos', 'Sad', '1705847896_download (7).jfif', 1, 2, '2024-01-21 07:38:16', '2024-02-04 08:48:54'),
(45, 'SEED', 'Dark SEED', '1705847908_download (8).jfif', 1, 2, '2024-01-21 07:38:29', '2024-02-04 08:48:58'),
(46, 'Epic Unicorn', 'Red Cool', '1705847926_download (9).jfif', 1, 2, '2024-01-21 07:38:46', '2024-02-04 08:49:00'),
(47, 'Dark Ori', 'Original but Dark', '1705847949_download.jfif', 1, 2, '2024-01-21 07:39:09', '2024-02-04 08:49:02'),
(48, 'Savage', 'Angry Barbatos', '1705847965_Gundam Barbatos Lupus Rex.jfif', 1, 2, '2024-01-21 07:39:25', '2024-02-04 08:49:05'),
(49, 'Unique', 'Estetik', '1705847985_Kmiiliy Nu Gundam Pop Art Gundam Poster Plaque Metal Tin Sign 8x12 Inch.jfif', 1, 2, '2024-01-21 07:39:45', '2024-02-04 08:49:07'),
(50, 'Mika', 'Tsubame Gaeshi', '1705848002_Mobile Suit Gundam_ Iron-Blooded Orphans (2015).jfif', 1, 2, '2024-01-21 07:40:02', '2024-02-04 08:49:09'),
(51, 'NU', 'Sesat', '1705848014_Nu Gundam Watercolor, Hector Trunnec.jfif', 1, 2, '2024-01-21 07:40:14', '2024-02-04 08:49:12'),
(59, 'FNAF', 'Purple Guy', '1707436893_purpleguy1.jpg', 3, 2, '2024-01-22 18:08:13', '2024-02-08 17:01:33'),
(86, 'Don Quixote', 'Limbus Company', '1705991075_don-quixote.jpg', 2, 2, '2024-01-22 23:24:35', '2024-02-04 09:13:38'),
(92, 'ebli', 'thos', '1706572636_Dashboard - Google Chrome 12_11_2023 10_26_52 AM (2).png', 4, 2, '2024-01-29 16:57:16', '2024-02-08 04:15:30'),
(94, 'red', 'e', '1706945834_diaspora (2).png', 4, 2, '2024-02-03 00:37:14', '2024-02-04 09:12:40'),
(95, 'meme', 'meme', '1706949177_Honkai_ Star Rail 11_11_2023 11_10_17 AM.png', 3, 2, '2024-02-03 01:32:57', '2024-02-04 09:12:19'),
(96, 'saber', 'saber', '1706949198_Fate_Samurai Remnant 10_20_2023 6_35_16 PM.png', 3, 2, '2026-02-03 01:33:18', '2024-02-04 09:12:21'),
(97, 'first', 'my first post here', '1706953798_Activity.png', NULL, 4, '2024-02-03 02:49:58', '2024-02-03 02:49:58'),
(98, 'eta', 'walin', '1707099579_etawalin.png', NULL, 4, '2024-02-04 19:19:39', '2024-02-04 19:19:39'),
(100, 'e', 'e', '1707101558_Capture.PNG', NULL, 2, '2024-02-04 19:52:38', '2024-02-06 03:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `fotoid`, `userid`, `isi`, `created_at`, `updated_at`) VALUES
(45, 48, 2, 'keren cuy', '2024-01-23 23:52:10', NULL),
(46, 48, 2, 'diluar nalar', '2024-01-23 23:52:10', NULL),
(54, 86, 2, 'Nyehehehehe', '2024-01-25 23:16:19', '2024-01-25 23:16:19'),
(57, 86, 3, 'spaghetti', '2024-01-28 05:39:32', '2024-01-28 05:39:32'),
(59, 86, 4, 'sans', '2024-01-28 18:21:32', '2024-01-28 18:21:32'),
(60, 51, 2, 'wkwkwkwkw', '2024-01-28 19:19:34', '2024-01-28 19:19:34'),
(62, 86, 2, 'komen', '2024-01-28 20:26:50', '2024-01-28 20:26:50'),
(63, 92, 2, 'jagat', '2024-01-29 17:06:55', '2024-01-29 17:06:55'),
(68, 92, 2, 'jaya', '2024-01-29 19:55:16', '2024-01-29 19:55:16'),
(69, 45, 2, 'wkwk', '2024-01-29 20:32:59', '2024-01-29 20:32:59'),
(70, 92, 4, 'jobfinder', '2024-02-01 23:24:16', '2024-02-01 23:24:16'),
(71, 48, 2, 'kakoi', '2024-02-03 02:38:01', '2024-02-03 02:38:01'),
(72, 97, 4, 'hello', '2024-02-03 02:50:12', '2024-02-03 02:50:12'),
(73, 97, 2, 'bonjour', '2024-02-04 02:14:04', '2024-02-04 02:14:04'),
(74, 97, 4, 'hallelujah', '2024-02-04 19:19:19', '2024-02-04 19:19:19'),
(75, 100, 2, 'e', '2024-02-05 20:26:07', '2024-02-05 20:26:07'),
(79, 59, 2, 'ehe', '2024-02-08 16:59:18', '2024-02-08 16:59:18'),
(80, 59, 2, 'mim', '2024-02-08 17:00:31', '2024-02-08 17:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `id` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id`, `fotoid`, `userid`, `created_at`, `updated_at`) VALUES
(7, 86, 3, '2024-01-28 06:17:12', '2024-01-28 06:17:12'),
(27, 86, 4, '2024-01-28 18:21:34', '2024-01-28 18:21:34'),
(57, 45, 2, '2024-01-30 20:22:01', '2024-01-30 20:22:01'),
(62, 86, 2, '2024-02-03 01:55:35', '2024-02-03 01:55:35'),
(64, 48, 2, '2024-02-03 02:47:05', '2024-02-03 02:47:05'),
(65, 97, 4, '2024-02-03 02:50:09', '2024-02-03 02:50:09'),
(66, 97, 2, '2024-02-04 00:26:42', '2024-02-04 00:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `role` enum('admin','pengguna') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fullname`, `alamat`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$r885pcfvLhUJwXbBx.AJLOoTpv1QOB/RVNBIeJa.HQwz.J7DRiPPu', 'admin@gmail.com', 'Oberon', '4110 Old Redmond, USA', 'admin', '2024-01-18 11:43:40', '2024-01-18 11:44:07'),
(2, 'daffa', '$2y$12$Ee4EXiDw5qAuFIKhEUeKaOml0Xab2OpLe.RjX.pN.hJWImlk/MaUG', 'daffa@gmail.com', 'Muhammad Daffa', '14 Garrett Hill London, UK', 'pengguna', '2024-01-20 03:59:46', '2024-01-20 03:59:46'),
(3, 'roman', '$2y$12$Cw/vedSY49AK5Nqoom.B8.1GVq.pHIpA0XfwVyoW/ebPjq4BsQSmO', 'romani@gmail.com', 'Romani Archaman', '14 Garrett Hill London, UK', 'pengguna', '2024-01-28 05:38:46', '2024-01-28 05:38:46'),
(4, 'bintang', '$2y$12$PNAw4v2B4rC/IhZMRykgDO01fkwX7JPJ1TmZm67rc6qL5n7tKIGVG', 'bintang@gmail.com', 'BintangTR', 'Kesambi', 'pengguna', '2024-01-28 16:58:41', '2024-01-28 16:58:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
