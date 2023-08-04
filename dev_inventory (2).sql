-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2023 at 01:04 PM
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
-- Database: `dev_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `acquimode`
--

CREATE TABLE `acquimode` (
  `Pk_aquisModeId` int(10) UNSIGNED NOT NULL,
  `Fk_aquisId` int(10) UNSIGNED NOT NULL,
  `Fk_sourceId` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acquisition`
--

CREATE TABLE `acquisition` (
  `Pk_acquisitionId` int(10) UNSIGNED NOT NULL,
  `acquisition_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acquisource`
--

CREATE TABLE `acquisource` (
  `Pk_sourceId` int(10) UNSIGNED NOT NULL,
  `source_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `Pk_articleId` int(10) UNSIGNED NOT NULL,
  `article_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`Pk_articleId`, `article_name`, `created_at`) VALUES
(1, 'Desktop', '2023-08-03 05:46:18'),
(2, 'Keyboard', '2023-08-03 05:48:50'),
(3, 'sample', '2023-08-03 07:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `article_relation`
--

CREATE TABLE `article_relation` (
  `Pk_article_relationId` int(10) UNSIGNED NOT NULL,
  `Fk_articleId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_typeId` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_relation`
--

INSERT INTO `article_relation` (`Pk_article_relationId`, `Fk_articleId`, `Fk_typeId`, `created_at`) VALUES
(1, 1, 1, '2023-08-03 05:46:18'),
(2, 2, 2, '2023-08-03 05:48:50'),
(3, 3, 3, '2023-08-03 07:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `associate`
--

CREATE TABLE `associate` (
  `Pk_assocId` int(10) UNSIGNED NOT NULL,
  `person_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `associate`
--

INSERT INTO `associate` (`Pk_assocId`, `person_name`, `created_at`) VALUES
(2, 'Adrian', '2023-07-25 03:03:44'),
(3, 'Dennis', '2023-07-26 02:55:55'),
(4, 'Kim Dolar', '2023-07-26 06:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `Pk_brandId` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`Pk_brandId`, `brand_name`, `created_at`) VALUES
(1, 'Huawei', '2023-08-03 05:46:18'),
(2, 'Logitech', '2023-08-03 05:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE `conditions` (
  `Pk_conditionsId` int(10) UNSIGNED NOT NULL,
  `conditions_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`Pk_conditionsId`, `conditions_name`, `created_at`) VALUES
(1, 'Good', '2023-07-26 02:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `Pk_countryId` int(10) UNSIGNED NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fundcluster`
--

CREATE TABLE `fundcluster` (
  `Pk_fundClusterId` int(10) UNSIGNED NOT NULL,
  `fundCluster` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fundcluster`
--

INSERT INTO `fundcluster` (`Pk_fundClusterId`, `fundCluster`, `created_at`) VALUES
(1, 'Sample Cluster', '2023-08-03 05:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `ics_details`
--

CREATE TABLE `ics_details` (
  `Pk_icsDetails` int(10) UNSIGNED NOT NULL,
  `Fk_fundClusterId` int(10) UNSIGNED DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `invoice` varchar(15) DEFAULT NULL,
  `invoiceDate` date DEFAULT NULL,
  `ors` varchar(50) DEFAULT NULL,
  `iar` varchar(100) DEFAULT NULL,
  `drf` varchar(100) DEFAULT NULL,
  `drf_date` date DEFAULT NULL,
  `ptr_num` varchar(100) DEFAULT NULL,
  `icsRemarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ics_no`
--

CREATE TABLE `ics_no` (
  `Pk_icsNumId` int(10) UNSIGNED NOT NULL,
  `series` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ics_no`
--

INSERT INTO `ics_no` (`Pk_icsNumId`, `series`, `created_at`) VALUES
(1, 1, '2023-08-03 07:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `ics_series`
--

CREATE TABLE `ics_series` (
  `Pk_icsId` int(10) UNSIGNED NOT NULL,
  `series` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `Pk_inventoryId` int(10) UNSIGNED NOT NULL,
  `Fk_itemId` int(10) UNSIGNED NOT NULL,
  `Fk_conditionsId` int(10) UNSIGNED NOT NULL,
  `Fk_locatmanId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_propertyId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_item_relationId` int(10) UNSIGNED DEFAULT NULL,
  `Delivery_date` date DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `property_no` varchar(255) DEFAULT NULL,
  `newProperty` varchar(100) DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `loose` int(11) DEFAULT NULL,
  `Remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`Pk_inventoryId`, `Fk_itemId`, `Fk_conditionsId`, `Fk_locatmanId`, `Fk_propertyId`, `Fk_item_relationId`, `Delivery_date`, `Quantity`, `property_no`, `newProperty`, `serial`, `barcode`, `loose`, `Remarks`, `created_at`) VALUES
(1, 1, 1, 1, 1, 1, NULL, 1, NULL, '2023-05-03-0001-10', NULL, '243524657', NULL, NULL, '2023-08-03 05:46:20'),
(2, 2, 1, 2, 2, 1, NULL, 1, NULL, '2023-05-03-0002-10', NULL, '38746262436', NULL, NULL, '2023-08-03 05:48:51'),
(3, 2, 1, 3, 3, 1, NULL, 1, 'jr7657575', '2023-05-03-0003-10', '7677464', '876e654', NULL, NULL, '2023-08-03 07:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `itemcateg`
--

CREATE TABLE `itemcateg` (
  `Pk_itemCategId` int(10) UNSIGNED NOT NULL,
  `itemCateg_name` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itemcateg`
--

INSERT INTO `itemcateg` (`Pk_itemCategId`, `itemCateg_name`, `code`, `created_at`) VALUES
(1, 'Medical Equipment', '05-10', '2023-06-15 02:22:03'),
(2, 'Janitorial Equipment', '06-03', '2023-06-15 02:22:03'),
(3, 'Office Equipment', '05-02', '2023-06-15 02:22:02'),
(4, 'Furnitures and Fixtures', '06-01', '2023-06-15 02:22:03'),
(5, 'Other', '09-09', '2023-06-15 02:22:03'),
(6, 'Machinery', '05-01', '2023-06-15 02:22:02'),
(7, 'Information and Communication Technology Equipment', '05-03', '2023-06-15 02:22:03'),
(8, 'Agricultural and Forestry', '05-04', '2023-06-15 02:22:03'),
(9, 'Marine and Fishery', '05-05', '2023-06-15 02:22:03'),
(10, 'Airport Equipment', '05-06', '2023-06-15 02:22:03'),
(11, 'Communication Equipment', '05-07', '2023-06-15 02:22:03'),
(12, 'Disaster Response and Rescue Equipment', '05-08', '2023-06-15 02:22:03'),
(13, 'Military Police and Security', '05-09', '2023-06-15 02:22:03'),
(14, 'Printing Equipment', '05-11', '2023-06-15 02:22:03'),
(15, 'Sports Equipment', '05-12', '2023-06-15 02:22:03'),
(16, 'Technical and Scientific Equipment', '05-13', '2023-06-15 02:22:03'),
(17, 'Other Machinery and Equipment', '05-19', '2023-06-15 02:22:03'),
(18, 'Books', '06-02', '2023-06-15 02:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Pk_itemId` int(10) UNSIGNED NOT NULL,
  `Fk_article_relationId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_statusId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_manuId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_supplierId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_unitId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_varietyId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_brandId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_countryId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_sourcemodeId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_itemCategId` int(10) UNSIGNED DEFAULT NULL,
  `item_name` varchar(500) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `details2` varchar(6000) DEFAULT NULL,
  `accessories` varchar(4000) DEFAULT NULL,
  `other` varchar(4000) DEFAULT NULL,
  `warranty` varchar(15) DEFAULT NULL,
  `acquisition_date` date DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `fundSource` varchar(255) DEFAULT NULL,
  `cost` double(15,2) NOT NULL DEFAULT 0.00,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Pk_itemId`, `Fk_article_relationId`, `Fk_statusId`, `Fk_manuId`, `Fk_supplierId`, `Fk_unitId`, `Fk_varietyId`, `Fk_brandId`, `Fk_countryId`, `Fk_sourcemodeId`, `Fk_itemCategId`, `item_name`, `model`, `details2`, `accessories`, `other`, `warranty`, `acquisition_date`, `expiration`, `fundSource`, `cost`, `remarks`, `created_at`) VALUES
(1, 1, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, 7, NULL, 'D15', NULL, NULL, NULL, NULL, '2023-08-31', NULL, 'Regular', 55000.00, NULL, '2023-08-03 05:46:18'),
(2, 1, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-19', NULL, 'Regular', 56000.00, NULL, '2023-08-03 05:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `item_relation`
--

CREATE TABLE `item_relation` (
  `Pk_item_relationId` int(10) UNSIGNED NOT NULL,
  `Fk_poId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_icsNumId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_parNumId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_icsDetailsId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_parDetailsId` int(10) UNSIGNED DEFAULT NULL,
  `ics_number` varchar(20) DEFAULT NULL,
  `old_icsNum` varchar(20) DEFAULT NULL,
  `par_number` varchar(20) DEFAULT NULL,
  `old_parNum` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_relation`
--

INSERT INTO `item_relation` (`Pk_item_relationId`, `Fk_poId`, `Fk_icsNumId`, `Fk_parNumId`, `Fk_icsDetailsId`, `Fk_parDetailsId`, `ics_number`, `old_icsNum`, `par_number`, `old_parNum`, `created_at`) VALUES
(1, 1, NULL, 1, NULL, 1, NULL, NULL, '2023-08-0001', NULL, '2023-08-03 05:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `Pk_locationId` int(10) UNSIGNED NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `area_code` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Pk_locationId`, `location_name`, `area_code`, `created_at`) VALUES
(1, 'MMS', 10, '2023-07-25 02:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `locat_man`
--

CREATE TABLE `locat_man` (
  `Pk_locatmanId` int(10) UNSIGNED NOT NULL,
  `Fk_assocId` int(10) UNSIGNED DEFAULT NULL,
  `Fk_locationId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locat_man`
--

INSERT INTO `locat_man` (`Pk_locatmanId`, `Fk_assocId`, `Fk_locationId`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `Pk_manuId` int(10) UNSIGNED NOT NULL,
  `manu_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `par_details`
--

CREATE TABLE `par_details` (
  `Pk_parDetails` int(10) UNSIGNED NOT NULL,
  `Fk_fundClusterId` int(10) UNSIGNED DEFAULT NULL,
  `invoice` varchar(100) DEFAULT NULL,
  `po_date` varchar(100) DEFAULT NULL,
  `ors_num` varchar(100) DEFAULT NULL,
  `po_conformed` date DEFAULT NULL,
  `invoice_rec` varchar(100) DEFAULT NULL,
  `ptr_num` varchar(100) DEFAULT NULL,
  `drf` varchar(20) DEFAULT NULL,
  `drf_date` varchar(100) DEFAULT NULL,
  `iar` varchar(50) DEFAULT NULL,
  `parRemarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `par_details`
--

INSERT INTO `par_details` (`Pk_parDetails`, `Fk_fundClusterId`, `invoice`, `po_date`, `ors_num`, `po_conformed`, `invoice_rec`, `ptr_num`, `drf`, `drf_date`, `iar`, `parRemarks`, `created_at`) VALUES
(1, 1, '1514367', '2023-08-23', '27425725', '2023-08-22', '2023-08-25', NULL, NULL, NULL, '8764543', NULL, '2023-08-03 05:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `par_no`
--

CREATE TABLE `par_no` (
  `Pk_parNumId` int(10) UNSIGNED NOT NULL,
  `series` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `par_no`
--

INSERT INTO `par_no` (`Pk_parNumId`, `series`, `created_at`) VALUES
(1, 1, '2023-08-03 05:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `par_series`
--

CREATE TABLE `par_series` (
  `Pk_parId` int(10) UNSIGNED NOT NULL,
  `series` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `par_series`
--

INSERT INTO `par_series` (`Pk_parId`, `series`, `created_at`) VALUES
(1, 1, '2023-08-03 05:46:18'),
(2, 2, '2023-08-03 05:48:50'),
(3, 3, '2023-08-03 07:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(8, 'App\\Models\\User', 1, 'auth_token', 'f5c148a455a8c8963227526b63e0cd5fb7235de72d56775603a78004a3135b3a', '[\"*\"]', '2023-08-03 21:57:42', NULL, '2023-08-03 21:57:35', '2023-08-03 21:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `po_number`
--

CREATE TABLE `po_number` (
  `Pk_poId` int(10) UNSIGNED NOT NULL,
  `po_number` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_number`
--

INSERT INTO `po_number` (`Pk_poId`, `po_number`, `created_at`) VALUES
(1, '7247224', '2023-08-03 13:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `propertyno`
--

CREATE TABLE `propertyno` (
  `Pk_propertyId` int(10) UNSIGNED NOT NULL,
  `Fk_parId` int(11) UNSIGNED DEFAULT NULL,
  `Fk_icsId` int(11) UNSIGNED DEFAULT NULL,
  `type` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propertyno`
--

INSERT INTO `propertyno` (`Pk_propertyId`, `Fk_parId`, `Fk_icsId`, `type`, `created_at`) VALUES
(1, 1, NULL, 1, '2023-08-03 05:46:18'),
(2, 2, NULL, 1, '2023-08-03 05:48:50'),
(3, 3, NULL, 1, '2023-08-03 07:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `Pk_statusId` int(10) UNSIGNED NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `Pk_supplierId` int(10) UNSIGNED NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `mode` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `Pk_typeId` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`Pk_typeId`, `type_name`, `created_at`) VALUES
(1, 'Computer', '2023-08-03 05:46:18'),
(2, 'Mechanical', '2023-08-03 05:48:50'),
(3, 'sample', '2023-08-03 07:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `Pk_unitId` int(10) UNSIGNED NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`Pk_unitId`, `unit`, `created_at`) VALUES
(1, 'Unit', '2023-08-03 05:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstname`, `lastname`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Adrian', 'Agcaoili', 'adrian.zcmc@gmail.com', '$2y$10$IzMF1A0u0vo2VibYu5t93e.0sVmHwR8VpBxB/Ad5HYovBDazb9EWu', NULL, NULL, NULL),
(2, 'emmanuel', 'montecino', 'emmanuel.zcmc@gmail.com', '$2y$10$d9JtxuzlGwIqvmrLB5LbQ.zcL3fc3I4SL0n/wzG8aolfUTHh6Zueu', NULL, NULL, NULL),
(3, 'Peter', 'Torres', 'Nobody@gmail.com', '$2y$10$lDBm1i2s9Jlb80pmUjdLue5yi5j6oIDOHrprshcz.m7BXyAgdx2FK', NULL, NULL, NULL),
(4, 'Peter', 'Torres', 'Mr.Nobody@gmail.com', '$2y$10$jo5F0tP7mGJgm8MtDGDO2e7tv2nzaNFYjEPQkd7Y1TPAEHZLmIVni', NULL, NULL, NULL),
(6, 'Nicho Jan', 'Torino', 'torinonicholjan@gmail.com', '$2y$10$lZOXTK1ez1/J56EcOyi60uhUTxsj2gu7Dp2MZG4lgZugsjRsfUxD2', NULL, NULL, NULL),
(7, 'dennis', 'falcasantos', 'dennis@gmail.com', '$2y$10$3FNDvg6BYehsXUZ703wAXeRGvBCLpNteIpJsB3S.OjW1MGa5oFRea', NULL, NULL, NULL),
(8, 'dennis', 'falcasantos', 'dd@gmail.com', '$2y$10$3ZaxVMkDsj3KAULET.kX2.To2ooXhNpqZOxHCJm0XSimvS3Pl5Ci2', NULL, NULL, NULL),
(9, 'MICHAEL', 'MAMALIAS', 'MICHMAMALIAS@GMAIL.COM', '$2y$10$BTGhwz3zTZ/J/K6DUGchz.HC4HuQEI.SWzlul/n.DOMb/UkATpzLe', NULL, NULL, NULL),
(10, 'Exie Jr.', 'Cruz', 'exiefcruzjr@gmail.com', '$2y$10$3TZMQk/686h5KtX6jKaEveSTkVkf07Cdg1GYx6Xs5Js2OKEyDlhlm', NULL, NULL, NULL),
(11, 'Jude Bryan', 'Guerzon', 'guerzonjude@gmail.com', '$2y$10$kdfpnEiSnYbax.ewOVv7xeczB1OOIcXmEqTQVwS9nJEAV45FCCeta', NULL, NULL, NULL),
(12, 'Yara', 'Que', 'queyaramae04@gmail.com', '$2y$10$Vm7bfU3d2uqQXBktE1NzreUMeAhhijg8Xkq4l5/GYkdyOfIg98otW', NULL, NULL, NULL),
(13, 'Janelle', 'Encabo', 'janelleanneencabo@gmail.com', '$2y$10$iokuNgfVrTyg5kTxkTj1YOZGtgh6QJPzhc7sQw0gCSxoy6tUdfTHG', NULL, NULL, NULL),
(14, 'Radsmer', 'Jama', 'jradsmer@gmail.com', '$2y$10$VkDrZ9EX0BDTFYEQMdMNtuT.oFbOIV.Oa1rkhxlKJfLP5y8QBhgm6', NULL, NULL, NULL),
(15, 'Radsmer', 'Jama', 'radsmerjama1@gmail.com', '$2y$10$bv/kQ1tLEir2xOPBI0Flf.xnsyWgEDTqfFryRuwyFnzb31QH.Q8R2', NULL, NULL, NULL),
(16, 'ruzcel', 'enriquez', 'ruzcelcornejoenriquez@gmail.com', '$2y$10$36UNM7KduRBOOY0kYeuT1eyebfw7W8cJhG7c94j9MKD7b4ww9DSRi', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variety`
--

CREATE TABLE `variety` (
  `Pk_varietyId` int(10) UNSIGNED NOT NULL,
  `variety` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variety`
--

INSERT INTO `variety` (`Pk_varietyId`, `variety`, `created_at`) VALUES
(1, 'Black', '2023-08-03 05:46:18'),
(2, 'Wireless', '2023-08-03 05:48:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acquimode`
--
ALTER TABLE `acquimode`
  ADD PRIMARY KEY (`Pk_aquisModeId`),
  ADD KEY `acquimode_fk_aquisid_foreign` (`Fk_aquisId`),
  ADD KEY `acquimode_fk_sourceid_foreign` (`Fk_sourceId`);

--
-- Indexes for table `acquisition`
--
ALTER TABLE `acquisition`
  ADD PRIMARY KEY (`Pk_acquisitionId`);

--
-- Indexes for table `acquisource`
--
ALTER TABLE `acquisource`
  ADD PRIMARY KEY (`Pk_sourceId`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`Pk_articleId`);

--
-- Indexes for table `article_relation`
--
ALTER TABLE `article_relation`
  ADD PRIMARY KEY (`Pk_article_relationId`),
  ADD KEY `Fk_articleId` (`Fk_articleId`),
  ADD KEY `Fk_typeId` (`Fk_typeId`);

--
-- Indexes for table `associate`
--
ALTER TABLE `associate`
  ADD PRIMARY KEY (`Pk_assocId`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`Pk_brandId`);

--
-- Indexes for table `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`Pk_conditionsId`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`Pk_countryId`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fundcluster`
--
ALTER TABLE `fundcluster`
  ADD PRIMARY KEY (`Pk_fundClusterId`);

--
-- Indexes for table `ics_details`
--
ALTER TABLE `ics_details`
  ADD PRIMARY KEY (`Pk_icsDetails`),
  ADD KEY `Fk_fundClusterId` (`Fk_fundClusterId`);

--
-- Indexes for table `ics_no`
--
ALTER TABLE `ics_no`
  ADD PRIMARY KEY (`Pk_icsNumId`);

--
-- Indexes for table `ics_series`
--
ALTER TABLE `ics_series`
  ADD PRIMARY KEY (`Pk_icsId`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`Pk_inventoryId`),
  ADD KEY `inventories_fk_itemid_foreign` (`Fk_itemId`),
  ADD KEY `inventories_fk_conditionsid_foreign` (`Fk_conditionsId`),
  ADD KEY `inventories_fk_locatmanid_foreign` (`Fk_locatmanId`),
  ADD KEY `Fk_propertyId` (`Fk_propertyId`),
  ADD KEY `Fk_item_relationId` (`Fk_item_relationId`);

--
-- Indexes for table `itemcateg`
--
ALTER TABLE `itemcateg`
  ADD PRIMARY KEY (`Pk_itemCategId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Pk_itemId`),
  ADD KEY `items_fk_typeid_foreign` (`Fk_article_relationId`),
  ADD KEY `items_fk_statusid_foreign` (`Fk_statusId`),
  ADD KEY `items_fk_manuid_foreign` (`Fk_manuId`),
  ADD KEY `items_fk_supplierid_foreign` (`Fk_supplierId`),
  ADD KEY `items_fk_unitid_foreign` (`Fk_unitId`),
  ADD KEY `items_fk_varietyid_foreign` (`Fk_varietyId`),
  ADD KEY `items_fk_brandid_foreign` (`Fk_brandId`),
  ADD KEY `items_fk_countryid_foreign` (`Fk_countryId`),
  ADD KEY `items_fk_sourcemodeid_foreign` (`Fk_sourcemodeId`),
  ADD KEY `items_fk_itemcategid_foreign` (`Fk_itemCategId`),
  ADD KEY `Fk_fundClusterId` (`item_name`);

--
-- Indexes for table `item_relation`
--
ALTER TABLE `item_relation`
  ADD PRIMARY KEY (`Pk_item_relationId`),
  ADD KEY `Fk_icsNumId` (`Fk_icsNumId`),
  ADD KEY `Fk_parNumId` (`Fk_parNumId`),
  ADD KEY `Fk_poId` (`Fk_poId`),
  ADD KEY `Fk_parDetailsId` (`Fk_parDetailsId`),
  ADD KEY `Fk_icsDetailsId` (`Fk_icsDetailsId`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`Pk_locationId`);

--
-- Indexes for table `locat_man`
--
ALTER TABLE `locat_man`
  ADD PRIMARY KEY (`Pk_locatmanId`),
  ADD KEY `locat_man_fk_associd_foreign` (`Fk_assocId`),
  ADD KEY `locat_man_fk_locationid_foreign` (`Fk_locationId`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`Pk_manuId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `par_details`
--
ALTER TABLE `par_details`
  ADD PRIMARY KEY (`Pk_parDetails`),
  ADD KEY `Fk_fundClusterId` (`Fk_fundClusterId`);

--
-- Indexes for table `par_no`
--
ALTER TABLE `par_no`
  ADD PRIMARY KEY (`Pk_parNumId`);

--
-- Indexes for table `par_series`
--
ALTER TABLE `par_series`
  ADD PRIMARY KEY (`Pk_parId`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `po_number`
--
ALTER TABLE `po_number`
  ADD PRIMARY KEY (`Pk_poId`);

--
-- Indexes for table `propertyno`
--
ALTER TABLE `propertyno`
  ADD PRIMARY KEY (`Pk_propertyId`),
  ADD KEY `Fk_icsId` (`Fk_icsId`),
  ADD KEY `Fk_parId` (`Fk_parId`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`Pk_statusId`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`Pk_supplierId`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`Pk_typeId`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`Pk_unitId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `variety`
--
ALTER TABLE `variety`
  ADD PRIMARY KEY (`Pk_varietyId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acquimode`
--
ALTER TABLE `acquimode`
  MODIFY `Pk_aquisModeId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acquisition`
--
ALTER TABLE `acquisition`
  MODIFY `Pk_acquisitionId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acquisource`
--
ALTER TABLE `acquisource`
  MODIFY `Pk_sourceId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `Pk_articleId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `article_relation`
--
ALTER TABLE `article_relation`
  MODIFY `Pk_article_relationId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `associate`
--
ALTER TABLE `associate`
  MODIFY `Pk_assocId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `Pk_brandId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `conditions`
--
ALTER TABLE `conditions`
  MODIFY `Pk_conditionsId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `Pk_countryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fundcluster`
--
ALTER TABLE `fundcluster`
  MODIFY `Pk_fundClusterId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ics_details`
--
ALTER TABLE `ics_details`
  MODIFY `Pk_icsDetails` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ics_no`
--
ALTER TABLE `ics_no`
  MODIFY `Pk_icsNumId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ics_series`
--
ALTER TABLE `ics_series`
  MODIFY `Pk_icsId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `Pk_inventoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `itemcateg`
--
ALTER TABLE `itemcateg`
  MODIFY `Pk_itemCategId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Pk_itemId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_relation`
--
ALTER TABLE `item_relation`
  MODIFY `Pk_item_relationId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `Pk_locationId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locat_man`
--
ALTER TABLE `locat_man`
  MODIFY `Pk_locatmanId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `Pk_manuId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `par_details`
--
ALTER TABLE `par_details`
  MODIFY `Pk_parDetails` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `par_no`
--
ALTER TABLE `par_no`
  MODIFY `Pk_parNumId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `par_series`
--
ALTER TABLE `par_series`
  MODIFY `Pk_parId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `po_number`
--
ALTER TABLE `po_number`
  MODIFY `Pk_poId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `propertyno`
--
ALTER TABLE `propertyno`
  MODIFY `Pk_propertyId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `Pk_statusId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `Pk_supplierId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `Pk_typeId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `Pk_unitId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `variety`
--
ALTER TABLE `variety`
  MODIFY `Pk_varietyId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acquimode`
--
ALTER TABLE `acquimode`
  ADD CONSTRAINT `acquimode_fk_aquisid_foreign` FOREIGN KEY (`Fk_aquisId`) REFERENCES `acquisition` (`Pk_acquisitionId`),
  ADD CONSTRAINT `acquimode_fk_sourceid_foreign` FOREIGN KEY (`Fk_sourceId`) REFERENCES `acquisource` (`Pk_sourceId`);

--
-- Constraints for table `article_relation`
--
ALTER TABLE `article_relation`
  ADD CONSTRAINT `article_relation_ibfk_1` FOREIGN KEY (`Fk_articleId`) REFERENCES `articles` (`Pk_articleId`),
  ADD CONSTRAINT `article_relation_ibfk_2` FOREIGN KEY (`Fk_typeId`) REFERENCES `types` (`Pk_typeId`);

--
-- Constraints for table `ics_details`
--
ALTER TABLE `ics_details`
  ADD CONSTRAINT `ics_details_ibfk_1` FOREIGN KEY (`Fk_fundClusterId`) REFERENCES `fundcluster` (`Pk_fundClusterId`);

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_fk_conditionsid_foreign` FOREIGN KEY (`Fk_conditionsId`) REFERENCES `conditions` (`Pk_conditionsId`),
  ADD CONSTRAINT `inventories_fk_itemid_foreign` FOREIGN KEY (`Fk_itemId`) REFERENCES `items` (`Pk_itemId`),
  ADD CONSTRAINT `inventories_fk_locatmanid_foreign` FOREIGN KEY (`Fk_locatmanId`) REFERENCES `locat_man` (`Pk_locatmanId`),
  ADD CONSTRAINT `inventories_ibfk_1` FOREIGN KEY (`Fk_propertyId`) REFERENCES `propertyno` (`Pk_propertyId`),
  ADD CONSTRAINT `inventories_ibfk_2` FOREIGN KEY (`Fk_item_relationId`) REFERENCES `item_relation` (`Pk_item_relationId`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_fk_brandid_foreign` FOREIGN KEY (`Fk_brandId`) REFERENCES `brands` (`Pk_brandId`),
  ADD CONSTRAINT `items_fk_countryid_foreign` FOREIGN KEY (`Fk_countryId`) REFERENCES `countries` (`Pk_countryId`),
  ADD CONSTRAINT `items_fk_manuid_foreign` FOREIGN KEY (`Fk_manuId`) REFERENCES `manufacturers` (`Pk_manuId`),
  ADD CONSTRAINT `items_fk_sourcemodeid_foreign` FOREIGN KEY (`Fk_sourcemodeId`) REFERENCES `acquisource` (`Pk_sourceId`),
  ADD CONSTRAINT `items_fk_statusid_foreign` FOREIGN KEY (`Fk_statusId`) REFERENCES `status` (`Pk_statusId`),
  ADD CONSTRAINT `items_fk_supplierid_foreign` FOREIGN KEY (`Fk_supplierId`) REFERENCES `suppliers` (`Pk_supplierId`),
  ADD CONSTRAINT `items_fk_typeid_foreign` FOREIGN KEY (`Fk_article_relationId`) REFERENCES `article_relation` (`Pk_article_relationId`),
  ADD CONSTRAINT `items_fk_unitid_foreign` FOREIGN KEY (`Fk_unitId`) REFERENCES `units` (`Pk_unitId`),
  ADD CONSTRAINT `items_fk_varietyid_foreign` FOREIGN KEY (`Fk_varietyId`) REFERENCES `variety` (`Pk_varietyId`),
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`Fk_itemCategId`) REFERENCES `itemcateg` (`Pk_itemCategId`);

--
-- Constraints for table `item_relation`
--
ALTER TABLE `item_relation`
  ADD CONSTRAINT `item_relation_ibfk_2` FOREIGN KEY (`Fk_icsNumId`) REFERENCES `ics_no` (`Pk_icsNumId`),
  ADD CONSTRAINT `item_relation_ibfk_4` FOREIGN KEY (`Fk_parNumId`) REFERENCES `par_no` (`Pk_parNumId`),
  ADD CONSTRAINT `item_relation_ibfk_5` FOREIGN KEY (`Fk_poId`) REFERENCES `po_number` (`Pk_poId`),
  ADD CONSTRAINT `item_relation_ibfk_6` FOREIGN KEY (`Fk_parDetailsId`) REFERENCES `par_details` (`Pk_parDetails`),
  ADD CONSTRAINT `item_relation_ibfk_7` FOREIGN KEY (`Fk_icsDetailsId`) REFERENCES `ics_details` (`Pk_icsDetails`);

--
-- Constraints for table `locat_man`
--
ALTER TABLE `locat_man`
  ADD CONSTRAINT `locat_man_fk_associd_foreign` FOREIGN KEY (`Fk_assocId`) REFERENCES `associate` (`Pk_assocId`),
  ADD CONSTRAINT `locat_man_fk_locationid_foreign` FOREIGN KEY (`Fk_locationId`) REFERENCES `location` (`Pk_locationId`);

--
-- Constraints for table `par_details`
--
ALTER TABLE `par_details`
  ADD CONSTRAINT `par_details_ibfk_1` FOREIGN KEY (`Fk_fundClusterId`) REFERENCES `fundcluster` (`Pk_fundClusterId`);

--
-- Constraints for table `propertyno`
--
ALTER TABLE `propertyno`
  ADD CONSTRAINT `propertyno_ibfk_1` FOREIGN KEY (`Fk_icsId`) REFERENCES `ics_series` (`Pk_icsId`),
  ADD CONSTRAINT `propertyno_ibfk_2` FOREIGN KEY (`Fk_parId`) REFERENCES `par_series` (`Pk_parId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
