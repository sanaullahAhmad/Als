-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 20, 2016 at 08:45 PM
-- Server version: 5.5.49-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alscom_als`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `access_level` int(10) NOT NULL,
  `email` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `verify_code` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `register_on` date NOT NULL,
  `last_login` date NOT NULL,
  `last_login_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `forgot_pass_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `password`, `access_level`, `email`, `verify_code`, `register_on`, `last_login`, `last_login_ip`, `status`, `forgot_pass_count`) VALUES
(3, 'Ronnie Admin', '82cc921c6a5c6707e1d6e6862ba3201a', 1, 'ronnie@getranked.com.my', '82291442b9b2fa9405594ffccc0bdfcc', '2016-03-09', '2016-05-16', '202.129.163.230', 1, 5),
(4, 'Marrcuss Lim', 'ba73050e7933fa354d506da83c00f12b', 1, 'marrcuss.lim@gmail.com', '3a859dbe469596bb17f19268bd9885f7', '2016-03-18', '2016-05-20', '103.26.249.252', 1, 0),
(19, 'sanatest', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'sana@getranked.com.my', '83dfd1cb85018ba979f8c753c965e967', '2016-03-21', '2016-05-16', '39.32.20.87', 1, 12),
(25, 'Dani Admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'dani@getranked.com.my', 'b520c1671a52cc93ddc9d8cc73ad5be5', '2016-04-03', '2016-04-03', '203.106.189.194', 1, 0),
(27, 'Muhammad Qureshi', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'muhammad@getranked.com.my', '5e9dee17d84d5133bb6c9744f8b79253', '2016-04-05', '2016-05-04', '202.129.163.230', 1, 2),
(28, 'sanakust', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'sanakust@yahoo.com', '49c5dad110cc1ee6de181f79122c6859', '2016-04-05', '0000-00-00', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `adverts`
--

CREATE TABLE IF NOT EXISTS `adverts` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `title` varchar(155) NOT NULL,
  `advert_by` int(11) NOT NULL,
  `image_url` varchar(155) NOT NULL,
  `ad_link` varchar(155) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_date_time` datetime NOT NULL,
  `condo_id` int(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `adverts`
--

INSERT INTO `adverts` (`id`, `title`, `advert_by`, `image_url`, `ad_link`, `payment_status`, `payment_date_time`, `condo_id`, `status`) VALUES
(8, 'this is title 4', 73, 'no-profile-img-240x3001.gif', 'http://www.bng.com5', 1, '2016-04-21 19:55:01', 44, 0),
(7, 'this is title 3', 73, 'chair31.jpg', 'http://www.msn.com', 1, '2016-04-21 19:50:41', 44, 0),
(5, 'this is title 5', 73, 'no-profile-img-240x300.gif', 'http://www.bng.com5', 1, '2016-04-21 19:44:52', 44, 0),
(6, 'this is title 2', 73, 'chair2.jpg', 'http://www.yahoo.com', 1, '2016-04-21 19:49:32', 44, 0),
(9, 'this is title 5', 73, 'chair32.jpg', 'http://www.bng.com5', 1, '2016-04-21 19:56:52', 44, 0),
(10, 'this is title 2', 73, 'portriat.jpg', 'ererer', 0, '0000-00-00 00:00:00', 0, 0),
(11, 'Ad 1', 73, 'cengal.jpg', 'google.com', 1, '2016-04-22 14:21:35', 0, 0),
(12, 'Ad today', 73, 'alpha_care.jpg', 'google.com', 1, '2016-04-25 18:18:02', 0, 0),
(13, 'Ad Today', 73, 'apply.jpg', 'google.com', 1, '2016-04-27 17:32:33', 0, 0),
(14, 'sanatest advertizment', 73, 'portriat1.jpg', 'www.yahoo.com', 0, '0000-00-00 00:00:00', 0, 0),
(15, 'sanatest advertizment', 73, 'portriat2.jpg', 'www.yahoo.com', 1, '2016-04-27 20:11:03', 0, 0),
(18, 'Highcharts Demo', 73, '32634-12.png', 'LP', 1, '2016-04-27 23:57:07', 44, 0),
(19, 'Laptops', 73, '8-Benefits-Of-Good-Web-Design-810x608.jpg', 'www.als.com.my', 1, '2016-04-28 13:47:09', 44, 0),
(20, 'this is title 2', 73, 'portriat6.jpg', 'www.yahoo.com', 1, '2016-04-28 21:10:16', 54, 1),
(21, 'this is title of advertisement', 73, 'chair35.jpg', 'http://www.msn.com', 0, '0000-00-00 00:00:00', 54, 3),
(22, 'this is testing', 73, 'fixing2.jpg', 'http://www.msn.com', 1, '2016-05-03 19:44:15', 54, 1),
(23, 'example', 73, 'chair33.jpg', 'www.example.com', 1, '2016-05-02 18:18:56', 54, 1),
(24, 'this is title 3', 73, 'fixing4.jpg', 'http://www.bng.com5', 0, '0000-00-00 00:00:00', 54, 1),
(25, 'testt617', 73, 'portriat4.jpg', '617.gmail.com', 0, '0000-00-00 00:00:00', 54, 1),
(26, 'sdfsdf', 73, 'portriat5.jpg', 'dfsdf', 0, '0000-00-00 00:00:00', 54, 0),
(27, 'sdfsdf', 73, 'portriat5.jpg', 'dfsdf', 0, '0000-00-00 00:00:00', 54, 0),
(28, 'sdfsdf', 73, 'portriat5.jpg', 'dfsdf', 0, '0000-00-00 00:00:00', 54, 0),
(29, 'sdfsdf', 73, 'portriat5.jpg', 'dfsdf', 0, '0000-00-00 00:00:00', 54, 1),
(30, 'sdfsdf', 73, 'portriat5.jpg', 'dfsdf', 1, '2016-05-03 20:22:54', 54, 1),
(31, 'sdfsdf', 73, 'portriat5.jpg', 'dfsdf', 1, '2016-05-03 19:57:58', 54, 1),
(32, 'this is title 5', 73, 'portriat5.jpg', 'http://www.bng.com5', 1, '2016-05-03 19:55:20', 54, 1),
(33, 'Testing manager approval', 78, 'cengal2.jpg', 'google.com', 0, '0000-00-00 00:00:00', 44, 3),
(34, 'Testing manager approval', 78, 'construction.jpg', 'google.com', 0, '0000-00-00 00:00:00', 44, 1),
(35, 'Art for Sale', 78, 'adimage.jpg', 'google.com', 1, '2016-05-05 19:09:13', 44, 1),
(36, 'Website ', 92, '3_(1).jpg', 'www.als.com.my', 0, '0000-00-00 00:00:00', 59, 1),
(37, 'New Ad', 78, 'Lighthouse.jpg', '', 0, '2016-05-10 18:22:47', 44, 1),
(41, 'Laptops', 78, 'Business-team.jpg', '', 1, '2016-05-11 19:29:11', 44, 1),
(39, 'test advertisment of bilal', 95, '0', '', 0, '0000-00-00 00:00:00', 54, 1),
(40, 'Car for sale ', 92, 'security_company_website_designers1.jpg', '', 1, '2016-05-11 16:48:44', 59, 1),
(42, 'Parking Space for Rent (RM150 per month)', 90, 'Parking_Space2.jpeg', '', 0, '0000-00-00 00:00:00', 50, 1),
(43, 'Parking Space For Rent 2', 90, 'Parking_Space21.jpeg', '', 0, '0000-00-00 00:00:00', 50, 1),
(44, 'Car for sale', 78, 'car.jpg', '', 0, '0000-00-00 00:00:00', 44, 0);

-- --------------------------------------------------------

--
-- Table structure for table `adverts_images`
--

CREATE TABLE IF NOT EXISTS `adverts_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `advert_id` int(10) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=126 ;

--
-- Dumping data for table `adverts_images`
--

INSERT INTO `adverts_images` (`id`, `advert_id`, `image_url`) VALUES
(1, 15, 'chair12.JPG'),
(2, 15, 'chair21.jpg'),
(3, 15, 'chair33.jpg'),
(4, 15, 'chair22.jpg'),
(12, 19, '5.jpg'),
(10, 36, '4mobile_responsivedesign_-_Copy.jpg'),
(11, 19, '4mobile_responsivedesign.jpg'),
(9, 18, '1106271124pyramid11.jpg'),
(13, 36, '34.jpg'),
(14, 0, 'portriat3.jpg'),
(15, 0, 'portriat4.jpg'),
(16, 0, 'no-profile-img-240x3002.gif'),
(17, 0, 'portriat5.jpg'),
(18, 0, 'portriat6.jpg'),
(19, 20, 'chair13.JPG'),
(20, 20, 'chair23.jpg'),
(21, 20, 'chair34.jpg'),
(22, 20, 'fixing1.jpg'),
(23, 0, 'chair35.jpg'),
(24, 21, 'chair14.JPG'),
(25, 21, 'chair24.jpg'),
(26, 0, 'fixing2.jpg'),
(27, 22, 'chair15.JPG'),
(28, 22, 'chair25.jpg'),
(29, 22, 'chair36.jpg'),
(30, 0, '32634-13.png'),
(31, 0, '1106271124pyramid12.jpg'),
(32, 0, 'chair37.jpg'),
(33, 0, 'chair33.jpg'),
(34, 23, 'chair12.JPG'),
(35, 23, 'chair21.jpg'),
(36, 23, 'fixing1.jpg'),
(37, 0, 'codeigniter-development.png'),
(38, 0, 'fixing3.jpg'),
(39, 0, 'portriat1.jpg'),
(40, 0, '26.png'),
(41, 0, '29.png'),
(42, 0, 'chair34.jpg'),
(43, 0, 'Hydrangeas.jpg'),
(44, 0, 'Chrysanthemum.jpg'),
(45, 0, 'chair35.jpg'),
(46, 0, 'portriat9_thumb.jpg'),
(47, 0, 'portriat16_200_200.jpg'),
(48, 0, 'Tulips.jpg'),
(49, 0, 'Jellyfish.jpg'),
(50, 0, 'portriat2.jpg'),
(51, 0, 'chair13.JPG'),
(52, 0, 'chair22.jpg'),
(53, 0, 'chair36.jpg'),
(54, 0, 'chair14.JPG'),
(55, 0, 'chair23.jpg'),
(56, 0, 'chair37.jpg'),
(57, 0, 'chair15.JPG'),
(58, 0, 'chair24.jpg'),
(59, 0, 'chair38.jpg'),
(60, 0, 'portriat3.jpg'),
(61, 0, 'fixing4.jpg'),
(62, 0, 'chair16.JPG'),
(63, 0, 'chair25.jpg'),
(64, 0, 'chair39.jpg'),
(65, 0, 'no-image1.jpg'),
(66, 0, 'chair17.JPG'),
(67, 0, 'chair26.jpg'),
(68, 0, 'chair310.jpg'),
(69, 0, 'fixing5.jpg'),
(70, 0, 'portriat4.jpg'),
(71, 25, 'chair18.JPG'),
(72, 25, 'chair27.jpg'),
(73, 25, 'chair311.jpg'),
(74, 25, 'fixing6.jpg'),
(75, 31, 'chair19.JPG'),
(76, 31, 'chair28.jpg'),
(77, 31, 'chair312.jpg'),
(78, 31, 'fixing7.jpg'),
(79, 0, 'portriat5.jpg'),
(80, 32, 'chair110.JPG'),
(81, 32, 'chair29.jpg'),
(82, 32, 'chair313.jpg'),
(83, 32, 'fixing8.jpg'),
(84, 0, 'cengal1.jpg'),
(85, 0, 'alpha_care1.jpg'),
(86, 0, 'alpha_care__Mockup.jpg'),
(87, 0, 'alpha2.jpg'),
(88, 0, 'cengal2.jpg'),
(89, 0, 'construction.jpg'),
(90, 34, 'Chrysanthemum1.jpg'),
(91, 34, 'Desert.jpg'),
(92, 0, 'adimage.jpg'),
(93, 0, 'chair210.jpg'),
(94, 0, 'chair111.JPG'),
(95, 0, 'chair211.jpg'),
(96, 0, 'chair314.jpg'),
(97, 0, 'fixing9.jpg'),
(98, 0, '3_(1).jpg'),
(99, 36, '4mobile_responsivedesign_-_Copy.jpg'),
(100, 36, '18bg.jpg'),
(101, 36, '34.jpg'),
(102, 36, 'beau-background-2.jpg'),
(103, 0, 'Lighthouse.jpg'),
(104, 37, 'Koala.jpg'),
(105, 0, 'maps.JPG'),
(106, 0, 'no-image2.jpg'),
(107, 0, 'security_company_website_designers1.jpg'),
(108, 40, '341.jpg'),
(109, 0, 'Business-team.jpg'),
(110, 41, '6bcbd105cd1f89af3fef020d8ac7034d.jpg'),
(111, 41, 'CMC.jpg'),
(112, 41, 'Coffee-Store.jpg'),
(113, 41, 'const3.jpg'),
(114, 0, 'Parking_Space.jpg'),
(115, 0, 'Parking_Space2.jpeg'),
(116, 42, 'Parking_Space1.jpg'),
(117, 0, 'Parking_Space21.jpeg'),
(118, 43, 'Parking_Space2.jpg'),
(119, 0, 'Parking_Space22.jpeg'),
(120, 0, 'OM_Sauna.jpg'),
(121, 0, 'Parking_Space3.jpg'),
(122, 0, 'Parking_Space23.jpeg'),
(123, 0, '20150823_151053.jpg'),
(124, 0, 'car.jpg'),
(125, 44, 'car2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(155) NOT NULL,
  `state_id` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=600 ;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `state_id`) VALUES
(1, 'Ampang', 1),
(2, 'Ampang Hilir', 1),
(3, 'Bandar Damai Perdana', 1),
(4, 'Bandar Menjalara', 1),
(5, 'Bandar Sri Damansara', 1),
(6, 'Bandar Tasik Selatan', 1),
(7, 'Bangsar', 1),
(8, 'Bangsar South', 1),
(9, 'Batu', 1),
(10, 'Brickfields', 1),
(11, 'Bukit Bintang', 1),
(12, 'Bukit Jalil', 1),
(13, 'Bukit Ledang', 1),
(14, 'Bukit Tunku', 1),
(15, 'Chan Sow Lin', 1),
(16, 'Cheras', 1),
(17, 'City Centre', 1),
(18, 'Country Heights Damansara', 1),
(19, 'Damansara', 1),
(20, 'Damansara Heights', 1),
(21, 'Desa Pandan', 1),
(22, 'Desa ParkCity', 1),
(23, 'Desa Petaling', 1),
(24, 'Federal Hill', 1),
(25, 'Gombak', 1),
(26, 'Jalan Ipoh', 1),
(27, 'Jalan Klang Lama', 1),
(28, 'Jalan Kuching', 1),
(29, 'Jalan Sultan Ismail', 1),
(30, 'Jinjang', 1),
(31, 'Kenny Hills', 1),
(32, 'Kepong', 1),
(33, 'Keramat', 1),
(34, 'KL City', 1),
(35, 'KL Sentral', 1),
(36, 'KLCC', 1),
(37, 'Kuchai Lama', 1),
(38, 'Mid Valley City', 1),
(39, 'Mont Kiara', 1),
(40, 'Old Klang Road', 1),
(41, 'OUG', 1),
(42, 'Pandan Indah', 1),
(43, 'Pandan Jaya', 1),
(44, 'Pandan Perdana', 1),
(45, 'Pantai', 1),
(46, 'Pekan Batu', 1),
(47, 'Puchong', 1),
(48, 'Salak Selatan', 1),
(49, 'Segambut', 1),
(50, 'Sentul', 1),
(51, 'Seputeh', 1),
(52, 'Serdang', 1),
(53, 'Setapak', 1),
(54, 'Setiawangsa', 1),
(55, 'Solaris Dutamas', 1),
(56, 'Solaris Mont Kiara', 1),
(57, 'Sri Hartamas', 1),
(58, 'Sri Petaling', 1),
(59, 'Sunway SPK', 1),
(60, 'Sungai Besi', 1),
(61, 'Sungai Penchala', 1),
(62, 'Taman Desa', 1),
(63, 'Taman Duta', 1),
(64, 'Taman Melawati', 1),
(65, 'Taman Tun Dr Ismail', 1),
(66, 'Titiwangsa', 1),
(67, 'Wangsa Maju', 1),
(68, 'Ayer Baloi', 2),
(69, 'Ayer Hitam', 2),
(70, 'Bakri', 2),
(71, 'Batu Anam', 2),
(72, 'Batu Pahat', 2),
(73, 'Bekok', 2),
(74, 'Benut', 2),
(75, 'Bukit Gambir', 2),
(76, 'Bukit Pasir', 2),
(77, 'Chaah', 2),
(78, 'Endau', 2),
(79, 'Gelang Patah', 2),
(80, 'Gerisek', 2),
(81, 'Gugusan Taib Andak', 2),
(82, 'Horizon Hills', 2),
(83, 'Jementah', 2),
(84, 'Johor Bahru', 2),
(85, 'Kahang', 2),
(86, 'Kampung Kenangan Tun Dr Ismail', 2),
(87, 'Kluang', 2),
(88, 'Kota Tinggi', 2),
(89, 'Kukup', 2),
(90, 'Kulai', 2),
(91, 'Labis', 2),
(92, 'Layang Layang', 2),
(93, 'Masai', 2),
(94, 'Medini', 2),
(95, 'Mersing', 2),
(96, 'Muar', 2),
(97, 'Nusajaya', 2),
(98, 'Pagoh', 2),
(99, 'Paloh', 2),
(100, 'Panchor', 2),
(101, 'Parit Jawa', 2),
(102, 'Parit Raja', 2),
(103, 'Parit Sulong', 2),
(104, 'Pasir Gudang', 2),
(105, 'Pekan Nanas', 2),
(106, 'Pengerang', 2),
(107, 'Permas Jaya', 2),
(108, 'Plentong', 2),
(109, 'Pontian', 2),
(110, 'Puteri Harbour', 2),
(111, 'Rengam', 2),
(112, 'Rengit', 2),
(113, 'Segamat', 2),
(114, 'Semerah', 2),
(115, 'Senai', 2),
(116, 'Senggarang', 2),
(117, 'Senibong', 2),
(118, 'Seri Gadang', 2),
(119, 'Setia Indah', 2),
(120, 'Setia Tropika', 2),
(121, 'Simpang Rengam', 2),
(122, 'Skudai', 2),
(123, 'Sungai Mati', 2),
(124, 'Tampoi', 2),
(125, 'Tangkak', 2),
(126, 'Ulu Tiram', 2),
(127, 'Yong Peng', 2),
(128, 'Alor Setar', 3),
(129, 'Baling', 3),
(130, 'Bandar Baharu', 3),
(131, 'Bedong', 3),
(132, 'Bukit Kayu Hitam', 3),
(133, 'Guar Chempedak', 3),
(134, 'Gurun', 3),
(135, 'Jitra', 3),
(136, 'Karangan', 3),
(137, 'Kepala Batas', 3),
(138, 'Kodiang', 3),
(139, 'Kota Sarang Semut', 3),
(140, 'Kuala Kedah', 3),
(141, 'Kuala Ketil', 3),
(142, 'Kuala Muda', 3),
(143, 'Kuala Nerang', 3),
(144, 'Kubang Pasu', 3),
(145, 'Kulim', 3),
(146, 'Kupang', 3),
(147, 'Langgar', 3),
(148, 'Langkawi', 3),
(149, 'Lunas', 3),
(150, 'Merbok', 3),
(151, 'Padang Serai', 3),
(152, 'Padang Terap', 3),
(153, 'Pendang', 3),
(154, 'Pokok Sena', 3),
(155, 'Pulau Langkawi', 3),
(156, 'Sik', 3),
(157, 'Simpang Empat', 3),
(158, 'Sungai Petani', 3),
(159, 'Univesity Utara', 3),
(160, 'Yan', 3),
(161, 'Ayer Lanas', 4),
(162, 'Bachok', 4),
(163, 'Cherang Ruku', 4),
(164, 'Dabong', 4),
(165, 'Gua Musang', 4),
(166, 'Jeli', 4),
(167, 'Kem Desa Pahwalan', 4),
(168, 'Ketereh', 4),
(169, 'Kota Bharu', 4),
(170, 'Kuala Balah', 4),
(171, 'Kuala Kerai', 4),
(172, 'Machang', 4),
(173, 'Melor', 4),
(174, 'Pasir Mas', 4),
(175, 'Pasir Puteh', 4),
(176, 'Pulai Chondong', 4),
(177, 'Rantau Panjang', 4),
(178, 'Selising', 4),
(179, 'Tanah Merah', 4),
(180, 'Tawang', 4),
(181, 'Temangan', 4),
(182, 'Tumpat', 4),
(183, 'Wakaf Baru', 4),
(184, 'Alor Gajah', 5),
(185, 'Asahan', 5),
(186, 'Ayer Keroh', 5),
(187, 'Bandar Hilir', 5),
(188, 'Batu Berendam', 5),
(189, 'Bemban', 5),
(190, 'Bukit Beruang', 5),
(191, 'Durian Tunggal', 5),
(192, 'Jasin', 5),
(193, 'Kuala Linggi', 5),
(194, 'Kuala Sungai Baru', 5),
(195, 'Lubok China', 5),
(196, 'Masjid Tanah', 5),
(197, 'Melaka Tengah', 5),
(198, 'Merlimau', 5),
(199, 'Selandar', 5),
(200, 'Sungai Rambai', 5),
(201, 'Sungai Udang', 5),
(202, 'Tanjong Kling', 5),
(203, 'Ujong Pasir', 5),
(204, 'Bahau', 6),
(205, 'Bandar Baru Serting', 6),
(206, 'Batang Melaka', 6),
(207, 'Batu Kikir', 6),
(208, 'Gemas', 6),
(209, 'Gemencheh', 6),
(210, 'Jelebu', 6),
(211, 'Jempol', 6),
(212, 'Johol', 6),
(213, 'Juasseh', 6),
(214, 'Kota', 6),
(215, 'Kuala Klawang', 6),
(216, 'Kuala Pilah', 6),
(217, 'Labu', 6),
(218, 'Lenggeng', 6),
(219, 'Linggi', 6),
(220, 'Mantin', 6),
(221, 'Nilai', 6),
(222, 'Pasir Panjang', 6),
(223, 'Pedas', 6),
(224, 'Port Dickson', 6),
(225, 'Rantau', 6),
(226, 'Rembau', 6),
(227, 'Rompin', 6),
(228, 'Senawang', 6),
(229, 'Seremban', 6),
(230, 'Siliau', 6),
(231, 'Simpang Durian', 6),
(232, 'Simpang Pertang', 6),
(233, 'Sri Menanti', 6),
(234, 'Sri Rusa', 6),
(235, 'Tampin', 6),
(236, 'Tanjong Ipoh', 6),
(237, 'Balok', 7),
(238, 'Bandar Pusat Jengka', 7),
(239, 'Bandar Tun Abdul Razak', 7),
(240, 'Benta', 7),
(241, 'Bentong', 7),
(242, 'Bera', 7),
(243, 'Brinchang', 7),
(244, 'Bukit Fraser', 7),
(245, 'Cameron Highlands', 7),
(246, 'Chenor', 7),
(247, 'Daerah Rompin', 7),
(248, 'Damak', 7),
(249, 'Dong', 7),
(250, 'Genting Highlands', 7),
(251, 'Jerantut', 7),
(252, 'Karak', 7),
(253, 'Kuala Lipis', 7),
(254, 'Kuala Rompin', 7),
(255, 'Kuantan', 7),
(256, 'Lanchang', 7),
(257, 'Lurah Bilut', 7),
(258, 'Maran', 7),
(259, 'Mengkarak', 7),
(260, 'Mentakab', 7),
(261, 'Muadzam Shah', 7),
(262, 'Padang Tengku', 7),
(263, 'Pekan', 7),
(264, 'Raub', 7),
(265, 'Ringlet', 7),
(266, 'Sega', 7),
(267, 'Sungai Koyan', 7),
(268, 'Sungai Lembing', 7),
(269, 'Sungai Ruan', 7),
(270, 'Tanah Rata', 7),
(271, 'Temerloh', 7),
(272, 'Triang', 7),
(273, 'Air Tawar', 8),
(274, 'Alma', 8),
(275, 'Ayer Itam', 8),
(276, 'Bagan Ajam', 8),
(277, 'Bagan Jermal', 8),
(278, 'Bagan Lallang', 8),
(279, 'Balik Pulau', 8),
(280, 'Bandar Perda', 8),
(281, 'Batu Ferringhi', 8),
(282, 'Batu Kawan', 8),
(283, 'Batu Maung', 8),
(284, 'Batu Uban', 8),
(285, 'Bayan Baru', 8),
(286, 'Bayan Lepas', 8),
(287, 'Berapit', 8),
(288, 'Bertam', 8),
(289, 'Bukit Dumbar', 8),
(290, 'Bukit Jambul', 8),
(291, 'Bukit Mertajam', 8),
(292, 'Bukit Minyak', 8),
(293, 'Bukit Tambun', 8),
(294, 'Bukit Tengah', 8),
(295, 'Butterworth', 8),
(296, 'Gelugor', 8),
(297, 'Georgetown', 8),
(298, 'Gertak Sangul', 8),
(299, 'Greenlane', 8),
(300, 'Jawi', 8),
(301, 'Jelutong', 8),
(302, 'Juru', 8),
(303, 'Kubang Semang', 8),
(304, 'Mak Mandin', 8),
(305, 'Minden Heights', 8),
(306, 'Nibong Tebal', 8),
(307, 'Pauh Jaya', 8),
(308, 'Paya Terubong', 8),
(309, 'Penaga', 8),
(310, 'Penang Hill', 8),
(311, 'Penanti', 8),
(312, 'Perai', 8),
(313, 'Permatang Kuching', 8),
(314, 'Permatang Pauh', 8),
(315, 'Permatang Tinggi', 8),
(316, 'Persiaran Gurney', 8),
(317, 'Prai', 8),
(318, 'Pulau Betong', 8),
(319, 'Pulau Tikus', 8),
(320, 'Raja Uda', 8),
(321, 'Relau', 8),
(322, 'Scotland', 8),
(323, 'Seberang Jaya', 8),
(324, 'Seberang Perai', 8),
(325, 'Simpang Ampat', 8),
(326, 'Sungai Ara', 8),
(327, 'Sungai Bakap', 8),
(328, 'Sungai Dua', 8),
(329, 'Sungai Jawi', 8),
(330, 'Sungai Nibong', 8),
(331, 'Sungai Pinang', 8),
(332, 'Tanjong Tokong', 8),
(333, 'Tanjung Bungah', 8),
(334, 'Tasek Gelugor', 8),
(335, 'Teluk Bahang', 8),
(336, 'Teluk Kumbar', 8),
(337, 'USM', 8),
(338, 'Valdor', 8),
(339, 'Ayer Tawar', 9),
(340, 'Bagan Datoh', 9),
(341, 'Bagan Serai', 9),
(342, 'Batu Gajah', 9),
(343, 'Batu Kurau', 9),
(344, 'Behrang Stesen', 9),
(345, 'Beruas', 9),
(346, 'Bidor', 9),
(347, 'Bota', 9),
(348, 'Changkat Jering', 9),
(349, 'Changkat Keruing', 9),
(350, 'Chemor', 9),
(351, 'Chenderiang', 9),
(352, 'Chenderong Balai', 9),
(353, 'Chikus', 9),
(354, 'Enggor', 9),
(355, 'Gerik', 9),
(356, 'Gopeng', 9),
(357, 'Hutan Melintang', 9),
(358, 'Intan', 9),
(359, 'Ipoh', 9),
(360, 'Jeram', 9),
(361, 'Kampar', 9),
(362, 'Kampong Gajah', 9),
(363, 'Kampong Kepayang', 9),
(364, 'Kamunting', 9),
(365, 'Kuala Kangsar', 9),
(366, 'Kuala Kurau', 9),
(367, 'Kuala Sepetang', 9),
(368, 'Lahat', 9),
(369, 'Lambor Kanan', 9),
(370, 'Langkap', 9),
(371, 'Lenggong', 9),
(372, 'Lumut', 9),
(373, 'Malim Nawar', 9),
(374, 'Mambang Diawan', 9),
(375, 'Manong', 9),
(376, 'Matang', 9),
(377, 'Menglembu', 9),
(378, 'Padang Rengas', 9),
(379, 'Pangkor', 9),
(380, 'Pantai Remis', 9),
(381, 'Parit', 9),
(382, 'Parit Buntar', 9),
(383, 'Pengkalan Hulu', 9),
(384, 'Pusing', 9),
(385, 'Sauk', 9),
(386, 'Selama', 9),
(387, 'Selekoh', 9),
(388, 'Selinsing', 9),
(389, 'Semanggol', 9),
(390, 'Seri Manjong', 9),
(391, 'Simpang', 9),
(392, 'Sitiawan', 9),
(393, 'Slim River', 9),
(394, 'Sungai Siput', 9),
(395, 'Sungai Sumun', 9),
(396, 'Sungkai', 9),
(397, 'Taiping', 9),
(398, 'Tanjong Piandang', 9),
(399, 'Tanjong Rambutan', 9),
(400, 'Tanjong Tualang', 9),
(401, 'Tanjung Malim', 9),
(402, 'Tapah', 9),
(403, 'Teluk Intan', 9),
(404, 'Temoh', 9),
(405, 'TLDM Lumut', 9),
(406, 'Trolak', 9),
(407, 'Trong', 9),
(408, 'Tronoh', 9),
(409, 'Ulu Bernam', 9),
(410, 'Ulu Kinta', 9),
(411, 'Arau', 10),
(412, 'Kaki Bukit', 10),
(413, 'Kangar', 10),
(414, 'Kuala Perlis', 10),
(415, 'Padang Besar', 10),
(416, 'Pauh', 10),
(417, 'Cyberjaya', 11),
(418, 'Putrajaya', 11),
(419, 'Beaufort', 12),
(420, 'Beluran', 12),
(421, 'Bongawan', 12),
(422, 'Keningau', 12),
(423, 'Kota Belud', 12),
(424, 'Kota Kinabalu', 12),
(425, 'Kota Kinabatangan', 12),
(426, 'Kota Marudu', 12),
(427, 'Kuala Penyu', 12),
(428, 'Kudat', 12),
(429, 'Kunak', 12),
(430, 'Lahad Datu', 12),
(431, 'Likas', 12),
(432, 'Membakut', 12),
(433, 'Menumbok', 12),
(434, 'Nabawan', 12),
(435, 'Pamol', 12),
(436, 'Papar', 12),
(437, 'Penampang', 12),
(438, 'Pitas', 12),
(439, 'Pulatan', 12),
(440, 'Ranau', 12),
(441, 'Sandakan', 12),
(442, 'Semporna', 12),
(443, 'Sipitang', 12),
(444, 'Tambunan', 12),
(445, 'Tamparuli', 12),
(446, 'Tawau', 12),
(447, 'Tenom', 12),
(448, 'Tuaran', 12),
(449, 'Asajaya', 13),
(450, 'Balingian', 13),
(451, 'Baram', 13),
(452, 'Bau', 13),
(453, 'Bekenu', 13),
(454, 'Belaga', 13),
(455, 'Belawai', 13),
(456, 'Betong', 13),
(457, 'Bintagor', 13),
(458, 'Bintulu', 13),
(459, 'Dalat', 13),
(460, 'Daro', 13),
(461, 'Debak', 13),
(462, 'Engkilili', 13),
(463, 'Julau', 13),
(464, 'Kabong', 13),
(465, 'Kanowit', 13),
(466, 'Kapit', 13),
(467, 'Kota Samarahan', 13),
(468, 'Kuching', 13),
(469, 'Lawas', 13),
(470, 'Limbang', 13),
(471, 'Lingga', 13),
(472, 'Long Lama', 13),
(473, 'Lubok Antu', 13),
(474, 'Lundu', 13),
(475, 'Lutong', 13),
(476, 'Maradong', 13),
(477, 'Marudi', 13),
(478, 'Matu', 13),
(479, 'Miri', 13),
(480, 'Mukah', 13),
(481, 'Nanga Medamit', 13),
(482, 'Niah', 13),
(483, 'Pusa', 13),
(484, 'Roban', 13),
(485, 'Saratok', 13),
(486, 'Sarikei', 13),
(487, 'Sebauh', 13),
(488, 'Sebuyau', 13),
(489, 'Serian', 13),
(490, 'Sibu', 13),
(491, 'Simunjan', 13),
(492, 'Song', 13),
(493, 'Spaoh', 13),
(494, 'Sri Aman', 13),
(495, 'Sundar', 13),
(496, 'Tanjung Kidurong', 13),
(497, 'Tatau', 13),
(498, 'Alam Impian', 14),
(499, 'Aman Perdana', 14),
(500, 'Ambang Botanic', 14),
(501, 'Ara Damansara', 14),
(502, 'Balakong', 14),
(503, 'Bandar Botanic', 14),
(504, 'Bandar Bukit Raja', 14),
(505, 'Bandar Bukit Tinggi', 14),
(506, 'Bandar Kinrara', 14),
(507, 'Bandar Puncak Alam', 14),
(508, 'Bandar Puteri Klang', 14),
(509, 'Bandar Puteri Puchong', 14),
(510, 'Bandar Saujana Putra', 14),
(511, 'Bandar Sungai Long', 14),
(512, 'Bandar Sunway', 14),
(513, 'Bandar Utama', 14),
(514, 'Bangi', 14),
(515, 'Banting', 14),
(516, 'Batang Berjuntai', 14),
(517, 'Batang Kali', 14),
(518, 'Batu Arang', 14),
(519, 'Batu Caves', 14),
(520, 'Beranang', 14),
(521, 'Bukit Jelutong', 14),
(522, 'Bukit Rahman Putra', 14),
(523, 'Bukit Rotan', 14),
(524, 'Bukit Subang', 14),
(525, 'Country Heights', 14),
(526, 'Damansara Damai', 14),
(527, 'Damansara Intan', 14),
(528, 'Damansara Jaya', 14),
(529, 'Damansara Kim', 14),
(530, 'Damansara Perdana', 14),
(531, 'Damansara Utama', 14),
(532, 'Denai Alam', 14),
(533, 'Dengkil', 14),
(534, 'Glenmarie', 14),
(535, 'Hulu Langat', 14),
(536, 'Hulu Selangor', 14),
(537, 'Jade Hills', 14),
(538, 'Jenjarom', 14),
(539, 'Kajang', 14),
(540, 'Kapar', 14),
(541, 'Kayu Ara', 14),
(542, 'Kelana Jaya', 14),
(543, 'Kerling', 14),
(544, 'Klang', 14),
(545, 'Kota Damansara', 14),
(546, 'Kota Emerald', 14),
(547, 'Kota Kemuning', 14),
(548, 'Kuala Kubu Baru', 14),
(549, 'Kuala Langat', 14),
(550, 'Kuala Selangor', 14),
(551, 'Kuang', 14),
(552, 'Mutiara Damansara', 14),
(553, 'Petaling Jaya', 14),
(554, 'Port Klang', 14),
(555, 'Puchong South', 14),
(556, 'Pulau Indah ( Pulau Lumut)', 14),
(557, 'Pulau Carey', 14),
(558, 'Pulau Ketam', 14),
(559, 'Puncak Jalil', 14),
(560, 'Putra Heights', 14),
(561, 'Rasa', 14),
(562, 'Rawang', 14),
(563, 'Sabak Bernam', 14),
(564, 'Saujana', 14),
(565, 'Sekinchan', 14),
(566, 'Selayang', 14),
(567, 'Semenyih', 14),
(568, 'Sepang', 14),
(569, 'Serendah', 14),
(570, 'Seri Kembangan', 14),
(571, 'Setia Alam', 14),
(572, 'Setia Eco Park', 14),
(573, 'Shah Alam', 14),
(574, 'SierraMas', 14),
(575, 'SS2', 14),
(576, 'Subang Bestari', 14),
(577, 'Subang Heights', 14),
(578, 'Subang Jaya', 14),
(579, 'Sungai Ayer Tawar', 14),
(580, 'Sungai Besar', 14),
(581, 'Sungai Buloh', 14),
(582, 'Sungai Pelek', 14),
(583, 'Taman TTDI Jaya', 14),
(584, 'Tanjong Karang', 14),
(585, 'Tanjong Sepat', 14),
(586, 'Telok Panglima Garang', 14),
(587, 'Tropicana', 14),
(588, 'Ulu Klang', 14),
(589, 'USJ', 14),
(590, 'USJ Heights', 14),
(591, 'Valencia', 14),
(592, 'Besut', 15),
(593, 'Dungun', 15),
(594, 'Hulu Terengganu', 15),
(595, 'Kemaman', 15),
(596, 'Kuala Terengganu', 15),
(597, 'Marang', 15),
(598, 'Setiu', 15),
(599, 'Kerteh', 15);

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `condo_id` int(10) NOT NULL,
  `floors` varchar(100) NOT NULL,
  `units` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `condo_id`, `floors`, `units`) VALUES
(9, 'Alpha ', 1, '20', '20'),
(26, 'aver', 54, '15', '22'),
(11, 'Charlie', 29, '15', '200'),
(8, 'A', 29, '20', '20'),
(13, 'Beta', 1, '20', '20'),
(14, 'Gemma', 1, '20', '20'),
(15, 'Block A', 44, '15', '6'),
(16, 'Block B', 44, '15', '6'),
(17, 'Block C', 44, '15', '6'),
(18, 'Block D', 44, '15', '6'),
(19, 'Pangkor', 47, '25', '6'),
(20, 'Tioman', 47, '25', '6'),
(21, 'A1', 46, '20', '60'),
(22, 'B2', 46, '20', '100'),
(23, 'C3', 46, '20', '120'),
(24, 'Apple', 50, '20', '20'),
(25, 'Banana', 50, '20', '20'),
(27, 'X', 55, '20', '40'),
(28, 'Y', 55, '20', '20'),
(29, 'Z', 55, '25', '50'),
(30, 'Aquarius', 56, '20', '20'),
(31, 'Capricorn', 56, '18', '20'),
(32, 'Libra', 56, '21', '20'),
(33, 'BlockA', 57, '15', '6'),
(34, 'BlockA', 58, '15', '6'),
(35, 'AA', 59, '18', '36'),
(36, 'BB', 59, '18', '36'),
(37, 'CC', 59, '20', '40'),
(38, 'DD', 59, '20', '40');

-- --------------------------------------------------------

--
-- Table structure for table `cht_chat`
--

CREATE TABLE IF NOT EXISTS `cht_chat` (
  `messageId` binary(32) NOT NULL,
  `username` varchar(300) NOT NULL DEFAULT 'Anonymous',
  `post_id` int(11) NOT NULL,
  `text` varchar(300) NOT NULL DEFAULT '',
  `insertDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`messageId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cht_chat`
--

INSERT INTO `cht_chat` (`messageId`, `username`, `post_id`, `text`, `insertDate`) VALUES
('00c2549f-0a38-11e6-bc0a-0cc47a31', 'sd', 0, 'sd', '2016-04-24 16:17:12'),
('3438f8fa-0a38-11e6-bc0a-0cc47a31', 'sd', 0, 'sd', '2016-04-24 16:18:39'),
('386858e0-0a38-11e6-bc0a-0cc47a31', 'we', 0, 'we', '2016-04-24 16:18:46'),
('adec42c0-0a38-11e6-bc0a-0cc47a31', '9', 0, 'df', '2016-04-24 16:22:03'),
('af451e1c-0a38-11e6-bc0a-0cc47a31', '9', 0, 'dfdd', '2016-04-24 16:22:05'),
('4e05aafc-0a3a-11e6-bc0a-0cc47a31', '9', 20, 'DFF', '2016-04-24 16:33:41'),
('5366542f-0a3a-11e6-bc0a-0cc47a31', '9', 24, 'FGHH', '2016-04-24 16:33:50'),
('149e7d58-0a7e-11e6-bc0a-0cc47a31', '9', 20, 'Dude1', '2016-04-25 00:38:50'),
('194b16c3-0a7e-11e6-bc0a-0cc47a31', '9', 24, 'Dude2', '2016-04-25 00:38:58'),
('104c673a-0a8f-11e6-bc0a-0cc47a31', '9', 24, 'FG', '2016-04-25 02:40:25'),
('79189492-0aa1-11e6-bc0a-0cc47a31', '9', 24, 'now check', '2016-04-25 04:52:11'),
('55ad4937-0aa3-11e6-bc0a-0cc47a31', '9', 20, 'df', '2016-04-25 05:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `condos`
--

CREATE TABLE IF NOT EXISTS `condos` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(155) NOT NULL,
  `code` varchar(55) NOT NULL,
  `email` varchar(155) NOT NULL,
  `phone` varchar(155) NOT NULL,
  `mobile` varchar(155) NOT NULL,
  `address` text NOT NULL,
  `areas` int(32) NOT NULL,
  `state` int(32) NOT NULL,
  `postcode` varchar(155) NOT NULL,
  `logo` varchar(155) NOT NULL,
  `condo_picture` varchar(155) NOT NULL,
  `registered_on` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `condos`
--

INSERT INTO `condos` (`id`, `name`, `code`, `email`, `phone`, `mobile`, `address`, `areas`, `state`, `postcode`, `logo`, `condo_picture`, `registered_on`, `status`) VALUES
(1, 'Cengal Condo', 'cengal', 'dani@getranked.com.my', '+60177092790', '+60177092790', 'Jln Sri Permaisuri 2, Bdr Sri Permaisuri', 48, 1, '56000', 'apply1.jpg', 'cengal1.jpg', '2016-03-31 16:33:33', 1),
(54, 'Kinrara Mas', 'kinrara', 'sana@getranked.com.my', '+923329620292', '+923329620292', 'kinrara mass condomium', 129, 3, '44000', 'kinrara_mas.jpg', 'kinrara_mas.jpg', '2016-04-13 17:55:05', 1),
(50, 'One Menerung', 'OM', 'marrcuss.lim@gmail.com', '0122783997', '0122783997', 'Bangsar ', 7, 1, '59000', 'ALIA_LOGO-01_(006)1.png', '51.jpg', '2016-04-05 16:18:34', 1),
(58, 'Scott Villa', 'SV', 'sdsuresh22@hotmail.com', '12334', '1233', 'Jalan Hulir', 1, 1, '60000', 'mines.jpg', 'mines1.jpg', '2016-04-28 10:21:05', 1),
(44, 'Palmcourt', 'PALM', 'ronnie@getranked.com.my', '601136548996', '601136548996', '15-06, Block D, Jalan Berhala', 10, 1, '40570', 'model.JPG', 'palmcourt.jpg', '2016-04-12 15:46:57', 1),
(47, 'Juta Mines', 'JM', 'sdsuresh22@gmail.com', '12334', '1233', 'Persiaran Seri Timah, Taman Seri Timah', 570, 14, '43300', 'Facebook-Covers-005.jpg', 'mines.jpg', '2016-04-01 14:17:28', 1),
(59, 'Regina USJ 1', 'Kundi', 'saqib.eq@gmail.com', '017-656-9760', '0176569760', 'Regina Usj 1, Jalan Subang Permai, USJ1 47500 Subang Jaya Selangore', 578, 14, '47500', '341.jpg', 'banner-design-900x900.jpg', '2016-05-04 13:10:16', 1),
(56, 'Ken Bangsar', 'KEN', 'marcuslimkl@gmail.com', '0122783997', '0122783997', 'Jalan Kapas, Bangsar, Kuala Lumpur', 7, 1, '59100', 'Ken_Logo.jpg', 'KEN1.JPG', '2016-05-20 13:11:30', 1),
(60, 'Enda Regal ', 'Pluo umba', 'jojo@getranked.com.my', '017-659-8975', '017-9876541', 'siri pataling ', 58, 1, '65000', 'shutterstock_158522279-1024x682.jpg', '20906-b.jpg', '2016-05-04 17:23:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `condo_admins`
--

CREATE TABLE IF NOT EXISTS `condo_admins` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `condo_id` int(32) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(155) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(155) NOT NULL,
  `verify_code` varchar(155) NOT NULL,
  `registered_on` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `ip` varchar(155) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `role` int(11) NOT NULL,
  `forgot_pass_count` int(11) NOT NULL,
  `notification_alert` int(11) NOT NULL DEFAULT '1',
  `delivery_time_starts` time NOT NULL,
  `delivery_time_ends` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `condo_admins`
--

INSERT INTO `condo_admins` (`id`, `condo_id`, `full_name`, `email`, `phone`, `password`, `verify_code`, `registered_on`, `last_login`, `ip`, `status`, `role`, `forgot_pass_count`, `notification_alert`, `delivery_time_starts`, `delivery_time_ends`) VALUES
(59, 54, 'USER', 'sana@getranked.com.my', '+923329620292', '81dc9bdb52d04dc20036dbd8313ed055', '83dfd1cb85018ba979f8c753c965e967', '2016-04-13 17:55:05', '2016-05-20 14:06:10', '39.32.238.66', 1, 1, 0, 1, '09:30:00', '14:45:00'),
(45, 44, 'Ronnie Security', 'sdsuresh22@gmail.com', '', '82cc921c6a5c6707e1d6e6862ba3201a', '149d6050fb0a0dc340253b3334911fee', '2016-04-01 14:17:28', '2016-05-19 19:06:09', '113.210.65.6', 1, 2, 0, 1, '00:00:00', '00:00:00'),
(46, 1, 'Dani Manager', 'dani@getranked.com.my', '', '1d0258c2440a8d19e716292b231e3190', 'd41d8cd98f00b204e9800998ecf8427e', '2016-04-01 18:39:39', '2016-04-03 16:34:13', '203.106.189.194', 1, 1, 0, 1, '00:00:00', '00:00:00'),
(40, 44, 'Ronnie Manager', 'sdsuresh22@hotmail.com', '+601136548996', '5f4dcc3b5aa765d61d8327deb882cf99', '82291442b9b2fa9405594ffccc0bdfcc', '2016-03-25 18:03:04', '2016-05-20 18:34:12', '202.129.163.230', 1, 1, 0, 1, '09:00:00', '21:00:00'),
(41, 47, 'sana Manager', 'sanaullahAhmad@gmail.com', '+923329620292', '81dc9bdb52d04dc20036dbd8313ed055', '659bac52c35f2b34fa7a310cdb366a4f', '2016-03-27 00:00:00', '2016-04-14 15:15:58', '101.50.84.78', 1, 1, 0, 2, '00:00:00', '00:00:00'),
(42, 33, 'sana Security', 'sanaullahAhmad@gmail.com', '', '81dc9bdb52d04dc20036dbd8313ed055', '659bac52c35f2b34fa7a310cdb366a4f', '2016-03-28 00:00:00', '2016-04-04 12:14:45', '101.50.82.103', 1, 2, 0, 1, '00:00:00', '00:00:00'),
(55, 50, 'USER', 'marrcuss.lim@gmail.com', '', '0795151defba7a4b5dfa89170de46277', '3a859dbe469596bb17f19268bd9885f7', '2016-04-04 19:01:55', '2016-05-17 15:55:50', '175.139.130.126', 1, 1, 0, 1, '00:00:00', '00:00:00'),
(54, 54, 'sanatest2', 'sanakust@yahoo.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '49c5dad110cc1ee6de181f79122c6859', '2016-04-04 00:00:00', '2016-05-20 14:25:15', '39.32.238.66', 1, 2, 2, 1, '09:30:00', '14:45:00'),
(65, 59, 'USER', 'saqib.eq@gmail.com', '', '5f4dcc3b5aa765d61d8327deb882cf99', '5e9dee17d84d5133bb6c9744f8b79253', '2016-05-04 12:43:04', '2016-05-11 16:42:47', '202.129.163.230', 1, 1, 2, 1, '10:00:00', '19:00:00'),
(61, 56, 'USER', 'marcuslimkl@gmail.com', '', '0795151defba7a4b5dfa89170de46277', '19f16aef943764113d5d2d49606e6503', '2016-04-27 19:29:38', '2016-05-04 18:56:19', '103.26.249.254', 1, 1, 0, 1, '00:00:00', '00:00:00'),
(63, 58, 'USER', 'sdsuresh22@hotmail.com', '', '78b64bd95ad4033217ed405633ff5e6b', 'ad439a97dba42b58cb58bb6640b71e43', '2016-04-28 10:21:05', '2016-04-28 10:31:12', '202.129.163.230', 1, 1, 0, 1, '00:00:00', '00:00:00'),
(64, 50, 'One Menerung Security', 'marrcuss.lim@als.com.my', '', '83af648e6d9712795f2cb32ad6c77592', '0d1728d257db84cd2abd8d752c610fa2', '2016-05-03 00:00:00', '0000-00-00 00:00:00', '', 1, 2, 0, 1, '00:00:00', '00:00:00'),
(66, 60, 'USER', 'jojo@getranked.com.my', '', '7d219a2ff0ef5dfe3244122c1ed1a71e', '0ec7d204d017b3fbe0d9c42542c7893e', '2016-05-04 17:23:34', '2016-05-04 17:26:07', '202.129.165.18', 1, 1, 0, 1, '00:00:00', '00:00:00'),
(67, 54, 'Waqas', 'waqas@getranked.com.my', '', '81c2bee78d5b216f15a14ef5dbabe1e7', '56815eb659c9d8f4407f9bfa44eefee5', '2016-05-04 00:00:00', '0000-00-00 00:00:00', '', 1, 1, 0, 1, '00:00:00', '00:00:00'),
(68, 59, 'waqass', 'waqas@getranked.com.my', '', '81c2bee78d5b216f15a14ef5dbabe1e7', '56815eb659c9d8f4407f9bfa44eefee5', '2016-05-05 00:00:00', '2016-05-11 16:34:05', '202.129.163.230', 1, 2, 0, 1, '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `condo_facilities`
--

CREATE TABLE IF NOT EXISTS `condo_facilities` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `condo_id` int(32) NOT NULL,
  `name` varchar(155) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(155) NOT NULL,
  `price` float NOT NULL,
  `opening_hour` time NOT NULL,
  `closing_hour` time NOT NULL,
  `session_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `condo_facilities`
--

INSERT INTO `condo_facilities` (`id`, `condo_id`, `name`, `description`, `image_url`, `price`, `opening_hour`, `closing_hour`, `session_time`) VALUES
(1, 54, 'testname', 'testdescription', 'moqaf_ki_tabdeeli.jpg', 40, '00:00:00', '00:00:00', 0),
(2, 54, 'testing', 'testing', 'chair3.jpg', 56, '00:00:00', '00:00:00', 0),
(4, 44, 'Badminton Court', 'Badminton Court Description', 'BadmintonCourt.jpg', 50, '00:00:00', '00:00:00', 0),
(5, 44, 'Dining Hall', 'Dining Hall Description', 'dining_hall.jpg', 200, '00:00:00', '00:00:00', 0),
(6, 44, 'Gym', 'Gym Descripiton', 'gym.jpg', 60, '00:00:00', '00:00:00', 0),
(7, 59, 'Swimming Pool', 'Swimming ', 'swmming_pool.jpg', 200, '00:00:00', '00:00:00', 0),
(8, 59, 'Suana Bath ', 'Healthy Life ', 'Suana_Bath.jpg', 0, '00:00:00', '00:00:00', 0),
(9, 59, 'Gym', 'Healthy Life ', 'GYM.jpg', 0, '00:00:00', '00:00:00', 0),
(10, 44, 'Sauna Bath', 'Sauna Bath Decription', 'sauna.jpg', 30, '00:00:00', '00:00:00', 0),
(11, 50, 'Function Room', 'Suitable for meetings, private events and hosting guests', 'OM_Function_Room.jpg', 0, '00:00:00', '00:00:00', 0),
(12, 50, 'BBQ Pit', 'For community and family events', 'OM_BBQ_Pit.jpg', 0, '00:00:00', '00:00:00', 0),
(13, 50, 'Dance Studio', 'Fully air conditioned, suitable for yoga, aerobics and other indoor exercises', 'OM_Dance_Studio.jpg', 0, '00:00:00', '00:00:00', 0),
(14, 50, 'Sauna Room', 'Opening hours (9am-9pm)', 'OM_Sauna.jpg', 0, '00:00:00', '00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `condo_settings`
--

CREATE TABLE IF NOT EXISTS `condo_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `condo_id` int(11) NOT NULL,
  `key_id` varchar(200) NOT NULL,
  `value` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `condo_settings`
--

INSERT INTO `condo_settings` (`id`, `condo_id`, `key_id`, `value`) VALUES
(1, 44, 'bank_info', 'ALL MY BANK INFO WILL GO HERE'),
(2, 44, 'merchant_id', 'ALL MY MERCHANT ID'),
(3, 44, 'verify_key', 'adwiqekdfhkjsdhkjsdhksdhklsd'),
(4, 44, 'maintenance_fee', '300');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_requests`
--

CREATE TABLE IF NOT EXISTS `delivery_requests` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `condo_id` int(11) NOT NULL,
  `company_name` varchar(155) NOT NULL,
  `delivery_for` int(32) NOT NULL,
  `deliverydatetime` datetime NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `icid_number` varchar(100) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `delivery_requests`
--

INSERT INTO `delivery_requests` (`id`, `condo_id`, `company_name`, `delivery_for`, `deliverydatetime`, `description`, `status`, `check_in`, `check_out`, `icid_number`, `driver_name`) VALUES
(1, 54, 'Sam''s Croceria', 73, '2016-04-18 12:51:06', 'this is delivery description', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(2, 44, 'Sam''s Croceria', 78, '2016-04-19 12:51:06', 'this is delivery description', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(4, 54, 'sanacompany', 73, '2016-04-25 10:30:00', 'this is delivery details', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(5, 54, 'rewrwerwrwer w erwerwer', 73, '2016-04-26 00:30:00', 'this  fasdfa was w fasfq4r q qw qtqtqt', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(6, 54, 'rewrwerwrwer w erwerwer', 73, '2016-04-26 00:30:00', 'this  fasdfa was w fasfq4r q qw qtqtqt', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(7, 54, 'Arsalan company', 73, '2016-04-20 10:30:00', 'this is description', 0, '2016-04-20 18:56:54', '2016-04-20 18:58:11', '', ''),
(8, 44, 'Nand services', 78, '2016-04-01 10:00:00', 'New Delivery', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(9, 44, 'Nand services', 78, '2016-04-20 10:00:00', 'New Delivery ', 0, '2016-04-20 17:51:04', '2016-04-20 17:51:06', '', ''),
(10, 54, 'this is country name', 73, '2016-04-14 10:20:00', 'this is description', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(11, 54, 'sdfsd', 73, '2016-04-06 13:40:00', 'fsdfs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(12, 54, 'this is test company name', 73, '2016-04-09 13:03:00', 'this delivery description', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(13, 54, '46464', 73, '2016-04-22 11:10:00', 'this is description', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(14, 54, 'fdfsdfsd', 73, '2016-04-20 11:12:00', 'this is del des sana', 0, '2016-04-20 23:13:44', '0000-00-00 00:00:00', '', ''),
(15, 44, 'Demo', 78, '2016-04-21 15:56:00', 'RET', 0, '2016-04-21 15:56:47', '2016-04-21 15:56:49', '', ''),
(16, 44, 'Ronnie Comp', 78, '2016-04-26 17:30:00', 'New Deleivery', 0, '2016-04-25 18:16:10', '2016-04-25 18:16:12', '', ''),
(17, 54, 'my company', 73, '2016-04-27 13:15:00', 'this is de', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(18, 44, 'Marbles', 78, '2016-04-27 17:20:00', 'Delivery today', 0, '2016-04-27 17:24:18', '2016-04-27 17:24:19', '', ''),
(19, 44, 'Ronnie Test Company', 78, '2016-04-27 16:27:00', 'Delivery added by security', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(20, 54, 'sana company td', 73, '2016-04-27 14:10:00', 'this in new testing des', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(21, 44, 'HARVY', 78, '2016-04-28 17:20:00', 'Delivery Testing', 0, '2016-04-28 11:22:36', '2016-04-28 11:22:39', '', ''),
(22, 59, '5 Start Sdn Bhd', 92, '2016-05-05 18:00:00', 'Furniture Delivery ', 0, '2016-05-05 13:11:28', '0000-00-00 00:00:00', '', ''),
(23, 59, 'solution', 0, '2016-05-06 13:17:58', 'delivery', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(24, 59, 'getranked', 0, '2016-05-06 13:20:49', 'delivery', 0, '2016-05-05 13:21:07', '0000-00-00 00:00:00', '', ''),
(25, 44, 'LP SDN BHD', 78, '2016-05-12 16:30:00', 'Delivery test Ronnie', 0, '2016-05-11 16:20:19', '2016-05-11 16:20:21', '', ''),
(26, 44, 'MLT lmt', 78, '2016-05-11 16:21:52', 'LPOP', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'IOP', ''),
(27, 59, 'ASDF ', 92, '2016-05-12 18:00:00', 'Furniture ', 0, '2016-05-11 16:35:04', '2016-05-11 16:35:05', '', ''),
(28, 59, 'SONY', 0, '2016-05-11 16:38:56', 'Furniture', 0, '2016-05-11 16:39:14', '2016-05-11 16:39:17', '11545421656', ''),
(29, 44, 'IFB', 78, '2016-05-12 16:15:00', 'Washing Machine delivery', 0, '2016-05-11 19:15:45', '2016-05-11 19:15:48', '', ''),
(30, 54, 'dsdsds', 0, '2016-05-16 15:47:48', 'sdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2323', ''),
(31, 54, 'Company Name', 0, '2016-05-16 15:50:32', 'Delivery Details', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'IC/ID number', 'Driver Name'),
(32, 54, 'Company Name', 73, '2016-05-16 15:53:11', 'Delivery Details', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Driver Name'),
(33, 54, 'Company Name', 73, '2016-05-16 16:02:29', 'Delivery Details', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'IC/ID number', 'Driver Name'),
(34, 44, 'DD', 78, '2016-05-19 10:55:00', 'Hi Delivery', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RT567', 'Arun'),
(35, 44, 'SD', 78, '2016-05-19 19:06:57', 'Chicken', 0, '2016-05-19 19:07:21', '2016-05-19 19:07:25', 'DGHTY', 'Driver Name ');

-- --------------------------------------------------------

--
-- Table structure for table `facility_booking`
--

CREATE TABLE IF NOT EXISTS `facility_booking` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `resident_id` int(32) NOT NULL,
  `datetime_booked` datetime NOT NULL,
  `bookedfor_datetime_from` datetime NOT NULL,
  `bookedfor_datetime_to` datetime NOT NULL,
  `facility_id` int(32) NOT NULL,
  `condo_id` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `facility_booking`
--

INSERT INTO `facility_booking` (`id`, `resident_id`, `datetime_booked`, `bookedfor_datetime_from`, `bookedfor_datetime_to`, `facility_id`, `condo_id`) VALUES
(3, 73, '2016-05-04 20:09:29', '2016-05-04 21:25:00', '2016-05-05 01:05:00', 1, 54),
(5, 73, '2016-05-04 20:25:11', '2016-05-07 17:20:00', '2016-05-08 17:20:00', 1, 54),
(7, 73, '2016-05-04 21:08:13', '2016-05-04 10:30:00', '2016-05-04 11:10:00', 2, 54),
(8, 73, '2016-05-04 21:09:09', '2016-05-04 12:25:00', '2016-05-04 13:25:00', 2, 54),
(9, 73, '2016-05-04 21:29:33', '2016-05-04 14:30:00', '2016-05-04 15:25:00', 2, 54),
(38, 92, '2016-05-06 19:22:29', '2016-05-06 20:00:00', '2016-05-06 21:00:00', 7, 59),
(37, 73, '2016-05-05 20:32:23', '2016-05-07 02:40:00', '2016-05-07 02:45:00', 2, 54),
(36, 73, '2016-05-05 20:28:19', '2016-05-07 02:25:00', '2016-05-07 02:30:00', 2, 54),
(35, 78, '2016-05-05 20:11:34', '2016-05-06 10:00:00', '2016-05-06 10:55:00', 5, 44),
(16, 73, '2016-05-05 14:19:30', '2016-05-18 11:35:00', '2016-05-27 11:30:00', 2, 54),
(18, 73, '2016-05-05 14:32:44', '2016-05-04 10:30:00', '2016-05-04 11:10:00', 2, 54),
(19, 73, '2016-05-05 15:18:39', '2016-05-04 10:30:00', '2016-05-04 10:25:00', 2, 54),
(20, 73, '2016-05-05 15:29:19', '2016-05-04 23:25:00', '2016-05-04 23:30:00', 2, 54),
(21, 73, '2016-05-05 15:30:11', '2016-05-04 23:15:00', '2016-05-04 23:20:00', 2, 54),
(34, 78, '2016-05-05 20:01:28', '2016-05-06 11:00:00', '2016-05-06 12:00:00', 5, 44),
(33, 73, '2016-05-05 19:26:08', '2016-05-03 02:10:00', '2016-05-03 02:15:00', 2, 54),
(31, 73, '2016-05-05 19:00:25', '2016-05-03 01:05:00', '2016-05-03 01:10:00', 2, 54),
(32, 78, '2016-05-05 19:12:21', '2016-05-06 11:10:00', '2016-05-06 11:10:00', 6, 44),
(39, 73, '2016-05-09 14:16:38', '2016-05-04 02:15:00', '2016-05-04 02:35:00', 2, 54),
(40, 73, '2016-05-09 14:17:27', '2016-05-04 02:15:00', '2016-05-04 02:30:00', 1, 54),
(41, 73, '2016-05-09 15:21:53', '2016-05-05 01:05:00', '2016-05-05 06:35:00', 2, 54),
(42, 73, '2016-05-17 18:55:15', '2016-05-09 12:29:00', '2016-05-09 12:29:00', 2, 54),
(43, 92, '2016-05-09 16:13:27', '2016-05-16 16:55:00', '2016-05-16 19:05:00', 8, 59),
(44, 92, '2016-05-09 16:16:35', '2016-05-10 17:00:00', '2016-05-10 18:00:00', 9, 59),
(45, 92, '2016-05-09 16:18:02', '2016-05-10 17:00:00', '2016-05-10 18:00:00', 8, 59),
(46, 92, '2016-05-10 12:23:14', '2016-05-20 17:00:00', '2016-05-20 18:00:00', 8, 59),
(47, 78, '2016-05-10 21:35:14', '2016-05-10 21:30:00', '2016-05-10 21:55:00', 6, 44),
(49, 78, '2016-05-10 23:48:48', '2016-05-11 09:30:00', '2016-05-11 10:30:00', 4, 44),
(50, 78, '2016-05-10 23:58:04', '2016-05-11 10:00:00', '2016-05-11 11:00:00', 5, 44),
(51, 92, '2016-05-11 14:03:25', '2016-05-23 16:00:00', '2016-05-23 17:00:00', 8, 59),
(52, 78, '2016-05-11 17:33:16', '2016-05-12 09:00:00', '2016-05-12 10:00:00', 5, 44),
(76, 78, '2016-05-20 18:55:50', '2016-05-30 19:00:00', '2016-05-30 19:00:00', 4, 44),
(61, 73, '2016-05-17 20:31:11', '2016-07-08 16:15:00', '2016-07-17 18:00:00', 1, 54),
(62, 73, '2016-05-18 19:40:58', '2016-08-05 16:00:00', '2016-08-05 17:00:00', 2, 54),
(75, 64, '2016-05-20 18:52:29', '2016-05-26 16:00:00', '2016-05-26 16:15:00', 1, 54),
(64, 71, '2016-05-17 21:50:44', '2016-09-01 19:00:00', '2016-09-01 20:00:00', 2, 54),
(65, 64, '2016-05-17 22:03:21', '2016-09-02 19:15:00', '2016-09-02 20:15:00', 1, 54),
(66, 78, '2016-05-18 11:06:15', '2016-05-18 00:15:00', '2016-05-19 11:15:00', 4, 44),
(74, 64, '2016-05-20 18:44:23', '2016-05-26 15:45:00', '2016-05-26 15:15:00', 1, 54),
(73, 64, '2016-05-20 18:39:53', '2016-05-27 15:45:00', '2016-05-27 15:30:00', 1, 54),
(72, 64, '2016-05-20 18:28:47', '2016-05-26 15:30:00', '2016-05-26 15:15:00', 1, 54),
(70, 78, '2016-05-18 22:56:22', '2016-05-18 11:00:00', '2016-05-18 00:00:00', 6, 44);

-- --------------------------------------------------------

--
-- Table structure for table `facility_invoice`
--

CREATE TABLE IF NOT EXISTS `facility_invoice` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `paid_by` int(32) NOT NULL,
  `booking_id` int(32) NOT NULL,
  `facility_id` int(10) NOT NULL,
  `amount_paid` float NOT NULL,
  `description` text NOT NULL,
  `condo_id` int(32) NOT NULL,
  `datetime_paid` datetime NOT NULL,
  `manual_receipt` varchar(155) NOT NULL,
  `payment_channel` varchar(155) NOT NULL,
  `payment_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `facility_invoice`
--

INSERT INTO `facility_invoice` (`id`, `paid_by`, `booking_id`, `facility_id`, `amount_paid`, `description`, `condo_id`, `datetime_paid`, `manual_receipt`, `payment_channel`, `payment_status`) VALUES
(1, 73, 2, 1, 40, 'testdescription', 54, '2016-05-04 20:45:34', '', '', 0),
(2, 73, 3, 2, 56, 'testing', 54, '2016-05-04 21:08:13', '', '', 1),
(3, 73, 21, 2, 56, 'testing', 54, '2016-05-04 21:10:36', '', 'Payment Channel', 1),
(4, 73, 31, 2, 56, 'testing', 54, '2016-05-04 21:29:40', '', 'Payment Channel', 1),
(5, 73, 32, 2, 56, 'testing', 54, '2016-05-04 21:41:19', '', 'Payment Channel', 1),
(6, 78, 33, 8, 200, 'Full Area', 44, '2016-05-05 11:46:31', '', 'Payment Channel', 1),
(7, 78, 34, 8, 200, 'Full Area', 44, '2016-05-05 11:48:25', '', 'Payment Channel', 1),
(8, 78, 4, 8, 200, 'Full Area', 44, '2016-05-05 11:57:02', '', '', 0),
(9, 78, 5, 8, 200, 'Full Area', 44, '2016-05-05 13:02:41', '', '', 1),
(10, 78, 6, 8, 200, 'Full Area', 44, '2016-05-05 13:08:01', '', '', 0),
(11, 73, 35, 2, 56, 'testing', 54, '2016-05-05 14:20:28', '', 'Payment Channel', 1),
(12, 73, 36, 2, 56, 'testing', 54, '2016-05-05 14:32:20', '', 'Payment Channel', 1),
(13, 73, 7, 2, 56, 'testing', 54, '2016-05-05 14:32:44', '', '', 1),
(14, 73, 37, 2, 56, 'testing', 54, '2016-05-05 15:18:45', '', 'Payment Channel', 1),
(15, 73, 38, 2, 56, 'testing', 54, '2016-05-05 15:29:28', '', 'Payment Channel', 1),
(16, 73, 39, 2, 56, 'testing', 54, '2016-05-05 15:30:18', '', 'Payment Channel', 1),
(25, 78, 8, 8, 200, 'Full Area', 44, '2016-05-05 18:38:47', '', '', 1),
(24, 73, 9, 2, 56, 'testing', 54, '2016-05-05 18:34:18', '', '', 1),
(23, 78, 16, 8, 200, 'Full Area', 44, '2016-05-05 18:19:45', '', '', 1),
(22, 78, 3, 8, 200, 'Full Area', 44, '2016-05-05 18:09:35', '', 'Payment Channel', 1),
(26, 73, 2, 2, 56, 'testing', 54, '2016-05-05 19:00:30', '', 'Payment Channel', 1),
(27, 78, 17, 0, 60, 'Gym Descripiton', 44, '2016-05-05 19:12:21', '', '', 0),
(28, 73, 2, 2, 56, 'testing', 54, '2016-05-05 19:56:29', 'fixing.jpg', 'Manual Payment', 1),
(29, 78, 18, 0, 200, 'Dining Hall Description', 44, '2016-05-05 20:01:28', '', '', 1),
(30, 78, 5, 0, 200, 'Dining Hall Description', 44, '2016-05-05 20:11:45', 'adimage.jpg', 'Manual Payment', 1),
(31, 73, 19, 2, 56, 'testing', 54, '2016-05-05 20:28:54', 'no-image.jpg', 'Manual Payment', 0),
(32, 73, 20, 2, 56, 'testing', 54, '2016-05-05 20:32:38', 'portriat.jpg', 'Manual Payment', 0),
(33, 92, 38, 7, 200, 'Swimming ', 59, '2016-05-06 19:23:28', '', 'Payment Channel', 1),
(38, 92, 43, 8, 0, 'Healthy Life ', 59, '2016-05-09 16:13:32', '', 'Payment Channel', 1),
(34, 73, 39, 2, 56, 'testing', 54, '2016-05-09 14:16:44', '', 'Payment Channel', 1),
(35, 73, 40, 1, 40, 'testdescription', 54, '2016-05-09 14:17:56', 'fixing1.jpg', 'Manual Payment', 1),
(36, 73, 41, 2, 56, 'testing', 54, '2016-05-09 15:23:07', 'portriat1.jpg', 'Manual Payment', 0),
(37, 73, 42, 2, 56, 'testing', 54, '2016-05-09 15:32:08', 'chair2.jpg', 'Manual Payment', 0),
(39, 92, 44, 9, 0, 'Healthy Life ', 59, '2016-05-09 16:16:38', '', 'Payment Channel', 1),
(40, 92, 45, 8, 0, 'Healthy Life ', 59, '2016-05-09 16:18:30', 'download_(6).jpg', 'Manual Payment', 1),
(41, 92, 46, 8, 0, 'Healthy Life ', 59, '2016-05-10 12:23:18', '', 'Payment Channel', 1),
(42, 78, 47, 6, 60, 'Gym Descripiton', 44, '2016-05-10 21:35:18', '', 'Payment Channel', 1),
(44, 78, 49, 4, 50, 'Badminton Court Description', 44, '2016-05-10 23:49:15', 'a4copy.jpg', 'Manual Payment', 1),
(45, 78, 50, 5, 200, 'Dining Hall Description', 44, '2016-05-10 23:58:08', '', 'Payment Channel', 1),
(46, 92, 51, 8, 0, 'Healthy Life ', 59, '2016-05-11 14:03:33', '', 'Payment Channel', 1),
(47, 78, 52, 5, 200, 'Dining Hall Description', 44, '2016-05-11 17:53:20', '26-le-cafe-coffee-website-design.png', 'Manual Payment', 1),
(48, 86, 53, 4, 50, 'Badminton Court Description', 44, '2016-05-17 00:09:58', '', '', 0),
(49, 73, 54, 4, 50, 'Badminton Court Description', 54, '2016-05-17 17:21:33', '', '', 0),
(50, 73, 55, 4, 50, 'Badminton Court Description', 54, '2016-05-17 17:22:22', '', '', 0),
(51, 73, 56, 4, 50, 'Badminton Court Description', 54, '2016-05-17 17:25:04', '', '', 0),
(52, 73, 57, 1, 40, 'testdescription', 54, '2016-05-17 17:25:57', '', '', 0),
(53, 73, 58, 1, 40, 'testdescription', 54, '2016-05-17 17:55:00', '', '', 0),
(54, 73, 59, 1, 40, 'testdescription', 54, '2016-05-17 17:59:28', '', '', 0),
(55, 73, 60, 1, 40, 'testdescription', 54, '2016-05-17 18:04:16', '', '', 0),
(56, 73, 61, 1, 40, 'testdescription', 54, '2016-05-17 21:01:07', 'no-image1.jpg', 'Manual Payment', 1),
(57, 73, 62, 2, 56, 'testing', 54, '2016-05-18 20:05:15', 'portriat3.jpg', 'Manual Payment', 1),
(58, 78, 63, 5, 200, 'Dining Hall Description', 44, '2016-05-17 19:05:45', '', '', 0),
(59, 71, 64, 2, 56, 'testing', 54, '2016-05-17 21:50:44', '', '', 1),
(60, 64, 65, 1, 40, 'testdescription', 54, '2016-05-17 22:03:21', '', '', 1),
(61, 78, 66, 4, 50, 'Badminton Court Description', 44, '2016-05-18 11:06:15', '', '', 1),
(62, 78, 67, 6, 60, 'Gym Descripiton', 44, '2016-05-18 13:57:33', '', '', 0),
(63, 90, 68, 11, 0, 'Suitable for meetings, private events and hosting guests', 50, '2016-05-18 21:27:01', '', '', 0),
(64, 90, 69, 11, 0, 'Suitable for meetings, private events and hosting guests', 50, '2016-05-18 21:27:32', '', '', 0),
(65, 78, 70, 6, 60, 'Gym Descripiton', 44, '2016-05-18 22:58:15', 'codeigniter-development.png', 'Manual Payment', 1),
(66, 73, 71, 2, 56, 'testing', 54, '2016-05-19 19:42:38', '', '', 0),
(67, 64, 72, 1, 40, 'testdescription', 54, '2016-05-20 18:28:47', '', '', 1),
(68, 64, 73, 1, 40, 'testdescription', 54, '2016-05-20 18:39:53', '', '', 1),
(69, 64, 74, 1, 40, 'testdescription', 54, '2016-05-20 18:44:23', '', '', 1),
(70, 64, 75, 1, 40, 'testdescription', 54, '2016-05-20 18:52:29', '', '', 1),
(71, 78, 76, 4, 50, 'Badminton Court Description', 44, '2016-05-20 18:55:55', '', 'Payment Channel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `incident_categories`
--

CREATE TABLE IF NOT EXISTS `incident_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `incident_categories`
--

INSERT INTO `incident_categories` (`id`, `name`, `image_url`) VALUES
(15, 'Maintenance', ''),
(16, 'Common Area (Swimming Pool, Gym etc)', ''),
(20, 'Fire', ''),
(21, 'Theft', '');

-- --------------------------------------------------------

--
-- Table structure for table `incident_images`
--

CREATE TABLE IF NOT EXISTS `incident_images` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `incident_id` int(32) NOT NULL,
  `image_url` varchar(155) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `incident_images`
--

INSERT INTO `incident_images` (`id`, `incident_id`, `image_url`) VALUES
(1, 26, '10411840_894158383990556_7048035604297408444_n.jpg'),
(2, 26, '11728910_897184043687990_1264031317487450642_o.jpg'),
(3, 28, 'apply.jpg'),
(4, 28, 'check.jpg'),
(5, 29, '5.jpg'),
(6, 30, 'cengal.jpg'),
(7, 0, 'fixing.jpg'),
(8, 0, 'no-image.jpg'),
(9, 0, 'no-profile-img-240x300.gif'),
(10, 0, 'portriat.jpg'),
(11, 0, 'no-image1.jpg'),
(12, 0, 'no-profile-img-240x3001.gif'),
(13, 0, 'portriat1.jpg'),
(14, 0, 'no-image2.jpg'),
(15, 0, 'no-profile-img-240x3002.gif'),
(16, 0, 'portriat2.jpg'),
(17, 0, 'no-image7.jpg'),
(18, 0, 'no-profile-img-240x3007.gif'),
(19, 0, 'portriat7.jpg'),
(20, 32, 'chair3.jpg'),
(21, 32, 'fixing1.jpg'),
(22, 32, 'no-image8.jpg'),
(23, 32, 'no-profile-img-240x3008.gif'),
(24, 32, 'portriat8.jpg'),
(25, 33, 'chair2.jpg'),
(26, 0, 'fixing2.jpg'),
(27, 0, 'no-image9.jpg'),
(28, 0, 'no-profile-img-240x3009.gif'),
(29, 0, 'portriat9.jpg'),
(33, 39, 'IMG_0377.JPG'),
(34, 40, 'Business-team.jpg'),
(35, 41, '071013_0726_watertankcl2.jpg'),
(36, 41, 'water-tank-cleaning-service-250x250.jpg'),
(37, 41, 'floor_crack.jpg'),
(38, 42, '20150821_165542.jpg'),
(39, 42, '20150823_151053.jpg'),
(40, 0, 'Parking_Space2.jpeg'),
(41, 0, 'OM_Function_Room.jpg'),
(42, 0, 'OM_Sauna.jpg'),
(43, 0, 'Parking_Space.jpg'),
(44, 0, 'Parking_Space21.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `incident_reporting`
--

CREATE TABLE IF NOT EXISTS `incident_reporting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reported_by` int(11) NOT NULL,
  `description` text NOT NULL,
  `condo_id` int(11) NOT NULL,
  `reported_date` datetime NOT NULL,
  `resolved_date` datetime NOT NULL,
  `incident_log` text NOT NULL,
  `incident_category` int(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `incident_reporting`
--

INSERT INTO `incident_reporting` (`id`, `reported_by`, `description`, `condo_id`, `reported_date`, `resolved_date`, `incident_log`, `incident_category`, `status`) VALUES
(7, 3, 'afad asdfasdf asfa asf asdf asdf 2', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(5, 3, ' dfgsdfg sdg a gsdgsdfgsdgsdg ', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(4, 3, 's ad asdf sdfasdfs fasdfa sfasdfasf222', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(9, 73, 'this is first report', 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 16, 0),
(10, 54, 'fire is there ', 46, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 20, 0),
(11, 78, 'Test Fire', 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 20, 0),
(12, 73, 'this is testing', 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 16, 1),
(13, 73, 'this is testing', 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 16, 1),
(14, 73, 'this is testing', 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 16, 1),
(15, 73, 'Second sms', 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 16, 1),
(16, 73, 'this is thired report', 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 21, 1),
(17, 73, 'First incident', 54, '2016-04-14 14:03:47', '2016-04-14 15:51:15', 'complaint log', 20, 1),
(18, 73, 'Second Complaint. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n', 54, '2016-04-14 14:28:06', '2016-04-14 17:29:28', 'this is complaint log', 15, 1),
(19, 78, 'Test Report', 44, '2016-04-14 15:05:29', '2016-04-15 19:38:58', 'pol12', 20, 1),
(20, 73, 'this incedent', 54, '2016-04-14 15:10:08', '2016-04-14 17:31:36', 'this is thired incidetn log', 16, 1),
(21, 73, '4Th Post lorem ipsum', 54, '2016-04-14 15:33:43', '0000-00-00 00:00:00', '', 20, 0),
(22, 73, 'this is testing inci', 54, '2016-04-15 14:32:31', '0000-00-00 00:00:00', '', 20, 0),
(23, 73, 'this i st', 54, '2016-04-15 14:34:17', '0000-00-00 00:00:00', '', 15, 0),
(24, 73, 'this is test 2', 54, '2016-04-15 14:37:54', '0000-00-00 00:00:00', '', 16, 0),
(25, 78, 'Hi', 44, '2016-04-15 16:05:48', '0000-00-00 00:00:00', '', 16, 0),
(26, 78, 'Hello ronnie test', 44, '2016-04-19 13:23:22', '0000-00-00 00:00:00', '', 15, 0),
(27, 73, 'testings', 54, '2016-04-19 14:12:39', '0000-00-00 00:00:00', '', 20, 0),
(28, 78, 'New Incident - Fire', 44, '2016-04-25 17:58:02', '2016-04-25 18:02:18', 'Marking Incident Log', 20, 1),
(29, 72, 'Life not working', 50, '2016-04-26 14:49:13', '2016-04-26 17:25:47', 'Problem solved. Lift fully functional', 15, 1),
(30, 78, 'Incident on Wednesday 27thapr16. Some theft happened.', 44, '2016-04-27 16:45:49', '2016-04-27 16:58:43', 'Yes issue theft resolved! FG', 21, 1),
(31, 78, 'Missing Mouse', 44, '2016-04-28 10:51:01', '2016-04-28 10:57:59', 'Finally Found!', 21, 1),
(32, 73, 'this is report', 54, '2016-04-28 18:17:51', '0000-00-00 00:00:00', '', 15, 0),
(33, 73, 'this is testesing', 54, '2016-04-28 18:19:30', '0000-00-00 00:00:00', '', 15, 0),
(34, 92, 'I have fire in my kitchen', 59, '2016-05-05 13:59:45', '2016-05-05 14:02:38', 'Its resolved ,, chill out mate.\n', 20, 1),
(38, 78, 'Testing Incident', 44, '2016-05-10 22:37:19', '2016-05-10 23:02:40', '', 16, 1),
(39, 92, 'Missing dog', 59, '2016-05-11 16:41:11', '2016-05-11 16:43:21', 'Hi.. Thanks for your help i found it in my house .\n', 21, 1),
(40, 78, 'Missing Mouse Wednesday', 44, '2016-05-11 19:01:12', '2016-05-11 19:02:17', 'Found the mouse xD:', 21, 1),
(41, 90, 'Floor crack in lobby area. pls repair asap to avoid accidents', 50, '2016-05-17 17:58:58', '0000-00-00 00:00:00', '', 16, 0),
(42, 73, 'this is report testing', 54, '2016-05-19 18:43:17', '0000-00-00 00:00:00', '', 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `ID` int(32) NOT NULL AUTO_INCREMENT,
  `msg_text` text NOT NULL,
  `sender` int(32) NOT NULL,
  `receiver` int(32) NOT NULL,
  `msg_time` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `session_id` int(32) NOT NULL,
  `person_id` int(32) NOT NULL,
  `code` varchar(155) NOT NULL,
  `insertDate` datetime NOT NULL,
  `msg_time` text NOT NULL,
  `read_noti` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `session_id`, `person_id`, `code`, `insertDate`, `msg_time`, `read_noti`) VALUES
(1, 78, 5, 'New Comment', '2016-05-07 19:59:20', '1462622360', 0),
(2, 78, 78, 'New Comment', '2016-05-07 20:02:39', '1462622559', 0),
(3, 78, 78, 'New Comment', '2016-05-07 21:08:50', '1462626530', 0),
(4, 78, 78, 'New Comment', '2016-05-08 00:44:28', '1462639468', 0),
(5, 78, 78, 'New Comment', '2016-05-09 16:55:08', '1462784108', 0),
(6, 78, 78, 'New Comment', '2016-05-10 13:27:35', '1462858055', 0),
(7, 78, 78, 'New Comment', '2016-05-10 13:40:08', '1462858808', 0),
(8, 73, 73, 'New Comment', '2016-05-10 14:17:41', '1462861061', 0),
(9, 73, 73, 'New Comment', '2016-05-10 14:26:17', '1462861577', 0),
(10, 73, 73, 'New Comment', '2016-05-10 14:31:35', '1462861895', 0),
(11, 73, 73, 'New Comment', '2016-05-10 14:35:07', '1462862107', 0),
(12, 73, 73, 'New Comment', '2016-05-10 14:39:07', '1462862347', 0),
(13, 73, 95, 'New Comment', '2016-05-10 19:25:46', '1462879546', 0),
(14, 78, 78, 'New Comment', '2016-05-11 00:43:47', '1462898627', 0),
(15, 78, 78, 'New Comment', '2016-05-11 08:30:27', '1462926627', 0),
(16, 73, 73, 'New Comment', '2016-05-11 11:34:12', '1462937652', 0),
(17, 73, 73, 'New Comment', '2016-05-11 11:35:01', '1462937701', 0),
(18, 73, 73, 'New Comment', '2016-05-11 11:47:58', '1462938478', 0),
(19, 92, 92, 'New Comment', '2016-05-11 14:00:48', '1462946448', 0),
(20, 92, 92, 'New Comment', '2016-05-11 14:00:48', '1462946448', 0),
(21, 92, 92, 'New Comment', '2016-05-11 14:00:51', '1462946451', 0),
(22, 78, 78, 'New Comment', '2016-05-11 16:14:48', '1462954488', 0),
(23, 78, 78, 'New Comment', '2016-05-11 17:25:06', '1462958706', 0),
(24, 78, 78, 'New Comment', '2016-05-18 18:47:37', '1463568457', 0),
(25, 78, 78, 'New Comment', '2016-05-18 23:11:42', '1463584302', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `posted_by` int(11) NOT NULL,
  `is_resident_post` tinyint(1) NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `condo_id` int(32) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `post_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `posted_by`, `is_resident_post`, `is_featured`, `image_url`, `description`, `condo_id`, `status`, `post_time`) VALUES
(32, 78, 1, 1, '', 'Testing Post', 44, 0, '2016-05-19 11:31:08'),
(4, 73, 1, 1, '', 'hi i am adnan', 54, 0, '2016-05-05 06:20:28'),
(5, 73, 1, 1, '', 'done', 54, 0, '2016-05-06 04:20:28'),
(33, 87, 1, 1, '', 'Today is a really sunny day', 56, 0, '2016-05-20 12:14:47'),
(7, 88, 1, 1, '', 'hi', 57, 0, '2016-05-06 05:20:28'),
(10, 92, 1, 1, '', 'yoooo Whats up.', 59, 0, '2016-05-06 14:20:28'),
(11, 92, 1, 1, '', 'yooo check this out my new stuff \n', 59, 0, '2016-05-05 04:20:28'),
(26, 55, 0, 0, '0', 'Power supply cut off', 50, 1, '2016-05-17 15:57:22'),
(27, 55, 0, 0, '071013_0726_watertankcl2.jpg', 'Water tank under maintenance', 50, 0, '2016-05-17 16:02:15'),
(14, 93, 1, 1, '', 'test post', 59, 0, '2016-05-06 04:10:28'),
(15, 94, 1, 1, '', 'Plumber fixing Tap.', 59, 0, '2016-05-05 04:20:28'),
(20, 92, 1, 1, '', 'I saw a beautiful girl on 11th level ', 59, 0, '2016-05-11 13:59:51'),
(21, 59, 0, 0, 'chair25.jpg', 'this is description', 54, 0, '2016-05-11 13:59:51'),
(22, 59, 0, 0, 'left-post-image.png', 'Water Disruption From 1st March.', 54, 0, '2016-05-11 14:20:12'),
(25, 78, 1, 1, '', 'Found my Mouse', 44, 0, '2016-05-11 17:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `posts_comments`
--

CREATE TABLE IF NOT EXISTS `posts_comments` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `commented_by` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `msg_time` text NOT NULL,
  `insertDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=172 ;

--
-- Dumping data for table `posts_comments`
--

INSERT INTO `posts_comments` (`id`, `comment`, `commented_by`, `post_id`, `msg_time`, `insertDate`) VALUES
(44, 'this is new comment 3', 73, 4, '', '2016-05-06 06:34:29'),
(43, 'this is new comment2', 73, 4, '', '2016-05-06 06:34:17'),
(42, 'this is new comment this is new comment this is new comment this is new comment this is new comment', 73, 4, '', '2016-05-10 04:55:37'),
(10, 'hi', 73, 4, '', '2016-04-27 05:38:56'),
(11, 'yo', 73, 4, '', '2016-04-27 05:39:01'),
(169, 'Finding it..', 78, 25, '', '2016-05-11 09:25:06'),
(13, 'beautiful pictures', 73, 4, '', '2016-04-28 04:59:25'),
(170, 'lp', 78, 25, '', '2016-05-18 10:47:37'),
(165, 'hi who was she ', 92, 20, '', '2016-05-11 06:00:48'),
(159, 'hi', 95, 4, '', '2016-05-10 11:25:46'),
(20, 'Heat in London', 92, 11, '', '2016-05-04 10:38:14'),
(21, 'Nothing', 93, 10, '', '2016-05-04 11:04:11'),
(22, 'Wa wa...', 92, 11, '', '2016-05-05 03:06:26'),
(23, 'good View Waqas', 92, 14, '', '2016-05-05 03:16:31'),
(24, 'Upload your DP as well plz.', 92, 14, '', '2016-05-05 03:16:48'),
(25, 'Gonna test it...', 94, 10, '', '2016-05-05 03:27:51'),
(45, 'ccccc', 73, 4, '', '2016-05-06 06:54:04'),
(46, 'testing', 73, 4, '', '2016-05-06 07:09:41'),
(47, 'texting 2', 73, 4, '', '2016-05-06 07:10:01'),
(48, 'testing 3', 73, 4, '', '2016-05-06 07:12:01'),
(51, 'Please fix it properly ..', 92, 15, '', '2016-05-06 08:36:53'),
(158, 'a light brown fox jump over lazy dog. a light brown fox jump over lazy dog. a light brown fox jump over lazy dog. a light brown fox jump over lazy dog. a light brown fox jump over lazy dog.', 73, 4, '', '2016-05-10 06:39:07'),
(157, 'a light brown fox jump over lazy dog. a light brown fox jump over lazy dog. a light brown fox jump over lazy dog. a light brown fox jump over lazy dog. a light brown fox jump over lazy dog. ', 73, 4, '', '2016-05-10 06:35:07'),
(156, 'dadsfsad as fasfsf adsf adf', 73, 4, '', '2016-05-10 06:31:35'),
(155, 'can you hear me?', 73, 4, '', '2016-05-10 06:26:17'),
(154, 'hello i am sanaullah', 73, 4, '', '2016-05-10 06:17:41'),
(153, 'rt', 78, 8, '', '2016-05-10 05:40:08'),
(162, 'hello i am sanaullah', 73, 4, '', '2016-05-11 03:34:12'),
(150, 'u', 78, 8, '', '2016-05-07 16:44:28'),
(166, 'hi who was she ', 92, 20, '', '2016-05-11 06:00:48'),
(167, '????', 92, 20, '', '2016-05-11 06:00:51'),
(163, 'hi there lorem ipsum. hi there lorem ipsum. hi there lorem ipsum. hi there lorem ipsum. hi there lorem ipsum. hi there lorem ipsum. hi there lorem ipsum. ', 73, 16, '', '2016-05-11 03:35:01'),
(147, 'opop', 5, 9, '', '2016-05-07 11:59:20'),
(164, '2 hi there lorem ipsum. hi there lorem ipsum. hi there lorem ipsum. hi there lorem ipsum. hi there lorem ipsum. hi there lorem ipsum. hi there lorem ipsum. 2', 73, 16, '', '2016-05-11 03:47:58'),
(171, 'vb', 78, 28, '', '2016-05-18 15:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `posts_images`
--

CREATE TABLE IF NOT EXISTS `posts_images` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `post_id` int(32) NOT NULL,
  `image_url` varchar(155) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `posts_images`
--

INSERT INTO `posts_images` (`id`, `post_id`, `image_url`) VALUES
(72, 0, 'portriat1.jpg'),
(71, 0, 'portriat.jpg'),
(69, 0, 'chair23.jpg'),
(70, 0, 'chair33.jpg'),
(68, 0, 'chair12.JPG'),
(4, 2, 'Koala.jpg'),
(5, 2, 'Penguins.jpg'),
(6, 2, 'Tulips.jpg'),
(29, 0, 'chair31.jpg'),
(28, 0, 'chair21.jpg'),
(10, 4, 'login-bg1.jpg'),
(11, 4, 'PH-5090099991.jpg'),
(12, 4, 'login-bg2.jpg'),
(13, 4, 'PH-5090099992.jpg'),
(30, 9, '120-x-600.jpg'),
(15, 5, 'bb-home.png'),
(16, 5, 'bb-landing-page.png'),
(17, 5, 'bb-promotion-page.png'),
(18, 6, 'chair1.JPG'),
(19, 6, 'chair2.jpg'),
(20, 6, 'chair3.jpg'),
(32, 9, '300-X-250.jpg'),
(31, 9, '160-X-600.jpg'),
(24, 7, '32634-1.png'),
(25, 8, '3D_Web_Design.png'),
(26, 8, '4.jpg'),
(27, 8, '6bcbd105cd1f89af3fef020d8ac7034d.jpg'),
(33, 0, '026.JPG'),
(34, 11, '005.JPG'),
(35, 11, '024.JPG'),
(36, 11, '030.JPG'),
(37, 11, '031.JPG'),
(38, 0, '37d92d9a-d9db-444f-9ae9-742680c75506_1023_612.jpg'),
(39, 0, '862594_15041410350026856401.jpg'),
(40, 0, '49233847.jpg'),
(41, 0, 'ean-538784-11857736_37_b-image.jpg'),
(42, 0, 'Hotel-Jen-Penang-photos-Exterior.JPEG'),
(43, 0, '37d92d9a-d9db-444f-9ae9-742680c75506_1023_6121.jpg'),
(44, 0, '862594_150414103500268564011.jpg'),
(45, 0, '492338471.jpg'),
(46, 0, 'ean-538784-11857736_37_b-image1.jpg'),
(47, 19, 'chair13.JPG'),
(48, 12, 'chair23.jpg'),
(49, 22, 'chair36.jpg'),
(50, 19, 'fixing2.jpg'),
(51, 12, 'no-image2.jpg'),
(52, 21, 'chair14.JPG'),
(53, 19, 'chair24.jpg'),
(54, 13, 'chair37.jpg'),
(55, 21, 'fixing3.jpg'),
(56, 13, 'no-image3.jpg'),
(57, 14, '862594_15041410350026856401.jpg'),
(58, 14, '49233847.jpg'),
(59, 14, 'ean-538784-11857736_37_b-image.jpg'),
(60, 14, 'evergreenlaurelpenang.jpg'),
(61, 15, 'condo.jpg'),
(62, 16, 'chair11.JPG'),
(63, 16, 'chair22.jpg'),
(64, 16, 'chair32.jpg'),
(65, 16, 'fixing.jpg'),
(66, 16, 'no-image.jpg'),
(75, 19, 'chair13.JPG'),
(74, 0, 'fixing1.jpg'),
(73, 0, 'portriat2.jpg'),
(76, 19, 'chair24.jpg'),
(77, 19, 'chair34.jpg'),
(78, 19, 'fixing2.jpg'),
(79, 20, 'IMG_0293.JPG'),
(80, 0, 'chair25.jpg'),
(81, 20, 'IMG_0377.JPG'),
(82, 20, 'IMG_0648.JPG'),
(83, 21, 'chair14.JPG'),
(84, 21, 'chair26.jpg'),
(85, 21, 'chair35.jpg'),
(86, 21, 'fixing3.jpg'),
(87, 20, 'IMG_0299.JPG'),
(88, 0, 'left-post-image.png'),
(89, 22, 'chair15.JPG'),
(90, 22, 'chair27.jpg'),
(91, 22, 'chair36.jpg'),
(92, 0, 'apply.jpg'),
(95, 25, '3D_Web_Design1.png'),
(94, 25, '3.jpg'),
(96, 0, '071013_0726_watertankcl2.jpg'),
(97, 27, 'water-tank-cleaning-service-250x250.jpg'),
(98, 28, 'CoverPhoto_OpenDay_2016_Jan_FB-2.jpg'),
(99, 29, 'DSC_1020.JPG'),
(100, 30, 'gym.jpg'),
(101, 30, 'mines.jpg'),
(102, 30, 'rythm.JPG'),
(103, 31, 'mines1.jpg'),
(104, 31, 'regina.jpg'),
(105, 31, 'sauna.jpg'),
(106, 32, 'mines2.jpg'),
(107, 32, 'regina1.jpg'),
(108, 32, 'rythm1.JPG'),
(109, 32, 'sauna1.jpg'),
(110, 0, 'Parking_Space2.jpeg'),
(111, 33, '710388.jpg'),
(112, 0, 'sana.jpg'),
(113, 0, 'sana1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE IF NOT EXISTS `residents` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `condo_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `block` varchar(100) NOT NULL,
  `floor` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `verify_code` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `date_registered` date NOT NULL,
  `last_login` datetime NOT NULL,
  `ip` varchar(100) NOT NULL,
  `forgot_pass_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `condo_id`, `name`, `email`, `phone`, `password`, `type`, `block`, `floor`, `unit`, `verify_code`, `image_url`, `status`, `date_registered`, `last_login`, `ip`, `forgot_pass_count`) VALUES
(64, 54, 'sss', 'sanakust@yahoo.com', '423423', '81dc9bdb52d04dc20036dbd8313ed055', '1', '10', 'G', '1', '49c5dad110cc1ee6de181f79122c6859', '', 2, '2016-04-04', '0000-00-00 00:00:00', '', 0),
(95, 54, 'bilal', 'bilalmasood2665@gmail.com', '0308480304', '81dc9bdb52d04dc20036dbd8313ed055', '2', '26', '4', '21', 'ba52861af5823a9571a4457efeb0146d', '', 1, '2016-05-10', '2016-05-10 19:00:49', '39.32.151.120', 0),
(23, 1, 'Dani Hussain4', 'dani@getranked.com.my', '+60177092790', '3ffaf00ea789e71126a412147698cdc6', '2', '9', 'G', '1', 'b520c1671a52cc93ddc9d8cc73ad5be5', '', 0, '2016-03-30', '0000-00-00 00:00:00', '', 0),
(4, 44, 'Dani Hussain', 'dani2@getranked.com.my', '+60177092790', '0181568827d362d5f7d33a5c95b2dca0', '2', '15', '18', '20', 'b520c1671a52cc93ddc9d8cc73ad5be5', '', 2, '0000-00-00', '0000-00-00 00:00:00', '', 0),
(5, 44, 'Naeem Hussain', 'dani4@getranked.com.my', '+923009196543', '82cc921c6a5c6707e1d6e6862ba3201a', '1', '15', 'G', '1', 'b520c1671a52cc93ddc9d8cc73ad5be5', '', 1, '0000-00-00', '2016-05-09 11:36:11', '202.129.163.230', 0),
(54, 46, 'Muhammad ', 'muhammad@getranked.com.my', '017-7485-6985', '2e3b4e5bc05c0b678ec769adc918409b', '1', '23', '5', '110', '5e9dee17d84d5133bb6c9744f8b79253', 'IMG_0264.JPG', 0, '2016-04-04', '2016-04-13 17:32:14', '202.129.163.230', 2),
(71, 54, 'sanaullahtest2', 'sanaullahAhmad@gmail.com', '6666666666', '81dc9bdb52d04dc20036dbd8313ed055', '2', '10', 'G', '1', '659bac52c35f2b34fa7a310cdb366a4f', 'portriat.jpg', 1, '2016-04-08', '2016-04-13 18:34:27', '39.32.20.58', 0),
(90, 50, 'Marc', 'marrcuss.lim@gmail.com', '0122783997', '4e74612466aa473adba4e4f77e14e50a', '2', '24', '8', '13', '3a859dbe469596bb17f19268bd9885f7', '', 1, '2016-04-28', '2016-05-19 19:20:03', '113.210.65.6', 0),
(78, 44, 'Ronnie Palmcourt', 'sdsuresh22@hotmail.com', '123347', '6a898eca5bf710c5e2541ca895598e7e', '2', '15', 'G', '6', '82291442b9b2fa9405594ffccc0bdfcc', 'dudes14.jpg', 1, '2016-04-12', '2016-05-20 19:51:34', '202.129.163.230', 2),
(72, 50, 'ML', 'marcuslimkl@gmail.com', '012273997', '4e74612466aa473adba4e4f77e14e50a', '2', '24', '15', '10', '3a859dbe469596bb17f19268bd9885f7', '', 1, '2016-04-08', '2016-04-26 17:21:49', '113.210.55.167', 2),
(73, 54, 'sanaullah', 'sana@getranked.com.my', '423423', '81dc9bdb52d04dc20036dbd8313ed055', '1', '26', 'G', '1', '83dfd1cb85018ba979f8c753c965e967', 'chair2.jpg', 1, '2016-04-11', '2016-05-20 13:43:48', '39.32.238.66', 0),
(77, 1, 'Dani Hussain', 'hr@getranked.com.my', '+60177092790', 'e94d51a35484755a9f9672d13687f499', '2', '9', '2', '7', 'fcdfe6ed76f83af0e942a4d9fd0bacde', '14260567-macro-close-up-of-female-hands-on-laptop-keyboard.jpg', 1, '2016-04-12', '2016-04-12 17:26:51', '202.129.163.230', 0),
(92, 59, 'Saqib ', 'saqib.eq@gmail.com', '017-656-9760', '6a898eca5bf710c5e2541ca895598e7e', '2', '36', '10', '20', 'bec66c5fc9d31e41fbf33a4b7a97bf97', 'IMG_02641.JPG', 1, '2016-05-04', '2016-05-11 16:27:36', '202.129.163.230', 2),
(91, 58, 'scott Vila Resident', 'sdsuresh22@gmail.com', '0123456', '82cc921c6a5c6707e1d6e6862ba3201a', '2', '34', '15', '6', '149d6050fb0a0dc340253b3334911fee', '', 1, '2016-04-28', '0000-00-00 00:00:00', '', 0),
(93, 59, 'Waqas', 'waqas@getranked.com.my', '017-569-8745', '81dc9bdb52d04dc20036dbd8313ed055', '2', '38', '10', '20', '56815eb659c9d8f4407f9bfa44eefee5', 'images.jpg', 1, '2016-05-04', '2016-05-04 19:24:32', '58.65.150.53', 5),
(83, 54, 'ddsf', 'sana@getranked.com.my2', '', '81288b8554d6102de13b6b99afdbed0d', '2', '26', 'G', '1', '70940555e73dcd77dd6cd0b302284ffc', '', 0, '2016-04-26', '0000-00-00 00:00:00', '', 0),
(84, 54, 'sana4', 'sanakust@yahoo.com2', '34343', '67a78e9856930cc37c8bdcb896f5f674', '1', '26', '13', '18', '5f6fef9ef0a28374b88d2ba0b758a5ec', '', 2, '2016-04-26', '0000-00-00 00:00:00', '', 0),
(86, 44, 'Marrcuss', 'marrcuss.lim@gmail.com', '0122783997', '4e74612466aa473adba4e4f77e14e50a', '2', '15', '3', '5', '3a859dbe469596bb17f19268bd9885f7', '', 1, '2016-04-27', '2016-05-18 21:32:32', '103.26.249.253', 0),
(87, 56, 'Marrcuss', 'marrcuss.lim@gmail.com', '0122783997', '4e74612466aa473adba4e4f77e14e50a', '2', '30', '10', '7', '3a859dbe469596bb17f19268bd9885f7', '20160513_193034.jpg', 1, '2016-04-27', '2016-05-20 13:12:19', '103.26.249.252', 0),
(94, 59, 'Ronnie', 'ronnie@getranked.com.my', '0123456', '6a898eca5bf710c5e2541ca895598e7e', '2', '35', '15', '20', '82291442b9b2fa9405594ffccc0bdfcc', 'dudes11.jpg', 1, '2016-05-05', '2016-05-05 14:38:35', '39.32.144.202', 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category_id`, `name`, `image_url`) VALUES
(29, 29, 'Service 6', 'Facebook-Covers-005.jpg'),
(27, 28, 'Service 5', 'Koala6.jpg'),
(23, 29, 'Service 1', 'Chrysanthemum3.jpg'),
(24, 41, 'Service 2', 'Lighthouse5.jpg'),
(25, 41, 'Service 3', 'Tulips5.jpg'),
(30, 45, 'Home Cleaning Service ', 'download1.jpg'),
(16, 27, 'Plumbing Work', 'plumber.jpg'),
(17, 27, 'Electrician', 'electrician.jpg'),
(31, 30, 'Upgrading Service', 'maps.JPG'),
(32, 46, 'Electrical Repairs', 'electrical_repairs.jpg'),
(33, 46, 'Electrical and Wiring Installation', 'elecrical_installation.jpg'),
(35, 47, 'Air-Con Installation', 'aircon_installation.jpg'),
(37, 47, 'Air Con Servicing', 'Aircon_Servicing.jpg'),
(38, 49, 'Plumbing Installation', 'Plumbing-Installation.jpg'),
(39, 49, 'Plumbing Service', 'plumbing_service.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services_categories`
--

CREATE TABLE IF NOT EXISTS `services_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `services_categories`
--

INSERT INTO `services_categories` (`id`, `name`, `image_url`) VALUES
(49, 'Plumbing', 'plumbing1.jpg'),
(47, 'Air Conditioning', 'Aircon.jpg'),
(41, 'Fixing & Installation', 'Tools_fix-it-625x290.jpg'),
(45, 'Cleaning Service ', 'download.jpg'),
(29, 'Interior Design', 'Homepolish-7256-interior-design-81fe7ced.jpeg'),
(30, 'Home Renovation', 'Home-renovation-socal.jpg'),
(31, 'Pest Control', 'exterminator.jpg'),
(46, 'Electrical and Wiring', 'electrical.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service_quotes`
--

CREATE TABLE IF NOT EXISTS `service_quotes` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `service_request_id` int(32) NOT NULL,
  `description` text NOT NULL,
  `amount` float NOT NULL,
  `quotation_file` varchar(100) NOT NULL,
  `min_budget` varchar(10) NOT NULL DEFAULT '0',
  `max_budget` varchar(10) NOT NULL DEFAULT '0',
  `quoted_on` int(32) NOT NULL,
  `quoted_by` int(10) NOT NULL,
  `status` int(11) NOT NULL,
  `ven_arival_time` datetime NOT NULL,
  `resident_phone` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `service_quotes`
--

INSERT INTO `service_quotes` (`id`, `service_request_id`, `description`, `amount`, `quotation_file`, `min_budget`, `max_budget`, `quoted_on`, `quoted_by`, `status`, `ven_arival_time`, `resident_phone`) VALUES
(2, 1, 'this is qoute description', 0, '', '0', '0', 2016, 14, 1, '0000-00-00 00:00:00', ''),
(3, 4, 'this is repy by vendor', 70, '', '0', '0', 2016, 14, 3, '0000-00-00 00:00:00', ''),
(5, 7, 'this sana vendor testing qoute', 21, '', '0', '0', 2016, 14, 3, '0000-00-00 00:00:00', ''),
(19, 21, 'Ok I am willing to do that', 0, 'download_(8).jpg', '30', '50', 2016, 18, 1, '2016-05-15 11:00:00', ''),
(16, 18, 'Ok i can fix your tap', 0, 'a4copy.jpg', '50', '100', 2016, 18, 1, '2016-05-13 10:20:00', ''),
(11, 16, 'lest des', 56, 'chair1.JPG', '45', '55', 2016, 14, 0, '2016-05-11 10:50:00', '676767676'),
(14, 17, 'Gelplp', 12, '1106271124pyramid1.jpg', '', '', 2016, 18, 2, '0000-00-00 00:00:00', ''),
(18, 20, 'i am willing to do that', 0, '3.jpg', '50', '200', 2016, 17, 0, '0000-00-00 00:00:00', ''),
(17, 19, 'Hello Hi ronnie palmcourt', 0, 'maps.JPG', '10', '20', 2016, 18, 1, '2016-05-08 07:18:27', ''),
(20, 22, 'RTY', 0, 'Acheivement-banner.jpg', '2', '20', 2016, 18, 1, '2016-05-20 19:20:00', '90808'),
(21, 23, 'floor carpet from vendor', 0, 'Acheivement-banner1.jpg', '20', '100', 2016, 18, 2, '2016-05-21 11:35:00', '97979797');

-- --------------------------------------------------------

--
-- Table structure for table `service_quotes_comments`
--

CREATE TABLE IF NOT EXISTS `service_quotes_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(32) NOT NULL,
  `service_qoute_id` int(11) NOT NULL,
  `actor` varchar(100) NOT NULL,
  `insertDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=122 ;

--
-- Dumping data for table `service_quotes_comments`
--

INSERT INTO `service_quotes_comments` (`id`, `comment`, `sender`, `receiver`, `service_qoute_id`, `actor`, `insertDate`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.\n', 73, 0, 11, 'resident', '2016-05-06 15:38:27'),
(2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.\n', 73, 0, 11, 'resident', '2016-05-06 07:18:27'),
(112, 'Your price is too much!', 78, 18, 19, 'resident', '2016-05-11 18:10:25'),
(111, 'Ok I am willing to do that', 18, 78, 19, 'vendor', '2016-05-11 18:07:09'),
(110, 'yes sure give me call', 92, 17, 18, 'resident', '2016-05-11 16:29:04'),
(109, 'i will come today ', 17, 92, 18, 'vendor', '2016-05-11 14:18:03'),
(108, 'Hi How you doing ??', 92, 17, 18, 'resident', '2016-05-11 14:17:08'),
(107, 'i am willing to do that', 17, 92, 18, 'vendor', '2016-05-11 14:16:03'),
(106, 'Done :)', 78, 18, 17, 'resident', '2016-05-11 13:00:19'),
(105, '50 max', 18, 78, 17, 'vendor', '2016-05-11 13:00:05'),
(104, 'Hi how much?', 78, 18, 17, 'resident', '2016-05-11 12:59:52'),
(121, 'io', 18, 78, 21, 'vendor', '2016-05-19 12:16:20'),
(120, 'Df', 78, 18, 21, 'resident', '2016-05-19 12:12:53'),
(119, 'Ok fine from vendor', 18, 78, 21, 'vendor', '2016-05-19 12:06:09'),
(118, 'hey ', 78, 18, 21, 'resident', '2016-05-19 12:05:55'),
(117, 'floor carpet from vendor', 18, 78, 21, 'vendor', '2016-05-19 12:05:02'),
(116, 'RTY', 18, 78, 20, 'vendor', '2016-05-18 19:21:56'),
(115, 'hi testing', 73, 14, 11, 'resident', '2016-05-16 12:28:39'),
(114, 'lp', 78, 18, 14, 'resident', '2016-05-12 14:06:31'),
(113, 'How much you want?', 18, 78, 19, 'vendor', '2016-05-11 18:12:17'),
(103, 'Hello Hi ronnie palmcourt', 18, 78, 17, 'vendor', '2016-05-11 12:58:55'),
(102, 'Test', 78, 18, 14, 'resident', '2016-05-06 07:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE IF NOT EXISTS `service_requests` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `requested_by` int(32) NOT NULL,
  `condo_id` int(32) NOT NULL,
  `service_id` int(32) NOT NULL,
  `description` text NOT NULL,
  `budget` float NOT NULL,
  `duration` int(11) NOT NULL,
  `service_request_file` varchar(100) NOT NULL,
  `requested_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `requested_by`, `condo_id`, `service_id`, `description`, `budget`, `duration`, `service_request_file`, `requested_time`) VALUES
(1, 73, 54, 24, 'this is description', 778, 0, '', '2016-04-25 16:06:55'),
(3, 78, 44, 24, 'Service test', 20, 0, '', '2016-04-25 18:48:11'),
(4, 78, 44, 24, 'this is description lorum ipsum. ', 76, 0, '', '2016-04-25 19:49:27'),
(5, 78, 44, 31, 'Home Renovation', 100, 0, '', '2016-04-27 16:39:54'),
(6, 73, 54, 24, 'this is sanaullah testing service request to sanakust', 22, 0, '', '2016-04-27 19:17:54'),
(7, 73, 54, 24, 'this is sana.get service request to sanavendor', 22, 0, '', '2016-04-27 19:19:31'),
(9, 78, 44, 30, 'Need a maid for cleaning service on Friday 10AM', 30, 0, '', '2016-04-28 11:52:57'),
(10, 73, 54, 24, 'sdfs sdf', 44, 0, '', '2016-04-28 21:48:40'),
(11, 73, 54, 25, 'this is description', 78, 0, '', '2016-05-03 14:49:23'),
(12, 78, 44, 0, 'Full Area', 0, 0, '', '2016-05-04 18:59:18'),
(13, 78, 44, 25, 'I need to get my air con fixed', 200, 0, '', '2016-05-04 19:25:58'),
(14, 73, 54, 24, 'this is description', 0, 15, '', '2016-05-06 18:01:30'),
(15, 73, 54, 24, 'testng', 0, 7, '', '2016-05-06 18:26:14'),
(16, 73, 54, 24, 'dfdsfsd', 0, 15, 'chair3.jpg', '2016-05-06 18:27:48'),
(17, 78, 44, 31, 'Crack', 0, 7, '32634-1.png', '2016-05-07 20:18:24'),
(18, 78, 44, 24, 'Need to fix tap', 0, 7, '1106271124pyramid1.jpg', '2016-05-10 23:17:21'),
(19, 78, 44, 30, 'Need Maid', 0, 7, 'Penguins.jpg', '2016-05-11 12:55:07'),
(20, 92, 59, 30, 'i want a for cleaning my house. ', 0, 15, '', '2016-05-11 14:13:57'),
(21, 78, 44, 31, 'Please have a new chair for me', 0, 7, '1364971755Neoteric_Banner_web-design1.jpg', '2016-05-11 18:03:37'),
(22, 78, 44, 30, 'Clean', 0, 7, 'adimage.jpg', '2016-05-18 19:19:50'),
(23, 78, 44, 31, 'Floor Carpet', 0, 7, 'BadmintonCourt.jpg', '2016-05-19 12:02:54'),
(24, 73, 54, 24, 'this is testing', 0, 7, '20150821_165542.jpg', '2016-05-19 18:32:52'),
(25, 73, 54, 38, 'this is plumbing description', 0, 7, '20150823_151053.jpg', '2016-05-20 12:52:33'),
(26, 78, 44, 37, 'Some air con work', 0, 15, 'car.jpg', '2016-05-20 19:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(155) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Kuala Lumpur'),
(2, 'Johor '),
(3, 'Kedah'),
(4, 'Kelantan'),
(5, 'Melaka'),
(6, 'Negeri Sembilan '),
(7, 'Pahang '),
(8, 'Penang '),
(9, 'Perak'),
(10, 'Perlis '),
(11, 'Putrajaya '),
(12, 'Sabah '),
(13, 'Sarawak '),
(14, 'Selengor '),
(15, 'Terengganu');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `areas` int(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `state` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_registered` date NOT NULL,
  `verify_code` varchar(100) NOT NULL,
  `forgot_pass_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `company_name`, `phone`, `mobile`, `address`, `areas`, `email`, `state`, `password`, `last_login`, `ip`, `status`, `date_registered`, `verify_code`, `forgot_pass_count`) VALUES
(3, 'Dani Vendor', 'getRanked', '343434', '', 'Salak', 38, 'dani@getranked.com.my', 1, '7c3613dba5171cb6027c67835dd3b9d4', '2016-04-03 16:31:18', '203.106.189.194', 1, '2016-03-24', '83dfd1cb85018ba979f8c753c965e967', 2),
(13, 'sanaullahtest2', 'sfds', '464', '', 'sfsdf', 5, 'sanaullahAhmad@gmail.com', 1, '81dc9bdb52d04dc20036dbd8313ed055', '2016-04-13 18:48:30', '39.32.20.58', 1, '2016-03-27', '659bac52c35f2b34fa7a310cdb366a4f', 2),
(15, 'sanaullahtest244', 'sanacompany', '23232323', '', 'ggggg', 84, 'sana@getranked.com.my23', 2, '0686774f20f6f1cc8d82680a5d0758b6', '0000-00-00 00:00:00', '', 0, '2016-03-30', 'b491499e9cd63827248b4155e1c43511', 0),
(17, 'Saqib ', '5 Start Sdn Bhd', '017-656-9874', '', 'Selangor', 578, 'saqib.eq@gmail.com', 14, '7c3613dba5171cb6027c67835dd3b9d4', '2016-05-11 14:11:21', '202.129.163.230', 1, '2016-04-07', 'bec66c5fc9d31e41fbf33a4b7a97bf97', 0),
(18, 'Ronnie Vendor', 'Ronnie Test Company', '12334', '56456464646456', 'Address', 1, 'sdsuresh22@hotmail.com', 1, '7c3613dba5171cb6027c67835dd3b9d4', '2016-05-19 12:04:04', '202.129.163.230', 1, '2016-04-12', '82291442b9b2fa9405594ffccc0bdfcc', 0),
(14, 'sanaullahVendor', 'sanaVendor', '23232323', '', 'ggggg', 84, 'sana@getranked.com.my', 2, '81dc9bdb52d04dc20036dbd8313ed055', '2016-05-19 18:34:25', '39.32.212.27', 1, '2016-03-30', '659bac52c35f2b34fa7a310cdb366a4f\n', 0),
(19, 'Plumber (Marrcuss)', 'Alpha Plumbing Sdn Bhd', '0122783997', '', 'Bangsar ', 7, 'marrcuss.lim@als.com.my', 1, '6c6e1464695ec20feb0b2a633f9cf27b', '2016-05-20 12:51:41', '103.26.249.252', 1, '2016-05-03', '0d1728d257db84cd2abd8d752c610fa2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_condos`
--

CREATE TABLE IF NOT EXISTS `vendor_condos` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(32) NOT NULL,
  `condo_id` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `vendor_condos`
--

INSERT INTO `vendor_condos` (`id`, `vendor_id`, `condo_id`) VALUES
(60, 18, 50),
(56, 14, 47),
(55, 18, 44),
(54, 14, 33),
(53, 14, 53),
(52, 14, 1),
(59, 18, 1),
(61, 18, 47),
(62, 14, 54),
(63, 17, 59),
(64, 19, 50),
(65, 19, 56);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_services`
--

CREATE TABLE IF NOT EXISTS `vendor_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=143 ;

--
-- Dumping data for table `vendor_services`
--

INSERT INTO `vendor_services` (`id`, `vendor_id`, `service_id`) VALUES
(92, 3, 29),
(122, 14, 23),
(121, 14, 29),
(120, 14, 30),
(102, 13, 23),
(101, 13, 24),
(54, 6, 29),
(53, 6, 25),
(52, 6, 24),
(39, 8, 29),
(38, 8, 26),
(37, 8, 25),
(91, 3, 25),
(90, 3, 23),
(119, 14, 25),
(118, 14, 24),
(123, 14, 31),
(131, 18, 29),
(130, 18, 30),
(129, 18, 25),
(128, 18, 24),
(132, 18, 23),
(133, 18, 31),
(134, 18, 27),
(135, 18, 16),
(136, 18, 17),
(137, 17, 24),
(138, 17, 30),
(139, 17, 29),
(140, 17, 31),
(141, 19, 38),
(142, 19, 39);

-- --------------------------------------------------------

--
-- Table structure for table `visitor_requests`
--

CREATE TABLE IF NOT EXISTS `visitor_requests` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `visitor_name` varchar(100) NOT NULL,
  `visitor_for` int(32) NOT NULL,
  `visitdatetime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `condo_id` int(32) NOT NULL,
  `visitor_reason` text NOT NULL,
  `vehicle_no` varchar(155) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `icid_number` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `visitor_requests`
--

INSERT INTO `visitor_requests` (`id`, `visitor_name`, `visitor_for`, `visitdatetime`, `status`, `condo_id`, `visitor_reason`, `vehicle_no`, `check_in`, `check_out`, `icid_number`) VALUES
(1, '', 73, '2016-04-18 12:37:36', 0, 54, 'this is description', 'this is vihicle number', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(2, '', 73, '2016-04-18 13:22:37', 0, 54, 'this is description 2', 'this is vihicle number 2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(6, 'rwer', 73, '2016-04-12 00:30:00', 0, 54, 'werwer', 'ewrw', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(8, 'weqwe', 73, '0000-00-00 00:00:00', 0, 54, 'qwqwe', '23123', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(9, 'myvisiter', 73, '2016-04-23 11:45:00', 0, 54, 'descriotiop', '34343', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(10, 'wwer', 73, '2016-04-20 23:45:00', 0, 54, 'wrwer', 'werwerwe', '2016-04-20 19:41:30', '2016-04-20 19:41:48', ''),
(11, 'sanaullah visiter', 73, '2016-04-20 14:45:00', 0, 54, 'This is sanaullah description', '1313131', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(12, 'thisi smy name', 73, '2016-04-29 15:15:00', 0, 54, 'this is description', '34343', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(13, 'this is his name', 73, '2016-04-21 15:06:00', 0, 54, 'this is visiter description', 'dsfsdfd', '2016-04-21 14:07:42', '0000-00-00 00:00:00', ''),
(15, 'testing', 73, '2016-04-22 19:45:00', 0, 54, 'thisi sdesc', 'erwrwer', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(17, 'sana visiter', 73, '2016-04-27 13:15:00', 0, 54, 'this is visiter des', '88885', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(20, 'new testing', 73, '2016-04-27 16:10:00', 0, 54, 'this is new testing description', '44445', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(29, 'www', 0, '2016-05-12 21:05:13', 0, 54, 'this is description', '353535', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(25, 'Ali ', 92, '2016-05-05 15:00:00', 0, 59, 'Visiting ', 'WER 5214', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(26, 'Chris', 92, '2016-05-06 22:00:00', 0, 59, 'My friend chris will visit me tomorrow.', 'ASD 8745', '2016-05-05 13:08:03', '0000-00-00 00:00:00', ''),
(27, 'Raja', 0, '2016-05-05 13:17:02', 0, 59, 'visiting my friend Jojo', '79', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(28, 'adnan', 0, '2016-05-10 13:10:26', 0, 59, 'adnan will be visiting ', '512', '2016-05-09 13:32:38', '2016-05-09 13:42:28', ''),
(30, 'testing', 0, '2016-05-10 21:19:25', 0, 54, 'test dec', '838438', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ic id number'),
(34, 'Vinoth', 78, '2016-05-11 16:21:13', 0, 44, 'Desc', 'BNJ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'PLOPPP'),
(33, 'Ronnie Visitor', 78, '2016-05-12 16:30:00', 0, 44, 'Ronnie Visitor Desc', 'EW', '2016-05-11 16:20:15', '2016-05-11 16:20:16', ''),
(35, 'Ronnie', 92, '2016-05-11 17:00:00', 0, 59, 'Meeting ', 'I dont know ', '2016-05-11 16:34:28', '2016-05-11 16:34:31', ''),
(36, 'lucky', 0, '2016-05-11 16:36:11', 0, 59, 'Meeting friend', 'wse1245', '2016-05-11 16:37:06', '2016-05-11 16:37:07', '01488792162325'),
(37, 'Marcuss', 78, '2016-05-12 19:15:00', 0, 44, 'Coming for BBQ', 'SDGH', '2016-05-11 19:10:04', '2016-05-11 19:10:11', ''),
(38, 'Hamid', 78, '2016-05-29 21:00:00', 0, 44, 'In-house Party', 'WFS6723', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
