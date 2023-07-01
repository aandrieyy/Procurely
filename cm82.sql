-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 08:09 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cm82`
--

-- --------------------------------------------------------

--
-- Table structure for table `annual_budget`
--

CREATE TABLE `annual_budget` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` varchar(20) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `type` varchar(3) NOT NULL COMMENT ' in or out',
  `new_amt` decimal(18,2) NOT NULL,
  `remarks` text NOT NULL,
  `transaction_description` varchar(60) NOT NULL,
  `signature` varchar(50) NOT NULL,
  `created_by` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `annual_budget`
--

INSERT INTO `annual_budget` (`id`, `date`, `amount`, `type`, `new_amt`, `remarks`, `transaction_description`, `signature`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2023-06-27', '100000.00', 'in', '100000.00', '', '', '', '272', '2023-06-27 10:02:31', '0000-00-00 00:00:00', NULL),
(2, '2023-06-27', '1000000.00', 'in', '1100000.00', '', '', '', '272', '2023-06-27 10:04:01', '0000-00-00 00:00:00', NULL),
(3, '2023-06-01', '1000.00', 'in', '1101000.00', '', '', '', '272', '2023-06-27 17:16:33', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `id` int(11) NOT NULL,
  `budget_officer_id` int(11) NOT NULL,
  `funds_type_id` int(11) NOT NULL,
  `prepared_by` int(11) NOT NULL,
  `attested_by` int(11) NOT NULL,
  `president` int(11) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `deleted_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_department`
--

CREATE TABLE `assigned_department` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_department_head` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned_department`
--

INSERT INTO `assigned_department` (`id`, `id_department_head`, `department_id`, `deleted_at`) VALUES
(1, 222, 1, NULL),
(2, 222, 2, NULL),
(3, 222, 3, NULL),
(4, 221, 1, '2023-06-15 00:00:00'),
(5, 221, 2, NULL),
(6, 221, 3, NULL),
(7, 223, 1, NULL),
(8, 221, 4, NULL),
(9, 226, 2, NULL),
(10, 228, 2, NULL),
(11, 229, 6, NULL),
(12, 230, 31, NULL),
(13, 231, 5, NULL),
(14, 233, 11, NULL),
(15, 234, 18, NULL),
(16, 235, 12, NULL),
(17, 236, 13, NULL),
(18, 237, 14, NULL),
(19, 238, 15, NULL),
(20, 239, 16, NULL),
(21, 240, 7, NULL),
(22, 242, 20, NULL),
(23, 243, 19, NULL),
(24, 244, 21, NULL),
(25, 245, 22, NULL),
(26, 248, 35, NULL),
(27, 249, 8, NULL),
(28, 250, 9, NULL),
(29, 251, 10, NULL),
(30, 253, 36, NULL),
(31, 254, 5, NULL),
(32, 255, 37, NULL),
(33, 256, 6, NULL),
(34, 258, 38, NULL),
(35, 259, 25, NULL),
(36, 260, 23, NULL),
(37, 262, 26, NULL),
(38, 263, 28, NULL),
(39, 264, 27, NULL),
(40, 265, 39, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `budget_proposals`
--

CREATE TABLE `budget_proposals` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `proposal_name` varchar(150) NOT NULL,
  `proposal_file` varchar(150) NOT NULL,
  `amount` decimal(18,4) NOT NULL,
  `status` int(10) UNSIGNED NOT NULL,
  `status_remarks` text NOT NULL,
  `update_by` int(11) NOT NULL,
  `signature` varchar(150) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_category_type` int(10) UNSIGNED NOT NULL,
  `id_main` int(10) UNSIGNED NOT NULL,
  `category` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `del_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `id_category_type`, `id_main`, `category`, `description`, `dt`, `del_status`) VALUES
(1, 4, 0, '2022', '', '2023-05-21 13:22:01', 1),
(2, 4, 0, '2023', '', '2023-05-21 13:22:05', 1),
(3, 4, 0, '2023', '', '2023-05-21 13:22:09', 0),
(4, 8, 0, 'Approve', '', '2023-05-21 13:30:40', 1),
(5, 8, 0, 'Reject', '', '2023-05-21 13:30:44', 0),
(6, 9, 0, 'Bid and Awards Committee Office', '', '2023-05-21 14:49:35', 1),
(7, 9, 0, 'Mathematics Department', '', '2023-05-21 14:49:42', 1),
(8, 9, 0, 'Physics Department', '', '2023-05-21 14:49:46', 1),
(9, 10, 0, 'Fund 101', 'General Funds', '2023-05-21 14:51:54', 1),
(10, 10, 0, 'Fund 164', 'Revolving funds', '2023-05-21 14:52:04', 1),
(11, 11, 0, 'Paper Products', '', '2023-05-22 17:44:04', 1),
(12, 12, 0, 'Box/es', '', '2023-05-22 17:46:41', 1),
(13, 12, 0, 'Piece/s', '', '2023-05-22 17:46:45', 1),
(14, 13, 0, 'CSE Item', '', '2023-05-22 18:23:01', 1),
(15, 13, 0, 'Non-CSE Item', '', '2023-05-22 18:23:18', 1),
(17, 7, 0, 'Shopping', '', '2023-05-22 18:33:37', 1),
(18, 4, 0, '2024', '', '2023-06-16 00:19:44', 1),
(19, 11, 0, 'Office Supplies', '', '2023-06-26 12:41:56', 1),
(20, 11, 0, 'Janitorial Supplies', '', '2023-06-26 12:42:25', 1),
(21, 7, 0, 'Small Value Procurement', '', '2023-06-26 12:45:35', 1),
(22, 7, 0, 'Bidding', '', '2023-06-26 12:45:43', 1),
(23, 11, 0, 'Batteries and Cells and Accessories', '', '2023-06-26 12:48:53', 0),
(24, 11, 0, 'Heating and Ventilation and Air Circulation', '', '2023-06-26 12:49:23', 0),
(25, 11, 0, 'Pesticides or Pest Repellents', '', '2023-06-26 12:57:14', 0),
(26, 11, 0, 'Perfume or Cologne or Fragrances', '', '2023-06-26 12:57:37', 0),
(27, 11, 0, 'Alcohol or Acetone based Antiseptics', '', '2023-06-26 12:58:09', 0),
(28, 12, 0, 'Bottle/s', '', '2023-06-26 12:58:44', 1),
(29, 11, 0, 'Electrical Supplies', '', '2023-06-26 13:11:34', 1),
(30, 11, 0, 'Computer Supplies', '', '2023-06-26 13:12:18', 1),
(31, 11, 0, 'Writing Supplies', '', '2023-06-26 13:13:03', 1),
(32, 12, 0, 'Pack/s', '', '2023-06-26 13:13:43', 1),
(33, 12, 0, 'Unit/s', '', '2023-06-26 13:14:00', 1),
(34, 11, 0, 'Office Equipment', '', '2023-06-26 13:28:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_types`
--

CREATE TABLE `category_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `del_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_types`
--

INSERT INTO `category_types` (`id`, `type`, `dt`, `del_status`) VALUES
(4, 'years', '2023-04-10 13:29:35', 1),
(6, 'announcements', '2023-04-11 04:19:40', 1),
(7, 'mode_of_procurements', '2023-05-21 13:24:55', 1),
(8, 'ppmp_status', '2023-05-21 13:30:06', 1),
(9, 'budget_department', '2023-05-21 14:33:03', 1),
(10, 'funds_type', '2023-05-21 14:33:03', 1),
(11, 'item_type', '2023-05-22 17:43:35', 1),
(12, 'units', '2023-05-22 17:46:02', 1),
(13, 'item_categories', '2023-05-22 18:21:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(10) UNSIGNED NOT NULL,
  `sector_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `sector_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'College of Science', '2023-06-19 09:41:46', '2023-06-26 00:00:00', NULL),
(2, 2, 'College of Industrial Education', '2023-06-19 09:42:02', '2023-06-26 00:00:00', NULL),
(3, 2, 'College of Industrial Technology', '2023-06-19 09:42:16', '2023-06-26 00:00:00', NULL),
(4, 2, 'College of Engineering', '2023-06-19 09:42:31', '2023-06-26 00:00:00', NULL),
(5, 2, 'College of Liberal Arts', '2023-06-19 09:42:39', '2023-06-26 00:00:00', NULL),
(6, 2, 'College of Architecture and Fine Arts', '2023-06-19 09:42:55', '2023-06-24 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `college_budget`
--

CREATE TABLE `college_budget` (
  `id` int(10) UNSIGNED NOT NULL,
  `college_id` int(10) UNSIGNED NOT NULL,
  `id_funds_type` int(10) UNSIGNED NOT NULL,
  `funds` decimal(18,2) NOT NULL,
  `type` varchar(3) NOT NULL,
  `new_amt` decimal(18,2) NOT NULL,
  `remarks` text NOT NULL,
  `transaction_description` varchar(60) NOT NULL,
  `signature` text NOT NULL,
  `created_by` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `notif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `college_budget`
--

INSERT INTO `college_budget` (`id`, `college_id`, `id_funds_type`, `funds`, `type`, `new_amt`, `remarks`, `transaction_description`, `signature`, `created_by`, `created_at`, `updated_at`, `deleted_at`, `notif`) VALUES
(1, 4, 9, '50000.00', '', '0.00', '', '', '', '', '2023-06-27 10:08:45', NULL, NULL, 0),
(2, 6, 9, '50000.00', '', '0.00', '', '', '', '', '2023-06-27 10:09:08', NULL, NULL, 0),
(3, 5, 10, '6000.00', '', '0.00', '', '', '', '', '2023-06-27 17:17:38', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `college_departments`
--

CREATE TABLE `college_departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `college_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college_departments`
--

INSERT INTO `college_departments` (`id`, `college_id`, `department_id`, `deleted_at`) VALUES
(1, 6, 1, NULL),
(2, 6, 2, NULL),
(3, 6, 2, NULL),
(4, 6, 3, NULL),
(5, 5, 4, NULL),
(6, 1, 2, NULL),
(7, 1, 3, NULL),
(8, 1, 6, NULL),
(9, 1, 5, NULL),
(10, 2, 10, NULL),
(11, 2, 7, NULL),
(12, 2, 8, NULL),
(13, 2, 9, NULL),
(14, 3, 11, NULL),
(15, 3, 12, NULL),
(16, 3, 12, NULL),
(17, 3, 13, NULL),
(18, 3, 14, NULL),
(19, 3, 15, NULL),
(20, 3, 16, NULL),
(21, 3, 17, NULL),
(22, 3, 18, NULL),
(23, 6, 25, NULL),
(24, 1, 9, '2023-06-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `sector_id` int(10) UNSIGNED NOT NULL,
  `college_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `sector_id`, `college_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 6, 'Bid and Awards Committee Office', '2023-05-22 23:01:09', '2023-05-22 00:00:00', '2023-06-20 00:00:00'),
(2, 2, 6, 'Mathematics Department', '2023-05-22 23:04:02', '2023-06-20 00:00:00', '2023-06-20 00:00:00'),
(3, 2, 6, 'Physics Department', '2023-05-22 23:04:09', NULL, '2023-06-20 00:00:00'),
(4, 2, 6, 'Department Liberal', '2023-06-19 22:49:45', NULL, '2023-06-21 00:00:00'),
(5, 2, 1, 'Chemistry Department', '2023-06-19 16:15:51', '2023-06-26 00:00:00', NULL),
(6, 2, 1, 'Computer Studies Department', '2023-06-19 16:17:47', '2023-06-26 00:00:00', NULL),
(7, 2, 3, 'Student Teaching Department  CIT', '2023-06-19 16:18:28', '2023-06-26 00:00:00', NULL),
(8, 2, 2, 'Technical Arts Department', '2023-06-19 16:18:48', '2023-06-26 00:00:00', NULL),
(9, 2, 2, 'Home Economics Department', '2023-06-19 16:19:07', '2023-06-26 00:00:00', NULL),
(10, 2, 2, 'Professional Industrial Education Department', '2023-06-19 16:19:46', '2023-06-26 00:00:00', NULL),
(11, 2, 3, 'Basic Industrial Technology Department', '2023-06-19 17:16:18', '2023-06-26 00:00:00', NULL),
(12, 2, 3, 'Food and Apparel Technology Department', '2023-06-19 17:18:57', '2023-06-26 00:00:00', NULL),
(13, 2, 3, 'Graphics Arts and Printing Technology Department', '2023-06-19 17:19:40', '2023-06-26 00:00:00', NULL),
(14, 2, 3, 'Mechanical Engineering Technology Department', '2023-06-19 17:20:08', '2023-06-26 00:00:00', NULL),
(15, 2, 3, 'Power Plant Engineering Technology Department', '2023-06-19 17:21:03', '2023-06-26 00:00:00', NULL),
(16, 2, 3, 'Electronics Engineering Technology Department', '2023-06-19 17:21:45', '2023-06-26 00:00:00', NULL),
(17, 2, 6, 'Electrical Engineering Technology Department', '2023-06-19 17:22:16', NULL, NULL),
(18, 2, 3, 'Civil Engineering Technology Department', '2023-06-19 17:22:39', '2023-06-26 00:00:00', NULL),
(19, 2, 4, 'Electronics Communication Engineering Department', '2023-06-19 17:24:15', '2023-06-26 00:00:00', NULL),
(20, 2, 4, 'Electrical Engineering Department', '2023-06-19 17:24:36', '2023-06-26 00:00:00', NULL),
(21, 2, 4, 'Mechanical Engineering Department', '2023-06-19 17:24:58', '2023-06-26 00:00:00', NULL),
(22, 2, 4, 'Civil Engineering Department', '2023-06-19 17:25:16', '2023-06-26 00:00:00', NULL),
(23, 2, 6, 'Graphics Department', '2023-06-19 17:25:56', NULL, NULL),
(24, 2, 6, 'Architecture Department', '2023-06-19 17:26:12', NULL, '2023-06-22 00:00:00'),
(25, 2, 6, 'Fine Arts Department', '2023-06-19 17:26:27', NULL, NULL),
(26, 2, 5, 'Languages Department', '2023-06-19 17:26:47', '2023-06-26 00:00:00', NULL),
(27, 2, 5, 'Social Science Department', '2023-06-19 17:27:07', '2023-06-26 00:00:00', NULL),
(28, 2, 5, 'Entrepreneurship and Management Department', '2023-06-19 17:27:38', '2023-06-26 00:00:00', NULL),
(29, 2, 6, 'Physical Education Department', '2023-06-19 17:27:57', NULL, '2023-06-22 00:00:00'),
(30, 2, 6, 'Physical Education Department', '2023-06-19 17:27:57', NULL, '2023-06-20 00:00:00'),
(31, 2, 6, 'Physics Department', '2023-06-20 00:40:41', NULL, '2023-06-22 00:00:00'),
(33, 2, 3, 'Civil Engineering Technology Department', '2023-06-26 08:15:00', NULL, '2023-06-26 00:00:00'),
(34, 2, 3, 'Food And Apparel Technology Department', '2023-06-26 08:15:33', NULL, '2023-06-26 00:00:00'),
(35, 2, 2, 'Student Teaching Department CIE', '2023-06-26 08:26:23', NULL, NULL),
(36, 2, 1, 'Mathematics Department', '2023-06-26 08:28:21', NULL, NULL),
(37, 2, 1, 'Physics Department', '2023-06-26 08:28:40', NULL, NULL),
(38, 2, 6, 'Architecture Department', '2023-06-26 08:30:10', NULL, NULL),
(39, 2, 5, 'Physical Education Department', '2023-06-26 08:32:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `id`
--

CREATE TABLE `id` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sector` int(10) UNSIGNED NOT NULL,
  `date` varchar(20) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `type` varchar(3) NOT NULL COMMENT 'in or out',
  `remarks` text NOT NULL,
  `transaction_description` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `item_type_id` int(10) UNSIGNED NOT NULL,
  `item_categories_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(60) NOT NULL,
  `description` varchar(150) NOT NULL,
  `unit_price` decimal(18,2) NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `project_id`, `item_type_id`, `item_categories_id`, `code`, `description`, `unit_price`, `unit_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 11, 14, '101204', 'Envelope - Brown Legal Size', '458.94', 12, '2023-06-13 10:15:20', '0000-00-00 00:00:00', '2023-06-26 00:00:00'),
(2, 1, 11, 15, '101081', 'Dell Monitor 20 inch', '4500.00', 13, '2023-06-13 10:15:33', '0000-00-00 00:00:00', '2023-06-26 00:00:00'),
(3, 1, 30, 15, '101081', 'Dell Monitor 20 inch', '4500.00', 33, '2023-06-26 13:16:03', '0000-00-00 00:00:00', '2023-06-26 00:00:00'),
(4, 6, 29, 14, '101082', 'BATTERY, dry cell, AA, 2 pieces per blister pack', '30.00', 32, '2023-06-26 13:20:48', '0000-00-00 00:00:00', NULL),
(5, 6, 29, 14, '101083', 'BATTERY, dry cell, AAA, 2 pieces per blister pack', '30.00', 32, '2023-06-26 13:21:29', '0000-00-00 00:00:00', NULL),
(6, 6, 29, 14, '101084', 'Electrical Tape', '25.00', 13, '2023-06-26 13:22:30', '0000-00-00 00:00:00', NULL),
(7, 6, 30, 14, '12212', 'DVD RE-WRITABLE', '30.00', 13, '2023-06-26 13:23:52', '0000-00-00 00:00:00', NULL),
(8, 6, 30, 14, '12213', 'EXTERNAL HARD DRIVE, 1TB, 2.5\"HDD, USB 3.0, ', '3000.00', 33, '2023-06-26 13:24:37', '0000-00-00 00:00:00', NULL),
(9, 6, 30, 14, '12214', 'FLASH DRIVE, 16 GB ', '200.00', 13, '2023-06-26 13:25:23', '0000-00-00 00:00:00', NULL),
(10, 6, 30, 14, '11004', 'MOUSE, OPTICAL, USB CONNECTION TYPE,', '150.00', 33, '2023-06-26 13:27:11', '0000-00-00 00:00:00', NULL),
(11, 6, 31, 14, '11001', 'MARKER, PERMANENT (black)', '20.00', 13, '2023-06-26 13:46:37', '0000-00-00 00:00:00', NULL),
(12, 6, 31, 14, '11001', 'MARKER, PERMANENT (blue)', '20.00', 13, '2023-06-26 13:47:11', '0000-00-00 00:00:00', NULL),
(13, 6, 31, 14, '11001', 'MARKER, PERMANENT (red)', '20.00', 13, '2023-06-26 13:47:44', '0000-00-00 00:00:00', NULL),
(14, 6, 31, 14, '11002', 'MARKER, WHITEBOARD (blue)', '20.00', 13, '2023-06-26 13:56:26', '0000-00-00 00:00:00', NULL),
(15, 6, 31, 14, '11002', 'MARKER, WHITEBOARD (red)', '20.00', 13, '2023-06-26 13:57:00', '0000-00-00 00:00:00', NULL),
(16, 6, 31, 14, '11002', 'MARKER, WHITEBOARD (black)', '20.00', 13, '2023-06-26 13:57:27', '0000-00-00 00:00:00', NULL),
(17, 6, 31, 14, '11003', 'PENCIL, LEAD WITH ERASER, 12 dozens ', '130.00', 12, '2023-06-26 14:09:08', '0000-00-00 00:00:00', NULL),
(18, 8, 29, 15, '100049', 'Electric Fan', '756.98', 13, '2023-06-27 06:52:00', '0000-00-00 00:00:00', NULL),
(19, 8, 29, 15, '100849', '1.5 hp Aircon Inverter', '28.00', 13, '2023-06-27 06:53:12', '0000-00-00 00:00:00', '2023-06-27 00:00:00'),
(20, 8, 29, 15, '100089', '1.5 HP Air Conditioner (Inverter)', '23.00', 13, '2023-06-27 06:54:34', '0000-00-00 00:00:00', '2023-06-27 00:00:00'),
(21, 8, 30, 15, '100389', '20\" inch Dell Monitor', '5600.00', 33, '2023-06-27 06:55:48', '0000-00-00 00:00:00', NULL),
(22, 8, 34, 15, '100998', '1.5 hp Carrier Air Conditioner (Inverter)', '25989.00', 33, '2023-06-27 06:57:36', '0000-00-00 00:00:00', NULL),
(23, 8, 34, 15, '190848', 'Water Dispenser', '7400.00', 33, '2023-06-27 06:58:22', '0000-00-00 00:00:00', NULL),
(24, 8, 34, 15, '189034', 'Epson Printer', '8900.00', 33, '2023-06-27 06:59:32', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `notif` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notif`, `user_id`, `status`, `created_at`) VALUES
(1, 'Sector (Office of the President) receives a new budget (₱400.00)', 218, 1, '2023-06-13 10:03:10'),
(2, 'Sector (Office of the President) receives a new budget (₱400.00)', 1, 1, '2023-06-13 10:03:10'),
(3, 'Department (Bid and Awards Committee Office) receives a new budget (₱50.00)', 218, 1, '2023-06-13 10:05:11'),
(4, 'Department (Bid and Awards Committee Office) receives a new budget (₱50.00)', 222, 0, '2023-06-13 10:05:11'),
(5, 'Department (Bid and Awards Committee Office) receives a new budget (₱50.00)', 221, 1, '2023-06-13 10:05:11'),
(6, 'Department (Bid and Awards Committee Office) receives a new budget (₱50.00)', 217, 1, '2023-06-13 10:05:11'),
(7, 'Department (Bid and Awards Committee Office) receives a new budget (₱50.00)', 1, 1, '2023-06-13 10:05:11'),
(8, 'Department (Bid and Awards Committee Office) receives a new budget (₱50.00)', 218, 1, '2023-06-13 10:10:47'),
(9, 'Department (Bid and Awards Committee Office) receives a new budget (₱50.00)', 222, 0, '2023-06-13 10:10:47'),
(10, 'Department (Bid and Awards Committee Office) receives a new budget (₱50.00)', 221, 1, '2023-06-13 10:10:47'),
(11, 'Department (Bid and Awards Committee Office) receives a new budget (₱50.00)', 217, 1, '2023-06-13 10:10:47'),
(12, 'Department (Bid and Awards Committee Office) receives a new budget (₱50.00)', 1, 1, '2023-06-13 10:10:47'),
(13, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-13 10:15:53'),
(14, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-13 10:15:53'),
(15, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-13 10:15:53'),
(16, 'PPMP for project (PPMP of BAC) was approved', 222, 0, '2023-06-13 10:18:08'),
(17, 'PPMP for project (PPMP of BAC) was approved', 221, 1, '2023-06-13 10:18:08'),
(18, 'PPMP for project (PPMP of BAC) was approved', 217, 1, '2023-06-13 10:18:08'),
(19, 'PPMP for project (PPMP of BAC) was approved', 1, 1, '2023-06-13 10:18:08'),
(20, 'Department (Mathematics Department) receives a new budget (₱300.00)', 218, 1, '2023-06-15 06:00:25'),
(21, 'Department (Mathematics Department) receives a new budget (₱300.00)', 222, 0, '2023-06-15 06:00:25'),
(22, 'Department (Mathematics Department) receives a new budget (₱300.00)', 221, 1, '2023-06-15 06:00:25'),
(23, 'Department (Mathematics Department) receives a new budget (₱300.00)', 217, 1, '2023-06-15 06:00:25'),
(24, 'Department (Mathematics Department) receives a new budget (₱300.00)', 1, 1, '2023-06-15 06:00:25'),
(25, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-15 23:22:18'),
(26, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-15 23:22:18'),
(27, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-15 23:22:18'),
(28, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-15 23:23:15'),
(29, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-15 23:23:15'),
(30, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-15 23:23:15'),
(31, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-15 23:25:14'),
(32, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-15 23:25:14'),
(33, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-15 23:25:14'),
(34, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-15 23:32:43'),
(35, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-15 23:32:43'),
(36, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-15 23:32:43'),
(37, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-16 00:06:02'),
(38, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-16 00:06:02'),
(39, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-16 00:06:02'),
(40, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-16 00:08:45'),
(41, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-16 00:08:45'),
(42, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-16 00:08:45'),
(43, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-16 00:09:42'),
(44, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-16 00:09:42'),
(45, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-16 00:09:42'),
(46, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-16 00:17:59'),
(47, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-16 00:17:59'),
(48, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-16 00:17:59'),
(49, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-16 06:50:15'),
(50, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-16 06:50:15'),
(51, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-16 06:50:15'),
(52, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-16 06:51:38'),
(53, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-16 06:51:38'),
(54, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-16 06:51:38'),
(55, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-16 00:27:44'),
(56, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-16 00:27:44'),
(57, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-16 00:27:44'),
(58, 'PPMP for project (PPMP of BAC) was approved', 222, 0, '2023-06-16 00:28:52'),
(59, 'PPMP for project (PPMP of BAC) was approved', 221, 0, '2023-06-16 00:28:52'),
(60, 'PPMP for project (PPMP of BAC) was approved', 217, 1, '2023-06-16 00:28:52'),
(61, 'PPMP for project (PPMP of BAC) was approved', 1, 1, '2023-06-16 00:28:52'),
(62, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-16 05:26:45'),
(63, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-16 05:26:45'),
(64, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-16 05:26:45'),
(65, 'PPMP for project (PPMP of BAC) was approved', 222, 0, '2023-06-16 05:27:43'),
(66, 'PPMP for project (PPMP of BAC) was approved', 221, 0, '2023-06-16 05:27:43'),
(67, 'PPMP for project (PPMP of BAC) was approved', 217, 1, '2023-06-16 05:27:43'),
(68, 'PPMP for project (PPMP of BAC) was approved', 1, 1, '2023-06-16 05:27:43'),
(69, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-19 18:14:38'),
(70, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-19 18:14:38'),
(71, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-19 18:14:38'),
(72, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-19 20:08:43'),
(73, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-19 20:08:43'),
(74, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-19 20:08:43'),
(75, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-19 20:49:08'),
(76, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-19 20:49:08'),
(77, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-19 20:49:08'),
(78, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-19 22:56:23'),
(79, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-19 22:56:23'),
(80, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-19 22:56:23'),
(81, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-19 23:00:32'),
(82, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-19 23:00:32'),
(83, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-19 23:00:32'),
(84, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-19 23:09:45'),
(85, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-19 23:09:45'),
(86, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-19 23:09:45'),
(87, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-19 15:40:51'),
(88, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-19 15:40:51'),
(89, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-19 15:40:51'),
(90, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-20 00:57:21'),
(91, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-20 00:57:21'),
(92, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-20 00:57:21'),
(93, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-20 00:59:24'),
(94, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-20 00:59:24'),
(95, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-20 00:59:24'),
(96, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-20 01:00:41'),
(97, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-20 01:00:41'),
(98, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-20 01:00:41'),
(99, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-20 14:46:07'),
(100, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-20 14:46:07'),
(101, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-20 14:46:07'),
(102, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-21 13:24:33'),
(103, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-21 13:24:33'),
(104, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-21 13:24:33'),
(105, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-24 23:51:41'),
(106, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-24 23:51:41'),
(107, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-24 23:51:41'),
(108, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-24 23:53:53'),
(109, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-24 23:53:53'),
(110, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-24 23:53:53'),
(111, 'PPMP for project (PPMP of BAC) was approved', 240, 0, '2023-06-26 09:21:02'),
(112, 'PPMP for project (PPMP of BAC) was approved', 239, 0, '2023-06-26 09:21:02'),
(113, 'PPMP for project (PPMP of BAC) was approved', 238, 0, '2023-06-26 09:21:02'),
(114, 'PPMP for project (PPMP of BAC) was approved', 237, 0, '2023-06-26 09:21:02'),
(115, 'PPMP for project (PPMP of BAC) was approved', 236, 0, '2023-06-26 09:21:02'),
(116, 'PPMP for project (PPMP of BAC) was approved', 235, 0, '2023-06-26 09:21:02'),
(117, 'PPMP for project (PPMP of BAC) was approved', 234, 0, '2023-06-26 09:21:02'),
(118, 'PPMP for project (PPMP of BAC) was approved', 233, 1, '2023-06-26 09:21:02'),
(119, 'PPMP for project (PPMP of BAC) was approved', 1, 1, '2023-06-26 09:21:02'),
(120, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-26 12:08:09'),
(121, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-26 12:08:09'),
(122, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-26 12:08:09'),
(123, 'New PPMP was created for project (PPMP of BAC)', 220, 1, '2023-06-26 12:09:18'),
(124, 'New PPMP was created for project (PPMP of BAC)', 218, 1, '2023-06-26 12:09:18'),
(125, 'New PPMP was created for project (PPMP of BAC)', 1, 1, '2023-06-26 12:09:18'),
(126, 'New PPMP was created for project (PPMP of BIT)', 220, 1, '2023-06-26 12:46:49'),
(127, 'New PPMP was created for project (PPMP of BIT)', 218, 1, '2023-06-26 12:46:49'),
(128, 'New PPMP was created for project (PPMP of BIT)', 1, 1, '2023-06-26 12:46:49'),
(129, 'New PPMP was created for project (PPMP of BIT)', 220, 1, '2023-06-26 12:47:47'),
(130, 'New PPMP was created for project (PPMP of BIT)', 218, 1, '2023-06-26 12:47:47'),
(131, 'New PPMP was created for project (PPMP of BIT)', 1, 1, '2023-06-26 12:47:47'),
(132, 'New PPMP was created for project (PPMP of BIT)', 220, 1, '2023-06-26 12:48:36'),
(133, 'New PPMP was created for project (PPMP of BIT)', 218, 1, '2023-06-26 12:48:36'),
(134, 'New PPMP was created for project (PPMP of BIT)', 1, 1, '2023-06-26 12:48:36'),
(135, 'Sector (Office of the VP for Academic Affairs) receives a new budget (₱10,000,000.00)', 218, 0, '2023-06-26 13:10:11'),
(136, 'Sector (Office of the VP for Academic Affairs) receives a new budget (₱10,000,000.00)', 1, 1, '2023-06-26 13:10:11'),
(137, 'Sector (Office of the President) receives a new budget (₱20,000,000.00)', 218, 0, '2023-06-26 13:10:53'),
(138, 'Sector (Office of the President) receives a new budget (₱20,000,000.00)', 1, 1, '2023-06-26 13:10:53'),
(139, 'PPMP for project (PPMP of CIT) was approved', 265, 0, '2023-06-26 13:16:07'),
(140, 'PPMP for project (PPMP of CIT) was approved', 264, 0, '2023-06-26 13:16:07'),
(141, 'PPMP for project (PPMP of CIT) was approved', 263, 0, '2023-06-26 13:16:07'),
(142, 'PPMP for project (PPMP of CIT) was approved', 262, 0, '2023-06-26 13:16:07'),
(143, 'PPMP for project (PPMP of CIT) was approved', 260, 0, '2023-06-26 13:16:07'),
(144, 'PPMP for project (PPMP of CIT) was approved', 259, 0, '2023-06-26 13:16:07'),
(145, 'PPMP for project (PPMP of CIT) was approved', 258, 0, '2023-06-26 13:16:07'),
(146, 'PPMP for project (PPMP of CIT) was approved', 256, 1, '2023-06-26 13:16:07'),
(147, 'PPMP for project (PPMP of CIT) was approved', 255, 0, '2023-06-26 13:16:07'),
(148, 'PPMP for project (PPMP of CIT) was approved', 254, 0, '2023-06-26 13:16:07'),
(149, 'PPMP for project (PPMP of CIT) was approved', 253, 0, '2023-06-26 13:16:07'),
(150, 'PPMP for project (PPMP of CIT) was approved', 251, 0, '2023-06-26 13:16:07'),
(151, 'PPMP for project (PPMP of CIT) was approved', 250, 0, '2023-06-26 13:16:07'),
(152, 'PPMP for project (PPMP of CIT) was approved', 249, 0, '2023-06-26 13:16:07'),
(153, 'PPMP for project (PPMP of CIT) was approved', 248, 0, '2023-06-26 13:16:07'),
(154, 'PPMP for project (PPMP of CIT) was approved', 245, 0, '2023-06-26 13:16:07'),
(155, 'PPMP for project (PPMP of CIT) was approved', 244, 0, '2023-06-26 13:16:07'),
(156, 'PPMP for project (PPMP of CIT) was approved', 243, 0, '2023-06-26 13:16:07'),
(157, 'PPMP for project (PPMP of CIT) was approved', 242, 0, '2023-06-26 13:16:07'),
(158, 'PPMP for project (PPMP of CIT) was approved', 240, 0, '2023-06-26 13:16:07'),
(159, 'PPMP for project (PPMP of CIT) was approved', 239, 0, '2023-06-26 13:16:07'),
(160, 'PPMP for project (PPMP of CIT) was approved', 238, 0, '2023-06-26 13:16:07'),
(161, 'PPMP for project (PPMP of CIT) was approved', 237, 0, '2023-06-26 13:16:07'),
(162, 'PPMP for project (PPMP of CIT) was approved', 236, 0, '2023-06-26 13:16:07'),
(163, 'PPMP for project (PPMP of CIT) was approved', 235, 0, '2023-06-26 13:16:07'),
(164, 'PPMP for project (PPMP of CIT) was approved', 234, 0, '2023-06-26 13:16:07'),
(165, 'PPMP for project (PPMP of CIT) was approved', 233, 1, '2023-06-26 13:16:07'),
(166, 'PPMP for project (PPMP of CIT) was approved', 1, 1, '2023-06-26 13:16:07'),
(167, 'PPMP for project (PPMP of CIT) was approved', 265, 0, '2023-06-26 13:16:11'),
(168, 'PPMP for project (PPMP of CIT) was approved', 264, 0, '2023-06-26 13:16:11'),
(169, 'PPMP for project (PPMP of CIT) was approved', 263, 0, '2023-06-26 13:16:11'),
(170, 'PPMP for project (PPMP of CIT) was approved', 262, 0, '2023-06-26 13:16:11'),
(171, 'PPMP for project (PPMP of CIT) was approved', 260, 0, '2023-06-26 13:16:11'),
(172, 'PPMP for project (PPMP of CIT) was approved', 259, 0, '2023-06-26 13:16:11'),
(173, 'PPMP for project (PPMP of CIT) was approved', 258, 0, '2023-06-26 13:16:11'),
(174, 'PPMP for project (PPMP of CIT) was approved', 256, 1, '2023-06-26 13:16:11'),
(175, 'PPMP for project (PPMP of CIT) was approved', 255, 0, '2023-06-26 13:16:11'),
(176, 'PPMP for project (PPMP of CIT) was approved', 254, 0, '2023-06-26 13:16:11'),
(177, 'PPMP for project (PPMP of CIT) was approved', 253, 0, '2023-06-26 13:16:11'),
(178, 'PPMP for project (PPMP of CIT) was approved', 251, 0, '2023-06-26 13:16:11'),
(179, 'PPMP for project (PPMP of CIT) was approved', 250, 0, '2023-06-26 13:16:11'),
(180, 'PPMP for project (PPMP of CIT) was approved', 249, 0, '2023-06-26 13:16:11'),
(181, 'PPMP for project (PPMP of CIT) was approved', 248, 0, '2023-06-26 13:16:11'),
(182, 'PPMP for project (PPMP of CIT) was approved', 245, 0, '2023-06-26 13:16:11'),
(183, 'PPMP for project (PPMP of CIT) was approved', 244, 0, '2023-06-26 13:16:11'),
(184, 'PPMP for project (PPMP of CIT) was approved', 243, 0, '2023-06-26 13:16:11'),
(185, 'PPMP for project (PPMP of CIT) was approved', 242, 0, '2023-06-26 13:16:11'),
(186, 'PPMP for project (PPMP of CIT) was approved', 240, 0, '2023-06-26 13:16:11'),
(187, 'PPMP for project (PPMP of CIT) was approved', 239, 0, '2023-06-26 13:16:11'),
(188, 'PPMP for project (PPMP of CIT) was approved', 238, 0, '2023-06-26 13:16:11'),
(189, 'PPMP for project (PPMP of CIT) was approved', 237, 0, '2023-06-26 13:16:11'),
(190, 'PPMP for project (PPMP of CIT) was approved', 236, 0, '2023-06-26 13:16:11'),
(191, 'PPMP for project (PPMP of CIT) was approved', 235, 0, '2023-06-26 13:16:11'),
(192, 'PPMP for project (PPMP of CIT) was approved', 234, 0, '2023-06-26 13:16:11'),
(193, 'PPMP for project (PPMP of CIT) was approved', 233, 1, '2023-06-26 13:16:11'),
(194, 'PPMP for project (PPMP of CIT) was approved', 1, 1, '2023-06-26 13:16:11'),
(195, 'PPMP for project (PPMP of CIT) was approved', 265, 0, '2023-06-26 13:16:16'),
(196, 'PPMP for project (PPMP of CIT) was approved', 264, 0, '2023-06-26 13:16:16'),
(197, 'PPMP for project (PPMP of CIT) was approved', 263, 0, '2023-06-26 13:16:16'),
(198, 'PPMP for project (PPMP of CIT) was approved', 262, 0, '2023-06-26 13:16:16'),
(199, 'PPMP for project (PPMP of CIT) was approved', 260, 0, '2023-06-26 13:16:16'),
(200, 'PPMP for project (PPMP of CIT) was approved', 259, 0, '2023-06-26 13:16:16'),
(201, 'PPMP for project (PPMP of CIT) was approved', 258, 0, '2023-06-26 13:16:16'),
(202, 'PPMP for project (PPMP of CIT) was approved', 256, 1, '2023-06-26 13:16:16'),
(203, 'PPMP for project (PPMP of CIT) was approved', 255, 0, '2023-06-26 13:16:16'),
(204, 'PPMP for project (PPMP of CIT) was approved', 254, 0, '2023-06-26 13:16:16'),
(205, 'PPMP for project (PPMP of CIT) was approved', 253, 0, '2023-06-26 13:16:16'),
(206, 'PPMP for project (PPMP of CIT) was approved', 251, 0, '2023-06-26 13:16:16'),
(207, 'PPMP for project (PPMP of CIT) was approved', 250, 0, '2023-06-26 13:16:16'),
(208, 'PPMP for project (PPMP of CIT) was approved', 249, 0, '2023-06-26 13:16:16'),
(209, 'PPMP for project (PPMP of CIT) was approved', 248, 0, '2023-06-26 13:16:16'),
(210, 'PPMP for project (PPMP of CIT) was approved', 245, 0, '2023-06-26 13:16:16'),
(211, 'PPMP for project (PPMP of CIT) was approved', 244, 0, '2023-06-26 13:16:16'),
(212, 'PPMP for project (PPMP of CIT) was approved', 243, 0, '2023-06-26 13:16:16'),
(213, 'PPMP for project (PPMP of CIT) was approved', 242, 0, '2023-06-26 13:16:16'),
(214, 'PPMP for project (PPMP of CIT) was approved', 240, 0, '2023-06-26 13:16:16'),
(215, 'PPMP for project (PPMP of CIT) was approved', 239, 0, '2023-06-26 13:16:16'),
(216, 'PPMP for project (PPMP of CIT) was approved', 238, 0, '2023-06-26 13:16:16'),
(217, 'PPMP for project (PPMP of CIT) was approved', 237, 0, '2023-06-26 13:16:16'),
(218, 'PPMP for project (PPMP of CIT) was approved', 236, 0, '2023-06-26 13:16:16'),
(219, 'PPMP for project (PPMP of CIT) was approved', 235, 0, '2023-06-26 13:16:16'),
(220, 'PPMP for project (PPMP of CIT) was approved', 234, 0, '2023-06-26 13:16:16'),
(221, 'PPMP for project (PPMP of CIT) was approved', 233, 1, '2023-06-26 13:16:16'),
(222, 'PPMP for project (PPMP of CIT) was approved', 1, 1, '2023-06-26 13:16:16'),
(223, 'PPMP for project (PPMP of CIT) was approved', 265, 0, '2023-06-26 13:16:21'),
(224, 'PPMP for project (PPMP of CIT) was approved', 264, 0, '2023-06-26 13:16:21'),
(225, 'PPMP for project (PPMP of CIT) was approved', 263, 0, '2023-06-26 13:16:21'),
(226, 'PPMP for project (PPMP of CIT) was approved', 262, 0, '2023-06-26 13:16:21'),
(227, 'PPMP for project (PPMP of CIT) was approved', 260, 0, '2023-06-26 13:16:21'),
(228, 'PPMP for project (PPMP of CIT) was approved', 259, 0, '2023-06-26 13:16:21'),
(229, 'PPMP for project (PPMP of CIT) was approved', 258, 0, '2023-06-26 13:16:21'),
(230, 'PPMP for project (PPMP of CIT) was approved', 256, 1, '2023-06-26 13:16:21'),
(231, 'PPMP for project (PPMP of CIT) was approved', 255, 0, '2023-06-26 13:16:21'),
(232, 'PPMP for project (PPMP of CIT) was approved', 254, 0, '2023-06-26 13:16:21'),
(233, 'PPMP for project (PPMP of CIT) was approved', 253, 0, '2023-06-26 13:16:21'),
(234, 'PPMP for project (PPMP of CIT) was approved', 251, 0, '2023-06-26 13:16:21'),
(235, 'PPMP for project (PPMP of CIT) was approved', 250, 0, '2023-06-26 13:16:21'),
(236, 'PPMP for project (PPMP of CIT) was approved', 249, 0, '2023-06-26 13:16:21'),
(237, 'PPMP for project (PPMP of CIT) was approved', 248, 0, '2023-06-26 13:16:21'),
(238, 'PPMP for project (PPMP of CIT) was approved', 245, 0, '2023-06-26 13:16:21'),
(239, 'PPMP for project (PPMP of CIT) was approved', 244, 0, '2023-06-26 13:16:21'),
(240, 'PPMP for project (PPMP of CIT) was approved', 243, 0, '2023-06-26 13:16:21'),
(241, 'PPMP for project (PPMP of CIT) was approved', 242, 0, '2023-06-26 13:16:21'),
(242, 'PPMP for project (PPMP of CIT) was approved', 240, 0, '2023-06-26 13:16:21'),
(243, 'PPMP for project (PPMP of CIT) was approved', 239, 0, '2023-06-26 13:16:21'),
(244, 'PPMP for project (PPMP of CIT) was approved', 238, 0, '2023-06-26 13:16:21'),
(245, 'PPMP for project (PPMP of CIT) was approved', 237, 0, '2023-06-26 13:16:21'),
(246, 'PPMP for project (PPMP of CIT) was approved', 236, 0, '2023-06-26 13:16:21'),
(247, 'PPMP for project (PPMP of CIT) was approved', 235, 0, '2023-06-26 13:16:21'),
(248, 'PPMP for project (PPMP of CIT) was approved', 234, 0, '2023-06-26 13:16:21'),
(249, 'PPMP for project (PPMP of CIT) was approved', 233, 1, '2023-06-26 13:16:21'),
(250, 'PPMP for project (PPMP of CIT) was approved', 1, 1, '2023-06-26 13:16:21'),
(251, 'PPMP for project (PPMP of CIT) was approved', 265, 0, '2023-06-26 13:16:30'),
(252, 'PPMP for project (PPMP of CIT) was approved', 264, 0, '2023-06-26 13:16:30'),
(253, 'PPMP for project (PPMP of CIT) was approved', 263, 0, '2023-06-26 13:16:30'),
(254, 'PPMP for project (PPMP of CIT) was approved', 262, 0, '2023-06-26 13:16:30'),
(255, 'PPMP for project (PPMP of CIT) was approved', 260, 0, '2023-06-26 13:16:30'),
(256, 'PPMP for project (PPMP of CIT) was approved', 259, 0, '2023-06-26 13:16:30'),
(257, 'PPMP for project (PPMP of CIT) was approved', 258, 0, '2023-06-26 13:16:30'),
(258, 'PPMP for project (PPMP of CIT) was approved', 256, 1, '2023-06-26 13:16:30'),
(259, 'PPMP for project (PPMP of CIT) was approved', 255, 0, '2023-06-26 13:16:30'),
(260, 'PPMP for project (PPMP of CIT) was approved', 254, 0, '2023-06-26 13:16:30'),
(261, 'PPMP for project (PPMP of CIT) was approved', 253, 0, '2023-06-26 13:16:30'),
(262, 'PPMP for project (PPMP of CIT) was approved', 251, 0, '2023-06-26 13:16:30'),
(263, 'PPMP for project (PPMP of CIT) was approved', 250, 0, '2023-06-26 13:16:30'),
(264, 'PPMP for project (PPMP of CIT) was approved', 249, 0, '2023-06-26 13:16:30'),
(265, 'PPMP for project (PPMP of CIT) was approved', 248, 0, '2023-06-26 13:16:30'),
(266, 'PPMP for project (PPMP of CIT) was approved', 245, 0, '2023-06-26 13:16:30'),
(267, 'PPMP for project (PPMP of CIT) was approved', 244, 0, '2023-06-26 13:16:30'),
(268, 'PPMP for project (PPMP of CIT) was approved', 243, 0, '2023-06-26 13:16:30'),
(269, 'PPMP for project (PPMP of CIT) was approved', 242, 0, '2023-06-26 13:16:30'),
(270, 'PPMP for project (PPMP of CIT) was approved', 240, 0, '2023-06-26 13:16:30'),
(271, 'PPMP for project (PPMP of CIT) was approved', 239, 0, '2023-06-26 13:16:30'),
(272, 'PPMP for project (PPMP of CIT) was approved', 238, 0, '2023-06-26 13:16:30'),
(273, 'PPMP for project (PPMP of CIT) was approved', 237, 0, '2023-06-26 13:16:30'),
(274, 'PPMP for project (PPMP of CIT) was approved', 236, 0, '2023-06-26 13:16:30'),
(275, 'PPMP for project (PPMP of CIT) was approved', 235, 0, '2023-06-26 13:16:30'),
(276, 'PPMP for project (PPMP of CIT) was approved', 234, 0, '2023-06-26 13:16:30'),
(277, 'PPMP for project (PPMP of CIT) was approved', 233, 1, '2023-06-26 13:16:30'),
(278, 'PPMP for project (PPMP of CIT) was approved', 1, 1, '2023-06-26 13:16:30'),
(279, 'New PPMP was created for project (PPMP of CIT)', 220, 0, '2023-06-26 13:32:36'),
(280, 'New PPMP was created for project (PPMP of CIT)', 1, 1, '2023-06-26 13:32:36'),
(281, 'New PPMP was created for project (PPMP of CIT)', 220, 0, '2023-06-26 13:34:36'),
(282, 'New PPMP was created for project (PPMP of CIT)', 1, 1, '2023-06-26 13:34:36'),
(283, 'New PPMP was created for project (PPMP of CIT)', 220, 0, '2023-06-26 13:35:42'),
(284, 'New PPMP was created for project (PPMP of CIT)', 1, 1, '2023-06-26 13:35:42'),
(285, 'New PPMP was created for project (PPMP of CIT)', 220, 0, '2023-06-26 13:59:52'),
(286, 'New PPMP was created for project (PPMP of CIT)', 266, 0, '2023-06-26 13:59:52'),
(287, 'New PPMP was created for project (PPMP of CIT)', 1, 1, '2023-06-26 13:59:52'),
(288, 'PPMP for project (PPMP of CIT) was approved', 265, 0, '2023-06-26 14:11:59'),
(289, 'PPMP for project (PPMP of CIT) was approved', 264, 0, '2023-06-26 14:11:59'),
(290, 'PPMP for project (PPMP of CIT) was approved', 263, 0, '2023-06-26 14:11:59'),
(291, 'PPMP for project (PPMP of CIT) was approved', 262, 0, '2023-06-26 14:11:59'),
(292, 'PPMP for project (PPMP of CIT) was approved', 260, 0, '2023-06-26 14:11:59'),
(293, 'PPMP for project (PPMP of CIT) was approved', 259, 0, '2023-06-26 14:11:59'),
(294, 'PPMP for project (PPMP of CIT) was approved', 258, 0, '2023-06-26 14:11:59'),
(295, 'PPMP for project (PPMP of CIT) was approved', 256, 1, '2023-06-26 14:11:59'),
(296, 'PPMP for project (PPMP of CIT) was approved', 255, 0, '2023-06-26 14:11:59'),
(297, 'PPMP for project (PPMP of CIT) was approved', 254, 0, '2023-06-26 14:11:59'),
(298, 'PPMP for project (PPMP of CIT) was approved', 253, 0, '2023-06-26 14:11:59'),
(299, 'PPMP for project (PPMP of CIT) was approved', 251, 0, '2023-06-26 14:11:59'),
(300, 'PPMP for project (PPMP of CIT) was approved', 250, 0, '2023-06-26 14:11:59'),
(301, 'PPMP for project (PPMP of CIT) was approved', 249, 0, '2023-06-26 14:11:59'),
(302, 'PPMP for project (PPMP of CIT) was approved', 248, 0, '2023-06-26 14:11:59'),
(303, 'PPMP for project (PPMP of CIT) was approved', 245, 0, '2023-06-26 14:11:59'),
(304, 'PPMP for project (PPMP of CIT) was approved', 244, 0, '2023-06-26 14:11:59'),
(305, 'PPMP for project (PPMP of CIT) was approved', 243, 0, '2023-06-26 14:11:59'),
(306, 'PPMP for project (PPMP of CIT) was approved', 242, 0, '2023-06-26 14:11:59'),
(307, 'PPMP for project (PPMP of CIT) was approved', 240, 0, '2023-06-26 14:11:59'),
(308, 'PPMP for project (PPMP of CIT) was approved', 239, 0, '2023-06-26 14:11:59'),
(309, 'PPMP for project (PPMP of CIT) was approved', 238, 0, '2023-06-26 14:11:59'),
(310, 'PPMP for project (PPMP of CIT) was approved', 237, 0, '2023-06-26 14:11:59'),
(311, 'PPMP for project (PPMP of CIT) was approved', 236, 0, '2023-06-26 14:11:59'),
(312, 'PPMP for project (PPMP of CIT) was approved', 235, 0, '2023-06-26 14:11:59'),
(313, 'PPMP for project (PPMP of CIT) was approved', 234, 0, '2023-06-26 14:11:59'),
(314, 'PPMP for project (PPMP of CIT) was approved', 233, 0, '2023-06-26 14:11:59'),
(315, 'PPMP for project (PPMP of CIT) was approved', 1, 1, '2023-06-26 14:11:59'),
(316, 'PPMP for project (PPMP of CIT) was approved', 265, 0, '2023-06-26 14:12:04'),
(317, 'PPMP for project (PPMP of CIT) was approved', 264, 0, '2023-06-26 14:12:04'),
(318, 'PPMP for project (PPMP of CIT) was approved', 263, 0, '2023-06-26 14:12:04'),
(319, 'PPMP for project (PPMP of CIT) was approved', 262, 0, '2023-06-26 14:12:04'),
(320, 'PPMP for project (PPMP of CIT) was approved', 260, 0, '2023-06-26 14:12:04'),
(321, 'PPMP for project (PPMP of CIT) was approved', 259, 0, '2023-06-26 14:12:04'),
(322, 'PPMP for project (PPMP of CIT) was approved', 258, 0, '2023-06-26 14:12:04'),
(323, 'PPMP for project (PPMP of CIT) was approved', 256, 1, '2023-06-26 14:12:04'),
(324, 'PPMP for project (PPMP of CIT) was approved', 255, 0, '2023-06-26 14:12:04'),
(325, 'PPMP for project (PPMP of CIT) was approved', 254, 0, '2023-06-26 14:12:04'),
(326, 'PPMP for project (PPMP of CIT) was approved', 253, 0, '2023-06-26 14:12:04'),
(327, 'PPMP for project (PPMP of CIT) was approved', 251, 0, '2023-06-26 14:12:04'),
(328, 'PPMP for project (PPMP of CIT) was approved', 250, 0, '2023-06-26 14:12:04'),
(329, 'PPMP for project (PPMP of CIT) was approved', 249, 0, '2023-06-26 14:12:04'),
(330, 'PPMP for project (PPMP of CIT) was approved', 248, 0, '2023-06-26 14:12:04'),
(331, 'PPMP for project (PPMP of CIT) was approved', 245, 0, '2023-06-26 14:12:04'),
(332, 'PPMP for project (PPMP of CIT) was approved', 244, 0, '2023-06-26 14:12:04'),
(333, 'PPMP for project (PPMP of CIT) was approved', 243, 0, '2023-06-26 14:12:04'),
(334, 'PPMP for project (PPMP of CIT) was approved', 242, 0, '2023-06-26 14:12:04'),
(335, 'PPMP for project (PPMP of CIT) was approved', 240, 0, '2023-06-26 14:12:04'),
(336, 'PPMP for project (PPMP of CIT) was approved', 239, 0, '2023-06-26 14:12:04'),
(337, 'PPMP for project (PPMP of CIT) was approved', 238, 0, '2023-06-26 14:12:04'),
(338, 'PPMP for project (PPMP of CIT) was approved', 237, 0, '2023-06-26 14:12:04'),
(339, 'PPMP for project (PPMP of CIT) was approved', 236, 0, '2023-06-26 14:12:04'),
(340, 'PPMP for project (PPMP of CIT) was approved', 235, 0, '2023-06-26 14:12:04'),
(341, 'PPMP for project (PPMP of CIT) was approved', 234, 0, '2023-06-26 14:12:04'),
(342, 'PPMP for project (PPMP of CIT) was approved', 233, 0, '2023-06-26 14:12:04'),
(343, 'PPMP for project (PPMP of CIT) was approved', 1, 1, '2023-06-26 14:12:04'),
(344, 'PPMP for project (PPMP of CIT) was approved', 265, 0, '2023-06-26 14:12:08'),
(345, 'PPMP for project (PPMP of CIT) was approved', 264, 0, '2023-06-26 14:12:08'),
(346, 'PPMP for project (PPMP of CIT) was approved', 263, 0, '2023-06-26 14:12:08'),
(347, 'PPMP for project (PPMP of CIT) was approved', 262, 0, '2023-06-26 14:12:08'),
(348, 'PPMP for project (PPMP of CIT) was approved', 260, 0, '2023-06-26 14:12:08'),
(349, 'PPMP for project (PPMP of CIT) was approved', 259, 0, '2023-06-26 14:12:08'),
(350, 'PPMP for project (PPMP of CIT) was approved', 258, 0, '2023-06-26 14:12:08'),
(351, 'PPMP for project (PPMP of CIT) was approved', 256, 1, '2023-06-26 14:12:08'),
(352, 'PPMP for project (PPMP of CIT) was approved', 255, 0, '2023-06-26 14:12:08'),
(353, 'PPMP for project (PPMP of CIT) was approved', 254, 0, '2023-06-26 14:12:08'),
(354, 'PPMP for project (PPMP of CIT) was approved', 253, 0, '2023-06-26 14:12:08'),
(355, 'PPMP for project (PPMP of CIT) was approved', 251, 0, '2023-06-26 14:12:08'),
(356, 'PPMP for project (PPMP of CIT) was approved', 250, 0, '2023-06-26 14:12:08'),
(357, 'PPMP for project (PPMP of CIT) was approved', 249, 0, '2023-06-26 14:12:08'),
(358, 'PPMP for project (PPMP of CIT) was approved', 248, 0, '2023-06-26 14:12:08'),
(359, 'PPMP for project (PPMP of CIT) was approved', 245, 0, '2023-06-26 14:12:08'),
(360, 'PPMP for project (PPMP of CIT) was approved', 244, 0, '2023-06-26 14:12:08'),
(361, 'PPMP for project (PPMP of CIT) was approved', 243, 0, '2023-06-26 14:12:08'),
(362, 'PPMP for project (PPMP of CIT) was approved', 242, 0, '2023-06-26 14:12:08'),
(363, 'PPMP for project (PPMP of CIT) was approved', 240, 0, '2023-06-26 14:12:08'),
(364, 'PPMP for project (PPMP of CIT) was approved', 239, 0, '2023-06-26 14:12:08'),
(365, 'PPMP for project (PPMP of CIT) was approved', 238, 0, '2023-06-26 14:12:08'),
(366, 'PPMP for project (PPMP of CIT) was approved', 237, 0, '2023-06-26 14:12:08'),
(367, 'PPMP for project (PPMP of CIT) was approved', 236, 0, '2023-06-26 14:12:08'),
(368, 'PPMP for project (PPMP of CIT) was approved', 235, 0, '2023-06-26 14:12:08'),
(369, 'PPMP for project (PPMP of CIT) was approved', 234, 0, '2023-06-26 14:12:08'),
(370, 'PPMP for project (PPMP of CIT) was approved', 233, 0, '2023-06-26 14:12:08'),
(371, 'PPMP for project (PPMP of CIT) was approved', 1, 1, '2023-06-26 14:12:08'),
(372, 'PPMP for project (PPMP of CIT) was approved', 265, 0, '2023-06-26 14:12:14'),
(373, 'PPMP for project (PPMP of CIT) was approved', 264, 0, '2023-06-26 14:12:14'),
(374, 'PPMP for project (PPMP of CIT) was approved', 263, 0, '2023-06-26 14:12:14'),
(375, 'PPMP for project (PPMP of CIT) was approved', 262, 0, '2023-06-26 14:12:14'),
(376, 'PPMP for project (PPMP of CIT) was approved', 260, 0, '2023-06-26 14:12:14'),
(377, 'PPMP for project (PPMP of CIT) was approved', 259, 0, '2023-06-26 14:12:14'),
(378, 'PPMP for project (PPMP of CIT) was approved', 258, 0, '2023-06-26 14:12:14'),
(379, 'PPMP for project (PPMP of CIT) was approved', 256, 1, '2023-06-26 14:12:14'),
(380, 'PPMP for project (PPMP of CIT) was approved', 255, 0, '2023-06-26 14:12:14'),
(381, 'PPMP for project (PPMP of CIT) was approved', 254, 0, '2023-06-26 14:12:14'),
(382, 'PPMP for project (PPMP of CIT) was approved', 253, 0, '2023-06-26 14:12:14'),
(383, 'PPMP for project (PPMP of CIT) was approved', 251, 0, '2023-06-26 14:12:14'),
(384, 'PPMP for project (PPMP of CIT) was approved', 250, 0, '2023-06-26 14:12:14'),
(385, 'PPMP for project (PPMP of CIT) was approved', 249, 0, '2023-06-26 14:12:14'),
(386, 'PPMP for project (PPMP of CIT) was approved', 248, 0, '2023-06-26 14:12:14'),
(387, 'PPMP for project (PPMP of CIT) was approved', 245, 0, '2023-06-26 14:12:14'),
(388, 'PPMP for project (PPMP of CIT) was approved', 244, 0, '2023-06-26 14:12:14'),
(389, 'PPMP for project (PPMP of CIT) was approved', 243, 0, '2023-06-26 14:12:14'),
(390, 'PPMP for project (PPMP of CIT) was approved', 242, 0, '2023-06-26 14:12:14'),
(391, 'PPMP for project (PPMP of CIT) was approved', 240, 0, '2023-06-26 14:12:14'),
(392, 'PPMP for project (PPMP of CIT) was approved', 239, 0, '2023-06-26 14:12:14'),
(393, 'PPMP for project (PPMP of CIT) was approved', 238, 0, '2023-06-26 14:12:14'),
(394, 'PPMP for project (PPMP of CIT) was approved', 237, 0, '2023-06-26 14:12:14'),
(395, 'PPMP for project (PPMP of CIT) was approved', 236, 0, '2023-06-26 14:12:14'),
(396, 'PPMP for project (PPMP of CIT) was approved', 235, 0, '2023-06-26 14:12:14'),
(397, 'PPMP for project (PPMP of CIT) was approved', 234, 0, '2023-06-26 14:12:14'),
(398, 'PPMP for project (PPMP of CIT) was approved', 233, 0, '2023-06-26 14:12:14'),
(399, 'PPMP for project (PPMP of CIT) was approved', 1, 1, '2023-06-26 14:12:14'),
(400, 'PPMP for project (PPMP of CIT) was approved', 265, 0, '2023-06-26 14:42:46'),
(401, 'PPMP for project (PPMP of CIT) was approved', 264, 0, '2023-06-26 14:42:46'),
(402, 'PPMP for project (PPMP of CIT) was approved', 263, 0, '2023-06-26 14:42:46'),
(403, 'PPMP for project (PPMP of CIT) was approved', 262, 0, '2023-06-26 14:42:46'),
(404, 'PPMP for project (PPMP of CIT) was approved', 260, 0, '2023-06-26 14:42:46'),
(405, 'PPMP for project (PPMP of CIT) was approved', 259, 0, '2023-06-26 14:42:46'),
(406, 'PPMP for project (PPMP of CIT) was approved', 258, 0, '2023-06-26 14:42:46'),
(407, 'PPMP for project (PPMP of CIT) was approved', 256, 1, '2023-06-26 14:42:46'),
(408, 'PPMP for project (PPMP of CIT) was approved', 255, 0, '2023-06-26 14:42:46'),
(409, 'PPMP for project (PPMP of CIT) was approved', 254, 0, '2023-06-26 14:42:46'),
(410, 'PPMP for project (PPMP of CIT) was approved', 253, 0, '2023-06-26 14:42:46'),
(411, 'PPMP for project (PPMP of CIT) was approved', 251, 0, '2023-06-26 14:42:46'),
(412, 'PPMP for project (PPMP of CIT) was approved', 250, 0, '2023-06-26 14:42:46'),
(413, 'PPMP for project (PPMP of CIT) was approved', 249, 0, '2023-06-26 14:42:46'),
(414, 'PPMP for project (PPMP of CIT) was approved', 248, 0, '2023-06-26 14:42:46'),
(415, 'PPMP for project (PPMP of CIT) was approved', 245, 0, '2023-06-26 14:42:46'),
(416, 'PPMP for project (PPMP of CIT) was approved', 244, 0, '2023-06-26 14:42:46'),
(417, 'PPMP for project (PPMP of CIT) was approved', 243, 0, '2023-06-26 14:42:46'),
(418, 'PPMP for project (PPMP of CIT) was approved', 242, 0, '2023-06-26 14:42:46'),
(419, 'PPMP for project (PPMP of CIT) was approved', 240, 0, '2023-06-26 14:42:46'),
(420, 'PPMP for project (PPMP of CIT) was approved', 239, 0, '2023-06-26 14:42:46'),
(421, 'PPMP for project (PPMP of CIT) was approved', 238, 0, '2023-06-26 14:42:46'),
(422, 'PPMP for project (PPMP of CIT) was approved', 237, 0, '2023-06-26 14:42:46'),
(423, 'PPMP for project (PPMP of CIT) was approved', 236, 0, '2023-06-26 14:42:46'),
(424, 'PPMP for project (PPMP of CIT) was approved', 235, 0, '2023-06-26 14:42:46'),
(425, 'PPMP for project (PPMP of CIT) was approved', 234, 0, '2023-06-26 14:42:46'),
(426, 'PPMP for project (PPMP of CIT) was approved', 233, 0, '2023-06-26 14:42:46'),
(427, 'PPMP for project (PPMP of CIT) was approved', 1, 1, '2023-06-26 14:42:46'),
(428, 'PPMP for project (PPMP of CIT) was approved', 265, 0, '2023-06-26 14:42:51'),
(429, 'PPMP for project (PPMP of CIT) was approved', 264, 0, '2023-06-26 14:42:51'),
(430, 'PPMP for project (PPMP of CIT) was approved', 263, 0, '2023-06-26 14:42:51'),
(431, 'PPMP for project (PPMP of CIT) was approved', 262, 0, '2023-06-26 14:42:51'),
(432, 'PPMP for project (PPMP of CIT) was approved', 260, 0, '2023-06-26 14:42:51'),
(433, 'PPMP for project (PPMP of CIT) was approved', 259, 0, '2023-06-26 14:42:51'),
(434, 'PPMP for project (PPMP of CIT) was approved', 258, 0, '2023-06-26 14:42:51'),
(435, 'PPMP for project (PPMP of CIT) was approved', 256, 1, '2023-06-26 14:42:51'),
(436, 'PPMP for project (PPMP of CIT) was approved', 255, 0, '2023-06-26 14:42:51'),
(437, 'PPMP for project (PPMP of CIT) was approved', 254, 0, '2023-06-26 14:42:51'),
(438, 'PPMP for project (PPMP of CIT) was approved', 253, 0, '2023-06-26 14:42:51'),
(439, 'PPMP for project (PPMP of CIT) was approved', 251, 0, '2023-06-26 14:42:51'),
(440, 'PPMP for project (PPMP of CIT) was approved', 250, 0, '2023-06-26 14:42:51'),
(441, 'PPMP for project (PPMP of CIT) was approved', 249, 0, '2023-06-26 14:42:51'),
(442, 'PPMP for project (PPMP of CIT) was approved', 248, 0, '2023-06-26 14:42:51'),
(443, 'PPMP for project (PPMP of CIT) was approved', 245, 0, '2023-06-26 14:42:51'),
(444, 'PPMP for project (PPMP of CIT) was approved', 244, 0, '2023-06-26 14:42:51'),
(445, 'PPMP for project (PPMP of CIT) was approved', 243, 0, '2023-06-26 14:42:51'),
(446, 'PPMP for project (PPMP of CIT) was approved', 242, 0, '2023-06-26 14:42:51'),
(447, 'PPMP for project (PPMP of CIT) was approved', 240, 0, '2023-06-26 14:42:51'),
(448, 'PPMP for project (PPMP of CIT) was approved', 239, 0, '2023-06-26 14:42:51'),
(449, 'PPMP for project (PPMP of CIT) was approved', 238, 0, '2023-06-26 14:42:51'),
(450, 'PPMP for project (PPMP of CIT) was approved', 237, 0, '2023-06-26 14:42:51'),
(451, 'PPMP for project (PPMP of CIT) was approved', 236, 0, '2023-06-26 14:42:51'),
(452, 'PPMP for project (PPMP of CIT) was approved', 235, 0, '2023-06-26 14:42:51'),
(453, 'PPMP for project (PPMP of CIT) was approved', 234, 0, '2023-06-26 14:42:51'),
(454, 'PPMP for project (PPMP of CIT) was approved', 233, 0, '2023-06-26 14:42:51'),
(455, 'PPMP for project (PPMP of CIT) was approved', 1, 1, '2023-06-26 14:42:51'),
(456, 'New PPMP was created for project (PPMP)', 272, 1, '2023-06-26 15:33:47'),
(457, 'New PPMP was created for project (PPMP)', 271, 0, '2023-06-26 15:33:47'),
(458, 'New PPMP was created for project (PPMP)', 270, 0, '2023-06-26 15:33:47'),
(459, 'New PPMP was created for project (PPMP)', 269, 1, '2023-06-26 15:33:47'),
(460, 'New PPMP was created for project (PPMP)', 268, 0, '2023-06-26 15:33:47'),
(461, 'New PPMP was created for project (PPMP)', 267, 0, '2023-06-26 15:33:47'),
(462, 'New PPMP was created for project (PPMP)', 1, 1, '2023-06-26 15:33:47'),
(463, 'New PPMP was created for project (PPMP)', 272, 1, '2023-06-26 15:34:04'),
(464, 'New PPMP was created for project (PPMP)', 271, 0, '2023-06-26 15:34:04'),
(465, 'New PPMP was created for project (PPMP)', 270, 0, '2023-06-26 15:34:04'),
(466, 'New PPMP was created for project (PPMP)', 269, 1, '2023-06-26 15:34:04'),
(467, 'New PPMP was created for project (PPMP)', 268, 0, '2023-06-26 15:34:04'),
(468, 'New PPMP was created for project (PPMP)', 267, 0, '2023-06-26 15:34:04'),
(469, 'New PPMP was created for project (PPMP)', 1, 1, '2023-06-26 15:34:04'),
(470, 'PPMP for project (PPMP) was approved', 265, 0, '2023-06-26 15:50:34'),
(471, 'PPMP for project (PPMP) was approved', 264, 0, '2023-06-26 15:50:34'),
(472, 'PPMP for project (PPMP) was approved', 263, 0, '2023-06-26 15:50:34'),
(473, 'PPMP for project (PPMP) was approved', 262, 0, '2023-06-26 15:50:34'),
(474, 'PPMP for project (PPMP) was approved', 260, 0, '2023-06-26 15:50:34'),
(475, 'PPMP for project (PPMP) was approved', 259, 0, '2023-06-26 15:50:34'),
(476, 'PPMP for project (PPMP) was approved', 258, 0, '2023-06-26 15:50:34'),
(477, 'PPMP for project (PPMP) was approved', 256, 1, '2023-06-26 15:50:34'),
(478, 'PPMP for project (PPMP) was approved', 255, 0, '2023-06-26 15:50:34'),
(479, 'PPMP for project (PPMP) was approved', 254, 0, '2023-06-26 15:50:34'),
(480, 'PPMP for project (PPMP) was approved', 253, 0, '2023-06-26 15:50:34'),
(481, 'PPMP for project (PPMP) was approved', 251, 0, '2023-06-26 15:50:34'),
(482, 'PPMP for project (PPMP) was approved', 250, 0, '2023-06-26 15:50:34'),
(483, 'PPMP for project (PPMP) was approved', 249, 0, '2023-06-26 15:50:34'),
(484, 'PPMP for project (PPMP) was approved', 248, 0, '2023-06-26 15:50:34'),
(485, 'PPMP for project (PPMP) was approved', 245, 0, '2023-06-26 15:50:34'),
(486, 'PPMP for project (PPMP) was approved', 244, 0, '2023-06-26 15:50:34'),
(487, 'PPMP for project (PPMP) was approved', 243, 0, '2023-06-26 15:50:34'),
(488, 'PPMP for project (PPMP) was approved', 242, 0, '2023-06-26 15:50:34'),
(489, 'PPMP for project (PPMP) was approved', 240, 0, '2023-06-26 15:50:34'),
(490, 'PPMP for project (PPMP) was approved', 239, 0, '2023-06-26 15:50:34'),
(491, 'PPMP for project (PPMP) was approved', 238, 0, '2023-06-26 15:50:34'),
(492, 'PPMP for project (PPMP) was approved', 237, 0, '2023-06-26 15:50:34'),
(493, 'PPMP for project (PPMP) was approved', 236, 0, '2023-06-26 15:50:34'),
(494, 'PPMP for project (PPMP) was approved', 235, 0, '2023-06-26 15:50:34'),
(495, 'PPMP for project (PPMP) was approved', 234, 0, '2023-06-26 15:50:34'),
(496, 'PPMP for project (PPMP) was approved', 233, 0, '2023-06-26 15:50:34'),
(497, 'PPMP for project (PPMP) was approved', 1, 1, '2023-06-26 15:50:34'),
(498, 'New PPMP was created for project (PPMP)', 272, 1, '2023-06-26 16:03:55'),
(499, 'New PPMP was created for project (PPMP)', 271, 0, '2023-06-26 16:03:55'),
(500, 'New PPMP was created for project (PPMP)', 270, 0, '2023-06-26 16:03:55'),
(501, 'New PPMP was created for project (PPMP)', 269, 1, '2023-06-26 16:03:55'),
(502, 'New PPMP was created for project (PPMP)', 268, 0, '2023-06-26 16:03:55'),
(503, 'New PPMP was created for project (PPMP)', 267, 0, '2023-06-26 16:03:55'),
(504, 'New PPMP was created for project (PPMP)', 1, 1, '2023-06-26 16:03:55'),
(505, 'New PPMP was created for project (PPMP)', 272, 1, '2023-06-26 16:05:32'),
(506, 'New PPMP was created for project (PPMP)', 271, 0, '2023-06-26 16:05:32'),
(507, 'New PPMP was created for project (PPMP)', 270, 0, '2023-06-26 16:05:32'),
(508, 'New PPMP was created for project (PPMP)', 269, 1, '2023-06-26 16:05:32'),
(509, 'New PPMP was created for project (PPMP)', 268, 0, '2023-06-26 16:05:32'),
(510, 'New PPMP was created for project (PPMP)', 267, 0, '2023-06-26 16:05:32'),
(511, 'New PPMP was created for project (PPMP)', 1, 1, '2023-06-26 16:05:32'),
(512, 'New PPMP was created for project (PPMP)', 272, 1, '2023-06-26 16:11:25'),
(513, 'New PPMP was created for project (PPMP)', 271, 0, '2023-06-26 16:11:25'),
(514, 'New PPMP was created for project (PPMP)', 270, 0, '2023-06-26 16:11:25'),
(515, 'New PPMP was created for project (PPMP)', 269, 1, '2023-06-26 16:11:25'),
(516, 'New PPMP was created for project (PPMP)', 268, 0, '2023-06-26 16:11:25'),
(517, 'New PPMP was created for project (PPMP)', 267, 0, '2023-06-26 16:11:25'),
(518, 'New PPMP was created for project (PPMP)', 1, 1, '2023-06-26 16:11:25'),
(519, 'New PPMP was created for project (PPMP)', 272, 1, '2023-06-26 16:13:35'),
(520, 'New PPMP was created for project (PPMP)', 271, 0, '2023-06-26 16:13:35'),
(521, 'New PPMP was created for project (PPMP)', 270, 0, '2023-06-26 16:13:35'),
(522, 'New PPMP was created for project (PPMP)', 269, 1, '2023-06-26 16:13:35'),
(523, 'New PPMP was created for project (PPMP)', 268, 0, '2023-06-26 16:13:35'),
(524, 'New PPMP was created for project (PPMP)', 267, 0, '2023-06-26 16:13:35'),
(525, 'New PPMP was created for project (PPMP)', 1, 1, '2023-06-26 16:13:35'),
(526, 'New PPMP was created for project (PPMP)', 272, 1, '2023-06-26 16:16:08'),
(527, 'New PPMP was created for project (PPMP)', 271, 0, '2023-06-26 16:16:08'),
(528, 'New PPMP was created for project (PPMP)', 270, 0, '2023-06-26 16:16:08'),
(529, 'New PPMP was created for project (PPMP)', 269, 1, '2023-06-26 16:16:08'),
(530, 'New PPMP was created for project (PPMP)', 268, 0, '2023-06-26 16:16:08'),
(531, 'New PPMP was created for project (PPMP)', 267, 0, '2023-06-26 16:16:08'),
(532, 'New PPMP was created for project (PPMP)', 1, 1, '2023-06-26 16:16:08'),
(533, 'New PPMP was created for project (PPMP)', 272, 1, '2023-06-26 16:18:09'),
(534, 'New PPMP was created for project (PPMP)', 271, 0, '2023-06-26 16:18:09'),
(535, 'New PPMP was created for project (PPMP)', 270, 0, '2023-06-26 16:18:09'),
(536, 'New PPMP was created for project (PPMP)', 269, 1, '2023-06-26 16:18:09'),
(537, 'New PPMP was created for project (PPMP)', 268, 0, '2023-06-26 16:18:09'),
(538, 'New PPMP was created for project (PPMP)', 267, 0, '2023-06-26 16:18:09'),
(539, 'New PPMP was created for project (PPMP)', 1, 1, '2023-06-26 16:18:09'),
(540, 'PPMP for project (PPMP) was approved', 265, 0, '2023-06-27 03:10:45'),
(541, 'PPMP for project (PPMP) was approved', 264, 0, '2023-06-27 03:10:45'),
(542, 'PPMP for project (PPMP) was approved', 263, 0, '2023-06-27 03:10:45'),
(543, 'PPMP for project (PPMP) was approved', 262, 0, '2023-06-27 03:10:45'),
(544, 'PPMP for project (PPMP) was approved', 260, 0, '2023-06-27 03:10:45'),
(545, 'PPMP for project (PPMP) was approved', 259, 0, '2023-06-27 03:10:45'),
(546, 'PPMP for project (PPMP) was approved', 258, 0, '2023-06-27 03:10:45'),
(547, 'PPMP for project (PPMP) was approved', 256, 1, '2023-06-27 03:10:45'),
(548, 'PPMP for project (PPMP) was approved', 255, 0, '2023-06-27 03:10:45'),
(549, 'PPMP for project (PPMP) was approved', 254, 0, '2023-06-27 03:10:45'),
(550, 'PPMP for project (PPMP) was approved', 253, 0, '2023-06-27 03:10:45'),
(551, 'PPMP for project (PPMP) was approved', 251, 0, '2023-06-27 03:10:45'),
(552, 'PPMP for project (PPMP) was approved', 250, 0, '2023-06-27 03:10:45'),
(553, 'PPMP for project (PPMP) was approved', 249, 0, '2023-06-27 03:10:45'),
(554, 'PPMP for project (PPMP) was approved', 248, 0, '2023-06-27 03:10:45'),
(555, 'PPMP for project (PPMP) was approved', 245, 0, '2023-06-27 03:10:45'),
(556, 'PPMP for project (PPMP) was approved', 244, 0, '2023-06-27 03:10:45'),
(557, 'PPMP for project (PPMP) was approved', 243, 0, '2023-06-27 03:10:45'),
(558, 'PPMP for project (PPMP) was approved', 242, 0, '2023-06-27 03:10:45'),
(559, 'PPMP for project (PPMP) was approved', 240, 0, '2023-06-27 03:10:45'),
(560, 'PPMP for project (PPMP) was approved', 239, 0, '2023-06-27 03:10:45'),
(561, 'PPMP for project (PPMP) was approved', 238, 0, '2023-06-27 03:10:45'),
(562, 'PPMP for project (PPMP) was approved', 237, 0, '2023-06-27 03:10:45'),
(563, 'PPMP for project (PPMP) was approved', 236, 0, '2023-06-27 03:10:45'),
(564, 'PPMP for project (PPMP) was approved', 235, 0, '2023-06-27 03:10:45'),
(565, 'PPMP for project (PPMP) was approved', 234, 0, '2023-06-27 03:10:45'),
(566, 'PPMP for project (PPMP) was approved', 233, 0, '2023-06-27 03:10:45'),
(567, 'PPMP for project (PPMP) was approved', 1, 1, '2023-06-27 03:10:45'),
(568, 'New PPMP was created for project (PPMP)', 272, 1, '2023-06-27 04:19:00'),
(569, 'New PPMP was created for project (PPMP)', 271, 0, '2023-06-27 04:19:00'),
(570, 'New PPMP was created for project (PPMP)', 270, 0, '2023-06-27 04:19:00'),
(571, 'New PPMP was created for project (PPMP)', 269, 1, '2023-06-27 04:19:00'),
(572, 'New PPMP was created for project (PPMP)', 268, 0, '2023-06-27 04:19:00'),
(573, 'New PPMP was created for project (PPMP)', 267, 0, '2023-06-27 04:19:00'),
(574, 'New PPMP was created for project (PPMP)', 1, 1, '2023-06-27 04:19:00'),
(575, 'New PPMP was created for project (PPMP)', 272, 1, '2023-06-27 04:20:33'),
(576, 'New PPMP was created for project (PPMP)', 271, 0, '2023-06-27 04:20:33'),
(577, 'New PPMP was created for project (PPMP)', 270, 0, '2023-06-27 04:20:33'),
(578, 'New PPMP was created for project (PPMP)', 269, 1, '2023-06-27 04:20:33'),
(579, 'New PPMP was created for project (PPMP)', 268, 0, '2023-06-27 04:20:33'),
(580, 'New PPMP was created for project (PPMP)', 267, 0, '2023-06-27 04:20:33'),
(581, 'New PPMP was created for project (PPMP)', 1, 1, '2023-06-27 04:20:33'),
(582, 'Sector (Office of the VP for Academic Affairs) receives a new budget (₱250,000.00)', 271, 0, '2023-06-27 10:04:48'),
(583, 'Sector (Office of the VP for Academic Affairs) receives a new budget (₱250,000.00)', 270, 0, '2023-06-27 10:04:48'),
(584, 'Sector (Office of the VP for Academic Affairs) receives a new budget (₱250,000.00)', 269, 0, '2023-06-27 10:04:48'),
(585, 'Sector (Office of the VP for Academic Affairs) receives a new budget (₱250,000.00)', 268, 0, '2023-06-27 10:04:48'),
(586, 'Sector (Office of the VP for Academic Affairs) receives a new budget (₱250,000.00)', 267, 0, '2023-06-27 10:04:48'),
(587, 'Sector (Office of the VP for Academic Affairs) receives a new budget (₱250,000.00)', 1, 0, '2023-06-27 10:04:48'),
(588, 'New PPMP was created for project (PPMP NON CSE)', 272, 0, '2023-06-27 10:13:41'),
(589, 'New PPMP was created for project (PPMP NON CSE)', 271, 0, '2023-06-27 10:13:41'),
(590, 'New PPMP was created for project (PPMP NON CSE)', 270, 0, '2023-06-27 10:13:41'),
(591, 'New PPMP was created for project (PPMP NON CSE)', 269, 0, '2023-06-27 10:13:41'),
(592, 'New PPMP was created for project (PPMP NON CSE)', 268, 0, '2023-06-27 10:13:41'),
(593, 'New PPMP was created for project (PPMP NON CSE)', 267, 0, '2023-06-27 10:13:41'),
(594, 'New PPMP was created for project (PPMP NON CSE)', 1, 0, '2023-06-27 10:13:41'),
(595, 'New PPMP was created for project (PPMP NON CSE)', 272, 0, '2023-06-27 10:16:27'),
(596, 'New PPMP was created for project (PPMP NON CSE)', 271, 0, '2023-06-27 10:16:27'),
(597, 'New PPMP was created for project (PPMP NON CSE)', 270, 0, '2023-06-27 10:16:27');
INSERT INTO `notifications` (`id`, `notif`, `user_id`, `status`, `created_at`) VALUES
(598, 'New PPMP was created for project (PPMP NON CSE)', 269, 0, '2023-06-27 10:16:27'),
(599, 'New PPMP was created for project (PPMP NON CSE)', 268, 0, '2023-06-27 10:16:27'),
(600, 'New PPMP was created for project (PPMP NON CSE)', 267, 0, '2023-06-27 10:16:27'),
(601, 'New PPMP was created for project (PPMP NON CSE)', 1, 0, '2023-06-27 10:16:27'),
(602, 'New PPMP was created for project (PPMP NON CSE)', 272, 0, '2023-06-27 10:17:40'),
(603, 'New PPMP was created for project (PPMP NON CSE)', 271, 0, '2023-06-27 10:17:40'),
(604, 'New PPMP was created for project (PPMP NON CSE)', 270, 0, '2023-06-27 10:17:40'),
(605, 'New PPMP was created for project (PPMP NON CSE)', 269, 0, '2023-06-27 10:17:40'),
(606, 'New PPMP was created for project (PPMP NON CSE)', 268, 0, '2023-06-27 10:17:40'),
(607, 'New PPMP was created for project (PPMP NON CSE)', 267, 0, '2023-06-27 10:17:40'),
(608, 'New PPMP was created for project (PPMP NON CSE)', 1, 0, '2023-06-27 10:17:40'),
(609, 'New PPMP was created for project (PPMP CSE)', 272, 0, '2023-06-28 00:53:25'),
(610, 'New PPMP was created for project (PPMP CSE)', 271, 0, '2023-06-28 00:53:25'),
(611, 'New PPMP was created for project (PPMP CSE)', 270, 0, '2023-06-28 00:53:25'),
(612, 'New PPMP was created for project (PPMP CSE)', 269, 0, '2023-06-28 00:53:25'),
(613, 'New PPMP was created for project (PPMP CSE)', 268, 0, '2023-06-28 00:53:25'),
(614, 'New PPMP was created for project (PPMP CSE)', 267, 0, '2023-06-28 00:53:25'),
(615, 'New PPMP was created for project (PPMP CSE)', 1, 0, '2023-06-28 00:53:25'),
(616, 'New PPMP was created for project (PPMP CSE)', 272, 0, '2023-06-28 02:16:54'),
(617, 'New PPMP was created for project (PPMP CSE)', 271, 0, '2023-06-28 02:16:54'),
(618, 'New PPMP was created for project (PPMP CSE)', 270, 0, '2023-06-28 02:16:54'),
(619, 'New PPMP was created for project (PPMP CSE)', 269, 0, '2023-06-28 02:16:54'),
(620, 'New PPMP was created for project (PPMP CSE)', 268, 0, '2023-06-28 02:16:54'),
(621, 'New PPMP was created for project (PPMP CSE)', 267, 0, '2023-06-28 02:16:54'),
(622, 'New PPMP was created for project (PPMP CSE)', 1, 0, '2023-06-28 02:16:54'),
(623, 'New PPMP was created for project (PPMP CSE)', 272, 0, '2023-06-30 22:46:12'),
(624, 'New PPMP was created for project (PPMP CSE)', 271, 0, '2023-06-30 22:46:12'),
(625, 'New PPMP was created for project (PPMP CSE)', 270, 0, '2023-06-30 22:46:12'),
(626, 'New PPMP was created for project (PPMP CSE)', 269, 0, '2023-06-30 22:46:12'),
(627, 'New PPMP was created for project (PPMP CSE)', 268, 0, '2023-06-30 22:46:12'),
(628, 'New PPMP was created for project (PPMP CSE)', 267, 0, '2023-06-30 22:46:12'),
(629, 'New PPMP was created for project (PPMP CSE)', 1, 0, '2023-06-30 22:46:12'),
(630, 'New PPMP was created for project (PPMP CSE)', 272, 0, '2023-07-01 10:40:51'),
(631, 'New PPMP was created for project (PPMP CSE)', 271, 0, '2023-07-01 10:40:51'),
(632, 'New PPMP was created for project (PPMP CSE)', 270, 0, '2023-07-01 10:40:51'),
(633, 'New PPMP was created for project (PPMP CSE)', 269, 0, '2023-07-01 10:40:51'),
(634, 'New PPMP was created for project (PPMP CSE)', 268, 0, '2023-07-01 10:40:51'),
(635, 'New PPMP was created for project (PPMP CSE)', 267, 0, '2023-07-01 10:40:51'),
(636, 'New PPMP was created for project (PPMP CSE)', 1, 0, '2023-07-01 10:40:51'),
(637, 'New PPMP was created for project (PPMP CSE)', 272, 0, '2023-07-01 10:41:50'),
(638, 'New PPMP was created for project (PPMP CSE)', 271, 0, '2023-07-01 10:41:50'),
(639, 'New PPMP was created for project (PPMP CSE)', 270, 0, '2023-07-01 10:41:50'),
(640, 'New PPMP was created for project (PPMP CSE)', 269, 0, '2023-07-01 10:41:50'),
(641, 'New PPMP was created for project (PPMP CSE)', 268, 0, '2023-07-01 10:41:50'),
(642, 'New PPMP was created for project (PPMP CSE)', 267, 0, '2023-07-01 10:41:50'),
(643, 'New PPMP was created for project (PPMP CSE)', 1, 0, '2023-07-01 10:41:50'),
(644, 'New PPMP was created for project (PPMP CSE)', 272, 0, '2023-07-01 10:49:54'),
(645, 'New PPMP was created for project (PPMP CSE)', 271, 0, '2023-07-01 10:49:54'),
(646, 'New PPMP was created for project (PPMP CSE)', 270, 0, '2023-07-01 10:49:54'),
(647, 'New PPMP was created for project (PPMP CSE)', 269, 0, '2023-07-01 10:49:54'),
(648, 'New PPMP was created for project (PPMP CSE)', 268, 0, '2023-07-01 10:49:54'),
(649, 'New PPMP was created for project (PPMP CSE)', 267, 0, '2023-07-01 10:49:54'),
(650, 'New PPMP was created for project (PPMP CSE)', 1, 0, '2023-07-01 10:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `ppmp`
--

CREATE TABLE `ppmp` (
  `id` int(10) UNSIGNED NOT NULL,
  `ppmp_category` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `college_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `status` int(10) UNSIGNED NOT NULL,
  `status_remarks` text NOT NULL,
  `update_by` int(10) UNSIGNED NOT NULL,
  `signature` varchar(70) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `generated_by_budget_offiicer` int(10) UNSIGNED NOT NULL,
  `generated_docu_type` varchar(50) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp(),
  `docu_generate_by` int(10) UNSIGNED NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `del_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ppmp_item`
--

CREATE TABLE `ppmp_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `ppmp_id` int(10) UNSIGNED NOT NULL,
  `project_item_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `mop` int(11) NOT NULL,
  `jan` int(11) NOT NULL,
  `feb` int(11) NOT NULL,
  `mar` int(11) NOT NULL,
  `apr` int(11) NOT NULL,
  `may` int(11) NOT NULL,
  `jun` int(11) NOT NULL,
  `jul` int(11) NOT NULL,
  `aug` int(11) NOT NULL,
  `sep` int(11) NOT NULL,
  `oct` int(11) NOT NULL,
  `nov` int(11) NOT NULL,
  `december` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `status_remarks` text NOT NULL,
  `update_by` int(11) NOT NULL,
  `signature` varchar(70) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PPMP of CIT', '2023-05-21 23:05:52', NULL, '2023-06-26 00:00:00'),
(3, 'PPMP of COE', '2023-06-26 13:02:52', NULL, '2023-06-26 00:00:00'),
(4, 'PPMP of COS', '2023-06-26 13:03:42', NULL, '2023-06-26 00:00:00'),
(5, 'PPMP of CIE', '2023-06-26 13:04:47', NULL, '2023-06-26 00:00:00'),
(6, 'PPMP CSE', '2023-06-26 13:05:03', NULL, NULL),
(7, 'PPMP of CLA', '2023-06-26 13:05:14', NULL, '2023-06-26 00:00:00'),
(8, 'PPMP NON CSE', '2023-06-27 06:51:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requests`
--

CREATE TABLE `purchase_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `pr_number` varchar(50) NOT NULL,
  `date` varchar(25) NOT NULL,
  `purpose` text NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `status_remarks` text NOT NULL,
  `update_by` int(10) UNSIGNED NOT NULL,
  `signature` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requests_items`
--

CREATE TABLE `purchase_requests_items` (
  `id` int(11) NOT NULL,
  `purchase_requests_id` int(10) UNSIGNED NOT NULL,
  `project_item_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Office of the President', '2023-05-21 22:46:58', NULL, NULL),
(2, 'Office of the VP for Academic Affairs', '2023-05-21 22:46:58', '2023-06-26 00:00:00', NULL),
(4, 'Office of the VP for Administration and Finance', '2023-06-26 08:17:54', NULL, NULL),
(5, 'Office of the VP for Planning Development and Information System', '2023-06-26 08:18:57', NULL, NULL),
(6, 'Office of the VP for Research and Extension', '2023-06-26 08:19:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sector_budget`
--

CREATE TABLE `sector_budget` (
  `id` int(10) UNSIGNED NOT NULL,
  `sector_id` int(10) UNSIGNED NOT NULL,
  `date` varchar(20) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `type` varchar(3) NOT NULL COMMENT 'in or out',
  `new_amt` decimal(18,2) NOT NULL,
  `remarks` text NOT NULL,
  `transaction_description` varchar(60) NOT NULL,
  `signature` varchar(50) NOT NULL,
  `created_by` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sector_budget`
--

INSERT INTO `sector_budget` (`id`, `sector_id`, `date`, `amount`, `type`, `new_amt`, `remarks`, `transaction_description`, `signature`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, '2023-06-27', '250000.00', '', '0.00', '', '', '', '272', '2023-06-27 10:04:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user_role` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `college_id` int(10) UNSIGNED NOT NULL,
  `sector_id` int(11) NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_status` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `del_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_user_role`, `id_user`, `college_id`, `sector_id`, `department_id`, `username`, `password`, `account_status`, `dt`, `del_status`) VALUES
(3, 1, 1, 0, 0, 0, 'admin', '$2y$10$AWNo.b6iAgr.YLhs/1hY6eVipskn5bcsdrCf3QtTN4Tsu2fZwjI/O', 1, '2021-07-14 05:22:23', 1),
(253, 3, 203, 0, 0, 0, 'katigbak1996', '$2y$10$9vmtb7JTZ6RPXd398MbaLOEjIM4IfuM8ZKx4UcYoqHXxuR84nDpYC', 1, '2023-04-11 08:16:49', 0),
(254, 3, 204, 0, 0, 0, 'yyyyyyyy', '$2y$10$rCLvxwZnAcy9kdmXIJUCKeD/keOh12qZ/bO3mMOOvbVBOCaDVukD2', 1, '2023-04-11 15:54:43', 1),
(265, 3, 211, 0, 0, 0, '1003', '$2y$10$ahGlzJ/VGlU7l5PCuOhZVO42n18AZona0CkVTBoP.AwtVH38qZReO', 1, '2023-04-19 15:45:12', 1),
(266, 3, 212, 0, 0, 0, '1004', '$2y$10$leDS.fZBlww0UqkAZjxKDOEQwfyZDpepnpmIxLPiFIRVAqZj3Z4Se', 1, '2023-04-19 15:45:12', 1),
(267, 3, 213, 0, 0, 0, '09352477540', '$2y$10$rBJFKBasef6kDaMfcawZp.0MdQ7Im87qYBW1H89pKyuNKTrOH7pKa', 1, '2023-05-08 16:19:29', 1),
(268, 3, 214, 0, 0, 0, 'y', '$2y$10$VgVFK6BpzbShGclFunHTqufmTOjrL1S6qVjV7XLe0Zucatm4R5CIK', 1, '2023-05-08 16:28:29', 0),
(269, 3, 215, 0, 0, 0, 'misp940025', '$2y$10$EX9AIt1gfG0.dF/LtT4Ele3FjH52u.nc0rwveXW0A3JmA3tX0xVRy', 1, '2023-05-09 03:43:50', 1),
(270, 3, 216, 0, 0, 0, 'misp940026', '$2y$10$D.UA..4g6i3IuJVK5NlMguYrO5px9pTLkt/l10/kH8lyipVxtU9UW', 1, '2023-05-09 03:47:14', 1),
(271, 3, 217, 0, 0, 0, 'depthead', '$2y$10$pwd4zoyoCSphiDwaznTCy.op9GxPgrYHhEaDanuZBgO93OnRaUdRS', 1, '2023-05-22 15:38:05', 0),
(272, 8, 218, 0, 1, 0, 'sectorhead', '$2y$10$0Ptjb/45hvfnUZfPdiuH7OoHYyquJrlIRzqeTL2CIGu3ix0h1iCea', 1, '2023-05-23 07:19:44', 0),
(273, 10, 219, 0, 0, 0, 'bacsecretariat', '$2y$10$PonJzcdmYL8uHSvBDExWBe8Pqq.3YBpfVD68nHRJg0IllutAc/rEW', 1, '2023-05-23 11:22:38', 0),
(274, 9, 220, 0, 0, 0, 'budgetofficer', '$2y$10$BFuluIhv1NyBo55.uzskLOcS1XAfn91J4cbLW60PkYanKWCzCLAY.', 1, '2023-05-23 11:29:39', 0),
(275, 3, 221, 0, 0, 0, 'departmenthead', '$2y$10$uQq.Er6OoHzoD5T9fuUqNu.utuOEty3hbK9LSXNSM7pRQFQL25bDK', 1, '2023-06-12 23:15:14', 0),
(277, 3, 222, 0, 0, 0, 'reyyyy1996', '$2y$10$luUjeFpfT94RZUoSDomyq.1NTV0rqzgQ1t8fm.mA2/mK0VudsMT2W', 1, '2023-06-13 01:37:07', 0),
(278, 11, 223, 6, 0, 0, 'college1996', '$2y$10$IO5bpdDaqV7YcUhN6HrRQ.Cm/RX/pbpgMrCQBiA9flKaVFlLLgGxa', 1, '2023-06-15 23:14:15', 0),
(279, 10, 224, 0, 0, 0, 'bacsecretariat', '$2y$10$VfeZWWzqXp.F1sPVv7xTTOxcv5JFZLwus5T7YYSSsc.xkXNVnPMcu', 1, '2023-06-16 01:41:14', 0),
(280, 11, 225, 0, 0, 0, 'cos', '$2y$10$WNjPDbkq.NEHxJ9wOdlYHulKKxmhvvMyLQL8bmmfAcT.fp6otJhsq', 1, '2023-06-19 15:35:36', 0),
(281, 3, 226, 0, 0, 0, 'mathdept', '$2y$10$4Qu09fZJ0zMDQJEcb31mk.enj03kcgaB4AuMXV7RP7yIVQ7pG6ezC', 1, '2023-06-19 15:38:49', 0),
(282, 11, 227, 1, 0, 0, 'cos.swift', '$2y$10$fkgbcM3uOpSX6y/9lTPOZ.qu8.DgKdtuokL/x.lo9ayhsdrSVWXRS', 1, '2023-06-19 17:39:43', 0),
(283, 3, 228, 0, 0, 0, 'mathdept', '$2y$10$L74NN0wEwiwbyhMTzh0skugIYePreKaSFDXfE3SqVpeCOnY5ltusC', 1, '2023-06-20 00:42:59', 0),
(284, 3, 229, 0, 0, 0, 'csdept', '$2y$10$.MwNGvmKSRp7sVxpNk.N6Os6m61IdVAD0fWS3pbPe9xKZFphjsG7G', 1, '2023-06-20 00:45:15', 0),
(285, 3, 230, 0, 0, 0, 'physicsdept', '$2y$10$cchorxqjPsej/9dgxHMrIu.rvaG0RFOAJuH0wQwE7S90Q66mzDwYS', 1, '2023-06-20 00:48:14', 0),
(286, 3, 231, 0, 0, 0, 'chemdept', '$2y$10$iXsAkpcvrZPxLEFnXLtNQeHSVTY0csDCkIjRDq/WtNGV/s3VoloOe', 1, '2023-06-20 00:51:43', 0),
(287, 11, 232, 1, 0, 0, 'cos.carey', '$2y$10$LS11f5pXa1XBT7rXKjMfTeW3a6VSmaQlkBtzwDGP/gI4p4iXXknB2', 1, '2023-06-20 00:55:34', 1),
(288, 3, 233, 0, 0, 0, 'bitdept', '$2y$10$/Wj8Pa6Cs5aTzvCj9hIWz.Qz8tEjIIy4qqF1pbQLMTY1lLTmZlq4W', 1, '2023-06-26 08:41:07', 1),
(289, 3, 234, 0, 0, 0, 'cetdept', '$2y$10$ZdOn68h5KvebZkipo/JwseX2al88hNYdZItXbYCpL9QLv4LjoNjMa', 1, '2023-06-26 08:46:14', 1),
(290, 3, 235, 0, 0, 0, 'fatdept', '$2y$10$w0SZ9UgVRkqDuHBra41YBe9jecZ25NE4CF3EZXV/lO1wMLhDJam6a', 1, '2023-06-26 08:49:46', 1),
(291, 3, 236, 0, 0, 0, 'gaptdept', '$2y$10$rS//Km2doy2xniRk8qdRnudUiu4NdOaiAhOsm4CaxHQ7Q7hGfJE7u', 1, '2023-06-26 08:53:28', 1),
(292, 3, 237, 0, 0, 0, 'metdept', '$2y$10$eVDF2Iy5ELBV.S7ekQ2LeO1HEkRUHf8MG94HitGUuuZDROfGZP9DK', 1, '2023-06-26 08:56:07', 1),
(293, 3, 238, 0, 0, 0, 'ppetdept', '$2y$10$/sDbM0BsWjN.jo.wJSq8bOC1JJsvAIwqdG/gPo9qmt.3kUv3qWdwO', 1, '2023-06-26 08:58:41', 1),
(294, 3, 239, 0, 0, 0, 'eetdept', '$2y$10$5g.a9fXA1meRSTlwtV5pfO9RwUFBAZ11EJdk7RbuHEU6xEyU2/PZW', 1, '2023-06-26 09:01:01', 1),
(295, 3, 240, 0, 0, 0, 'stcitdept', '$2y$10$j.1DPp3go5gHffSs4LR1ouuIMz0YutBMerjr.bIEFA.UedZ1xG7D2', 1, '2023-06-26 09:04:04', 1),
(296, 11, 241, 3, 0, 0, 'cit.dean', '$2y$10$E1tt9pwRZ5WBjU5q.OaLdueoecJGfor1JrGby6tznbLj/K2vNfuA.', 1, '2023-06-26 09:07:04', 1),
(297, 3, 242, 0, 0, 0, 'eedept', '$2y$10$USHXAPsovQTwCNlH5yIcseCtIRdufFLgLf1gcxRPebq5qdzyBmN0K', 1, '2023-06-26 09:36:21', 1),
(298, 3, 243, 0, 0, 0, 'ecedept', '$2y$10$JUm.IFyRQ555Y5aX2pGO8uw/Ymr/2i2mI/ZQjzfy24yQWqb2MwOhC', 1, '2023-06-26 09:40:05', 1),
(299, 3, 244, 0, 0, 0, 'medept', '$2y$10$LXc5tLs8AGwXg.bsssTi6OJv4SQylyqUN4YG4nt4fs.tS0WN0yAyW', 1, '2023-06-26 09:43:39', 1),
(300, 3, 245, 0, 0, 0, 'cedept', '$2y$10$asLZSU2sxDSm0EdjGarpDOoKnVLWQPPdNhg1KoQidqA63.vxcSOEq', 1, '2023-06-26 09:46:49', 1),
(301, 11, 246, 4, 0, 0, 'coe.dean', '$2y$10$vtFeEwGdETMGzUUzp6JZMOJ/R8eNsLpB29gP39xq6TEumA.Zl.fO6', 1, '2023-06-26 09:50:21', 1),
(302, 11, 247, 2, 0, 0, 'cie.dean', '$2y$10$/IJ7Lb7HL/iUhkYHXXXU7urLNtbEXfn4x.1P9siqDFbi9wHBfDZLC', 1, '2023-06-26 09:53:53', 1),
(303, 3, 248, 0, 0, 0, 'stciedept', '$2y$10$v/2azts0/XIcClmyxuQ72OgqoGHxEAixwfxP2S9UKbYwRqqnNrnt.', 1, '2023-06-26 10:00:46', 1),
(304, 3, 249, 0, 0, 0, 'tadept', '$2y$10$avIOhsoP6JBy3A1mWKh7I.K9ImJ6wKrbJuXg.3HwpFnyLMui1CbG2', 1, '2023-06-26 10:05:21', 1),
(305, 3, 250, 0, 0, 0, 'hedept', '$2y$10$c6vLfcswlH0c35zLOulysu0DPALmqOCJWey6oFlMPXDvs.7Lr/T6q', 1, '2023-06-26 10:08:50', 1),
(306, 3, 251, 0, 0, 0, 'piedept', '$2y$10$GbAT/RVjSQ0FnhNS28u1G.5PbR84XCFpfDEsa5ItJIUonA.XwTYoi', 1, '2023-06-26 10:11:58', 1),
(307, 11, 252, 1, 0, 0, 'cos.dean', '$2y$10$5QkwIVNkP47jy2Atkk/vq.Ihrit1Eo6imtne1wwH3UK0hbf3CBXJW', 1, '2023-06-26 10:17:00', 1),
(308, 3, 253, 0, 0, 0, 'mathdept', '$2y$10$i5thWmP7hfNS7QyQM7jpC.qaBt/xhN613BYs9uwIoMEe8CiQaWaD2', 1, '2023-06-26 10:21:55', 1),
(309, 3, 254, 0, 0, 0, 'chemdept', '$2y$10$EdYiRimW9clR7sAVE/lJf.NXUFTkxtKX7TwGJDgsX4gX99B1/HxvG', 1, '2023-06-26 10:24:45', 1),
(310, 3, 255, 0, 0, 0, 'physdept', '$2y$10$kiFTi1ZNu.6Xz9iafOo19.jTuZMrO84pyR8OnI/Hx/oKKMameXqU6', 1, '2023-06-26 10:27:54', 1),
(311, 3, 256, 0, 0, 0, 'csdept', '$2y$10$LMhlFuE5prAJZR2rHS149.QvTH5avLZh4etf1B1e2pP7J2.s13SrK', 1, '2023-06-26 10:30:27', 1),
(312, 11, 257, 6, 0, 0, 'cafa.dean', '$2y$10$/DwzhfZKzXpoK/63.zHG.eWPGdAB6VCEcl6HaQEKS7AgiTQJV2RYi', 1, '2023-06-26 10:33:36', 1),
(313, 3, 258, 0, 0, 0, 'archdept', '$2y$10$/fA7Q9dQBNuudY0dNVx8fOP6yhSJdAnCcSjjGCh7wBqNAp82XkRrO', 1, '2023-06-26 10:38:35', 1),
(314, 3, 259, 0, 0, 0, 'fadept', '$2y$10$2.DaSIgz.oJSeDvYDd9aR.q2ixG7WdRt8PJ9xIpwvkLcQEDrwxO1S', 1, '2023-06-26 10:42:57', 1),
(315, 3, 260, 0, 0, 0, 'gradept', '$2y$10$9MqEa96AaZD50TxgkuY5UOUQR7owO..a2COhhmlNZMpLY89Slxr6u', 1, '2023-06-26 10:47:13', 1),
(316, 11, 261, 5, 0, 0, 'cla.dean', '$2y$10$tJLveMLUgWUpU/3C1GgqT.MMRgu5d.WYFlyX5AXvw1rWElfG6ICxm', 1, '2023-06-26 10:50:49', 1),
(317, 3, 262, 0, 0, 0, 'langdept', '$2y$10$0NnDru2GfCMIdUftV66eeeqC6iO4or9saB45xESk.xZe5Gej1MWVe', 1, '2023-06-26 10:54:05', 1),
(318, 3, 263, 0, 0, 0, 'emdept', '$2y$10$cUe7aLaN9ohOAAeawOdCvuGReyLjirAG2q/8XOkSgDfOGI4qtb4Am', 1, '2023-06-26 10:57:21', 1),
(319, 3, 264, 0, 0, 0, 'ssdept', '$2y$10$FWrVWOtoKl14nS2nIStnheZ4MdiOk2xztSV4MA5FfnbPrXueGCMge', 1, '2023-06-26 11:01:09', 1),
(320, 3, 265, 0, 0, 0, 'pedept', '$2y$10$c3T/Z027RUJSV0hHFGDNKOJ/aPOGGjObjgCxmOtbZKqMeIbe.iFOC', 1, '2023-06-26 11:04:43', 1),
(321, 8, 266, 0, 1, 0, 'sectorhead', '$2y$10$9lplI88n4Y4/Jrz.LQ9l/ea0YphqymY5lANc0XzyEry/4qmvwLiNi', 1, '2023-06-26 13:46:10', 0),
(322, 8, 267, 0, 1, 0, 'op.tup', '$2y$10$XiQybFgPORDyeVPeNJhFQ.i.j/z72JCQ75/JWjosdqHzXgFA4wLzW', 1, '2023-06-26 14:05:12', 1),
(323, 8, 268, 0, 5, 0, 'ovppdis.tup', '$2y$10$D1SPpHJldwtEiGnjrU3qquS7U3GGlPHOZG1WqgpGk5WHE/U2Eppqa', 1, '2023-06-26 14:09:04', 1),
(324, 8, 269, 0, 2, 0, 'ovpaa.tup', '$2y$10$LS11f5pXa1XBT7rXKjMfTeW3a6VSmaQlkBtzwDGP/gI4p4iXXknB2', 1, '2023-06-26 14:12:55', 1),
(325, 8, 270, 0, 4, 0, 'ovpaf.tup', '$2y$10$oO4Dtver.jr7rf78axwHDOLtYM2tqjpDygkZISWRlasfY3K.y6Nu.', 1, '2023-06-26 14:15:51', 1),
(326, 8, 271, 0, 6, 0, 'ovpre.tup', '$2y$10$.fy/9LLmQjNGgdTzlhjOo.zx0hgZGeOqSr9PgrxmQTQ3.Ocp5F6ya', 1, '2023-06-26 14:18:35', 1),
(327, 9, 272, 0, 0, 0, 'bo.tup', '$2y$10$65djQvHgnHe9qiYGKYS.Z.8wglTh5UrVpOuCsWSBTw8rgjxGjiHEi', 1, '2023-06-26 15:07:02', 1),
(328, 10, 273, 0, 0, 0, 'bacsec.tup', '$2y$10$2FTacTcF8ODhHNp6HTZ8J.uQayABHiYp42BoEjNwNpWHGFWu4u3LS', 1, '2023-06-26 15:10:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `signature` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `first_name` varchar(70) NOT NULL,
  `middle_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `birthday` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `nationality` varchar(150) NOT NULL,
  `civil_status` varchar(40) NOT NULL,
  `religion` varchar(65) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `del_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `signature`, `picture`, `first_name`, `middle_name`, `last_name`, `birthday`, `gender`, `nationality`, `civil_status`, `religion`, `email`, `contact`, `telephone`, `address`, `dt`, `del_status`) VALUES
(1, '', 'default_pic.png', 'Admin', 'Admin', 'Admin', '2021-07-06', 'Male', 'Filipino', 'Single', 'c', 'admin@gmail.com', '09951211867', '', 'BLK 1 LOT 32 VILLA LAS CASAS BRGY MALITLIT SANTA ROSA LAGUNA', '2021-07-13 20:49:06', 1),
(203, '', 'xxxx.png', 'xxx', 'x', 'xxx', '2023-04-11', 'Male', '', '', '', 'jrey.katigbak1996@gmail.com', '09352477540', '', 'St. Joseph Phase 3 Block 1 Lot 13, Inosluban', '2023-04-11 08:16:49', 1),
(217, '', 'default_pic.png', 'Head', 'R', 'Department', '2023-05-22', 'Male', '', '', '', 'jrey.katigbak1996@gmail.com', '09352477540', '', 'St. Joseph Phase 3 Block 1 Lot 13, Inosluban', '2023-05-22 15:38:05', 1),
(218, 'svm32mgt0475477.png', 'default_pic.png', 'Head', 'b', 'Sector', '2023-05-23', 'Male', '', '', '', 'jrey.katigbak1996@gmail.com', '09352477540', '', 'St. Joseph Phase 3 Block 1 Lot 13, Inosluban', '2023-05-23 07:19:44', 1),
(219, 'u5o736x2sk31700.png', 'cpascodhar97196.png', 'secretariat', 'R', 'bac', '2023-05-23', 'Male', '', '', '', 'bacsecretariat@gmail.com', '09352477540', '', 'St. Joseph Phase 3 Block 1 Lot 13, Inosluban', '2023-05-23 11:22:37', 1),
(220, 'kirv17snq119355.png', 'default_pic.png', 'officer', 'R', 'budget', '2023-05-23', 'Male', '', '', '', 'budgetofficer@gmail.com', '09352477111', '', 'St. Joseph Phase 3 Block 1 Lot 13, Inosluban', '2023-05-23 11:29:39', 1),
(221, '', 'default_pic.png', 'head', 'd', 'dep', '2023-06-13', 'Male', '', '', '', 'departmenthead@gmail.com', '09352477540', '', 'St. Joseph Phase 3 Block 1 Lot 13, Inosluban', '2023-06-12 23:15:14', 1),
(222, '0ovgh6xtz923227.png', 'unzli2zlye45668.png', 'rey', 'u', 'rey', '2023-06-13', 'Male', '', '', '', 'reyyyy1996@gmail.com', '09352477540', '', 'St. Joseph Phase 3 Block 1 Lot 13, Inosluban', '2023-06-13 01:37:07', 1),
(223, 'o5wdjeg8bi13258.png', 'mt65ore9iw36218.png', 'college', 'c', 'college', '2023-06-16', 'Male', '', '', '', 'collegeAFA1996@gmail.com', '09352477540', '', 'St. Joseph Phase 3 Block 1 Lot 13, Inosluban', '2023-06-15 23:14:15', 1),
(224, 'ws8oe5fv4061293.png', 'default_pic.png', 'Secretariat', 'C', 'Bac', '2023-06-16', 'Male', '', '', '', 'bacsecretariat@gmail.com', '09352477540', '', 'TUP Manila', '2023-06-16 01:41:14', 1),
(225, 'tk8cb2s5ej54089.jpg', 'default_pic.png', 'Taylor', 'A', 'Swift', '2023-06-19', 'Female', '', '', '', 'cos@tup.edu.ph', '09123456789', '', 'Manila, Philippines', '2023-06-19 15:35:36', 1),
(226, 'qa3txwsji524483.jpg', 'default_pic.png', 'Kathryn', 'M.', 'Bernardo', '2023-06-19', 'Female', '', '', '', 'mathdept@tup.edu.ph', '09123456789', '', 'Cavite', '2023-06-19 15:38:49', 1),
(227, 'xxyjn46fe316857.png', 'default_pic.png', 'Taylor', 'A.', 'Swift', '2023-06-20', 'Female', '', '', '', 'taylor.swift@tup.edu.ph', '09123456789', '', 'Cavite, Philippines', '2023-06-19 17:39:43', 1),
(228, 'k36ughewet70838.png', 'default_pic.png', 'Taylor', 'A.', 'Swift', '2023-06-20', 'Female', '', '', '', 'taylor.swift@tup.edu.ph', '09123456789', '', 'Cavite, Philippines', '2023-06-20 00:42:58', 1),
(229, '6iindqpbnw91359.png', 'default_pic.png', 'Kathryn', 'M', 'Bernardo', '2023-06-20', 'Female', '', '', '', 'kathryn.bernardo@tup.edu.ph', '09234567891', '', 'Quezon City, Philippines', '2023-06-20 00:45:15', 1),
(230, 'th27r6ylyj56775.png', 'default_pic.png', 'Nadine', 'P', 'Lustre', '2023-06-20', 'Female', '', '', '', 'nadine.lustre@tup.edu.ph', '09123456789', '', 'Manila, Philippines', '2023-06-20 00:48:13', 1),
(231, 'qo7w4y35dk67379.png', 'default_pic.png', 'Liza', 'H', 'Soberano', '2023-06-20', 'Female', '', '', '', 'liza.soberano@tup.edu.ph', '09123456789', '', 'Tondo, Manila', '2023-06-20 00:51:43', 1),
(232, 'nexw4hn31p69159.png', 'default_pic.png', 'Mariah', 'A', 'Carey', '2023-06-20', 'Female', '', '', '', 'mariah.carey@tup.edu.ph', '09123456789', '', 'Ermita, Manila', '2023-06-20 00:55:34', 1),
(233, '1z91rk8qut20160.png', '5aw30ga06f16321.jpg', 'Pia', 'A.', 'Wurtzbach', '1989-09-24', 'Female', '', '', '', 'paw_cit@tup.edu.ph', '09123456789', '', 'Caloocan City, Philippines', '2023-06-26 08:41:07', 1),
(234, '470618jexr32006.png', 'kpg91eihou90522.jpg', 'Kylie', 'F.', 'Versoza', '1992-02-07', 'Female', '', '', '', 'kfv_cit@tup.edu.ph', '09234567891', '', 'Las Piñas, Philippines', '2023-06-26 08:46:14', 1),
(235, '4gwvmwx7ej79320.png', 'rnb3wg04xx97899.jpg', 'Megan', 'T.', 'Young', '1990-02-27', 'Female', '', '', '', 'mty_cit@tup.edu.ph', '09345678912', '', 'Makati City, Philippines', '2023-06-26 08:49:46', 1),
(236, 'baq6fi2kad49785.png', 'fhhlnzp6ua86624.jpg', 'Celesti', 'R.', 'Cortesi', '1997-12-15', 'Female', '', '', '', 'crc_cit@tup.edu.ph', '09456789123', '', 'Malabon City Philippines', '2023-06-26 08:53:28', 1),
(237, 'hyr75ydsw791170.png', 'q4foacqlrb77879.jpg', 'Venus', 'B.', 'Raj', '1988-07-07', 'Female', '', '', '', 'vbr_cit@tup.edu.ph', '09567891234', '', 'Mandaluyong City, Philippines', '2023-06-26 08:56:06', 1),
(238, 'ldr19zsqe672063.png', '4mymft5puq61010.jpg', 'Janine ', 'R. ', 'Tugonon', '1989-10-18', 'Female', '', '', '', 'jrt_cit@tup.edu.ph', '09678912345', '', 'Manila City, Philippines', '2023-06-26 08:58:41', 1),
(239, 'hlrb5a4gy672013.png', '2rg7kg7xp598899.jpg', 'Rabiya', 'O.', 'Mateo', '1996-11-14', 'Female', '', '', '', 'rom_cit@tup.edu.ph', '09789123456', '', 'Marikina City, Philippines', '2023-06-26 09:01:01', 1),
(240, 'oxm4que2et28073.png', '6qf0k7er1e23091.jpg', 'Michelle', 'M.', 'Dee', '1995-04-24', 'Female', '', '', '', 'mmd_cit@tup.edu.ph', '09891234567', '', 'Muntinlupa City, Philippines', '2023-06-26 09:04:04', 1),
(241, '4rbhh0dds566296.png', 'agbfre6qu329324.jpg', 'Catriona', 'M.', 'Gray', '1994-01-06', 'Female', '', '', '', 'cmg_cit@tup.edu.ph', '09987654321', '', 'Navotas City, Philippines', '2023-06-26 09:07:04', 1),
(242, 'ig079yltw511153.png', '3spg31ty3545484.jpg', 'Nadine', 'P.', 'Lustre', '1993-10-31', 'Female', '', '', '', 'npl_coe@tup.edu.ph', '09876543210', '', 'Parañaque City, Philippines', '2023-06-26 09:36:21', 1),
(243, 'dwsghyx00492016.png', 'x65er872g296383.jpg', 'Kathryn', 'M.', 'Bernardo', '1996-03-26', 'Female', '', '', '', 'kmb_coe@tup.edu.ph', '09887654321', '', 'Pasay City, Philippines', '2023-06-26 09:40:05', 1),
(244, 'dwsghyx00492016.png', '8udsw8kdry26133.jpg', 'Julia', 'S.', 'Montes', '1995-03-19', 'Female', '', '', '', 'jsm_coe@tup.edu.ph', '09776543211', '', 'Pasig City, Philippines', '2023-06-26 09:43:39', 1),
(245, 'vyzx6qcg0h29649.png', 'bwrpkbr9l767562.jpg', 'Belle', 'A.', 'Mariano', '2002-06-10', 'Female', '', '', '', 'bam_coe@tup.edu.ph', '09654321098', '', 'Pateros, Philippines', '2023-06-26 09:46:49', 1),
(246, 'u6mzx8dnve41227.png', '5o9e0c4km266382.jpg', 'Liza ', 'H.', 'Soberano', '1998-01-04', 'Female', '', '', '', 'lhz_coe@tup.edu.ph', '09543217894', '', 'Quezon City, Philippines', '2023-06-26 09:50:21', 1),
(247, 'a8km2ev5lg66616.png', 'pjjs7ks96q75184.jpg', 'Marian', 'R.', 'Dantes', '1984-08-12', 'Female', '', '', '', 'mrd_cie@tup.edu.ph', '09665412378', '', 'San Juan City, Philippines', '2023-06-26 09:53:53', 1),
(248, 'eo0unxk4ps64210.png', 'yykchq1iwi74548.jpg', 'Antoinette', 'F.', 'Taus', '1981-08-30', 'Female', '', '', '', 'aft_cie@tup.edu.ph', '09554321789', '', 'Taguig City, Philippines', '2023-06-26 10:00:46', 1),
(249, '6jm79oqexg99656.png', '21i5y64s6948141.jpg', 'Karylle', 'T.', 'Yuzon', '1981-03-22', 'Female', '', '', '', 'kty_cie@tup.edu.ph', '09332145698', '', 'Valenzuela City, Philippines', '2023-06-26 10:05:21', 1),
(250, '45ttq1nr6s33719.png', '8qi7stypvr79499.jpg', 'Bela', 'S.', 'Padilla', '1991-05-03', 'Female', '', '', '', 'bsp_cie@tup.edu.ph', '09221456987', '', 'Caloocan City, Philippines', '2023-06-26 10:08:50', 1),
(251, '22b0x0n4ir28438.png', 'bv8swz9k4470986.jpg', 'Jennylyn', 'P.', 'Mercado', '1987-05-15', 'Female', '', '', '', 'jpm_cie@tup.edu.ph', '09786541232', '', 'Las Piñas, Philippines', '2023-06-26 10:11:58', 1),
(252, 'xqj4fvk7k278705.png', 'legsfj1zq273495.jpg', 'Julia', 'B.', 'Barretto', '1997-03-10', 'Female', '', '', '', 'jbb_cos@tup.edu.ph', '09632587411', '', 'Makati City, Philippines', '2023-06-26 10:17:00', 1),
(253, 'rd8rl86fs435326.png', 'oe9n12d26615883.jpg', 'Kim', 'S.', 'Chiu', '1990-04-19', 'Female', '', '', '', 'ksc_cos@tup.edu.ph', '09632587415', '', 'Malabon City Philippines', '2023-06-26 10:21:55', 1),
(254, 'vkm8xjfcia47874.png', 'weuaa18mhp60627.jpg', 'Bea', 'F.', 'Alonzo', '1987-10-17', 'Female', '', '', '', 'baf_cos@tup.edu.ph', '09741258963', '', 'Mandaluyong City, Philippines', '2023-06-26 10:24:45', 1),
(255, '8rf73a41pv51867.png', 'id804iea9797057.jpg', 'Maja', 'A.', 'Salvador', '1988-10-05', 'Female', '', '', '', 'mas_cos@tup.edu.ph', '09852145796', '', 'Manila City, Philippines', '2023-06-26 10:27:54', 1),
(256, 'hlrg5r8don75344.png', 'ka5ioerdmz31650.jpg', 'Sarah', 'T.', 'Geronimo', '1988-07-25', 'Female', '', '', '', 'stg_cos@tup.edu.ph', '09369852147', '', 'Marikina City, Philippines', '2023-06-26 10:30:27', 1),
(257, '8ix4aozqhh36239.png', 'iz7niw2xff80497.jpg', 'Maine', 'D.', 'Mendoza', '1995-03-03', 'Female', '', '', '', 'mdm_cafa@tup.edu.ph', '09998745632', '', 'Muntinlupa City, Philippines', '2023-06-26 10:33:36', 1),
(258, '0t6kble51f30123.png', 'wfbcdsh8lh48354.jpg', 'Gabbi', 'L.', 'Garcia', '1998-12-02', 'Female', '', '', '', 'glg_cafa@tup.edu.ph', '09786452132', '', 'Navotas City, Philippines', '2023-06-26 10:38:35', 1),
(259, 'ajwa9otlwh46423.png', 'gs9vhr8vpa46697.jpg', 'Bea', 'L.', 'Binene', '1997-11-04', 'Female', '', '', '', 'blb_cafa@tup.edu.ph', '09632214587', '', 'Parañaque City, Philippines', '2023-06-26 10:42:56', 1),
(260, 'r4iectblwp69715.png', 'sv5njc5yeh95596.jpg', 'Barbie', 'C.', 'Forteza', '1997-07-31', 'Female', '', '', '', 'bcf_cafa@tup.edu.ph', '09632147855', '', 'Pasay City, Philippines', '2023-06-26 10:47:13', 1),
(261, '5bhzw4fg3q33352.png', 'oosn1vwwnn23325.jpg', 'Regine', 'A.', 'Velasquez', '1972-04-22', 'Female', '', '', '', 'rav_cla@tup.edu.ph', '09514753648', '', 'Pasig City, Philippines', '2023-06-26 10:50:49', 1),
(262, 'zdve13zi6s99018.png', 'gcs17gqgob85074.jpg', 'Lea', 'I.', 'Salonga', '1971-02-22', 'Female', '', '', '', 'lis_cla@tup.edu.ph', '09741236589', '', 'Pateros, Philippines', '2023-06-26 10:54:05', 1),
(263, 'qqxa1o7n9f95997.png', '0ectcrscr090435.jpg', 'Morisette', 'D.', 'Amon', '1996-06-02', 'Female', '', '', '', 'mda_cla@tup.edu.ph', '09159753365', '', 'Quezon City, Philippines', '2023-06-26 10:57:21', 1),
(264, 'xgvt39l0u560552.png', 'toqiaxirgn23568.jpg', 'Sharon', 'G.', 'Cuneta', '1966-01-06', 'Female', '', '', '', 'sgc_cla@tup.edu.ph', '09713964852', '', 'San Juan City, Philippines', '2023-06-26 11:01:09', 1),
(265, 'clkmdzdg0j87583.png', 'gjptiq8vo715162.jpg', 'Moira', 'B.', 'Dela Torre', '1993-11-04', 'Female', '', '', '', 'mbd_cla@tup.edu.ph', '09731944532', '', 'Taguig City, Philippines', '2023-06-26 11:04:43', 1),
(266, 'ygubld1un435947.png', 'default_pic.png', 'head', 'b', 'sector', '1985-06-06', 'Female', '', '', '', 'sectorhead@gmail.com', '09352477111', '', 'Cavite ', '2023-06-26 13:46:10', 1),
(267, 'ttvectqkho29005.png', '5cbxu4yj8p10534.jpg', 'Heart', 'C.', 'Evangelista', '1985-02-14', 'Female', '', '', '', 'hce_op@tup.edu.ph', '09874555632', '', 'Caloocan City, Philippines', '2023-06-26 14:05:12', 1),
(268, '76uy5mo1ni38483.png', 'kv4mynhr5175666.jpg', 'Kris', 'C.', 'Aquino', '1971-02-14', 'Female', '', '', '', 'kca_ovppdis@tup.edu.ph', '09774512689', '', 'Quezon City, Philippines', '2023-06-26 14:09:04', 1),
(269, 'nieyt2rpp936267.png', '8jgf8odrrh58845.jpg', 'Angel', 'C.', 'Locsin', '1985-04-23', 'Female', '', '', '', 'acl_ovpaa@tup.edu.ph', '09636254177', '', 'Makati City, Philippines', '2023-06-26 14:12:55', 1),
(270, 'eik97jef2b64400.png', '98ry9z7hx423782.jpg', 'Iza', 'U.', 'Calzado', '1982-08-12', 'Female', '', '', '', 'iuc_ovpaf@tup.edu.ph', '09647853147', '', 'Las Piñas, Philippines', '2023-06-26 14:15:51', 1),
(271, 'yfhwyz1n5666695.png', '32xwj3zokg26337.jpg', 'Rufamae', 'O.', 'Quinto', '1978-05-28', 'Female', '', '', '', 'roq_ovpre@tup.edu.ph', '09987745632', '', 'Malabon City Philippines', '2023-06-26 14:18:35', 1),
(272, 'ymodvgzk7n33716.png', 'ei3hk2o0w543546.jpg', 'Janella', 'D.', 'Salvador', '1998-03-30', 'Female', '', '', '', 'jds_bo@tup.edu.ph', '09663255874', '', 'Makati City, Philippines', '2023-06-26 15:07:02', 1),
(273, 'vht5mm574y69436.png', 'qto2s5wyku99467.jpg', 'Carla', 'R.', 'Abellana', '1986-06-12', 'Female', '', '', '', 'cra_bacsec@tup.edu.ph', '09336547885', '', 'Marikina City, Philippines', '2023-06-26 15:10:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(25) NOT NULL,
  `description` varchar(20) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `del_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`, `description`, `dt`, `del_status`) VALUES
(1, 'admin', 'Administrator', '2021-07-13 20:47:09', 1),
(3, 'department_head', 'Department Head', '2021-07-13 22:09:21', 1),
(8, 'sector_head', 'Sector Head', '2023-05-21 15:12:34', 1),
(9, 'budget_officer', 'Budget Officer', '2023-05-21 15:12:50', 1),
(10, 'bac_secretariat', 'BAC Secretariat', '2023-05-21 15:12:50', 1),
(11, 'college', 'College', '2023-06-15 23:11:46', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annual_budget`
--
ALTER TABLE `annual_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assigned_department`
--
ALTER TABLE `assigned_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_proposals`
--
ALTER TABLE `budget_proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoy_type` (`id_category_type`,`id_main`);

--
-- Indexes for table `category_types`
--
ALTER TABLE `category_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `college_budget`
--
ALTER TABLE `college_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `college_departments`
--
ALTER TABLE `college_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id`
--
ALTER TABLE `id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ppmp`
--
ALTER TABLE `ppmp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ppmp_item`
--
ALTER TABLE `ppmp_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_requests`
--
ALTER TABLE `purchase_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_requests_items`
--
ALTER TABLE `purchase_requests_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sector_budget`
--
ALTER TABLE `sector_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_role` (`id_user_role`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annual_budget`
--
ALTER TABLE `annual_budget`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app`
--
ALTER TABLE `app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assigned_department`
--
ALTER TABLE `assigned_department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `budget_proposals`
--
ALTER TABLE `budget_proposals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `category_types`
--
ALTER TABLE `category_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `college_budget`
--
ALTER TABLE `college_budget`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `college_departments`
--
ALTER TABLE `college_departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `id`
--
ALTER TABLE `id`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=651;

--
-- AUTO_INCREMENT for table `ppmp`
--
ALTER TABLE `ppmp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppmp_item`
--
ALTER TABLE `ppmp_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase_requests`
--
ALTER TABLE `purchase_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_requests_items`
--
ALTER TABLE `purchase_requests_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sector_budget`
--
ALTER TABLE `sector_budget`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
