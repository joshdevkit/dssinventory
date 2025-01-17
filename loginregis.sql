-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2024 at 02:08 PM
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
-- Database: `loginregis`
--

-- --------------------------------------------------------

--
-- Table structure for table `computer_engineering`
--

CREATE TABLE `computer_engineering` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_acquired` date NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `computer_engineering`
--

INSERT INTO `computer_engineering` (`id`, `equipment`, `brand`, `quantity`, `date_acquired`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'A.C. Synchronous Generator', 'BALDOR, USA', 1, '2003-05-31', 'unit', '2024-06-07 04:29:36', '2024-06-07 04:29:36'),
(2, 'Antenna Trainer', 'AT 1001', 1, '2006-08-25', 'set', '2024-06-07 04:33:00', '2024-06-07 04:33:00'),
(3, 'Simple Dipole λ/2 antenna', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 15:43:43', '2024-06-07 15:53:30'),
(4, 'Simple Dipole λ/4 antenna', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 15:49:53', '2024-06-07 15:53:40'),
(5, 'Simple Dipole 3/λ antenna', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 15:50:43', '2024-06-07 15:53:50'),
(6, 'Folded Dipole', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 15:52:40', '2024-06-07 15:52:40'),
(7, 'Yagi Uda Folded Dipole (3E)', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 15:54:48', '2024-06-07 15:54:48'),
(8, 'Yagi Uda Simple Dipole (5E)', 'AT 1001', 1, '2006-08-25', 'pcs', '2024-06-07 15:55:49', '2024-06-07 15:56:05'),
(9, 'Yagi Uda Simple (7E)', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 15:57:39', '2024-06-07 15:57:39'),
(10, 'Yagi Uda Folded Dipole (5E)', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 15:59:31', '2024-06-07 15:59:31'),
(11, 'Ground Plane Antenna', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:00:06', '2024-06-07 16:00:06'),
(12, 'Slot Antenna λ/', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:01:02', '2024-06-07 16:01:02'),
(13, 'Loop Antenna', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:02:17', '2024-06-07 16:02:17'),
(14, 'Rhombus Antenna', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:02:57', '2024-06-07 16:02:57'),
(15, 'Helix Antenna', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:03:40', '2024-06-07 16:03:40'),
(16, 'Phase Array λ/2 Antenna', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:04:28', '2024-06-07 16:04:28'),
(17, 'Phase Array λ/4 Antenna', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:05:02', '2024-06-07 16:05:02'),
(18, 'Broad Side Array', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:05:39', '2024-06-07 16:05:39'),
(19, 'Combined Collinear Array', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:06:11', '2024-06-07 16:06:11'),
(20, 'Log Periodic Antenna', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:07:01', '2024-06-07 16:07:01'),
(21, 'Simple Dipole Cut Paraboloid Antenna', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:09:00', '2024-06-07 16:09:00'),
(22, 'Zeppline Antenna (Hor. end Fed)', 'AT 1001', 1, '2006-08-25', 'unit', '2024-06-07 16:09:52', '2024-06-07 16:09:52'),
(23, 'Audio Generator', 'Wheeler', 4, '2004-08-08', 'unit', '2024-06-07 16:11:05', '2024-06-07 16:11:05'),
(24, 'Basic Electricity & Electronics EEC471-2', 'Feedback', 1, '1999-07-08', 'unit', '2024-06-07 16:12:26', '2024-06-07 16:12:26'),
(25, 'Breadboard (big w/4 terminals)', 'MIYAMA 0049', 5, '2005-02-19', 'pcs', '2024-06-07 16:13:36', '2024-06-07 16:13:36'),
(26, 'Breadboard (small)', '-', 5, '2005-02-19', 'pcs', '2024-06-07 16:28:17', '2024-06-07 16:28:17'),
(27, 'Breadboard', 'MIYAMA 0023', 4, '2005-02-19', 'pcs', '2024-06-07 16:33:42', '2024-06-07 16:33:42'),
(28, 'Clamp Meter, Digital', 'DT/DM 6266', 2, '2005-08-13', 'pcs', '2024-06-07 16:34:35', '2024-06-07 16:34:35'),
(29, 'Clamp Meter', 'National', 1, '2005-08-13', 'pcs', '2024-06-07 16:35:10', '2024-06-07 16:35:10'),
(30, 'Compound DC Generator', 'BALDOR, USA', 1, '2003-05-31', 'unit', '2024-06-07 16:35:59', '2024-06-07 16:35:59'),
(31, 'Connectors, Assorted', '-', 1, '1999-07-08', 'box', '2024-06-07 16:37:12', '2024-06-07 16:37:12'),
(32, 'Desoldering Pump', '-', 1, '2005-02-19', 'pcs', '2024-06-07 16:37:53', '2024-06-07 16:37:53'),
(33, 'Digital Logic Trainer (CMOS) Logic Trainer Board (based on 74)/4000 series', 'Omega LTB 842', 1, '2005-12-08', 'unit', '2024-06-07 16:39:22', '2024-06-07 16:39:22'),
(34, 'Digital Logic Trainer (TTL) Logic Trainer Board (based on 74 series)', 'Omega LTB 841', 1, '2006-12-08', 'unit', '2024-06-07 16:43:15', '2024-06-07 16:43:15'),
(35, 'Electricity & Electronics Constructor EEC470', 'Feedback', 1, '1999-07-08', 'unit', '2024-06-07 16:44:21', '2024-06-07 16:44:21'),
(36, 'Drill', 'Bionic', 5, '2005-02-19', 'unit', '2024-06-07 16:44:56', '2024-06-07 16:44:56'),
(37, 'Electronics Component Kit', 'Plastic', 6, '2002-08-28', 'box', '2024-06-07 16:45:55', '2024-06-07 16:45:55'),
(38, 'ETW-500 Base Communication Trainer', 'Heatkit', 1, '2001-09-14', 'set', '2024-06-07 16:46:51', '2024-06-07 16:46:51'),
(39, 'ETB-551A Electronics Communications', 'Heatkit', 1, '2001-09-14', 'set', '2024-06-07 16:47:59', '2024-06-07 16:47:59'),
(41, 'ETB-553 Wireless Comm. Fundamentals', 'Heatkit', 1, '2001-09-14', 'set', '2024-06-07 22:46:08', '2024-06-07 22:46:08'),
(42, 'ETB-554A Wireless System', 'Heatkit', 1, '2001-09-14', 'set', '2024-06-07 22:46:44', '2024-06-07 22:46:44'),
(43, 'ETW-3567 Accessory Backpack', 'Heatkit', 1, '2021-09-14', 'set', '2024-06-07 22:47:18', '2024-06-07 22:47:18'),
(44, 'Fiber Optic Trainer', 'Type 007', 4, '2007-09-19', 'set', '2024-06-07 22:47:55', '2024-06-07 22:47:55'),
(45, 'Frequency Counter', 'Sinometer', 4, '2004-08-08', 'unit', '2024-06-07 22:48:35', '2024-06-07 22:48:35'),
(46, 'Frequency Counter', 'Sinometer', 1, '2005-05-19', 'unit', '2024-06-07 22:49:04', '2024-06-07 22:49:04'),
(47, 'Insulation Tester', 'SDAR', 1, '2004-08-08', 'unit', '2024-06-07 22:49:37', '2024-06-07 22:49:37'),
(48, 'Interfacing CMOS to TTL & TTL to CMOS IC\'s', 'Omega LTE 865', 1, '2006-12-08', 'unit', '2024-06-07 22:50:47', '2024-06-07 22:50:47'),
(49, 'Logic Probe', 'Japan', 1, '1999-07-08', 'unit', '2024-06-07 22:51:25', '2024-06-07 22:51:25'),
(50, 'Logic Tutor LT 345', 'Feedback', 1, '1999-07-08', 'unit', '2024-06-07 22:52:03', '2024-06-07 22:52:03'),
(51, 'Microprocessor Trainer 8085', 'Intel', 4, '2005-12-08', 'set', '2024-06-07 22:52:39', '2024-06-07 22:52:39'),
(52, 'Study Card (Elevator)', 'Intel', 4, '2005-08-13', 'pcs', '2024-06-07 22:53:17', '2024-06-07 22:53:17'),
(53, 'Study Card (Traffic Light)', 'Intel', 4, '2005-08-13', 'pcs', '2024-06-07 22:53:52', '2024-06-07 22:53:52'),
(54, 'Supply adaptor', 'DMS SMPS -01A', 4, '2005-08-13', 'pcs', '2024-06-07 22:54:37', '2024-06-07 22:54:37'),
(55, 'Magnitude Comparator, 4 Bit', 'Omega LTB 870', 1, '2006-12-08', 'unit', '2024-06-07 22:56:47', '2024-06-07 22:56:47'),
(57, 'Monoshot Multivibrator', 'Omega LTB 838', 1, '2006-12-08', 'unit', '2024-06-07 22:57:36', '2024-06-07 22:57:36'),
(59, 'Multiplying Digital to Analog Converter, 8 Bit', 'Omega LTB 833', 1, '2006-12-08', 'unit', '2024-06-07 22:59:22', '2024-06-07 22:59:22'),
(60, 'Osciloscope', 'Wheelers', 2, '1999-07-08', 'pcs', '2024-06-07 23:00:45', '2024-06-07 23:08:58'),
(61, 'Osciloscope', 'Sinometer, YB 4368', 2, '2004-06-09', 'unit', '2024-06-07 23:01:39', '2024-06-07 23:01:39'),
(62, 'Osciloscope', 'Tektronix TDS 2012', 1, '2006-07-08', 'set', '2024-06-07 23:02:24', '2024-06-07 23:02:24'),
(63, 'PLC Logo', 'Siemens', 2, '2005-09-23', 'unit', '2024-06-07 23:03:02', '2024-06-07 23:03:02'),
(64, 'Programmable Timer 8253', 'Omega LTB 848', 1, '2006-12-08', 'unit', '2024-06-07 23:03:42', '2024-06-07 23:03:42'),
(65, 'Programmable Peripheral Interface', 'Omega LTB 847', 1, '2006-12-08', 'unit', '2024-06-07 23:04:22', '2024-06-07 23:04:22'),
(66, 'Potentiometer', 'RP', 10, '1999-07-08', 'pcs', '2024-06-07 23:04:58', '2024-06-07 23:04:58'),
(67, 'Power Supply PS 445', 'Feedback', 1, '1999-07-08', 'unit', '2024-06-07 23:05:31', '2024-06-07 23:05:31'),
(68, 'Power Supply, Dc', 'Wheeler', 6, '2004-08-08', 'unit', '2024-06-07 23:06:18', '2024-06-07 23:06:18'),
(69, 'Power Supply, Dc', 'Sinometer', 3, '2005-02-19', 'unit', '2024-06-07 23:06:48', '2024-06-07 23:06:48'),
(70, 'Power Supply, Dc', 'Sinometer', 1, '2006-07-08', 'pcs', '2024-06-07 23:07:08', '2024-06-07 23:09:41'),
(71, 'Power Supply, 3Phase', 'BALDOR, USA', 1, '2003-05-31', 'unit', '2024-06-07 23:07:42', '2024-06-07 23:07:42'),
(72, 'Static Random Access Memory (2102), 1024 x 1 Bit', 'Omega LTB 852', 1, '2006-12-08', 'unit', '2024-06-07 23:12:09', '2024-06-07 23:12:09'),
(73, 'Static Random Access Memory (7489), 16 x 4 Bit', 'Omega LTB 851', 1, '2006-12-08', 'unit', '2024-06-07 23:12:52', '2024-06-07 23:12:52'),
(74, 'Surge Protector', 'Taiwan', 2, '2004-06-09', 'pcs', '2024-06-07 23:13:29', '2024-06-07 23:13:29'),
(75, 'Tester (multi) Analog', 'Sunwa', 6, '2004-06-09', 'pcs', '2024-06-07 23:14:24', '2024-06-07 23:14:24'),
(76, 'Tester (multi) Analog', '7040', 1, '2006-07-08', 'pcs', '2024-06-07 23:14:55', '2024-06-07 23:14:55'),
(77, 'Tester (multi) digital', 'Mastech MS 8221A', 7, '2006-07-08', 'pcs', '2024-06-07 23:15:38', '2024-06-07 23:15:38'),
(78, 'Tester (multi) digital', 'Mastech MY61', 4, '2006-07-08', 'pcs', '2024-06-07 23:16:12', '2024-06-07 23:16:12'),
(79, 'Tweezer set', '-', 1, '2002-08-28', 'pcs', '2024-06-07 23:16:50', '2024-06-07 23:16:50'),
(80, 'Tachometer, digital', 'DT 2234B', 1, '2004-06-09', 'unit', '2024-06-07 23:17:33', '2024-06-07 23:17:33'),
(81, 'Universal Shift Register', 'Omega LTB 839', 1, '2006-12-08', 'unit', '2024-06-07 23:18:15', '2024-06-07 23:18:15'),
(82, 'Transformer Transistor', '-', 4, '2004-06-09', 'pcs', '2024-06-07 23:19:05', '2024-06-07 23:19:05'),
(83, 'Variable AC Supply (Variac)', 'Hossoni', 5, '2004-06-09', 'unit', '2024-06-07 23:19:49', '2024-06-07 23:19:49'),
(84, 'Wattmeter AC', 'Nippen', 4, '2004-05-31', 'pcs', '2024-06-07 23:20:27', '2024-06-07 23:24:02'),
(85, 'Wattmeter/Digital Power Meter', 'Omega', 4, '2006-12-08', 'pcs', '2024-06-07 23:20:58', '2024-06-07 23:20:58'),
(86, 'Z80 Trainer', 'Feedback', 1, '1999-07-08', 'unit', '2024-06-07 23:21:24', '2024-06-07 23:21:24'),
(87, 'Sample item', 'Moderna', 6, '2024-09-16', 'unit', '2024-09-16 06:03:26', '2024-09-16 17:19:01');

-- --------------------------------------------------------

--
-- Table structure for table `computer_engineering_serials`
--

CREATE TABLE `computer_engineering_serials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `computer_engineering_serials`
--

INSERT INTO `computer_engineering_serials` (`id`, `product_id`, `serial_no`, `condition`, `created_at`, `updated_at`) VALUES
(1, 87, 'JK-11-1029', 'For Upgrading', '2024-09-16 06:03:26', '2024-09-16 17:14:22'),
(2, 87, 'JK-11-1030', 'For Upgrading', '2024-09-16 06:03:26', '2024-09-16 17:14:22'),
(5, 87, 'JK-11-1031', 'Good', '2024-09-16 17:18:19', '2024-09-16 17:18:19'),
(6, 87, 'JK-11-1032', 'For Repair', '2024-09-16 17:18:19', '2024-09-16 17:18:19'),
(7, 87, 'JK-11-1033', 'For Upgrading', '2024-09-16 17:18:19', '2024-09-16 17:18:19'),
(8, 87, 'JK-11-1034', 'Good', '2024-09-16 17:19:01', '2024-09-16 17:19:01');

-- --------------------------------------------------------

--
-- Table structure for table `construction`
--

CREATE TABLE `construction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_acquired` date NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `construction`
--

INSERT INTO `construction` (`id`, `equipment`, `brand`, `quantity`, `date_acquired`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'Acetylene', 'Pro lotus USA', 1, '2001-10-17', 'unit', '2024-06-08 06:17:38', '2024-06-08 06:17:38'),
(2, 'Auger Bit', '-', 2, '1985-12-07', 'pcs', '2024-06-08 06:18:34', '2024-06-08 06:18:34'),
(3, 'Bits & Braces', 'China', 4, '1985-12-07', 'unit', '2024-06-08 06:19:05', '2024-06-08 06:19:05'),
(4, 'Blow Torch', 'China', 1, '1993-08-07', 'unit', '2024-06-08 06:19:53', '2024-06-08 06:19:53'),
(5, 'Carborundum 8\"', 'England', 1, '1985-12-07', 'pcs', '2024-06-08 06:20:49', '2024-06-08 06:20:49'),
(6, 'Carborundum circular', 'diamond', 5, '1985-12-07', 'pcs', '2024-06-08 06:21:23', '2024-06-08 06:21:23'),
(7, 'Carpenter\'s Bar Clamp', 'RP Standard', 3, '1985-12-07', 'pcs', '2024-06-08 06:22:09', '2024-06-08 06:22:09'),
(8, 'Carpenter\'s level', '-', 4, '1989-11-17', 'pcs', '2024-06-08 06:22:33', '2024-06-08 06:22:33'),
(9, 'C-clamp', 'Malleable', 1, '1985-12-07', 'pcs', '2024-06-08 06:23:11', '2024-06-08 06:23:11'),
(10, 'C-clamp', 'Malleable', 1, '1985-12-07', 'pcs', '2024-06-08 06:23:39', '2024-06-08 06:23:39'),
(11, 'C-clamp', 'Malleable', 1, '1985-12-07', 'pcs', '2024-06-08 06:23:54', '2024-06-08 06:23:54'),
(12, 'Chisel, flat', 'China', 1, '1985-12-07', 'pcs', '2024-06-08 06:25:21', '2024-06-08 06:25:21'),
(13, 'Chisel, pointed', 'China', 1, '1985-12-07', 'pcs', '2024-06-08 06:25:48', '2024-06-08 06:25:48'),
(14, 'Chisel, 1\"', 'China', 1, '1985-12-07', 'pcs', '2024-06-08 06:26:15', '2024-06-08 06:26:15'),
(15, 'Chisel, 1 1/2\"', 'China', 3, '1985-12-07', 'pcs', '2024-06-08 06:26:52', '2024-06-08 06:26:52'),
(16, 'Chisel, 1 3/4\"', 'China', 4, '1985-12-07', 'pcs', '2024-06-08 06:27:37', '2024-06-08 06:27:37'),
(17, 'Chisel, 1/2\"', 'China', 3, '1985-12-07', 'pcs', '2024-06-08 06:28:30', '2024-06-08 06:28:30'),
(18, 'Chisel, 1/2\"', 'China', 3, '1985-12-07', 'pcs', '2024-06-08 06:28:31', '2024-06-08 06:28:31'),
(19, 'Chisel, 1/4\"', 'China', 2, '1985-12-07', 'pcs', '2024-06-08 06:29:02', '2024-06-08 06:29:02'),
(20, 'Chisel, 1/8\"', 'China', 1, '1985-12-07', 'pcs', '2024-06-08 06:29:35', '2024-06-08 06:29:35'),
(21, 'Chisel, 3/8\"', 'China', 2, '1985-12-07', 'pcs', '2024-06-08 06:29:59', '2024-06-08 06:29:59'),
(22, 'Chisel, 5/8\"', 'China', 1, '1985-12-07', 'pcs', '2024-06-08 06:30:27', '2024-06-08 06:30:27'),
(23, 'Combination Square', 'Buffalo', 2, '2002-01-27', 'pcs', '2024-06-08 06:31:15', '2024-06-08 06:31:15'),
(24, 'Coping saw', 'Eagle, USA', 1, '2001-10-17', 'set', '2024-06-08 06:31:52', '2024-06-08 06:31:52'),
(25, 'Chisel, pointed', 'Japan', 1, '2002-01-29', 'pcs', '2024-06-08 06:32:23', '2024-06-08 06:32:23'),
(26, 'Chisel, flat', 'Japan', 1, '2002-01-29', 'pcs', '2024-06-08 06:32:53', '2024-06-08 06:32:53'),
(27, 'Drill Press', 'WYS Machine', 1, '1999-12-02', '-', '2024-06-08 06:33:39', '2024-06-08 06:33:39'),
(28, 'Disc Grinder', 'Makita, Japan', 1, '1985-12-07', 'pcs', '2024-06-08 06:35:27', '2024-06-08 06:37:50'),
(29, 'Electric Drill', 'Makita, Japan', 1, '1985-12-07', 'pcs', '2024-06-08 06:36:05', '2024-06-08 06:38:07'),
(30, 'File, flat smooth 10\"', 'USA', 1, '1985-12-07', 'pcs', '2024-06-08 06:39:09', '2024-06-08 06:39:09'),
(31, 'File, Triangular', 'USA', 1, '1985-12-07', 'pcs', '2024-06-08 14:30:01', '2024-06-08 14:30:01'),
(32, 'File, wood rasp 12\"', 'USA', 2, '1985-12-07', 'pcs', '2024-06-08 14:32:53', '2024-06-08 14:32:53'),
(33, 'File, wood rasp 10\"', 'USA', 2, '1985-12-07', 'pcs', '2024-06-08 14:33:58', '2024-06-08 14:33:58'),
(34, 'File, wood rasp 8\"', 'USA', 1, '1985-12-07', 'pcs', '2024-06-08 14:34:55', '2024-06-08 14:34:55'),
(35, 'File, wood rasp 8\"', 'USA', 1, '1985-12-07', 'pcs', '2024-06-08 14:34:56', '2024-06-08 14:34:56'),
(36, 'File, wood rasp 8\"', 'USA', 1, '1985-12-07', 'pcs', '2024-06-08 14:34:56', '2024-06-08 14:34:56'),
(37, 'File, wood rasp 8\"', 'USA', 1, '1985-12-07', 'pcs', '2024-06-08 14:34:57', '2024-06-08 14:34:57'),
(38, 'Glass Cutter', 'diamond', 1, '1996-08-16', 'pcs', '2024-06-08 14:36:14', '2024-06-08 14:36:14'),
(39, 'Grinding wheel stone', 'Italy', 1, '1985-12-07', 'pcs', '2024-06-08 14:36:47', '2024-06-08 14:36:47'),
(40, 'Hammer', 'China', 3, '1985-12-07', 'pcs', '2024-06-08 14:37:17', '2024-06-08 14:37:17'),
(41, 'Hammer, ball type', 'Stanley, USA', 2, '2001-10-17', 'pcs', '2024-06-08 14:38:06', '2024-06-08 14:38:06'),
(42, 'Hand Drill', 'China', 3, '1985-12-07', 'pcs', '2024-06-08 14:38:53', '2024-06-08 14:38:53'),
(43, 'Hatchet', 'China', 1, '1985-12-07', 'pcs', '2024-06-08 14:39:24', '2024-06-08 14:39:24'),
(44, 'Jigsaww', 'Black & decker', 1, '1999-12-02', 'pcs', '2024-06-08 14:40:03', '2024-06-08 14:40:03'),
(45, 'Marking Gauge', '-', 4, '1985-12-07', 'pcs', '2024-06-08 14:41:02', '2024-06-08 14:41:02'),
(46, 'Mechanical Box', 'RP', 1, '1993-08-09', 'pcs', '2024-06-08 14:41:51', '2024-06-08 14:41:51'),
(47, 'Miter Box', '-', 4, '1985-12-07', 'pcs', '2024-06-08 14:43:02', '2024-06-08 14:43:02'),
(48, 'Miter Shooting Board', '-', 4, '1985-12-07', 'pcs', '2024-06-08 14:44:24', '2024-06-08 14:44:24'),
(49, 'Multi purpose long nose pliers', '-', 1, '2002-08-28', 'pcs', '2024-06-08 14:45:31', '2024-06-08 14:45:31'),
(50, 'Multipurpose tool', 'B.Bon', 1, '2002-01-27', 'pcs', '2024-06-08 14:46:12', '2024-06-08 14:46:12'),
(51, 'Pick Mattock', 'RP', 2, '1985-12-07', 'pcs', '2024-06-08 14:46:45', '2024-06-08 14:46:45'),
(52, 'Planer, mechanical', 'stanley', 11, '1985-12-07', 'pcs', '2024-06-08 14:47:28', '2024-06-08 14:47:28'),
(53, 'Plier', 'China', 2, '1985-12-07', 'pcs', '2024-06-08 14:49:11', '2024-06-08 14:49:11'),
(54, 'Planer, electric', 'Makita/1911B', 1, '1993-02-11', 'pcs', '2024-06-08 14:49:48', '2024-06-08 14:50:58'),
(55, 'Pipe Threader Set', 'RIDGID', 1, '1994-06-18', 'set', '2024-06-08 14:50:34', '2024-06-08 14:50:34'),
(56, 'Pipe wrench #18', 'KYK', 1, '1994-06-18', 'pcs', '2024-06-08 14:52:01', '2024-06-08 14:52:01'),
(57, 'Pipe wrench #14', 'KYK', 1, '1994-06-18', 'pcs', '2024-06-08 14:52:40', '2024-06-08 14:52:40'),
(58, 'Router', 'Makita, Japan', 1, '1999-12-02', '-', '2024-06-08 14:53:37', '2024-06-08 14:53:37'),
(59, 'Sharpening Stone', 'Germany', 1, '2001-10-17', '-', '2024-06-08 14:55:29', '2024-06-08 14:55:29'),
(60, 'Saw, coping frame', 'China', 1, '1985-12-07', 'pcs', '2024-06-08 14:55:54', '2024-06-08 14:55:54'),
(61, 'Saw, cross cut saw', 'sandvick', 1, '1985-12-07', 'pcs', '2024-06-08 14:56:28', '2024-06-08 14:56:28'),
(62, 'Saw, Hack Frame', 'sandvick', 1, '1985-12-07', 'pcs', '2024-06-08 14:56:59', '2024-06-08 14:56:59'),
(63, 'Saw (interchangeable)', 'China', 1, '1985-12-07', 'set', '2024-06-08 14:57:40', '2024-06-08 14:57:40'),
(64, 'Screw driver', 'Stanley', 3, '1985-12-07', 'pcs', '2024-06-08 14:58:18', '2024-06-08 14:58:18'),
(65, 'Shovel', '-', 7, '1985-12-07', 'pcs', '2024-06-08 14:58:41', '2024-06-08 14:58:41'),
(66, 'Steel square', 'Stanley', 1, '1985-12-07', 'pcs', '2024-06-08 14:59:07', '2024-06-08 14:59:07'),
(67, 'Tin Snip', 'Germany', 1, '1985-12-07', 'pcs', '2024-06-08 14:59:29', '2024-06-08 14:59:29'),
(68, 'Tri Square', 'China', 4, '1985-12-07', 'pcs', '2024-06-08 14:59:56', '2024-06-08 14:59:56'),
(69, 'Tri Square combination', 'Stanley', 2, '1985-12-07', 'pcs', '2024-06-08 15:00:35', '2024-06-08 15:00:35'),
(70, 'Trowel', 'RP', 1, '1989-11-17', 'pcs', '2024-06-08 15:01:08', '2024-06-08 15:01:08'),
(71, 'Tubing cutter', 'Stanley', 1, '1995-09-19', 'pcs', '2024-06-08 15:01:47', '2024-06-08 15:01:47'),
(72, 'Vise (big)', 'Germany', 1, '1999-12-10', 'pcs', '2024-06-08 15:02:16', '2024-06-08 15:02:16'),
(73, 'Vise, screw type', 'China', 1, '1985-12-07', 'pcs', '2024-06-08 15:02:53', '2024-06-08 15:03:13'),
(74, 'Welding Goggle', 'GW 515', 1, '2002-01-27', 'pcs', '2024-06-08 15:03:57', '2024-06-08 15:03:57'),
(75, 'Wrench, open #12/13', 'KYK', 1, '1995-07-11', 'pcs', '2024-06-08 15:04:37', '2024-06-08 15:04:37'),
(76, 'Welding Mchine', 'RP', 1, '1995-01-13', 'unit', '2024-06-08 15:05:05', '2024-06-08 15:05:05'),
(77, 'Welding Mask w/ handle', '-', 1, '1985-12-07', 'pcs', '2024-06-08 15:05:42', '2024-06-08 15:05:42'),
(78, 'Welding outfit', '-', 1, '1985-12-07', 'unit', '2024-06-08 15:06:13', '2024-06-08 15:07:26'),
(79, 'Wrench, asjustable', 'Crescent, USA', 1, '2001-10-17', 'pcs', '2024-06-08 15:06:59', '2024-06-08 15:06:59'),
(80, 'Wrench, asjustable', 'USA', 2, '1985-12-07', 'pcs', '2024-06-08 15:08:07', '2024-06-08 15:08:07'),
(81, 'Wrench, Allen', 'USA', 1, '1985-12-07', 'set', '2024-06-08 15:09:18', '2024-06-08 15:09:18'),
(82, 'Wrench, Open', 'Diamond', 1, '1995-04-21', 'pcs', '2024-06-08 15:09:57', '2024-06-08 15:09:57'),
(83, 'Zigzag', 'RP Standard', 1, '1985-12-07', 'pcs', '2024-06-08 15:10:20', '2024-06-08 15:10:20'),
(84, 'Testing and Contruction', 'Testing and Contruction', 3, '2024-09-23', 'pcs', '2024-09-23 14:38:55', '2024-09-23 14:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `construction_serials`
--

CREATE TABLE `construction_serials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `construction_serials`
--

INSERT INTO `construction_serials` (`id`, `product_id`, `serial_no`, `condition`, `created_at`, `updated_at`) VALUES
(1, 84, 'Testing and Contruction', 'Good', '2024-09-23 14:38:55', '2024-09-23 14:38:55'),
(2, 84, 'Testing and Contruction 123', 'Good', '2024-09-23 14:38:55', '2024-09-23 14:38:55'),
(3, 84, 'Testing and Contruction 1234', 'For Repair', '2024-09-23 14:38:55', '2024-09-23 14:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `brand_description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date_delivered` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `quantity`, `unit`, `item`, `brand_description`, `location`, `date_delivered`, `created_at`, `updated_at`) VALUES
(1, 1, 'pcs', 'Steel Chair', '-', 'Dean\'s Office', '2023-01-05', '2024-08-11 13:16:01', '2024-08-11 13:16:01'),
(2, 6, 'pcs', 'LCD Projector', '-', 'Dean\'s Office', '2023-05-01', '2024-08-11 13:17:04', '2024-12-21 14:36:48'),
(3, 2, 'pcs', 'Desktop Computer', 'Lenovo', 'Secretary Area', '2023-01-25', '2024-08-11 13:18:12', '2024-12-21 14:37:25'),
(4, 1, 'pcs', 'Scanner', 'Epson ES-580W', 'Secretary Area', '2023-01-25', '2024-08-11 13:19:14', '2024-08-11 13:19:14'),
(5, 3, 'pcs', 'Printer', 'Epson L310', 'Faculty Office', '2023-01-25', '2024-08-11 13:21:11', '2024-08-11 13:21:11'),
(6, 1, '-', 'Shredder', 'Admiral S-A3000', 'Faculty Office', '2023-12-20', '2024-08-11 13:22:27', '2024-08-11 13:22:27'),
(9, 0, 'pcs', 'Sample Equipment 123', 'Sample Items description', 'asasdasdas', '2024-09-22', '2024-09-22 13:51:33', '2024-12-30 12:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_items`
--

CREATE TABLE `equipment_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment_items`
--

INSERT INTO `equipment_items` (`id`, `equipment_id`, `serial_no`, `created_at`, `updated_at`) VALUES
(3, 9, '1234565464', '2024-09-22 14:12:41', '2024-09-22 14:12:41'),
(4, 9, '234435434645', '2024-09-22 14:12:41', '2024-09-22 14:12:41'),
(5, 9, 'asdasdasdasda', '2024-09-22 14:12:58', '2024-09-22 14:12:58');

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
-- Table structure for table `fluid`
--

CREATE TABLE `fluid` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `brand` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_acquired` date NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fluid`
--

INSERT INTO `fluid` (`id`, `equipment`, `description`, `brand`, `quantity`, `date_acquired`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'Beaker', '1000 ml', 'Pyrex, USA', 5, '2001-10-17', 'pcs', '2024-06-08 15:26:10', '2024-06-08 15:26:10'),
(2, 'Buckner Funnel', '-', 'Pyrex', 3, '1987-06-02', 'pcs', '2024-06-08 15:34:37', '2024-06-08 15:34:37'),
(3, 'Filter Flask', '-', 'Pyrex', 3, '1987-06-02', 'pcs', '2024-06-08 15:35:15', '2024-06-08 15:35:15'),
(4, 'F-10 Hydraulic Bench Machine', 'self contained mobile water circulating unit with gravimetric means of flow measurement, top is designed to be used as the working surface for the experiments.', 'Armfield', 1, '2001-03-03', 'unit', '2024-06-08 15:40:55', '2024-06-08 15:40:55'),
(5, 'F1-20 Osborne Reynolds App', 'a self contained transitional flow demonstration apparatus, fitted with dye injector system for observation of flow.', 'Armfield', 1, '2001-03-03', 'unit', '2024-06-08 15:47:48', '2024-06-08 15:47:48'),
(6, 'Hydraulic Bench', 'self contained mobile water circulating unit with gravimetric means of flow measurement, top is designed to be as the working surface for the experiments, With the following portable accessories', 'Modular Trend', 1, '1986-10-16', 'set', '2024-06-08 15:53:57', '2024-06-08 15:53:57'),
(7, 'a. Center of Pressure Apparatus', 'the equipment is capable of verifying the theoretical analysis to within 1% accuracy', 'Modular Trend', 1, '1986-10-16', 'set', '2024-06-08 15:56:46', '2024-06-08 16:13:20'),
(8, 'b. Flow through orifice', 'this apparatus enables full analysis of the flow through an orifice over range of flow rates', 'Modular Trend', 1, '1986-10-16', 'set', '2024-06-08 15:59:05', '2024-06-08 16:13:43'),
(9, 'c. Jet Impact Apparatus', 'designed primarily for the use by directly measuring the force exerted on the plats by the water jet', 'Modular Trend', 1, '1986-10-16', 'set', '2024-06-08 16:01:54', '2024-06-08 16:13:58'),
(10, 'd. Losses in Pipes Bends', 'primarily used in determining head loss in pipe bends', 'Modular Trend', 1, '1986-10-16', 'set', '2024-06-08 16:11:06', '2024-06-08 16:11:06'),
(11, 'e. Pipe Friction Apparatus', 'Is designed primarily for use on the bench to have a full scope for experimentations in both laminar and turbulent flow', 'Modular Trend', 1, '1986-10-06', 'set', '2024-06-08 16:16:53', '2024-06-08 16:16:53'),
(12, 'f. Venturi Meter', 'it allow the observation and measurement of the complete static head distribution along a horizontal venturi tube', 'Modular Trend', 1, '1986-10-16', 'set', '2024-06-08 16:19:35', '2024-06-08 16:20:08'),
(13, 'g. Pressure Gauge Calibrator', 'it enables a commercial Bourdon tube pressure gauge to be accurately calibrated using a dead weight tester.', 'Modular Trend', 1, '1986-10-16', 'set', '2024-06-08 16:23:38', '2024-06-08 16:23:38'),
(14, 'h. Stability of floating body', 'it demonstrate a method of determining the metacentric Height of floating body', 'Modular Trend', 1, '1986-10-16', 'set', '2024-06-08 16:25:29', '2024-06-08 16:25:29'),
(15, 'Hydraulic Tract Apparatus', 'a compact twin motor multipurpose unit designed to be flexible so that the widest possible range of experiments can be accomodated', 'BALDOR, USA', 1, '2002-03-01', 'set', '2024-06-08 16:28:57', '2024-06-08 16:28:57'),
(16, 'Ph Meter', '-', '-', 1, '1989-11-17', 'unit', '2024-06-08 16:31:26', '2024-06-08 16:31:26'),
(17, 'Timer', 'stopwatch', 'Japan', 5, '2001-12-05', 'pcs', '2024-06-08 16:31:54', '2024-06-08 16:31:54'),
(18, 'Top Loading', 'Balance', 'National', 4, '1989-11-17', 'set', '2024-06-08 16:32:33', '2024-06-08 16:32:33'),
(19, 'Viscosity Apparatus', 'consist of a transparent tube sedimentation columns are held in spring retaining clips and can be easily removed for filing prior test', 'Locally fabricated', 1, '2990-08-28', 'unit', '2024-06-08 16:34:25', '2024-06-08 16:34:25'),
(20, 'Wire Basket', '-', 'Stainless', 2, '1987-07-30', 'pcs', '2024-06-08 16:35:01', '2024-06-08 16:35:01'),
(21, 'Pitot tube', 'w/ complete accessories', 'Stainless', 1, '1984-07-10', 'pcs', '2024-06-08 16:35:48', '2024-06-08 19:50:13'),
(22, 'Fluid Item 123', 'Fluid Item 123 Fluid Item 123 Fluid Item 123Fluid Item 123 Fluid Item 123', 'Fluid Item 123', 3, '2024-09-24', 'pcs', '2024-09-24 08:14:01', '2024-09-24 08:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `fluid_serials`
--

CREATE TABLE `fluid_serials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fluid_serials`
--

INSERT INTO `fluid_serials` (`id`, `product_id`, `serial_no`, `condition`, `created_at`, `updated_at`) VALUES
(1, 22, 'Fluid Item 123', 'Good', '2024-09-24 08:14:01', '2024-09-24 08:14:01'),
(2, 22, 'Fluid Item 1234', 'Good', '2024-09-24 08:14:01', '2024-09-24 08:14:01'),
(3, 22, 'Fluid Item 1235', 'Good', '2024-09-24 08:14:01', '2024-09-24 08:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_04_09_131419_create_computer_engineering_table', 1),
(5, '2024_05_21_045005_create_surveyings_table', 1),
(6, '2024_05_21_163940_create_testings_table', 1),
(7, '2024_05_22_041736_create_construction_table', 1),
(8, '2024_05_23_122158_create_fluid_table', 1),
(9, '2024_05_24_132453_create_supplies_table', 1),
(10, '2024_06_22_103658_create_transactionoffice_table', 1),
(11, '2024_06_22_151009_create_notifications_table', 1),
(12, '2024_07_16_040153_create_equipment_table', 1),
(13, '2024_07_19_081600_create_teachersborrow_table', 1),
(14, '2024_07_19_143508_create_users_table', 1),
(15, '2024_08_11_114604_create_equipment_table', 2),
(16, '2024_09_15_145047_create_permission_tables', 3),
(17, '2024_09_16_135822_create_computer_engineering_serials_table', 4),
(26, '2024_09_18_123010_create_requisitions_table', 5),
(27, '2024_09_18_142924_create_requisitions_items_table', 5),
(28, '2024_09_18_143921_create_requisitions_items_students_table', 5),
(30, '2024_09_22_214258_create_equipment_items_table', 6),
(31, '2024_09_22_221916_create_supplies_items_table', 7),
(33, '2024_09_22_223332_create_office_requests_table', 8),
(34, '2024_09_23_215544_create_surveying_serials_table', 9),
(35, '2024_09_23_222206_create_testing_serials_table', 10),
(36, '2024_09_23_223138_create_construction_serials_table', 11),
(37, '2024_09_24_160754_create_fluid_serials_table', 12),
(38, '2024_09_29_094939_add_is_notified_to_office_requests_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('03db6459-0190-49da-bd83-9cb6a475e408', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Black Ballpen\' is running low with only 0 items left.\"}', '2024-12-30 12:57:40', '2024-12-30 12:56:59', '2024-12-30 12:57:40'),
('14cef7ea-f3e8-4344-9727-fd7015d141fc', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Red Ink\' is running low with only 0 items left.\"}', '2024-12-30 12:52:35', '2024-12-30 12:42:50', '2024-12-30 12:52:35'),
('189fc0e1-5fe1-4254-bf3b-a7248ce26c71', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Yellow Ink\' is running low with only 0 items left.\"}', '2024-12-30 12:57:41', '2024-12-30 12:56:59', '2024-12-30 12:57:41'),
('1a8c3838-504f-4b3e-9be0-7ca3fb443df7', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Bondpaper\' is running low with only 0 items left.\"}', '2024-12-30 12:52:35', '2024-12-30 12:42:50', '2024-12-30 12:52:35'),
('329d51cc-7df6-4afe-b84e-e1bc24262345', 'App\\Notifications\\UserNotifications', 'App\\Models\\User', 1, '{\"message\":\"The Supplies\\n\'Bondpaper\' has been Approved.\"}', NULL, '2024-12-30 12:32:24', '2024-12-30 12:32:24'),
('38b8e289-c97b-4528-9fce-e42ea8e6ae45', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'White Board Marker\' is running low with only 0 items left.\"}', '2024-12-30 12:57:42', '2024-12-30 12:56:59', '2024-12-30 12:57:42'),
('5ba6d043-1504-4f01-bb7a-41c5249fa5c7', 'App\\Notifications\\UserNotifications', 'App\\Models\\User', 1, '{\"message\":\"The Equipments\\n\'Sample Equipment 123\' has been Damaged.\"}', NULL, '2024-12-30 12:39:47', '2024-12-30 12:39:47'),
('5d676e68-4c7e-45d9-ada8-af940a9eb508', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Black Ink\' is running low with only 0 items left.\"}', '2024-12-30 12:57:43', '2024-12-30 12:56:59', '2024-12-30 12:57:43'),
('606a607e-6e5c-47ba-925f-a04107f59150', 'App\\Notifications\\UserNotifications', 'App\\Models\\User', 1, '{\"message\":\"The Equipments\\n\'Sample Equipment 123\' has been Repaired.\"}', NULL, '2024-12-30 12:50:33', '2024-12-30 12:50:33'),
('63a1eb4a-ad8a-4d7b-ad28-0213882acedb', 'App\\Notifications\\UserNotifications', 'App\\Models\\User', 1, '{\"message\":\"The Supplies\\n\'Bondpaper\' has been Received.\"}', NULL, '2024-12-30 12:32:28', '2024-12-30 12:32:28'),
('646f0cb6-4174-4a0c-a5bf-1a71ece34a3c', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Eraser\' is running low with only 0 items left.\"}', '2024-12-30 12:52:35', '2024-12-30 12:42:50', '2024-12-30 12:52:35'),
('65ac0014-7aa9-4ea1-8aa0-9797c221e361', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Yellow Ink\' is running low with only 0 items left.\"}', '2024-12-30 12:52:35', '2024-12-30 12:42:50', '2024-12-30 12:52:35'),
('69686484-cc4f-4cf9-88da-ce6dff277acf', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Blue Ink\' is running low with only 0 items left.\"}', '2024-12-30 12:52:35', '2024-12-30 12:42:50', '2024-12-30 12:52:35'),
('6da1956f-2091-43a2-a3f3-bee24af59284', 'App\\Notifications\\UserNotifications', 'App\\Models\\User', 1, '{\"message\":\"The Equipments\\n\'Sample Equipment 123\' has been Damaged.\"}', NULL, '2024-12-30 12:45:43', '2024-12-30 12:45:43'),
('6ef26e32-cfbb-4c42-b08e-c21ce0c8be8b', 'App\\Notifications\\UserNotifications', 'App\\Models\\User', 1, '{\"message\":\"The Equipments\\n\'Sample Equipment 123\' has been XXX.\"}', NULL, '2024-12-30 12:52:14', '2024-12-30 12:52:14'),
('7916a1f5-d8d4-4bab-a6d4-48f2cf779310', 'App\\Notifications\\UserNotifications', 'App\\Models\\User', 1, '{\"message\":\"The Equipments\\n\'Sample Equipment 123\' has been Returned.\"}', NULL, '2024-12-30 12:39:30', '2024-12-30 12:39:30'),
('7bd24f68-5687-409b-aaa8-67492cf5fa5d', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Red Ink\' is running low with only 0 items left.\"}', '2024-12-30 12:57:45', '2024-12-30 12:56:59', '2024-12-30 12:57:45'),
('87b0944f-9259-4efb-9a68-503a4a2bd1f6', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Black Ink\' is running low with only 0 items left.\"}', '2024-12-30 12:52:35', '2024-12-30 12:42:50', '2024-12-30 12:52:35'),
('87e09e6e-dd34-4956-b18b-70e5e804887d', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Red Ballpen\' is running low with only 0 items left.\"}', '2024-12-30 12:52:35', '2024-12-30 12:42:50', '2024-12-30 12:52:35'),
('9f58828f-f309-418c-b7d8-70afb1a11b17', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'White Board Marker\' is running low with only 0 items left.\"}', '2024-12-30 12:52:35', '2024-12-30 12:42:50', '2024-12-30 12:52:35'),
('a86247fe-a402-424a-9c56-bbd4c34b2d63', 'App\\Notifications\\BorrowerNotification', 'App\\Models\\User', 1, '{\"message\":\"Your borrowed equipment \'Sample Equipment 123\' has exceeded the allowed return period. Please return it immediately.\",\"timestamp\":\"2024-12-30T12:36:10.360751Z\"}', NULL, '2024-12-30 12:36:10', '2024-12-30 12:36:10'),
('abd4ae48-0127-4e8a-a9cd-d59cdca6338c', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Blue Ink\' is running low with only 0 items left.\"}', NULL, '2024-12-30 12:56:59', '2024-12-30 12:56:59'),
('c37d0cca-f160-44bd-aa2c-2364f2c4d8db', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Black Ballpen\' is running low with only 0 items left.\"}', '2024-12-30 12:52:35', '2024-12-30 12:42:50', '2024-12-30 12:52:35'),
('d424a1da-2eb4-48fe-b636-78759530f836', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Sample Equipment 123\' is running low with only 3 items left.\"}', NULL, '2024-12-30 12:56:59', '2024-12-30 12:56:59'),
('d5b4fa5f-04b5-42f2-b29d-1edf1ce8b83a', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Eraser\' is running low with only 0 items left.\"}', NULL, '2024-12-30 12:56:59', '2024-12-30 12:56:59'),
('d8e128ca-108c-4712-b492-3be5d674721a', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Bondpaper\' is running low with only 0 items left.\"}', NULL, '2024-12-30 12:56:59', '2024-12-30 12:56:59'),
('da2725ce-0961-4d98-b112-2f9fa6ba19b9', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Sample Equipment 123\' is running low with only 3 items left.\"}', '2024-12-30 12:52:35', '2024-12-30 12:42:50', '2024-12-30 12:52:35'),
('f84c1a26-de25-4838-9476-434dd25d754d', 'App\\Notifications\\SupplyRunningLowNotification', 'App\\Models\\User', 4, '{\"message\":\"The supply item \'Red Ballpen\' is running low with only 0 items left.\"}', NULL, '2024-12-30 12:56:59', '2024-12-30 12:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `office_requests`
--

CREATE TABLE `office_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `quantity_requested` int(11) NOT NULL,
  `requested_by` bigint(20) UNSIGNED NOT NULL,
  `purpose` longtext NOT NULL,
  `status` enum('Pending','Approved','Received','Declined','Returned','Not Returned','Damaged','Repaired','XXX') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_notified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_requests`
--

INSERT INTO `office_requests` (`id`, `item_id`, `item_type`, `quantity_requested`, `requested_by`, `purpose`, `status`, `created_at`, `updated_at`, `is_notified`) VALUES
(1, 9, 'Equipments', 2, 1, 'asd', 'XXX', '2024-12-26 12:17:46', '2024-12-30 12:52:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `date_time_filed` datetime NOT NULL,
  `date_time_needed` datetime NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `course_year` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `status` enum('Pending','Approved and Prepared','Declined','Accepted by Dean') NOT NULL DEFAULT 'Pending',
  `reason_for_decline` longtext DEFAULT NULL,
  `dean_signature` varchar(255) DEFAULT NULL,
  `labtext_signature` varchar(255) DEFAULT NULL,
  `received_date` datetime DEFAULT NULL,
  `returned_date` datetime DEFAULT NULL,
  `issued_date` datetime DEFAULT NULL,
  `checked_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `category`, `date_time_filed`, `date_time_needed`, `instructor_id`, `subject`, `course_year`, `activity`, `status`, `reason_for_decline`, `dean_signature`, `labtext_signature`, `received_date`, `returned_date`, `issued_date`, `checked_date`, `created_at`, `updated_at`) VALUES
(3, 'Testings', '2024-09-19 21:57:51', '2024-09-21 21:33:00', 1, 'Sample testing subject', 'BSCPE', 'Sample testing activity', 'Accepted by Dean', NULL, 'signatures/signature_1726911355.png', 'signatures/signature_1726905792.png', NULL, NULL, NULL, NULL, '2024-09-19 05:34:23', '2024-09-21 09:35:55'),
(4, 'ComputerEngineering', '2024-09-22 11:05:24', '2024-09-25 11:05:00', 1, 'Needs', 'BSCE', 'Request Items for Disbursement Proccess', 'Approved and Prepared', NULL, 'signatures/signature_1726976941.png', 'signatures/signature_1726975692.png', NULL, NULL, NULL, NULL, '2024-09-22 03:06:29', '2024-09-22 03:49:01'),
(5, 'Testings', '2024-09-28 16:46:16', '2024-09-30 08:50:00', 1, 'Ukkinam', 'BSENSE', 'Ayoko', 'Accepted by Dean', NULL, 'signatures/signature_1727513347.png', 'signatures/signature_1727513272.png', NULL, NULL, NULL, NULL, '2024-09-28 08:46:52', '2024-09-28 08:49:07'),
(6, 'Fluids', '2024-09-28 17:23:43', '2024-09-28 17:24:00', 1, 'dsfdsfds', 'BSENSE', 'asdasdasdasdasdsa', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-28 09:24:41', '2024-09-28 09:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions_items`
--

CREATE TABLE `requisitions_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisitions_items`
--

INSERT INTO `requisitions_items` (`id`, `requisition_id`, `equipment_id`, `quantity`, `remarks`, `created_at`, `updated_at`) VALUES
(3, 3, 15, 2, 'Sample Condition', '2024-09-19 05:34:23', '2024-09-19 05:34:23'),
(4, 3, 16, 1, 'Sample Condition 1', '2024-09-19 05:34:23', '2024-09-19 05:34:23'),
(5, 4, 54, 2, 'Good Condition', '2024-09-22 03:06:29', '2024-09-22 03:06:29'),
(6, 4, 2, 1, 'Good Condition 1', '2024-09-22 03:06:29', '2024-09-22 03:06:29'),
(7, 5, 19, 3, 'Sample Condition', '2024-09-28 08:46:52', '2024-09-28 08:46:52'),
(8, 5, 15, 2, 'Good Condition 1', '2024-09-28 08:46:52', '2024-09-28 08:46:52'),
(9, 6, 18, 2, '111', '2024-09-28 09:24:41', '2024-09-28 09:24:41'),
(10, 6, 19, 1, '111', '2024-09-28 09:24:41', '2024-09-28 09:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions_items_students`
--

CREATE TABLE `requisitions_items_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` bigint(20) UNSIGNED NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requisitions_items_students`
--

INSERT INTO `requisitions_items_students` (`id`, `requisition_id`, `student_name`, `created_at`, `updated_at`) VALUES
(3, 3, 'Nathalee Bautista', '2024-09-19 05:34:23', '2024-09-19 05:34:23'),
(4, 3, 'asfjkdsfldsfklds', '2024-09-19 05:34:23', '2024-09-19 05:34:23'),
(5, 4, 'Nathalee Bautista', '2024-09-22 03:06:29', '2024-09-22 03:06:29'),
(6, 4, '123121212121212121', '2024-09-22 03:06:29', '2024-09-22 03:06:29'),
(7, 4, 'User 123', '2024-09-22 03:06:29', '2024-09-22 03:06:29'),
(8, 4, 'User 1234', '2024-09-22 03:06:29', '2024-09-22 03:06:29'),
(9, 5, 'asdasdasdas', '2024-09-28 08:46:52', '2024-09-28 08:46:52'),
(10, 5, 'asdasdasdasdas123', '2024-09-28 08:46:52', '2024-09-28 08:46:52'),
(11, 5, '123232asdasdsa', '2024-09-28 08:46:52', '2024-09-28 08:46:52'),
(12, 6, 'asdasdasdasda123', '2024-09-28 09:24:41', '2024-09-28 09:24:41'),
(13, 6, 'asdasdasdas23232', '2024-09-28 09:24:41', '2024-09-28 09:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user', 'web', '2024-09-15 06:52:51', '2024-09-15 06:52:51'),
(2, 'dean', 'web', '2024-09-15 06:52:51', '2024-09-15 06:52:51'),
(3, 'laboratory', 'web', '2024-09-15 06:52:51', '2024-09-15 06:52:51'),
(4, 'site secretary', 'web', '2024-09-15 06:52:51', '2024-09-15 06:52:51'),
(5, 'superadmin', 'web', '2024-09-15 06:52:51', '2024-09-15 06:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `brand_description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date_delivered` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`id`, `quantity`, `unit`, `item`, `brand_description`, `location`, `date_delivered`, `created_at`, `updated_at`) VALUES
(67, -1, 'box', 'Bondpaper', 'Copy', 'Faculty Office', '2023-03-20', '2024-08-11 13:26:07', '2024-12-30 12:32:28'),
(68, 1, 'pcs', 'Blue Ink', 'epson 003', 'Faculty Office', '2023-02-01', '2024-08-11 13:27:44', '2024-12-21 14:48:27'),
(69, 8, 'pcs', 'Red Ink', 'EPSON 003', 'Faculty Office', '2023-02-20', '2024-08-11 13:28:11', '2024-12-21 14:47:53'),
(70, 10, 'pcs', 'Yellow Ink', 'Epson 003', 'Faculty Office', '2023-03-20', '2024-08-11 13:28:46', '2024-08-11 13:28:46'),
(71, 10, 'pcs', 'Black Ink', 'Epson 003', 'Faculty Office', '2023-02-20', '2024-08-11 13:29:11', '2024-08-11 13:29:11'),
(72, 100, 'pcs', 'Black Ballpen', 'HBW', 'Faculty Office', '2023-02-20', '2024-08-11 13:29:44', '2024-08-11 13:29:44'),
(73, 100, 'pcs', 'Red Ballpen', 'HBW', 'Faculty Office', '2023-02-20', '2024-08-11 13:30:10', '2024-08-11 13:30:10'),
(74, 12, 'pcs', 'White Board Marker', 'HBW', 'Faculty Office', '2023-02-20', '2024-08-11 13:30:37', '2024-08-11 13:30:37'),
(75, 10, 'pcs', 'Eraser', 'HBW', 'Faculty Office', '2023-02-20', '2024-08-11 13:30:58', '2024-08-11 13:30:58'),
(76, 2, 'pcs', 'Sample Equipment 123', 'Sample Items description', 'asasdasdas', '2024-09-22', '2024-09-22 14:21:35', '2024-09-22 14:21:35'),
(77, 5, 'pcs', 'SASASASA', 'Sample Items description', 'SASASSA', '2024-12-30', '2024-12-30 13:02:34', '2024-12-30 13:02:34'),
(78, 4, 'pcs', 'as das das das das', 'as das das das', 'as das das d', '2024-12-21', '2024-12-30 13:03:42', '2024-12-30 13:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `supplies_items`
--

CREATE TABLE `supplies_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplies_id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplies_items`
--

INSERT INTO `supplies_items` (`id`, `supplies_id`, `serial_no`, `created_at`, `updated_at`) VALUES
(1, 76, 'SUP-000123', '2024-09-22 14:21:35', '2024-09-22 14:21:35'),
(2, 76, 'SUP-000124', '2024-09-22 14:21:35', '2024-09-22 14:21:35'),
(3, 76, 'SUP-0001234', '2024-09-22 14:27:13', '2024-09-22 14:27:13'),
(4, 77, '10000', '2024-12-30 13:02:34', '2024-12-30 13:02:34'),
(5, 77, '100001', '2024-12-30 13:02:34', '2024-12-30 13:02:34'),
(6, 77, '100002', '2024-12-30 13:02:34', '2024-12-30 13:02:34'),
(7, 77, '100003', '2024-12-30 13:02:34', '2024-12-30 13:02:34'),
(8, 77, '100004', '2024-12-30 13:02:34', '2024-12-30 13:02:34'),
(9, 78, '1230', '2024-12-30 13:03:42', '2024-12-30 13:03:42'),
(10, 78, '1233', '2024-12-30 13:03:42', '2024-12-30 13:03:42'),
(11, 78, '123123', '2024-12-30 13:03:42', '2024-12-30 13:03:42'),
(12, 78, '12312321', '2024-12-30 13:03:42', '2024-12-30 13:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `surveyings`
--

CREATE TABLE `surveyings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `brand` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_acquired` date NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surveyings`
--

INSERT INTO `surveyings` (`id`, `equipment`, `description`, `brand`, `quantity`, `date_acquired`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'Aerial Photograph', 'colored 5 x 7 size', 'NAMRIA', 16, '1990-10-22', 'pcs', '2024-06-08 01:32:15', '2024-06-08 01:32:15'),
(2, 'A lidade w/ Plane Table', '19x magnification and wooden tripod with complete accessories and packed in a wooden case.', 'Standard Brand', 1, '1986-04-05', 'set', '2024-06-08 01:34:07', '2024-06-08 01:34:07'),
(3, 'A lidade w/ Plane Table', '19x magnification and wooden tripod with complete accessories and packed in a wooden case.', 'CB 14 W & E', 1, '1987-05-27', 'set', '2024-06-08 01:34:57', '2024-06-08 01:34:57'),
(4, 'A lidade w/ Plane Table', '19x magnification and wooden tripod with complete accessories and packed in a wooden case.', 'Tamura, Japan', 2, '1989-11-17', 'unit', '2024-06-08 01:35:33', '2024-06-08 01:35:33'),
(5, 'A lidade w/ Plane Table', '19x magnification and wooden tripod with complete accessories and packed in a wooden case.', 'Standard, Japan', 1, '1990-12-05', 'unit', '2024-06-08 01:36:10', '2024-06-08 01:36:10'),
(6, 'Automatic Level', '20x magnification with its shortest focusing distance of 0.9m erect image packed in a heavy unbreakable plastic.', 'Wild Heerbrug', 1, '1986-04-05', 'unit', '2024-06-08 01:39:46', '2024-06-08 01:39:46'),
(7, 'Automatic Level', '20x magnification with its shortest focusing distance of 0.9m erect image packed in a heavy unbreakable plastic.', 'Wild Heerbrug', 1, '1986-10-23', 'unit', '2024-06-08 01:40:12', '2024-06-08 01:40:12'),
(8, 'Automatic Level', '20x magnification with its shortest focusing distance of 0.9m erect image packed in a heavy unbreakable plastic.', 'Wild Heerbrug', 1, '1987-05-27', 'set', '2024-06-08 01:40:36', '2024-06-08 01:40:36'),
(9, 'Altimeter/Barometer', 'digital reading', 'Sunnunto, Japan', 1, '2001-11-19', 'unit', '2024-06-08 01:42:37', '2024-06-08 01:42:37'),
(10, 'Barometer/Altimeter', 'pocket type max, 4500m altitude', 'Stockburger, Germany', 4, '1990-12-05', 'pcs', '2024-06-08 01:43:48', '2024-06-08 01:43:48'),
(11, 'Brunton Compass', 'A compact pocket type transit', 'USA', 2, '1984-01-05', 'unit', '2024-06-08 01:44:43', '2024-06-08 01:44:43'),
(12, 'Chain Pin', '-', 'Locally fabricated', 2, '1990-09-10', 'pcs', '2024-06-08 01:46:27', '2024-06-08 01:46:27'),
(13, 'Contact Printer', '-', 'NP - C11', 1, '1991-10-22', 'unit', '2024-06-08 01:47:18', '2024-06-08 01:47:18'),
(14, 'Current Meter', 'precise with electronically counter shaft, high pitch buzzer rocket shaped lead with complete accessories, packed in wooden and fiber case', 'Nihon, Sokuryoki, Japan', 1, '1986-10-26', 'unit', '2024-06-08 01:48:52', '2024-06-08 01:48:52'),
(15, 'Current Meter', 'precise with electronically counter shaft, high pitch buzzer rocket shaped lead with complete accessories, packed in wooden and fiber case', 'NSP-01, Japan', 4, '1990-12-05', 'unit', '2024-06-08 01:49:49', '2024-06-08 01:49:49'),
(16, 'Dot Grid Templet', '-', '-', 1, '1991-10-22', 'pcs', '2024-06-08 01:53:57', '2024-06-08 01:53:57'),
(17, 'Drafting Machine', '-', '-', 3, '1984-07-10', 'unit', '2024-06-08 01:54:55', '2024-06-08 01:54:55'),
(18, 'Dumpy level', 'engineer\'s level 30X magnification with shortest focusing distance of 2m, 14\" in length and packed in wooden case.', 'Tamaya, Japan', 1, '1984-01-24', 'unit', '2024-06-08 01:57:13', '2024-06-08 01:57:13'),
(19, 'Electronic Total Station', 'an automatic and highly sophisticated electronic distance measurement', 'Sokkisha', 1, '2000-05-19', 'unit', '2024-06-08 01:58:58', '2024-06-08 01:58:58'),
(20, 'Engineer Transit', 'magnification with 1 minute direct reading, erect image and packed in a plastic and wooden case', 'K&E, USA', 1, '1985-08-02', 'unit', '2024-06-08 02:00:45', '2024-06-08 02:00:45'),
(21, 'Engineer Transit', 'magnification with 1 minute direct reading, erect image and packed in a plastic and wooden case', 'Japan', 1, '1983-11-22', 'pcs', '2024-06-08 02:02:10', '2024-06-08 02:02:10'),
(22, 'Engineer Transit', 'magnification with 1 minute direct reading, erect image and packed in a plastic and wooden case', 'World-BD-3', 3, '1990-02-19', 'unit', '2024-06-08 02:02:49', '2024-06-08 02:02:49'),
(23, 'Engineer Transit', 'magnification with 1 minute direct reading, erect image and packed in a plastic and wooden case', 'Sokkisha, japan', 3, '2005-11-18', 'unit', '2024-06-08 02:03:45', '2024-06-08 02:03:45'),
(24, 'Flashlight', '-', 'Eveready', 5, '1991-10-22', 'pcs', '2024-06-08 02:04:30', '2024-06-08 02:04:30'),
(25, 'GPS, Magelan', '-', 'GPS 300', 2, '2000-05-19', 'unit', '2024-06-08 02:05:33', '2024-06-08 02:05:33'),
(26, 'Hand Level & Clinometer', '-', 'USA', 1, '1984-01-05', 'unit', '2024-06-08 02:06:22', '2024-06-08 02:06:22'),
(27, 'Leveling Rod', 'folded type 3 meters, extended type 4.19 meters', '-', 7, '1984-02-24', 'pcs', '2024-06-08 02:08:28', '2024-06-08 02:08:28'),
(28, 'Micrometer Sextant', '-', 'USA', 1, '1986-10-11', 'unit', '2024-06-08 02:10:56', '2024-06-08 02:10:56'),
(29, 'Marking Pins', '-', '-', 36, '1988-10-29', 'pcs', '2024-06-08 02:11:42', '2024-06-08 02:11:42'),
(30, 'Planimeter', 'with zero setting device, polar compensating type, in fiber plastic case', '-', 1, '1984-01-05', 'unit', '2024-06-08 02:12:39', '2024-06-08 02:12:39'),
(31, 'Planimeter', 'with zero setting device, polar compensating type, in fiber plastic case', '-', 4, '1991-10-22', 'pcs', '2024-06-08 02:13:26', '2024-06-08 02:13:26'),
(32, 'Planimeter', 'digital', 'Koizumi, electronics', 2, '2000-05-19', 'unit', '2024-06-08 02:14:17', '2024-06-08 02:14:17'),
(33, 'Pantograph', 'made of brass, 80cm, consist of arms length 85cm, and short arms of 40cm, holder tracing pin.', 'Tamaya, Japan', 1, '1986-10-11', 'unit', '2024-06-08 02:15:52', '2024-06-08 02:15:52'),
(35, 'Precission Level', 'an engineer\'s level in blue plastic case and wooden tripod', 'L-21, Japan', 1, '1986-10-11', 'pcs', '2024-06-08 02:18:10', '2024-06-08 02:18:10'),
(36, 'Range Pole', 'metal GI Wooden with metal plate Alloy extended type', '-', 8, '1992-10-22', 'pcs', '2024-06-08 02:19:24', '2024-06-08 02:19:24'),
(37, 'Range Pole', 'metal GI Wooden with metal plate Alloy extended type', '-', 4, '1988-09-12', 'pcs', '2024-06-08 02:19:50', '2024-06-08 02:19:50'),
(38, 'Range Pole', 'metal GI Wooden with metal plate Alloy extended type', '-', 6, '1984-07-10', 'pcs', '2024-06-08 02:20:26', '2024-06-08 02:20:26'),
(39, 'Steel Tape', 'pocket type', 'Tajima', 3, '1992-10-22', 'unit', '2024-06-08 02:21:15', '2024-06-08 02:21:15'),
(40, 'Stadia Rod', 'Alum. 4m adjustable', 'Japan', 5, '2001-11-05', 'pcs', '2024-06-08 02:23:05', '2024-06-08 02:23:05'),
(41, 'Stadia Rod', 'wooden 4m adjustable', 'Philadelphia type', 8, '2001-11-05', 'pcs', '2024-06-08 03:42:01', '2024-06-08 03:42:01'),
(42, 'Stadia Rods', 'Folding type', '-', 4, '1984-01-05', 'pcs', '2024-06-08 03:42:58', '2024-06-08 03:42:58'),
(43, 'Steel Tapes', 'carpenters type', 'Tajima', 4, '1984-01-05', 'pcs', '2024-06-08 03:44:01', '2024-06-08 03:44:01'),
(46, 'Steel Tape', '30m', 'Stanley', 2, '1995-07-11', 'pcs', '2024-06-08 03:47:11', '2024-06-08 03:47:11'),
(47, 'Steel Tape', '50m', 'State steel', 2, '1988-12-07', 'pcs', '2024-06-08 03:47:53', '2024-06-08 03:47:53'),
(48, 'Steel Tape', 'Nylon coated', 'Taijima, Japan', 8, '2001-11-05', 'pcs', '2024-06-08 03:49:01', '2024-06-08 03:49:01'),
(49, 'Steel Tape', 'Fiver glass', '-', 1, '2023-01-14', 'pcs', '2024-06-08 03:49:59', '2024-06-08 03:49:59'),
(50, 'Steel tape', '100m', 'State steel', 2, '2000-03-19', 'pcs', '2024-06-08 03:50:33', '2024-06-08 03:50:33'),
(51, 'Steel tape', 'pocket type 3m', 'Stanley', 2, '1995-07-11', 'pcs', '2024-06-08 03:51:12', '2024-06-08 03:51:12'),
(52, 'Steel tape', '5m', 'Stanley', 1, '1995-04-21', 'pcs', '2024-06-08 03:51:50', '2024-06-08 03:51:50'),
(53, 'Sextant', '-', 'USA', 3, '1990-12-03', 'unit', '2024-06-08 03:52:29', '2024-06-08 03:52:29'),
(54, 'Solar Eyepiece', 'prismatic type fitted in a standard WILD and K&E transit', 'Standard', 5, '1990-12-05', 'pcs', '2024-06-08 03:53:59', '2024-06-08 03:53:59'),
(55, 'Tape Thermometer', 'in stainless case 0 to 100 degrees centigrade', 'China', 2, '1994-03-13', 'pcs', '2024-06-08 03:55:43', '2024-06-08 03:55:43'),
(56, 'Templet, Crab and Overlap', '-', 'Standard', 5, '1991-10-22', 'pcs', '2024-06-08 03:57:23', '2024-06-08 03:57:23'),
(57, 'Three Arms Protractor', '-', 'San-Ei, Japan', 1, '1986-10-27', 'pcs', '2024-06-08 04:01:36', '2024-06-08 04:01:36'),
(58, 'Theodolite', 'optical, 5 min. direct reading estimate to 0.5 min. 90x magnification, erect image built in illuminator image, Complete with standard accessories with aluminum tripods', 'T05', 3, '1986-11-10', 'unit', '2024-06-08 04:05:45', '2024-06-08 04:05:45'),
(59, 'Theodolite', 'optical, 5 min. direct reading estimate to 0.5 min. 90x magnification, erect image built in illuminator image, Complete with standard accessories with aluminum tripods', 'Fuji Koh', 2, '1990-12-02', 'unit', '2024-06-08 04:07:38', '2024-06-08 04:07:38'),
(61, 'Theodolite', 'optical, 5 min. direct reading estimate to 0.5 min. 90x magnification, erect image built in illuminator image, Complete with standard accessories with aluminum tripods', 'Universal', 1, '2000-03-19', 'unit', '2024-06-08 04:11:15', '2024-06-08 04:11:15'),
(62, 'Theodolite', 'optical, 5 min. direct reading estimate to 0.5 min. 90x magnification, erect image built in illuminator image, Complete with standard accessories with aluminum tripods', 'Sunray Japan', 1, '2001-10-17', 'unit', '2024-06-08 04:12:41', '2024-06-08 04:12:41'),
(63, 'Templet, Crab and Overlap', 'made of stainless steel', 'Standard', 5, '1991-10-22', 'pcs', '2024-06-08 04:14:46', '2024-06-08 04:14:46'),
(64, 'Thermometer Tape', '-', 'Japan', 3, '1936-10-11', 'pcs', '2024-06-08 04:15:38', '2024-06-08 04:15:38'),
(65, 'Tripod for Transit', '-', 'Aluminum cap', 5, '2001-11-19', 'pcs', '2024-06-08 04:16:44', '2024-06-08 04:16:44'),
(66, 'Topographic Map', 'scale: 1:50,000', '-', 5, '1991-10-22', 'pcs', '2024-06-08 04:18:07', '2024-06-08 04:18:07'),
(67, 'Turning Plates', '-', 'RP', 4, '1991-10-22', 'pcs', '2024-06-08 04:18:46', '2024-06-08 04:18:46'),
(68, 'Wye Level', '30x magnification with its shortest focusing distance of 2 meters and packed in a wooden case.', 'Standard, Japan', 1, '1984-02-24', 'unit', '2024-06-08 04:21:24', '2024-06-08 04:21:24'),
(69, 'Sample item', 'asd sad asd asdas', 'Moderna', 2, '2024-09-23', 'pcs', '2024-09-23 14:16:06', '2024-09-23 14:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `surveying_serials`
--

CREATE TABLE `surveying_serials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surveying_serials`
--

INSERT INTO `surveying_serials` (`id`, `product_id`, `serial_no`, `condition`, `created_at`, `updated_at`) VALUES
(1, 69, 'JK-11-1029', 'For Repair', '2024-09-23 14:16:06', '2024-09-23 14:16:06'),
(2, 69, 'JK-11-102912121', 'Good', '2024-09-23 14:16:06', '2024-09-23 14:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `teachersborrow`
--

CREATE TABLE `teachersborrow` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dateFiled` date NOT NULL DEFAULT current_timestamp(),
  `dateNeeded` date NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `subject` int(11) NOT NULL,
  `courseYear` enum('BSCE','BSCPE','BSENSE') NOT NULL,
  `activityTitle` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'waiting for approval',
  `days_not_returned` int(11) NOT NULL DEFAULT 0,
  `datetime_returned` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testings`
--

CREATE TABLE `testings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `brand` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_acquired` date NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testings`
--

INSERT INTO `testings` (`id`, `equipment`, `description`, `brand`, `quantity`, `date_acquired`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'Air Meter', 'for entrained air content determination, container made of alkali dow proof alloy 6.4 kg., provided with an air pressure chamber in a conical center, pressure gauge, dual graduation', 'C13 XT', 1, '1987-05-27', 'unit', '2024-06-08 04:25:27', '2024-06-08 04:25:27'),
(2, 'Balance', 'Top Loading 25 kg. capacity Digital', 'Daikin', 1, '1987-08-11', 'unit', '2024-06-08 04:28:29', '2024-06-08 04:28:29'),
(3, 'Balance', 'Top Loading 25 kg. capacity Digital', 'NL Scientific', 1, '2023-01-04', 'unit', '2024-06-08 04:30:23', '2024-06-08 04:30:23'),
(4, 'Balance, Spring', '10 kg. capacity', '-', 2, '2001-10-17', 'pcs', '2024-06-08 04:31:47', '2024-06-08 04:31:47'),
(5, 'Beaker', '1000 ml', 'Pyrex, USA', 5, '2001-10-17', '-', '2024-06-08 04:32:38', '2024-06-08 04:32:38'),
(6, 'Blaine Air Permeability', 'consist of a U-tube, glass manometer, stop cock, rubber pump, supplied complete with filling funnel, filter paper and indicating fluid', '-', 1, '1984-02-24', 'unit', '2024-06-08 04:35:24', '2024-06-08 04:35:24'),
(7, 'Blaine Air Permeability', 'consist of a U-tube, glass manometer, stop cock, rubber pump, supplied complete with filling funnel, filter paper and indicating fluid', '-', 1, '2023-01-14', 'unit', '2024-06-08 04:36:16', '2024-06-08 04:36:16'),
(8, 'Buckner Funnel', 'porcelain', 'Pyrex', 3, '1987-06-02', 'pcs', '2024-06-08 04:38:42', '2024-06-08 04:38:42'),
(9, 'Calibration Bucket', 'steel', '-', 1, '1986-10-11', 'pcs', '2024-06-08 04:39:43', '2024-06-08 04:39:43'),
(10, 'California Bearing Ratio (CBR)', 'mechanical loading press 5000 kg. Proving ring, one centicimal dial gauge with micrometric adjustable bracket.', 'Technotest brand-T005/5 Italy 608', 1, '1986-10-11', 'unit', '2024-06-08 04:43:05', '2024-06-08 04:43:05'),
(11, 'Crowbar', '-', 'Locally fabricated', 5, '2002-01-20', 'pcs', '2024-06-08 04:43:52', '2024-06-08 04:43:52'),
(12, 'Cylinder Cone & Tamper', '-', '-', 1, '1984-02-26', 'pcs', '2024-06-08 04:44:57', '2024-06-08 04:44:57'),
(13, 'Extension meter assembly', '-', '-', 4, '2983-11-22', 'pcs', '2024-06-08 04:45:34', '2024-06-08 04:45:34'),
(14, 'Extractor', 'made of brass, three deck screen with different size of mesh', '-', 1, '1985-05-17', 'pcs', '2024-06-08 04:46:40', '2024-06-08 04:46:40'),
(15, 'Filter Flask', '-', 'pyrex', 3, '1987-06-02', 'pcs', '2024-06-08 04:47:51', '2024-06-08 04:47:51'),
(16, 'Flow mold', 'made up of bronze and cast iron, designed in accordance with ASRM-AASHTO', '-', 1, '1987-06-02', 'pcs', '2024-06-08 04:49:41', '2024-06-08 04:49:41'),
(17, 'Frame trimmer', 'facilitate mounting and rotation of soil sample trimming', '-', 1, '1987-02-20', 'pcs', '2024-06-08 04:50:48', '2024-06-08 04:50:48'),
(18, 'Gilmore Apparatus', 'consist of one needle point of each size, base support shaft and horizontal arm weight 2.5 kg.', 'ASTM - C-91', 1, '1987-02-20', 'pcs', '2024-06-08 04:53:03', '2024-06-08 04:53:03'),
(19, 'Glass Plate', '-', 'Asahi', 5, '1989-11-17', 'pcs', '2024-06-08 04:53:44', '2024-06-08 04:53:44'),
(20, 'Hydrometer Jar', '-', 'pyrex', 1, '1986-01-22', '-', '2024-06-08 04:54:23', '2024-06-08 04:54:23'),
(21, 'Hydrometer Soil', '-', 'Model 141', 1, '1983-11-22', '-', '2024-06-08 04:55:03', '2024-06-08 04:55:03'),
(22, 'Liquid Limit Device', 'a molded hard rubber-base, a die formed brass cup with ASTM type; plated steel for abrasion and rust resistance.', '-', 1, '1984-02-26', 'pcs', '2024-06-08 04:57:54', '2024-06-08 04:57:54'),
(23, 'Liquid Limit Device', 'a molded hard rubber-base, a die formed brass cup with ASTM type; plated steel for abrasion and rust resistance.', 'Marichs', 3, '1986-10-11', 'pcs', '2024-06-08 04:59:25', '2024-06-08 04:59:25'),
(24, 'Liquid Limit Device', 'Motorized unit', 'NL Scientific', 1, '2023-01-14', 'unit', '2024-06-08 05:00:24', '2024-06-08 05:00:24'),
(25, 'Mechanical Stirring Apparatus', 'a 220 Volts, 700 watts 3.3 ampere with 1300 rpm.', 'Makita, Japan UT1301 Serial no. 3535E', 1, '1984-02-24', 'pcs', '2024-06-08 05:04:55', '2024-06-08 05:04:55'),
(26, 'Mixing bowl', 'stainless', '-', 4, '1989-11-17', 'pcs', '2024-06-08 05:05:26', '2024-06-08 05:05:26'),
(27, 'Mixing Pan', 'aluminum w/ an area of 576 square inch', '-', 1, '1986-10-24', 'pcs', '2024-06-08 05:06:42', '2024-06-08 05:06:42'),
(28, 'Mixing Pan', 'With handle', '-', 1, '2023-01-14', 'pcs', '2024-06-08 05:07:17', '2024-06-08 05:07:17'),
(29, 'Moisture can', '-', 'GI', 24, '2002-01-27', 'pcs', '2024-06-08 05:08:28', '2024-06-08 05:08:28'),
(30, 'Moisture can', '-', 'GI', 12, '2023-01-14', 'pcs', '2024-06-08 05:09:01', '2024-06-08 05:09:01'),
(32, 'Mold beam 6 x 6', '-', 'Locally fabricated', 1, '1989-11-17', 'pcs', '2024-06-08 05:11:17', '2024-06-08 05:11:17'),
(33, 'Mold beam 6 x 6', '-', 'Steel, fabricated', 3, '2023-01-14', 'pcs', '2024-06-08 05:13:12', '2024-06-08 05:13:12'),
(34, 'Mortar & pestle', '-', 'Anchor', 6, '2001-10-17', '-', '2024-06-08 05:14:46', '2024-06-08 05:14:46'),
(35, 'Oven,', 'thermostat digital control', 'DN 500', 1, '2001-03-03', 'pcs', '2024-06-08 05:16:59', '2024-06-08 05:16:59'),
(36, 'Pan & cover', '-', 'Maruto, Japan', 1, '1987-08-18', '-', '2024-06-08 05:21:54', '2024-06-08 05:21:54'),
(37, 'Pan & cover', '-', 'Maruto, Japan', 1, '1986-04-05', '-', '2024-06-08 05:22:55', '2024-06-08 05:22:55'),
(38, 'Particle Size Analysis Set', 'especially designed for the sedimentation method. Tank dimension 300 x 420 x 550m depth and will accommodate six sedimentation cylinders, supplied complete with 1500w heater/thermostat.', 'Technotest /T-659', 1, '1986-10-11', 'unit', '2024-06-08 05:25:43', '2024-06-08 05:25:43'),
(39, 'Pentrometer', 'stainless steel designed for penetration test, cone 45mm. Ling with a smooth surface an angle of 60 degrees', 'Locally fabricated', 1, '1991-02-13', 'pcs', '2024-06-08 05:26:59', '2024-06-08 05:26:59'),
(41, 'Ph Meter', '-', '-', 1, '1989-11-17', 'unit', '2024-06-08 05:29:12', '2024-06-08 05:29:12'),
(42, 'Ph Meter', '-', 'HANNAH Inst.', 1, '2023-01-14', 'unit', '2024-06-08 05:29:39', '2024-06-08 05:29:39'),
(43, 'PickMattock', '-', 'RP', 2, '1985-12-07', 'pcs', '2024-06-08 05:30:51', '2024-06-08 05:30:51'),
(44, 'Pitot tube', 'w/ complete accessories', 'Stainless', 1, '1984-07-10', 'pcs', '2024-06-08 05:31:47', '2024-06-08 05:31:47'),
(45, 'Pycnometer', 'made of glass, adjusted type of specific gravity bottle with profated stipper', 'Pyrex', 1, '1989-11-17', 'pcs', '2024-06-08 05:33:01', '2024-06-08 05:33:01'),
(46, 'Pycnometer', 'made of glass, adjusted type of specific gravity bottle with perforated stipper', 'Hannah', 1, '2023-01-14', 'pcs', '2024-06-08 05:34:39', '2024-06-08 05:34:39'),
(47, 'Rubber Mallet', 'wooden and steel handle', 'Stanley', 2, '2001-11-17', '-', '2024-06-08 05:40:53', '2024-06-08 05:40:53'),
(48, 'Sample Ejector/Extruder', 'designed for extruding samples, finished with a screw jack and not three sizes of reaction plates and dish with a pushing force of 6000 lbs. In 8\" pushing length.', 'Shuchow, China', 1, '1986-10-11', 'unit', '2024-06-08 05:43:58', '2024-06-08 05:43:58'),
(49, 'Sample Ejector/Extruder', 'designed for extruding samples, finished with a screw jack and not three sizes of reaction plates and dish with a pushing force of 6000 lbs. In 8\" pushing length.', 'brass', 1, '2023-01-14', 'unit', '2024-06-08 05:44:25', '2024-06-08 05:44:25'),
(50, 'Sample Scoop', 'galvanized', '-', 1, '1986-10-11', 'pcs', '2024-06-08 05:45:07', '2024-06-08 05:45:07'),
(51, 'Sample Splitter', 'consisting of aluminum bars', 'Marichs', 1, '1983-11-22', 'unit', '2024-06-08 05:46:21', '2024-06-08 05:46:21'),
(52, 'Sand Funnel', 'w/ compete accessories, it measures in-place density of soils, glass and jug, top cone threaded into sand jug with valve control sand flow into density hole.', '-', 2, '1986-10-11', 'unit', '2024-06-08 05:48:40', '2024-06-08 05:48:40'),
(53, 'Sieve shaker', '-', 'Geotech', 1, '1986-10-11', 'unit', '2024-06-08 05:49:30', '2024-06-08 05:49:30'),
(54, 'Set of Weights', '-', '-', 2, '1988-12-07', 'set', '2024-06-08 05:50:02', '2024-06-08 05:50:02'),
(55, 'Standard Sieves', '-', 'Endecott, England', 4, '0001-01-01', 'pcs', '2024-06-08 05:51:31', '2024-06-08 05:51:31'),
(57, 'Standard Sieves', '-', 'England', 4, '1983-11-22', 'pcs', '2024-06-08 05:52:39', '2024-06-08 05:52:39'),
(58, 'Standard Sieves', '-', 'Standard, Japan', 20, '1987-08-18', 'pcs', '2024-06-08 05:53:11', '2024-06-08 05:53:11'),
(59, 'Standard Sieves', '-', 'Standard, USA', 16, '2023-01-14', 'pcs', '2024-06-08 05:53:42', '2024-06-08 05:53:42'),
(60, 'Shovel', '-', 'Eagle, USA', 5, '2001-10-17', '-', '2024-06-08 05:56:23', '2024-06-08 05:56:23'),
(61, 'Shovel', '-', '-', 7, '1985-12-07', 'pcs', '2024-06-08 05:57:16', '2024-06-08 05:57:16'),
(62, 'Shrinkage Limit Device', 'w/ grooving tool', '-', 1, '2001-11-18', 'pcs', '2024-06-08 05:59:02', '2024-06-08 05:59:02'),
(63, 'Shrinkage Limit Device', 'w/ grooving tool', 'NL Scientific', 1, '2023-01-14', 'pcs', '2024-06-08 05:59:41', '2024-06-08 05:59:41'),
(64, 'Soil Auger', 'stainless with extended accessories motorized', 'USA', 1, '2001-11-18', 'unit', '2024-06-08 06:00:46', '2024-06-08 06:00:46'),
(65, 'Soil Auger', 'stainless with extended accessories motorized', 'NL Scientific', 1, '2023-01-14', 'unit', '2024-06-08 06:01:11', '2024-06-08 06:01:11'),
(66, 'Soil sampler', '-', '-', 1, '1983-11-22', 'pcs', '2024-06-08 06:01:54', '2024-06-08 06:01:54'),
(67, 'Soil Hydrometer', '-', '-', 5, '1983-11-22', 'pcs', '2024-06-08 06:02:32', '2024-06-08 06:02:32'),
(69, 'Thermometer', 'Mercury', '-', 3, '1983-11-22', 'pcs', '2024-06-08 06:04:04', '2024-06-08 06:04:04'),
(70, 'Thermometer', 'digital', '-', 1, '2023-01-14', 'pcs', '2024-06-08 06:04:31', '2024-06-08 06:04:31'),
(71, 'Triaxal Testing Machine', 'loading capacity 1500 lbs., lateral pressure 110 psi, clear lucite cyl. 6\" 0.d. x1/4 thk', 'Germany', 1, '1985-05-11', 'unit', '2024-06-08 06:06:19', '2024-06-08 06:06:19'),
(72, 'Unconfined Compression Testing Machine', '-', '-', 1, '1984-07-10', 'unit', '2024-06-08 06:07:27', '2024-06-08 06:07:27'),
(73, 'Univeral Testing Machine', 'with complete accessories, shearing stress for wood and metal, compression test related to strength of materials.', 'Germany', 1, '1985-05-11', 'unit', '2024-06-08 06:09:23', '2024-06-08 06:09:23'),
(74, 'Univeral Testing Machine', 'Computerized w/ accessories', 'TBUTM', 1, '2023-01-14', 'unit', '2024-06-08 06:11:10', '2024-06-08 06:11:10'),
(75, 'Vicat Apparatus', 'reversible plunger, steel needle mounted in plunger with scale graduated in millimeter.', 'Germany', 1, '1985-05-11', 'unit', '2024-06-08 06:12:50', '2024-06-08 06:12:50'),
(76, 'Volumetric Flask', '500ml.', 'pyrex', 8, '1983-12-20', 'pcs', '2024-06-08 06:13:57', '2024-06-08 06:13:57'),
(77, 'Volumetric Measure', 'made of metal', 'pyrex', 2, '1983-12-20', 'pcs', '2024-06-08 06:14:36', '2024-06-08 06:14:36'),
(78, 'Water Bath', 'stainless', 'Aluminum', 1, '1983-12-20', 'pcs', '2024-06-08 06:15:16', '2024-06-08 06:15:16'),
(79, 'Wire Basket', 'stainless', 'GI mesh', 1, '1987-07-30', 'pcs', '2024-06-08 06:15:51', '2024-06-08 06:15:51'),
(80, 'Testing items 123', 'Testing items 123Testing items 123Testing items 123Testing items 123Testing items 123Testing items 123Testing items 123Testing items 123', 'Testing items 123', 3, '2024-09-23', 'pcs', '2024-09-23 14:27:58', '2024-09-23 14:27:58'),
(81, 'Testing items 123', 'Testing items 123Testing items 123Testing items 123Testing items 123Testing items 123Testing items 123Testing items 123Testing items 123', 'Testing items 123', 3, '2024-09-23', 'pcs', '2024-09-23 14:28:31', '2024-09-23 14:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `testing_serials`
--

CREATE TABLE `testing_serials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testing_serials`
--

INSERT INTO `testing_serials` (`id`, `product_id`, `serial_no`, `condition`, `created_at`, `updated_at`) VALUES
(1, 81, 'Testing items 123', 'Good', '2024-09-23 14:28:31', '2024-09-23 14:28:31'),
(2, 81, 'Testing items 1234', 'For Repair', '2024-09-23 14:28:31', '2024-09-23 14:28:31'),
(3, 81, 'Testing items 1235', 'Good', '2024-09-23 14:28:31', '2024-09-23 14:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `transactionoffice`
--

CREATE TABLE `transactionoffice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `datetime_borrowed` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'waiting for approval',
  `days_not_returned` int(11) NOT NULL DEFAULT 0,
  `datetime_returned` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactionoffice`
--

INSERT INTO `transactionoffice` (`id`, `user_name`, `item`, `quantity`, `purpose`, `datetime_borrowed`, `status`, `days_not_returned`, `datetime_returned`, `created_at`, `updated_at`) VALUES
(1, 'Lovely Nathalee Bautista', 'Electric Fan', 2, 'For Lr201', '2024-08-11 14:58:13', 'disapproved', 0, NULL, '2024-08-11 06:58:13', '2024-09-14 05:55:33'),
(2, 'Lovely Nathalee Bautista', 'Red Ink', 3, 'for printing', '2024-08-12 02:27:33', 'damaged', 0, '2024-08-12 02:28:34', '2024-08-11 18:27:33', '2024-08-11 18:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Lovely Nathalee Bautista', 'nathaleebautista@gmail.com', '2024-09-15 15:04:48', '$2y$10$5oS97tGIovNG662dX5Q.NOFV.GjGZZNe8YSmSqssppnEg6oKzUAa6', NULL, '2024-08-11 01:46:09', '2024-08-11 01:46:09'),
(2, 'Francess Liana Silva', 'silva@gmail.com', '2024-09-15 15:04:51', '$2y$10$5oS97tGIovNG662dX5Q.NOFV.GjGZZNe8YSmSqssppnEg6oKzUAa6', NULL, '2024-08-11 01:46:40', '2024-08-11 01:46:40'),
(3, 'My Name Is Laboratory', 'laboratory@gmail.com', '2024-09-15 15:04:53', '$2y$10$5oS97tGIovNG662dX5Q.NOFV.GjGZZNe8YSmSqssppnEg6oKzUAa6', NULL, '2024-08-11 01:47:28', '2024-08-11 01:47:28'),
(4, 'Marifel Grace Kummer', 'drkummer@gmail.com', '2024-09-15 15:04:55', '$2y$10$Z.hTnp5dDGBcbvy..gQdRei/rbQU4m532lFLqQnwcpfTIeJjoCBxy', NULL, '2024-08-11 01:48:28', '2024-12-21 14:13:02'),
(6, 'Lovely Nathalee Bautista', 'lovelynathaleebautista@gmail.com', '2024-09-15 15:04:59', '$2y$10$5oS97tGIovNG662dX5Q.NOFV.GjGZZNe8YSmSqssppnEg6oKzUAa6', NULL, '2024-09-13 17:49:34', '2024-09-13 17:49:34'),
(9, 'Administrator', 'administrator@gmail.com', '2024-09-15 15:11:06', '$2y$10$5oS97tGIovNG662dX5Q.NOFV.GjGZZNe8YSmSqssppnEg6oKzUAa6', NULL, '2024-09-15 07:11:01', '2024-09-15 07:11:01'),
(14, 'Ramona Thornton', 'venelafub@mailinator.com', NULL, '$2y$10$GIX82dJhZ.RRJQjskfWAaetUwdeZ/c327wmSB/a0m7b7lp2lOqcVi', NULL, '2024-12-30 12:30:18', '2024-12-30 12:30:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `computer_engineering`
--
ALTER TABLE `computer_engineering`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `computer_engineering_serials`
--
ALTER TABLE `computer_engineering_serials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `computer_engineering_serials_product_id_foreign` (`product_id`);

--
-- Indexes for table `construction`
--
ALTER TABLE `construction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `construction_serials`
--
ALTER TABLE `construction_serials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `construction_serials_product_id_foreign` (`product_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_items`
--
ALTER TABLE `equipment_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_items_equipment_id_foreign` (`equipment_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fluid`
--
ALTER TABLE `fluid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fluid_serials`
--
ALTER TABLE `fluid_serials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fluid_serials_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `office_requests`
--
ALTER TABLE `office_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `office_requests_item_id_item_type_index` (`item_id`,`item_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisitions_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `requisitions_items`
--
ALTER TABLE `requisitions_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisitions_items_requisition_id_foreign` (`requisition_id`);

--
-- Indexes for table `requisitions_items_students`
--
ALTER TABLE `requisitions_items_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisitions_items_students_requisition_id_foreign` (`requisition_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplies_items`
--
ALTER TABLE `supplies_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplies_items_supplies_id_foreign` (`supplies_id`);

--
-- Indexes for table `surveyings`
--
ALTER TABLE `surveyings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveying_serials`
--
ALTER TABLE `surveying_serials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surveying_serials_product_id_foreign` (`product_id`);

--
-- Indexes for table `teachersborrow`
--
ALTER TABLE `teachersborrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testings`
--
ALTER TABLE `testings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testing_serials`
--
ALTER TABLE `testing_serials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testing_serials_product_id_foreign` (`product_id`);

--
-- Indexes for table `transactionoffice`
--
ALTER TABLE `transactionoffice`
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
-- AUTO_INCREMENT for table `computer_engineering`
--
ALTER TABLE `computer_engineering`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `computer_engineering_serials`
--
ALTER TABLE `computer_engineering_serials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `construction`
--
ALTER TABLE `construction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `construction_serials`
--
ALTER TABLE `construction_serials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `equipment_items`
--
ALTER TABLE `equipment_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fluid`
--
ALTER TABLE `fluid`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `fluid_serials`
--
ALTER TABLE `fluid_serials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `office_requests`
--
ALTER TABLE `office_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `requisitions_items`
--
ALTER TABLE `requisitions_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `requisitions_items_students`
--
ALTER TABLE `requisitions_items_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `supplies_items`
--
ALTER TABLE `supplies_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `surveyings`
--
ALTER TABLE `surveyings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `surveying_serials`
--
ALTER TABLE `surveying_serials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachersborrow`
--
ALTER TABLE `teachersborrow`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testings`
--
ALTER TABLE `testings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `testing_serials`
--
ALTER TABLE `testing_serials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactionoffice`
--
ALTER TABLE `transactionoffice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `computer_engineering_serials`
--
ALTER TABLE `computer_engineering_serials`
  ADD CONSTRAINT `computer_engineering_serials_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `computer_engineering` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `construction_serials`
--
ALTER TABLE `construction_serials`
  ADD CONSTRAINT `construction_serials_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `construction` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `equipment_items`
--
ALTER TABLE `equipment_items`
  ADD CONSTRAINT `equipment_items_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fluid_serials`
--
ALTER TABLE `fluid_serials`
  ADD CONSTRAINT `fluid_serials_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `fluid` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD CONSTRAINT `requisitions_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requisitions_items`
--
ALTER TABLE `requisitions_items`
  ADD CONSTRAINT `requisitions_items_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requisitions_items_students`
--
ALTER TABLE `requisitions_items_students`
  ADD CONSTRAINT `requisitions_items_students_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supplies_items`
--
ALTER TABLE `supplies_items`
  ADD CONSTRAINT `supplies_items_supplies_id_foreign` FOREIGN KEY (`supplies_id`) REFERENCES `supplies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surveying_serials`
--
ALTER TABLE `surveying_serials`
  ADD CONSTRAINT `surveying_serials_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `surveyings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `testing_serials`
--
ALTER TABLE `testing_serials`
  ADD CONSTRAINT `testing_serials_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `testings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
