-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2025 at 02:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `service_request`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_tab_2`
--

CREATE TABLE `category_tab_2` (
  `category_id` int(11) NOT NULL,
  `category_value` varchar(255) NOT NULL,
  `main_category` varchar(255) NOT NULL,
  `agentunit_id` int(11) NOT NULL,
  `repairtype_id` int(11) NOT NULL,
  `category_icon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_tab_2`
--

INSERT INTO `category_tab_2` (`category_id`, `category_value`, `main_category`, `agentunit_id`, `repairtype_id`, `category_icon`, `created_at`, `updated_at`) VALUES
(1, 'Repair of IT Equipment', '', 2, 2, 'bi bi-hdd-network-fill', NULL, NULL),
(3, 'System Enhancement / Modification / Homis / Other Installation', '', 2, 4, 'bi bi-pc-display', NULL, NULL),
(4, 'HOMIS Encoding Error', '', 2, 2, 'bi bi-keyboard-fill', NULL, NULL),
(6, 'Network Installation / Internet Connection / Cable Transfer', '', 2, 2, 'bi bi-wifi', NULL, NULL),
(7, 'Website Uploads', '', 2, 5, 'bi bi-cloud-arrow-up-fill', NULL, NULL),
(8, 'Technical Assistance', '', 2, 1, 'bi bi-people-fill', NULL, NULL),
(10, 'Training - Orientation / Computer Literacy', '', 2, 4, 'bi bi-person-badge', NULL, NULL),
(11, 'User Account Management', '', 2, 1, 'bi bi-person-gear', NULL, NULL),
(12, 'Biometrics Enrollment', '', 2, 3, 'bi bi-fingerprint', NULL, NULL),
(13, 'VMC ID Card Preparation', '', 2, 3, 'bi bi-person-vcard', NULL, NULL),
(30, 'Zoom Link', '', 2, 1, 'bi bi-wechat', NULL, NULL),
(33, 'Others', '', 2, 2, 'bi bi-patch-question', NULL, NULL),
(34, 'Repair of Medical Equipment', '', 1, 4, 'bi bi-prescription2', NULL, NULL),
(35, 'Repair of Office Equipment', '', 1, 4, 'bi bi-pen-fill', NULL, NULL),
(36, 'Repair of Architectural Works', '', 1, 4, 'bi bi-buildings', NULL, NULL),
(37, 'Repair of Civil Works', '', 1, 4, 'bi bi-motherboard', NULL, NULL),
(38, 'Repair of Electrical Works', '', 1, 4, 'bi bi-ev-station', NULL, NULL),
(39, 'Repair of Plumbing Works', '', 1, 4, 'bi bi-wrench', NULL, NULL),
(40, 'Technical Assistance', '', 1, 4, 'bi bi-people-fill', NULL, NULL),
(41, 'Others', '', 1, 4, 'bi bi-patch-question', NULL, NULL),
(42, 'Travel Conduction', '', 1, 4, 'bi bi-airplane', NULL, NULL),
(43, 'Plumbing Repair', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-wrench-adjustable\r\n', NULL, NULL),
(44, 'Sanitary Repair', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-bandaid\r\n', NULL, NULL),
(45, 'Electrical Repair', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-ev-station\r\n', NULL, NULL),
(46, 'Emergency / Hazard Repair', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-exclamation-diamond\r\n', NULL, NULL),
(47, 'Architectural Repair', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-buildings\r\n', NULL, NULL),
(48, 'Carpentry Repair', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-hammer\r\n', NULL, NULL),
(49, 'Masonry Repair', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-bricks\r\n', NULL, NULL),
(50, 'Electrical / Plumbing / Sanitary Installation', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-columns-gap\r\n', NULL, NULL),
(51, 'Steel / Welding Repair', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-magic\r\n', NULL, NULL),
(52, 'Signages', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-signpost\r\n', NULL, NULL),
(53, 'Office / Hospital Furniture', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-lamp\r\n', NULL, NULL),
(54, 'Office Equipment', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-pen-fill\r\n', NULL, NULL),
(55, 'Renovation', 'BUILDING GROUND MAINTENANCE', 1, 4, 'bi bi-recycle\r\n', NULL, NULL),
(56, 'Cleaning', 'GENERAL SERVICE', 1, 4, 'bi bi-trash2-fill\r\n', NULL, NULL),
(57, 'Linen Request', 'GENERAL SERVICE', 1, 4, 'bi bi-square-half\r\n', NULL, NULL),
(58, 'Air Condition Repair', 'GENERAL SERVICE', 1, 4, 'bi bi-window-dock\r\n', NULL, NULL),
(59, 'Refrigiration Repair', 'GENERAL SERVICE', 1, 4, 'bi bi-terminal-split\r\n', NULL, NULL),
(60, 'Ventillation / Blower Repair', 'GENERAL SERVICE', 1, 4, 'bi bi-wind\r\n', NULL, NULL),
(61, 'Chair & Tables', 'GENERAL SERVICE', 1, 4, 'bi bi-balloon-fill\r\n', NULL, NULL),
(62, 'Pest Control', 'GENERAL SERVICE', 1, 4, 'bi bi-bug-fill\r\n', NULL, NULL),
(63, 'Linen Repair', 'GENERAL SERVICE', 1, 4, 'bi bi-square-fill\r\n', NULL, NULL),
(64, 'Linen Fabrication', 'GENERAL SERVICE', 1, 4, 'bi bi-filter-square-fill\r\n', NULL, NULL),
(65, 'Labelling', 'GENERAL SERVICE', 1, 4, 'bi bi-bookmarks\r\n', NULL, NULL),
(66, 'Visitor Request', 'GENERAL SERVICE', 1, 4, 'bi bi-person-standing\r\n', NULL, NULL),
(67, 'Request Under Security Management', 'GENERAL SERVICE', 1, 4, 'bi bi-shield-lock-fill\r\n', NULL, NULL),
(68, 'Air Condition Installation', 'GENERAL SERVICE', 1, 4, 'bi bi-window-stack\r\n', NULL, NULL),
(69, 'Ventillation / Blower Installation', 'GENERAL SERVICE', 1, 4, 'bi bi-fan\r\n', NULL, NULL),
(70, 'Medical Equipment (IN-HOUSE REPAIR)', 'BIOMEDICAL', 1, 4, 'bi bi-prescription2\r\n', NULL, NULL),
(71, 'Medical Equipment (IN-HOUSE REPAIR & SUPPLY)', 'BIOMEDICAL', 1, 4, 'bi bi-prescription\r\n', NULL, NULL),
(72, 'Supply & Repair Of Medical Equipment (BIG TICKET)', 'BIOMEDICAL', 1, 4, 'bi bi-hospital\r\n', NULL, NULL),
(73, 'Basic Life Support', 'TRANSPORT', 1, 4, 'bi bi-heart-pulse\r\n', NULL, NULL),
(74, 'Advance Life Support', 'TRANSPORT', 1, 4, 'bi bi-heart-pulse-fill\r\n', NULL, NULL),
(75, 'Employee Transport', 'TRANSPORT', 1, 4, 'bi bi-car-front', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_tab_2`
--
ALTER TABLE `category_tab_2`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_tab_2`
--
ALTER TABLE `category_tab_2`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
