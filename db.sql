-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2021 at 07:29 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siko`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama_admin`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'adminkonseling', 1, '2020-09-24 18:57:34', '2020-09-24 18:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `case_conferences`
--

CREATE TABLE `case_conferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_mulai_case_conference` date NOT NULL,
  `judul_case_conference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konseling_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_conferences`
--

CREATE TABLE `chat_conferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `UserID` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_konseling` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_chat` date NOT NULL,
  `case_conference_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_konselings`
--

CREATE TABLE `chat_konselings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_konseling` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_chat` date NOT NULL,
  `konseling_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_conferences`
--

CREATE TABLE `detail_conferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `konselor_id` bigint(20) UNSIGNED NOT NULL,
  `case_conference_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_fakultas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `nama_fakultas`, `created_at`, `updated_at`) VALUES
(1, 'FTI', NULL, NULL),
(2, 'FTEK', NULL, NULL),
(3, 'FPB', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_konselors`
--

CREATE TABLE `jadwal_konselors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_akhir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konselor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konselings`
--

CREATE TABLE `konselings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_daftar_konseling` date NOT NULL,
  `tgl_akhir_konseling` date NOT NULL,
  `tgl_expired_konseling` date NOT NULL,
  `status_konseling` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_selesai` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konseli_id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_konselor_id` bigint(20) UNSIGNED NOT NULL,
  `konselor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `refered` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tidak',
  `conferenced` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tidak',
  `referral_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konselis`
--

CREATE TABLE `konselis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_konseli` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir_konseli` date NOT NULL,
  `no_hp_konseli` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_kerabat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hubungan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_konseli` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progdi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fakultas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konselors`
--

CREATE TABLE `konselors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_konselor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profesi_konselor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_konselor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_konselor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_06_02_000000_create_faculties_table', 1),
(10, '2020_06_02_000001_create_prodis_table', 1),
(11, '2020_06_02_000002_create_konselors_table', 1),
(12, '2020_06_02_000003_create_jadwal_konselors_table', 1),
(13, '2020_06_02_000004_create_konselis_table', 1),
(14, '2020_06_02_114245_create_konselings_table', 1),
(15, '2020_06_03_102220_create_chat_konselings_table', 1),
(16, '2020_06_13_075135_change_chat_size', 1),
(17, '2020_06_15_143204_create_rangkuman_konselings_table', 1),
(18, '2020_06_15_144320_create_rekam_konselings_table', 1),
(19, '2020_06_16_181744_modify_rekam_konseling', 1),
(20, '2020_06_20_102804_create_notifications_table', 1),
(21, '2020_06_20_152407_add_new_column_notification', 1),
(22, '2020_07_04_081157_create_referals_table', 1),
(23, '2020_07_06_093815_add_new_column_konselings', 1),
(24, '2020_07_07_172633_add_referral_konselings', 1),
(25, '2020_07_09_231921_create_case_conferences_table', 1),
(26, '2020_07_09_234048_create_detail_conferences_table', 1),
(27, '2020_07_10_130152_create_chat_conferences_table', 1),
(28, '2020_07_14_004021_add_image_url', 1),
(29, '2020_09_17_153205_create_pengumumen_table', 1),
(30, '2020_09_19_164209_create_settings_table', 1),
(31, '2020_09_19_195942_create_quotes_table', 1),
(32, '2020_09_24_154934_create_admins_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` datetime DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengumumen`
--

CREATE TABLE `pengumumen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_gambar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','non-aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_prodi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`id`, `nama_prodi`, `faculty_id`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Informatika', 1, NULL, NULL),
(2, 'Sistem Informasi', 2, NULL, NULL),
(3, 'Desain Komunikasi Visual', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `oleh` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rangkuman_konselings`
--

CREATE TABLE `rangkuman_konselings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rangkuman` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `treatment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konseling_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referals`
--

CREATE TABLE `referals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_referral` date NOT NULL,
  `judul_referral` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan_referral` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jadwal_konselor_id` bigint(20) UNSIGNED NOT NULL,
  `konseling_id` bigint(20) UNSIGNED NOT NULL,
  `konselor_tujuan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekam_konselings`
--

CREATE TABLE `rekam_konselings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_konseling` date NOT NULL,
  `judul_konseling` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_rekam_konseling` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konseling_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expired` int(11) NOT NULL DEFAULT 30,
  `session_limit` int(11) NOT NULL DEFAULT 7,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `expired`, `session_limit`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, '2021-01-22 14:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'konseli',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `avatar`) VALUES
(1, 'adminkonseling', 'admin@uksw.edu', NULL, '$2y$10$TrYuXITWV87y5R88UXrwEe/2sYxkeqzZMkqhDV1VOuPEwuOd6Yi7K', 'admin', NULL, '2020-09-24 18:57:34', '2020-09-24 18:57:34', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `case_conferences`
--
ALTER TABLE `case_conferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_conferences_konseling_id_foreign` (`konseling_id`);

--
-- Indexes for table `chat_conferences`
--
ALTER TABLE `chat_conferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_conferences_case_conference_id_foreign` (`case_conference_id`);

--
-- Indexes for table `chat_konselings`
--
ALTER TABLE `chat_konselings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_konselings_konseling_id_foreign` (`konseling_id`);

--
-- Indexes for table `detail_conferences`
--
ALTER TABLE `detail_conferences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_conferences_konselor_id_foreign` (`konselor_id`),
  ADD KEY `detail_conferences_case_conference_id_foreign` (`case_conference_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_konselors`
--
ALTER TABLE `jadwal_konselors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_konselors_konselor_id_foreign` (`konselor_id`);

--
-- Indexes for table `konselings`
--
ALTER TABLE `konselings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konselings_konseli_id_foreign` (`konseli_id`),
  ADD KEY `konselings_jadwal_konselor_id_foreign` (`jadwal_konselor_id`),
  ADD KEY `konselings_konselor_id_foreign` (`konselor_id`),
  ADD KEY `konselings_referral_id_foreign` (`referral_id`);

--
-- Indexes for table `konselis`
--
ALTER TABLE `konselis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konselis_user_id_foreign` (`user_id`),
  ADD KEY `konselis_prodi_id_foreign` (`prodi_id`);

--
-- Indexes for table `konselors`
--
ALTER TABLE `konselors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konselors_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengumumen`
--
ALTER TABLE `pengumumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodis_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rangkuman_konselings`
--
ALTER TABLE `rangkuman_konselings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rangkuman_konselings_konseling_id_foreign` (`konseling_id`);

--
-- Indexes for table `referals`
--
ALTER TABLE `referals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referals_jadwal_konselor_id_foreign` (`jadwal_konselor_id`),
  ADD KEY `referals_konseling_id_foreign` (`konseling_id`),
  ADD KEY `referals_konselor_tujuan_id_foreign` (`konselor_tujuan_id`);

--
-- Indexes for table `rekam_konselings`
--
ALTER TABLE `rekam_konselings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekam_konselings_konseling_id_foreign` (`konseling_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `case_conferences`
--
ALTER TABLE `case_conferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_conferences`
--
ALTER TABLE `chat_conferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_konselings`
--
ALTER TABLE `chat_konselings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_conferences`
--
ALTER TABLE `detail_conferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_konselors`
--
ALTER TABLE `jadwal_konselors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konselings`
--
ALTER TABLE `konselings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konselis`
--
ALTER TABLE `konselis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konselors`
--
ALTER TABLE `konselors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumumen`
--
ALTER TABLE `pengumumen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rangkuman_konselings`
--
ALTER TABLE `rangkuman_konselings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referals`
--
ALTER TABLE `referals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekam_konselings`
--
ALTER TABLE `rekam_konselings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `case_conferences`
--
ALTER TABLE `case_conferences`
  ADD CONSTRAINT `case_conferences_konseling_id_foreign` FOREIGN KEY (`konseling_id`) REFERENCES `konselings` (`id`);

--
-- Constraints for table `chat_conferences`
--
ALTER TABLE `chat_conferences`
  ADD CONSTRAINT `chat_conferences_case_conference_id_foreign` FOREIGN KEY (`case_conference_id`) REFERENCES `case_conferences` (`id`);

--
-- Constraints for table `chat_konselings`
--
ALTER TABLE `chat_konselings`
  ADD CONSTRAINT `chat_konselings_konseling_id_foreign` FOREIGN KEY (`konseling_id`) REFERENCES `konselings` (`id`);

--
-- Constraints for table `detail_conferences`
--
ALTER TABLE `detail_conferences`
  ADD CONSTRAINT `detail_conferences_case_conference_id_foreign` FOREIGN KEY (`case_conference_id`) REFERENCES `case_conferences` (`id`),
  ADD CONSTRAINT `detail_conferences_konselor_id_foreign` FOREIGN KEY (`konselor_id`) REFERENCES `konselors` (`id`);

--
-- Constraints for table `jadwal_konselors`
--
ALTER TABLE `jadwal_konselors`
  ADD CONSTRAINT `jadwal_konselors_konselor_id_foreign` FOREIGN KEY (`konselor_id`) REFERENCES `konselors` (`id`);

--
-- Constraints for table `konselings`
--
ALTER TABLE `konselings`
  ADD CONSTRAINT `konselings_jadwal_konselor_id_foreign` FOREIGN KEY (`jadwal_konselor_id`) REFERENCES `jadwal_konselors` (`id`),
  ADD CONSTRAINT `konselings_konseli_id_foreign` FOREIGN KEY (`konseli_id`) REFERENCES `konselis` (`id`),
  ADD CONSTRAINT `konselings_konselor_id_foreign` FOREIGN KEY (`konselor_id`) REFERENCES `konselors` (`id`),
  ADD CONSTRAINT `konselings_referral_id_foreign` FOREIGN KEY (`referral_id`) REFERENCES `referals` (`id`);

--
-- Constraints for table `konselis`
--
ALTER TABLE `konselis`
  ADD CONSTRAINT `konselis_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`),
  ADD CONSTRAINT `konselis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `konselors`
--
ALTER TABLE `konselors`
  ADD CONSTRAINT `konselors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `prodis`
--
ALTER TABLE `prodis`
  ADD CONSTRAINT `prodis_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`);

--
-- Constraints for table `rangkuman_konselings`
--
ALTER TABLE `rangkuman_konselings`
  ADD CONSTRAINT `rangkuman_konselings_konseling_id_foreign` FOREIGN KEY (`konseling_id`) REFERENCES `konselings` (`id`);

--
-- Constraints for table `referals`
--
ALTER TABLE `referals`
  ADD CONSTRAINT `referals_jadwal_konselor_id_foreign` FOREIGN KEY (`jadwal_konselor_id`) REFERENCES `jadwal_konselors` (`id`),
  ADD CONSTRAINT `referals_konseling_id_foreign` FOREIGN KEY (`konseling_id`) REFERENCES `konselings` (`id`),
  ADD CONSTRAINT `referals_konselor_tujuan_id_foreign` FOREIGN KEY (`konselor_tujuan_id`) REFERENCES `konselors` (`id`);

--
-- Constraints for table `rekam_konselings`
--
ALTER TABLE `rekam_konselings`
  ADD CONSTRAINT `rekam_konselings_konseling_id_foreign` FOREIGN KEY (`konseling_id`) REFERENCES `konselings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
