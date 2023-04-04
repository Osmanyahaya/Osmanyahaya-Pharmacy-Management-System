-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 01:33 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oytech_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(25, 'Tablet '),
(26, 'Syrup'),
(27, 'suppository'),
(28, 'injection'),
(29, 'infusion'),
(30, 'capsules'),
(31, 'powder'),
(32, 'ointment'),
(33, 'solution'),
(34, 'suspension'),
(35, 'inhaler'),
(36, 'pessery'),
(37, 'Cream');

-- --------------------------------------------------------

--
-- Table structure for table `depositor`
--

CREATE TABLE `depositor` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `depositor`
--

INSERT INTO `depositor` (`id`, `name`) VALUES
(1, '85f14ba4aa9a81090ecc8ce5ed02a24efcf901f5');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` varchar(50) NOT NULL,
  `details` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `date_added`, `type`, `details`, `user_id`, `amount`) VALUES
(1, '2021-10-19 20:51:26', 'Others', 'Polybags Thank you rubber (6)', 1, '50.00'),
(2, '2021-10-19 20:55:46', 'Others', 'Cost of 1Ltr Bine Disinfectant', 1, '13.00'),
(3, '2021-11-02 19:24:35', 'Others', '3 bundle of brooms @ 3.00 each', 1, '9.00'),
(4, '2021-11-02 19:24:35', 'Others', '3 bundle of brooms @ 3.00 each', 1, '9.00'),
(5, '2021-11-09 21:42:24', 'Others', 'Cost of a light bulb', 1, '10.00'),
(6, '2021-11-09 21:43:28', 'Others', 'Cost of fuel for generator', 1, '25.00'),
(7, '2021-11-10 21:51:31', 'Cost of Water', '2 bags of Sachet water', 1, '8.00'),
(8, '2021-11-20 21:11:19', 'Cost of Water', '2 Bags of Sachet water', 1, '9.00'),
(9, '2021-11-29 21:53:45', 'Cost of Maintenance', '1 wooden Broom', 1, '10.00'),
(10, '2021-12-02 13:28:32', 'Cost of Electricity', 'Payment against November comsumption', 1, '300.00'),
(11, '2021-12-02 13:30:52', 'Others', 'SSNIT  Contribution for 2 staff for November 2021', 1, '162.00'),
(12, '2021-12-02 13:33:24', 'Others', 'SSNIT  Contribution for 2 staff for October 2021', 1, '162.00'),
(13, '2021-12-02 13:36:08', 'Others', 'Salaries for November 2021', 1, '2550.00'),
(14, '2021-12-02 13:39:50', 'Cost of Electricity', 'Payment of light bill against  October\'s Comsumption', 1, '500.00'),
(15, '2021-12-02 13:44:45', 'Others', 'Salaries for October 2021', 1, '2000.00'),
(16, '2021-12-02 14:44:42', 'Others', 'Anchor Stationary (3 A4 Paper & 6 rolls of receipt paper.', 1, '108.00'),
(17, '2021-12-02 14:46:14', 'Others', '10pkts of Thank you Polybags', 1, '50.00'),
(18, '2021-12-03 21:52:20', 'Cost of Maintenance', 'Heaven Insecticide spray', 1, '17.00'),
(19, '2021-12-07 21:50:04', 'Cost of Water', '2 Bags of Sachet water', 1, '9.00'),
(20, '2021-12-13 21:53:04', 'Cost of Maintenance', 'Cost of  new VGA cable for Monitor', 1, '30.00'),
(21, '2021-12-15 21:38:42', 'Others', 'New Monitor from Nelson', 1, '250.00'),
(22, '2021-12-15 21:39:20', 'Cost of Water', '2 Bags of Sachet water', 1, '9.00'),
(23, '2021-12-15 21:40:32', 'Cost of Maintenance', 'Cost  of 1Ltr Disinfectant - Bine 20', 1, '10.00'),
(24, '2021-12-17 20:11:44', 'Others', 'Corporate Income Tax for 2021 ( Part payment )', 1, '1500.00'),
(25, '2021-12-21 19:30:20', 'Cost of Maintenance', 'WORKS ON GLASS DOOR ( Interchange )  - MR FAISAL', 1, '25.00'),
(26, '2021-12-22 21:52:34', 'Others', 'Annual Market Cleansing  - Dakpema', 1, '16.00'),
(27, '2021-12-22 21:53:52', 'Others', 'Corporate Income Tax for 2021 ( Final payment )', 1, '3500.00'),
(28, '2021-12-23 21:35:18', 'Cost of Water', '2 Bags of Sachet water', 1, '9.00'),
(29, '2021-12-27 21:29:20', 'Others', 'MASONARY WORK - Filling of vents ( Landlord )', 1, '30.00'),
(30, '2022-01-01 19:23:39', 'Others', 'Christmas refreshment', 1, '55.00'),
(31, '2022-01-01 19:24:44', 'Cost of Water', '3 bags of Sachet Water', 1, '13.50'),
(32, '2022-01-02 21:39:58', 'Others', 'Stocking-taking package', 1, '23.00'),
(33, '2022-01-06 20:34:30', 'Others', 'BUSINESS OPERATING PERMIT FOR 2021 - TAMALE CENTRAL SUB-METRO', 1, '72.00'),
(34, '2022-01-06 20:41:13', 'Others', 'WHOLESALE / RETAIL Renewal (1600.00) & Business Renewal (200.00) for 2022.', 1, '1800.00'),
(35, '2022-01-06 20:55:24', 'Others', 'Part-payment for Superintendent Licence ( 6months )', 1, '11100.00'),
(36, '2022-01-08 21:05:02', 'Others', 'Salaries for December 2021', 1, '2500.00'),
(37, '2022-01-08 21:06:36', 'Others', 'SSNIT  Contribution for 2 staff for December 2021', 1, '162.00'),
(38, '2022-01-08 21:08:28', 'Cost of Electricity', 'Payment against December 2021 comsumption', 1, '350.00'),
(39, '2022-01-11 21:59:16', 'Cost of Water', '3 bags of Sachet Water', 1, '15.00'),
(40, '2022-01-12 21:50:43', 'Cost of Maintenance', 'Cost 7 dusters bought', 1, '16.00'),
(41, '2022-01-18 15:41:42', 'Cost of Maintenance', 'Cost of polybags and Thank rubber - 10pkts', 1, '50.00'),
(42, '2022-01-25 21:53:42', 'Others', 'Cost of 500ml Glue( 15.00 ) & 1 Cash Book ( 35.00)', 1, '50.00'),
(43, '2022-02-04 14:24:33', 'Others', 'AIRTIME Bought on 28 jan 2022', 1, '10.00'),
(44, '2022-02-04 14:25:34', 'Cost of Water', '3 bags of Sachet Water bought on 31st jan 2022', 1, '15.00'),
(45, '2022-02-04 14:32:18', 'Others', 'Salaries of  staff for January 2022', 1, '2350.00'),
(46, '2022-02-04 14:33:29', 'Others', 'SSNIT  Contribution for 3 staff for January 2022', 1, '227.50'),
(47, '2022-02-04 14:38:32', 'Cost of Electricity', 'Payment against January 2022 consumption', 1, '700.00'),
(48, '2022-02-08 21:40:58', 'Others', 'Cost of paint & repainting the pharmacy - Mr Dominic', 1, '660.00'),
(49, '2022-02-11 21:52:44', 'Others', '0NE PACK OF PERMANENT MARKERS', 1, '8.00'),
(50, '2022-02-11 21:54:12', 'Cost of Maintenance', 'Cost of metalic handle broom bought from Melcom', 1, '18.00'),
(51, '2022-02-21 19:14:22', 'Others', '1 LARGE SIZE CELLOTAPE', 1, '15.00'),
(52, '2022-02-21 19:42:44', 'Cost of Water', '3 bags of Sachet Water', 1, '15.00'),
(53, '2022-02-21 20:04:52', 'Cost of Maintenance', 'Cost 15A AC Output sochet to replace burnt one', 1, '8.00'),
(54, '2022-02-22 21:39:20', 'Others', 'Cost of 2.5Ltr liquid soap', 1, '16.00'),
(55, '2022-02-24 11:36:15', 'Others', 'Cost of 3 bottles of Bine for cleaning', 1, '15.00'),
(56, '2022-02-24 22:14:34', 'Cost of Maintenance', 'Cost 6 pcs of thermal roll- receipt paper', 1, '48.00'),
(57, '2022-02-25 21:55:19', 'Others', 'cost of Polybags', 1, '51.00'),
(58, '2022-03-04 20:22:39', 'Others', '1 gallon of petrol for generator', 1, '34.10'),
(59, '2022-03-04 20:38:21', 'Others', 'Salaries of  staff for February 2022', 1, '2400.00'),
(60, '2022-03-04 20:39:28', 'Others', 'SSNIT  Contribution for 3 staff for February 2022', 1, '227.50'),
(61, '2022-03-04 20:41:02', 'Cost of Electricity', 'Payment against February 2022 consumption', 1, '300.00'),
(62, '2022-03-08 19:40:27', 'Others', 'Cost of 2 long sleeves Lab coats', 1, '180.00'),
(63, '2022-03-10 22:00:50', 'Others', '1 rim of A4 paper', 1, '28.00'),
(64, '2022-03-26 20:31:53', 'Cost of Water', '6 bags bought on 14th & 25th March 2022', 1, '30.00'),
(65, '2022-03-26 20:33:50', 'Others', 'Cost of Mob bought on 9th March 2022', 1, '12.00'),
(66, '2022-03-31 19:27:50', 'Cost of Water', 'Cost of special bottle water', 1, '15.00'),
(67, '2022-03-31 19:51:26', 'Others', 'T & T for Mr Yahaya for Software updates', 1, '50.00'),
(68, '2022-03-31 19:53:30', 'Others', 'Salaries of  staff for March 2022', 1, '2400.00'),
(69, '2022-03-31 19:54:33', 'Others', 'SSNIT  Contribution for 3 staff for March 2022', 1, '227.50'),
(70, '2022-03-31 20:08:12', 'Cost of Electricity', 'Payment against March 2022 consumption', 1, '300.00'),
(71, '2022-04-04 13:45:13', 'Others', 'Cost of Stationary ( One Pack each, Clear Bag & Markers)', 1, '22.00'),
(72, '2022-04-08 21:42:30', 'Cost of Water', '3 bags of Sachet Water', 1, '18.00'),
(73, '2022-04-12 21:57:39', 'Others', 'Cost HP 79A Tonner', 1, '170.00'),
(74, '2022-04-12 21:58:25', 'Others', 'Cost Mouse Pad - 2pcs', 1, '20.00'),
(75, '2022-04-12 21:59:51', 'Others', 'Cost of 1 Rim of A4 Paper & 6 rolls of receipt paper', 1, '94.00'),
(76, '2022-04-12 22:02:07', 'Others', 'Cost of design & embroidery of 4 Lab coats', 1, '62.00'),
(77, '2022-04-30 20:54:18', 'Others', 'Salaries of  staff for April 2022', 1, '2850.00'),
(78, '2022-04-30 20:56:12', 'Cost of Electricity', 'Payment against April 2022 consumption', 1, '300.00'),
(79, '2022-04-30 20:58:24', 'Others', 'SSNIT  Contribution for 3 staff for April 2022', 1, '227.50'),
(80, '2022-05-30 21:38:41', 'Others', '2 Rims of A4 paper @ 40.00 each', 1, '80.00'),
(81, '2022-05-30 21:39:37', 'Others', 'Salaries of staff for May 2022', 1, '2400.00'),
(82, '2022-05-30 21:40:20', 'Others', 'SSNIT  Contribution for 3 staff for May 2022', 1, '227.50'),
(83, '2022-05-30 21:41:00', 'Cost of Electricity', 'Payment against May 2022 consumption', 1, '600.00'),
(84, '2022-06-09 21:05:48', 'Others', 'Polybags -Thank you rubber (6)', 1, '48.00'),
(85, '2022-06-09 21:06:52', 'Others', 'Commission on Nephrostomy tubes - Dr Muntaka', 1, '100.00'),
(86, '2022-06-10 20:25:09', 'Cost of Electricity', 'Settlement of Electricity Arrear up to June 2022', 1, '1580.00'),
(87, '2022-06-10 20:29:54', 'Cost of Electricity', 'final settlement of electricity bill in June 2022', 1, '620.00'),
(88, '2022-07-09 20:40:57', 'Others', 'Salaries of  staff for June 2022', 1, '2400.00'),
(89, '2022-07-09 20:42:12', 'Others', 'SSNIT  Contribution for 3 staff for June 2022', 1, '228.00'),
(90, '2022-07-09 20:50:40', 'Cost of Electricity', 'Cost of Prepaid  450.00 and 50.00 refunded', 1, '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `action_made` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action_made`, `date_created`) VALUES
(1, 90, 'Logged out.', '2022-10-15 17:13:06'),
(2, 12, 'Logged in the system.', '2022-10-15 17:15:11'),
(3, 12, 'Logged out.', '2022-10-15 17:15:20'),
(4, 12, 'Logged in the system.', '2022-10-15 17:28:00'),
(5, 12, 'Logged out.', '2022-10-15 17:28:14'),
(6, 5, 'Logged in the system.', '2022-10-15 17:31:59'),
(7, 5, ' Made sales  of [invoice=2210150001] [amount=12.00].', '2022-10-15 17:34:07'),
(8, 12, 'Logged in the system.', '2022-10-15 17:36:33'),
(9, 5, 'Logged in the system.', '2022-10-15 17:59:45'),
(10, 5, 'Logged in the system.', '2022-10-15 18:05:50'),
(11, 1, 'Logged out.', '2022-10-15 18:29:04'),
(12, 12, 'Logged in the system.', '2022-10-15 18:29:16'),
(13, 12, ' Made sales  of [invoice=2210160001] [amount=96.00].', '2022-10-16 10:22:27'),
(14, 12, 'Logged in the system.', '2022-10-22 14:51:14'),
(15, 12, 'Logged in the system.', '2022-11-01 16:18:57'),
(16, 12, 'Logged out.', '2022-11-01 16:20:03'),
(17, 12, 'Logged in the system.', '2022-11-01 18:21:28'),
(18, 12, ' Made sales  of [invoice=2211010001] [amount=125.00].', '2022-11-01 18:46:52'),
(19, 12, ' Made sales  of [invoice=2211010002] [amount=166.00].', '2022-11-01 19:04:35'),
(20, 12, ' Made sales  of [invoice=2211010003] [amount=370.00].', '2022-11-01 19:37:11'),
(21, 12, 'Logged out.', '2022-11-01 22:53:31'),
(22, 12, 'Logged in the system.', '2022-11-05 12:26:39'),
(23, 12, 'Logged out.', '2022-11-05 12:31:54'),
(24, 12, 'Logged in the system.', '2022-12-23 20:47:24'),
(25, 12, ' added stock of [id=2212001] [total cost=3760.2] into the stock list.', '2022-12-23 20:48:35'),
(26, 12, ' Changed the price of [id=2] LIV 52 CAPS.', '2022-12-23 21:03:40'),
(27, 12, ' added stock of [id=2212001] [total cost=6618.8] into the stock list.', '2022-12-23 21:25:36'),
(28, 12, 'Logged in the system.', '2022-12-27 14:47:51'),
(29, 12, ' added stock of [id=2212002] [total cost=6618.8] into the stock list.', '2022-12-28 10:47:46'),
(30, 12, ' added stock of [id=2212003] [total cost=6618.8] into the stock list.', '2022-12-28 11:04:59'),
(31, 12, ' added stock of [id=2212004] [total cost=7120] into the stock list.', '2022-12-28 11:13:25'),
(32, 12, ' added stock of [id=2212002] [total cost=7120] into the stock list.', '2022-12-28 11:14:56'),
(33, 12, ' Made sales  of [invoice=2212280001] [amount=144.00].', '2022-12-28 11:33:49'),
(34, 12, ' Made sales  of [invoice=2212280002] [amount=43.00].', '2022-12-28 12:41:06'),
(35, 12, ' Made sales  of [invoice=2212280001] [amount=284.00].', '2022-12-28 12:44:44'),
(36, 12, 'Deleted a Transaction of [invoice=2212280001] [total amount=284.00] from the transaction list.', '2022-12-28 12:51:39'),
(37, 12, 'Logged out.', '2022-12-28 12:51:59'),
(38, 2, 'Logged in the system.', '2022-12-28 12:52:13'),
(39, 2, 'Logged out.', '2022-12-28 12:53:01'),
(40, 1, 'Logged in the system.', '2022-12-28 12:53:11'),
(41, 1, ' Made sales  of [invoice=2212280001] [amount=86.00].', '2022-12-28 12:53:51'),
(42, 1, 'Logged out.', '2022-12-28 12:54:43'),
(43, 1, 'Logged in the system.', '2022-12-28 15:33:09'),
(44, 1, 'Logged out.', '2022-12-28 15:33:21'),
(45, 1, 'Logged in the system.', '2022-12-29 05:30:55'),
(46, 1, ' Made sales  of [invoice=2212290001] [amount=140.00].', '2022-12-29 05:39:05'),
(47, 1, ' added stock of [id=2212001] [total cost=23040] into the stock list.', '2022-12-29 06:11:56'),
(48, 1, 'Logged in the system.', '2023-01-01 15:33:11'),
(49, 1, 'Logged out.', '2023-01-01 15:46:03'),
(50, 1, 'Logged in the system.', '2023-01-01 16:02:55'),
(51, 1, 'Logged in the system.', '2023-03-16 08:35:04'),
(52, 1, 'Logged out.', '2023-03-16 08:35:12'),
(53, 1, 'Logged in the system.', '2023-03-16 08:36:17'),
(54, 1, ' Made sales  of [invoice=2303160001] [amount=4.50].', '2023-03-16 08:38:32'),
(55, 1, ' added stock of [id=2303001] [total cost=1771.8] into the stock list.', '2023-03-16 08:43:43'),
(56, 1, ' Made sales  of [invoice=2303160002] [amount=48.00].', '2023-03-16 08:47:13'),
(57, 1, 'Logged out.', '2023-03-16 08:52:43'),
(58, 1, 'Logged in the system.', '2023-03-21 08:10:27'),
(59, 1, ' Made sales  of [invoice=2303210001] [amount=524.00].', '2023-03-21 08:53:27'),
(60, 1, ' updated the details of [id=3] [name=PILEX CAPS  -HIMALAYA] product .', '2023-03-21 09:00:58'),
(61, 1, ' Made sales  of [invoice=2303210002] [amount=110.00].', '2023-03-21 09:01:21'),
(62, 1, ' added stock of [id=2303002] [total cost=2023.7] into the stock list.', '2023-03-21 11:26:22'),
(63, 1, ' Made sales  of [invoice=2303210003] [amount=10.00].', '2023-03-21 17:08:50'),
(64, 1, ' Made sales  of [invoice=2303210004] [amount=82.00].', '2023-03-21 17:10:20');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_name` varchar(100) NOT NULL,
  `prod_desc` varchar(500) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `prod_cprice` decimal(10,2) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `reorder` int(11) NOT NULL,
  `serial` varchar(11) NOT NULL,
  `exdate` varchar(50) NOT NULL,
  `measure` varchar(10) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `exdate2` varchar(50) NOT NULL,
  `prod_wprice` decimal(10,2) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_name`, `prod_desc`, `prod_price`, `prod_cprice`, `cat_id`, `prod_qty`, `reorder`, `serial`, `exdate`, `measure`, `prod_id`, `exdate2`, `prod_wprice`, `branch_id`) VALUES
('EVECARE  CAPS', '', '68.00', '51.84', 30, -278, 2, 'SKU1001', '2022-12-27', '100 CAPS', 1, '2022-11-26', '0.00', 0),
('LIV 52 CAPS', 'HIMALAYA', '60.00', '50.12', 30, -378, 4, 'SKU1002', '2024-01-01', '100 CAPS', 2, '', '0.00', 0),
('PILEX CAPS  -HIMALAYA', '', '55.00', '50.75', 30, 302, 0, 'SKU1003', '2024-11-01', '100 CAPS', 3, '', '0.00', 0),
('PYLIN CAPS', 'DR GOOD', '64.00', '44.00', 30, 0, 3, 'SKU1004', '2023-01-01', '100 CAPS', 4, '', '0.00', 0),
('TENOFOVIR CAPS 300mg', '', '118.00', '89.78', 30, 0, 1, 'SKU1005', '2024-01-01', '30 CAPS', 5, '', '0.00', 0),
('PILEX OINTMENT -  HIMALAYA', '', '48.00', '35.54', 30, 0, 1, 'SKU1006', '2024-12-01', '30g', 6, '', '0.00', 0),
('PHLEBODIA TABS- INNOTHERA', '', '115.00', '87.00', 30, 4, 1, 'SKU1007', '2026-09-01', '15 TABS', 7, '', '0.00', 0),
('COLDRILIF CAPS - ENTRANCE', '', '6.00', '4.25', 30, 11, 3, 'SKU1008', '2024-10-01', '10 TABS', 8, '', '0.00', 0),
('FLUREST TABS', 'LUEX', '24.00', '15.00', 30, 6, 7, 'SKU1009', '2023-04-01', '10 TABS', 9, '', '0.00', 0),
('CONGESTYL TABS', '', '9.00', '6.50', 30, 0, 10, 'SKU1010', '2023-12-01', '10', 10, '', '0.00', 0),
('COLD & CAT. TABS - STOPKOF ECL', '', '12.00', '8.96', 30, 19, 4, 'SKU1011', '2026-03-01', '12 TABS', 11, '', '0.00', 0),
('LEMSIP COLD & FLU. / sachet', '', '4.00', '3.00', 30, 6, 0, 'SKU1012', '2023-05-01', 'SACHET', 12, '', '0.00', 0),
('STREPSILS LOZENGES / tab', '', '2.00', '1.34', 30, 59, 12, 'SKU1013', '2023-11-01', '1TAB', 13, '', '0.00', 0),
('FISHERMAN FRIEND', 'LEUX', '10.00', '7.50', 30, 8, 3, 'SKU1014', '2023-09-01', '24 TABS', 14, '', '0.00', 0),
('DECATYLEN LOZENGES', 'ACINO', '1.00', '1.00', 25, 0, 10, 'SKU1015', '12024-05-01', '1', 15, '', '0.00', 0),
('SAMALIN / MALIN TABS', 'ALL', '3.50', '2.50', 30, 0, 5, 'SKU1016', '2024-01-01', 'PACK', 16, '', '0.00', 0),
('KLARO CARBXYMETHYL EYE DROPS', '', '7.00', '4.60', 30, 1, 1, 'SKU1017', '2023-03-01', '3 TABS', 17, '', '0.00', 0),
('CIPROLEX TZ LUEX', '', '40.00', '30.00', 30, 9, 3, 'SKU1018', '2023-02-01', '14 TABS', 18, '', '0.00', 0),
('ZYMAX 250  AZITHROMYCIN 250 tab -1x 6s', '', '12.00', '8.50', 30, 5, 5, 'SKU1019', '2024-11-01', '6 TABS', 19, '', '0.00', 0),
('AZITHROMYCIN TAB ZYMAX 500 - 1 x 3s', '', '20.00', '14.98', 30, 6, 3, 'SKU1020', '2024-01-01', '3 TABS', 20, '', '0.00', 0),
('SULPHUR OINTMENT', '', '12.00', '8.41', 30, 3, 1, 'SKU1021', '2023-01-01', '10 TABS', 21, '', '0.00', 0),
('CEFUROXIME TABLET ENACEF 250', '', '28.00', '19.98', 30, 5, 3, 'SKU1022', '2024-02-01', '10TABS', 22, '', '0.00', 0),
('CEFUROXIME TABLETS ENACEF 500', '', '44.00', '27.98', 30, 5, 3, 'SKU1023', '2024-07-01', '10TABS', 23, '', '0.00', 0),
('CEFIXIME  TAB PACK ENAFIX 200', '', '20.00', '13.98', 30, 6, 7, 'SKU1024', '2024-02-01', '10TABS', 24, '', '0.00', 0),
('CEFUROXIME PACK ZINNAT 500', '', '158.00', '135.02', 30, 1, 3, 'SKU1025', '2023-09-01', '10TABS', 25, '', '0.00', 0),
('CEFUROXIME 250 EXCINATE 250', '', '30.00', '22.98', 30, 2, 5, 'SKU1026', '2023-04-01', '10TABS', 26, '', '0.00', 0),
('AMARYL TABS 4MG', '', '210.00', '181.73', 30, 1, 0, 'SKU1027', '2024-02-01', '14 TABS', 27, '', '0.00', 0),
('COTTON BUNDLE 200G', '', '12.00', '7.00', 30, 0, 1, 'SKU1028', '2024-02-01', '10TABS', 28, '', '0.00', 0),
('LEK AMOKSIKLAV 625 TABS UK-', '', '58.00', '41.78', 30, 4, 2, 'SKU1029', '2023-10-10', '10 TABS', 29, '', '0.00', 0),
('AMOXICLAV 625MG AUGMENTIN', '', '210.00', '166.70', 25, 2, 1, 'SKU1030', '2024-12-01', '14 TABS', 30, '', '0.00', 0),
('DISPERSIBLE LONART TAB 20/120', '', '10.00', '6.00', 25, 12, 3, 'SKU1031', '2023-07-01', '14 TABS', 31, '', '0.00', 0),
('TAB 250 -  AZITHROMYCIN TAB - AZITEX', '', '16.00', '11.90', 30, 1, 1, 'SKU1032', '2024-05-01', '10', 32, '', '0.00', 0),
('EXETER DOXYCYCLINE CAPS per STRIP -', '', '18.00', '11.60', 30, 1, 5, 'SKU1033', '2024-03-01', '10', 33, '', '0.00', 0),
('ECL DOXYCYCLINE  ECL Local per STRIP -', '', '5.00', '3.45', 30, 85, 10, 'SKU1034', '2025-06-01', '10', 34, '', '0.00', 0),
('CLINDAMYCIN CAPS per CAPS - ENACIN', '', '1.50', '1.00', 30, 129, 50, 'SKU1035', '2022-11-01', '10', 35, '', '0.00', 0),
('LONART SUSPENSION', '', '19.00', '13.80', 30, 4, 1, 'SKU1036', '2023-10-01', '100ML', 36, '', '0.00', 0),
('LUFART SUSPENSION', '', '15.00', '10.50', 30, 0, 2, 'SKU1037', '2024-10-12', '100ML', 37, '', '0.00', 0),
('MALOFF FORTE Tab 1x6s', '', '10.00', '6.00', 30, 2, 2, 'SKU1038', '2023-03-01', '60ML', 38, '', '0.00', 0),
('MALAR 2 SUSPENSION', '', '14.00', '10.32', 30, 0, 5, 'SKU1039', '2024-03-01', '60', 39, '', '0.00', 0),
('ROOTER HERB. MIXTER', '', '10.00', '6.90', 26, 0, 4, 'SKU1040', '2024-06-02', '100', 40, '', '0.00', 0),
('TAABEA HERB. MIXTURE', '', '20.00', '15.00', 30, 2, 4, 'SKU1041', '2024-07-01', '700', 41, '', '0.00', 0),
('OSTEOCARE LIQIUD 200ML', '', '43.00', '31.92', 26, 0, 0, 'SKU1042', '2023-01-01', '500', 42, '', '0.00', 0),
('TINATETT VENECARE 750ML', '', '34.00', '24.14', 26, 0, 1, 'SKU1043', '2024-03-01', '200', 43, '', '0.00', 0),
('LIVING BITTERS TONIC', '', '20.00', '14.46', 30, 0, 4, 'SKU1044', '2023-01-01', '200', 44, '', '0.00', 0),
('LIVING BITTERS CAPS', '', '28.00', '20.70', 30, 1, 3, 'SKU1045', '2023-06-01', '20', 45, '', '0.00', 0),
('LAWSON HERBAL MIXTURE', '', '14.00', '9.20', 30, 0, 0, 'SKU1046', '2023-01-01', '100', 46, '', '0.00', 0),
('IMPRESSOR CAPS / OIL', '', '70.00', '54.00', 30, 7, 4, 'SKU1047', '2023-12-01', '30 CAPS', 47, '', '0.00', 0),
('BIO OIL 125ml -plain', '', '52.00', '38.60', 30, 0, 0, 'SKU1048', '2025-12-31', '70ML', 48, '', '0.00', 0),
('RAKSON CAPS', '', '5.00', '3.00', 30, 0, 5, 'SKU1049', '2024-12-01', '10', 49, '', '0.00', 0),
('ADOM KOO CAPS', '', '20.00', '15.50', 30, 0, 5, 'SKU1050', '2024-02-01', '30', 50, '', '0.00', 0),
('ECL PIRITON SYRUP - C PHENIRAMINE', '', '5.00', '3.20', 30, 8, 5, 'SKU1051', '2024-12-01', '100ML', 51, '', '0.00', 0),
('CONGESTYL SYRUP - MEYER', '', '23.00', '17.27', 30, 5, 2, 'SKU1052', '2025-06-01', '100ML', 52, '', '0.00', 0),
('HISTAZINE SYRUP', 'ECL', '7.00', '4.78', 30, 5, 3, 'SKU1053', '2023-02-01', '100ML', 53, '', '0.00', 0),
('SYRUP CETRIZINE 100ml  EXETER', '', '10.00', '6.77', 30, 3, 3, 'SKU1054', '2024-01-01', '100ML', 54, '', '0.00', 0),
('COLDRILIF SYRUP - ENTRANCE', '', '10.00', '6.91', 30, 7, 2, 'SKU1055', '2024-10-01', '100ML', 55, '', '0.00', 0),
('AMCOF  SYRUP 3+', '', '13.00', '9.70', 30, 7, 1, 'SKU1056', '2024-06-01', '100', 56, '', '0.00', 0),
('KOFOL SYRUP', '', '16.00', '12.00', 30, 19, 0, 'SKU1057', '2024-01-01', '100', 57, '', '0.00', 0),
('ACTIFIED 60MG- GSK', '', '25.00', '18.90', 30, 1, 1, 'SKU1058', '2024-04-01', '100', 58, '', '0.00', 0),
('HONEYKOF HERBAL SYRUP', '', '20.00', '14.98', 26, 6, 3, 'SKU1059', '2025-03-01', '100', 59, '', '0.00', 0),
('PACK NOVACIP Cipro 500', '', '5.00', '3.10', 30, 30, 5, 'SKU1060', '2026-03-01', '100', 60, '', '0.00', 0),
('SIMPLE / BABY  LINCTUS JUNIOR - ALL', '', '8.00', '5.98', 26, 4, 3, 'SKU1061', '2024-03-01', '100', 61, '', '0.00', 0),
('LUEX CHILDREN CHESTY COUGH SYRUP', '', '14.00', '9.90', 30, 8, 5, 'SKU1062', '2023-05-01', '100', 62, '', '0.00', 0),
('BELLS CHILDREN COUGH SYRUP', '', '22.00', '16.00', 30, 5, 2, 'SKU1063', '2024-02-01', '100', 63, '', '0.00', 0),
('BELLS BABY COUGH SYRUP', '', '22.00', '16.40', 26, 0, 2, 'SKU1064', '2023-03-01', '100', 64, '', '0.00', 0),
('TEETHING SYRUP ERNEST', '', '15.00', '10.76', 26, 9, 2, 'SKU1065', '2024-10-01', '100', 65, '', '0.00', 0),
('BELLS TEETHING MIXTURE', 'BELLS', '25.00', '18.30', 26, 0, 1, 'SKU1066', '2024-11-01', '100', 66, '', '0.00', 0),
('TEEDAR SYRUP', '', '15.00', '11.11', 26, 0, 1, 'SKU1067', '2025-06-01', '100', 67, '', '0.00', 0),
('CAFALGIN JNR SYRUP', '', '10.00', '6.95', 26, 0, 5, 'SKU1068', '2023-03-01', '100', 68, '', '0.00', 0),
('EFPAC JNR SYRUP', '', '10.00', '7.48', 30, 2, 2, 'SKU1069', '2024-03-01', '100', 69, '', '0.00', 0),
('COARTEM 40/80', '', '65.00', '49.98', 30, 0, 2, 'SKU1070', '2023-02-01', '6 TABS', 70, '', '0.00', 0),
('QUININE TABS per STRIP', '', '9.00', '6.50', 30, 5, 4, 'SKU1071', '2023-08-01', '100', 71, '', '0.00', 0),
('PANTOPRAZOLE 20MG - PRAZOLIN', '', '54.00', '39.00', 30, 4, 1, 'SKU1072', '2023-06-01', '10', 72, '', '0.00', 0),
('MALAR 2 FORTE TAB', '', '15.00', '10.80', 30, 30, 10, 'SKU1073', '2024-03-01', '10', 73, '', '0.00', 0),
('MALAR 2 DS TABLET', '', '22.00', '10.32', 30, 14, 5, 'SKU1074', '2024-03-01', '10', 74, '', '0.00', 0),
('NOVAMETHER FORTE per Pack', '', '12.00', '8.66', 30, 10, 10, 'SKU1075', '2023-05-01', '10', 75, '', '0.00', 0),
('P ALAXIN TAB', '', '20.00', '16.50', 30, 4, 5, 'SKU1076', '2024-01-01', '10', 76, '', '0.00', 0),
('LONART DS TAB', '', '28.00', '21.00', 30, 8, 7, 'SKU1077', '2024-03-01', '6', 77, '', '0.00', 0),
('LUFART DS', '', '20.00', '15.50', 30, 40, 4, 'SKU1078', '2025-02-01', '6', 78, '', '0.00', 0),
('NOVAMETHER 4X4 TAB', '', '7.00', '4.90', 30, 0, 2, 'SKU1079', '2023-11-01', '24', 79, '', '0.00', 0),
('4X4 LONART 4X4 Tablet', '', '12.00', '6.73', 25, 4, 0, 'SKU1080', '2024-02-01', '24', 80, '', '0.00', 0),
('LACLOSE SOLUTION 100ml', '', '40.00', '29.94', 30, 5, 2, 'SKU1081', '2024-08-01', '100', 81, '', '0.00', 0),
('MENOTA per TABLET', '', '2.00', '1.68', 30, 130, 1, 'SKU1082', '2025-05-01', '10', 82, '', '0.00', 0),
('CHOCHO CREAM / SOAP', '', '9.00', '6.50', 30, 10, 1, 'SKU1083', '2024-04-01', '10', 83, '', '0.00', 0),
('MYCOLEX POWDER - LUEX', '', '32.00', '23.00', 30, 6, 4, 'SKU1084', '2024-01-01', '100', 84, '', '0.00', 0),
('FLUCLO + AMOXI.SUSPENSON - Fluxamox', '', '15.00', '10.78', 30, 2, 2, 'SKU1085', '2023-12-01', '100', 85, '', '0.00', 0),
('SUSPENSION METROLEX F  - LUEX', '', '23.00', '16.95', 30, 0, 4, 'SKU1086', '2025-01-01', '100', 86, '', '0.00', 0),
('FUMET SUSPENSION', '', '6.00', '4.00', 30, 7, 2, 'SKU1087', '2023-08-01', '100', 87, '', '0.00', 0),
('METRO Z SUSPENSION', '', '15.00', '10.40', 30, 62, 1, 'SKU1088', '2024-10-01', '10', 88, '', '0.00', 0),
('Metronidazole Suspension -METAGYL SUSPENSION', '', '9.00', '6.87', 30, 5, 5, 'SKU1089', '2024-02-01', '100', 89, '', '0.00', 0),
('FLUCLOXACILLIN SUSP - LEPTAB', '', '5.00', '2.59', 30, 0, 5, 'SKU1090', '2023-10-01', '100', 90, '', '0.00', 0),
('LUEX BABY COUGH 150ml', '', '22.00', '15.69', 30, 1000, 0, 'SKU1091', '2023-09-01', '100', 91, '', '0.00', 0),
('FLUCLOXACILLIN SUSPENSION - FLUXACIN 125', '', '12.00', '7.80', 30, 7, 5, 'SKU1092', '2023-10-01', '100', 92, '', '0.00', 0),
('ANTACID MIXTURE 200ML BELLS', '', '22.00', '14.20', 30, 2, 2, 'SKU1093', '2024-09-01', '100', 93, '', '0.00', 0),
('AMOXICILLIN SUSPENSION -PERMOXYL 125', '', '9.00', '6.98', 30, 8, 5, 'SKU1094', '2024-04-01', '100', 94, '', '0.00', 0),
('LEPTAB AMOXICILLIN SUSPENSION', '', '5.00', '2.85', 30, 0, 3, 'SKU1095', '2024-04-01', '100', 95, '', '0.00', 0),
('CEFUROXIME SUSPENSION - ENACEF 125', '', '20.00', '14.38', 30, 3, 3, 'SKU1096', '2024-02-01', '100', 96, '', '0.00', 0),
('SUSPENSION AMOXICILLIN - EXETER', '', '10.00', '5.98', 30, 1, 5, 'SKU1097', '2023-01-20', '100', 97, '', '0.00', 0),
('ERYTHROMYCIN SUSPENSION -ENAMYCIN 125', '', '12.00', '8.16', 30, 3, 0, 'SKU1098', '2024-02-01', '100', 98, '', '0.00', 0),
('CO TRIMOXAZOLE SEPTRIN SUSPENSON - LEPTAB', '', '4.00', '2.25', 30, 6, 2, 'SKU1099', '2024-05-01', '100', 99, '', '0.00', 0),
('EXETER CLINDAMYCIN CAPS 300 - per CAPSULE', '', '1.80', '1.10', 30, 42, 20, 'SKU1100', '2024-02-01', '100', 100, '', '0.00', 0),
('INFA V OINTMENT', '', '23.00', '17.00', 30, 0, 0, 'SKU1101', '2023-11-01', '100', 101, '', '0.00', 0),
('AMOKSIKLAV 457 SUSPENSION - UK', '', '34.00', '25.90', 30, 0, 1, 'SKU1102', '2022-11-02', '100', 102, '', '0.00', 0),
('AZITHROMYCIN SUSPENSION -ZYMAX SUSPENSION', '', '14.00', '8.89', 30, 2, 5, 'SKU1103', '2024-01-01', '100', 103, '', '0.00', 0),
('SUSP AZITHROMYCIN - AZITEX', '', '18.00', '10.80', 30, 3, 2, 'SKU1104', '2024-08-01', '100', 104, '', '0.00', 0),
('PARA Exeter 500 TAB', 'EXETER', '3.00', '2.20', 30, 107, 10, 'SKU1105', '2026-03-01', '500', 105, '', '0.00', 0),
('PANADOL ADVANCE TABLET', '', '10.00', '7.21', 30, 0, 3, 'SKU1106', '2024-05-01', '500', 106, '', '0.00', 0),
('PANADOL EXTRA ADVANCE per PACK', '', '30.00', '19.80', 30, 0, 4, 'SKU1107', '2024-08-01', '100', 107, '', '0.00', 0),
('PANACIN TABLET per STRIP', '', '1.50', '0.85', 30, 5, 10, 'SKU1108', '2025-04-01', '100', 108, '', '0.00', 0),
('TRAMADOL CAPSULE  per BLISTER - HOVID', '', '15.00', '10.00', 30, 40, 5, 'SKU1109', '2024-08-01', '100', 109, '', '0.00', 0),
('DORETA CAPSULE per CAP', '', '4.00', '2.80', 30, 0, 10, 'SKU1110', '2023-07-01', '100', 110, '', '0.00', 0),
('TREXAMOL CAPSULE per CAP', '', '2.50', '1.76', 30, 0, 12, 'SKU1111', '2024-04-01', '100', 111, '', '0.00', 0),
('EZIPEN TABLET', '', '5.00', '3.56', 30, 30, 5, 'SKU1112', '2024-12-01', '100', 112, '', '0.00', 0),
('ZULU 100 TABLET', '', '6.00', '4.57', 30, 7, 5, 'SKU1113', '2025-01-01', '5.00', 113, '', '0.00', 0),
('TCP LIQUID 50ML  S/S', '', '38.00', '27.98', 30, 1, 0, 'SKU1114', '2023-02-01', '100', 114, '', '0.00', 0),
('GEBEDOL PLUS + TABLET', '', '2.50', '1.50', 30, 0, 2, 'SKU1115', '2024-01-02', '100', 115, '', '0.00', 0),
('LIQUID PARAFIN', '', '12.00', '7.85', 26, 2, 4, 'SKU1116', '2025-08-01', '100', 116, '', '0.00', 0),
('METHYLATED SPIRIT 125ml - ECL BOTTLE', '', '8.00', '5.79', 30, 0, 3, 'SKU1117', '2024-10-01', '100', 117, '', '0.00', 0),
('METHYLATED SPIRIT S/S - SMALL BOTTLE', '', '3.00', '2.07', 30, 10, 0, 'SKU1118', '2023-12-01', '10', 118, '', '0.00', 0),
('GENTION VIOLET - GV PAINT', '', '3.00', '2.07', 30, 10, 7, 'SKU1119', '2023-03-01', '100', 119, '', '0.00', 0),
('BORGES OLIVE OIL 125ML', '', '21.00', '15.54', 33, 5, 2, 'SKU1120', '2024-10-01', '100', 120, '', '0.00', 0),
('BELLS OLIVE OIL', '', '19.00', '13.90', 30, 2, 4, 'SKU1121', '2024-12-01', '100', 121, '', '0.00', 0),
('OMEGA OIL', 'OMEGA 50ml', '13.00', '8.50', 30, 1, 4, 'SKU1122', '2025-12-01', '100', 122, '', '0.00', 0),
('BIO OIL SKINCARE', 'BIO 60ml', '22.00', '16.10', 30, 0, 3, 'SKU1123', '2025-02-01', '100', 123, '', '0.00', 0),
('WISDOM MOUTHWASH', 'WISDOM', '20.00', '14.98', 30, 3, 2, 'SKU1124', '2024-03-01', '100', 124, '', '0.00', 0),
('NESTER MOUTHWASH', '', '15.00', '10.89', 30, 0, 4, 'SKU1125', '2023-04-01', '100', 125, '', '0.00', 0),
('KAMACLOX MOUTHWASH', '', '13.00', '9.00', 30, 2, 1, 'SKU1126', '2024-11-01', '100', 126, '', '0.00', 0),
('HYDRO. PEROXIDE ECL 200ml', 'ECL BOTTLE', '10.00', '6.63', 30, 2, 2, 'SKU1127', '2024-01-01', '100', 127, '', '0.00', 0),
('HYDRO. PEROXIDE Plastic bottle', '', '7.00', '4.20', 30, 4, 2, 'SKU1128', '2025-09-01', '100', 128, '', '0.00', 0),
('MIST. POTASSIUM. CIT - MIST POT CIT', '', '4.00', '3.00', 30, 5, 0, 'SKU1129', '2023-06-01', '100', 129, '', '0.00', 0),
('MAGNESSIUM TRISC. - MGT', '', '5.00', '3.50', 30, 5, 3, 'SKU1130', '2025-02-01', '100', 130, '', '0.00', 0),
('MILK OF MAGNESSIA', 'MILK', '3.00', '1.40', 30, 0, 5, 'SKU1131', '2023-04-01', '100', 131, '', '0.00', 0),
('AMPICLOX CAPS per STRIP', 'LEPTAB', '4.50', '3.37', 30, 4, 5, 'SKU1132', '2023-05-02', '100', 132, '', '0.00', 0),
('CHLORDIAZEPOXIDE CAPS -  LIBRIUM LEPTAB', '', '2.00', '1.38', 30, 21, 10, 'SKU1133', '2023-10-01', '100', 133, '', '0.00', 0),
('INDOMETHAZINE -  INDOCID Leptab', '', '1.00', '0.40', 30, 46, 10, 'SKU1134', '2023-11-01', '100', 134, '', '0.00', 0),
('AKOMA  APC', '', '1.00', '0.50', 30, 34, 15, 'SKU1135', '2023-01-01', '100', 135, '', '0.00', 0),
('BISACODYL TABS', '', '1.00', '0.35', 30, 95, 10, 'SKU1136', '2026-06-05', '100', 136, '', '0.00', 0),
('PENICILLIN V TABS', '', '2.00', '0.86', 30, 28, 20, 'SKU1137', '2024-01-01', '100', 137, '', '0.00', 0),
('IBUPROFEN 200 TABS Eskay', '', '1.00', '0.51', 30, 50, 7, 'SKU1138', '2025-01-20', '100', 138, '', '0.00', 0),
('IBUPROFEN TAB 400mg -ENAFEN', '', '2.50', '1.80', 30, 38, 15, 'SKU1139', '2024-09-01', '100', 139, '', '0.00', 0),
('DICLOFENAC 75MG CAPS per STRIP - NAKLOFEN DUO', '', '30.00', '22.00', 30, 2, 2, 'SKU1140', '2024-05-01', '100', 140, '', '0.00', 0),
('DICLOFENAC CHOLESTR. FLOTAC 75', '', '75.00', '53.40', 30, 1, 3, 'SKU1141', '2023-05-01', '100', 141, '', '0.00', 0),
('DICLOFENAC 100 per TAB -  VOLTAREN RETARD', '', '2.50', '1.88', 30, 34, 25, 'SKU1142', '2023-03-01', '100', 142, '', '0.00', 0),
('CELECOXIB 200 - CELEBREX', '', '115.00', '90.00', 30, 0, 1, 'SKU1143', '2023-11-01', '200', 143, '', '0.00', 0),
('CELECOXIB TAB 200 per STRIP - ALL', '', '13.00', '8.73', 30, 24, 6, 'SKU1144', '2025-12-01', '200', 144, '', '0.00', 0),
('GOFEX - IBUPROFEN 400 CAPS', '', '14.00', '10.43', 30, 20, 10, 'SKU1145', '2024-03-01', '400', 145, '', '0.00', 0),
('PIROXICAM CAPS per PACK -OXAFEN', '', '2.50', '1.20', 30, 30, 10, 'SKU1146', '2024-03-01', '100', 146, '', '0.00', 0),
('RONFIT FORTE', '', '6.00', '4.38', 30, 5, 3, 'SKU1147', '2025-03-01', '100', 147, '', '0.00', 0),
('ESKYZOLE CREAM 30g', '', '10.00', '6.11', 30, 4, 2, 'SKU1148', '2024-12-01', '100', 148, '', '0.00', 0),
('KEFEN EXTRA per PACK', '', '4.50', '2.98', 30, 0, 7, 'SKU1149', '2023-04-01', '100', 149, '', '0.00', 0),
('TOBTABS per PACK', '', '4.00', '2.75', 30, 36, 10, 'SKU1150', '2026-06-01', '100', 150, '', '0.00', 0),
('ASPIMANOL TABS', '', '1.00', '0.40', 30, 5, 5, 'SKU1151', '2023-11-01', '10', 151, '', '0.00', 0),
('NEXCOFER CAPS per PACK - ECL', '', '10.00', '7.18', 30, 10, 1, 'SKU1152', '2025-03-01', '100', 152, '', '0.00', 0),
('3FER SYRUP', '', '7.00', '4.60', 30, 0, 2, 'SKU1153', '2024-04-01', '100', 153, '', '0.00', 0),
('NEXCOFER TONIC 200', 'ECL', '16.00', '11.96', 30, 5, 4, 'SKU1154', '2025-08-01', '120', 154, '', '0.00', 0),
('FERUM SYRUP', '', '8.00', '5.00', 30, 0, 4, 'SKU1155', '2024-02-01', '100', 155, '', '0.00', 0),
('ATROPINE', '', '4.50', '3.00', 30, 6, 1, 'SKU1156', '2022-09-01', '100', 156, '', '0.00', 0),
('XFERON SYRUP 200ML', '', '12.00', '7.56', 30, 0, 4, 'SKU1157', '2023-02-02', '100', 157, '', '0.00', 0),
('CAPS SEVEN SEAS ( COD LIVER + OMEGA ) CAPSULE', '', '78.00', '60.73', 30, 1, 1, 'SKU1158', '2023-03-01', '100', 158, '', '0.00', 0),
('ZINCOFER TONIC 200ML', '', '32.00', '23.96', 30, 7, 2, 'SKU1159', '2024-01-01', '100', 159, '', '0.00', 0),
('CAPS POLYFER CAPS', '', '10.00', '6.50', 30, 8, 4, 'SKU1160', '2024-07-01', '100', 160, '', '0.00', 0),
('BECOACTIN SYRUP', '', '19.00', '14.42', 30, 6, 2, 'SKU1161', '2024-11-01', '100', 161, '', '0.00', 0),
('FEROGLOBIN SYRUP', '', '68.00', '52.00', 30, 0, 2, 'SKU1162', '2024-01-01', '200', 162, '', '0.00', 0),
('FOLIGROW SYRUP 200ML', '', '30.00', '20.02', 30, 4, 5, 'SKU1163', '2023-03-01', '200', 163, '', '0.00', 0),
('DYNWELL SYRUP', '', '7.00', '4.90', 30, 3, 3, 'SKU1164', '2024-05-01', '100', 164, '', '0.00', 0),
('TALAGENTIS 5MG per STRIP', '', '15.00', '10.00', 30, 94, 1, 'SKU1165', '2024-08-01', '100', 165, '', '0.00', 0),
('APETAMINE SYRUP', '', '37.00', '27.84', 30, 4, 2, 'SKU1166', '2023-12-01', '100', 166, '', '0.00', 0),
('TRES ORIX 250ML', '', '34.00', '22.90', 30, 4, 4, 'SKU1167', '2025-01-01', '100', 167, '', '0.00', 0),
('ABYTONE SYRUP', '', '12.00', '7.48', 30, 0, 4, 'SKU1168', '2023-01-01', '100', 168, '', '0.00', 0),
('GUDAPET SYRUP / TABLET', '', '14.00', '10.50', 30, 15, 4, 'SKU1169', '2024-11-01', '100', 169, '', '0.00', 0),
('LEENA SYRUP', '', '12.00', '7.61', 30, 0, 4, 'SKU1170', '2023-06-01', '100', 170, '', '0.00', 0),
('MARK 2 INHALER', '', '10.00', '7.25', 30, 10, 2, 'SKU1171', '2024-04-01', '10', 171, '', '0.00', 0),
('ASTYMIN SYRUP', '', '32.00', '23.54', 30, 4, 3, 'SKU1172', '2023-07-01', '100', 172, '', '0.00', 0),
('CYFEN SYRUP', '', '14.00', '9.30', 30, 0, 4, 'SKU1173', '2022-11-01', '100', 173, '', '0.00', 0),
('ZINCOVIT SYRUP  200ML', '', '30.00', '21.63', 30, 7, 1, 'SKU1174', '2024-03-01', '200', 174, '', '0.00', 0),
('ZINCOVIT DROPS', '', '12.00', '8.56', 30, 2, 3, 'SKU1175', '2023-04-01', '90', 175, '', '0.00', 0),
('ZINVITE SYRUP - ENTRANCE', '', '15.00', '8.45', 30, 0, 5, 'SKU1176', '2023-07-01', '100', 176, '', '0.00', 0),
('KIDIVITE SYRUP 200ML -12 NUTRIENTS', '', '14.00', '7.59', 30, 2, 4, 'SKU1177', '2025-01-01', '100', 177, '', '0.00', 0),
('PROKID MULTIVIT DROPS', '', '10.00', '7.28', 30, 0, 4, 'SKU1178', '2022-08-01', '100', 178, '', '0.00', 0),
('KIDIVITE  DROPS 25ML', '', '18.00', '13.44', 30, 2, 2, 'SKU1179', '2023-03-01', '100', 179, '', '0.00', 0),
('FEROGLOBIN CAPS', '', '50.00', '38.03', 30, 0, 0, 'SKU1180', '2024-02-01', '100', 180, '', '0.00', 0),
('HEMOSOFT CAPS', '', '32.00', '23.00', 30, 2, 5, 'SKU1181', '2024-04-01', '100', 181, '', '0.00', 0),
('APEX ZINCOVIT CAPSULES', '', '40.00', '29.75', 30, 5, 4, 'SKU1182', '2023-09-01', '100', 182, '', '0.00', 0),
('REDSUN CAPSULES PACK', '', '15.00', '9.68', 30, 0, 0, 'SKU1183', '2024-06-01', '100', 183, '', '0.00', 0),
('ZINVITE CAPS per STRIP - ENTRANCE', '', '10.00', '4.57', 30, 7, 5, 'SKU1184', '2023-03-01', '100', 184, '', '0.00', 0),
('CYPRODINE CAPS / SYRUP', '', '44.00', '32.80', 30, 8, 2, 'SKU1185', '2025-02-01', '30', 185, '', '0.00', 0),
('PARA LEPTAB / ZINOL   500mg tablet', '', '1.00', '0.68', 30, 51, 4, 'SKU1186', '2024-08-01', '30', 186, '', '0.00', 0),
('GLUCOLIFE C - ECL', '', '20.00', '15.00', 30, 3, 0, 'SKU1187', '2024-02-01', '100', 187, '', '0.00', 0),
('LEENA CAPSULES', '', '5.00', '3.50', 30, 0, 1, 'SKU1188', '2024-05-01', '100', 188, '', '0.00', 0),
('PERMOXYL AMOXICILLIN 500 CAPS per Blister', '', '6.00', '4.04', 30, 36, 10, 'SKU1189', '2024-05-01', '100', 189, '', '0.00', 0),
('AMOXICILLIN 250  Blister - MAXMOX 250 / LEPTAB 250', '', '2.50', '1.55', 30, 67, 12, 'SKU1190', '2024-03-01', '100', 190, '', '0.00', 0),
('AMOXIC.+ FLUCLO CAPS - FLUXAMOX 500', '', '10.00', '7.98', 30, 32, 5, 'SKU1191', '2024-06-01', '100', 191, '', '0.00', 0),
('ERYTHROMYCIN 250 TABLETS', 'ENAMYCIN 250', '5.00', '2.80', 30, 34, 10, 'SKU1192', '2023-04-01', '10', 192, '', '0.00', 0),
('CAPS FLUCLOXACILLIN - FLUXACIN 500', '', '10.00', '7.04', 30, 22, 12, 'SKU1193', '2024-01-01', '10', 193, '', '0.00', 0),
('28s FLUCLOXACILLIN 500 PACK - EXETER', '', '16.00', '9.89', 30, 0, 4, 'SKU1194', '2023-04-01', '100', 194, '', '0.00', 0),
('LEVOFLOXACIN 500 CAPS - EXETER& MSN', '', '34.00', '25.89', 30, 7, 3, 'SKU1195', '2025-03-01', '10', 195, '', '0.00', 0),
('FLUCLOX 250 - local', '', '3.50', '2.65', 30, 38, 10, 'SKU1196', '2023-06-01', '100', 196, '', '0.00', 0),
('CLARITHROMYCIN 500 per TAB - B CLAR', '', '1.80', '1.50', 30, 0, 20, 'SKU1197', '2022-07-01', '10', 197, '', '0.00', 0),
('CLARITHROMYCIN 500 per PACK - EXETER', '', '59.00', '43.98', 30, 2, 2, 'SKU1198', '2024-07-01', '10', 198, '', '0.00', 0),
('TOBREX EYE DROPS - TOBRAMYCIN 0.3%', '', '30.00', '22.29', 30, 0, 1, 'SKU1199', '2023-12-01', '10', 199, '', '0.00', 0),
('OLFEN GEL 20g', '', '34.00', '25.00', 30, 3, 0, 'SKU1200', '2024-08-01', '10', 200, '', '0.00', 0),
('CIPRO 500 per Blister ALL', '', '4.00', '3.28', 30, 21, 30, 'SKU1201', '2024-02-01', '10', 201, '', '0.00', 0),
('CIPRO + TINEDAZOLE - CIFLOX T', '', '10.00', '7.20', 30, 6, 7, 'SKU1202', '2024-02-01', '10', 202, '', '0.00', 0),
('Cap TETRACYLINE CAPS - LEPTAB', '', '2.00', '0.90', 30, 41, 25, 'SKU1203', '2023-10-01', '10', 203, '', '0.00', 0),
('CHLOROPHENICOL CAPS', '', '3.50', '2.24', 30, 0, 20, 'SKU1204', '2024-02-01', '10', 204, '', '0.00', 0),
('AMOXICILLIN 500 per PACK - EXETER', '', '19.00', '13.98', 30, 23, 4, 'SKU1205', '2025-05-01', '10', 205, '', '0.00', 0),
('MAXMOX 500 PACK', '', '10.00', '7.20', 30, 10, 0, 'SKU1206', '2025-04-01', '10', 206, '', '0.00', 0),
('NOSPA 40MG per STRIP', '', '10.00', '7.50', 30, 25, 6, 'SKU1207', '2023-10-01', '10', 207, '', '0.00', 0),
('BUSCOPAM TAB', '', '8.00', '5.58', 30, 48, 15, 'SKU1208', '2025-06-01', '10', 208, '', '0.00', 0),
('METOCLOPRAMIDE 10MG - BLISTER', '', '1.50', '0.89', 30, 29, 15, 'SKU1209', '2024-07-01', '10', 209, '', '0.00', 0),
('CETRIZINE TAB per Blister -EXETER', '', '4.50', '3.18', 30, 23, 2, 'SKU1210', '2025-03-01', '10', 210, '', '0.00', 0),
('STUGERON  TABS per STRIP', '', '8.50', '6.10', 30, 5, 5, 'SKU1211', '2024-05-01', '10', 211, '', '0.00', 0),
('ZYFEN TABLETS', '', '20.00', '15.00', 30, 4, 2, 'SKU1212', '2024-09-01', '10', 212, '', '0.00', 0),
('TAB RHIZINE / CETRIZINE / HISTAZINE / PIRITON', '', '1.00', '0.50', 30, 143, 20, 'SKU1213', '2023-04-01', '110', 213, '', '0.00', 0),
('NEUTROSEC AMINO ACIDS + VIT SYRUP', '', '40.00', '25.00', 30, 2, 0, 'SKU1214', '2022-12-01', '10', 214, '', '0.00', 0),
('ZINC TABLETS 10/20MG', '', '1.00', '0.31', 30, 22, 10, 'SKU1215', '2024-03-01', '10', 215, '', '0.00', 0),
('VISCOF SYRUP - ALL BRANDS', '', '23.00', '17.98', 30, 14, 3, 'SKU1216', '2023-02-01', '1', 216, '', '0.00', 0),
('6\'\' GAUZE BANDAGE L/S - 6\'\'', '', '3.00', '1.80', 30, 53, 3, 'SKU1217', '2024-02-01', '10', 217, '', '0.00', 0),
('HOT WATER BOTTLE 1Ltr', '', '20.00', '12.98', 30, 5, 0, 'SKU1218', '2025-02-01', '10', 218, '', '0.00', 0),
('ZUBES COUGH SYRUP', '', '22.00', '16.00', 30, 0, 4, 'SKU1219', '2025-02-01', '10', 219, '', '0.00', 0),
('RIDDLES COUGH SYRUP', '', '8.00', '5.72', 30, 0, 3, 'SKU1220', '2024-08-01', '10', 220, '', '0.00', 0),
('SAMALIN NON DROWZY', '', '8.00', '5.60', 30, 0, 4, 'SKU1221', '2023-01-01', '100', 221, '', '0.00', 0),
('SAMALIN ADULT & JNR SYRUP', '', '12.00', '8.20', 30, 5, 8, 'SKU1222', '2025-05-01', '10', 222, '', '0.00', 0),
('STOPKOF SYRUPS - ALL ADULT / CHILD', '', '12.00', '8.50', 30, 6, 3, 'SKU1223', '2024-10-01', '10', 223, '', '0.00', 0),
('STOPKOF COLD & CATTARRH SYRUP', '', '8.00', '5.98', 30, 0, 4, 'SKU1224', '2024-07-01', '10', 224, '', '0.00', 0),
('STOPKOF EXPECTORANT - ECL', '', '8.00', '3.98', 30, 0, 0, 'SKU1225', '2023-01-01', '10', 225, '', '0.00', 0),
('ZECARB CARBOCIST 2% / 5%  ADULT & JNR', '', '8.00', '4.55', 30, 0, 4, 'SKU1226', '2023-01-01', '10', 226, '', '0.00', 0),
('AMINO PEP FORTE', '', '28.00', '19.35', 26, 3, 0, 'SKU1227', '2023-06-01', '100', 227, '', '0.00', 0),
('VIKIL 20 SYRUP', '', '38.00', '26.00', 30, 2, 4, 'SKU1228', '2024-09-01', '100', 228, '', '0.00', 0),
('VITAMIN B COMPLEX SYRUP', '', '7.00', '5.16', 30, 3, 4, 'SKU1229', '2024-01-01', '100', 229, '', '0.00', 0),
('BIO OIL NATURAL 125ML', '', '75.00', '57.60', 30, 3, 0, 'SKU1230', '2024-09-01', '10', 230, '', '0.00', 0),
('BELLS VITAMIN C SYRUP - BELLS', '', '20.00', '14.80', 30, 0, 1, 'SKU1231', '2023-08-01', '10', 231, '', '0.00', 0),
('PHARMADERM HERBAL SOAP', '', '20.00', '13.50', 30, 1, 1, 'SKU1232', '2024-02-04', '10', 232, '', '0.00', 0),
('WELLBABY DROPS - VITABIOTICS', '', '68.00', '49.96', 30, 0, 1, 'SKU1233', '2023-01-01', '10', 233, '', '0.00', 0),
('WELLBABY MULTIVITAMINE - VITABIOTICS', '', '80.00', '56.30', 30, 0, 2, 'SKU1234', '2023-02-01', '100', 234, '', '0.00', 0),
('WELLKID MULTIVITAMINE - VITABIOTICS', '', '82.00', '57.90', 30, 0, 2, 'SKU1235', '2022-06-01', '10', 235, '', '0.00', 0),
('SIMPLE LINCTUS BABY', '', '7.00', '5.25', 30, 0, 0, 'SKU1236', '2024-11-01', '10', 236, '', '0.00', 0),
('OMEPRAZOLE  20MG per PACK - OMPRA 20', '', '10.00', '5.38', 30, 2, 5, 'SKU1237', '2025-02-01', '10', 237, '', '0.00', 0),
('OMEPRAZOLE 20mg per Strip / HYCID PACK', '', '4.00', '2.30', 30, 39, 0, 'SKU1238', '2025-03-01', '10', 238, '', '0.00', 0),
('MUPIROCIN 2% OINTMENT', '', '34.00', '22.87', 30, 1, 1, 'SKU1239', '2023-05-01', '10', 239, '', '0.00', 0),
('NEXIUM 40MG per TAB', '', '14.00', '10.00', 30, 14, 4, 'SKU1240', '2024-09-01', '10', 240, '', '0.00', 0),
('20mg NEXIUM  20MG per TAB', '', '10.00', '7.57', 30, 14, 5, 'SKU1241', '2023-06-01', '10', 241, '', '0.00', 0),
('EXETER OMEPRAZOLE 20MG PACK - OMEXET', '', '18.00', '11.98', 30, 0, 4, 'SKU1242', '2023-11-01', '10', 242, '', '0.00', 0),
('OMESHAL D TABLETS', '', '10.00', '7.40', 30, 1, 4, 'SKU1243', '2023-01-01', '10', 243, '', '0.00', 0),
('METRO Z TAB per PACK', '', '8.00', '5.40', 30, 2, 4, 'SKU1244', '2025-11-01', '10', 244, '', '0.00', 0),
('Metronidazole 400  per Blister METAGYL & NOVAGYL', '', '2.00', '1.11', 30, 0, 15, 'SKU1245', '2024-03-01', '100', 245, '', '0.00', 0),
('METRO PACK 400 EXETER per PACK', '', '14.00', '9.11', 30, 17, 10, 'SKU1246', '2026-02-01', '10', 246, '', '0.00', 0),
('Metronidazole 200 per Blister METAGYL & NOVAGYL', '', '1.50', '0.92', 30, 49, 15, 'SKU1247', '2025-03-01', '100', 247, '', '0.00', 0),
('LOPERAMIDE CAPS -CLODIUM & STARDIUM', '', '2.00', '0.90', 30, 49, 5, 'SKU1248', '2024-01-01', '10', 248, '', '0.00', 0),
('METROLEX F TAB per PACK - LUEX', '', '16.00', '12.00', 30, 6, 4, 'SKU1249', '2023-01-03', '100', 249, '', '0.00', 0),
('SEPTRIN TABLET LEPTAB', '', '1.50', '1.08', 30, 74, 25, 'SKU1250', '2024-05-01', '10', 250, '', '0.00', 0),
('B CO TABLET MULTIVIT', 'BCO TAB', '0.50', '0.20', 30, 58, 20, 'SKU1251', '2024-10-01', '100', 251, '', '0.00', 0),
('MULTIVITAMIMNE TABLETS - LEPTAB', '', '0.50', '0.23', 30, 127, 25, 'SKU1252', '2024-08-01', '10', 252, '', '0.00', 0),
('FOLIC  ACID 5mg Blister ALL', '', '1.00', '0.56', 30, 68, 20, 'SKU1253', '2025-05-01', '10', 253, '', '0.00', 0),
('NOVAMENTIN 1G', '', '30.00', '18.20', 30, 7, 2, 'SKU1254', '2023-02-01', '10', 254, '', '0.00', 0),
('PROMETHAZINE TABLET', '', '1.00', '0.72', 30, 0, 20, 'SKU1255', '2024-01-01', '10', 255, '', '0.00', 0),
('DYNWELL TABLETS', '', '1.00', '0.38', 30, 31, 20, 'SKU1256', '2024-02-01', '10', 256, '', '0.00', 0),
('CYPRONE / LEENA / ABYTONE TAB per PACK', '', '4.00', '1.87', 30, 5, 4, 'SKU1257', '2022-11-01', '10', 257, '', '0.00', 0),
('FERROUS SULPHATE per PACK EXETER', '', '7.00', '4.89', 30, 0, 5, 'SKU1258', '2022-12-01', '102', 258, '', '0.00', 0),
('FERROUS SULPHATE per Blister - LOCAL', '', '1.00', '0.49', 30, 62, 15, 'SKU1259', '2026-03-01', '10', 259, '', '0.00', 0),
('ACCORD FOLIC ACID 5MG - PACK', '', '14.00', '7.97', 30, 8, 2, 'SKU1260', '2025-03-01', '10', 260, '', '0.00', 0),
('FOLIC ACID. 5MG CRESENT PACK', '', '10.00', '6.00', 30, 0, 5, 'SKU1261', '2023-09-01', '10', 261, '', '0.00', 0),
('IV AMOXICLAV 1.2g - CLAVUNOVA', '', '14.00', '10.50', 30, 3, 3, 'SKU1262', '2023-06-01', '100', 262, '', '0.00', 0),
('SELEVITE CAPS - CONTAINER', '', '35.00', '25.30', 30, 3, 3, 'SKU1263', '2023-09-01', '100', 263, '', '0.00', 0),
('GUTT PREDNISOLINE DROPS - PHARMANOVA', '', '45.00', '31.72', 30, 4, 0, 'SKU1264', '2023-07-12', '10', 264, '', '0.00', 0),
('THIAMINE CAPS SUPPLEMENT', '', '38.00', '28.00', 30, 1, 12, 'SKU1265', '2023-11-01', '100', 265, '', '0.00', 0),
('SEVEN  SEAS ( COD LIVER + OMEGA OIL )', '', '40.00', '27.00', 30, 1, 1, 'SKU1266', '2023-03-01', '10', 266, '', '0.00', 0),
('60s FOLIC  ACID CONTAINER - EXETER & BASIC NUTRIT', '', '15.00', '9.80', 30, 0, 4, 'SKU1267', '2023-08-01', '10', 267, '', '0.00', 0),
('90s VALUPAK FOLIC  ACID', '', '21.00', '15.50', 30, 0, 2, 'SKU1268', '2024-03-03', '10', 268, '', '0.00', 0),
('OMEGA 369  CAPS - ALL', '', '20.00', '15.33', 30, 1, 2, 'SKU1269', '2023-01-01', '10', 269, '', '0.00', 0),
('COD LIVER OIL 550 & 1000MG', '', '22.00', '15.68', 30, 8, 4, 'SKU1270', '2024-01-01', '100', 270, '', '0.00', 0),
('ODOURLESS GARLIC  CAPS - ZANZA', '', '12.00', '8.29', 30, 2, 2, 'SKU1271', '2025-11-01', '10', 271, '', '0.00', 0),
('PREDNISOLINE LEPTAB 5MG local', '', '1.00', '0.84', 30, 29, 10, 'SKU1272', '2024-10-01', '10', 272, '', '0.00', 0),
('MENTHODEX SYRUP 100ML', '', '20.00', '13.50', 30, 4, 3, 'SKU1273', '2025-02-01', '100', 273, '', '0.00', 0),
('MENTHODEX SYRUP 200ML', '', '35.00', '26.40', 30, 6, 2, 'SKU1274', '2024-05-01', '100', 274, '', '0.00', 0),
('ROBB ORIGINAL CONTAINER', '', '6.00', '4.50', 30, 0, 2, 'SKU1275', '2024-01-01', '100', 275, '', '0.00', 0),
('DIPHEX COUGH SYRUP', '', '12.00', '7.97', 30, 0, 2, 'SKU1276', '2024-03-01', '100', 276, '', '0.00', 0),
('KOFLET COUGH SYRUP - HIMALAYA', '', '26.00', '19.00', 30, 4, 2, 'SKU1277', '2024-12-01', '100', 277, '', '0.00', 0),
('BONNISAN', '', '23.00', '17.20', 30, 7, 4, 'SKU1278', '2024-08-01', '410', 278, '', '0.00', 0),
('AUNTIE MARY GRIPE WATER', '', '15.00', '10.89', 30, 10, 4, 'SKU1279', '2025-03-01', '100', 279, '', '0.00', 0),
('MOTHERCARE GRIPE WATER - EXETER', '', '18.00', '12.98', 30, 5, 1, 'SKU1280', '2024-05-01', '10', 280, '', '0.00', 0),
('MEBENDAZOLE 500MG -  VERMOX TAB', '', '15.00', '10.70', 30, 18, 5, 'SKU1281', '2024-04-01', '400', 281, '', '0.00', 0),
('ALBENDAZOLE 400MG - WORMPLEX', '', '10.00', '7.58', 30, 6, 2, 'SKU1282', '2025-11-01', '1', 282, '', '0.00', 0),
('WORMBAT SUSPENSION', '', '6.00', '4.00', 30, 0, 0, 'SKU1283', '2024-08-01', '2', 283, '', '0.00', 0),
('ALBENDAZOLE 200MG - ZENTEL TAB', '', '14.00', '10.48', 30, 0, 5, 'SKU1284', '2026-03-01', '2', 284, '', '0.00', 0),
('ALBENDAZOLE SUSPENSION - NESBEN SUSP', '', '8.00', '6.00', 30, 0, 3, 'SKU1285', '2023-06-01', '10', 285, '', '0.00', 0),
('TAMSULOSIN  HYDRO.', 'EXETER & CONTIFLO XL', '30.00', '22.80', 30, 9, 4, 'SKU1286', '2024-12-01', '100', 286, '', '0.00', 0),
('FINESTRIDE TAB 5MG - FINASTRIDE', '', '26.00', '18.73', 30, 8, 4, 'SKU1287', '2023-03-01', '10', 287, '', '0.00', 0),
('ACIGUARD O SUSPENSION', '', '15.00', '8.05', 30, 8, 3, 'SKU1288', '2024-07-01', '10', 288, '', '0.00', 0),
('NUGEL O SUSPENSION', '', '36.00', '27.73', 30, 3, 2, 'SKU1289', '2024-07-01', '100', 289, '', '0.00', 0),
('NUGEL PLAIN SUSPENSION', '', '30.00', '24.97', 30, 7, 5, 'SKU1290', '2023-03-01', '100', 290, '', '0.00', 0),
('ACIGUARD PLAIN SUSP', '', '10.00', '7.44', 30, 0, 3, 'SKU1291', '2023-05-20', '100', 291, '', '0.00', 0),
('STOMACAINE', '', '20.00', '14.90', 30, 0, 4, 'SKU1292', '2023-01-01', '100', 292, '', '0.00', 0),
('GASTRONE PLUS 200ML', '', '22.00', '16.30', 30, 12, 4, 'SKU1293', '2025-03-01', '100', 293, '', '0.00', 0),
('Gastrone TABLETS', '', '4.00', '2.36', 30, 3, 2, 'SKU1294', '2024-02-01', '100', 294, '', '0.00', 0),
('ALBENDAZOLE 200MG TAB - DEWORME', '', '3.00', '1.15', 30, 0, 7, 'SKU1295', '2024-01-01', '2', 295, '', '0.00', 0),
('MAGACID SUSPENSION', '', '11.00', '8.00', 30, 0, 4, 'SKU1296', '2024-05-01', '100', 296, '', '0.00', 0),
('ZEROCID SUSPENSION', '', '12.00', '8.40', 30, 0, 2, 'SKU1297', '2023-02-01', '100', 297, '', '0.00', 0),
('RHINATHIOL ADULT SYRUP', '', '38.00', '29.57', 30, 1, 2, 'SKU1298', '2023-05-05', '110', 298, '', '0.00', 0),
('ASCOVITE CEE SYRUP - ECL', '', '12.00', '7.56', 30, 0, 2, 'SKU1299', '2024-01-01', '100', 299, '', '0.00', 0),
('LUEX ADULT COUGH SYRUP', '', '20.00', '15.90', 30, 4, 4, 'SKU1300', '2023-04-01', '10', 300, '', '0.00', 0),
('KEFROX CEFUROXIME 500 - LUEX', '', '32.00', '20.00', 30, 1, 1, 'SKU1301', '2023-03-01', '10', 301, '', '0.00', 0),
('MENTHOX COUGH SYRUP', '', '8.00', '5.23', 30, 0, 4, 'SKU1302', '2024-01-01', '10', 302, '', '0.00', 0),
('BENYLIN PAEDIATRIC SYRUP', '', '38.00', '27.73', 30, 2, 1, 'SKU1303', '2024-01-04', '10', 303, '', '0.00', 0),
('BENYLIN 4 FLU', '', '32.00', '22.93', 30, 0, 2, 'SKU1304', '2024-01-01', '10', 304, '', '0.00', 0),
('KOFFEX COUGH SYRUP', '', '11.00', '7.91', 30, 3, 3, 'SKU1305', '2025-04-01', '100', 305, '', '0.00', 0),
('LETALIN  COUGH SYRUP', '', '4.00', '2.40', 30, 5, 5, 'SKU1306', '2024-06-12', '100', 306, '', '0.00', 0),
('GRISEOFULVIN SYRUP - NOVAFULVIN', '', '9.00', '6.50', 30, 0, 4, 'SKU1307', '2023-02-01', '100', 307, '', '0.00', 0),
('PROMETHAZINE SYRUP - PROMIZEL', '', '5.00', '3.50', 30, 2, 5, 'SKU1308', '2024-05-01', '100', 308, '', '0.00', 0),
('IBUPROFEN SYRUP - ENAFEN SYRUP', '', '8.00', '5.04', 30, 7, 2, 'SKU1309', '2025-01-01', '100', 309, '', '0.00', 0),
('IBUPROFEN 200 / PACK UK- GALPHARM', '', '5.00', '3.25', 30, 0, 1, 'SKU1310', '2023-08-01', '100', 310, '', '0.00', 0),
('PARA SYRUP - EXETER', '', '10.00', '6.96', 30, 0, 3, 'SKU1311', '2024-07-01', '100', 311, '', '0.00', 0),
('Para Syrup LOCAL 100ml', 'ECL & Pharmanova', '7.00', '4.67', 30, 8, 5, 'SKU1312', '2024-02-01', '100', 312, '', '0.00', 0),
('CALPOL 6+ SUSPENSION', '', '52.00', '36.49', 30, 1, 0, 'SKU1313', '2024-09-01', '100', 313, '', '0.00', 0),
('CONFIDO TABLETS', '', '64.00', '46.66', 30, 2, 0, 'SKU1314', '2024-03-01', '200', 314, '', '0.00', 0),
('BENZYL BENZOATE', '', '18.00', '12.98', 30, 5, 0, 'SKU1315', '2025-02-01', '100', 315, '', '0.00', 0),
('SECNIDAZOLE  EXETER / SECNIDEX PACK', '', '10.00', '6.58', 30, 13, 2, 'SKU1316', '2024-05-01', '100', 316, '', '0.00', 0),
('6s LONGRIDE DAPOXETINE 30MG', '', '16.00', '11.30', 30, 7, 1, 'SKU1317', '2025-03-01', '100', 317, '', '0.00', 0),
('TEVA  FLUCONAZOLE 150MG PACK', '', '10.00', '7.04', 30, 0, 5, 'SKU1318', '2024-03-01', '100', 318, '', '0.00', 0),
('NEFLUCON FLUCONAZOLE  150MG', '', '5.00', '2.49', 30, 4, 10, 'SKU1319', '2024-01-01', '150', 319, '', '0.00', 0),
('FLUCONAZOLE 150MG LUEX - MYCOSTAT', '', '9.00', '7.38', 30, 33, 10, 'SKU1320', '2024-01-01', '100', 320, '', '0.00', 0),
('FLUCORON Fluconazole cap 150mg', 'FLUCORON', '3.00', '1.98', 30, 0, 15, 'SKU1321', '2022-10-12', '1', 321, '', '0.00', 0),
('GRISEOFULVIN 500 TAB - MYCOVIN 500', '', '14.00', '9.92', 30, 25, 10, 'SKU1322', '2025-09-01', '10', 322, '', '0.00', 0),
('TOTHEMA  per AMPOULE', '', '4.00', '3.05', 30, 109, 20, 'SKU1323', '2023-08-01', '1', 323, '', '0.00', 0),
('IV NORMAL SALINE 500ml', 'SHOP', '6.00', '4.65', 30, 6, 5, 'SKU1324', '2023-02-01', '500', 324, '', '0.00', 0),
('IV RINGERS LACTATE 500ML - SHOP', '', '6.00', '4.67', 30, 17, 5, 'SKU1325', '2023-01-01', '500', 325, '', '0.00', 0),
('DNS 500ML', 'SHOP', '6.00', '4.70', 30, 12, 5, 'SKU1326', '2024-01-01', '500', 326, '', '0.00', 0),
('IV DEXTROSE 500ml', 'SHOP', '6.00', '4.67', 30, 17, 5, 'SKU1327', '2023-02-01', '500', 327, '', '0.00', 0),
('COTTON PIECES', '', '1.00', '1.00', 30, 0, 5, 'SKU1328', '2023-01-01', '1', 328, '', '0.00', 0),
('COTTON ZIGZAG PACK', '', '6.00', '3.90', 30, 0, 1, 'SKU1329', '2024-01-01', '1', 329, '', '0.00', 0),
('MAN UP CAPSULES', '', '170.00', '130.00', 30, 3, 1, 'SKU1330', '2024-02-01', '1', 330, '', '0.00', 0),
('ACICLOVIR UK  per STRIP- ACCORD', '', '7.00', '5.30', 30, 4, 2, 'SKU1331', '2023-10-01', '100', 331, '', '0.00', 0),
('Carvedilol 6.25mg Pack - TEVA', '', '24.00', '18.00', 30, 2, 3, 'SKU1332', '2023-02-01', '1', 332, '', '0.00', 0),
('CARVEDILOL12.5mg PACK', 'EXETER', '20.00', '14.85', 30, 4, 3, 'SKU1333', '2022-12-01', '1', 333, '', '0.00', 0),
('FUROSEMIDE FUMERATE 40MG', '', '12.00', '8.79', 30, 2, 2, 'SKU1334', '2024-01-01', '1', 334, '', '0.00', 0),
('AMLODIPINE 10mg TEVA PACK', '', '12.00', '7.87', 30, 1, 4, 'SKU1335', '2026-09-01', '1', 335, '', '0.00', 0),
('FENTANYL INJ / AMPOULE', '', '30.00', '25.00', 28, 38, 10, 'SKU1336', '2024-09-01', '2ML', 336, '', '0.00', 0),
('STOPKOF DRY COUGH SYRUP', '', '10.00', '6.98', 26, 0, 1, 'SKU1337', '2023-04-01', '1', 337, '', '0.00', 0),
('MORPHINE INJ  /  AMPOULE', '', '19.00', '14.00', 28, 10, 2, 'SKU1338', '2023-08-08', '1ML', 338, '', '0.00', 0),
('NALOXONE INJ / AMPOULE', '', '48.00', '35.00', 28, 0, 9, 'SKU1339', '2023-02-01', '1ML', 339, '', '0.00', 0),
('TESTOSTERONE 250MG INJ -  SUSTAVIRON', '', '100.00', '75.00', 28, 0, 6, 'SKU1340', '2023-11-01', '1ML', 340, '', '0.00', 0),
('MACAINE PER AMPOULE - BUPIVACAINE HYDROCHLORIDE INJ / AMP', '', '38.00', '30.00', 28, 25, 10, 'SKU1341', '2024-06-01', '2ML', 341, '', '0.00', 0),
('ASMANOL TABLETS', '', '1.00', '0.24', 25, 4, 6, 'SKU1342', '2023-05-02', '4TABS', 342, '', '0.00', 0),
('ASMADRINE TABLETS', '', '2.00', '1.40', 25, 50, 10, 'SKU1343', '2024-02-01', '4TABS', 343, '', '0.00', 0),
('BENDRO 2.5MG -ACCORD/ EXETER', '', '9.00', '6.65', 25, 0, 1, 'SKU1344', '2025-02-01', '28TABS', 344, '', '0.00', 0),
('AMLODIPINE 5mG TEVA PACK', '', '10.00', '6.50', 30, 9, 4, 'SKU1345', '2025-01-11', '1', 345, '', '0.00', 0),
('WHITFIELD OINTMENT', '', '9.00', '6.47', 25, 2, 1, 'SKU1346', '2024-04-01', '84TABS', 347, '', '0.00', 0),
('LIDOCAINE per VAIL', '', '6.00', '4.50', 30, 22, 15, 'SKU1347', '2023-04-01', '1', 348, '', '0.00', 0),
('AMLODIPINE 10MG - AMLONOVA 10 / WINDEPIN 10mg GB', '', '8.00', '4.38', 30, 15, 5, 'SKU1348', '2024-06-01', '1', 349, '', '0.00', 0),
('BICALUTAMIDE 50MG - TEVA', '', '70.00', '50.00', 25, 2, 10, 'SKU1347', '2023-04-01', '28TABS', 350, '', '0.00', 0),
('BICALUTAMIDE  50MG -  RELON CHEM', '', '70.00', '51.71', 25, 4, 2, 'SKU1349', '2023-04-01', '28TABS', 351, '', '0.00', 0),
('OXYBUTYNIN 5MG per Tab', '10', '2.00', '0.95', 30, 0, 0, 'SKU1349', '2023-08-01', '1', 352, '', '0.00', 0),
('100s SOLUBLE ASPIRIN 75MG per Blister', '25s', '5.00', '3.75', 30, 20, 8, 'SKU1350', '2023-11-01', '1', 353, '', '0.00', 0),
('BICALUTAMIDE 150MG- TEVA / ACCORD', '', '148.00', '92.00', 25, 8, 5, 'SKU1350', '2023-09-01', '28TABS', 354, '', '0.00', 0),
('ASPIRIN CARDIO per STRIP - BAYERN', '', '10.00', '6.98', 30, 3, 2, 'SKU1351', '2023-05-06', '1', 355, '', '0.00', 0),
('CLOPIDOGREL 75MG EXETER', '', '22.00', '16.99', 30, 1, 3, 'SKU1352', '2023-09-01', '1', 356, '', '0.00', 0),
('LOSARTAN POTASSIUM 50mg - TEVA PACK', '', '22.00', '16.09', 30, 0, 3, 'SKU1353', '2022-09-01', '1', 357, '', '0.00', 0),
('LOSARTAN POTASSIUM  25MG - TEVA PACK', '', '20.00', '14.20', 30, 0, 2, 'SKU1354', '2023-02-01', '1', 358, '', '0.00', 0),
('LOSARTAN POTASSIUM  100MG - TEVA PACK', '', '30.00', '22.79', 30, 0, 4, 'SKU1355', '2023-02-01', '1', 359, '', '0.00', 0),
('TEVA ATENOLOL 50MG -TEVA', '', '10.00', '7.46', 30, 5, 2, 'SKU1356', '2025-04-01', '1', 360, '', '0.00', 0),
('UK BENDRO 5MG - 28s UK', '', '20.00', '13.50', 25, 2, 1, 'SKU1351', '2024-01-01', '28TABS', 361, '', '0.00', 0),
('Lisinopril 5mg Pharmanova - LISINOVA', '', '6.00', '3.94', 30, 4, 5, 'SKU1357', '2024-06-01', '1', 362, '', '0.00', 0),
('LISINOPRIL + HTZ -  PHARMANOVA', '', '25.00', '18.80', 30, 5, 1, 'SKU1358', '2024-07-01', '1', 363, '', '0.00', 0),
('LISINOPRIL 10MG - CRESCENT', '', '16.00', '10.00', 30, 0, 4, 'SKU1359', '2024-08-01', '1', 364, '', '0.00', 0),
('Lisinopril10mg Pharmanova - LISINONOVA 10', '', '6.00', '4.47', 30, 0, 4, 'SKU1360', '2024-01-01', '1', 365, '', '0.00', 0),
('LOSARTAN POTASSIUM 50 - LOSAT 50 ( Pharmanova )', '', '8.00', '5.71', 30, 6, 4, 'SKU1361', '2023-08-01', '1', 366, '', '0.00', 0),
('BISOPROLOL FUMARATE 10MG - EXETER', '', '15.00', '9.98', 25, 3, 1, 'SKU1357', '2023-09-01', '28TABS', 367, '', '0.00', 0),
('LOSAR DENK 100  per PACK', '', '62.00', '54.00', 30, 3, 3, 'SKU1363', '2023-02-01', '1', 368, '', '0.00', 0),
('LOSAR DENK 50 per PACK', '', '25.00', '16.30', 30, 0, 3, 'SKU1364', '2023-03-01', '1', 369, '', '0.00', 0),
('ALLOPURINOL100MG - CRESENT', '', '18.00', '9.30', 25, 2, 2, 'SKU1364', '2023-01-01', '28TABS', 370, '', '0.00', 0),
('COLOSARDENK 50/12.50 PACK', '', '50.00', '34.00', 30, 2, 3, 'SKU1365', '2024-11-01', '1', 371, '', '0.00', 0),
('DICLO DENK 100MG / TAB - DICLODENK', '', '2.00', '1.56', 25, 103, 7, 'SKU1365', '2024-05-01', '10TABS /ST', 372, '', '0.00', 0),
('NIFEDIDENK 20 RET. per STRIP - DENK', '', '8.50', '6.43', 30, 19, 5, 'SKU1366', '2024-01-01', '10s', 373, '', '0.00', 0),
('CIPRO DENK 500MG-  CIPRODENK 500', '', '70.00', '58.63', 25, 3, 0, 'SKU1366', '2023-11-01', '10TABS', 374, '', '0.00', 0),
('NIFECARD XL PACK', '', '40.00', '30.08', 30, 2, 3, 'SKU1368', '2024-04-01', '35', 375, '', '0.00', 0),
('METFORMIN DENK 500MG / STRIP', '', '12.00', '8.83', 25, 10, 7, 'SKU1368', '2024-04-01', '10TABS / S', 376, '', '0.00', 0),
('ENAFIX SUSPENSION- Cefixime', '', '26.00', '19.18', 30, 2, 0, 'SKU1369', '2024-10-01', '10s', 377, '', '0.00', 0),
('METHYLDOPA 250MG', '', '6.00', '4.00', 25, 16, 2, 'SKU1369', '2024-02-01', '10TABS / S', 378, '', '0.00', 0),
('EVENING PRIMOSE ZANZA', '', '22.00', '16.50', 30, 6, 0, 'SKU1370', '2026-11-01', '28s', 379, '', '0.00', 0),
('CARBAMAZIPINE 200MG per strip -ALL', '', '5.00', '3.60', 25, 45, 10, 'SKU1370', '2025-04-01', '10TABS / S', 380, '', '0.00', 0),
('GLIBENCLAMIDE 5MG /STRIP - GLIBENIL', '', '1.00', '0.72', 25, 65, 10, 'SKU1371', '2025-05-01', '10TABS / S', 381, '', '0.00', 0),
('ZYFEN SYRUP', '', '26.00', '19.00', 30, 1, 0, 'SKU1371', '2023-03-01', '28s', 382, '', '0.00', 0),
('GLIMEPRIDE 2MG/ STRIP - GLIMPER PHARMANOVA', '', '5.00', '3.51', 25, 21, 10, 'SKU1372', '2023-02-01', '10TABS / S', 383, '', '0.00', 0),
('GLIMEPRIDE 4MG/ STRIP - GLIMPER PHARMANOVA', '', '7.50', '5.50', 25, 50, 10, 'SKU1373', '2022-12-01', '10TABS / S', 384, '', '0.00', 0),
('AMITRIPTYLINE PACK ECL', '', '6.00', '3.98', 30, 19, 5, 'SKU1372', '2023-05-01', '20s', 385, '', '0.00', 0),
('METFORMINE 500MG / STRIP', 'ECL', '2.00', '1.36', 25, 61, 8, 'SKU1374', '2024-04-01', '10TABS / S', 386, '', '0.00', 0),
('PROPOFOL IV', '', '35.00', '24.00', 30, 30, 10, 'SKU1374', '2023-06-01', '1', 387, '', '0.00', 0),
('VECURINIUM', '', '60.00', '45.00', 30, 0, 1, 'SKU1375', '2023-08-01', '1', 388, '', '0.00', 0),
('AMOXICLAV 457 SUSPENSION - LAVI C', '', '22.00', '15.00', 34, 5, 2, 'SKU1375', '2023-04-05', '2ML', 389, '', '0.00', 0),
('ADRENALIN IV', '', '4.00', '3.00', 30, 8, 2, 'SKU1377', '2025-08-01', '1AMP', 390, '', '0.00', 0),
('GENTAMYCIN IV - PER AMPOULE', '', '2.00', '0.50', 30, 33, 10, 'SKU1378', '2023-02-01', '1 AMP', 391, '', '0.00', 0),
('HYDROCORTISONE IV - INFUSION', '', '8.00', '5.22', 30, 10, 4, 'SKU1379', '2023-02-01', '1 AMP', 392, '', '0.00', 0),
('LIDOCAINE + ADRENALINE 50ML', '', '20.00', '15.00', 29, 0, 0, 'SKU1380', '2023-05-01', '10ML', 393, '', '0.00', 0),
('CEFTRIAXONE  TROGE WITH AQUA 1G / VIAL', '', '9.00', '6.38', 29, 9, 5, 'SKU1381', '2024-08-01', '10ML', 394, '', '0.00', 0),
('ALKA 5 SYRUP', '', '42.00', '30.00', 30, 2, 2, 'SKU1380', '2024-01-01', '1BTL', 395, '', '0.00', 0),
('SALBUTAMOL INHALER', '', '26.00', '18.98', 30, 6, 1, 'SKU1382', '2025-01-01', '1 PACK', 396, '', '0.00', 0),
('CEFTRIAXONE 1G NOVAZONE IV  - PHARMANOVA', '', '7.00', '3.59', 29, 5, 0, 'SKU1382', '2024-04-01', '10ML', 397, '', '0.00', 0),
('VENTOLIN INHALER', '', '64.00', '37.72', 30, 1, 2, 'SKU1383', '2023-08-01', '1 PACK', 398, '', '0.00', 0),
('SYMBICORT', '', '88.00', '70.50', 30, 0, 1, 'SKU1384', '2023-09-01', '1 PACK', 399, '', '0.00', 0),
('IV CEFUROXIME  750MG / VIAL', '', '7.00', '4.16', 29, 20, 3, 'SKU1383', '2026-03-01', '10ML', 400, '', '0.00', 0),
('IV CIPROFLOXACIN  IV Bottle', 'ALL', '5.00', '2.63', 30, 3, 2, 'SKU1385', '2024-10-01', '1 BTL', 401, '', '0.00', 0),
('PARA FOR INJECTION PARA IV ALL', '', '20.00', '12.50', 30, 6, 3, 'SKU1386', '2024-02-01', '1 BTL', 402, '', '0.00', 0),
('METOCLOPROMIDE  INJ / AMP 10GM - EXETER', '', '5.00', '2.80', 28, 99, 3, 'SKU1385', '2024-07-01', '2ML', 403, '', '0.00', 0),
('METRONIDAZOLE FOR INJECTION - METRO IV', '', '5.00', '2.40', 30, 5, 2, 'SKU1387', '2024-07-01', '1BTL', 404, '', '0.00', 0),
('BUSCOPAN INJ 10MG / AMP', 'LAXOPAN', '5.00', '2.50', 28, 17, 8, 'SKU1387', '2022-10-01', '1ML', 405, '', '0.00', 0),
('VAGINAX or GOGYNAX CREAM', '', '9.00', '5.91', 30, 8, 8, 'SKU1388', '2025-01-01', '1 TUBE', 406, '', '0.00', 0),
('CLOTRIMAZOLE CREAM - Pharmanova', '', '5.00', '3.33', 30, 0, 5, 'SKU1389', '2023-07-01', '1 TUBE', 407, '', '0.00', 0),
('BIOPENTIN  PER STRIP', '', '23.00', '17.00', 30, 28, 0, 'SKU1390', '2024-02-01', '1 PACK', 408, '', '0.00', 0),
('DAKTARIN ORAL GEL 40g', '', '64.00', '46.70', 30, 2, 2, 'SKU1391', '2024-04-01', '1 PACK', 409, '', '0.00', 0),
('INFA V PESSARIES', '', '27.00', '19.00', 30, 0, 2, 'SKU1392', '2023-03-01', '1 PACK', 410, '', '0.00', 0),
('VAGINAX PESSARIES', '', '7.00', '4.00', 30, 0, 5, 'SKU1393', '2024-02-01', '1 PACK', 411, '', '0.00', 0),
('WELLWOMAN +PLUS DUAL PACK', '', '120.00', '85.00', 30, 2, 1, 'SKU1394', '2023-03-01', '1 PACK', 412, '', '0.00', 0),
('EVECARE SYRUP 200ML', '', '54.00', '39.97', 30, 0, 1, 'SKU1395', '2024-12-01', '1 PACK', 413, '', '0.00', 0),
('LAVESTEN C PESSARIES', '', '19.00', '13.79', 30, 4, 5, 'SKU1396', '2023-09-01', '1 PACK', 414, '', '0.00', 0),
('GYNOMYCOLEX PESSARIES LUEX', '', '35.00', '20.53', 30, 5, 6, 'SKU1397', '2023-12-01', '1 PACK', 415, '', '0.00', 0),
('MYCOLEX CREAM - LUEX', '', '21.00', '15.00', 30, 3, 4, 'SKU1398', '2024-01-01', '1 PACK', 416, '', '0.00', 0),
('IV CLINDAMYCIN  150MG per AMP', '', '22.00', '15.00', 28, 10, 2, 'SKU1388', '2024-02-01', '1ML', 417, '', '0.00', 0),
('POLYGNAX OVULES per STRIP', '', '54.00', '41.00', 30, 12, 2, 'SKU1399', '2024-02-01', '1 PACK', 418, '', '0.00', 0),
('KETAZOL CREAM', '', '10.00', '7.63', 30, 0, 2, 'SKU1400', '2024-04-04', 'SHALINA', 419, '', '0.00', 0),
('EPHEDRINE IV 30MG  / AMP', '', '27.00', '20.80', 28, 9, 4, 'SKU1399', '2024-02-01', '2ML', 420, '', '0.00', 0),
('DREZ V Gel', '', '38.00', '28.61', 30, 4, 2, 'SKU1401', '2023-04-01', '1 PACK', 421, '', '0.00', 0),
('CAMEL ANTISEPTIC 250ML', '', '18.00', '12.32', 30, 0, 1, 'SKU1402', '2024-09-22', '1 PACK', 422, '', '0.00', 0),
('DICLOFENAC  INJ 75MG / AMPOULE - TROGE', '', '2.00', '1.15', 28, 100, 7, 'SKU1401', '2024-05-01', '2ML', 423, '', '0.00', 0),
('1% CLOTRIMAZOLE 20MG ECL - LAVINA', '', '5.00', '3.28', 30, 3, 1, 'SKU1403', '2023-12-01', '1 TUBE', 424, '', '0.00', 0),
('TAB CLAVUNOVA 625mg', '', '24.00', '18.04', 25, 23, 1, 'SKU1403', '2023-10-01', '10ML', 425, '', '0.00', 0),
('HYDROCORTISONE CREAM 30g - EXETER', '', '34.00', '24.54', 30, 3, 5, 'SKU1404', '2026-10-01', '1 TUBE', 426, '', '0.00', 0),
('ITRACONAZOLE CAPS per CAPSULE', '', '3.00', '2.12', 29, 11, 5, 'SKU1404', '2023-09-01', '10ML', 427, '', '0.00', 0),
('SALBUTAMOL TABLETS 4MG', '', '1.00', '0.50', 25, 0, 10, 'SKU1405', '2025-04-01', '10TABS / S', 428, '', '0.00', 0),
('ARABA BA ZHEN  TAB', '', '27.00', '20.00', 30, 0, 3, 'SKU1405', '2023-03-01', '20s', 429, '', '0.00', 0),
('SALBUTAMOL SYRUP', 'ECL', '7.00', '4.98', 26, 4, 4, 'SKU1406', '2024-05-01', '200', 430, '', '0.00', 0),
('MIXTAB SYRUP', '', '10.00', '7.26', 30, 3, 1, 'SKU1406', '2025-04-01', '30s', 431, '', '0.00', 0),
('RAPINOL TABLETS', '', '1.00', '0.43', 30, 4, 15, 'SKU1407', '2024-01-01', '1s', 432, '', '0.00', 0),
('DIAZEPAM 5-10MG TAB / STRIP', '', '2.00', '1.10', 25, 111, 9, 'SKU1407', '2024-04-01', '10TABS / S', 433, '', '0.00', 0),
('PAIN OFF TABLET', '', '1.00', '0.72', 30, 31, 10, 'SKU1408', '2027-05-01', '1s', 434, '', '0.00', 0),
('10CC SYRINGE & NEEDLE', '', '1.00', '0.34', 30, 43, 9, 'SKU1408', '2023-01-01', '10ML', 435, '', '0.00', 0),
('DEXAMETHACIN TAB -  DEXONE TABLETS', '', '4.00', '2.00', 30, 7, 5, 'SKU1409', '2024-05-01', '1 PACK', 436, '', '0.00', 0),
('ZUDREX PACK', '', '4.50', '3.15', 30, 0, 3, 'SKU1410', '2023-02-01', '1 PACK', 437, '', '0.00', 0),
('DICLO SUPP 100MG / STRIP - LAVINAC', '', '8.00', '5.45', 27, 34, 9, 'SKU1409', '2023-12-01', '5', 438, '', '0.00', 0),
('ESKADOL NYTE - ESKAY', '', '4.00', '2.80', 30, 16, 5, 'SKU1411', '2025-05-01', '1 PACK', 439, '', '0.00', 0),
('CLODIFEN SUPP - PACK', '', '24.00', '17.98', 27, 5, 0, 'SKU1411', '2024-08-01', '6', 440, '', '0.00', 0),
('GEBEDOL FORTE', '', '3.50', '2.55', 30, 8, 5, 'SKU1412', '2024-09-01', '1 PACK', 441, '', '0.00', 0),
('PIROXICAM  CAPS Blister - LETACAM', '', '1.00', '0.66', 30, 21, 8, 'SKU1413', '2023-05-01', '1s', 442, '', '0.00', 0),
('PARAFENAC TABLET', '', '3.50', '2.80', 30, 40, 10, 'SKU1414', '2025-05-01', '1 PACK', 443, '', '0.00', 0),
('PELADOL EXTRA', '', '3.00', '1.70', 30, 16, 10, 'SKU1415', '2025-01-01', '1 STRIP', 444, '', '0.00', 0);
INSERT INTO `product` (`prod_name`, `prod_desc`, `prod_price`, `prod_cprice`, `cat_id`, `prod_qty`, `reorder`, `serial`, `exdate`, `measure`, `prod_id`, `exdate2`, `prod_wprice`, `branch_id`) VALUES
('ALLU DRUGS', '', '1.00', '0.55', 30, 3, 10, 'SKU1416', '2025-03-01', '1s', 445, '', '0.00', 0),
('PARA SUPP 250 per SUPP - SUPOFEN EXETER', '', '1.20', '0.80', 30, -1, 6, 'SKU1417', '2025-05-01', '1s', 446, '', '0.00', 0),
('GEBEDOL PLAIN', '', '3.00', '2.15', 30, 45, 6, 'SKU1418', '2024-04-01', '1 PACK', 447, '', '0.00', 0),
('GEBEDOL EXTRA', '', '4.50', '3.42', 30, 5, 5, 'SKU1419', '2025-04-01', '1 PACK', 448, '', '0.00', 0),
('WELLWOMAN MAX 84s', '', '200.00', '144.30', 30, 2, 1, 'SKU1420', '2024-02-01', '1s', 449, '', '0.00', 0),
('LOFNAC 100 TABLET', '', '3.00', '1.48', 30, 12, 5, 'SKU1421', '2024-03-01', '1 PACK', 450, '', '0.00', 0),
('PAEDRITONE SYRUP 100ML', '', '28.00', '21.00', 30, 1, 0, 'SKU1422', '2023-02-01', '1 PACK', 451, '', '0.00', 0),
('Diclofenac tab 50mg- Diclo 50mg Strip', '', '1.50', '0.90', 30, 55, 10, 'SKU1423', '2024-06-01', '1 PACK', 452, '', '0.00', 0),
('DICLOFENAC  TAB 100mg  per BLISTER - exeter', '', '3.00', '1.60', 30, 0, 1, 'SKU1424', '2023-07-01', '1PK', 453, '', '0.00', 0),
('DOLOPAINE EXTRA TAB /PACK- ECL', '', '5.00', '3.58', 30, 6, 7, 'SKU1425', '2024-08-01', '1s', 454, '', '0.00', 0),
('DICLOFENAC FORTE ECL', '', '3.00', '1.98', 30, 0, 2, 'SKU1426', '2022-11-01', '1PK', 455, '', '0.00', 0),
('ORS HYDROLYTE ALL', '', '1.50', '1.00', 30, 25, 30, 'SKU1427', '2023-12-01', '1s', 456, '', '0.00', 0),
('EYECOPEN CAPS per STRIP', '', '12.00', '9.00', 30, 10, 2, 'SKU1428', '2023-10-01', '1s', 457, '', '0.00', 0),
('EXETER VITAMINE B CO STRONG Blister BCO STRONG', '', '5.00', '3.00', 30, 21, 1, 'SKU1429', '2023-02-01', '1s', 458, '', '0.00', 0),
('TRANEXAMIC TAB per TAB- EXETER', '', '3.20', '2.22', 30, 100, 30, 'SKU1430', '2024-03-01', '1TAB', 459, '', '0.00', 0),
('NAT B CAPS PACK', '', '69.00', '50.68', 30, 4, 1, 'SKU1431', '2022-11-01', '1 PACK', 460, '', '0.00', 0),
('PROMAN ORIGINAL', '', '54.00', '39.97', 30, 1, 2, 'SKU1432', '2023-01-01', '1 PACK', 461, '', '0.00', 0),
('PROMAN 50+  CAPS', '', '54.00', '39.98', 30, 1, 2, 'SKU1433', '2023-10-01', '1 PACK', 462, '', '0.00', 0),
('PROWOMAN ORIGNAL CAPS', '', '62.00', '43.98', 30, 2, 2, 'SKU1434', '2024-02-01', '1PACK', 463, '', '0.00', 0),
('5CC SYRINGE & NEEDLE', '', '1.00', '0.32', 30, 1, 10, 'SKU1412', '2023-01-01', '5ML', 464, '', '0.00', 0),
('AQUA FOR INJ', '', '1.00', '0.50', 30, 0, 9, 'SKU1435', '2023-02-01', '10ML', 465, '', '0.00', 0),
('Prowoman  50+ Capsules - EXETER', '', '72.00', '52.80', 30, 1, 2, 'SKU1435', '2024-09-01', '1PACK', 466, '', '0.00', 0),
('GIVING SET', '', '2.00', '1.00', 30, 24, 9, 'SKU1436', '2024-10-01', '10', 467, '', '0.00', 0),
('MARTINS LIVER SALT', '', '1.00', '0.50', 30, 24, 10, 'SKU1436', '2023-12-01', '1s', 468, '', '0.00', 0),
('ABIDEC multi DROPS', '', '78.00', '57.80', 30, 0, 0, 'SKU1437', '2023-01-01', '1s', 469, '', '0.00', 0),
('CANULA  ALL COLORS', '', '4.00', '2.44', 30, 0, 8, 'SKU1437', '2024-02-01', '2', 470, '', '0.00', 0),
('AKUMADADA', '', '1.50', '0.90', 30, 18, 5, 'SKU1438', '2023-01-01', '1', 471, '', '0.00', 0),
('NO 10 LIVER SALT ALL', 'NO10', '1.00', '0.48', 30, 231, 25, 'SKU1438', '2024-06-01', '1s', 472, '', '0.00', 0),
('GYNICARE SYRUP', '', '70.00', '49.50', 30, 5, 0, 'SKU1439', '2024-10-01', '1s', 473, '', '0.00', 0),
('SOLUBLE VIT C +  ALL BRANDS', '', '27.00', '19.98', 30, 1, 2, 'SKU1439', '2023-04-01', '20 IN A TU', 474, '', '0.00', 0),
('DUREX  EXTRA / FEELS CONDOM', '', '18.00', '12.98', 30, 15, 2, 'SKU1440', '2026-09-01', '3 PIECE', 475, '', '0.00', 0),
('GUTT CHLOROPHENICOL Drops - ATECOL', '', '4.00', '2.27', 30, 13, 0, 'SKU1440', '2024-02-01', '1s', 476, '', '0.00', 0),
('FIESTA CONDOM', '', '5.00', '3.50', 30, 16, 5, 'SKU1441', '2025-10-01', '3', 477, '', '0.00', 0),
('MOODS CONDOM', '', '6.00', '2.80', 30, 4, 8, 'SKU1442', '2023-07-01', '3', 478, '', '0.00', 0),
('KISS CONDOM', '', '4.00', '3.00', 30, 15, 5, 'SKU1443', '2025-03-01', '30', 479, '', '0.00', 0),
('SACHET LUBRICANT 3ML', '', '2.00', '2.00', 30, 0, 5, 'SKU1444', '2023-01-01', '75ML', 480, '', '0.00', 0),
('FIESTA  LUBRICANT 40ML', '', '23.00', '16.80', 30, 0, 5, 'SKU1445', '2024-01-01', '40', 481, '', '0.00', 0),
('SISTER INTIMATE WASH', '', '16.00', '12.00', 30, 0, 5, 'SKU1446', '2023-11-01', '20', 482, '', '0.00', 0),
('MEDISOFT REPELLANT', '', '6.00', '4.55', 30, 0, 3, 'SKU1447', '2023-06-01', '20', 483, '', '0.00', 0),
('AZILEX SUSPENSION - LUEX', '', '18.00', '13.00', 30, 0, 1, 'SKU1448', '2023-08-01', '250ML', 484, '', '0.00', 0),
('SAVLON ANTISEP 500ML', '', '32.00', '23.10', 30, 0, 0, 'SKU1449', '2025-03-01', '500', 485, '', '0.00', 0),
('SECURE PILLS per Blister', '', '2.00', '1.46', 30, 36, 20, 'SKU1448', '2024-04-01', '1s', 486, '', '0.00', 0),
('SAVLON ANTISEPTIC 250ML', '', '25.00', '18.00', 30, 4, 1, 'SKU1450', '2024-10-01', '250ML', 487, '', '0.00', 0),
('UPT CASSETTE HCG', '', '6.00', '3.90', 30, 60, 10, 'SKU1450', '2025-01-01', '1s', 488, '', '0.00', 0),
('SHALTOUX LOZENGES', '', '1.00', '0.70', 30, 0, 9, 'SKU1451', '2024-04-01', '200', 489, '', '0.00', 0),
('LUEX INHALER / ONE', '', '6.00', '4.00', 30, 1, 5, 'SKU1452', '2024-11-01', '1', 490, '', '0.00', 0),
('DICLO POWER SPRAY- LAVINAC', '', '24.00', '15.80', 30, 2, 0, 'SKU1451', '2023-09-01', '1s', 491, '', '0.00', 0),
('CATACOLD CAPS', '', '5.00', '3.10', 30, 0, 1, 'SKU1453', '2024-08-01', '1', 492, '', '0.00', 0),
('LOFNAC GEL Tube', '', '8.00', '5.69', 30, 0, 2, 'SKU1454', '2024-05-03', '1TUBE', 493, '', '0.00', 0),
('CITRO C / ASCOVITE CEE TABS', '', '2.00', '1.40', 30, 288, 10, 'SKU1454', '2024-03-01', '10TABS / S', 494, '', '0.00', 0),
('ZUBES LOZENGES', '', '1.50', '0.84', 30, 27, 10, 'SKU1455', '2024-04-01', '4', 495, '', '0.00', 0),
('PINPAC GEL  30g', '', '6.00', '4.30', 30, 2, 2, 'SKU1455', '2023-08-01', '1s', 496, '', '0.00', 0),
('WOODS SYRUP', '', '1.50', '0.93', 30, 146, 8, 'SKU1456', '2024-03-01', '10ML', 497, '', '0.00', 0),
('MENTHOX LOZENGES', '', '1.00', '0.51', 30, 22, 8, 'SKU1457', '2024-06-01', '4', 498, '', '0.00', 0),
('CIPROLEX EYE OINTMENT - LUEX', '', '15.00', '10.00', 30, 6, 1, 'SKU1456', '2023-05-01', '1s', 499, '', '0.00', 0),
('DICLOFENAC GEL 30G DICLONOVA GEL', '', '5.00', '2.10', 30, 1, 3, 'SKU1458', '2022-12-01', '1s', 500, '', '0.00', 0),
('MIXTAB', '', '1.50', '1.02', 30, 45, 5, 'SKU1458', '2024-08-01', '4', 501, '', '0.00', 0),
('KWIK ACTION', '', '1.50', '0.88', 30, 38, 6, 'SKU1459', '2025-06-01', '4', 502, '', '0.00', 0),
('MYCOLEX 3 CREAM 30g', '', '23.00', '17.00', 30, 0, 1, 'SKU1459', '2022-10-01', '1s', 503, '', '0.00', 0),
('EFPAC TABLETS', 'A EFAH', '2.00', '1.45', 30, 30, 10, 'SKU1460', '2025-02-01', '10TABS / S', 504, '', '0.00', 0),
('SURFAZ CREAM', '', '15.00', '11.04', 30, 2, 0, 'SKU1460', '2023-03-01', '1 TUBE', 505, '', '0.00', 0),
('OTRIVIN CHILD DROPS', '', '17.00', '16.39', 30, 0, 10, 'SKU1461', '2022-06-01', '1', 506, '', '0.00', 0),
('DEMACOT CREAM 15g', '', '15.00', '11.00', 30, 0, 5, 'SKU1461', '2025-10-01', '1TUBE', 507, '', '0.00', 0),
('OTRIVIN ADULT Drops', '', '38.00', '27.80', 30, 1, 1, 'SKU1462', '2024-04-01', '1', 508, '', '0.00', 0),
('KLOF GEL 30 gram', '', '7.00', '3.50', 30, 2, 5, 'SKU1462', '2023-08-01', '1s', 509, '', '0.00', 0),
('MAJOR NASAL DROP', '', '12.00', '8.50', 30, 3, 1, 'SKU1463', '2026-03-01', '1', 510, '', '0.00', 0),
('NEOHYCOLEX DROPS', 'LUEX', '23.00', '16.90', 30, 0, 3, 'SKU1464', '2023-08-01', '1', 511, '', '0.00', 0),
('EPICROM DROPS 2%', '', '27.00', '18.00', 30, 7, 4, 'SKU1465', '2023-01-01', '1', 512, '', '0.00', 0),
('FUNCBACT A CREAM 30g  BLISS', '', '12.00', '8.50', 30, 2, 0, 'SKU1463', '2024-11-01', '1s', 513, '', '0.00', 0),
('SALINE NASAL DROPS', '', '6.00', '3.77', 30, 5, 2, 'SKU1466', '2025-02-01', '1', 514, '', '0.00', 0),
('LADINAS TABLETS', '', '6.00', '4.50', 30, 3, 5, 'SKU1466', '2023-01-01', '1s', 515, '', '0.00', 0),
('ARTIFICIAL TEARS DROPS', '', '26.00', '19.00', 30, 3, 5, 'SKU1467', '2022-12-02', '1', 516, '', '0.00', 0),
('MENSTAK TABLET', '', '5.00', '3.00', 30, 0, 2, 'SKU1467', '2023-06-01', '1s', 517, '', '0.00', 0),
('LYDIA POST PILL', '', '12.00', '8.62', 30, 16, 5, 'SKU1468', '2025-05-01', '1s', 518, '', '0.00', 0),
('OLIVE OIL EAR DROPS', '', '12.00', '8.59', 30, 0, 0, 'SKU1468', '2023-04-01', '1', 519, '', '0.00', 0),
('GUTT EXCLOFEN-DICLOFENAC DROPS', '', '10.00', '6.00', 30, 10, 1, 'SKU1469', '2023-04-01', '1', 520, '', '0.00', 0),
('EXACROM DROPS', '', '16.00', '11.38', 30, 6, 5, 'SKU1470', '2023-09-01', '1', 521, '', '0.00', 0),
('CONTRA 72 PILLS', '', '5.00', '2.38', 30, 0, 10, 'SKU1470', '2024-05-01', '1s', 522, '', '0.00', 0),
('COOL EYES DROPS - ARTIFICIAL TEARS', '', '34.00', '24.59', 30, 5, 2, 'SKU1471', '2024-01-01', '1', 523, '', '0.00', 0),
('BRIONA / JOY / ALISON / IZZO OINT -  ALL', '', '6.00', '4.50', 30, 17, 5, 'SKU1471', '2023-04-01', '1s', 524, '', '0.00', 0),
('CIPROLEX DROPS-LUEX', '', '15.00', '10.98', 30, 0, 2, 'SKU1472', '2023-06-01', '1', 525, '', '0.00', 0),
('FRICKS HERBAL LOZENGES', '', '1.50', '1.18', 30, 0, 5, 'SKU1472', '2023-01-20', '1s', 526, '', '0.00', 0),
('EXCIPRO DEX DROPS - EXETER', '', '15.00', '10.78', 30, 4, 1, 'SKU1473', '2024-01-01', '1', 527, '', '0.00', 0),
('CALAMINE OINT', '', '8.00', '5.69', 30, 1, 3, 'SKU1473', '2024-02-01', '1s', 528, '', '0.00', 0),
('LANTANOPROST DROP - EXETER', '', '58.00', '45.78', 30, 2, 1, 'SKU1474', '2023-04-01', '1', 529, '', '0.00', 0),
('DROPS NOVACIP - CIPRO DROPS', '', '4.00', '2.19', 30, 0, 5, 'SKU1475', '2022-11-01', '1', 530, '', '0.00', 0),
('MEDULAC LACTULOSE 25OML', '', '48.00', '29.80', 30, 2, 0, 'SKU1476', '2024-05-01', '1', 531, '', '0.00', 0),
('MAXITROL OINTMENT -  OCC', '', '32.00', '23.00', 30, 3, 2, 'SKU1477', '2023-01-01', '1', 532, '', '0.00', 0),
('TIMOLOL EXETOMOL  DROP', '', '10.00', '5.98', 30, 33, 5, 'SKU1478', '2024-01-01', '1', 533, '', '0.00', 0),
('EPHEDRINE DROPS', '', '4.00', '2.91', 30, 7, 5, 'SKU1479', '2024-08-01', '1', 534, '', '0.00', 0),
('SUDOCREAM  60g', '', '27.00', '20.17', 30, 0, 1, 'SKU1478', '2024-02-01', '1s', 535, '', '0.00', 0),
('GENTAMICIN DROPs / NOVAGENT drops', '', '7.00', '4.80', 30, 8, 3, 'SKU1480', '2023-06-01', '1', 536, '', '0.00', 0),
('SUDOCREAM 120g', '', '30.00', '29.00', 30, 0, 0, 'SKU1480', '2023-09-01', '1s', 537, '', '0.00', 0),
('POLAR ICE', '', '22.00', '15.52', 30, 0, 2, 'SKU1481', '2024-11-01', '1s', 538, '', '0.00', 0),
('VASELINE  BLUE SEAL 250g', '', '18.00', '12.00', 30, 0, 2, 'SKU1482', '2023-04-01', '1s', 539, '', '0.00', 0),
('PMF CREAM', '', '12.00', '8.94', 30, 0, 3, 'SKU1483', '2023-12-01', '1s', 540, '', '0.00', 0),
('DYKLO SPRAY', '', '125.00', '101.00', 30, 2, 1, 'SKU1484', '2024-04-01', '1s', 541, '', '0.00', 0),
('DREZ SOLUTION 30ml', '', '18.00', '13.60', 30, 5, 4, 'SKU1485', '2024-11-01', '1s', 542, '', '0.00', 0),
('DREZ OINTMENT 10g', '', '13.00', '9.45', 30, 3, 3, 'SKU1486', '2024-01-01', '1s', 543, '', '0.00', 0),
('DREZ OINTMENT 30g', 'ECL', '20.00', '14.37', 30, 6, 3, 'SKU1487', '2024-08-01', '1s', 544, '', '0.00', 0),
('DREZ SOLUTION 100ML', '', '28.00', '24.25', 30, 1, 2, 'SKU1488', '2024-01-01', '1s', 545, '', '0.00', 0),
('2\'\' GAUZE Bandage s/s - 2\'\'', '', '1.50', '0.60', 30, 36, 20, 'SKU1489', '2024-03-02', '1s', 546, '', '0.00', 0),
('3\'\' GAUZE BANDAGE M/S - 3\'\'', '', '2.00', '1.30', 30, 10, 24, 'SKU1490', '2026-12-01', '1s', 547, '', '0.00', 0),
('REDSUN JELLY/ sachet', '', '3.00', '2.15', 30, 31, 10, 'SKU1491', '2024-06-01', '1s', 548, '', '0.00', 0),
('BEBE FOOD SUPPLEMENT', '', '8.00', '5.00', 30, 9, 4, 'SKU1492', '2024-01-01', '1s', 549, '', '0.00', 0),
('BLUMOON TAB per PACK', '', '4.00', '2.23', 30, 0, 5, 'SKU1493', '2023-05-01', '1PK', 550, '', '0.00', 0),
('SILDENAFIL EXETER 50 /100MG per TAB', '', '4.00', '2.70', 30, 58, 8, 'SKU1494', '2024-08-01', '1s', 551, '', '0.00', 0),
('DRAGON TAB per TAB', '', '7.00', '5.47', 30, 18, 2, 'SKU1495', '2023-05-01', '1s', 552, '', '0.00', 0),
('MR Q SYRUP', '', '7.00', '4.62', 30, 9, 2, 'SKU1496', '2024-06-01', '1s', 553, '', '0.00', 0),
('ELASTIC BANDAGE 2\'\' S/S', '', '2.50', '1.80', 30, 0, 1, 'SKU1497', '2023-11-02', '1s', 554, '', '0.00', 0),
('LEVOTHYROXINE 50MG', '', '18.00', '13.00', 30, 0, 0, 'SKU1498', '2023-07-01', '1PACK', 555, '', '0.00', 0),
('EVALINA INTIMATE SPRAY', '', '24.00', '18.50', 30, 0, 2, 'SKU1499', '2024-01-01', '1s', 556, '', '0.00', 0),
('INFA V WASH 100ML', '', '23.00', '16.00', 30, 0, 2, 'SKU1500', '2022-09-01', '1s', 557, '', '0.00', 0),
('LAVET 20 ML', '', '38.00', '28.29', 30, 1, 2, 'SKU1501', '2025-09-01', '1s', 558, '', '0.00', 0),
('HILADY INTIMATE WASH', '', '25.00', '18.00', 30, 3, 3, 'SKU1502', '2025-01-01', '1s', 559, '', '0.00', 0),
('IDEOS CALCIUM CAPS per BOTTLE', '', '54.00', '40.00', 30, 0, 1, 'SKU1503', '2024-02-01', '1PACK', 560, '', '0.00', 0),
('BETHANECHOL CHLORIDE per TAB', '', '8.00', '5.00', 30, 100, 50, 'SKU1504', '2023-10-01', '1s', 561, '', '0.00', 0),
('OXYBUTYNIN 2.5MG per TAB', '', '1.20', '0.64', 30, 152, 10, 'SKU1505', '2023-02-01', '1s', 562, '', '0.00', 0),
('DIABETONE CAPS per STRIP', '', '20.00', '30.00', 30, 0, 1, 'SKU1506', '2023-04-01', '1s', 563, '', '0.00', 0),
('PROSLUV CAPSULE', '', '27.00', '20.00', 30, 0, 3, 'SKU1507', '2023-03-01', '1s', 564, '', '0.00', 0),
('TRUMAN CAPSULES', '', '22.00', '15.00', 30, 0, 3, 'SKU1508', '2022-12-01', '1s', 565, '', '0.00', 0),
('PERFECTIL PLAIN CAPS', '', '80.00', '56.00', 30, 3, 2, 'SKU1509', '2024-03-01', '1pk', 566, '', '0.00', 0),
('OSTEOCARE CAPS Original', '', '54.00', '39.98', 30, 1, 1, 'SKU1510', '2025-02-01', '1PACK', 567, '', '0.00', 0),
('GOSERILIN 10.8MG - ZOLADEX', '', '3200.00', '2900.95', 30, 2, 1, 'SKU1511', '2023-08-01', '1s', 568, '', '0.00', 0),
('PARA SUPP 125 per  STRIP ALL - GACET LAVIFLAM NOVAMOL', '', '3.50', '2.50', 30, 5, 15, 'SKU1512', '2023-02-01', '1s', 569, '', '0.00', 0),
('PARA SUPP 500 per SUPP - SUPOFEN ( EXETER )', '', '2.00', '1.37', 30, 0, 7, 'SKU1513', '2024-10-01', '1s', 570, '', '0.00', 0),
('PARA SUPP 125 per SUPP - SUPOFEN ( EXETER )', '', '1.00', '0.53', 30, 45, 8, 'SKU1514', '2023-10-01', '1s', 571, '', '0.00', 0),
('DOMI 10 SUPPOSITORY per Supp', '', '3.00', '1.91', 30, 6, 5, 'SKU1515', '2023-09-01', '1s', 572, '', '0.00', 0),
('PARA DENK  SUPP 125 per SUPP', '', '1.80', '1.40', 30, 0, 4, 'SKU1516', '2023-09-01', '1s', 573, '', '0.00', 0),
('PARA DENK SUPP 250 per SUPP', '', '2.00', '1.50', 30, 0, 4, 'SKU1517', '2022-07-01', '1s', 574, '', '0.00', 0),
('IV SALINE 5Ltr bag KABSAD', '', '70.00', '50.00', 30, 33, 7, 'SKU1518', '2024-04-01', '1s', 575, '', '0.00', 0),
('RINGERS 0.5tr bag KABSAD', '', '6.00', '4.70', 30, 0, 7, 'SKU1519', '2024-01-02', '1s', 576, '', '0.00', 0),
('IV SALINE 500ml KABSAD', '', '6.00', '4.67', 30, 44, 7, 'SKU1520', '2024-03-01', '1s', 577, '', '0.00', 0),
('IV DEXTROSE DNS 500ml bag KABSAD', '', '6.00', '4.70', 30, 0, 7, 'SKU1521', '2024-03-02', '1s', 578, '', '0.00', 0),
('BUNDLE COTTON DIGAMED 100g', '', '8.00', '4.70', 30, 0, 1, 'SKU1522', '2024-01-01', '1s', 579, '', '0.00', 0),
('OCC TETRACYCLINE  OINTMENT', '', '5.00', '4.00', 30, 36, 1, 'SKU1523', '2024-07-04', '1s', 580, '', '0.00', 0),
('PLASTER ROLL 1\'\' s/s Brown', '', '5.00', '3.80', 30, 0, 2, 'SKU1524', '2023-10-01', '1s', 581, '', '0.00', 0),
('SILVER SULFADIAZINE Cream LAVINA', '', '15.00', '8.98', 30, 5, 4, 'SKU1525', '2023-12-01', '1s', 582, '', '0.00', 0),
('SILVERZINE CREAM 30g', '', '13.00', '9.36', 30, 4, 3, 'SKU1526', '2024-10-01', '1S', 583, '', '0.00', 0),
('LEXSPORIN CREAM', '', '27.00', '20.00', 30, 2, 2, 'SKU1527', '2023-05-01', '1s', 584, '', '0.00', 0),
('LEXSPORIN POWDER', '', '20.00', '16.00', 30, 3, 2, 'SKU1528', '2022-11-01', '1s', 585, '', '0.00', 0),
('EPIDERM CREAM', '', '9.00', '6.95', 30, 4, 4, 'SKU1529', '2024-04-01', '1s', 586, '', '0.00', 0),
('AMIDERM CREAM 30g', '', '5.00', '3.08', 30, 0, 4, 'SKU1530', '2023-01-01', '1s', 587, '', '0.00', 0),
('PENICILLIN Ointment 30g', '', '6.00', '4.00', 30, 0, 3, 'SKU1531', '2024-08-01', '1s', 588, '', '0.00', 0),
('ABONIKI BALM', '', '6.50', '4.68', 30, 0, 2, 'SKU1532', '2025-04-01', '1s', 589, '', '0.00', 0),
('ROBB s/s', '', '1.00', '0.60', 30, 1, 5, 'SKU1533', '2023-01-20', '1s', 590, '', '0.00', 0),
('TUSHIES BABY WIPES', '', '10.00', '8.50', 30, 11, 4, 'SKU1534', '2023-01-01', '1PK', 591, '', '0.00', 0),
('EXAM Gloves pieces', '', '2.00', '1.50', 30, 31, 15, 'SKU1535', '2023-05-01', '1s', 592, '', '0.00', 0),
('EXAM GLOVES per PACK', '', '65.00', '48.00', 30, 6, 2, 'SKU1536', '2023-01-02', '1s', 593, '', '0.00', 0),
('Diaspot UPT stripes', '', '3.00', '1.50', 30, 0, 1, 'SKU1537', '2023-01-02', '1s', 594, '', '0.00', 0),
('NEPHROSTOMY TUBE', '', '770.00', '684.00', 30, 2, 1, 'SKU1538', '2025-08-04', '1s', 595, '', '0.00', 0),
('PROSTACARE CAPS', '', '85.00', '64.21', 30, 4, 3, 'SKU1539', '2024-08-01', '1s', 596, '', '0.00', 0),
('ZEMAN CAPSULES', '', '85.00', '60.50', 30, 16, 7, 'SKU1540', '2023-11-01', '1pk', 597, '', '0.00', 0),
('LIVOLIN FORTE', '', '75.00', '56.40', 30, 4, 2, 'SKU1541', '2023-03-01', '1s', 598, '', '0.00', 0),
('LIVOMYN CAPSULES', '', '24.00', '17.00', 30, 0, 4, 'SKU1542', '2023-10-01', '1PK', 599, '', '0.00', 0),
('PERFECTIL PLUS CAPS', '', '200.00', '144.83', 30, 2, 1, 'SKU1543', '2024-12-01', '1PACK', 600, '', '0.00', 0),
('PLEASURE GEL LUBRICANT', '', '30.00', '21.80', 30, 2, 2, 'SKU1544', '2024-07-01', '1s', 601, '', '0.00', 0),
('BONJELA JNR OINTMENT', '', '53.00', '39.15', 30, 0, 1, 'SKU1545', '2023-02-01', '1s', 602, '', '0.00', 0),
('10mg TADALAFIL + OXYTOCIN. spray', 'SPRAY', '330.00', '245.00', 30, 5, 2, 'SKU1546', '2023-09-01', '1s', 603, '', '0.00', 0),
('DRAGON DELAY SPRAY', '', '35.00', '25.59', 30, 5, 2, 'SKU1547', '2025-02-01', '1s', 604, '', '0.00', 0),
('K Y Gel 83g', 'KY', '54.00', '40.00', 30, 0, 1, 'SKU1548', '2023-03-01', '1s', 605, '', '0.00', 0),
('M2 TONE Caps', 'M 2', '80.00', '60.00', 30, 3, 3, 'SKU1549', '2023-01-01', '1s', 606, '', '0.00', 0),
('WELLWOMAN Original', '', '95.00', '71.17', 30, 4, 2, 'SKU1550', '2024-04-01', '1s', 607, '', '0.00', 0),
('WELLWOMAN 50+ Caps', '', '90.00', '65.95', 30, 4, 1, 'SKU1551', '2024-08-01', '1s', 608, '', '0.00', 0),
('WELLMAN Original', '', '75.00', '56.00', 30, 2, 1, 'SKU1552', '2023-11-01', '1s', 609, '', '0.00', 0),
('WELLMAN 50+', '', '70.00', '57.90', 30, 2, 1, 'SKU1553', '2023-10-01', '1s', 610, '', '0.00', 0),
('PREGNACARE Original', '', '75.00', '52.00', 30, 1, 1, 'SKU1554', '2024-03-01', '1s', 611, '', '0.00', 0),
('PREGNACARE plus Omega', '', '176.00', '135.57', 30, 3, 2, 'SKU1555', '2024-03-01', '1s', 612, '', '0.00', 0),
('ORTHOKIT', '', '30.00', '21.00', 30, 1, 1, 'SKU1556', '2023-03-02', '1s', 613, '', '0.00', 0),
('VITAMINE E - ENAT 400PACK', '', '68.00', '50.00', 30, 5, 2, 'SKU1557', '2025-03-01', '1s', 614, '', '0.00', 0),
('EXTRAFLEX', '', '66.00', '48.95', 30, 3, 1, 'SKU1558', '2024-09-01', '1s', 615, '', '0.00', 0),
('ZANZA VITAMINE E Caps', '', '38.00', '27.80', 30, 7, 3, 'SKU1559', '2025-09-01', '1s', 616, '', '0.00', 0),
('LIVOPAT CAPSULES', '', '36.00', '26.56', 30, 3, 2, 'SKU1560', '2023-03-01', '1s', 617, '', '0.00', 0),
('NEUROPAT CAPASULES', '', '68.00', '49.82', 30, 3, 1, 'SKU1561', '2023-11-01', '1s', 618, '', '0.00', 0),
('CYTOTEC per TAB', '', '5.00', '2.70', 30, 19, 10, 'SKU1562', '2023-01-01', '1s', 619, '', '0.00', 0),
('PREGABLIN  75mg per STRIP - PREGASAFE', '', '20.00', '13.33', 30, 32, 3, 'SKU1563', '2024-03-01', '1s', 620, '', '0.00', 0),
('CARDIOPAT CAPS', '', '30.00', '21.81', 30, 3, 2, 'SKU1564', '2023-05-01', '1s', 621, '', '0.00', 0),
('PREGNACARE MAX', '', '180.00', '140.00', 30, 0, 1, 'SKU1565', '2023-11-01', '1s', 622, '', '0.00', 0),
('NAPROSEN EC TAB', '', '13.00', '9.50', 30, 16, 5, 'SKU1566', '2026-05-06', '28', 623, '', '0.00', 0),
('AMLODIPINE 5mg TAB AMLONOVA 5- Pharmanova', '', '8.00', '3.50', 30, 4, 7, 'SKU1567', '2023-02-01', '1', 624, '', '0.00', 0),
('BISOPROLOL 2.5MG - TEVA', '', '10.00', '7.98', 30, 3, 2, 'SKU1568', '2024-04-01', '28s', 625, '', '0.00', 0),
('LOSARTAN  POTASSIUM 100mg - LOSAT 100 ( Pharmanova )', '', '15.00', '10.51', 30, 0, 4, 'SKU1569', '2024-10-01', '30s', 626, '', '0.00', 0),
('LOSARTAN POTASSIUM 100MG - EXETER', '', '15.00', '10.51', 30, 0, 1, 'SKU1570', '2022-06-01', '28s', 627, '', '0.00', 0),
('VIT B DENK per TAB', '', '2.00', '1.45', 30, 73, 15, 'SKU1571', '2024-02-01', '1s', 628, '', '0.00', 0),
('NIFEDIPINE / CARDIOFIN 20MG TABS strip - EXETER', '', '3.00', '1.85', 30, 3, 3, 'SKU1572', '2024-11-01', '10s', 629, '', '0.00', 0),
('NOVAPENEM 1G -  MEROPENEM 1000', '', '85.00', '57.00', 30, 19, 3, 'SKU1573', '2023-08-01', '1s', 630, '', '0.00', 0),
('CEFTRIAXONE + SALBACTAM 1G VIAL', '', '16.00', '11.72', 30, 10, 3, 'SKU1574', '2026-02-01', '1s', 631, '', '0.00', 0),
('GACET PARA  SUPP 250 per STRIP', '', '4.00', '2.60', 30, 18, 5, 'SKU1575', '2023-02-01', '1s', 632, '', '0.00', 0),
('NEOSTIGMINE INJ', '', '25.00', '16.00', 30, 10, 7, 'SKU633', '2024-02-01', '1s', 633, '', '0.00', 0),
('BENDRO TAB ECL 2.5MG - E C L', '', '1.00', '0.65', 30, 25, 15, 'SKU634', '2024-04-01', '1s', 634, '', '0.00', 0),
('DYMOL TABLET', 'SANOFI', '7.00', '4.80', 25, 8, 5, 'SKU635', '2024-09-01', '10s', 635, '', '0.00', 0),
('NESTRIX FORTE 200ML', 'E C L', '16.00', '11.76', 26, 2, 1, 'SKU636', '2024-04-01', '200ml', 636, '', '0.00', 0),
('NEXCOFER PLUS EXETER 200ML', '', '21.00', '14.98', 30, 2, 2, 'SKU637', '2023-05-01', '200', 637, '', '0.00', 0),
('PLASTER ROLL 4\'\' L/S', '', '13.00', '8.80', 30, 0, 2, 'SKU638', '2023-09-11', '4\'\' ROLL', 638, '', '0.00', 0),
('PROCOLD TABLETS', '', '5.00', '3.30', 25, 0, 14, 'SKU639', '2023-01-11', '1s', 639, '', '0.00', 0),
('NOSTAMINE EYE/NASAL DROP', '', '24.00', '17.49', 35, 2, 3, 'SKU640', '2024-12-01', '1pack', 640, '', '0.00', 0),
('DEXATROL OINTMENT', '', '18.00', '12.32', 32, 0, 2, 'SKU641', '2023-08-01', '1s', 641, '', '0.00', 0),
('CLOMID TABLETS', '', '78.00', '65.00', 30, 0, 0, 'SKU642', '2026-05-01', '1s', 642, '', '0.00', 0),
('ELASTIC BANDAGE L/S 6\'\'', '', '9.00', '5.18', 30, 6, 2, 'SKU643', '2024-02-01', '1ROLL', 643, '', '0.00', 0),
('NO LOGO CONDOM PIECES', '', '1.00', '0.30', 30, 0, 5, 'SKU644', '2024-01-01', '3s', 644, '', '0.00', 0),
('MICROGYNON TABLETS', '', '20.00', '13.80', 25, 7, 3, 'SKU645', '2023-09-10', '30s', 645, '', '0.00', 0),
('PRIMOLUT per TAB', '', '1.50', '0.77', 30, 6, 5, 'SKU646', '2023-08-10', 'PRIMOLUT', 646, '', '0.00', 0),
('LAVI C  228 SUSPENSION - AMOXICILAV 228', '', '18.00', '13.12', 30, 6, 2, 'SKU647', '2023-09-01', '100', 647, '', '0.00', 0),
('NO LOGO FULLPACK', '', '25.00', '14.00', 30, 0, 2, 'SKU648', '2024-01-01', '144s', 648, '', '0.00', 0),
('CARDIOFINE NIFEDIPINE 30MG - EXETER per strip', '', '9.00', '6.43', 30, 0, 2, 'SKU649', '2022-11-01', '14s', 649, '', '0.00', 0),
('KIDIVITE BABY/ CHILD  14/15 MULTI 150ML', '', '32.00', '22.98', 30, 8, 2, 'SKU650', '2023-09-01', '150ML', 650, '', '0.00', 0),
('NEOFERON CAPSULES - EXETER', '', '16.00', '11.88', 30, 7, 2, 'SKU651', '2024-04-01', '30s', 651, '', '0.00', 0),
('PANALEX 500 PACK  - LUEX', '', '10.00', '6.00', 30, 7, 3, 'SKU652', '2025-04-01', '16s', 652, '', '0.00', 0),
('STOPKOF LOZENGES 4s - ECL', '', '1.00', '0.40', 30, 26, 10, 'SKU653', '2023-01-01', '4s', 653, '', '0.00', 0),
('FAST MELT', '', '1.00', '0.48', 30, 28, 5, 'SKU654', '2024-03-01', '1s', 654, '', '0.00', 0),
('UK PREDNISOLINE 5MG per STRIP  UK', '', '14.00', '8.86', 30, 5, 1, 'SKU655', '2023-04-01', '28s', 655, '', '0.00', 0),
('SPEMEN CAPSULES', '', '48.00', '38.00', 30, 2, 1, 'SKU656', '2024-04-01', '28s', 656, '', '0.00', 0),
('ANUSOL SUPPOSITORIES per SUPP', '', '4.00', '2.50', 30, 16, 4, 'SKU657', '2024-06-01', '1s', 657, '', '0.00', 0),
('TAB AZITHROMYCN 500 - AZITEX 500 EXETER', '', '22.00', '14.00', 30, 3, 2, 'SKU658', '2024-02-01', '3s', 658, '', '0.00', 0),
('ENVICO COLD & FLU CAPS PACK', '', '32.00', '21.80', 30, 0, 0, 'SKU659', '2023-01-01', '20s', 659, '', '0.00', 0),
('PREGNACARE BEFORE CONCEPTION', '', '135.00', '101.00', 30, 4, 1, 'SKU660', '2024-06-01', '10s', 660, '', '0.00', 0),
('LYRICA per strip -PREGABLIN 75MG', '', '160.00', '120.69', 30, 5, 1, 'SKU661', '2024-02-01', '1s', 661, '', '0.00', 0),
('SLIM SMART CAPS', '', '120.00', '100.00', 30, 1, 0, 'SKU662', '2023-12-01', '1s', 662, '', '0.00', 0),
('SHALTOUX COUGH SYRUPS', '', '8.00', '5.15', 30, 0, -1, 'SKU663', '2023-01-01', '100', 663, '', '0.00', 0),
('IBUCAP FORTE TAB -SHALINA', '', '3.00', '2.10', 30, 0, 4, 'SKU664', '2023-01-01', '10s', 664, '', '0.00', 0),
('BETASOL CREAM 30g', '', '5.00', '3.05', 30, 1, 3, 'SKU665', '2023-01-20', '30g', 665, '', '0.00', 0),
('SHALTEM FORTE 1 X 6s', '', '13.00', '9.10', 30, 0, 3, 'SKU666', '2024-04-01', '6s', 666, '', '0.00', 0),
('POLYGEL ANTACID 200ml', '', '14.00', '9.80', 30, 5, 2, 'SKU667', '2024-04-01', '200ml', 667, '', '0.00', 0),
('ADDYZOA CAPSULES', '', '80.00', '58.00', 30, 16, 2, 'SKU668', '2023-03-01', '30s', 668, '', '0.00', 0),
('ACICLOVIR 200  ALL 200mg - per PACK', '', '18.00', '10.37', 30, 5, 2, 'SKU669', '2023-10-01', '28s', 669, '', '0.00', 0),
('MAXITROL SUSPENSION', '', '35.00', '25.38', 30, 0, 1, 'SKU670', '2024-02-01', '1s', 670, '', '0.00', 0),
('SUSTANON ORIGINAL 250mg - Testosteron Inj', '', '135.00', '95.00', 30, 3, 2, 'SKU671', '2024-05-01', '1s', 671, '', '0.00', 0),
('DESMOPRESSIN TABLET  0.1MG per TAB', '', '15.00', '10.95', 30, 76, 10, 'SKU672', '2022-11-01', '1s', 672, '', '0.00', 0),
('TALAGENTIS TABLET 20MG per TAB', '', '5.00', '3.00', 30, 10, 5, 'SKU673', '2024-01-01', '1s', 673, '', '0.00', 0),
('SSS THROAT LOZENGE per STRIP', '', '7.00', '4.30', 30, 0, 3, 'SKU674', '2022-09-01', '1s', 674, '', '0.00', 0),
('PETHIDINE INJ per VIAL', '', '30.00', '20.00', 28, 39, 5, 'SKU675', '2024-01-01', '1s', 675, '', '0.00', 0),
('AMOXICILLIN SUSPENSION - LUEX', '', '10.00', '7.00', 34, 4, 3, 'SKU676', '2024-01-01', '100', 676, '', '0.00', 0),
('BONAPLEX SYRUP - LUEX', '', '28.00', '21.90', 26, 0, 2, 'SKU677', '2023-11-01', '100', 677, '', '0.00', 0),
('CIPROLEX 500 TAB  PACK - LUEX', '', '20.00', '15.00', 30, 27, 3, 'SKU678', '2024-10-01', '1s', 678, '', '0.00', 0),
('FERROLEX SYRUP 250 - LUEX', '', '25.00', '16.90', 30, 2, 2, 'SKU679', '2023-04-01', '250', 679, '', '0.00', 0),
('RENALOF CAPSULES', '', '140.00', '110.00', 30, 3, 1, 'SKU680', '2023-06-01', '90s', 680, '', '0.00', 0),
('VITAFORCE SYRUP 250 - LUEX', '', '26.00', '18.90', 26, 4, 2, 'SKU681', '2023-12-01', '250', 681, '', '0.00', 0),
('WORMBAT 400 TABLET', '', '5.00', '2.50', 30, 8, 5, 'SKU682', '2025-12-01', '1s', 682, '', '0.00', 0),
('ACICLOVIR CREAM 5% - ACYCLOVIR Denk', '', '38.00', '26.15', 30, 3, 1, 'SKU683', '2023-01-01', '1s', 683, '', '0.00', 0),
('GRISEOFULVIN 125 TAB - MYCOVIN 125', '', '6.00', '4.47', 30, 23, 10, 'SKU684', '2024-08-01', '1s', 684, '', '0.00', 0),
('AMITRIPTYLINE  25MG per BLISTER', '', '3.00', '1.70', 30, 36, 10, 'SKU685', '2023-06-01', '1s', 685, '', '0.00', 0),
('TEVA SILDENAFIL 100mg per PACK 8s', '', '32.00', '16.00', 30, 6, 2, 'SKU686', '2023-10-01', '8s', 686, '', '0.00', 0),
('PIRITON ORIG - GSK /TABLET', '', '2.00', '1.10', 30, 0, 5, 'SKU687', '2024-03-01', '1s', 687, '', '0.00', 0),
('DEXATROL DROPS', '', '27.00', '19.56', 30, 4, 2, 'SKU688', '2023-12-01', '1s', 688, '', '0.00', 0),
('ZULU MR', '', '8.00', '5.30', 32, 5, 1, 'SKU689', '2023-09-01', '1s', 689, '', '0.00', 0),
('COCODAMOL TABLETS', '', '10.00', '7.50', 30, 0, 3, 'SKU690', '2024-09-01', '1s', 690, '', '0.00', 0),
('DREZ POWDER 10g', '', '18.00', '12.10', 30, 5, 2, 'SKU691', '2024-09-01', '1s', 691, '', '0.00', 0),
('PAINGAY CAPSULES', '', '5.50', '4.20', 30, 14, 3, 'SKU692', '2024-09-01', '1s', 692, '', '0.00', 0),
('DETTOL 250ML', '', '22.00', '15.51', 30, 0, 1, 'SKU693', '2023-01-01', '250', 693, '', '0.00', 0),
('SAVLON ANTISEPTIC 125ML', '', '13.00', '9.82', 30, 0, 1, 'SKU694', '2023-01-01', '1s', 694, '', '0.00', 0),
('FOLIGROW CAPSULES', '', '20.00', '15.00', 30, 4, 1, 'SKU695', '2024-11-01', '1s', 695, '', '0.00', 0),
('GUDAPET TABLET', '', '10.00', '6.73', 30, 0, 2, 'SKU696', '2023-03-01', '1s', 696, '', '0.00', 0),
('JEDITOINE SYRUP', '', '10.00', '6.73', 30, 2, 2, 'SKU697', '2023-01-01', '1s', 697, '', '0.00', 0),
('REFRESH TEARS EYE DROP 15ML', '', '68.00', '48.00', 30, 2, 1, 'SKU698', '2023-04-02', '15ML', 698, '', '0.00', 0),
('TRES ORIX S/S 100ML', '', '17.00', '12.00', 30, 0, 1, 'SKU699', '2024-01-01', '100ML', 699, '', '0.00', 0),
('KLOVINAL PESSARIES', '', '28.00', '19.66', 30, 0, 1, 'SKU700', '2023-06-06', '1s', 700, '', '0.00', 0),
('GALVUS MET 50/1000', '', '48.00', '37.71', 30, 6, 1, 'SKU701', '2023-03-01', '1s', 701, '', '0.00', 0),
('FUROSEMIDE 20MG TA B UK', '', '10.00', '6.00', 30, 2, 1, 'SKU702', '2023-03-01', '28s', 702, '', '0.00', 0),
('UPT PACK', '', '5.00', '3.50', 30, 0, 1, 'SKU703', '2024-01-01', '1s', 703, '', '0.00', 0),
('PARA EXTRA + CAFFEINE', '', '3.00', '1.28', 30, 10, 1, 'SKU704', '2024-01-01', '1s', 704, '', '0.00', 0),
('BIOFERON CAPS', '', '32.00', '23.49', 30, 2, 1, 'SKU705', '2023-07-01', '1s', 705, '', '0.00', 0),
('ELASTIC BANDAGE 3\'\' M/S', '', '5.00', '2.50', 30, 0, 1, 'SKU706', '2024-01-01', '1s', 706, '', '0.00', 0),
('DICLOLEX  HEAT GEL', '', '8.00', '6.00', 30, 5, 1, 'SKU707', '2024-01-01', '1s', 707, '', '0.00', 0),
('OVULATION TEST kit', 'kit', '7.00', '5.04', 30, 23, 1, 'SKU708', '2023-07-01', '1s', 708, '', '0.00', 0),
('GUTT PRED FORTE  drops - Prednisoline', '', '90.00', '68.00', 30, 2, 0, 'SKU709', '2025-02-01', '1s', 709, '', '0.00', 0),
('COMBIGAN EYE DROPS', '', '140.00', '107.00', 30, 1, 1, 'SKU710', '2023-01-02', '1s', 710, '', '0.00', 0),
('NIFEDENK 10MG RETARD', '', '4.50', '3.31', 30, 16, 1, 'SKU711', '2023-01-01', '1s', 711, '', '0.00', 0),
('ESSENTIAL FOLIC ACID 5MG', '', '22.00', '15.00', 30, 6, 2, 'SKU712', '2024-08-01', '30s', 712, '', '0.00', 0),
('VIVADONA', '', '42.00', '35.00', 30, 6, 1, 'SKU713', '2024-01-01', '1s', 713, '', '0.00', 0),
('KETOCONAZOL 15G - NIZORAL', '', '42.00', '33.56', 30, 1, 0, 'SKU714', '2024-03-01', '15G', 714, '', '0.00', 0),
('ACICLOVIR 400MG 14s per STRIP - EXETER', '', '17.00', '12.60', 30, 12, 1, 'SKU715', '2024-03-01', '400MG', 715, '', '0.00', 0),
('SUPER APETI PLUS', '', '13.00', '9.50', 30, 0, 1, 'SKU716', '2024-06-01', '100ML', 716, '', '0.00', 0),
('RONCIP D DROPS', '', '14.00', '9.50', 30, 19, 1, 'SKU717', '2024-07-01', '1s', 717, '', '0.00', 0),
('SUSP FLUCLOXACILLIN - EXAFLOX', '', '24.00', '16.86', 34, 3, 1, 'SKU718', '2024-01-01', '100ML', 718, '', '0.00', 0),
('SPIRONOLACTONE 25MG TEVA', '', '20.00', '13.50', 30, 1, 0, 'SKU719', '2024-09-01', '25MG', 719, '', '0.00', 0),
('SUSP ENAPHOX - CEFPODOXIME', '', '22.00', '15.58', 30, 3, 0, 'SKU720', '2023-11-01', '40MG/5ML', 720, '', '0.00', 0),
('SUSP NEFLUCON - FLUCONAZOLE', '', '15.00', '10.80', 30, 0, 0, 'SKU721', '2024-01-01', '100ML', 721, '', '0.00', 0),
('TAB ENAPHOX 200MG - CEFPODOXIME', '', '36.00', '26.76', 30, 1, 0, 'SKU722', '2023-01-01', '200MG', 722, '', '0.00', 0),
('200ml METHYLATED SPIRIT BOTTLE ECL', '', '15.00', '9.47', 30, 4, 0, 'SKU723', '2025-05-01', '200ML', 723, '', '0.00', 0),
('AVAMYS NASAL SPRAY', '', '80.00', '64.72', 30, 0, 0, 'SKU724', '2022-09-01', '100ML', 724, '', '0.00', 0),
('IV vecuronium 4mg', '', '40.00', '30.00', 30, 4, 0, 'SKU725', '2023-06-01', '4', 725, '', '0.00', 0),
('JARIFAN 2 SYRUP', '', '18.00', '13.25', 30, 0, 0, 'SKU726', '2023-08-01', '100ML', 726, '', '0.00', 0),
('BASECOLD SYRUP 3+', '', '7.00', '4.10', 30, 0, 2, '', '2024-02-01', '5', 729, '', '0.00', 0),
('DJOLAI CAPS - JULY CAPS', '', '20.00', '16.00', 30, 0, 0, '', '2024-02-01', '44', 731, '', '0.00', 0),
('ESSENTIAL VITAMINE E CAPS- CONTAINER', '', '44.00', '32.00', 30, 11, 0, '', '2024-08-01', '30s', 732, '', '0.00', 0),
('ECL PREDNISOLINE 5MG TAB', '', '2.00', '1.23', 30, 85, 5, '', '2025-08-01', '1s', 733, '', '0.00', 0),
('TAB CIPRINOL 500 per TAB - KRKA', '', '9.00', '6.20', 30, 30, 5, '', '2026-05-01', '1s', 734, '', '0.00', 0),
('ZANZA B COMPLEX Caps', '', '20.00', '14.85', 30, 2, 1, '', '2025-11-01', '1s', 735, '', '0.00', 0),
('LIDOCAINE GEL 2% 20g', '', '16.00', '11.80', 30, 6, 1, '', '2024-06-01', '1s', 736, '', '0.00', 0),
('4% EPICROM EYE DROP - 4%', '', '38.00', '27.00', 30, 3, 1, '', '2024-12-12', '1s', 737, '', '0.00', 0),
('M & A PARACETAMOL TAB / BLISTER', '', '4.00', '2.60', 30, 0, 5, '', '2024-03-01', '1s', 738, '', '0.00', 0),
('PF MALARIA TEST CASSETTE - RDT', '', '8.00', '6.20', 30, 11, 1, '', '2023-11-01', '1s', 739, '', '0.00', 0),
('3s PYRAMAX  SACHETS per strip', '', '14.00', '9.30', 30, 23, 5, '', '2023-11-01', '3s', 740, '', '0.00', 0),
('EPIFENAC DROPS', '', '24.00', '17.49', 30, 0, 1, '', '2023-10-01', '1s', 741, '', '0.00', 0),
('MINAMINO SYRUP 200ml', '', '52.00', '38.30', 30, 0, 0, '', '2024-01-01', '1s', 742, '', '0.00', 0),
('CALAMINE LOTION 200ml - KALAMINA 200', '', '17.00', '11.98', 30, 5, 0, '', '2025-01-01', '100ML', 743, '', '0.00', 0),
('OSTEOCALCIN TABLETS - EXETER', '', '18.00', '11.80', 30, 0, 0, '', '2024-04-01', '1s', 744, '', '0.00', 0),
('SACHET MAALOX SUSPENSION', '', '3.00', '1.93', 30, 44, 0, '', '2024-02-01', '1s', 745, '', '0.00', 0),
('1G AMOKSIKLAV TAB 2X - LEK', '', '50.00', '37.00', 30, 1, 1, '', '2023-05-01', '1s', 746, '', '0.00', 0),
('ROCEPHIN 1G', '', '54.00', '54.00', 30, 0, 0, '', '2024-04-01', '1s', 747, '', '0.00', 0),
('MOSQUITO NETS', 'n', '20.00', '15.00', 30, 9, 15, '', '2024-01-02', '1s', 748, '', '0.00', 0),
('TADALAFIL + TRAMADOL . spray', '', '210.00', '160.00', 30, 4, 1, '', '2023-09-01', '1s', 749, '', '0.00', 0),
('20mg TADALAFIL + OXYTOCIN Spray - DOULBE DOSE', '', '360.00', '283.00', 30, 3, 0, '', '2023-09-01', '1s', 750, '', '0.00', 0),
('PROSTACAPS', '', '195.00', '155.00', 30, 10, 0, '', '2022-11-01', '60s', 751, '', '0.00', 0),
('HEPTOVIT CAPSULE', '', '46.00', '34.34', 30, 3, 0, '', '2023-12-01', '1s', 752, '', '0.00', 0),
('COA MIXTURE', '', '126.00', '93.00', 30, 0, 0, '', '2023-05-01', '100ML', 753, '', '0.00', 0),
('SUXAMETHONIUM 100MG INJ', '', '60.00', '42.00', 30, 0, 0, '', '2023-04-01', '1s', 754, '', '0.00', 0),
('SANDOZ BICALUTAMIDE 50mg', '', '220.00', '175.00', 30, 20, 0, '', '2022-10-01', '1s', 755, '', '0.00', 0),
('ACTILIFE MULTIVIT CAPSULES', '', '18.00', '12.00', 30, 0, 0, '', '2023-08-01', '1s', 756, '', '0.00', 0),
('EXETER  SEPTRIN / EXETRIM SUSPENSION', '', '11.00', '7.89', 30, 4, 1, '', '2022-11-01', '100ML', 757, '', '0.00', 0),
('LUEX AMOXICLAV 625MG', '', '35.00', '25.00', 30, 0, 0, '', '2023-11-01', '14s', 758, '', '0.00', 0),
('DIAPER RASH CREAM 100G', '', '40.00', '30.00', 30, 3, 0, '', '2023-05-01', '100g', 759, '', '0.00', 0),
('TUBE MASCULAN LUBRICANT 70ML', '', '32.00', '25.00', 30, 7, 1, '', '2025-07-01', '70', 760, '', '0.00', 0),
('TAB EXCIPRO 500 PACK - CIPRO 500 EXETER', '', '15.00', '9.88', 30, 0, 0, '', '2024-08-01', '10s', 761, '', '0.00', 0),
('2LTR HOT WATER BOTTLE', '', '25.00', '18.19', 30, 3, 0, '', '2025-02-01', '2Ltr', 762, '', '0.00', 0),
('NEUROBION TABLETS', '', '78.00', '58.90', 30, 0, 0, '', '2023-07-01', '20s', 763, '', '0.00', 0),
('WHEY PROTEIN 500g VANILLA', '', '240.00', '190.00', 30, 1, 0, '', '2025-04-01', '500g', 764, '', '0.00', 0),
('RINGERS R/L 1Ltr KABSAD', '', '12.00', '8.10', 30, 0, 0, '', '2025-01-01', '1Ltr', 765, '', '0.00', 0),
('OMEGA  H3 CAPSULE', '', '65.00', '54.75', 30, 0, 0, '', '2024-01-01', '30s', 766, '', '0.00', 0),
('V FIRM  CREAM', '30g', '28.00', '20.69', 30, 2, 0, '', '2024-04-01', '1s', 767, '', '0.00', 0),
('NIFECARD XL  per STRIP', '1', '14.00', '10.30', 30, 1, 0, '', '2025-01-01', '1s', 768, '', '0.00', 0),
('NIZORAL SHAMPOO 60ml 2%', '', '58.00', '42.80', 30, 2, 0, '', '2023-09-01', '60ml', 769, '', '0.00', 0),
('GSK SOLUBLE CALCIUM + VIT C - EFFERVECENT', '', '39.00', '28.76', 30, 1, 0, '', '2023-09-01', '10s', 770, '', '0.00', 0),
('VIBE FIESTA + RING', '', '18.00', '13.50', 30, 2, 0, '', '2026-09-01', '6s', 771, '', '0.00', 0),
('AQUEOUS CREAM 500mg', '', '30.00', '22.85', 30, 3, 0, '', '2024-07-01', '500mg', 772, '', '0.00', 0),
('UK FOLIC ACID 5MG - ACTIFOLIC', '', '20.00', '15.00', 30, 10, 0, '', '2025-02-01', '35s', 773, '', '0.00', 0),
('CARTEF SUSPENSION', '', '10.00', '6.81', 30, 0, 1, '', '2023-11-01', '60ML', 774, '', '0.00', 0),
('TOBIN COD LIVER CAPS per Blister', '', '3.00', '1.85', 30, 18, 3, '', '2024-07-01', '10s', 775, '', '0.00', 0),
('ARTENATE SUSPENSION', '', '22.00', '15.80', 30, 5, 0, '', '2023-11-01', '100ML', 776, '', '0.00', 0),
('TAB AMOVULIN 625mg', '', '35.00', '25.40', 30, 3, 0, '', '2023-11-01', '14s', 777, '', '0.00', 0),
('4X4 ACT SHALTEM 4X4 Tablets - 24s', '', '10.00', '6.60', 30, 0, 0, '', '2024-08-01', '24s', 778, '', '0.00', 0),
('DIHYDROCODEINE per TAB - DF118', '', '5.00', '3.00', 30, 70, 10, '', '2025-01-01', '100', 779, '', '0.00', 0),
('LORATADINE 10mg per STRIP - TEVA', '', '12.00', '8.00', 30, 5, 1, '', '2025-04-01', '30s', 780, '', '0.00', 0),
('CREPE BANDAGE 4\'\'', '', '14.00', '9.23', 30, 11, 0, '', '2025-11-01', '1s', 781, '', '0.00', 0),
('SKYCEF 250 tablets', '', '18.00', '12.00', 30, 5, 2, '', '2025-03-01', '10s', 782, '', '0.00', 0),
('500 SKYCEF - Cefuroxime', '', '28.00', '20.28', 30, 5, 2, '', '2025-05-01', '10s', 783, '', '0.00', 0),
('SKYCLAV 625mg', '', '28.00', '20.69', 30, 3, 2, '', '2024-04-01', '14s', 784, '', '0.00', 0),
('IV ARTESUNATE 120mg per pack', '', '18.00', '13.00', 30, 10, 2, '', '2024-01-01', '1s', 785, '', '0.00', 0),
('EFF. TRAMADOL DENK 50mg', '', '80.00', '63.00', 30, 4, 2, '', '2025-02-01', '10s', 786, '', '0.00', 0),
('UK VITAMINE E 400 IU -ACTIHEALTH VIT E', '', '45.00', '32.00', 30, 4, 2, '', '2024-06-01', '30s', 787, '', '0.00', 0),
('GUTT CIPAC - Ciprofloxacin drops', '', '7.00', '4.50', 30, 19, 5, '', '2025-03-01', '10ML', 788, '', '0.00', 0),
('CENART FORTE TAB 1X6s', '', '16.00', '11.50', 30, 20, 5, '', '2024-06-01', '6s', 789, '', '0.00', 0),
('FENZA', '', '80.00', '54.75', 30, 1, 0, '', '2023-09-01', '30s', 790, '', '0.00', 0),
('LETAFEN 400mg - IBUPROFEN', '', '2.00', '1.20', 30, 50, 10, '', '2024-02-01', '10s', 791, '', '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_cart`
--

CREATE TABLE `service_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `patient_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_cart`
--

INSERT INTO `service_cart` (`id`, `user_id`, `service_id`, `patient_id`) VALUES
(69, 1, 3, '20220003'),
(70, 1, 5, '20220003');

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` float(15,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `name`, `description`, `price`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Diabetes Check-up', 'Diabetes Check-up', 100.00, 1, 0, '2022-05-04 09:17:45', '2022-06-16 12:09:33'),
(2, 'General Check-up', 'General Check-up', 250.00, 1, 0, '2022-05-04 09:18:06', '2022-06-16 04:31:42'),
(3, 'Kidney Stone', 'Kidney Stone', 50.00, 1, 0, '2022-05-04 09:19:01', '2022-06-16 12:11:00'),
(4, 'Cholesterol levels', 'Cholesterol levels', 100.00, 1, 0, '2022-05-04 09:19:36', '2022-06-16 12:10:24'),
(5, 'Blood Pressure Check-up', 'Blood Pressure Check-up', 70.00, 1, 0, '2022-05-04 09:20:33', '2022-10-10 21:04:17'),
(6, 'test', 'test', 1.00, 1, 1, '2022-05-04 09:20:49', '2022-05-04 09:20:57'),
(7, '', '', 0.00, 1, 1, '2022-06-14 15:43:16', '2022-06-14 15:44:06'),
(8, 'Infertility', 'Infertility', 60.00, 1, 0, '2022-06-16 12:11:32', '2022-06-16 12:11:32'),
(9, 'Body Mass Index', 'Body Mass Index', 20.00, 1, 0, '2022-06-16 12:12:03', '2022-06-16 12:12:03'),
(10, 'Health Counseling', 'Health Counseling', 100.00, 1, 0, '2022-06-16 12:12:48', '2022-06-16 12:12:48'),
(11, 'Cancer Awareness', 'Cancer Awareness', 70.00, 1, 0, '2022-06-16 12:13:27', '2022-06-16 12:13:27'),
(12, 'Stroke', 'Stroke', 55.00, 1, 0, '2022-06-16 12:13:51', '2022-06-16 12:13:51'),
(13, 'Hepatitis ', 'Hepatitis ', 10.00, 1, 0, '2022-06-16 12:14:28', '2022-06-16 12:14:28'),
(14, 'IT ', 'hhh78', 10.00, 1, 0, '2022-08-15 03:11:13', '2022-08-15 03:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `service_transaction_list`
--

CREATE TABLE `service_transaction_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `client_name` text NOT NULL,
  `amount` float(15,2) NOT NULL DEFAULT 0.00,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `discount` decimal(10,2) NOT NULL,
  `cash_tendered` decimal(10,2) NOT NULL,
  `amount_due` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_transaction_list`
--

INSERT INTO `service_transaction_list` (`id`, `user_id`, `code`, `client_name`, `amount`, `date_created`, `date_updated`, `discount`, `cash_tendered`, `amount_due`, `balance`, `total`) VALUES
(1, 1, '2205130001', '###', 1301.00, '2022-05-13 18:09:25', '2022-05-13 18:32:54', '0.00', '1301.00', '0.00', '0.00', '1301.00'),
(2, 1, '2205130002', '###', 700.00, '2022-05-13 18:48:47', '2022-05-13 18:48:47', '0.00', '700.00', '0.00', '0.00', '700.00'),
(3, 1, '2205130003', '###', 1301.00, '2022-05-13 18:50:14', '2022-05-13 18:50:14', '0.00', '1301.00', '0.00', '0.00', '1301.00'),
(4, 1, '2205140001', '###', 1100.00, '2022-05-14 10:05:13', '2022-05-14 10:05:13', '0.00', '1100.00', '0.00', '0.00', '1100.00'),
(5, 1, '2205140002', '###', 700.00, '2022-05-14 11:10:33', '2022-05-14 11:10:33', '0.00', '700.00', '0.00', '0.00', '700.00'),
(6, 1, '2205140003', '###', 2650.00, '2022-05-14 20:24:44', '2022-05-14 20:24:44', '0.00', '2650.00', '0.00', '0.00', '2650.00'),
(7, 1, '2205150001', '###', 1.00, '2022-05-15 03:16:55', '2022-05-15 03:16:55', '0.00', '1.00', '0.00', '0.00', '1.00'),
(8, 1, '2205150002', '###', 700.00, '2022-05-15 15:20:34', '2022-05-15 15:20:34', '0.00', '700.00', '0.00', '0.00', '700.00'),
(9, 1, '2205150003', '', 0.00, '2022-05-15 23:18:56', '2022-05-15 23:18:56', '0.00', '0.00', '0.00', '0.00', '0.00'),
(10, 1, '2205150004', '###', 850.00, '2022-05-15 23:19:20', '2022-05-15 23:19:20', '0.00', '850.00', '0.00', '0.00', '850.00');

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `stockin_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(6) NOT NULL,
  `date_created` datetime NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `prod_exdate` varchar(50) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`stockin_id`, `prod_id`, `qty`, `date_created`, `supplier_id`, `prod_exdate`, `cost_price`, `id`) VALUES
(2212001, 3, 200, '0000-00-00 00:00:00', 0, '', '36.75', 7),
(2212001, 91, 1000, '0000-00-00 00:00:00', 0, '', '15.69', 8),
(2303001, 1, 20, '0000-00-00 00:00:00', 0, '', '51.84', 9),
(2303001, 3, 20, '0000-00-00 00:00:00', 0, '', '36.75', 10),
(2303002, 3, 30, '0000-00-00 00:00:00', 0, '', '50.75', 11),
(2303002, 2, 10, '0000-00-00 00:00:00', 0, '', '50.12', 12);

-- --------------------------------------------------------

--
-- Table structure for table `stockin_cart`
--

CREATE TABLE `stockin_cart` (
  `stockin_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(6) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `supplier_id` int(11) NOT NULL,
  `prod_exdate` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_list`
--

CREATE TABLE `stock_list` (
  `sid` varchar(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` decimal(10,2) NOT NULL,
  `user_id` int(10) NOT NULL,
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_list`
--

INSERT INTO `stock_list` (`sid`, `date_created`, `amount`, `user_id`, `id`, `supplier_id`, `invoice`) VALUES
('2212001', '2022-12-29 06:11:56', '23040.00', 1, 4, 13, '100'),
('2303001', '2023-03-16 08:43:42', '1771.80', 1, 5, 13, '9737'),
('2303002', '2023-03-21 11:26:22', '2023.70', 1, 6, 13, '0002');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_address` varchar(300) NOT NULL,
  `supplier_contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact`) VALUES
(13, 'UNICHEM GH LTD', 'Box Tamale - VITTING', '0244585591'),
(14, 'ERNEST CHEMIST LTD', 'BOX 1538 TAMALE', '0505824232'),
(15, 'BASELINE PHARMACY', 'CBG BUILDING', '020'),
(16, 'E B PHARMACY', 'OPP DHL OFFICE', '0243063256'),
(17, 'GOPENS PHARMACY ', 'KUMASI', '0266764625'),
(18, 'GINAPHARMA LTD', 'KANVILLE', '024'),
(19, 'PHARMANOVA GHANA LTD', 'TAMALE', '0245'),
(20, 'MEK PHARMACY LTD', 'LAMASHEGU-UDS ROAD', '0372028753'),
(21, 'DECENT PHARMACY', 'ADJ CENTRAL MOSQUE TML', '0558002546'),
(22, 'DOKULOKU PHARMACY', 'Bank of Africa Building, TAMALE', '0241081237'),
(23, 'TOBINCO PHARMAUEUTICALS', 'TAMALE', '024'),
(24, 'RICKY PHARMACY', 'OPP ACCESS BANK', '0208161286 / 0372023426'),
(25, 'INTRAVENOUS INFUSION', 'TTH Road', '0558208684'),
(26, 'PHILIPS PHAMACEUTICALS LTD', 'BOX ST 380, ACCRA', '0558754576'),
(27, 'ASGA ENTERPRISE', 'WATER WORKS ROAD', '0506677155'),
(28, 'MEGALIFE SCIENCES', '8 DZORWULU', '0201515060 /0202290084'),
(29, 'LANSAH CHEMIST', 'NEW TAFO , KUMASI', '0322029013'),
(30, 'KALAMED PHARMACY', 'TAMALE ,OPP POINT 7', '0546462489'),
(31, 'ENDSWELL PHARMACY', 'BOLGA', '0241853006'),
(32, 'ALLIANCE  HEALTH SERVICE', 'TAMALE', '0248358260');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Oy. Tech PHARM'),
(6, 'short_name', 'OY Tech. Pharm'),
(11, 'logo', 'uploads/logo-1660083108.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1660077546.png'),
(15, 'address', 'P. O. Box TL 2186 Tamale Opposite IK Photos.'),
(16, 'contact', 'SHOP:0559204730  CEO:0208162506');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_list`
--

CREATE TABLE `transaction_list` (
  `id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_tendered` decimal(10,2) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `client_id` varchar(50) NOT NULL,
  `discount` decimal(11,2) NOT NULL,
  `code` varchar(100) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp(),
  `amount` decimal(10,2) NOT NULL,
  `amount_due` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `type` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_list`
--

INSERT INTO `transaction_list` (`id`, `user_id`, `cash_tendered`, `balance`, `total`, `client_id`, `discount`, `code`, `date_created`, `date_updated`, `amount`, `amount_due`, `status`, `type`) VALUES
(2, 1, '86.00', '0.00', '86.00', '', '0.00', '2212280001', '2022-12-28 12:53:51', '2022-12-28 12:53:51', '86.00', '0.00', 1, 1),
(3, 1, '140.00', '0.00', '144.00', '', '4.00', '2212290001', '2022-12-29 05:39:05', '2022-12-29 05:39:05', '140.00', '0.00', 1, 1),
(4, 1, '5.00', '0.50', '4.50', '', '0.00', '2303160001', '2023-03-16 08:38:31', '2023-03-16 08:38:31', '4.50', '0.00', 1, 1),
(5, 1, '48.00', '0.00', '48.00', '48', '0.00', '2303160002', '2023-03-16 08:47:13', '2023-03-16 08:47:13', '48.00', '0.00', 1, 1),
(6, 1, '524.00', '0.00', '524.00', '', '0.00', '2303210001', '2023-03-21 08:53:26', '2023-03-21 08:53:26', '524.00', '0.00', 1, 1),
(7, 1, '110.00', '0.00', '110.00', '', '0.00', '2303210002', '2023-03-21 09:01:21', '2023-03-21 09:01:21', '110.00', '0.00', 1, 1),
(8, 1, '10.00', '0.00', '10.00', '', '0.00', '2303210003', '2023-03-21 17:08:50', '2023-03-21 17:08:50', '10.00', '0.00', 1, 1),
(9, 1, '82.00', '0.00', '82.00', '', '0.00', '2303210004', '2023-03-21 17:10:20', '2023-03-21 17:10:20', '82.00', '0.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_products`
--

CREATE TABLE `transaction_products` (
  `id` int(100) NOT NULL,
  `transaction_id` varchar(30) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_products`
--

INSERT INTO `transaction_products` (`id`, `transaction_id`, `product_id`, `price`, `qty`, `cost_price`) VALUES
(1, '1', 3, '48.00', 1, '36.75'),
(2, '1', 5, '118.00', 2, '89.78'),
(3, '2', 6, '48.00', 1, '35.54'),
(4, '2', 265, '38.00', 1, '28.00'),
(5, '3', 3, '48.00', 1, '36.75'),
(6, '3', 6, '48.00', 2, '35.54'),
(7, '4', 105, '3.00', 1, '2.20'),
(8, '4', 108, '1.50', 1, '0.85'),
(9, '5', 3, '48.00', 1, '36.75'),
(10, '6', 3, '48.00', 5, '36.75'),
(11, '6', 5, '118.00', 2, '89.78'),
(12, '6', 6, '48.00', 1, '35.54'),
(13, '7', 3, '55.00', 2, '50.75'),
(14, '8', 133, '2.00', 2, '1.38'),
(15, '8', 135, '1.00', 2, '0.50'),
(16, '8', 137, '2.00', 2, '0.86'),
(17, '9', 3, '55.00', 1, '50.75'),
(18, '9', 420, '27.00', 1, '20.80');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_services`
--

CREATE TABLE `transaction_services` (
  `id` int(11) NOT NULL,
  `transaction_id` int(30) NOT NULL,
  `service_id` int(30) NOT NULL,
  `price` float(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_services`
--

INSERT INTO `transaction_services` (`id`, `transaction_id`, `service_id`, `price`) VALUES
(21, 117, 2, 0.00),
(22, 117, 4, 0.00),
(23, 117, 5, 0.00),
(24, 118, 4, 0.00),
(25, 118, 5, 0.00),
(26, 119, 4, 0.00),
(27, 119, 5, 0.00),
(28, 119, 3, 0.00),
(29, 120, 4, 0.00),
(30, 120, 6, 0.00),
(31, 122, 3, 0.00),
(32, 122, 2, 0.00),
(33, 123, 5, 0.00),
(34, 124, 4, 0.00),
(35, 125, 2, 0.00),
(36, 126, 4, 0.00),
(37, 126, 5, 0.00),
(38, 126, 3, 0.00),
(39, 127, 4, 0.00),
(40, 127, 5, 0.00),
(41, 128, 3, 0.00),
(42, 128, 4, 0.00),
(43, 128, 1, 0.00),
(44, 130, 2, 0.00),
(45, 130, 1, 0.00),
(46, 130, 4, 0.00),
(47, 131, 3, 0.00),
(48, 131, 5, 0.00),
(49, 131, 6, 0.00),
(50, 132, 3, 0.00),
(51, 132, 5, 0.00),
(52, 132, 6, 0.00),
(53, 134, 2, 0.00),
(54, 134, 5, 0.00),
(55, 135, 4, 0.00),
(56, 136, 1, 0.00),
(57, 136, 3, 0.00),
(58, 137, 4, 0.00),
(59, 137, 5, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_created`, `date_updated`) VALUES
(1, 'Yahaya', 'Osman', 'admin', '5136b96817648b5b81008f6a984284a7', 'uploads/avatars/1.png?v=1652954167', NULL, 1, '2021-01-20 14:02:37', '2022-12-28 12:51:06'),
(2, 'Yahaya', 'Wunam', 'user', '2a33a3553c5eb270ef8539bad6cb85d9', NULL, NULL, 2, '2022-08-08 13:00:23', '2022-12-28 12:51:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `depositor`
--
ALTER TABLE `depositor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `service_cart`
--
ALTER TABLE `service_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_transaction_list`
--
ALTER TABLE `service_transaction_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockin_cart`
--
ALTER TABLE `stockin_cart`
  ADD PRIMARY KEY (`stockin_id`);

--
-- Indexes for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `transaction_list`
--
ALTER TABLE `transaction_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_products`
--
ALTER TABLE `transaction_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_services`
--
ALTER TABLE `transaction_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `depositor`
--
ALTER TABLE `depositor`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=792;

--
-- AUTO_INCREMENT for table `service_cart`
--
ALTER TABLE `service_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `service_transaction_list`
--
ALTER TABLE `service_transaction_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stockin_cart`
--
ALTER TABLE `stockin_cart`
  MODIFY `stockin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_list`
--
ALTER TABLE `transaction_list`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaction_products`
--
ALTER TABLE `transaction_products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction_services`
--
ALTER TABLE `transaction_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction_services`
--
ALTER TABLE `transaction_services`
  ADD CONSTRAINT `service_id_fk_ts` FOREIGN KEY (`service_id`) REFERENCES `service_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
