-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 16, 2021 at 01:37 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_laravel`
--

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
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` int(11) NOT NULL,
  `nama_gudang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `nama_gudang`, `created_at`) VALUES
(2, 'Toko Utama', '2021-01-09 13:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(255) NOT NULL,
  `nama_kategori` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`) VALUES
(7, 'Makanan', '2021-01-07 14:04:29'),
(8, 'Minuman', '2021-01-07 14:04:35'),
(9, 'Rokok', '2021-01-07 14:04:39'),
(10, 'sabun', '2021-01-10 08:51:17');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

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
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_transaksi` varchar(40) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `metode_pembayaran` enum('Tunai','Non-Tunai') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_barcode` varchar(36) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `harga_modal` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_barcode`, `nama_produk`, `id_kategori`, `id_satuan`, `harga_modal`, `harga_jual`, `keterangan`, `created_at`) VALUES
(10, '7676761', 'sabun batang', 7, 5, 1000, 5000, NULL, '2021-01-07 22:05:05'),
(11, '0202020', 'magnum filter', 9, 6, 6000, 8000, NULL, '2021-01-07 22:06:10'),
(12, '5656656', 'cocolatos', 7, 5, 5000, 6000, NULL, '2021-01-07 23:20:45'),
(13, '7676767', 'pepsodent', 8, 6, 10000, 2000, NULL, '2021-01-08 21:07:53'),
(14, '767676741', 'close up', 9, 6, 20000, 30000, NULL, '2021-01-08 23:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(255) DEFAULT NULL,
  `created_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `created_at`) VALUES
(4, 'kilogram', '21:03:57'),
(5, 'bungkus', '21:04:03'),
(6, 'kotak', '21:04:09'),
(7, 'kardus', '21:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `stok_gudang`
--

CREATE TABLE `stok_gudang` (
  `id_stok_gudang` int(11) NOT NULL,
  `id_gudang` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `min_stok` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_gudang`
--

INSERT INTO `stok_gudang` (`id_stok_gudang`, `id_gudang`, `id_produk`, `stok`, `min_stok`, `created_at`, `updated_at`) VALUES
(2, 2, 10, 20, 10, '2021-01-09 17:42:15', '2021-01-09 17:42:15'),
(3, 2, 12, 30, 20, '2021-01-10 08:48:25', '2021-01-10 08:48:25'),
(4, 2, 11, 10, 5, '2021-01-10 08:50:16', '2021-01-10 08:50:16'),
(5, 2, 13, 0, 10, '2021-01-10 08:52:47', '2021-01-10 08:52:47'),
(7, 2, 14, 50, 10, '2021-01-31 03:41:28', '2021-01-31 04:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(40) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `id_kasir` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `diskon_bayar` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` varchar(40) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('admin','kasir') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$eqc18eXiAehuFh8ghs7bKulY7C2oxYV09b9cwOZyq2B23PZwoWHay', 'admin', NULL, '2020-12-26 22:18:19', '2020-12-26 22:18:19'),
(2, 'alief', 'alief@gmail.com', NULL, '$2y$10$xwEq3EfJOo4i1vvAAMMS3O1KBSnGNh3Zz6TH0HS.FHy1BDhuhc146', 'kasir', NULL, '2020-12-27 08:30:07', '2020-12-27 08:30:07'),
(4, 'alief', 'alief2@gmail.com', NULL, '$2y$10$oVaafZISz9wrdYWGRpgirOuj5N68J6XJmrqVik4TFGJ8DcPzVVGzm', 'kasir', NULL, '2020-12-27 08:48:59', '2020-12-27 08:48:59'),
(5, 'alief', 'alief22@gmail.com', NULL, '$2y$10$SvnbQqFPVEzYWz9tw2fK9e/p2vwHnmqIFXP0ssJfQfsNul36NAPX6', 'admin', NULL, '2020-12-27 08:49:39', '2020-12-27 08:49:39'),
(6, 'rr', 'rr@gmail.com', NULL, '$2y$10$2z.UKRoA3Z5uXv95y9L6F.k7SwM9i0ARg0o0XKRgbk.S9xOV2KyWq', 'admin', NULL, '2020-12-27 08:53:47', '2020-12-27 08:53:47'),
(7, 'asd', 'asd@gmail.com', NULL, '$2y$10$ngNwSPKfb5.Go202llfCnO6JMwPNuAU3sjiSQ.Mf1muhttXNpEp5.', 'admin', NULL, '2020-12-27 08:54:19', '2020-12-27 08:54:19'),
(22, 'cdcdcd', 'cdcddc@gmail.com', NULL, '$2y$10$acb7wD9m2KkK9pCYqMM.1e1clGwZF8DKzlYeKDFM7wUj2E.eamu12', 'admin', NULL, '2021-01-02 06:46:48', '2021-01-02 06:46:48'),
(23, 'asdsad345', 'dsf@gmail.com', NULL, '$2y$10$wH5oc3qsEpUv3yDkgIyreOCbafol6J72PFllEP17nqFbDpEjCMM2O', 'admin', NULL, '2021-01-02 06:48:18', '2021-01-02 06:48:18'),
(24, 'cdcdc', 'cdc@gmail.com', NULL, '$2y$10$CO.Wp8jJUMJTPmQkzNlEfuwVdEFQaK2n0QqE2ALIXzkIuYvzagrpq', 'admin', NULL, '2021-01-02 06:49:49', '2021-01-02 06:49:49'),
(25, 'asdasd', 'asdasdasdasd@fdsf.com', NULL, '$2y$10$JXL1vLamP2i3EV8UKNYgY.lOy83hQdJEAeJEeLIhJ5d2DB0kZScBa', 'admin', NULL, '2021-01-02 06:51:54', '2021-01-02 06:51:54'),
(26, 'asdasd343', 'asd233@gmail.com', NULL, '$2y$10$GpDfvvl0p2GXoze35sL2zu2Qkt4R5xnWaLpoz13ABV79KbQ/S7mFa', 'admin', NULL, '2021-01-02 06:52:29', '2021-01-02 06:52:29'),
(27, 'asddd', 'asd324@gmail.com', NULL, '$2y$10$wvublch9lV6aIw59pMAhPeKGkAp2QgiTg937VN9jaNUWcAiH5VzU.', 'admin', NULL, '2021-01-02 07:00:23', '2021-01-02 07:43:10'),
(28, 't5t5t5', 't5@gmail.com', NULL, '$2y$10$uDpxTVm7jt9BwuyknyhK0ejlrwwIFEspFnZUxhozxJGH4IA854Nfm', 'admin', NULL, '2021-01-02 07:43:24', '2021-01-02 07:43:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

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
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stok_gudang`
--
ALTER TABLE `stok_gudang`
  ADD PRIMARY KEY (`id_stok_gudang`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stok_gudang`
--
ALTER TABLE `stok_gudang`
  MODIFY `id_stok_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
