-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 23, 2016 at 05:34 PM
-- Server version: 5.5.48-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imejpark_ipops_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `rec_invoice_items`
--

CREATE TABLE IF NOT EXISTS `rec_invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `site_name` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `or_number` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `bank_details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clamp_date` date NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=88 ;

--
-- Dumping data for table `rec_invoice_items`
--

INSERT INTO `rec_invoice_items` (`id`, `item_name`, `invoice_id`, `amount`, `site_name`, `or_number`, `bank_details`, `clamp_date`, `date_created`) VALUES
(28, 'Bay Rental ( 1 DAY ) RM20 X 14', 20, 280, 'Southgate Commercial Centre', '', '', '1970-01-01', '2015-12-29'),
(29, 'Bay Rental ( 1 DAY ) RM20 X 12', 21, 240, 'Southgate Commercial Centre', '', '', '0000-00-00', '2015-12-29'),
(27, 'Claim Back', 19, 1220, 'Presint Alami', '', '', '0000-00-00', '2015-12-28'),
(26, 'Claim Back', 19, 955, 'Presint Alami', '', '', '0000-00-00', '2015-12-28'),
(30, 'Visitor ', 22, 671, '', '', '', '1970-01-01', '2016-01-06'),
(36, 'CLAIMED BACK', 26, 136, '', '', '', '1970-01-01', '2016-01-18'),
(34, 'CLAIMED BACK (IPSB7014)', 25, 1253, 'Presint Alami', '', '', '0000-00-00', '2016-01-15'),
(35, 'CLAIMED BACK (IPSB7017)', 25, 2484, 'Presint Alami', '', '', '0000-00-00', '2016-01-15'),
(64, 'SIGNAGE', 44, 636, 'Menara PKNS PJ', '', '', '1970-01-01', '2016-03-10'),
(38, 'Visitor ', 28, 348, '', '', '', '1970-01-01', '2016-01-22'),
(39, 'TS10304', 29, 3604, '', '', '', '1970-01-01', '2016-01-27'),
(40, 'TS10305', 29, 2862, '', '', '', '1970-01-01', '2016-01-27'),
(41, 'CLAMPING', 30, 50, 'Menara Yayasan Tun Razak', '641033', '', '2016-01-20', '2016-02-03'),
(42, 'CLAMPING', 31, 50, 'Menara Yayasan Tun Razak', '636732', '', '2016-01-27', '2016-02-09'),
(43, 'CLAMPING', 31, 50, 'Menara Yayasan Tun Razak', '636732', '', '2016-01-27', '2016-02-09'),
(44, 'CLAIM BACK PARKING FACILITY ON 19th JANUARY 2016', 32, 40, '', '', '', '0000-00-00', '2016-02-11'),
(45, 'CLAIM BACK PARKING FACILITY ON 20th JANUARY 2016', 32, 272, '', '', '', '0000-00-00', '2016-02-11'),
(46, 'CLAMPING', 33, 50, 'Menara Yayasan Tun Razak', '627022', '', '2016-01-30', '2016-02-11'),
(47, 'CLAMPING', 33, 50, 'Menara Yayasan Tun Razak', '627023', '', '2016-01-30', '2016-02-11'),
(48, 'CLAMPING', 33, 50, 'Menara Yayasan Tun Razak', '627024', '', '2016-01-30', '2016-02-11'),
(49, 'CLAMPING', 33, 50, 'Menara Yayasan Tun Razak', '627025', '', '2016-01-30', '2016-02-11'),
(50, '1 PARKING LOT / DAY ( RESERVED )', 34, 20, '', '', '', '1970-01-01', '2016-02-11'),
(51, 'Visitor', 35, 628.5, '', '', '', '1970-01-01', '2016-02-19'),
(66, 'New Parking Buy', 45, 159, 'Menara Worldwide Bukit Bintang', '', '', '1970-01-01', '2016-03-10'),
(65, 'New Parking Buy', 45, 159, 'Menara Worldwide Bukit Bintang', '', '', '1970-01-01', '2016-03-10'),
(52, 'CLAMPING', 36, 50, 'Menara Yayasan Tun Razak', '636734', '', '2016-02-02', '2016-03-02'),
(53, 'CLAMPING', 36, 50, 'Menara Yayasan Tun Razak', '636735', '', '2016-02-02', '2016-03-02'),
(54, 'CLAMPING', 37, 20, 'Menara Yayasan Tun Razak', '636741', '', '2016-02-04', '2016-03-02'),
(55, 'CLAMPING', 37, 20, 'Menara Yayasan Tun Razak', '636742', '', '2016-02-04', '2016-03-02'),
(56, 'CLAMPING', 37, 30, 'Menara Yayasan Tun Razak', '636743', '', '2016-02-04', '2016-03-02'),
(57, 'CLAMPING', 37, 50, 'Menara Yayasan Tun Razak', '645650', '', '2016-02-04', '2016-03-02'),
(58, 'CLAMPING', 38, 50, 'Menara Yayasan Tun Razak', '636744', '', '2016-02-05', '2016-03-02'),
(59, 'CLAMPING', 39, 10, 'Menara Yayasan Tun Razak', '636745', '', '2016-02-11', '2016-03-02'),
(60, 'CLAMPING', 40, 30, 'Menara Yayasan Tun Razak', '636747', '', '2016-02-18', '2016-03-02'),
(61, 'CLAMPING', 41, 30, 'Menara Yayasan Tun Razak', '636746', '', '2016-02-19', '2016-03-02'),
(62, 'SIGNAGE', 42, 636, 'Menara PKNS PJ', '', '', '1970-01-01', '2016-03-03'),
(63, 'CLAIM BACK', 43, 628.5, '', '', '', '1970-01-01', '2016-03-07'),
(67, 'New Parking Buy', 45, 159, 'Menara Worldwide Bukit Bintang', '', '', '1970-01-01', '2016-03-10'),
(68, 'New Parking Buy', 45, 159, 'Menara Worldwide Bukit Bintang', '', '', '1970-01-01', '2016-03-10'),
(69, 'Passcard Deposit', 45, 50, 'Menara Worldwide Bukit Bintang', '', '', '1970-01-01', '2016-03-10'),
(70, 'Passcard Deposit', 45, 50, 'Menara Worldwide Bukit Bintang', '', '', '1970-01-01', '2016-03-10'),
(71, 'Passcard Deposit', 45, 50, 'Menara Worldwide Bukit Bintang', '', '', '1970-01-01', '2016-03-10'),
(72, 'Key', 45, 50, 'Menara Worldwide Bukit Bintang', '', '', '1970-01-01', '2016-03-10'),
(73, 'Plate Number', 45, 20, 'Menara Worldwide Bukit Bintang', '', '', '1970-01-01', '2016-03-10'),
(74, 'CLAMPING', 46, 50, 'Menara Yayasan Tun Razak', '645602', '', '2016-02-24', '2016-03-10'),
(75, 'CLAMPING', 46, 30, 'Menara Yayasan Tun Razak', '645603', '', '2016-02-24', '2016-03-10'),
(77, 'CLAMPING', 48, 30, 'Menara Yayasan Tun Razak', '645604', '', '2016-02-26', '2016-03-22'),
(78, 'CLAMPING', 48, 30, 'Menara Yayasan Tun Razak', '645605', '', '2016-02-26', '2016-03-22'),
(79, 'CLAMPING', 48, 50, 'Menara Yayasan Tun Razak', '645606', '', '2016-02-26', '2016-03-22'),
(80, 'CLAMPING', 48, 50, 'Menara Yayasan Tun Razak', '645607', '', '2016-02-26', '2016-03-22'),
(81, 'CLAMPING', 48, 30, 'Menara Yayasan Tun Razak', '645608', '', '2016-02-26', '2016-03-22'),
(87, 'GH1', 51, 56, '205', '45', 'y', '2016-03-28', '2016-03-23'),
(86, 'TY1', 51, 36, '205', '34', 'VB', '2016-03-28', '2016-03-23');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
