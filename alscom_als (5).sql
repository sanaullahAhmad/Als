-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2016 at 06:28 PM
-- Server version: 5.5.50-cll
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
(3, 'Ronnie Admin', '82cc921c6a5c6707e1d6e6862ba3201a', 1, 'sdsuresh22@hotmail.com', '82291442b9b2fa9405594ffccc0bdfcc', '2016-03-09', '2016-06-23', '115.132.11.157', 1, 5),
(4, 'Marrcuss Lim', 'ba73050e7933fa354d506da83c00f12b', 1, 'marrcuss.lim@gmail.com', '3a859dbe469596bb17f19268bd9885f7', '2016-03-18', '2016-06-28', '175.143.195.15', 1, 0),
(19, 'sanatest', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'sana@getranked.com.my', '83dfd1cb85018ba979f8c753c965e967', '2016-03-21', '2016-06-26', '39.32.235.236', 1, 12),
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
  `description` text NOT NULL,
  `advert_by` int(11) NOT NULL,
  `is_resident_ad` int(11) NOT NULL DEFAULT '1',
  `image_url` varchar(155) NOT NULL,
  `ad_link` varchar(155) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_date_time` datetime NOT NULL,
  `condo_id` int(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `advert_type` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `adverts`
--

INSERT INTO `adverts` (`id`, `title`, `description`, `advert_by`, `is_resident_ad`, `image_url`, `ad_link`, `payment_status`, `payment_date_time`, `condo_id`, `status`, `advert_type`) VALUES
(10, 'this is title 2', 'Lorem ipsum dummy description', 73, 1, 'portriat.jpg', 'ererer', 0, '0000-00-00 00:00:00', 0, 0, 1),
(11, 'Ad 1', 'Lorem ipsum dummy description', 73, 1, 'cengal.jpg', 'google.com', 1, '2016-04-22 14:21:35', 0, 0, 1),
(12, 'Ad today', 'Lorem ipsum dummy description', 73, 1, 'alpha_care.jpg', 'google.com', 1, '2016-04-25 18:18:02', 0, 0, 1),
(13, 'Ad Today', 'Lorem ipsum dummy description', 73, 1, 'apply.jpg', 'google.com', 1, '2016-04-27 17:32:33', 0, 0, 1),
(14, 'sanatest advertizment', 'Lorem ipsum dummy description', 73, 1, 'portriat1.jpg', 'www.yahoo.com', 0, '0000-00-00 00:00:00', 0, 0, 1),
(15, 'sanatest advertizment', 'Lorem ipsum dummy description', 73, 1, 'portriat2.jpg', 'www.yahoo.com', 1, '2016-04-27 20:11:03', 0, 0, 1),
(20, 'this is title 2', 'Lorem ipsum dummy description', 73, 1, 'portriat6.jpg', 'www.yahoo.com', 1, '2016-04-28 21:10:16', 54, 1, 1),
(21, 'this is title of advertisement', 'Lorem ipsum dummy description', 73, 1, 'chair35.jpg', 'http://www.msn.com', 0, '0000-00-00 00:00:00', 54, 3, 1),
(22, 'this is testing', 'Lorem ipsum dummy description', 73, 1, 'fixing2.jpg', 'http://www.msn.com', 1, '2016-05-03 19:44:15', 54, 1, 2),
(23, 'example', 'Lorem ipsum dummy description', 73, 1, 'chair33.jpg', 'www.example.com', 1, '2016-05-02 18:18:56', 54, 1, 2),
(24, 'this is title 3', 'Lorem ipsum dummy description', 73, 0, 'fixing4.jpg', 'http://www.bng.com5', 1, '0000-00-00 00:00:00', 54, 1, 1),
(25, 'testt617', 'Lorem ipsum dummy description', 73, 1, 'portriat4.jpg', '617.gmail.com', 0, '0000-00-00 00:00:00', 54, 1, 1),
(26, 'sdfsdf', 'Lorem ipsum dummy description', 73, 1, 'portriat5.jpg', 'dfsdf', 1, '2016-05-27 15:44:50', 54, 1, 2),
(27, 'sdfsdf2', 'Lorem ipsum dummy description', 73, 1, 'portriat6.jpg', 'dfsdf', 0, '0000-00-00 00:00:00', 54, 1, 2),
(28, 'sdfsdf', 'Lorem ipsum dummy description', 73, 1, 'portriat5.jpg', 'dfsdf', 0, '0000-00-00 00:00:00', 54, 1, 1),
(29, 'sdfsdf', 'Lorem ipsum dummy description', 73, 1, 'portriat5.jpg', 'dfsdf', 0, '0000-00-00 00:00:00', 54, 1, 1),
(30, 'sdfsdf', 'Lorem ipsum dummy description', 73, 1, 'aircon_installation1_174_174.jpg', 'dfsdf', 1, '2016-05-03 20:22:54', 54, 1, 1),
(31, 'sdfsdf', 'Lorem ipsum dummy description', 73, 1, 'portriat5.jpg', 'dfsdf', 1, '2016-05-03 19:57:58', 54, 1, 1),
(32, 'this is title 5', 'Lorem ipsum dummy description', 73, 1, 'aircon_installation1_174_174.jpg', 'http://www.bng.com5', 1, '2016-05-03 19:55:20', 54, 1, 1),
(36, 'Website ', 'Lorem ipsum dummy description', 92, 1, '3_(1).jpg', 'www.als.com.my', 0, '0000-00-00 00:00:00', 59, 1, 1),
(39, 'test advertisment of bilal', 'Lorem ipsum dummy description', 95, 1, 'security_company_website_designers1.jpg', '', 0, '0000-00-00 00:00:00', 54, 1, 1),
(40, 'Car for sale ', 'Lorem ipsum dummy description', 92, 1, 'security_company_website_designers1.jpg', '', 1, '2016-05-11 16:48:44', 59, 1, 1),
(42, 'Parking Space for Rent (RM150 per month)', 'Lorem ipsum dummy description', 90, 1, 'Parking_Space2.jpeg', '', 0, '0000-00-00 00:00:00', 50, 1, 1),
(43, 'Parking Space For Rent 2', 'Lorem ipsum dummy description', 90, 1, 'Parking_Space21.jpeg', '', 0, '0000-00-00 00:00:00', 50, 1, 1),
(45, 'advert tile', 'Lorem ipsum dummy description', 73, 1, 'fixing14.jpg', '', 0, '0000-00-00 00:00:00', 54, 0, 1),
(46, 'sana advert ', '', 73, 0, 'portriat6.jpg', '', 1, '2016-06-01 14:46:13', 54, 1, 2),
(49, 'this is title', 'this is description', 73, 1, 'chair322.jpg', '', 0, '0000-00-00 00:00:00', 54, 0, 1),
(51, 'Room', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n', 78, 1, '20160601_185716_(1).jpg', '', 1, '0000-00-00 00:00:00', 44, 0, 1),
(50, 'Highcharts Demo', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 78, 1, '9.jpg', '', 1, '0000-00-00 00:00:00', 44, 0, 1),
(53, 'Car for sale', 'Jaguar, F-type, Red, Front view Wallpaper, Background iPhone 6', 78, 1, 'jaguar_f_type_red_front_view_99308_750x1334.jpg', '', 1, '2016-06-02 14:27:52', 44, 1, 3),
(55, 'Testing', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English.', 78, 1, 'straight.jpg', '', 1, '2016-06-02 14:35:20', 44, 1, 2),
(59, 'alpha advertisement', 'this is Alpha advertisement', 0, 0, 'chair324.jpg', '', 1, '0000-00-00 00:00:00', 0, 0, 1),
(60, 'Ad from Alpha', 'Hello testing ad from alpha.', 0, 0, '6.jpg', '', 1, '0000-00-00 00:00:00', 0, 0, 1),
(61, 'Holidays', '', 92, 1, '0', '', 0, '0000-00-00 00:00:00', 59, 0, 1),
(62, 'Sana', 'Savour', 92, 1, '0', '', 0, '0000-00-00 00:00:00', 59, 0, 1),
(63, 'Cat', 'Cat description', 78, 1, '0', '', 0, '0000-00-00 00:00:00', 44, 1, 1),
(64, 'new add', 'new add descrption', 73, 0, 'Aircon.jpg', '', 1, '0000-00-00 00:00:00', 54, 1, 2),
(65, 'fixcing', 'fixcng description', 73, 1, 'fixing16.jpg', '', 0, '0000-00-00 00:00:00', 54, 0, 1),
(66, 'Ad Test', 'Ad Test Description', 78, 1, 'billy.jpg', '', 1, '0000-00-00 00:00:00', 44, 1, 2),
(67, 'sdfsd', 'sdfsdf', 73, 1, 'fixing17.jpg', '', 0, '0000-00-00 00:00:00', 54, 0, 1),
(68, 'sdfsd', 'sdfsdf', 73, 1, 'fixing17.jpg', '', 0, '0000-00-00 00:00:00', 54, 0, 1),
(70, 'Dani', 'sdfsdfd', 78, 1, '300-X-250.jpg', '', 1, '0000-00-00 00:00:00', 44, 1, 2),
(71, 'University Advert', 'I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. I have wrote some really large description. ', 78, 1, '120-x-6001.jpg', '', 1, '2016-06-16 00:00:00', 44, 1, 2),
(75, 'new add 174', 'asd asdf asfda&nbsp;', 73, 1, 'aircon_installation1_174_174.jpg', '', 1, '2016-06-23 17:36:19', 54, 1, 1),
(76, 'Super Bike for Sale', 'The red and white 2015 Yamaha YZF-R1 you see in the photos here is in pristine condition, has barely been ridden in and is ready to go! If you want...', 78, 1, '2013-Suzuki-GSX-R750-For-Sell55965a04d4607afbdfe4.jpg', '', 1, '2016-06-23 00:00:00', 44, 1, 3),
(77, 'New KL Property for Sale', 'KL Residence is a landmark amongst its surroundings. With its strategic location merely 18km away from the Second Link, and surrounded by EduCity, Legoland Theme Park, Medini, Southern Industrial & Logistics Clusters (SILC) and Columbia Asia Private Hospital, residents can enjoy quick and convenient access to these important amenities.  Residents need only step into the exquisite lobby area to feel at home as they will be greeted by the personal concierge. Beautifully designed facilities such as a half-olympic sized swimming pool, sauna and meeting rooms are readily available for the use of its residents.                                                                                                          \n \nFurthermore, there is an impressive, individual building housing a gymnasium well-equipped with the latest Technogym equipments, right next to the beautiful pool and landscaped park. Together with a distinctive touch in its architecture and style, One Sentral provides residents with an opportunity to live a "high" life in the heart of Iskandar Puteri, the future of Johor.\n \n \nKEY FEATURES:-\n1) Grand 5 star lobby with concierge services\n2) All conveniences available at the Ground Floor (Concierge service @ Lobby, Laundromat, F&B outlets & Convenience shops)\n3) 4-tier security system to ensure security of residents\n4) Ample car park spaces available - 716 parking lots\n5) 4 lifts & 1 service lift for each block\n6) Shuttle bus services to Educity, Legoland & bus terminals\n7) High speed broadband connectivity for every apartment unit\n8) Semi-furnished\n \n \nLIFESTYLE & LEISURE FACILITIES @ LEVEL 5:-\n1) A Technogym equipped gym with a full view of the swimming pool\n2) Half-Olympic sized swimming pool\n3) Sky Terrace Garden\n4) Table Tennis Room\n5) Sauna\n6) Pool Deck\n7) Wading Pool\n \n \nFACILITIES @ LEVEL 1:-\n1) Spacious private function rooms\n2) Private library\n3) Meeting rooms\n \nWaze us at Taman Nusa Sentral\nGPS Coordinates 1.468595,103.626075 / 1°28’06.9”N 103°37’33.9”E\n \nFor more info, please visit us at www.countryview.com.my\n\nRead more at http://newlaunch.iproperty.com.my/One-Sentral-Serviced-Residence/5246#ZTjoUq9Bw5ZoQcko.99', 0, 0, 'Tate-on-Howe-Building-Rendering.jpg', '', 1, '0000-00-00 00:00:00', 61, 1, 1),
(78, 'Doris Catering Services', '', 0, 0, 'Catering_Services.jpg', '', 1, '0000-00-00 00:00:00', 61, 1, 1),
(79, 'Best Coffee in Town', '', 0, 0, 'Oliver-Brown-Cafe-Open-Late.jpg', '', 1, '0000-00-00 00:00:00', 61, 1, 1),
(80, 'Laundry Services', '', 0, 0, 'laundry_services.jpg', '', 1, '0000-00-00 00:00:00', 61, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `adverts_images`
--

CREATE TABLE IF NOT EXISTS `adverts_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `advert_id` int(10) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=257 ;

--
-- Dumping data for table `adverts_images`
--

INSERT INTO `adverts_images` (`id`, `advert_id`, `image_url`) VALUES
(1, 15, 'chair12.JPG'),
(2, 15, 'chair21.jpg'),
(3, 15, 'chair33.jpg'),
(4, 15, 'chair22.jpg'),
(12, 50, '5.jpg'),
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
(125, 44, 'car2.jpg'),
(126, 0, 'chair212.jpg'),
(127, 0, 'chair112.JPG'),
(128, 0, 'chair213.jpg'),
(129, 0, 'chair315.jpg'),
(130, 0, 'fixing10.jpg'),
(131, 0, 'chair214.jpg'),
(132, 0, 'chair113.JPG'),
(133, 0, 'chair215.jpg'),
(134, 0, 'chair316.jpg'),
(135, 0, 'chair114.JPG'),
(136, 0, 'chair115.JPG'),
(137, 0, 'chair216.jpg'),
(138, 0, 'chair317.jpg'),
(139, 0, 'fixing11.jpg'),
(140, 0, 'chair116.JPG'),
(141, 0, 'chair117.JPG'),
(142, 0, 'chair217.jpg'),
(143, 0, 'chair318.jpg'),
(144, 0, 'fixing12.jpg'),
(145, 0, 'chair118.JPG'),
(146, 0, 'chair119.JPG'),
(147, 0, 'chair218.jpg'),
(148, 0, 'chair319.jpg'),
(149, 0, 'fixing13.jpg'),
(150, 0, 'fixing14.jpg'),
(151, 45, 'chair120.JPG'),
(152, 45, 'chair219.jpg'),
(153, 45, 'chair320.jpg'),
(154, 45, 'portriat7.jpg'),
(155, 0, 'portriat8.jpg'),
(156, 46, 'chair121.JPG'),
(157, 46, 'chair220.jpg'),
(158, 46, 'chair321.jpg'),
(159, 0, '13.jpg'),
(160, 0, '10.jpg'),
(161, 47, '16.jpg'),
(162, 47, '17.jpg'),
(163, 47, '19.jpg'),
(164, 0, 'Website-Under-Construction-Template.png'),
(165, 48, 'underConstruction.png'),
(166, 48, 'Website-Under-Construction-Template1.png'),
(167, 0, 'chair322.jpg'),
(168, 49, 'chair122.JPG'),
(169, 49, 'chair221.jpg'),
(170, 0, '9.jpg'),
(171, 50, '4.jpg'),
(172, 50, '5.jpg'),
(173, 50, '101.jpg'),
(174, 0, '20160601_185716_(1).jpg'),
(175, 0, '20160601_185716_(1)1.jpg'),
(176, 53, '20160601_185716.jpg'),
(177, 0, 'straight.jpg'),
(178, 55, 'beautiful_natural_scenery_553758.jpg'),
(179, 55, 'sunrise_sun_water.jpg'),
(180, 0, 'chair222.jpg'),
(181, 0, 'chair223.jpg'),
(182, 56, 'chair123.JPG'),
(183, 56, 'chair224.jpg'),
(184, 56, 'chair323.jpg'),
(185, 0, 'chair225.jpg'),
(186, 57, 'portriat9.jpg'),
(187, 0, 'chair324.jpg'),
(188, 59, 'chair124.JPG'),
(189, 59, 'chair226.jpg'),
(190, 59, 'fixing15.jpg'),
(191, 0, '6.jpg'),
(192, 60, '29.jpg'),
(193, 60, '30.jpg'),
(194, 60, '32.jpg'),
(195, 60, '33.jpg'),
(196, 0, 'Aircon.jpg'),
(197, 64, 'BadmintonCourt1.jpg'),
(198, 0, 'BadmintonCourt11.jpg'),
(199, 0, 'Aircon1.jpg'),
(200, 0, 'BadmintonCourt12.jpg'),
(201, 0, 'Aircon2.jpg'),
(202, 0, 'chair227.jpg'),
(203, 0, 'chair125.JPG'),
(204, 65, 'chair325.jpg'),
(205, 65, 'chair228.jpg'),
(206, 65, 'chair126.JPG'),
(207, 65, 'fixing16.jpg'),
(208, 66, 'BadmintonCourt.jpg'),
(209, 66, 'billy.jpg'),
(210, 66, 'apply.jpg'),
(211, 0, 'chair326.jpg'),
(212, 0, 'chair229.jpg'),
(213, 0, 'chair127.JPG'),
(214, 68, 'chair327.jpg'),
(215, 68, 'chair230.jpg'),
(217, 68, 'chair128.JPG'),
(225, 0, '2alp.jpg'),
(226, 0, 'chair328.jpg'),
(224, 0, '2alp.png'),
(227, 0, 'chair233.jpg'),
(228, 0, 'chair329.jpg'),
(229, 0, 'chair234.jpg'),
(230, 0, 'chair235.jpg'),
(231, 0, 'chair330.jpg'),
(232, 0, 'chair236.jpg'),
(233, 0, 'chair331.jpg'),
(234, 0, 'chair237.jpg'),
(235, 70, '320-x-50.jpg'),
(236, 70, '160-X-600.jpg'),
(237, 70, '300-X-600.jpg'),
(239, 70, '120-x-600.jpg'),
(241, 71, '300-X-2501.jpg'),
(242, 0, 'chair131.JPG'),
(244, 72, 'chair132.JPG'),
(245, 73, 'chair333.jpg'),
(248, 0, '20150823_1510531.jpg'),
(249, 0, 'Aircon_Servicing.jpg'),
(250, 0, 'aircon_installation.jpg'),
(253, 0, 'Tate-on-Howe-Building-Rendering.jpg'),
(254, 0, 'Catering_Services.jpg'),
(255, 0, 'Oliver-Brown-Cafe-Open-Late.jpg'),
(256, 0, 'laundry_services.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `archived_posts`
--

CREATE TABLE IF NOT EXISTS `archived_posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `archived_posts`
--

INSERT INTO `archived_posts` (`id`, `post_id`, `date`) VALUES
(1, 80, '0000-00-00 00:00:00'),
(2, 21, '2016-06-27 13:58:37');

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
-- Table structure for table `blacklisted_units`
--

CREATE TABLE IF NOT EXISTS `blacklisted_units` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `condo_id` int(10) NOT NULL,
  `unit` int(10) NOT NULL,
  `disable_facility` int(10) NOT NULL DEFAULT '0',
  `disable_service` int(10) NOT NULL DEFAULT '0',
  `disable_account_creation` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `blacklisted_units`
--

INSERT INTO `blacklisted_units` (`id`, `condo_id`, `unit`, `disable_facility`, `disable_service`, `disable_account_creation`) VALUES
(1, 54, 95, 0, 0, 1),
(2, 54, 84, 0, 1, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

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
(38, 'DD', 59, '20', '40'),
(39, 'Block A', 60, '18', '8'),
(40, 'Block B', 60, '18', '8'),
(41, 'Block C', 60, '18', '8'),
(42, 'A', 61, '20', '10'),
(43, 'B', 61, '20', '10'),
(44, 'C', 61, '21', '8'),
(45, 'D', 61, '21', '8');

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
-- Table structure for table `closing_account_options`
--

CREATE TABLE IF NOT EXISTS `closing_account_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `closing_account_options`
--

INSERT INTO `closing_account_options` (`id`, `name`) VALUES
(4, 'option 2'),
(3, 'option 1'),
(5, 'Option 3');

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
  `privacy` int(2) NOT NULL DEFAULT '1',
  `logo` varchar(155) NOT NULL,
  `condo_picture` varchar(155) NOT NULL,
  `registered_on` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `condos`
--

INSERT INTO `condos` (`id`, `name`, `code`, `email`, `phone`, `mobile`, `address`, `areas`, `state`, `postcode`, `privacy`, `logo`, `condo_picture`, `registered_on`, `status`) VALUES
(1, 'Cengal Condo', 'cengal', 'dani@getranked.com.my', '+60177092790', '+60177092790', 'Jln Sri Permaisuri 2, Bdr Sri Permaisuri', 48, 1, '56000', 1, 'apply1.jpg', 'cengal1.jpg', '2016-06-21 11:47:52', 1),
(54, 'Kinrara Mas', 'kinrara', 'sana@getranked.com.my', '+923329620292', '+923329620292', 'kinrara mass condomium', 129, 3, '44000', 1, 'kinrara_mas.jpg', 'kinrara_mas.jpg', '2016-04-13 17:55:05', 1),
(61, 'KL Residence', 'KLR', 'marrcuss.lim@gmail.com', '', '0122783997', '6, Jalan Sultan Ismail', 29, 1, '50250', 1, 'KL_residence_Logo.jpg', 'KL_residence.jpg', '2016-06-13 16:52:12', 1),
(58, 'Scott Villa', 'SV', 'sdsuresh22@hotmail.com', '12334', '1233', 'Jalan Hulir', 1, 1, '60000', 1, 'mines.jpg', 'mines1.jpg', '2016-06-13 11:31:47', 1),
(44, 'Palmcourt', 'PALM', 'ronnie@getranked.com.my', '601136548996', '601136548996', '15-06, Block D, Jalan Berhala', 10, 1, '40570', 1, 'model.JPG', 'palmcourt.jpg', '2016-04-12 15:46:57', 1),
(47, 'Juta Mines', 'JM', 'sdsuresh22@gmail.com', '12334', '1233', 'Persiaran Seri Timah, Taman Seri Timah', 570, 14, '43300', 1, 'Facebook-Covers-005.jpg', 'mines.jpg', '2016-04-01 14:17:28', 1),
(59, 'Regina USJ 1', 'Kundi', 'saqib.eq@gmail.com', '017-656-9760', '0176569760', 'Regina Usj 1, Jalan Subang Permai, USJ1 47500 Subang Jaya Selangore', 578, 14, '47500', 1, '341.jpg', 'banner-design-900x900.jpg', '2016-05-04 13:10:16', 1),
(56, 'Ken Bangsar', 'KEN', 'marcuslimkl@gmail.com', '0122783997', '0122783997', 'Jalan Kapas, Bangsar, Kuala Lumpur', 7, 1, '59100', 1, 'Ken_Logo1.jpg', 'KEN2.JPG', '2016-06-13 16:52:28', 1),
(60, 'Enda Regal ', 'Pluo umba', 'jojo@getranked.com.my', '017-659-8975', '017-9876541', 'siri pataling ', 58, 1, '65000', 1, 'shutterstock_158522279-1024x682.jpg', '20906-b.jpg', '2016-05-04 17:23:34', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `condo_admins`
--

INSERT INTO `condo_admins` (`id`, `condo_id`, `full_name`, `email`, `phone`, `password`, `verify_code`, `registered_on`, `last_login`, `ip`, `status`, `role`, `forgot_pass_count`, `notification_alert`, `delivery_time_starts`, `delivery_time_ends`) VALUES
(59, 54, 'SanaManager', 'sana@getranked.com.my', '+923329620292', '81dc9bdb52d04dc20036dbd8313ed055', '83dfd1cb85018ba979f8c753c965e967', '2016-04-13 17:55:05', '2016-06-27 16:58:40', '39.32.238.145', 1, 1, 0, 1, '09:30:00', '14:45:00'),
(45, 44, 'Ronnie Security', 'sdsuresh22@gmail.com', '', '82cc921c6a5c6707e1d6e6862ba3201a', '149d6050fb0a0dc340253b3334911fee', '2016-04-01 14:17:28', '2016-05-19 19:06:09', '113.210.65.6', 1, 2, 0, 1, '00:00:00', '00:00:00'),
(46, 1, 'Dani Manager', 'dani@getranked.com.my', '', '1d0258c2440a8d19e716292b231e3190', 'd41d8cd98f00b204e9800998ecf8427e', '2016-04-01 18:39:39', '2016-04-03 16:34:13', '203.106.189.194', 1, 1, 0, 1, '00:00:00', '00:00:00'),
(40, 44, 'Ronnie Manager', 'sdsuresh22@hotmail.com', '+601136548996', '5f4dcc3b5aa765d61d8327deb882cf99', '82291442b9b2fa9405594ffccc0bdfcc', '2016-03-25 18:03:04', '2016-06-28 10:47:59', '202.129.163.230', 1, 1, 0, 1, '09:00:00', '21:00:00'),
(41, 47, 'sana Manager', 'sanaullahAhmad@gmail.com', '+923329620292', '81dc9bdb52d04dc20036dbd8313ed055', '659bac52c35f2b34fa7a310cdb366a4f', '2016-03-27 00:00:00', '2016-06-26 16:56:04', '39.32.235.236', 1, 1, 0, 2, '00:00:00', '00:00:00'),
(42, 33, 'sana Security', 'sanaullahAhmad@gmail.com', '', '81dc9bdb52d04dc20036dbd8313ed055', '659bac52c35f2b34fa7a310cdb366a4f', '2016-03-28 00:00:00', '2016-04-04 12:14:45', '101.50.82.103', 1, 2, 0, 1, '00:00:00', '00:00:00'),
(69, 61, 'USER', 'marrcuss.lim@gmail.com', '', '0795151defba7a4b5dfa89170de46277', '3a859dbe469596bb17f19268bd9885f7', '2016-06-13 16:52:12', '2016-06-28 02:41:21', '175.143.195.15', 1, 1, 0, 1, '00:00:00', '00:00:00'),
(54, 54, 'SanaSecurity', 'sanakust@yahoo.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '49c5dad110cc1ee6de181f79122c6859', '2016-04-04 00:00:00', '2016-06-20 15:14:35', '39.32.34.148', 1, 2, 2, 1, '09:30:00', '14:45:00'),
(65, 59, 'USER', 'saqib.eq@gmail.com', '', '5f4dcc3b5aa765d61d8327deb882cf99', '5e9dee17d84d5133bb6c9744f8b79253', '2016-05-04 12:43:04', '2016-05-11 16:42:47', '202.129.163.230', 1, 1, 2, 1, '10:00:00', '19:00:00'),
(61, 56, 'USER', 'marcuslimkl@gmail.com', '', '0795151defba7a4b5dfa89170de46277', '19f16aef943764113d5d2d49606e6503', '2016-04-27 19:29:38', '2016-05-04 18:56:19', '103.26.249.254', 1, 1, 0, 1, '00:00:00', '00:00:00'),
(63, 58, 'USER', 'sdsuresh22@hotmail.com', '', '78b64bd95ad4033217ed405633ff5e6b', 'ad439a97dba42b58cb58bb6640b71e43', '2016-04-28 10:21:05', '2016-04-28 10:31:12', '202.129.163.230', 1, 1, 0, 1, '00:00:00', '00:00:00'),
(71, 61, 'KLR Security', 'marrcuss.lim@als.com.my', '', '83af648e6d9712795f2cb32ad6c77592', '0d1728d257db84cd2abd8d752c610fa2', '2016-06-14 00:00:00', '2016-06-21 16:07:24', '175.141.240.37', 1, 2, 0, 1, '00:00:00', '00:00:00'),
(66, 60, 'Jojo Manager', 'jojo@getranked.com.my', '', '1d0258c2440a8d19e716292b231e3190', '0ec7d204d017b3fbe0d9c42542c7893e', '2016-05-04 17:23:34', '2016-06-06 12:59:28', '202.129.163.230', 1, 1, 0, 1, '00:00:00', '00:00:00'),
(67, 54, 'Waqas', 'waqas@getranked.com.my', '', '81c2bee78d5b216f15a14ef5dbabe1e7', '56815eb659c9d8f4407f9bfa44eefee5', '2016-05-04 00:00:00', '0000-00-00 00:00:00', '', 1, 1, 0, 1, '09:30:00', '14:45:00'),
(68, 59, 'waqass', 'waqas@getranked.com.my', '', '81c2bee78d5b216f15a14ef5dbabe1e7', '56815eb659c9d8f4407f9bfa44eefee5', '2016-05-05 00:00:00', '2016-05-11 16:34:05', '202.129.163.230', 1, 2, 0, 1, '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `condo_facilities`
--

CREATE TABLE IF NOT EXISTS `condo_facilities` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `condo_id` int(32) NOT NULL,
  `facility_category_id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(155) NOT NULL,
  `price` float NOT NULL,
  `opening_hour` time NOT NULL,
  `closing_hour` time NOT NULL,
  `session_time` int(11) NOT NULL,
  `booking_limit` int(10) NOT NULL,
  `limit_days` int(10) NOT NULL,
  `is_booking_required` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `condo_facilities`
--

INSERT INTO `condo_facilities` (`id`, `condo_id`, `facility_category_id`, `name`, `description`, `image_url`, `price`, `opening_hour`, `closing_hour`, `session_time`, `booking_limit`, `limit_days`, `is_booking_required`) VALUES
(1, 54, 1, 'testname123', 'testdescription123', 'chair1.JPG', 40123, '03:00:00', '15:00:00', 180, 10, 7, 1),
(2, 54, 2, 'testing', 'testing', 'chair3.jpg', 56, '10:00:00', '16:00:00', 240, 10, 7, 1),
(7, 59, 1, 'Swimming Pool', 'Swimming ', 'swmming_pool.jpg', 200, '10:00:00', '16:00:00', 240, 10, 7, 1),
(8, 59, 4, 'Suana Bath ', 'Healthy Life ', 'Suana_Bath.jpg', 0, '10:00:00', '16:00:00', 240, 10, 7, 1),
(9, 59, 4, 'Gym', 'Healthy Life ', 'GYM.jpg', 0, '10:00:00', '16:00:00', 240, 10, 7, 1),
(11, 50, 2, 'Function Room', 'Suitable for meetings, private events and hosting guests', 'OM_Function_Room.jpg', 0, '10:00:00', '16:00:00', 240, 10, 7, 1),
(12, 50, 1, 'BBQ Pit', 'For community and family events', 'OM_BBQ_Pit.jpg', 0, '10:00:00', '16:00:00', 240, 10, 7, 1),
(13, 50, 4, 'Dance Studio', 'Fully air conditioned, suitable for yoga, aerobics and other indoor exercises', 'OM_Dance_Studio.jpg', 0, '10:00:00', '16:00:00', 240, 10, 7, 1),
(14, 50, 3, 'Sauna Room', 'Opening hours (9am-9pm)', 'OM_Sauna.jpg', 0, '10:00:00', '16:00:00', 240, 10, 7, 1),
(18, 54, 1, 'bidminton A', 'bidminton A Description', 'Jellyfish.jpg', 22, '00:00:00', '14:15:00', 660, 10, 7, 1),
(26, 54, 1, 'Service 1', 'fsdaf asdf', '', 55, '08:00:00', '21:00:00', 210, 10, 7, 1),
(30, 47, 14, 'badminton court 1', 'this is badminton court 1 in Kinrara mass', 'BadmintonCourt12.jpg', 500, '08:00:00', '18:00:00', 120, 12, 7, 1),
(29, 44, 13, 'Dining Hall', 'Dining Hall Description', '', 1.2, '15:00:00', '19:00:00', 120, 6, 7, 1),
(28, 44, 12, 'Function Hall A', 'Function Hall A Description', '', 1.1, '13:00:00', '21:00:00', 60, 5, 7, 1),
(31, 61, 17, 'Badminton Court A', 'Badminton Court A in Sports Hall', 'KL_residence_Badminton1.jpg', 0, '09:00:00', '22:00:00', 0, 12, 7, 1),
(32, 61, 17, 'Badminton Court B', 'Badminton Court B in Sports Hall', 'KL_residence_Basketball1.jpg', 0, '09:00:00', '22:00:00', 0, 12, 7, 1),
(33, 61, 18, 'BBQ Pit A', 'BBQ pit A in Block A', '', 0, '09:00:00', '22:00:00', 240, 4, 7, 1),
(34, 61, 15, 'Gym Room', 'Booking not needed. Free to use for all residents.', '', 0, '09:00:00', '22:00:00', 0, 12, 7, 1),
(35, 54, 21, 'n facility', 'desc n facility', '', 44, '06:00:00', '18:00:00', 120, 11, 7, 0),
(36, 54, 1, 'bd', 'dbc', '', 0, '14:00:00', '14:00:00', 0, 0, 7, 0),
(37, 54, 2, 'hk', 'hkc', '', 0, '06:00:00', '16:00:00', 0, 0, 7, 0),
(38, 44, 13, 'Dining Hall A', 'Dining Hall A Description', '', 0, '09:00:00', '18:00:00', 0, 0, 7, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `condo_settings`
--

INSERT INTO `condo_settings` (`id`, `condo_id`, `key_id`, `value`) VALUES
(1, 44, 'bank_info', 'ALL MY BANK INFO WILL GO HERE'),
(2, 44, 'merchant_id', 'test7441'),
(3, 44, 'verify_key', 'adwiqekdfhkjsdhkjsdhksdhklsd'),
(4, 44, 'maintenance_fee', '300'),
(5, 44, 'advert', '2'),
(6, 44, 'processing_fee', '1');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_requests`
--

CREATE TABLE IF NOT EXISTS `delivery_requests` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `condo_id` int(11) NOT NULL,
  `company_name` varchar(155) NOT NULL,
  `reciept` varchar(100) NOT NULL,
  `delivery_for` int(32) NOT NULL,
  `deliverydatetime` datetime NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `icid_number` varchar(100) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `delivery_requests`
--

INSERT INTO `delivery_requests` (`id`, `condo_id`, `company_name`, `reciept`, `delivery_for`, `deliverydatetime`, `description`, `status`, `check_in`, `check_out`, `icid_number`, `driver_name`) VALUES
(1, 54, 'Sam''s Croceria', '', 73, '2016-04-18 12:51:06', 'this is delivery description', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(2, 44, 'Sam''s Croceria', '', 78, '2016-04-19 12:51:06', 'this is delivery description', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(4, 54, 'sanacompany', '', 73, '2016-04-25 10:30:00', 'this is delivery details', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(5, 54, 'rewrwerwrwer w erwerwer', '', 73, '2016-04-26 00:30:00', 'this  fasdfa was w fasfq4r q qw qtqtqt', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(6, 54, 'rewrwerwrwer w erwerwer', '', 73, '2016-04-26 00:30:00', 'this  fasdfa was w fasfq4r q qw qtqtqt', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(7, 54, 'Arsalan company', '', 73, '2016-04-20 10:30:00', 'this is description', 0, '2016-04-20 18:56:54', '2016-04-20 18:58:11', '', ''),
(8, 44, 'Nand services', '', 78, '2016-04-01 10:00:00', 'New Delivery', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(9, 44, 'Nand services', '', 78, '2016-04-20 10:00:00', 'New Delivery ', 0, '2016-04-20 17:51:04', '2016-04-20 17:51:06', '', ''),
(10, 54, 'this is country name', '', 73, '2016-04-14 10:20:00', 'this is description', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(11, 54, 'sdfsd', '', 73, '2016-04-06 13:40:00', 'fsdfs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(12, 54, 'this is test company name', '', 73, '2016-04-09 13:03:00', 'this delivery description', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(13, 54, '46464', '', 73, '2016-04-22 11:10:00', 'this is description', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(14, 54, 'fdfsdfsd', '', 73, '2016-04-20 11:12:00', 'this is del des sana', 0, '2016-04-20 23:13:44', '0000-00-00 00:00:00', '', ''),
(15, 44, 'Demo', '', 78, '2016-04-21 15:56:00', 'RET', 0, '2016-04-21 15:56:47', '2016-04-21 15:56:49', '', ''),
(16, 44, 'Ronnie Comp', '', 78, '2016-04-26 17:30:00', 'New Deleivery', 0, '2016-04-25 18:16:10', '2016-04-25 18:16:12', '', ''),
(17, 54, 'my company', '', 73, '2016-04-27 13:15:00', 'this is de', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(18, 44, 'Marbles', '', 78, '2016-04-27 17:20:00', 'Delivery today', 0, '2016-04-27 17:24:18', '2016-04-27 17:24:19', '', ''),
(19, 44, 'Ronnie Test Company', '', 78, '2016-04-27 16:27:00', 'Delivery added by security', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(20, 54, 'sana company td', '', 73, '2016-04-27 14:10:00', 'this in new testing des', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(21, 44, 'HARVY', '', 78, '2016-04-28 17:20:00', 'Delivery Testing', 0, '2016-04-28 11:22:36', '2016-04-28 11:22:39', '', ''),
(22, 59, '5 Start Sdn Bhd', '', 92, '2016-05-05 18:00:00', 'Furniture Delivery ', 0, '2016-05-05 13:11:28', '0000-00-00 00:00:00', '', ''),
(23, 59, 'solution', '', 0, '2016-05-06 13:17:58', 'delivery', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(24, 59, 'getranked', '', 0, '2016-05-06 13:20:49', 'delivery', 0, '2016-05-05 13:21:07', '0000-00-00 00:00:00', '', ''),
(25, 44, 'LP SDN BHD', '', 78, '2016-05-12 16:30:00', 'Delivery test Ronnie', 0, '2016-05-11 16:20:19', '2016-05-11 16:20:21', '', ''),
(26, 44, 'MLT lmt', '', 78, '2016-05-11 16:21:52', 'LPOP', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'IOP', ''),
(27, 59, 'ASDF ', '', 92, '2016-05-12 18:00:00', 'Furniture ', 0, '2016-05-11 16:35:04', '2016-05-11 16:35:05', '', ''),
(28, 59, 'SONY', '', 0, '2016-05-11 16:38:56', 'Furniture', 0, '2016-05-11 16:39:14', '2016-05-11 16:39:17', '11545421656', ''),
(29, 44, 'IFB', '', 78, '2016-05-12 16:15:00', 'Washing Machine delivery', 0, '2016-05-11 19:15:45', '2016-05-11 19:15:48', '', ''),
(30, 54, 'dsdsds', '', 0, '2016-05-16 15:47:48', 'sdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2323', ''),
(31, 54, 'Company Name', '', 0, '2016-05-16 15:50:32', 'Delivery Details', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'IC/ID number', 'Driver Name'),
(32, 54, 'Company Name', '', 73, '2016-05-16 15:53:11', 'Delivery Details', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Driver Name'),
(33, 54, 'Company Name', '', 73, '2016-05-16 16:02:29', 'Delivery Details', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'IC/ID number', 'Driver Name'),
(34, 44, 'DD', '', 78, '2016-05-19 10:55:00', 'Hi Delivery', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'RT567', 'Arun'),
(35, 44, 'SD', '', 78, '2016-05-19 19:06:57', 'Chicken', 0, '2016-05-19 19:07:21', '2016-05-19 19:07:25', 'DGHTY', 'Driver Name '),
(36, 44, 'Harvey Norman ', '', 86, '2016-05-31 15:30:00', 'New furniture delivery. Please escort vendor to loading bay and guide them to our unit at Block A.', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(37, 44, 'CB', '', 78, '2016-06-03 11:00:00', 'Test', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(38, 54, 'dfadsfasf', '', 73, '2016-06-07 14:00:00', 'new des', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(39, 54, 'new company', '', 71, '2016-06-17 14:00:00', 'this is test description', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `facility_booking`
--

INSERT INTO `facility_booking` (`id`, `resident_id`, `datetime_booked`, `bookedfor_datetime_from`, `bookedfor_datetime_to`, `facility_id`, `condo_id`) VALUES
(61, 98, '2016-06-24 13:31:45', '2016-06-24 13:45:00', '2016-06-24 14:45:00', 28, 44),
(83, 73, '2016-06-28 13:48:43', '2016-07-02 11:00:00', '2016-07-02 14:00:00', 1, 54),
(85, 73, '2016-06-28 17:10:33', '2016-07-03 00:00:00', '2016-07-03 15:00:00', 1, 54),
(84, 73, '2016-06-28 14:09:52', '2016-06-29 03:00:00', '2016-06-29 06:00:00', 1, 54),
(82, 73, '2016-06-28 13:45:49', '2016-07-01 10:45:00', '2016-07-01 13:45:00', 1, 54),
(75, 73, '2016-06-26 18:25:01', '2016-06-27 01:00:00', '2016-06-27 00:00:00', 18, 54),
(81, 73, '2016-06-28 13:35:23', '2016-06-30 11:00:00', '2016-06-30 14:00:00', 1, 54),
(80, 73, '2016-06-28 13:26:53', '2016-06-28 10:30:00', '2016-06-28 13:30:00', 1, 54),
(79, 73, '2016-06-28 13:26:28', '2016-06-29 10:30:00', '2016-06-29 13:30:00', 1, 54),
(78, 0, '2016-06-27 11:56:53', '2016-06-28 13:00:00', '2016-06-28 16:30:00', 26, 54),
(77, 78, '2016-06-27 09:39:29', '2016-06-28 16:45:00', '2016-06-28 18:45:00', 29, 44),
(74, 73, '2016-06-26 16:57:33', '2016-06-29 00:00:00', '2016-06-29 16:00:00', 7, 54),
(73, 71, '2016-06-26 16:54:43', '2016-07-03 10:00:00', '2016-07-03 14:00:00', 12, 54),
(76, 78, '2016-06-26 21:22:24', '2016-06-26 13:00:00', '2016-06-26 14:00:00', 28, 44),
(71, 71, '2016-06-26 16:35:14', '2016-07-01 10:45:00', '2016-07-01 14:45:00', 12, 54);

-- --------------------------------------------------------

--
-- Table structure for table `facility_categories`
--

CREATE TABLE IF NOT EXISTS `facility_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `condo_id` int(11) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `facility_categories`
--

INSERT INTO `facility_categories` (`id`, `name`, `condo_id`, `image_url`) VALUES
(1, 'bidminton', 54, 'Aircon_Servicing.jpg'),
(2, 'hockey', 54, 'Aircon_Servicing.jpg'),
(3, 'cricket', 54, 'Aircon_Servicing.jpg'),
(4, 'swimming pool', 54, 'Aircon_Servicing.jpg'),
(14, 'badminton courts', 47, 'bidminton.jpg'),
(13, 'Dining Hall', 44, 'dining_hall1.jpg'),
(15, 'Gym', 61, 'KL_residence_Condo_Gym.jpg'),
(12, 'Function Hall', 44, 'hallbig1.jpg'),
(16, 'Function Hall', 61, 'KL_Residence_Function_Room.jpg'),
(17, 'Badminton', 61, 'KL_residence_Badminton.jpg'),
(18, 'BBQ', 61, 'KL_residence_BBQ.jpg'),
(19, 'Sauna Room', 61, 'KL_residence_Sauna.jpg'),
(20, 'Basketball', 61, 'KL_residence_Basketball.jpg'),
(21, 'new facility', 54, 'BadmintonCourt13.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `incident_categories`
--

CREATE TABLE IF NOT EXISTS `incident_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `condo_id` int(11) NOT NULL,
  `reports_per_day` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `incident_categories`
--

INSERT INTO `incident_categories` (`id`, `condo_id`, `reports_per_day`, `name`, `image_url`) VALUES
(15, 0, 0, 'Maintenance', ''),
(16, 0, 0, 'Common Area (Swimming Pool, Gym etc)', ''),
(20, 0, 0, 'Fire', ''),
(21, 0, 0, 'Theft', '');

-- --------------------------------------------------------

--
-- Table structure for table `incident_images`
--

CREATE TABLE IF NOT EXISTS `incident_images` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `incident_id` int(32) NOT NULL,
  `image_url` varchar(155) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

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
(44, 0, 'Parking_Space21.jpeg'),
(45, 0, 'sana.jpg'),
(46, 0, 'sana2.jpg'),
(47, 0, 'Chrysanthemum.jpg'),
(48, 0, 'Desert.jpg'),
(49, 0, 'Hydrangeas.jpg'),
(50, 0, 'Jellyfish.jpg'),
(51, 0, 'Hydrangeas1.jpg'),
(52, 0, 'Chrysanthemum1.jpg'),
(53, 0, 'Desert1.jpg'),
(54, 0, 'Hydrangeas2.jpg'),
(55, 0, 'Jellyfish1.jpg'),
(56, 0, 'Chrysanthemum2.jpg'),
(57, 0, 'Desert2.jpg'),
(58, 0, 'Hydrangeas3.jpg'),
(59, 0, 'Jellyfish2.jpg'),
(60, 0, 'Koala.jpg'),
(61, 0, 'Chrysanthemum3.jpg'),
(62, 0, 'Desert3.jpg'),
(63, 44, 'chair1.JPG'),
(64, 44, 'chair21.jpg'),
(65, 44, 'chair33.jpg'),
(66, 44, 'fixing7.jpg'),
(67, 0, 'chair34.jpg'),
(68, 0, 'chair11.JPG'),
(69, 0, 'chair22.jpg'),
(70, 0, 'chair35.jpg'),
(71, 45, 'chair36.jpg'),
(72, 45, 'no-image10.jpg'),
(73, 45, 'no-profile-img-240x30010.gif'),
(74, 45, 'chair23.jpg'),
(75, 45, 'fixing8.jpg'),
(76, 0, 'chair12.JPG'),
(77, 0, '6760135001_58b1c5c5f0_b.jpg'),
(78, 0, 'beautiful_natural_scenery_553758.jpg');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

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
(42, 73, 'this is report testing', 54, '2016-05-19 18:43:17', '0000-00-00 00:00:00', '', 15, 0),
(43, 73, 'this is is report', 54, '2016-05-24 20:05:11', '0000-00-00 00:00:00', '', 15, 0),
(44, 73, 'df asdfa saas', 54, '2016-05-24 20:10:12', '0000-00-00 00:00:00', '', 20, 0),
(45, 73, 'this is description of common area incident', 54, '2016-06-15 16:31:08', '0000-00-00 00:00:00', '', 16, 0),
(46, 78, 'fire near lift block A', 44, '2016-06-25 16:54:59', '0000-00-00 00:00:00', '', 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `payer_id` int(32) NOT NULL,
  `booking_id` int(10) NOT NULL,
  `facility_id` int(10) NOT NULL,
  `payment_for` int(32) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_paid` datetime NOT NULL,
  `system_transaction_id` varchar(155) NOT NULL,
  `transaction_info` varchar(155) NOT NULL,
  `amount_paid` float NOT NULL,
  `payment_receipt` varchar(155) NOT NULL,
  `payment_month` date NOT NULL,
  `payment_channel` varchar(155) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `condo_id` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `payer_id`, `booking_id`, `facility_id`, `payment_for`, `date_created`, `date_paid`, `system_transaction_id`, `transaction_info`, `amount_paid`, `payment_receipt`, `payment_month`, `payment_channel`, `payment_status`, `condo_id`) VALUES
(1, 98, 60, 31, 1, '2016-06-24 13:31:45', '0000-00-00 00:00:00', '1466746305', '', 0, '', '0000-00-00', '', 0, 44),
(2, 98, 62, 34, 1, '2016-06-24 13:32:42', '0000-00-00 00:00:00', '1466746362', '', 0, '', '0000-00-00', '', 0, 44),
(3, 97, 63, 32, 1, '2016-06-24 16:05:50', '0000-00-00 00:00:00', '1466755550', '', 0, '', '0000-00-00', '', 0, 61),
(4, 98, 64, 28, 1, '2016-06-24 18:32:54', '0000-00-00 00:00:00', '1466764374', '', 0, '', '0000-00-00', '', 0, 44),
(5, 78, 65, 29, 1, '2016-06-25 16:53:27', '0000-00-00 00:00:00', '1466844807', '', 0, '', '0000-00-00', '', 0, 44),
(6, 86, 66, 34, 1, '2016-06-25 19:57:00', '0000-00-00 00:00:00', '1466855820', '', 0, '', '0000-00-00', '', 0, 44),
(7, 78, 67, 28, 1, '2016-06-25 23:47:27', '0000-00-00 00:00:00', '1466869647', '', 0, '', '0000-00-00', '', 0, 44),
(8, 71, 68, 28, 1, '2016-06-26 13:48:17', '0000-00-00 00:00:00', '1466920097', '', 0, '', '0000-00-00', '', 0, 54),
(9, 71, 69, 28, 1, '2016-06-26 14:26:55', '0000-00-00 00:00:00', '1466922415', '', 0, '', '0000-00-00', '', 0, 54),
(10, 71, 70, 29, 1, '2016-06-26 15:56:46', '0000-00-00 00:00:00', '1466927806', '', 0, '', '0000-00-00', '', 0, 54),
(11, 71, 71, 12, 1, '2016-06-26 16:35:14', '0000-00-00 00:00:00', '1466930114', '', 0, '', '0000-00-00', '', 1, 54),
(12, 71, 72, 12, 1, '2016-06-26 16:50:53', '0000-00-00 00:00:00', '1466931053', '', 0, '', '0000-00-00', '', 0, 54),
(13, 71, 73, 12, 1, '2016-06-26 16:54:43', '0000-00-00 00:00:00', '1466931283', '', 0, '', '0000-00-00', '', 1, 54),
(14, 73, 74, 7, 1, '2016-06-26 16:57:33', '0000-00-00 00:00:00', '1466931453', '', 0, '', '0000-00-00', '', 1, 54),
(15, 73, 75, 18, 1, '2016-06-26 18:25:01', '0000-00-00 00:00:00', '1466936701', '', 0, '', '0000-00-00', '', 0, 54),
(16, 78, 76, 28, 1, '2016-06-26 21:22:24', '0000-00-00 00:00:00', '1466947344', '', 0, '', '0000-00-00', '', 0, 44),
(20, 78, 77, 29, 1, '2016-06-27 09:39:29', '0000-00-00 00:00:00', '1466991569', '', 0, '', '0000-00-00', '', 0, 44),
(25, 78, 0, 0, 2, '2016-06-28 11:33:40', '0000-00-00 00:00:00', '1467084820', 'This is for my maintenance fee.', 1.1, '', '0000-00-00', 'MOLPAY', 1, 44),
(21, 0, 78, 26, 1, '2016-06-27 10:42:54', '0000-00-00 00:00:00', '1466995374', '', 0, '', '0000-00-00', '', 0, 54),
(26, 73, 79, 1, 1, '2016-06-28 13:26:28', '0000-00-00 00:00:00', '1467091588', '', 0, '', '0000-00-00', '', 0, 54),
(27, 73, 80, 1, 1, '2016-06-28 13:26:53', '0000-00-00 00:00:00', '1467091613', '', 0, '', '0000-00-00', '', 0, 54),
(28, 73, 81, 1, 1, '2016-06-28 13:35:23', '0000-00-00 00:00:00', '1467092123', '', 0, '', '0000-00-00', '', 0, 54),
(29, 73, 82, 1, 1, '2016-06-28 13:45:49', '0000-00-00 00:00:00', '1467092749', '', 0, '', '0000-00-00', '', 0, 54),
(30, 73, 83, 1, 1, '2016-06-28 13:48:43', '0000-00-00 00:00:00', '1467092923', '', 0, '', '0000-00-00', '', 0, 54),
(31, 73, 84, 1, 1, '2016-06-28 14:09:52', '0000-00-00 00:00:00', '1467094192', '', 0, '', '0000-00-00', '', 0, 54),
(32, 73, 85, 1, 1, '2016-06-28 17:10:33', '0000-00-00 00:00:00', '1467105033', '', 0, '', '0000-00-00', '', 0, 54);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE IF NOT EXISTS `invoice_items` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(32) NOT NULL,
  `description` varchar(155) NOT NULL,
  `amount` float NOT NULL,
  `facility_id` int(32) NOT NULL,
  `transaction_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `description`, `amount`, `facility_id`, `transaction_type`) VALUES
(1, 1, 'Function Hall A', 1.1, 28, 'facility'),
(2, 1, 'GST', 0.07, 28, 'facility'),
(3, 2, 'Dining Hall', 1.2, 29, 'facility'),
(4, 2, 'GST', 0.07, 29, 'facility'),
(5, 3, 'Gym Room', 0, 34, 'facility'),
(6, 3, 'GST', 0, 34, 'facility'),
(7, 4, 'Function Hall A', 1.1, 28, 'facility'),
(8, 4, 'GST', 0.07, 28, 'facility'),
(9, 5, 'Function Hall A', 1.1, 28, 'facility'),
(10, 5, 'GST', 0.07, 28, 'facility'),
(11, 6, 'Function Hall A', 1.1, 28, 'facility'),
(12, 6, 'GST', 0.07, 28, 'facility'),
(13, 7, 'Dining Hall', 1.2, 29, 'facility'),
(14, 7, 'GST', 0.07, 29, 'facility'),
(15, 8, 'BBQ Pit', 0, 12, 'facility'),
(16, 8, 'GST', 0, 12, 'facility'),
(17, 9, 'Service 1', 55, 26, 'facility'),
(18, 9, 'GST', 3.3, 26, 'facility'),
(19, 10, 'BBQ Pit', 0, 12, ''),
(20, 10, 'GST', 0, 12, ''),
(21, 11, 'BBQ Pit', 0, 12, ''),
(22, 11, 'GST', 0, 12, ''),
(23, 12, 'BBQ Pit', 0, 12, ''),
(24, 12, 'GST', 0, 12, ''),
(25, 13, 'BBQ Pit', 0, 12, ''),
(26, 13, 'GST', 0, 12, ''),
(27, 14, 'Swimming Pool', 200, 7, ''),
(28, 14, 'GST', 12, 7, ''),
(29, 15, 'bidminton A', 22, 18, ''),
(30, 15, 'GST', 1.32, 18, ''),
(31, 16, 'Function Hall A', 1.1, 28, 'facility'),
(32, 16, 'GST', 0.07, 28, 'facility'),
(39, 19, 'Bills & Payments', 1, 0, ''),
(40, 19, 'Processing Fee', 1, 0, ''),
(41, 19, 'GST', 0.06, 0, ''),
(42, 20, 'Dining Hall', 1.2, 29, ''),
(43, 20, 'GST', 0.07, 29, ''),
(44, 21, 'Swimming Pool', 200, 7, ''),
(45, 21, 'GST', 12, 7, ''),
(55, 25, 'Quick Pay', 0.1, 0, ''),
(56, 25, 'Processing Fee', 1, 0, ''),
(57, 26, 'testname123', 40123, 1, ''),
(58, 26, 'GST', 2, 1, ''),
(59, 27, 'testname123', 40123, 1, ''),
(60, 27, 'GST', 2, 1, ''),
(61, 28, 'testname123', 40123, 1, ''),
(62, 28, 'GST', 2, 1, ''),
(63, 29, 'testname123', 40123, 1, ''),
(64, 29, 'GST', 2, 1, ''),
(65, 30, 'testname123', 40123, 1, ''),
(66, 30, 'GST', 2, 1, ''),
(67, 31, 'testname123', 40123, 1, ''),
(68, 31, 'GST', 2, 1, ''),
(69, 32, 'testname123', 40123, 1, ''),
(70, 32, 'GST', 2, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `knowledge_base`
--

CREATE TABLE IF NOT EXISTS `knowledge_base` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `condo_id` int(10) NOT NULL,
  `privacy` int(2) NOT NULL DEFAULT '0',
  `image_url` varchar(100) NOT NULL,
  `date_uploaded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `knowledge_base`
--

INSERT INTO `knowledge_base` (`id`, `name`, `description`, `condo_id`, `privacy`, `image_url`, `date_uploaded`) VALUES
(1, 'this is nameq23', 'this is description23', 54, 1, 'sample2.pdf', '0000-00-00 00:00:00'),
(2, 'second4', 'second description4', 54, 1, 'sample1.pdf', '0000-00-00 00:00:00'),
(3, 'fsdfsf', 'sfsdfsdsfsdfsdfsdfsdfdfsdfsdf', 54, 1, 'sample.pdf', '0000-00-00 00:00:00'),
(12, 'Hari Raya Kids Party1', '<p>Hari Raya Kids Party Description</p>\n', 44, 1, 'HELP_Psychology_Preview_Aug_20153.pdf', '2016-06-09 13:36:44'),
(6, 'sssd', 'sdfsfs sf sdf', 54, 1, 'pdf11.pdf', '0000-00-00 00:00:00'),
(7, 'test', 'testtesttesttest', 54, 0, 'pdf7.pdf', '0000-00-00 00:00:00'),
(11, 'sana test', 'sana test description', 54, 1, 'pdf15.pdf', '2016-06-09 13:21:23'),
(10, 'sanatest2', 'sanatest description2', 54, 0, 'sample4.pdf', '2016-06-09 12:14:06'),
(13, 'Demo Forms', 'Demo Forms Description', 54, 1, 'BB_LMS_Admin_Dashboard2.pdf', '2016-06-09 16:44:09'),
(14, 'Community Event', '<h2><span><b>Letter of\nInvitation to Community Groups And </b><span><b>Local\n Schools</b><br></span></span></h2><br>Dear\n(Community Group Contact):<br><br>Throughout\nlife, love can come at us fast and stay for ages. National Nursing Home Week, an annual\nobservance that honors the residents and staff of our nation’s nursing\nfacilities, is May 10-16.&nbsp; This year’s\nthem is “Nurturing a Love that Lasts” and on [day] of that week, our facility\nwill be hosting a [choose from your activities].\n\n&nbsp;\n\nOur\ncelebration would be greatly enriched by your organization’s\nparticipation.&nbsp; We are asking key\ncommunity groups such as yours to join us in our festivities as our residents\nand community take center stage. \n\n&nbsp;\n<br><br>Beyond\ncreating an enjoyable place for residents to relax and visit with friends and\nfamilies, we see this event as a very positive way to celebrate the community\nspirit of [your town] and our appreciation for the residents, staff and\nvolunteers of our facility who have given so much to our town.\n\n&nbsp;\n\n<br><span><br>We hope\nyou can join us for this fun and meaningful activity.&nbsp; Please call me at [phone number] or stop by\nat the above address by [date] to let me know if your group will be\nparticipating.</span>\n\n<br><br><br>Sincerely,\n\n&nbsp;\n\n<br>Name \n\nTitle \n\nOrganization', 61, 1, 'evtg-invitation-letter-example-2.pdf', '2016-06-23 23:01:26'),
(15, 'Access Card Application Form', 'To apply for new OR replacement access cards, owners must complete this application form and submit to Management Office.', 61, 1, 'Access-Card-Application-Form-2015.pdf', '2016-06-23 23:16:26'),
(16, 'Tenant Registration Form', 'Owners should complete this tenant registration form before tenants are allowed into the residence.', 61, 1, 'Tenant_Registration_Form.pdf', '2016-06-23 23:18:25'),
(17, 'AGM Report And Minutes', 'Annual report and Financial Statements for the Year&nbsp;2012', 61, 1, 'Annual-Report-2012-111.pdf', '2016-06-23 23:19:55'),
(18, 'sd fasdfasdf', '<p>ds fsdf asdf asdf</p>\n', 54, 1, 'pdf1.pdf', '2016-06-26 18:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `knowledge_base_files`
--

CREATE TABLE IF NOT EXISTS `knowledge_base_files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `knowledge_base_id` int(10) NOT NULL,
  `file_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `knowledge_base_files`
--

INSERT INTO `knowledge_base_files` (`id`, `knowledge_base_id`, `file_url`) VALUES
(42, 7, 'pdf7.pdf'),
(58, 12, 'HELP_Psychology_Preview_Aug_20153.pdf'),
(57, 12, 'Most-Useful-Websites4.pdf'),
(54, 11, 'pdf15.pdf'),
(55, 10, 'sample4.pdf'),
(49, 1, 'sample2.pdf'),
(48, 6, 'pdf11.pdf'),
(50, 8, 'Most-Useful-Websites.pdf'),
(51, 9, 'prepreport.pdf'),
(52, 9, 'Most-Useful-Websites1.pdf'),
(56, 12, 'BB_LMS_Admin_Dashboard1.pdf'),
(28, 4, 'Hydrangeas.jpg'),
(29, 4, 'Chrysanthemum.jpg'),
(43, 7, 'pdf8.pdf'),
(45, 5, 'pdf10.pdf'),
(46, 3, 'sample.pdf'),
(47, 2, 'sample1.pdf'),
(59, 13, 'BB_LMS_Admin_Dashboard2.pdf'),
(60, 13, 'HELP_Psychology_Preview_Aug_20154.pdf'),
(61, 14, 'evtg-invitation-letter-example-2.pdf'),
(62, 14, 'Annual-Report-2012-11.pdf'),
(63, 15, 'Access-Card-Application-Form-2015.pdf'),
(64, 16, 'Tenant_Registration_Form.pdf'),
(65, 17, 'Annual-Report-2012-111.pdf'),
(67, 18, 'pdf1.pdf');

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
  `condo_id` int(32) NOT NULL,
  `insertDate` datetime NOT NULL,
  `msg_time` text NOT NULL,
  `read_noti` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `session_id`, `person_id`, `code`, `condo_id`, `insertDate`, `msg_time`, `read_noti`) VALUES
(1, 78, 78, 'New Comment', 44, '2016-06-24 09:32:37', '1466731957', 0),
(2, 78, 98, 'New Comment', 44, '2016-06-24 18:16:10', '1466763370', 0),
(3, 78, 98, 'New Comment', 44, '2016-06-24 18:16:13', '1466763373', 0),
(4, 78, 98, 'New Comment', 44, '2016-06-24 18:16:15', '1466763375', 0),
(5, 78, 98, 'New Comment', 44, '2016-06-24 18:16:17', '1466763377', 0),
(6, 78, 98, 'New Comment', 44, '2016-06-24 18:16:21', '1466763381', 0),
(7, 78, 98, 'New Comment', 44, '2016-06-24 18:16:27', '1466763387', 0),
(8, 86, 78, 'New Comment', 44, '2016-06-27 14:39:23', '1467009563', 0),
(9, 97, 97, 'New Post', 61, '2016-06-28 02:33:20', '1467052400', 0),
(10, 97, 97, 'New Post', 61, '2016-06-28 02:39:39', '1467052779', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_for`
--

CREATE TABLE IF NOT EXISTS `payment_for` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(155) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment_for`
--

INSERT INTO `payment_for` (`id`, `name`) VALUES
(1, 'Facility Booking'),
(2, 'Bills and Payments');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `is_resident_post` tinyint(1) NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `condo_id` int(32) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `post_time` datetime NOT NULL,
  `edit_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `posted_by`, `is_resident_post`, `is_featured`, `image_url`, `description`, `condo_id`, `status`, `post_time`, `edit_time`) VALUES
(60, '', 73, 1, 1, '', 'sadf asdf asfasdf 4', 54, 0, '2016-05-30 15:53:51', '0000-00-00 00:00:00'),
(33, 'title 33', 87, 1, 1, '', 'Today is a really sunny day', 56, 0, '2016-05-20 12:14:47', '0000-00-00 00:00:00'),
(7, 'title 7', 88, 1, 1, '', 'hi', 57, 0, '2016-05-06 05:20:28', '0000-00-00 00:00:00'),
(72, 'Bahaya Kebakaran', 40, 0, 0, '20.jpg', '<span>liability or <b>exposure </b>to harm or <i>injury</i>; risk; peril.&nbsp;...&nbsp;<b>Danger, hazard, peril, jeopardy imply harm that one may encounter.&nbsp;... Hazard suggests a&nbsp;danger&nbsp;that one can foresee but cannot avoid:</b> A mountain climber is exposed to many hazards.</span><span><br><br>Kindly check it...<br><br></span><br>', 44, 0, '2016-06-21 14:36:44', '0000-00-00 00:00:00'),
(10, 'title 10', 92, 1, 1, '', 'Hi..  how you doing, I am doing great :) ', 59, 0, '2016-05-06 14:20:28', '2016-06-07 09:57:21'),
(11, 'title 11', 92, 1, 1, '', 'yooo check this out my new stuff \n', 59, 0, '2016-05-05 04:20:28', '0000-00-00 00:00:00'),
(26, 'title 26', 55, 0, 0, '0', 'Power supply cut off', 50, 1, '2016-05-17 15:57:22', '0000-00-00 00:00:00'),
(27, 'title 27', 55, 0, 0, '071013_0726_watertankcl2.jpg', 'Water tank under maintenance', 50, 0, '2016-05-17 16:02:15', '0000-00-00 00:00:00'),
(14, 'title 14', 93, 1, 1, '', 'test post', 59, 0, '2016-05-06 04:10:28', '0000-00-00 00:00:00'),
(15, 'title 15', 94, 1, 1, '', 'Plumber fixing Tap.', 59, 0, '2016-05-05 04:20:28', '0000-00-00 00:00:00'),
(21, 'title 21', 59, 0, 1, 'chair25.jpg', 'this is description', 54, 0, '2016-05-11 13:59:51', '0000-00-00 00:00:00'),
(22, 'title 22', 59, 0, 1, 'left-post-image.png', 'Water Disruption From 1st March.', 54, 0, '2016-05-11 14:20:12', '0000-00-00 00:00:00'),
(37, 'this is title', 59, 0, 0, 'portriat7.jpg', 'this is description', 54, 0, '2016-05-23 15:55:22', '0000-00-00 00:00:00'),
(78, '', 4, 1, 1, '', 'Testing Post Arun Palmcourt.', 44, 0, '2016-06-07 13:24:12', '0000-00-00 00:00:00'),
(46, '', 78, 1, 1, '', 'Going Outstation2...', 44, 0, '2016-06-02 18:36:05', '2016-06-15 18:03:27'),
(74, 'Urgent Notice', 40, 0, 0, '71.jpg', 'It is a long established fact that a reader will be <span style="color:#FF0000">distracted</span> by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n', 44, 0, '2016-06-28 14:22:56', '0000-00-00 00:00:00'),
(63, 'Power Supply Shut Off for Maintenance Between 2pm-4pm', 55, 0, 1, 'electrical_repairs.jpg', '', 50, 0, '2016-06-02 15:57:25', '0000-00-00 00:00:00'),
(65, 'Water disruption on 1 June 2016 (2am-6am)', 55, 0, 1, 'water-tank-cleaning-service-250x2501.jpg', 'Water disruption on 1 June 2016 (2am-6am) due to upgrading works', 50, 0, '2016-06-02 16:02:33', '0000-00-00 00:00:00'),
(79, '', 73, 1, 1, '', 'These are my new chairs These are my new chairs ', 54, 0, '2016-06-07 15:50:32', '0000-00-00 00:00:00'),
(67, '', 90, 1, 1, '', 'hello', 50, 0, '2016-06-02 21:03:07', '0000-00-00 00:00:00'),
(68, '', 90, 1, 1, '', 'selling aircon', 50, 0, '2016-06-02 21:05:44', '0000-00-00 00:00:00'),
(75, '', 92, 1, 1, '', 'hi i am not here i am at 11th level.', 59, 0, '2016-06-06 13:55:09', '2016-06-06 14:01:42'),
(76, '', 92, 1, 1, '', 'Test', 59, 0, '2016-06-06 14:28:38', '0000-00-00 00:00:00'),
(80, '', 59, 0, 1, 'chair134.JPG', '', 54, 0, '2016-06-08 13:14:31', '0000-00-00 00:00:00'),
(81, '', 86, 1, 1, '', 'Ronnie is the best', 44, 0, '2016-06-09 17:03:35', '0000-00-00 00:00:00'),
(84, '', 73, 1, 1, '', 'this is my new post with 5 images', 54, 0, '2016-06-15 17:01:19', '2016-06-15 17:51:08'),
(83, '', 95, 1, 1, '', 'a quick brown fox jump over lazy dog.', 54, 0, '2016-06-10 14:08:17', '2016-06-10 14:24:06'),
(85, '', 98, 1, 1, '', 'Hello there testing Primary Owner.', 44, 0, '2016-06-16 18:54:12', '2016-06-16 18:54:54'),
(96, 'this is title2', 41, 0, 0, 'chair160.JPG', 'this is description2', 47, 0, '2016-06-21 15:24:35', '0000-00-00 00:00:00'),
(93, '', 4, 1, 1, '', 'FGH', 44, 0, '2016-06-20 11:51:22', '0000-00-00 00:00:00'),
(89, '', 96, 1, 1, '', 'hi', 60, 0, '2016-06-19 23:04:11', '0000-00-00 00:00:00'),
(99, 'Lift under Maintenance', 69, 0, 1, 'electrical.jpg', '<span>There\nwill be minor maintenance work done between 10 -20 August 2016. During this\ntime please refrain from using Lift A. We are sorry for the inconvenience\ncaused during this time and we will ensure our technicians will work their best\nto have all the lifts in fully functional condition.&nbsp;<br><br></span>There will be minor maintenance work done between 10 -20 August 2016. During this time please refrain from using Lift A. We are sorry for the inconvenience caused during this time and we will ensure our technicians will work their best to have all the lifts in fully functional condition.&nbsp;<br><br>There will be minor maintenance work done between 10 -20 August 2016. During this time please refrain from using Lift A. We are sorry for the inconvenience caused during this time and we will ensure our technicians will work their best to have all the lifts in fully functional condition.&nbsp;<br><br><span><br><br></span>', 61, 0, '2016-06-23 23:30:09', '0000-00-00 00:00:00'),
(98, 'Notice for Testing', 40, 0, 1, '73.jpg', 'Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 44, 0, '2016-06-21 16:56:08', '0000-00-00 00:00:00'),
(100, '', 97, 1, 1, '', 'Amazing resort in Bali. Worth a visit.', 61, 0, '2016-06-28 02:33:20', '2016-06-28 02:34:05'),
(101, '', 97, 1, 1, '', 'Stunning view from the rice fields. Nature is amazing.', 61, 0, '2016-06-28 02:39:39', '2016-06-28 02:40:18'),
(102, 'Notice of Annual General Meeting 2016', 40, 0, 0, '2.jpg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 44, 0, '2016-06-28 13:54:19', '0000-00-00 00:00:00');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `posts_comments`
--

INSERT INTO `posts_comments` (`id`, `comment`, `commented_by`, `post_id`, `msg_time`, `insertDate`) VALUES
(1, 'Hello', 78, 78, '', '2016-06-23 14:53:46'),
(2, 'ohh that bad...', 78, 46, '', '2016-06-24 01:32:37'),
(3, 'RT', 98, 46, '', '2016-06-24 10:16:10'),
(4, 'yu', 98, 46, '', '2016-06-24 10:16:13'),
(5, 'rtrt', 98, 46, '', '2016-06-24 10:16:15'),
(6, 'rtrtrtrt', 98, 46, '', '2016-06-24 10:16:17'),
(7, 'qwqwqw', 98, 46, '', '2016-06-24 10:16:21'),
(8, '12121212', 98, 46, '', '2016-06-24 10:16:27'),
(9, 'kjhkj', 78, 81, '', '2016-06-27 06:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `posts_images`
--

CREATE TABLE IF NOT EXISTS `posts_images` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `post_id` int(32) NOT NULL,
  `image_url` varchar(155) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=554 ;

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
(354, 0, 'chair235.jpg'),
(348, 56, 'chair234.jpg'),
(349, 56, 'chair335.jpg'),
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
(55, 21, 'fixing3.jpg'),
(56, 13, 'no-image3.jpg'),
(383, 0, 'water-tank-cleaning-service-250x2501.jpg'),
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
(412, 10, 'web-design-2.jpg'),
(80, 0, 'chair25.jpg'),
(83, 21, 'chair14.JPG'),
(84, 21, 'chair26.jpg'),
(85, 21, 'chair35.jpg'),
(86, 21, 'fixing3.jpg'),
(411, 10, '8-Benefits-Of-Good-Web-Design-810x608.jpg'),
(410, 10, 'images_(127).jpg'),
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
(113, 0, 'sana1.jpg'),
(114, 0, 'fixing4.jpg'),
(115, 0, 'fixing5.jpg'),
(116, 0, 'portriat3.jpg'),
(339, 0, 'DSCN1894.JPG'),
(120, 0, 'fixing6.jpg'),
(121, 0, 'chair17.JPG'),
(122, 0, 'chair29.jpg'),
(123, 0, 'chair38.jpg'),
(124, 0, 'fixing7.jpg'),
(125, 0, 'chair18.JPG'),
(126, 0, 'chair210.jpg'),
(127, 0, 'chair39.jpg'),
(128, 0, 'fixing8.jpg'),
(129, 0, 'fixing9.jpg'),
(130, 0, 'fixing10.jpg'),
(131, 0, 'fixing11.jpg'),
(132, 1, 'chair19.JPG'),
(133, 1, 'chair211.jpg'),
(134, 1, 'chair310.jpg'),
(338, 0, 'DSCN1619.JPG'),
(353, 0, 'chair130.JPG'),
(139, 0, 'no-profile-img-240x300.gif'),
(140, 0, 'chair312.jpg'),
(141, 0, 'portriat4.jpg'),
(145, 0, '18m-Brt-Articulated-Bus-YS6186G-.jpg'),
(146, 0, '2.1180141200_.generalife-round-bush_.jpg'),
(147, 0, 'a3p8xx.jpg'),
(148, 0, 'AD_Dragon-Fly_-_Animated_3D_Wallpaper.jpg'),
(149, 0, '18m-Brt-Articulated-Bus-YS6186G-1.jpg'),
(152, 0, 'a3p8xx2.jpg'),
(153, 0, 'fixing12.jpg'),
(154, 0, 'portriat5.jpg'),
(155, 0, 'fixing13.jpg'),
(156, 0, 'fixing14.jpg'),
(157, 0, 'fixing15.jpg'),
(158, 0, 'fixing16.jpg'),
(159, 0, 'fixing17.jpg'),
(160, 0, 'chair314.jpg'),
(161, 0, 'fixing18.jpg'),
(162, 0, 'fixing19.jpg'),
(163, 0, 'fixing20.jpg'),
(164, 0, 'fixing21.jpg'),
(165, 0, 'fixing22.jpg'),
(166, 0, 'Untitled.jpg'),
(167, 0, 'sana2.jpg'),
(168, 0, 'sana21.jpg'),
(169, 0, 'Untitled1.jpg'),
(170, 0, 'fixing23.jpg'),
(171, 0, 'fixing24.jpg'),
(172, 0, 'chair112.JPG'),
(173, 0, 'chair214.jpg'),
(174, 0, 'fixing25.jpg'),
(175, 0, 'fixing26.jpg'),
(176, 0, 'chair315.jpg'),
(177, 0, 'chair113.JPG'),
(178, 0, 'chair215.jpg'),
(179, 0, 'chair316.jpg'),
(180, 0, 'chair216.jpg'),
(181, 0, 'chair114.JPG'),
(182, 0, 'chair217.jpg'),
(183, 0, 'chair317.jpg'),
(184, 0, 'chair115.JPG'),
(185, 0, 'chair218.jpg'),
(186, 0, 'chair318.jpg'),
(187, 0, 'chair116.JPG'),
(188, 0, 'chair219.jpg'),
(189, 0, 'chair319.jpg'),
(190, 0, 'fixing27.jpg'),
(191, 0, 'fixing28.jpg'),
(192, 0, 'chair117.JPG'),
(193, 0, 'chair220.jpg'),
(194, 0, 'chair320.jpg'),
(206, 0, 'chair120.JPG'),
(202, 0, 'portriat7.jpg'),
(203, 37, 'chair323.jpg'),
(198, 37, 'chair119.JPG'),
(205, 0, 'chair223.jpg'),
(204, 0, 'Aircon.jpg'),
(207, 0, 'chair224.jpg'),
(208, 0, 'chair324.jpg'),
(209, 0, 'fixing29.jpg'),
(210, 0, 'portriat8.jpg'),
(211, 0, 'fixing30.jpg'),
(212, 0, 'chair121.JPG'),
(213, 0, 'chair225.jpg'),
(214, 0, 'chair325.jpg'),
(215, 0, 'fixing31.jpg'),
(216, 0, 'chair326.jpg'),
(217, 0, 'fixing32.jpg'),
(218, 38, 'chair122.JPG'),
(219, 38, 'chair226.jpg'),
(220, 38, 'chair327.jpg'),
(221, 38, 'fixing33.jpg'),
(222, 0, 'no-image2.jpg'),
(223, 38, 'no-profile-img-240x3001.gif'),
(224, 39, 'chair123.JPG'),
(225, 39, 'chair227.jpg'),
(226, 39, 'chair328.jpg'),
(227, 39, 'fixing34.jpg'),
(228, 0, 'fixing35.jpg'),
(229, 0, 'no-image3.jpg'),
(230, 39, 'no-profile-img-240x3002.gif'),
(231, 40, 'Lighthouse.jpg'),
(232, 40, 'Penguins1.jpg'),
(233, 0, 'Tulips1.jpg'),
(272, 41, 'chair230.jpg'),
(271, 41, 'chair126.JPG'),
(281, 46, '24.jpg'),
(273, 41, 'chair331.jpg'),
(279, 46, '22.jpg'),
(508, 0, 'chair356.jpg'),
(239, 0, 'chair229.jpg'),
(240, 0, 'chair330.jpg'),
(241, 0, 'fixing37.jpg'),
(242, 42, 'beautiful_natural_scenery_553758.jpg'),
(243, 42, 'sunrise_sun_water.jpg'),
(244, 0, 'sunrise_sun_water1.jpg'),
(385, 66, '6760135001_58b1c5c5f0_b.jpg'),
(384, 0, 'sunrise_sun_water2.jpg'),
(288, 0, 'chair333.jpg'),
(275, 45, 'chair127.JPG'),
(250, 0, 'fixing38.jpg'),
(251, 0, 'portriat9.jpg'),
(252, 0, 'fixing39.jpg'),
(253, 0, 'fixing40.jpg'),
(254, 0, 'no-image4.jpg'),
(255, 0, 'no-image5.jpg'),
(256, 0, 'portriat10.jpg'),
(257, 0, 'portriat11.jpg'),
(258, 0, 'fixing41.jpg'),
(259, 0, 'no-image6.jpg'),
(260, 0, 'no-image7.jpg'),
(261, 0, 'chair125.JPG'),
(262, 0, 'no-image8.jpg'),
(263, 0, '6.jpg'),
(264, 0, '61.jpg'),
(265, 0, '27.jpg'),
(266, 0, 'portriat12.jpg'),
(278, 45, 'fixing42.jpg'),
(277, 45, 'chair332.jpg'),
(299, 0, 'chair232.jpg'),
(287, 0, 'fixing43.jpg'),
(431, 0, 'chair2.jpg'),
(347, 56, 'chair129.JPG'),
(301, 0, 'redimages11.png'),
(290, 0, 'redimages1.png'),
(291, 0, 'redimages2.png'),
(292, 0, 'redimages3.png'),
(293, 0, 'redimages4.png'),
(294, 0, 'redimages5.png'),
(295, 0, 'redimages6.png'),
(296, 0, 'redimages7.png'),
(297, 0, 'redimages8.png'),
(298, 0, 'redimages9.png'),
(300, 0, 'redimages10.png'),
(304, 47, 'Chrysanthemum.jpg'),
(303, 44, '49.jpg'),
(305, 47, 'Desert.jpg'),
(306, 47, 'Hydrangeas.jpg'),
(307, 47, 'Jellyfish.jpg'),
(308, 47, 'Koala1.jpg'),
(309, 0, '39.jpg'),
(387, 56, 'fixing45.jpg'),
(312, 0, '41.jpg'),
(313, 0, '51.jpg'),
(314, 0, '511.jpg'),
(315, 0, '52.jpg'),
(316, 50, '521.jpg'),
(317, 50, '53.jpg'),
(318, 50, '54.jpg'),
(319, 50, '55.jpg'),
(355, 0, 'chair336.jpg'),
(382, 0, 'electrical_repairs.jpg'),
(323, 52, 'Chrysanthemum1.jpg'),
(324, 52, 'Desert1.jpg'),
(325, 52, 'Hydrangeas1.jpg'),
(326, 52, 'Jellyfish1.jpg'),
(327, 53, 'chair128.JPG'),
(328, 53, 'chair233.jpg'),
(329, 53, 'chair334.jpg'),
(371, 0, 'chair238.jpg'),
(356, 0, 'portriat16.jpg'),
(381, 58, '81.jpg'),
(363, 60, 'Chrysanthemum2.jpg'),
(361, 0, 'chair236.jpg'),
(369, 62, 'chair337.jpg'),
(370, 0, 'chair132.JPG'),
(368, 62, 'chair237.jpg'),
(367, 62, 'chair131.JPG'),
(372, 0, 'chair338.jpg'),
(375, 0, 'Website-Under-Construction-Template1.png'),
(380, 58, '62.jpg'),
(379, 58, '42.jpg'),
(386, 66, 'beautiful_natural_scenery_5537581.jpg'),
(388, 68, 'Aircon1.jpg'),
(423, 79, 'chair339.jpg'),
(422, 79, 'chair239.jpg'),
(421, 79, 'chair133.JPG'),
(420, 78, '59.jpg'),
(419, 78, '541.jpg'),
(418, 78, '522.jpg'),
(396, 0, '20.jpg'),
(397, 72, '7.jpg'),
(398, 72, '10.jpg'),
(399, 72, '121.jpg'),
(404, 74, '07.jpg'),
(403, 74, '5.jpg'),
(402, 0, '13.jpg'),
(405, 74, '71.jpg'),
(406, 75, '5633aba85ad39_1920x1080.jpg'),
(407, 75, 'Appartment_Typ_I_rot.jpg'),
(408, 75, 'fire_safety.jpg'),
(409, 75, 'login-bg4.jpg'),
(413, 10, '117.jpg'),
(424, 0, 'chair134.JPG'),
(425, 80, 'chair135.JPG'),
(426, 80, 'chair240.jpg'),
(427, 80, 'chair340.jpg'),
(428, 0, 'chair241.jpg'),
(432, 0, 'chair1.JPG'),
(430, 46, 'new.png'),
(433, 0, 'chair21.jpg'),
(434, 0, 'chair11.JPG'),
(435, 0, 'chair22.jpg'),
(436, 0, 'chair12.JPG'),
(437, 0, 'chair13.JPG'),
(438, 0, 'chair14.JPG'),
(439, 81, '55179133-Hand-holding-modern-tablet-and-house-sign-on-screen-Stock-Photo.jpg'),
(440, 81, '19329222-Hand-pressing-modern-social-buttons--Stock-Photo-social-media-digital.jpg'),
(441, 81, '21444885-Social-media-concept-pixelated-words-Community-on-digital-background-3d-render-Stock-Photo.jpg'),
(442, 81, '25156512-Social-network-concept-magnifying-optical-glass-with-words-Community-on-digital-3d-render-Stock-Photo.jpg'),
(443, 83, 'chair136.JPG'),
(444, 83, 'chair242.jpg'),
(445, 83, 'chair341.jpg'),
(446, 0, 'chair342.jpg'),
(447, 0, 'chair243.jpg'),
(448, 0, 'chair137.JPG'),
(449, 84, 'chair343.jpg'),
(451, 84, 'chair244.jpg'),
(482, 84, 'portriat18.jpg'),
(454, 0, 'chair138.JPG'),
(484, 0, 'chair251.jpg'),
(483, 84, 'chair147.JPG'),
(455, 0, 'chair344.jpg'),
(456, 0, 'chair245.jpg'),
(457, 0, 'no-image12.jpg'),
(458, 0, 'portriat17.jpg'),
(459, 0, 'fixing47.jpg'),
(460, 0, 'chair139.JPG'),
(461, 0, 'chair246.jpg'),
(462, 0, 'chair140.JPG'),
(463, 0, 'chair141.JPG'),
(464, 0, 'chair142.JPG'),
(465, 0, 'chair345.jpg'),
(466, 0, 'chair247.jpg'),
(467, 0, 'chair143.JPG'),
(468, 0, 'chair346.jpg'),
(469, 0, 'chair248.jpg'),
(470, 0, 'chair144.JPG'),
(471, 0, 'chair347.jpg'),
(472, 0, 'chair249.jpg'),
(473, 0, 'fixing48.jpg'),
(474, 0, 'chair145.JPG'),
(475, 0, 'alpha2.jpg'),
(476, 0, 'alpha2.png'),
(477, 0, 'chair348.jpg'),
(478, 0, 'fixing49.jpg'),
(479, 0, 'chair349.jpg'),
(480, 84, 'chair250.jpg'),
(481, 0, 'chair146.JPG'),
(485, 0, 'chair350.jpg'),
(486, 0, 'chair148.JPG'),
(487, 0, 'chair351.jpg'),
(488, 0, 'chair149.JPG'),
(489, 0, 'chair252.jpg'),
(490, 0, 'chair253.jpg'),
(491, 0, 'chair150.JPG'),
(492, 0, 'no-image13.jpg'),
(493, 0, 'chair352.jpg'),
(494, 0, 'fixing50.jpg'),
(495, 0, 'chair353.jpg'),
(496, 0, 'chair354.jpg'),
(497, 0, 'chair254.jpg'),
(498, 0, 'chair151.JPG'),
(499, 0, 'chair255.jpg'),
(500, 0, 'chair152.JPG'),
(501, 0, 'chair355.jpg'),
(502, 0, 'chair256.jpg'),
(503, 0, 'chair153.JPG'),
(504, 46, '72.jpg'),
(506, 0, 'chair154.JPG'),
(509, 0, 'chair257.jpg'),
(510, 0, 'chair155.JPG'),
(511, 0, '82.jpg'),
(512, 0, '93.jpg'),
(513, 0, 'Our+Practice-Books.jpg'),
(514, 0, '63.jpg'),
(515, 0, 'Law.jpg'),
(517, 85, '411.jpg'),
(518, 85, '48.jpg'),
(519, 85, '47.jpg'),
(520, 0, 'chair156.JPG'),
(521, 0, 'chair258.jpg'),
(522, 0, 'chair357.jpg'),
(523, 0, 'chair157.JPG'),
(524, 0, 'fixing51.jpg'),
(525, 98, '56.jpg'),
(526, 98, '43.jpg'),
(527, 98, '73.jpg'),
(528, 0, 'chair259.jpg'),
(529, 0, 'fixing52.jpg'),
(530, 95, 'fixing53.jpg'),
(531, 95, 'chair358.jpg'),
(532, 95, 'chair359.jpg'),
(533, 95, 'chair260.jpg'),
(534, 95, 'fixing54.jpg'),
(535, 0, 'chair158.JPG'),
(539, 96, 'chair160.JPG'),
(542, 99, 'electrical.jpg'),
(543, 0, 'adimage.jpg'),
(544, 100, '20141003_232130.jpg'),
(545, 100, '20141003_232157.jpg'),
(546, 100, '20141003_232148.jpg'),
(547, 101, '20141004_135246.jpg'),
(548, 0, '20141005_184130.jpg'),
(549, 101, '20141004_135418.jpg'),
(550, 101, '20141005_1841301.jpg'),
(551, 102, '57.jpg'),
(552, 102, '64.jpg'),
(553, 102, '2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reported_posts`
--

CREATE TABLE IF NOT EXISTS `reported_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `reported_by` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `report_time` datetime NOT NULL,
  `is_resolved` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `reported_posts`
--

INSERT INTO `reported_posts` (`id`, `post_id`, `reported_by`, `action`, `report_time`, `is_resolved`) VALUES
(1, 56, 73, '', '2016-06-02 20:02:41', 1),
(2, 62, 0, '', '2016-06-02 21:28:47', 1),
(3, 60, 73, '', '2016-06-02 21:29:58', 0),
(4, 69, 73, '', '2016-06-02 21:49:04', 0),
(5, 58, 78, '', '2016-06-03 13:38:10', 1),
(6, 46, 78, '', '2016-06-03 13:42:44', 0),
(7, 71, 78, '', '2016-06-03 18:20:52', 0),
(8, 69, 73, '', '2016-06-06 22:02:53', 0),
(9, 69, 73, '', '2016-06-06 22:08:46', 0),
(10, 69, 73, '', '2016-06-06 22:08:51', 0),
(11, 60, 73, '', '2016-06-06 22:08:51', 0),
(12, 60, 73, '', '2016-06-06 22:08:57', 0),
(13, 69, 73, '', '2016-06-06 22:08:57', 0),
(14, 60, 73, '', '2016-06-06 22:09:04', 0),
(15, 69, 73, '', '2016-06-06 22:09:04', 0),
(16, 69, 73, '', '2016-06-06 22:09:09', 0),
(17, 60, 73, '', '2016-06-06 22:09:09', 0),
(18, 69, 73, '', '2016-06-06 22:09:13', 0),
(19, 60, 73, '', '2016-06-06 22:09:13', 0),
(20, 69, 73, '', '2016-06-06 22:09:19', 0),
(21, 60, 73, '', '2016-06-06 22:09:19', 0),
(22, 69, 73, '', '2016-06-06 22:09:23', 0),
(23, 60, 73, '', '2016-06-06 22:09:23', 0),
(24, 69, 73, '', '2016-06-06 22:09:28', 0),
(25, 60, 73, '', '2016-06-06 22:09:28', 0),
(26, 69, 73, '', '2016-06-06 22:09:32', 0),
(27, 60, 73, '', '2016-06-06 22:09:32', 0),
(28, 69, 73, '', '2016-06-06 22:09:37', 0),
(29, 60, 73, '', '2016-06-06 22:09:37', 0),
(30, 60, 73, '', '2016-06-06 22:09:42', 0),
(31, 69, 73, '', '2016-06-06 22:09:42', 0),
(32, 69, 73, '', '2016-06-06 22:09:46', 0),
(33, 60, 73, '', '2016-06-06 22:09:46', 0),
(34, 69, 73, '', '2016-06-06 22:09:57', 0),
(35, 60, 95, '', '2016-06-07 12:27:40', 0),
(36, 69, 95, '', '2016-06-07 12:30:35', 0),
(37, 69, 95, '', '2016-06-07 12:30:39', 0),
(38, 69, 95, '', '2016-06-07 12:32:26', 0),
(39, 79, 95, '', '2016-06-07 15:52:40', 0),
(40, 46, 86, '', '2016-06-07 22:40:36', 0),
(41, 46, 86, '', '2016-06-07 22:40:52', 0),
(42, 78, 86, '', '2016-06-07 22:41:14', 0),
(43, 78, 86, '', '2016-06-07 22:41:22', 0),
(44, 78, 86, '', '2016-06-07 22:41:22', 0),
(45, 78, 86, '', '2016-06-09 17:05:10', 0),
(46, 78, 86, '', '2016-06-09 17:05:13', 0),
(47, 78, 86, '', '2016-06-09 17:05:21', 0),
(48, 81, 78, '', '2016-06-09 17:05:37', 0),
(49, 81, 78, '', '2016-06-09 17:05:53', 0),
(50, 81, 78, '', '2016-06-09 17:06:09', 0),
(51, 78, 86, '', '2016-06-09 17:06:09', 0),
(52, 78, 86, '', '2016-06-09 17:06:14', 0),
(53, 60, 95, '', '2016-06-10 14:07:25', 0),
(54, 79, 95, '', '2016-06-10 14:08:51', 0),
(55, 79, 95, '', '2016-06-10 14:23:12', 0),
(56, 79, 95, '', '2016-06-10 14:23:23', 0),
(57, 82, 78, '', '2016-06-10 14:27:07', 0),
(58, 81, 78, '', '2016-06-10 14:27:16', 0),
(59, 79, 95, '', '2016-06-10 14:31:13', 0),
(60, 82, 78, '', '2016-06-10 17:20:59', 0),
(61, 82, 78, '', '2016-06-10 17:21:04', 0),
(62, 81, 78, '', '2016-06-10 17:21:13', 0),
(63, 78, 78, '', '2016-06-13 18:43:23', 0),
(64, 78, 78, '', '2016-06-13 18:43:27', 0),
(65, 78, 78, '', '2016-06-15 18:32:20', 0),
(66, 85, 78, '', '2016-06-21 17:20:20', 0);

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
  `moved_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `condo_id`, `name`, `email`, `phone`, `password`, `type`, `block`, `floor`, `unit`, `verify_code`, `image_url`, `status`, `date_registered`, `last_login`, `ip`, `forgot_pass_count`, `moved_date`) VALUES
(64, 54, 'sss', 'sanakust@yahoo.com', '423423', '81dc9bdb52d04dc20036dbd8313ed055', '2', '26', 'G', '1', '49c5dad110cc1ee6de181f79122c6859', '', 1, '2016-04-04', '0000-00-00 00:00:00', '', 0, '0000-00-00'),
(95, 54, 'bilal', 'bilalmasood2665@gmail.com', '0308480304', '81dc9bdb52d04dc20036dbd8313ed055', '2', '26', '4', '21', 'ba52861af5823a9571a4457efeb0146d', 'aircon_installation.jpg', 1, '2016-05-10', '2016-06-10 14:07:17', '39.32.74.248', 0, '0000-00-00'),
(23, 1, 'Dani Hussain', 'dani@getranked.com.my', '+60177092790', '96f44e6b989c1be01462c2767c3fc159', '2', '9', 'G', '1', 'b520c1671a52cc93ddc9d8cc73ad5be5', '', 1, '2016-03-30', '2016-06-20 18:01:12', '1.32.71.108', 2, '0000-00-00'),
(4, 44, 'Arun Palmcourt', 'sdsuresh22@gmail.com', '+60112121212', '6a898eca5bf710c5e2541ca895598e7e', '2', '15', '18', '20', 'b520c1671a52cc93ddc9d8cc73ad5be5', 'vijay-house-chennai-10-1455089898.jpg', 1, '2016-03-30', '2016-06-22 23:40:33', '115.132.104.99', 0, '0000-00-00'),
(5, 44, 'Naeem Hussain', 'dani4@getranked.com.my', '+923009196543', '82cc921c6a5c6707e1d6e6862ba3201a', '1', '15', 'G', '1', 'b520c1671a52cc93ddc9d8cc73ad5be5', '', 1, '0000-00-00', '2016-05-09 11:36:11', '202.129.163.230', 0, '0000-00-00'),
(54, 46, 'Muhammad ', 'muhammad@getranked.com.my', '017-7485-6985', '2e3b4e5bc05c0b678ec769adc918409b', '1', '23', '5', '110', '5e9dee17d84d5133bb6c9744f8b79253', 'IMG_0264.JPG', 0, '2016-04-04', '2016-04-13 17:32:14', '202.129.163.230', 2, '0000-00-00'),
(71, 54, 'sanaullahtest2', 'sanaullahAhmad@gmail.com', '6666666666', '81dc9bdb52d04dc20036dbd8313ed055', '11', '26', 'G', '1', '659bac52c35f2b34fa7a310cdb366a4f', 'portriat17.jpg', 1, '2016-04-08', '2016-06-26 13:34:31', '39.32.190.215', 0, '0000-00-00'),
(90, 50, 'Marrcuss', 'marrcuss.lim@gmail.com', '0122783997', '4e74612466aa473adba4e4f77e14e50a', '2', '24', '8', '13', '3a859dbe469596bb17f19268bd9885f7', '20160513_1930342.jpg', 1, '2016-04-28', '2016-06-02 21:02:31', '103.26.249.253', 0, '0000-00-00'),
(78, 44, 'Dani Palmcourt', 'sdsuresh22@hotmail.com', '123347', '6a898eca5bf710c5e2541ca895598e7e', '2', '15', 'G', '6', '82291442b9b2fa9405594ffccc0bdfcc', 'Nadeem_Passport_Pic.png', 1, '2016-04-12', '2016-06-28 10:47:07', '202.129.163.230', 0, '0000-00-00'),
(72, 50, 'ML', 'marcuslimkl@gmail.com', '012273997', '4e74612466aa473adba4e4f77e14e50a', '2', '24', '15', '10', '3a859dbe469596bb17f19268bd9885f7', '', 2, '2016-04-08', '2016-04-26 17:21:49', '113.210.55.167', 2, '0000-00-00'),
(73, 54, 'sanaullah R', 'sana@getranked.com.my', '423423', '81dc9bdb52d04dc20036dbd8313ed055', '2', '26', 'G', '1', '83dfd1cb85018ba979f8c753c965e967', 'fixing10.jpg', 1, '2016-04-11', '2016-06-28 12:39:26', '39.32.219.95', 0, '0000-00-00'),
(77, 1, 'Dani Hussain', 'hr@getranked.com.my', '+60177092790', 'e94d51a35484755a9f9672d13687f499', '2', '9', '2', '7', 'fcdfe6ed76f83af0e942a4d9fd0bacde', '', 1, '2016-04-12', '2016-04-12 17:26:51', '202.129.163.230', 0, '0000-00-00'),
(92, 59, 'Saqib ', 'saqib.eq@gmail.com', '017-656-9760', '81dc9bdb52d04dc20036dbd8313ed055', '2', '36', '10', '20', 'bec66c5fc9d31e41fbf33a4b7a97bf97', 'IMG_02641.JPG', 1, '2016-05-04', '2016-06-06 14:46:34', '101.50.82.161', 2, '0000-00-00'),
(91, 58, 'scott Vila Resident', 'sdsuresh22134@gmail.com', '0123456', '82cc921c6a5c6707e1d6e6862ba3201a', '2', '34', '15', '6', '149d6050fb0a0dc340253b3334911fee', '', 1, '2016-04-28', '0000-00-00 00:00:00', '', 0, '0000-00-00'),
(93, 59, 'Waqas', 'waqas@getranked.com.my', '017-569-8745', '81dc9bdb52d04dc20036dbd8313ed055', '2', '38', '10', '20', '56815eb659c9d8f4407f9bfa44eefee5', 'images.jpg', 1, '2016-05-04', '2016-05-04 19:24:32', '58.65.150.53', 5, '0000-00-00'),
(83, 54, 'ddsf', 'sana@getranked.com.my2', '', '81288b8554d6102de13b6b99afdbed0d', '2', '26', 'G', '1', '70940555e73dcd77dd6cd0b302284ffc', '', 1, '2016-04-26', '0000-00-00 00:00:00', '', 0, '2016-06-28'),
(84, 54, 'sana4', 'sanakust@yahoo.com2', '34343', '67a78e9856930cc37c8bdcb896f5f674', '1', '26', '13', '18', '5f6fef9ef0a28374b88d2ba0b758a5ec', '', 2, '2016-04-26', '0000-00-00 00:00:00', '', 0, '0000-00-00'),
(86, 44, 'Marrcuss', 'marrcuss.lim@gmail.com', '0122783997', '4e74612466aa473adba4e4f77e14e50a', '2', '15', '3', '5', '3a859dbe469596bb17f19268bd9885f7', '20160513_1930343.jpg', 1, '2016-04-27', '2016-06-27 18:47:49', '1.32.76.93', 0, '0000-00-00'),
(87, 56, 'Marrcuss', 'marrcuss.limmmm@gmail.com', '0122783997', '4e74612466aa473adba4e4f77e14e50a', '2', '30', '10', '7', '3a859dbe469596bb17f19268bd9885f7', '20160513_193034.jpg', 2, '2016-04-27', '2016-06-13 17:31:06', '175.139.129.31', 0, '0000-00-00'),
(94, 59, 'Ronnie', 'ronnie@getranked.com.my', '0123456', '4d2b31c91d33a32a98584546736d5c73', '2', '35', '15', '20', '82291442b9b2fa9405594ffccc0bdfcc', 'dudes11.jpg', 1, '2016-05-05', '2016-05-05 14:38:35', '39.32.144.202', 0, '0000-00-00'),
(96, 60, 'JOHANNES STEPHEN KALWIHURA', 'joannesstephen4@gmail.com', '176091729', '6a898eca5bf710c5e2541ca895598e7e', '1', '40', '9', '5', '52fddc972563a3b78865c505ae204a3d', '', 1, '2016-06-06', '2016-06-19 23:03:58', '175.141.19.252', 0, '0000-00-00'),
(97, 61, 'Marrcuss Lim', 'marrcuss.lim@gmail.com', '0122783997', '4e74612466aa473adba4e4f77e14e50a', '11', '42', '10', '1', '3a859dbe469596bb17f19268bd9885f7', '20160513_1930344.jpg', 1, '2016-06-13', '2016-06-28 02:32:23', '175.143.195.15', 0, '0000-00-00'),
(98, 44, 'Ronnie PO', 'ronnie@getranked.com.my', '12334', '4d2b31c91d33a32a98584546736d5c73', '11', '15', 'G', '6', '82291442b9b2fa9405594ffccc0bdfcc', 'akon.jpg', 1, '2016-06-16', '2016-06-24 18:15:43', '1.32.73.96', 0, '0000-00-00'),
(100, 54, 'qwewq', 'sana@getranked.com.my3', '42323423423', 'a44a02e18157adf6d378609b53da6377', '1', '26', 'G', '1', '3cc61acffca814491e39d6b3604fd9ad', '', 1, '2016-06-16', '0000-00-00 00:00:00', '', 0, '0000-00-00'),
(105, 54, 'sfdsd', 'bilalmasood2666@gmail.com', '45166161612', '7374bbdae9f00bd4aec4829327390f98', '1', '26', 'G', '1', 'd33b12214fe5a0854c23f0793b0b4568', '', 0, '2016-06-21', '0000-00-00 00:00:00', '', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `residents_invitations`
--

CREATE TABLE IF NOT EXISTS `residents_invitations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `condo_id` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `floor` varchar(10) NOT NULL,
  `unit` int(11) NOT NULL,
  `resi_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `residents_invitations`
--

INSERT INTO `residents_invitations` (`id`, `sender_id`, `email`, `condo_id`, `block`, `floor`, `unit`, `resi_type`) VALUES
(1, 71, 'sana@getranked.com.my', 54, 26, 'G', 1, 2),
(2, 71, 'sanaullahAhmad@gmail.com', 54, 26, 'G', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `resident_logs`
--

CREATE TABLE IF NOT EXISTS `resident_logs` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `resident_id` int(32) NOT NULL,
  `log_text` text NOT NULL,
  `ip_address` varchar(155) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(38, 41, 'Plumbing Installation', 'Plumbing-Installation.jpg'),
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
  `rating` int(11) NOT NULL,
  `feedback` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `service_quotes`
--

INSERT INTO `service_quotes` (`id`, `service_request_id`, `description`, `amount`, `quotation_file`, `min_budget`, `max_budget`, `quoted_on`, `quoted_by`, `status`, `ven_arival_time`, `resident_phone`, `rating`, `feedback`) VALUES
(1, 1, 'Hello I''m up.', 0, 'layout.jpg', '20', '100', 2016, 18, 2, '2016-06-05 09:00:00', '12334', 0, '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `service_quotes_comments`
--

INSERT INTO `service_quotes_comments` (`id`, `comment`, `sender`, `receiver`, `service_qoute_id`, `actor`, `insertDate`) VALUES
(1, 'Hello I''m up.', 18, 78, 1, 'vendor', '2016-05-24 11:43:06'),
(2, 'ok', 78, 18, 1, 'resident', '2016-05-24 11:46:12'),
(3, 'done', 18, 78, 1, 'vendor', '2016-05-24 11:46:20'),
(6, 'this is quote desc', 14, 73, 2, 'vendor', '2016-05-24 15:59:21'),
(5, 'this is quote desc', 14, 73, 3, 'vendor', '2016-05-24 15:59:21'),
(7, 'fa sdfasdf as asdfa dsfa sd sfdas dfasdf', 14, 73, 2, 'vendor', '2016-05-24 17:47:00'),
(8, 'hi', 73, 14, 2, 'resident', '2016-05-24 17:50:43'),
(9, 'hi', 73, 14, 2, 'resident', '2016-05-24 17:50:43'),
(10, 'hello', 73, 14, 3, 'resident', '2016-06-08 12:50:16'),
(11, 'i am testing', 73, 14, 3, 'resident', '2016-06-08 12:50:28'),
(12, 'test', 73, 14, 3, 'resident', '2016-06-08 12:50:35'),
(13, 'test again', 73, 14, 3, 'resident', '2016-06-08 12:50:43'),
(14, 'testing', 73, 14, 3, 'resident', '2016-06-08 12:51:39'),
(15, 'here we go', 73, 14, 3, 'resident', '2016-06-08 12:51:47'),
(16, 'its working', 73, 14, 3, 'resident', '2016-06-08 12:51:51'),
(17, 'yes', 73, 14, 3, 'resident', '2016-06-08 12:51:55'),
(18, 'common', 73, 14, 3, 'resident', '2016-06-08 12:51:58'),
(19, 'testing', 73, 14, 3, 'resident', '2016-06-08 12:52:02'),
(20, 'vb', 18, 78, 1, 'vendor', '2016-06-13 18:48:21'),
(21, 'Hey I''m ok with your request.', 18, 78, 5, 'vendor', '2016-06-14 11:07:01'),
(22, 'Hi', 78, 18, 5, 'resident', '2016-06-14 11:08:51'),
(23, 'Good to see you replying', 18, 78, 5, 'vendor', '2016-06-14 11:09:59'),
(24, 'Ok did you check the image i have sent to you?', 78, 18, 5, 'resident', '2016-06-14 11:10:24'),
(25, 'yes I did', 18, 78, 5, 'vendor', '2016-06-14 11:10:31'),
(26, ':)', 18, 78, 5, 'vendor', '2016-06-14 11:10:34'),
(27, 'Ok so im ok with the cost. So what time you are comfortable with?', 78, 18, 5, 'resident', '2016-06-14 11:11:22'),
(28, 'This weekend!', 18, 78, 5, 'vendor', '2016-06-14 11:11:32'),
(29, 'Thats cool.', 78, 18, 5, 'resident', '2016-06-14 11:15:28'),
(30, 'Ok', 18, 78, 5, 'vendor', '2016-06-14 11:25:17'),
(31, 'Fine', 78, 18, 5, 'resident', '2016-06-14 11:25:24'),
(32, 'bn', 18, 78, 5, 'vendor', '2016-06-14 11:37:18'),
(33, 'WE', 18, 78, 5, 'vendor', '2016-06-14 11:39:17'),
(34, 'FG', 78, 18, 5, 'resident', '2016-06-14 11:39:22'),
(35, 'pp', 18, 78, 5, 'vendor', '2016-06-14 11:44:28'),
(36, 'SD', 78, 18, 5, 'resident', '2016-06-14 12:11:55'),
(37, 'OP', 18, 78, 5, 'vendor', '2016-06-14 12:12:02'),
(38, 'CV', 18, 78, 5, 'vendor', '2016-06-14 12:14:28'),
(39, 'WE', 78, 18, 5, 'resident', '2016-06-14 12:14:34'),
(40, 'CV', 18, 78, 5, 'vendor', '2016-06-14 13:20:14'),
(41, 'BNN', 78, 18, 5, 'resident', '2016-06-14 13:20:25'),
(42, 'hi ronnie..u are great bro!', 18, 78, 1, 'vendor', '2016-06-14 15:19:58'),
(43, 'ronnie is great!', 18, 78, 5, 'vendor', '2016-06-14 15:21:19'),
(44, 'Hi Marrccus', 78, 18, 5, 'resident', '2016-06-14 15:21:32'),
(45, 'GH', 78, 18, 5, 'resident', '2016-06-15 11:04:25'),
(46, 'AS', 78, 18, 5, 'resident', '2016-06-15 12:38:50'),
(47, 'OPPPP', 78, 18, 5, 'resident', '2016-06-15 12:39:21'),
(48, 'QW', 78, 18, 5, 'resident', '2016-06-15 12:40:37'),
(49, 'NM', 18, 78, 5, 'vendor', '2016-06-15 12:40:51'),
(50, 'op', 18, 78, 5, 'vendor', '2016-06-15 12:43:59'),
(51, 'scroll', 78, 18, 5, 'resident', '2016-06-15 12:47:27'),
(52, 'From mob', 18, 78, 5, 'vendor', '2016-06-15 16:15:31'),
(53, '', 18, 73, 6, 'vendor', '2016-06-15 18:57:44'),
(54, '', 18, 73, 7, 'vendor', '2016-06-15 18:58:30'),
(55, 'ppppp', 18, 78, 1, 'vendor', '2016-06-17 16:23:45'),
(56, 'mmm', 78, 18, 5, 'resident', '2016-06-24 09:34:21');

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
  `rating` int(11) NOT NULL,
  `feedback` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `requested_by`, `condo_id`, `service_id`, `description`, `budget`, `duration`, `service_request_file`, `requested_time`, `rating`, `feedback`) VALUES
(1, 78, 44, 31, 'Renovation', 0, 7, 'adimage1.jpg', '2016-05-24 11:25:16', 0, ''),
(5, 73, 54, 39, 'afds f asdf asdf', 0, 15, 'chair27.jpg', '2016-06-02 16:26:42', 0, ''),
(12, 71, 54, 35, 'testing des', 0, 7, '', '2016-06-26 14:02:58', 0, ''),
(13, 71, 54, 35, 'testing des', 0, 7, '', '2016-06-26 14:06:02', 0, ''),
(14, 71, 54, 35, 'testing des', 0, 7, '', '2016-06-26 14:10:12', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `service_requests_images`
--

CREATE TABLE IF NOT EXISTS `service_requests_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `service_request_id` int(10) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `service_requests_images`
--

INSERT INTO `service_requests_images` (`id`, `service_request_id`, `image_url`) VALUES
(1, 4, 'Chrysanthemum.jpg'),
(2, 4, 'Desert1.jpg'),
(3, 4, 'Hydrangeas1.jpg'),
(4, 4, 'Jellyfish.jpg'),
(5, 4, 'Koala.jpg'),
(20, 8, 'chair38.jpg'),
(19, 0, 'chair29.jpg'),
(18, 0, 'chair37.jpg'),
(17, 0, 'chair28.jpg'),
(16, 0, 'chair13.JPG'),
(11, 5, 'chair12.JPG'),
(12, 5, 'chair27.jpg'),
(13, 6, 'chair36.jpg'),
(14, 6, 'fixing4.jpg'),
(15, 7, 'BadmintonCourt1.jpg'),
(21, 8, 'chair210.jpg'),
(22, 8, 'chair14.JPG'),
(23, 0, 'chair39.jpg'),
(24, 0, 'chair211.jpg'),
(25, 0, 'chair15.JPG'),
(26, 0, 'chair16.JPG'),
(27, 0, 'chair310.jpg'),
(28, 0, 'chair212.jpg'),
(29, 0, 'fixing5.jpg'),
(30, 0, 'chair17.JPG'),
(31, 0, 'chair18.JPG'),
(32, 0, 'chair311.jpg'),
(33, 0, 'chair213.jpg'),
(34, 0, 'chair19.JPG'),
(35, 0, 'chair214.jpg'),
(36, 0, 'chair110.JPG'),
(37, 0, 'chair215.jpg'),
(38, 0, 'chair216.jpg'),
(39, 0, 'chair217.jpg'),
(40, 0, 'chair111.JPG'),
(41, 0, 'chair312.jpg'),
(42, 0, 'chair313.jpg'),
(43, 0, 'chair218.jpg'),
(44, 0, 'chair112.JPG'),
(45, 0, 'chair113.JPG'),
(46, 0, 'chair314.jpg'),
(47, 0, 'chair219.jpg'),
(48, 0, 'chair315.jpg'),
(49, 0, 'no-image.jpg'),
(50, 0, 'no-profile-img-240x3001.gif'),
(51, 0, 'portriat3.jpg'),
(52, 0, 'chair220.jpg'),
(53, 0, 'fixing6.jpg'),
(54, 0, 'chair114.JPG'),
(55, 0, '2alp.jpg'),
(56, 0, '2alp.png');

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
-- Table structure for table `useful_contacts`
--

CREATE TABLE IF NOT EXISTS `useful_contacts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `condo_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `waze` varchar(100) NOT NULL,
  `google_map_link` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `useful_contacts`
--

INSERT INTO `useful_contacts` (`id`, `condo_id`, `name`, `phone`, `email`, `mobile`, `website`, `address`, `status`, `waze`, `google_map_link`) VALUES
(1, 54, 'my name', 'my phone', 'email@gmai.com', 'my mobile', 'http://www.mywebsite.com', 'my address', 1, '', ''),
(3, 54, 'weqwe', 'qweqwe', 'qweqwe@gmail.com', 'qweqw', 'http://qweqwe.example.com', 'ewqwe', 1, '', ''),
(4, 44, 'Police Statsion Sunge Basi1', '037987897', 'police@malaysia.com', '01727387932', 'http://www.malaysiapolice.com', 'Police Station Road, Sunge Basi', 1, '', ''),
(5, 44, 'Emergency Contact', '03434343434', 'ronnie@getranked.com.my', '0175658694', 'http://www.emergency.com', 'Leburaya Ampang', 1, '', ''),
(6, 44, 'Demo', '0123456', 'ronnie@getranked.com.my', '13133', 'demo.com', 'Demo Address', 1, '', ''),
(7, 54, 'sfsf', 'sdfs', 'sdfsd@gmail.com', '644', 'http://www.gmail.com', 'lsdjfsl', 1, 'oewrwe.was', 'slljsdf.goo'),
(8, 61, 'Police Station', '0322334455', 'polis@rmp.spab.gov.my', 'N/A', 'http://www.rmp.gov.my/', 'Ibu Pejabat Polis Bukit Aman, Jalan Bukit Aman, Tasik Perdana, Wilayah Persekutuan, Perdana Botanica', 1, '', 'Ibu Pejabat Polis Bukit Aman, Jalan Bukit Aman, Tasik Perdana, Wilayah Persekutuan, Perdana Botanica'),
(9, 61, 'HOSPITAL KUALA LUMPUR', '03-26155555', 'pro.hkl@moh.gov.my', 'N/A', 'http://www.hkl.gov.my', 'Jalan Pahang, 50586 Kuala Lumpur, MALAYSIA ', 1, '', 'Jalan Pahang, 50586 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur, Malaysia'),
(10, 61, 'Mediviron Clinic', '03-22829815', 'help@mediviron.com.my', 'N/A', 'http://www.mediviron.com.my/', 'Ground Floor,  46, Jalan Telawi,  Bangsar Baru,  59100 KL', 1, '', ' 46, Jalan Telawi, Bangsar Baru, 59100 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur, Malaysia');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
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
  `image_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `company_name`, `description`, `phone`, `mobile`, `address`, `areas`, `email`, `state`, `password`, `last_login`, `ip`, `status`, `date_registered`, `verify_code`, `forgot_pass_count`, `image_url`) VALUES
(3, 'Dani Vendor', 'getRanked', '<p><em><strong>lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet.</strong></em></p>\r\n', '343434', '', 'Salak', 38, 'dani@getranked.com.my', 1, '7c3613dba5171cb6027c67835dd3b9d4', '2016-04-03 16:31:18', '203.106.189.194', 1, '2016-03-24', '83dfd1cb85018ba979f8c753c965e967', 2, 'aircon_installation.jpg'),
(13, 'sanaullahtest2', 'sfds', '<p><em><strong>lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet.</strong></em></p>\r\n', '464', '', 'sfsdf', 5, 'sanaullahAhmad@gmail.com', 1, '81dc9bdb52d04dc20036dbd8313ed055', '2016-06-17 16:22:10', '39.32.52.156', 1, '2016-03-27', '659bac52c35f2b34fa7a310cdb366a4f', 2, ''),
(15, 'sanaullahtest244', 'sanacompany', '<p><em><strong>lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet.</strong></em></p>\r\n', '23232323', '', 'ggggg', 84, 'sana@getranked.com.my23', 2, '0686774f20f6f1cc8d82680a5d0758b6', '0000-00-00 00:00:00', '', 0, '2016-03-30', 'b491499e9cd63827248b4155e1c43511', 0, ''),
(17, 'Saqib ', '5 Start Sdn Bhd', '<p><em><strong>lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet.</strong></em></p>\r\n', '017-656-9874', '', 'Selangor', 578, 'saqib.eq@gmail.com', 14, '7c3613dba5171cb6027c67835dd3b9d4', '2016-05-11 14:11:21', '202.129.163.230', 1, '2016-04-07', 'bec66c5fc9d31e41fbf33a4b7a97bf97', 0, ''),
(18, 'Ronnie Vendor', 'Ronnie Test Company', '<h3><span style="color:#800000">lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet.</span></h3>\n', '12334', '56456464646456', 'Address', 10, 'sdsuresh22@hotmail.com', 1, '7c3613dba5171cb6027c67835dd3b9d4', '2016-06-17 16:17:55', '202.129.163.230', 1, '2016-04-12', '82291442b9b2fa9405594ffccc0bdfcc', 0, 'vendor.png'),
(14, 'sanaullahVendor', 'sanaVendor', '<p><em><strong>lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet.</strong></em></p>\r\n', '23232323', '', 'ggggg', 84, 'sana@getranked.com.my', 2, '81dc9bdb52d04dc20036dbd8313ed055', '2016-06-20 15:15:27', '39.32.34.148', 1, '2016-03-30', '659bac52c35f2b34fa7a310cdb366a4f\n', 0, ''),
(19, 'Plumber (Marrcuss)', 'Alpha Plumbing Sdn Bhd', '<p><em><strong>lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet.</strong></em></p>\r\n', '0122783997', '', 'Bangsar ', 7, 'marrcuss.lim@als.com.my', 1, '6c6e1464695ec20feb0b2a633f9cf27b', '2016-06-21 15:44:21', '175.141.240.37', 1, '2016-05-03', '0d1728d257db84cd2abd8d752c610fa2', 0, ''),
(21, 'test', 'test com', '<p><em><strong>lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet.</strong></em></p>\r\n', 'test p', '', 'tes a', 449, 'sana@getranked.com.my25', 13, '652a903026db4a25cb6f2a551dcf3ff3', '0000-00-00 00:00:00', '', 0, '2016-06-13', '50f91d2ad246fdc49c82ea5edfc6c308', 0, 'fixing.jpg'),
(22, 'Rrr', 'rrr', '<p><em><strong>lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet. lorem ipusum dollar set amet.</strong></em></p>\r\n', 'rrr', '', 'rrr', 465, 'sana@getranked.com.my24', 13, '81144ce684993bd3960d2afc7c16a3cd', '0000-00-00 00:00:00', '', 0, '2016-06-13', '44f437ced647ec3f40fa0841041871cd', 0, 'chair11.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_condos`
--

CREATE TABLE IF NOT EXISTS `vendor_condos` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(32) NOT NULL,
  `condo_id` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `vendor_condos`
--

INSERT INTO `vendor_condos` (`id`, `vendor_id`, `condo_id`) VALUES
(56, 14, 47),
(94, 18, 47),
(54, 14, 33),
(53, 14, 53),
(52, 14, 1),
(93, 18, 44),
(92, 18, 50),
(62, 14, 54),
(63, 17, 59),
(64, 19, 50),
(65, 19, 56),
(91, 18, 1),
(85, 3, 47),
(84, 3, 54),
(83, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_services`
--

CREATE TABLE IF NOT EXISTS `vendor_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=150 ;

--
-- Dumping data for table `vendor_services`
--

INSERT INTO `vendor_services` (`id`, `vendor_id`, `service_id`) VALUES
(148, 3, 37),
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
(147, 3, 39),
(146, 3, 38),
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
(142, 19, 39),
(149, 3, 32);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

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
(38, 'Hamid', 78, '2016-05-29 21:00:00', 0, 44, 'In-house Party', 'WFS6723', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(39, 'sana', 73, '2016-05-18 16:30:00', 0, 54, 'dfadsfa', '324234', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(40, ' waqar', 73, '2016-05-18 16:30:00', 0, 54, 'dfadsfa', '23423', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(41, 'werwer', 73, '2016-05-25 16:30:00', 0, 54, 'dfsfsd', '4324234', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(42, 'fg', 78, '2016-05-31 00:15:00', 0, 44, 'fgf', '23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(43, 'WE', 78, '2016-05-31 00:15:00', 0, 44, 'fgf', '67', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(44, 'Wendy', 86, '2016-05-30 18:00:00', 0, 44, 'Please escort visitors to the BBQ pit.', 'WSA 1234', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(45, ' Andy', 86, '2016-05-30 18:00:00', 0, 44, 'Please escort visitors to the BBQ pit.', ' WSB 5678', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(46, ' Brandon', 86, '2016-05-30 18:00:00', 0, 44, 'Please escort visitors to the BBQ pit.', ' WSC 9123', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(47, ' Jessie', 86, '2016-05-30 18:00:00', 0, 44, 'Please escort visitors to the BBQ pit.', ' WSD 4567', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(48, 'ronnite', 78, '2016-06-29 19:45:00', 0, 44, 'Party', 'WMG123', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(49, 'dani', 78, '2016-06-29 19:45:00', 0, 44, 'Party', 'w34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(50, 'jojo', 78, '2016-06-29 19:45:00', 0, 44, 'Party', 'w12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(51, 'saqib', 78, '2016-06-29 19:45:00', 0, 44, 'Party', 'w5', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(52, 'Marellyn', 86, '2016-06-15 18:00:00', 0, 44, 'BBQ party. please direct my guest to the BBQ pit A', 'WAB 1234', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(53, ' Marrcuss', 86, '2016-06-15 18:00:00', 0, 44, 'BBQ party. please direct my guest to the BBQ pit A', ' WAC 2345', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(54, ' Kee En', 86, '2016-06-15 18:00:00', 0, 44, 'BBQ party. please direct my guest to the BBQ pit A', ' WAD 3567', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(55, 'sanaguest', 95, '2016-06-07 10:15:00', 0, 54, 'asdfa', '3434343', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(56, 'jameel', 78, '2016-07-08 17:00:00', 0, 44, 'Open House', 'IBD2329', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
