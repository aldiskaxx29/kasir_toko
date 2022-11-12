-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 12, 2022 at 06:57 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluars`
--

CREATE TABLE `barang_keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_keluars`
--

INSERT INTO `barang_keluars` (`id`, `tanggal`, `barang_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(2, '2022-10-06', 1, 2, '2022-10-05 16:37:31', '2022-10-05 16:37:31'),
(3, '2022-10-28', 2, 5, '2022-10-29 08:52:36', '2022-10-29 08:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuks`
--

CREATE TABLE `barang_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_masuks`
--

INSERT INTO `barang_masuks` (`id`, `tanggal`, `barang_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, '2022-10-05', 1, 8, '2022-10-05 09:16:22', '2022-10-05 09:16:22'),
(2, '2022-10-28', 1, 4, '2022-10-29 08:45:28', '2022-10-29 08:45:28'),
(3, '2022-10-22', 1, 4, '2022-10-29 08:52:07', '2022-10-29 08:52:07'),
(4, '2022-10-27', 2, 1, '2022-10-29 08:52:22', '2022-10-29 08:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `data_barangs`
--

CREATE TABLE `data_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `harga_pcs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_dus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_slop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_barangs`
--

INSERT INTO `data_barangs` (`id`, `nama_barang`, `stok`, `created_at`, `updated_at`, `harga`, `harga_pcs`, `harga_dus`, `harga_slop`) VALUES
(1, 'Ciki Komo', 25, '2022-09-29 09:38:22', '2022-11-10 15:28:51', 100000, '25000', '20000', '10000'),
(2, 'Hp', 28, '2022-10-28 08:58:36', '2022-11-10 15:29:05', 200000, '23000', '10000', '20000'),
(3, 'Sampo', 12, '2022-10-29 17:20:16', '2022-11-10 15:29:22', 10000, '1500', '13000', '10000'),
(4, 'Sabun', 14, '2022-10-29 17:21:14', '2022-11-10 15:29:34', 10000, '25000', '10000', '17000'),
(5, 'Sosis', 28, '2022-10-29 17:21:31', '2022-11-10 15:28:36', 10000, '1000', '2000', '30000'),
(6, 'Sunsilk', 10000, '2022-11-10 15:19:35', '2022-11-10 15:27:42', 1, '200000', '1000', '10000'),
(7, 'Aqua', 23, '2022-11-12 00:37:11', '2022-11-12 00:37:11', 1, '10000', '110000', '1100000');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` bigint(20) UNSIGNED NOT NULL,
  `barangs_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `satuan_id` bigint(20) UNSIGNED NOT NULL,
  `sub_total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `transaksi_id`, `barangs_id`, `quantity`, `satuan_id`, `sub_total`, `created_at`, `updated_at`) VALUES
(12, 7, 1, 1, 2, '100000', '2022-10-31 16:05:38', '2022-10-31 16:05:38'),
(13, 7, 2, 2, 1, '400000', '2022-10-31 16:05:38', '2022-10-31 16:05:38'),
(14, 7, 3, 5, 2, '50000', '2022-10-31 16:05:38', '2022-10-31 16:05:38'),
(15, 7, 5, 3, 3, '30000', '2022-10-31 16:05:38', '2022-10-31 16:05:38'),
(16, 7, 4, 2, 1, '20000', '2022-10-31 16:05:38', '2022-10-31 16:05:38'),
(17, 8, 1, 5, 1, '500000', '2022-10-31 16:14:24', '2022-10-31 16:14:24'),
(18, 8, 2, 3, 1, '600000', '2022-10-31 16:14:24', '2022-10-31 16:14:24'),
(19, 9, 5, 5, 2, '50000', '2022-10-31 16:15:50', '2022-10-31 16:15:50'),
(20, 10, 1, 3, 1, '300000', '2022-10-31 16:16:43', '2022-10-31 16:16:43'),
(21, 10, 5, 3, 1, '30000', '2022-10-31 16:16:43', '2022-10-31 16:16:43'),
(22, 11, 2, 2, 1, '400000', '2022-11-02 23:09:22', '2022-11-02 23:09:22'),
(23, 11, 1, 1, 1, '100000', '2022-11-02 23:09:22', '2022-11-02 23:09:22'),
(24, 12, 2, 1, 1, '200000', '2022-11-02 23:28:49', '2022-11-02 23:28:49'),
(25, 12, 1, 3, 1, '300000', '2022-11-02 23:28:49', '2022-11-02 23:28:49'),
(26, 13, 1, 2, 1, '200000', '2022-11-03 00:24:14', '2022-11-03 00:24:14'),
(27, 13, 2, 1, 2, '200000', '2022-11-03 00:24:14', '2022-11-03 00:24:14'),
(28, 13, 4, 3, 1, '30000', '2022-11-03 00:24:14', '2022-11-03 00:24:14'),
(29, 14, 3, 3, 1, '30000', '2022-11-04 15:37:57', '2022-11-04 15:37:57'),
(30, 14, 5, 2, 2, '20000', '2022-11-04 15:37:57', '2022-11-04 15:37:57');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `harga_per_satuans`
--

CREATE TABLE `harga_per_satuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `satuan_id` bigint(20) UNSIGNED NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `harga_per_satuans`
--

INSERT INTO `harga_per_satuans` (`id`, `barang_id`, `satuan_id`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100000, NULL, NULL),
(2, 1, 2, 200000, NULL, NULL),
(3, 1, 3, 15000, NULL, NULL),
(4, 2, 1, 50000, NULL, NULL),
(5, 2, 2, 20000, NULL, NULL),
(6, 3, 1, 10000, NULL, NULL),
(7, 3, 2, 25000, NULL, NULL),
(8, 4, 1, 10000, NULL, NULL),
(9, 4, 2, 50000, NULL, NULL),
(10, 5, 1, 5000, NULL, NULL),
(11, 5, 2, 20000, NULL, NULL),
(12, 6, 1, 20000, NULL, NULL),
(13, 6, 2, 25000, NULL, NULL),
(14, 7, 2, 25000, NULL, NULL);

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
(5, '2022_08_12_033206_create_satuan_barangs_table', 1),
(6, '2022_08_12_033239_create_data_barangs_table', 1),
(7, '2022_08_12_033635_create_barang_masuks_table', 1),
(8, '2022_08_12_034129_create_barang_keluars_table', 1),
(10, '2022_09_29_231714_add_harga_to_data_barangs', 2),
(13, '2022_10_27_233316_add_qty_to_pembelians', 4),
(21, '2022_10_29_052308_create_remove_satuan_id_table', 6),
(22, '2022_09_29_231239_create_pembelians_table', 7),
(27, '2022_10_30_221828_create_transaksi_table', 8),
(28, '2022_10_30_222216_create_detail_transaksi_table', 8),
(29, '2022_11_10_215218_add_harga_satuan_to_data_barangs', 9),
(30, '2022_11_12_061431_create_harga_per_satuans_table', 10);

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
-- Table structure for table `pembelians`
--

CREATE TABLE `pembelians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kasir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangs_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `satuan_id` bigint(20) UNSIGNED NOT NULL,
  `harga_satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelians`
--

INSERT INTO `pembelians` (`id`, `no_order`, `nama_kasir`, `barangs_id`, `quantity`, `satuan_id`, `harga_satuan`, `total_harga`, `pembayaran`, `kembalian`, `created_at`, `updated_at`) VALUES
(2, '00-20221029591', 'aldi', 1, 2, 3, '100000', '200000', 250000, 50000, '2022-10-29 06:55:31', '2022-10-29 08:42:19'),
(4, '00-20221029868', 'aldi', 1, 2, 1, '100000', '200000', 500000, 300000, '2022-10-29 08:18:49', '2022-10-29 08:18:49'),
(5, '00-20221029428', 'aldi', 1, 4, 3, '100000', '400000', 500000, 100000, '2022-10-29 08:20:38', '2022-10-29 08:20:38'),
(6, '00-20221029902', 'aldi', 1, 3, 2, '100000', '300000', 500000, 200000, '2022-10-29 08:25:01', '2022-10-29 08:25:01'),
(7, '00-20221030535', 'aldi', 4, 3, 1, '10000', '30000', 100000, 70000, '2022-10-29 17:22:58', '2022-10-29 17:22:58'),
(8, '00-20221030390', 'aldi', 3, 5, 1, '10000', '50000', 100000, 50000, '2022-10-29 17:23:21', '2022-10-29 17:23:21');

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
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satuan_barangs`
--

CREATE TABLE `satuan_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuan_barangs`
--

INSERT INTO `satuan_barangs` (`id`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 'Pcs', '2022-09-29 09:32:55', '2022-09-29 09:32:55'),
(2, 'Kardus', '2022-10-27 16:38:25', '2022-10-27 16:38:25'),
(3, 'Slop', '2022-10-27 16:38:37', '2022-10-27 16:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kasir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `no_order`, `nama_kasir`, `total_produk`, `total_harga`, `pembayaran`, `kembalian`, `created_at`, `updated_at`) VALUES
(7, '00-20221031699', 'aldi', '13', '600000', 1000000, 400000, '2022-10-31 16:05:38', '2022-10-31 16:05:38'),
(8, '00-20221031204', 'aldi', '8', '1100000', 2000000, 900000, '2022-10-31 16:14:24', '2022-10-31 16:14:24'),
(9, '00-20221031898', 'aldi', '5', '50000', 100000, 50000, '2022-10-31 16:15:50', '2022-10-31 16:15:50'),
(10, '00-20221031432', 'aldi', '6', '330000', 1000000, 670000, '2022-09-01 16:16:43', '2022-10-31 16:16:43'),
(11, '00-20221103157', 'aldi', '3', '500000', 700000, 200000, '2022-11-02 23:09:22', '2022-11-02 23:09:22'),
(12, '00-20221103937', 'aldi', '4', '500000', 500000, 0, '2022-11-02 23:28:49', '2022-11-02 23:28:49'),
(13, '00-20221103816', 'aldi', '6', '430000', 1000000, 570000, '2022-11-03 00:24:14', '2022-11-03 00:24:14'),
(14, '00-20221104152', 'aldi', '5', '50000', 500000, 450000, '2022-11-04 15:37:57', '2022-11-04 15:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `role_user`, `status`, `password`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'aldi', 'aldi', 1, 1, '$2y$10$Oy792QmiadTBJ0z4X.AQLe3mQ9xJcqaiAudo7Tt.bWpB3K/LiGEri', 'default.png', NULL, '2022-09-29 09:03:10', '2022-09-29 09:03:10'),
(2, 'aldo', 'aldo', 2, 1, '$2y$10$P.ZczMyy0hGRqkthixD5Nuj7qw.4D2MZP1idLY6kN9ezfKOG4rTkG', 'upload/user/1667434810.jpeg', NULL, '2022-09-29 09:03:10', '2022-11-03 00:20:10'),
(5, 'indra 123 yoi', 'indra', 1, 1, '$2y$10$QeXV3SGTbPW2oqSPlQSFfuJfrTXicjyBeDUyjfZDhNYmmQHlx3PB6', NULL, NULL, '2022-10-29 18:23:14', '2022-10-30 06:07:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluars`
--
ALTER TABLE `barang_keluars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_keluars_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_masuks_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `data_barangs`
--
ALTER TABLE `data_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_transaksi_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `detail_transaksi_barangs_id_foreign` (`barangs_id`),
  ADD KEY `detail_transaksi_satuan_id_foreign` (`satuan_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `harga_per_satuans`
--
ALTER TABLE `harga_per_satuans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `harga_per_satuans_barang_id_foreign` (`barang_id`),
  ADD KEY `harga_per_satuans_satuan_id_foreign` (`satuan_id`);

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
-- Indexes for table `pembelians`
--
ALTER TABLE `pembelians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelians_barangs_id_foreign` (`barangs_id`),
  ADD KEY `pembelians_satuan_id_foreign` (`satuan_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `satuan_barangs`
--
ALTER TABLE `satuan_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluars`
--
ALTER TABLE `barang_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `barang_masuks`
--
ALTER TABLE `barang_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_barangs`
--
ALTER TABLE `data_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `harga_per_satuans`
--
ALTER TABLE `harga_per_satuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pembelians`
--
ALTER TABLE `pembelians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satuan_barangs`
--
ALTER TABLE `satuan_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluars`
--
ALTER TABLE `barang_keluars`
  ADD CONSTRAINT `barang_keluars_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `data_barangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD CONSTRAINT `barang_masuks_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `data_barangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_barangs_id_foreign` FOREIGN KEY (`barangs_id`) REFERENCES `data_barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksi_satuan_id_foreign` FOREIGN KEY (`satuan_id`) REFERENCES `satuan_barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksi_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `harga_per_satuans`
--
ALTER TABLE `harga_per_satuans`
  ADD CONSTRAINT `harga_per_satuans_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `data_barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `harga_per_satuans_satuan_id_foreign` FOREIGN KEY (`satuan_id`) REFERENCES `satuan_barangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembelians`
--
ALTER TABLE `pembelians`
  ADD CONSTRAINT `pembelians_barangs_id_foreign` FOREIGN KEY (`barangs_id`) REFERENCES `data_barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembelians_satuan_id_foreign` FOREIGN KEY (`satuan_id`) REFERENCES `satuan_barangs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
