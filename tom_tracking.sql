-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2021 at 08:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tom_tracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `counties`
--

CREATE TABLE `counties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counties`
--

INSERT INTO `counties` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Nakuru', '2021-04-13 16:45:55', NULL),
(2, 'Nairobi', '2021-04-13 16:46:02', NULL),
(3, 'Mombasa', '2021-04-13 16:46:09', NULL),
(4, 'Kisumu', '2021-04-13 16:48:29', NULL),
(5, 'Nyahururu', '2021-04-13 16:49:51', NULL),
(6, 'Nyeri', '2021-04-13 16:50:36', NULL),
(7, 'Laikipia', '2021-05-02 13:52:53', NULL),
(8, 'Muranga', '2021-05-02 14:11:49', NULL);

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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `rec_id` bigint(20) NOT NULL,
  `package_id` bigint(20) NOT NULL,
  `sender_delete` tinyint(1) NOT NULL DEFAULT 0,
  `rec_delete` tinyint(1) NOT NULL DEFAULT 0,
  `timezone_offset` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `sender_id`, `rec_id`, `package_id`, `sender_delete`, `rec_delete`, `timezone_offset`, `created_at`, `updated_at`) VALUES
(1, 'vipi', 2, 3, 1, 0, 0, -180, '2021-04-24 10:33:02', NULL),
(2, 'hh', 2, 3, 1, 0, 0, -180, '2021-05-02 08:05:28', NULL);

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
(4, '2021_04_13_191720_counties', 2),
(5, '2021_04_13_201726_vehicles', 3),
(6, '2021_04_17_061338_price_settings', 4),
(8, '2021_04_21_122621_packages', 5),
(10, '2021_04_23_100458_mpesa_transactions', 6),
(12, '2021_04_24_122558_messages', 7);

-- --------------------------------------------------------

--
-- Table structure for table `mpesa_transactions`
--

CREATE TABLE `mpesa_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `FirstName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MiddleName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TransactionType` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TransID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TransTime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BusinessShortCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BillRefNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `InvoiceNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ThirdPartyTransID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MSISDN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TransAmount` double DEFAULT NULL,
  `OrgAccountBalance` double DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `package_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mpesa_transactions`
--

INSERT INTO `mpesa_transactions` (`id`, `FirstName`, `LastName`, `MiddleName`, `TransactionType`, `TransID`, `TransTime`, `BusinessShortCode`, `BillRefNumber`, `InvoiceNumber`, `ThirdPartyTransID`, `MSISDN`, `TransAmount`, `OrgAccountBalance`, `deleted_at`, `package_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, 'PDN55S1QWD', '1', NULL, NULL, NULL, NULL, '254703468755', 1, NULL, NULL, 1, '2021-04-23 09:36:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `from_town` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_latitude` double NOT NULL,
  `from_longitude` double NOT NULL,
  `to_town` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_latitude` double NOT NULL,
  `to_longitude` double NOT NULL,
  `current_latitude` double DEFAULT NULL,
  `current_longitude` double DEFAULT NULL,
  `distance` double NOT NULL,
  `weight` double NOT NULL,
  `amount` double NOT NULL,
  `picked` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `user_id`, `vehicle_id`, `from_town`, `from_latitude`, `from_longitude`, `to_town`, `to_latitude`, `to_longitude`, `current_latitude`, `current_longitude`, `distance`, `weight`, `amount`, `picked`, `status`, `paid`, `created_at`, `updated_at`) VALUES
(1, 'Envelope', 2, 1, 'Nairobi', -1.2920659, 36.8219462, 'Nakuru', -0.3030988, 36.080026, -1.2713984, 36.8345088, 137.6217421665095, 1, 1, 1, 0, 1, '2021-04-23 06:10:46', NULL),
(2, 'Oil tanks', 2, 1, 'Nairobi', -1.2920659, 36.8219462, 'Kisumu', -0.0917016, 34.7679568, -1.2713984, 36.8345088, 264.81, 1, 52962.708055123, 0, 0, 0, '2021-05-02 10:05:54', NULL);

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
-- Table structure for table `price_settings`
--

CREATE TABLE `price_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` double DEFAULT NULL,
  `price` double NOT NULL,
  `distance` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_settings`
--

INSERT INTO `price_settings` (`id`, `name`, `weight`, `price`, `distance`, `created_at`, `updated_at`) VALUES
(1, 'Below 1KG', 1, 200, 1, '2021-04-17 04:37:17', NULL),
(2, '1 KG', 1, 300, 0, '2021-04-17 04:40:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `vehicle_id`, `created_at`, `updated_at`) VALUES
(1, 'James', 'Githiora', 'jaygithiora@gmail.com', '254797696907', NULL, '$2y$10$kQZSYzBgm13eN5pNVY66f.NJxZpCqGYE..PO4wnY3j5CdVZzxZ6dO', 1, 1, NULL, NULL, '2021-04-08 11:16:51', '2021-04-08 11:16:51'),
(2, 'Staicy', 'Ngigi', 'staicyngigi@gmail.com', '254703468755', NULL, '$2y$10$/n/E1sdG7IBwz7gavQCq/.PTRbFrvnRDED0bGJKtAtsNGMGldkWa6', 0, 1, NULL, NULL, '2021-04-17 02:40:47', '2021-04-24 02:22:05'),
(3, 'Dennis', 'Kiarie', 'deekiarie@gmail.com', '254791162496', NULL, '$2y$10$7crI5FrMahPupFMfUrcuUucAl4Mc/N.eGNjH83HTO7/ZTWIFktQLq', 2, 1, NULL, 3, '2021-04-24 02:36:33', '2021-05-02 13:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `vehicle_type`, `created_at`, `updated_at`) VALUES
(1, 'KBS 455H', 'Mini-Truck', '2021-04-13 17:35:29', NULL),
(2, 'KBC 567K', 'Truck', '2021-04-13 17:37:34', NULL),
(3, 'KBB 768M', 'Matatu', '2021-04-13 17:37:46', NULL),
(4, 'KDA 001A', 'Truck', '2021-05-02 15:33:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counties`
--
ALTER TABLE `counties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mpesa_transactions`
--
ALTER TABLE `mpesa_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `price_settings`
--
ALTER TABLE `price_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counties`
--
ALTER TABLE `counties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mpesa_transactions`
--
ALTER TABLE `mpesa_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `price_settings`
--
ALTER TABLE `price_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
