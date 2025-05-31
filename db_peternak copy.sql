-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2025 at 02:54 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peternak`
--

-- --------------------------------------------------------

--
-- Table structure for table `bedah`
--

CREATE TABLE `bedah` (
  `id` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `umur` int DEFAULT NULL,
  `gejala` varchar(20) DEFAULT NULL,
  `diagnosis` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bedah`
--

INSERT INTO `bedah` (`id`, `tanggal`, `umur`, `gejala`, `diagnosis`) VALUES
(1, '2025-02-12', 5, 'Mata Merah', 'Cekrek'),
(3, '2025-02-17', 10, 'Tidak Ada', 'Normal'),
(4, '2025-02-22', 15, 'Tidak Ada', 'Normal'),
(5, '2025-02-27', 20, 'Pengkejuan', 'Colibasilosis'),
(6, '2025-03-04', 25, 'Tidak Ada', 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `id` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `umur` int DEFAULT NULL,
  `gejala` enum('PENGKEJUAN','FASES MERAH','FASES HIJAU','HIDUNG BERLENDIR') DEFAULT NULL,
  `diagnosis` enum('COLIBASILOSIS','KOLERA','KOKSIDIPSIS','CRD') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bw`
--

CREATE TABLE `bw` (
  `id` bigint NOT NULL,
  `tanggal` date DEFAULT NULL,
  `umur` bigint DEFAULT NULL,
  `bw_act` bigint DEFAULT NULL,
  `bw_std` bigint DEFAULT NULL,
  `dif_bw` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bw`
--

INSERT INTO `bw` (`id`, `tanggal`, `umur`, `bw_act`, `bw_std`, `dif_bw`) VALUES
(3, '2025-02-10', 12, 430, 420, 10),
(4, '2025-02-11', 14, 500, 480, 20),
(5, '2025-02-09', 5, 150, 180, -30),
(6, '2025-02-08', 2, 60, 59, 1),
(7, '2025-02-07', 1, 42, 39, 3);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kematian`
--

CREATE TABLE `kematian` (
  `id` bigint NOT NULL,
  `tanggal` date DEFAULT NULL,
  `umur` int DEFAULT NULL,
  `kematian` int DEFAULT NULL,
  `std_kematian` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kematian`
--

INSERT INTO `kematian` (`id`, `tanggal`, `umur`, `kematian`, `std_kematian`, `created_at`, `updated_at`) VALUES
(3, '2025-02-07', 6, 5, 4, '2025-01-29 20:24:13', '2025-01-29 20:24:13'),
(6, '2025-02-09', 8, 3, 3, '2025-01-29 20:39:34', '2025-01-29 20:39:34'),
(7, '2025-02-11', 10, 3, 3, '2025-01-29 20:39:47', '2025-01-29 20:39:47'),
(10, '2025-02-08', 7, 3, 4, NULL, NULL),
(11, '2025-02-10', 9, 6, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2014_10_12_000000_create_users_table', 1),
(14, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(15, '2014_10_12_100000_create_password_resets_table', 1),
(16, '2019_08_19_000000_create_failed_jobs_table', 1),
(17, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(18, '2025_01_28_085843_add_level_to_users_table', 1),
(19, '2025_01_29_080408_add_level_to_users_table', 2),
(20, '2025_01_29_142111_add_columns_to_kematian_table', 3),
(21, '2025_01_30_041955_add_columns_to_kematian_table', 4),
(22, '2025_01_30_042356_add_structure_to_kematian_table', 4),
(23, '2025_02_01_042815_create_pakans_table', 5),
(24, '2025_02_01_062135_add_structure_to_pakan_table', 6),
(25, '2025_02_02_020006_add_structure_to_obat_table', 7),
(26, '2025_02_03_135803_add_structure_to_bw_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` bigint NOT NULL,
  `tanggal` date DEFAULT NULL,
  `umur` bigint DEFAULT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `jenis` enum('ANTIBIOTIK','PROBIOTIK','VITAMIN') DEFAULT NULL,
  `jumlah` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `tanggal`, `umur`, `nama`, `jenis`, `jumlah`) VALUES
(2, '2025-02-07', 4, 'KURKUMAVIT', 'VITAMIN', 1),
(3, '2025-02-08', 5, 'PARVITOL', 'VITAMIN', 1),
(4, '2025-02-09', 1, 'NEOTETRA', 'ANTIBIOTIK', 1),
(5, '2025-02-10', 2, 'NEOTETRA', 'ANTIBIOTIK', 2),
(6, '2025-02-11', 3, 'KURKUMAVIT', 'VITAMIN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pakan`
--

CREATE TABLE `pakan` (
  `id` bigint NOT NULL,
  `tanggal` date DEFAULT NULL,
  `umur` bigint DEFAULT NULL,
  `nama` enum('NEWHOPE','JAPFA','POKPHAND') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` enum('STARTER','PRESTARTER','FINISHER') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pakan`
--

INSERT INTO `pakan` (`id`, `tanggal`, `umur`, `nama`, `jenis`, `jumlah`, `created_at`, `updated_at`) VALUES
(3, '2025-02-10', 4, 'POKPHAND', 'FINISHER', 6, NULL, NULL),
(7, '2025-02-09', 3, 'NEWHOPE', 'PRESTARTER', 5, NULL, NULL),
(8, '2025-02-08', 2, 'POKPHAND', 'STARTER', 3, NULL, NULL),
(9, '2025-02-07', 1, 'JAPFA', 'STARTER', 2, NULL, NULL),
(10, '2025-02-11', 5, 'JAPFA', 'STARTER', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pakans`
--

CREATE TABLE `pakans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekaptest`
--

CREATE TABLE `rekaptest` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `umur` int NOT NULL,
  `kematian` int NOT NULL,
  `pakan` int NOT NULL,
  `obat` int NOT NULL,
  `bobot` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekaptest`
--

INSERT INTO `rekaptest` (`id`, `tanggal`, `umur`, `kematian`, `pakan`, `obat`, `bobot`) VALUES
(1, '2025-02-13', 1, 10, 8, 1, 42),
(2, '2025-02-12', 2, 3, 3, 1, 50),
(3, '2025-02-14', 3, 4, 4, 1, 80),
(4, '2025-02-15', 4, 1, 4, 3, 120),
(5, '2025-02-16', 5, 2, 4, 1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` enum('ADMIN','PETERNAK') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `level`) VALUES
(8, 'koko', 'koko@gmail.com', NULL, '$2y$12$TWYo7Lz.Ojry0t8G.Ulpse4jthfmPnNc3CyCc4NLz8JnUGT3AR/S6', NULL, '2025-01-31 20:20:01', '2025-02-11 03:34:12', 'ADMIN'),
(9, 'qori', 'qori@gmail.com', NULL, '$2y$12$aVHvAF.1cfz7a5tH.pcIDOvoOyXb2lRetM/PwdcqHEtbqAiHEb/U.', NULL, '2025-02-06 14:38:12', '2025-02-06 14:38:12', 'ADMIN'),
(10, 'riko danu agung', 'riko@gmail.com', NULL, '$2y$12$K302xxU1uVhnunG2ovB0jupXbWb2FDI3Ur55Dx1KPtVOff7j3u9nC', NULL, '2025-02-11 03:33:49', '2025-02-11 03:33:49', 'ADMIN'),
(11, 'galih', 'galih@gmail.com', NULL, '$2y$12$pfzpU/uEl/PoUgS292WzmOUfLELkI87MpUYN9bTeO9s4ev.BqY41u', NULL, '2025-02-11 03:34:05', '2025-02-11 03:34:05', 'ADMIN'),
(12, 'danu', 'danu@gmail.com', NULL, '$2y$12$iu01zdSf6eMVxc7WIBpqPOyEP1ldJWFY0KWIKquMcj7XZXyI.SuhS', NULL, '2025-02-19 16:31:36', '2025-02-19 16:31:36', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bedah`
--
ALTER TABLE `bedah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bw`
--
ALTER TABLE `bw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kematian`
--
ALTER TABLE `kematian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pakan`
--
ALTER TABLE `pakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pakans`
--
ALTER TABLE `pakans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rekaptest`
--
ALTER TABLE `rekaptest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bedah`
--
ALTER TABLE `bedah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bw`
--
ALTER TABLE `bw`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kematian`
--
ALTER TABLE `kematian`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pakan`
--
ALTER TABLE `pakan`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pakans`
--
ALTER TABLE `pakans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekaptest`
--
ALTER TABLE `rekaptest`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
