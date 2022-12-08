-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 05:12 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id_penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id_penulis`, `nama_penulis`) VALUES
('a638dc11298ed98.96501074', 'Antony Permana'),
('a638dc12b2c82a9.17802590', 'Andrian Pran, S.T'),
('a638dc1377e5d69.48916143', 'Antonio Indiva'),
('a638dc141cb7a84.74775613', 'Sinyoman SH');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_penerbit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `tempat_terbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `halaman` int(11) NOT NULL,
  `ddc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `id_penerbit`, `judul`, `tahun_terbit`, `tempat_terbit`, `halaman`, `ddc`, `isbn`, `no_rak`, `stok`, `keterangan`) VALUES
('11111', 'b638dbb179c2025.49799588', 'Panduan Pemrograman Java SE', 2010, 'Malang', 210, '005.9989786', '979554324455', '005.7654 (Lantai 2)', 10, ''),
('11112', 'b638dbb179c2025.49799588', 'Panduan Membuat Animasi dengan Adobe Flash CS9', 2010, 'Malang', 340, '005.4534555', '979656565654', '005.67677 (Lantai 2)', 10, ''),
('11113', 'b638dbb179c2025.49799588', 'Simulasi Teori Graph dengan Embarcadero RAD Studio XE 2012', 2010, 'Malang', 340, '005.89897666', '97987876676', '005.6756565 (Lantai 2)', 10, ''),
('11114', 'b638dbdd10d8016.70435012', 'Manajemen Hukum Perdata', 2010, 'Jakarta', 450, '115.45353', '979765556556', '115.6556 (Lantai 3)', 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `book_authors`
--

CREATE TABLE `book_authors` (
  `id_penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_authors`
--

INSERT INTO `book_authors` (`id_penulis`, `id_buku`) VALUES
('a638dc11298ed98.96501074', '11111'),
('a638dc12b2c82a9.17802590', '11112'),
('a638dc1377e5d69.48916143', '11113'),
('a638dc141cb7a84.74775613', '11114');

-- --------------------------------------------------------

--
-- Table structure for table `book_loans`
--

CREATE TABLE `book_loans` (
  `id_peminjaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_peminjaman` timestamp NULL DEFAULT NULL,
  `tenggat_pengembalian` timestamp NULL DEFAULT NULL,
  `tanggal_pengembalian` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_loans`
--

INSERT INTO `book_loans` (`id_peminjaman`, `id_buku`, `id_user`, `tanggal_peminjaman`, `tenggat_pengembalian`, `tanggal_pengembalian`) VALUES
('l638f33259a0d58.04475915', '11111', '0072642983', '2022-12-06 12:19:13', '2022-12-13 12:19:13', '2022-12-06 16:53:58'),
('l638f72343778c4.59028144', '11114', '0079153287', '2022-12-06 16:50:24', '2022-12-13 16:50:24', '2022-12-06 16:53:57'),
('l638f72df2574c6.95373711', '11114', '0079153287', '2022-12-06 16:50:55', '2022-12-16 16:50:55', '2022-12-06 16:53:56'),
('l638f73ef6ca688.38978813', '11114', '0079153287', '2022-12-06 16:55:22', '2022-12-13 16:55:22', '2022-12-06 17:11:42'),
('l638f74030c08b6.68560611', '11114', '0079153287', '2022-12-06 16:56:27', '2022-12-16 16:56:27', '2022-12-06 17:11:43'),
('l638f7440e74749.21361224', '11114', '0079153287', '2022-12-06 17:01:09', '2022-12-13 17:01:09', '2022-12-06 17:11:45'),
('l6390340c52edc0.80170486', '11111', '0078296512', '2022-12-07 06:35:00', '2022-12-14 06:35:00', '2022-12-07 07:23:25'),
('l63903fa545af09.20566795', '11114', '0078296512', '2022-12-07 07:24:28', '2022-12-14 07:24:28', '2022-12-07 08:05:50'),
('l6390498340c101.11527693', '11112', '0078296512', '2022-12-07 08:06:37', '2022-12-17 08:06:37', '2022-12-07 18:50:26'),
('l6390620ba08f21.57424609', '11111', '0078296512', '2022-12-07 09:52:30', '2022-12-14 09:52:30', '2022-12-07 09:52:34'),
('l6390841996e271.78923919', '11111', '0078296512', '2022-12-07 12:16:32', '2021-12-14 12:16:32', NULL),
('l63908fc3304d14.36289618', '11111', '0075015582', '2022-12-07 13:23:33', '2022-12-14 13:23:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_11_23_180844_create_authors_table', 1),
(6, '2022_11_23_181017_create_publishers_table', 1),
(7, '2022_12_05_170519_create_books_table', 1),
(8, '2022_12_05_170540_create_book_authors_table', 1),
(9, '2022_12_05_170647_create_book_loans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id_penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id_penerbit`, `nama_penerbit`) VALUES
('b638dbb179c2025.49799588', 'Penerbit UMD'),
('b638dbdd10d8016.70435012', 'Mentari Publishing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nisn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2 COMMENT '1:admin, 2:member',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nisn`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('0072642983', 'Carlos Warren', '0072642983', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '6QgpTOjSTyV5J41mAsuaXewDzSHmnTO2THTWSNqFT7a1RdH0vFsfK8sW7238', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0075015582', 'Muhammad Axelxylander Brandon Renaldo', '0075015582', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', 'oD3gtaUG12LYm4aUoWA1DojKUL8M3VJSX2XnMST8XwwtmFWEzAF3zzCrMdhb', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0075052629', 'BERTRAND ALEXIS XIE', '0075052629', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0078296512', 'Wincent Gouwinsky', '0078296512', 2, '\n$2a$12$kww8WmrME6.PxzluGrEhtOfAkt1b.0lq8byYcMQOo1HUh8PzXWE2m ', 'DBRwUbJWiIRidFwsqQeQXIoPIkQtuLbqYUQ5He6d3zGbpyiHCq8DVBEN6M1A', '2022-12-05 10:52:12', '2022-12-07 06:17:32'),
('0079153287', 'MICHAEL MARVEL TOENROE', '0079153287', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0081092663', 'PHILBERT ANATHAPINDIKA', '0081092663', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0081117958', 'FIONA CHEN', '0081117958', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0081292792', 'Livia Jocelyn Wijaya', '0081292792', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0081483690', 'JASSEL LOUIS HARJANTO', '0081483690', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0081540469', 'Breavenlee De Benassi', '0081540469', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0081697992', 'MOURIE GOLEYU', '0081697992', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0082027550', 'ALVARO ETHAN WIJAYA', '0082027550', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0082263368', 'LOUIS OWEN', '0082263368', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0082407056', 'MAY AGENY', '0082407056', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0083129555', 'Owen Viden Sutrisno', '0083129555', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0083438368', 'STEVE EMMANUEL GUNAWAN', '0083438368', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0083628090', 'YOUMIE GOLEYU', '0083628090', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0083767868', 'Vilia Jocelyn Wijaya', '0083767868', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0084714201', 'YEMIMA ABIELLA MATULANDI', '0084714201', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0084808050', 'TANTRATIUS RAVATO', '0084808050', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', 'cHKwlFlPnvHPm8TZRuEi0VKytAsrgRBF6mNtElEDnFOFzT3c9ieVTtk36xTY', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0084982250', 'aline radita pramesthi', '0084982250', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0085207978', 'CLARK GARRY TAMBA', '0085207978', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0085306227', 'Elcardio Reef', '0085306227', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0085458714', 'Brendenlee De Benassi', '0085458714', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0085472875', 'Ananda Rizqi', '0085472875', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0085772923', 'NOVERYA TRISNATA SOLAIMAN', '0085772923', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0085859547', 'CHARLIE WAISAKA ISKANDAR', '0085859547', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0086083073', 'FELICIA WILBERT', '0086083073', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0086258878', 'DENALYN CHANG', '0086258878', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0087384425', 'Rionaldi Thomas Haryanto', '0087384425', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0087449293', 'JONATHAN CHARIS LAURENT', '0087449293', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0087613072', 'Aletta Florensia', '0087613072', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0087681989', 'LEONARDY RAPHAEL', '0087681989', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0088061438', 'FELICIA RENYTA SINULINGGA', '0088061438', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0088088726', 'Mattheuw Manuel Hanry Jose E', '0088088726', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0088178312', 'AGNES SANDRIA', '0088178312', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0089033721', 'MOZA GIER VENTINA', '0089033721', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0089100301', 'Nicholas Wijaya', '0089100301', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0089672485', 'Angelina Caroline', '0089672485', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0089722977', 'CARISSA GLORIA', '0089722977', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0089855418', 'SHANON QUEENTHANA HOTAMA', '0089855418', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0089876098', 'VINCENT VICAKKHANA WIJAYA', '0089876098', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0091378242', 'Elia Elbenson Tanoko Chung', '0091378242', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0091790714', 'Damaris Sarah Kamaratih', '0091790714', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0091929013', 'Michael Parulian Simangunsong', '0091929013', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0092142920', 'Clairene Fiorentia', '0092142920', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0092338300', 'FARAH NOREEN MING', '0092338300', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0092395242', 'David Widjaja Chairudin', '0092395242', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0092617088', 'Jovita Andini Lituhayu', '0092617088', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0092709654', 'Eduardo Adams Dinarta', '0092709654', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0092732818', 'BRYAN LOUIS HARJANTO', '0092732818', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0092771626', 'Joyce Li Cordelinne Telaumbanua', '0092771626', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0092775491', 'JAVIER EVLAND TANGO', '0092775491', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0092869890', 'MARVEL LOUIS HANSLY', '0092869890', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0093239144', 'Nicole Ansell Lim', '0093239144', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0093516825', 'VANESSA NOVESKE RAINTJUNG', '0093516825', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0093593634', 'KELLY ANGEL CALLYSTA EPENDI', '0093593634', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0093757866', 'QUENN CELINE NATHANIE KWAN', '0093757866', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0094081101', 'Stefanus Kevin Putra Sunardi', '0094081101', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0094271178', 'CASSEY CHRISTANTO', '0094271178', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0094292722', 'Aragon Yapply', '0094292722', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0094319017', 'NATHANIA DARMAWAN', '0094319017', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0094391716', 'KENDRICK HAMONANGAN', '0094391716', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0094765982', 'DAVID OSTEEN TJENDRA', '0094765982', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0094825491', 'Violyn Aldesia', '0094825491', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0095071374', 'GLENN EDWARD LIU', '0095071374', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0095289972', 'Reynard Ryugo Istanto', '0095289972', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0095316490', 'Aubreyazka Sharliz Budiarto', '0095316490', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0095593894', 'ENYA NATHALIA SOLAEMAN', '0095593894', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0095763738', 'Joseph Nathanael Raja Guk-Guk', '0095763738', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0095809322', 'NICOLE WALDINE', '0095809322', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0096030725', 'MEVERICK PRATAMA WITIANDIKA', '0096030725', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0096291480', 'Keenant Melson Wijaya', '0096291480', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0096548879', 'Lovely Grace Putri Wijaja', '0096548879', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0096790084', 'Ziva Hilman', '0096790084', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0096814318', 'KAREN CLARETTE TANIA', '0096814318', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0097020507', 'NEVAN JOSHUA PERNADI', '0097020507', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0097123208', 'CATHLYN ROSELYNNE THEOPHILA', '0097123208', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0097450161', 'YUTHA MAULANA NASUTION', '0097450161', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0098069320', 'RICHARD CHICO', '0098069320', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0098090361', 'Jessyca Nathania Christika', '0098090361', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0098286129', 'Fatih Alexander Bintang Haryanto', '0098286129', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0098348647', 'Athallah Vieero Andino Pratama', '0098348647', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0098686330', 'BRILIANT KENZA', '0098686330', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0098713879', 'Genoveva Rachelle Susantio', '0098713879', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0098761833', 'Ashia Kiran Kalila', '0098761833', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0099165348', 'Vania Auberta Erni Grace Sitohang', '0099165348', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0099168038', 'Michelle Angeline', '0099168038', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0099332511', 'BERNICE CHANG', '0099332511', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0099549464', 'Khadafi Milano', '0099549464', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0099559312', 'OLIVYA HENDINATA SENTOSA', '0099559312', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0099718507', 'BRYAN OCTAVIUS SANTOSO', '0099718507', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0099877947', 'Clarissa Kineta Handana', '0099877947', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0099909638', 'GABRIELLE AUDREY RAHARJO', '0099909638', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0101098161', 'LIONEL JUAN DANIEL PUTRA', '0101098161', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0101263072', 'JANICE JACQUELINE WIJAYA', '0101263072', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0101344674', 'AURELLIA PRIBADI ALI', '0101344674', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0101353840', 'DARREL SACHIO KHEDIRA LIM', '0101353840', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0101567357', 'Darrish Andrian', '0101567357', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0101651063', 'BRANDON MAXIMILLIAN FRANSIS', '0101651063', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0102034411', 'ARIELLA APPLE WIJAYA', '0102034411', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0102418903', 'SCOTT SAMUEL FARRELL', '0102418903', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0102431415', 'Jessica Putri Waluyo', '0102431415', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0102448918', 'YOESANDA HADINATA', '0102448918', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0102597956', 'DAWSON SEBASTIAN CHAIDIR', '0102597956', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0103080605', 'Daniel Fernando Suwardy', '0103080605', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0103271259', 'Louischel Azalia Suherman', '0103271259', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0103567952', 'Jovanie Yang', '0103567952', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0103714776', 'BRANDON CHRISTIAN SURIAATMADJA', '0103714776', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0103969325', 'SOLOMON GUNAWAN RYARDI', '0103969325', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0104200806', 'LYONELL EDMUND CLEMENCE LIM', '0104200806', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0104211862', 'Delvin Angelo', '0104211862', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0104498986', 'SETIA JOSEPH IMANUEL', '0104498986', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0104711477', 'Derren Tionardo', '0104711477', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0104793702', 'Vinnie Abichail Sorrento', '0104793702', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0104839979', 'CHRISTOPHER ELIEZER VERONY', '0104839979', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0105172872', 'CALLYSTA EVE', '0105172872', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0106681261', 'CANDICE RACHEL RIADI', '0106681261', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0107083947', 'Cantika Fransiska', '0107083947', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0107142943', 'ELFIRAISYAH TRISNATA SOLAIMAN', '0107142943', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0107288012', 'Olivia Anabell Tan', '0107288012', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0107336391', 'RACHELL JANE OLIVIA MENDROFA', '0107336391', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0107390838', 'Jevan Tayindra', '0107390838', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0107865499', 'Sahara Sabah K Hamad', '0107865499', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0108233489', 'Gwendolyn Annabelle Salim', '0108233489', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0108566330', 'GREGORIUS RICHIE HANDOKO', '0108566330', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0109201752', 'HILARIUS ANDREW', '0109201752', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0109414676', 'KENNETH JOHAN', '0109414676', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0109731030', 'Naomi Nathania Handana', '0109731030', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0109781258', 'RACHEL GRACE DHARMAWAN', '0109781258', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0111136228', 'JASON SATYA HALIM', '0111136228', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('0134224641', 'Eric Putra Setiawan', '0134224641', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('3081551583', 'Cahaya Saputra', '3081551583', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('3102138419', 'Devdan Vero Vasu', '3102138419', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('3105942925', 'Leonel Keitaro', '3105942925', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('3137710144', 'Melvern Nathan Liem', '3137710144', 2, '$2a$12$R/NLqnspquu/syBJc7Kkj.LyIsTMaqIAEtgOFsuwXXawKso4rCV8u', '-', '2022-12-05 10:52:12', '2022-12-05 10:52:12'),
('u638dc25c1b5594.44818316', 'ADMIN_TMMS', 'ADMIN_TMMS', 1, '$2y$10$dh9BQcR8msqwNZ7.Kq.ThO5ZmCqIJQiNw9LGWQ3AVe/2pcVMfF1hu', NULL, '2022-12-05 10:06:20', '2022-12-05 10:06:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_id_penerbit_foreign` (`id_penerbit`);

--
-- Indexes for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD KEY `book_authors_id_penulis_foreign` (`id_penulis`),
  ADD KEY `book_authors_id_buku_foreign` (`id_buku`);

--
-- Indexes for table `book_loans`
--
ALTER TABLE `book_loans`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `book_loans_id_buku_foreign` (`id_buku`),
  ADD KEY `book_loans_id_user_foreign` (`id_user`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nisn_unique` (`nisn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_id_penerbit_foreign` FOREIGN KEY (`id_penerbit`) REFERENCES `publishers` (`id_penerbit`) ON DELETE SET NULL;

--
-- Constraints for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD CONSTRAINT `book_authors_id_buku_foreign` FOREIGN KEY (`id_buku`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_authors_id_penulis_foreign` FOREIGN KEY (`id_penulis`) REFERENCES `authors` (`id_penulis`) ON DELETE CASCADE;

--
-- Constraints for table `book_loans`
--
ALTER TABLE `book_loans`
  ADD CONSTRAINT `book_loans_id_buku_foreign` FOREIGN KEY (`id_buku`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_loans_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
