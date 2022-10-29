-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2022 at 03:37 PM
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
-- Database: `stayparktravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` int(11) NOT NULL,
  `airport` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `airport`) VALUES
(6, 'Albany International Airport'),
(7, 'Newark Liberty International Airport'),
(8, 'Tampa International Airport'),
(9, 'Toronto Pearson Airport'),
(10, 'Near Newcastle Airport');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `feature` varchar(100) NOT NULL,
  `font_awesome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature`, `font_awesome`) VALUES
(2, 'Lowest Rate Guarantee', 'fa fa-thumbs-up'),
(3, ' Free Breakfast Included', 'fa fa-coffee'),
(4, 'Self Park', 'fa fa-check-circle');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `distance` varchar(100) NOT NULL,
  `shuttle_hours` varchar(150) NOT NULL,
  `image` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL,
  `parking` varchar(100) NOT NULL,
  `airport` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `location`, `distance`, `shuttle_hours`, `image`, `rating`, `parking`, `airport`, `created_on`) VALUES
(11, 'Super 8 By Wyndham Latham - Albany Airport', 'LATHAM, NY, 12110-2501', '4 Miles from ALB', 'Must take taxi', '16664199632182.jpg', 5, 'Room Package Includes Parking', 'Albany International Airport', '2022-10-21 06:37:03'),
(15, 'Surestay Plus Hotel By Best Western Albany Airport', '200 Wolf Road, ALBANY, NY 12205-1197', ' 1/2 mile from ALB', '24 Hours', '16666103268480.png', 3, 'Room Package Includes Parking', 'Albany International Airport', '2022-10-24 04:18:46'),
(16, 'Sure Stay Plus Albany', '200 Wolf Road, Albany , NY 12205', '1 mile from ALB', '24 Hours', '16666109199053.jpg', 4, 'Room Package Includes Parking', 'Albany International Airport', '2022-10-24 04:28:39'),
(17, 'Quality Inn & Suites Albany Airport', '611 Troy-schenectady Rd, Latham , NY 12110', '4.5 Miles from ALB', '7am to 10am only', '1666611836210.jpg', 5, 'Room Package Includes Parking', 'Albany International Airport', '2022-10-24 04:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_features`
--

CREATE TABLE `hotel_features` (
  `id` int(11) NOT NULL,
  `feature` varchar(100) NOT NULL,
  `hotel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_features`
--

INSERT INTO `hotel_features` (`id`, `feature`, `hotel_id`) VALUES
(81, 'Lowest Rate Guarantee', 11),
(82, ' Free Breakfast Included', 11),
(83, 'Lowest Rate Guarantee', 15),
(84, ' Free Breakfast Included', 15),
(88, 'Lowest Rate Guarantee', 17),
(89, ' Free Breakfast Included', 17),
(93, 'Lowest Rate Guarantee', 16),
(94, ' Free Breakfast Included', 16),
(95, 'Self Park', 16);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_images`
--

CREATE TABLE `hotel_images` (
  `id` int(11) NOT NULL,
  `images` varchar(100) NOT NULL,
  `hotel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_images`
--

INSERT INTO `hotel_images` (`id`, `images`, `hotel_id`) VALUES
(61, '16663594239237.jpg', 11),
(62, '1666359423798.jpg', 11),
(63, '16663594235678.jpg', 11),
(64, '16663594239784.jpg', 11),
(65, '1666359423586.jpg', 11),
(66, '16663594231017.jpg', 11),
(67, '16663594234198.jpg', 11),
(68, '16663594238100.jpg', 11),
(69, '16663594233104.jpg', 11),
(70, '16663594231630.jpg', 11),
(101, '1666610326557.png', 15),
(102, '16666103268628.png', 15),
(103, '1666610326589.png', 15),
(104, '1666610326245.png', 15),
(105, '16666103263056.png', 15),
(106, '16666103266670.png', 15),
(107, '1666610326624.png', 15),
(108, '16666103267523.png', 15),
(109, '16666103269790.png', 15),
(110, '16666103266315.png', 15),
(111, '16666109198453.jpg', 16),
(112, '16666109199458.jpg', 16),
(113, '16666109197996.jpg', 16),
(114, '16666109197605.jpg', 16),
(115, '16666109192668.jpg', 16),
(116, '16666109198650.jpg', 16),
(117, '16666109194753.jpg', 16),
(118, '16666109197551.jpg', 16),
(119, '16666109192272.jpg', 16),
(120, '16666109194640.jpg', 16),
(121, '16666109192891.jpg', 16),
(122, '16666109199194.jpg', 16),
(123, '16666109193677.jpg', 16),
(124, '16666118363928.jpg', 17),
(125, '16666118364348.jpg', 17),
(126, '16666118362102.jpg', 17),
(127, '16666118368352.jpg', 17),
(128, '16666118365099.jpg', 17),
(129, '16666118363192.jpg', 17),
(130, '16666118361090.jpg', 17),
(131, '16666118361772.jpg', 17),
(132, '16666118369646.jpg', 17),
(133, '16666118363675.jpg', 17),
(134, '16666118367709.jpg', 17),
(135, '16666118367563.jpg', 17),
(136, '16666118368827.jpg', 17),
(137, '16666118367834.jpg', 17);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_rates`
--

CREATE TABLE `hotel_rates` (
  `id` int(11) NOT NULL,
  `price` varchar(30) NOT NULL,
  `accomodation` varchar(255) NOT NULL,
  `season` varchar(100) NOT NULL,
  `hotel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_rates`
--

INSERT INTO `hotel_rates` (`id`, `price`, `accomodation`, `season`, `hotel_id`) VALUES
(67, '89', ' 2 Double Beds Non-Smoking', '', 11),
(68, '95', ' 2 Double Beds Smoking', '', 11),
(69, '106', ' 1 Queen Bed,Mobility Accessible,WALK IN SHOWER', '', 15),
(71, '119', ' 1 King or 2 Double Beds', '', 17),
(77, '89', ' 2 Double Beds Non-Smoking', '', 16),
(78, '95', ' 2 Double Beds Smoking', '', 16),
(79, '106', ' 1 Queen Bed,Mobility Accessible,WALK IN SHOWER', '', 16),
(80, '119', ' 1 King or 2 Double Beds', '', 16),
(81, '105', '1 King or 2 Double Beds', '', 16);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_services`
--

CREATE TABLE `hotel_services` (
  `id` int(11) NOT NULL,
  `service` varchar(100) NOT NULL,
  `hotel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_services`
--

INSERT INTO `hotel_services` (`id`, `service`, `hotel_id`) VALUES
(132, 'Free Parking', 11),
(133, 'Restaurant', 11),
(134, 'Free WiFi', 11),
(135, 'Free Parking', 15),
(136, 'Restaurant', 15),
(137, 'Free WiFi', 15),
(141, 'Free Parking', 17),
(142, 'Free WiFi', 17),
(146, 'Free Parking', 16),
(147, 'Restaurant', 16),
(148, 'Free WiFi', 16);

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `name`, `start`, `end`) VALUES
(2, 'Season October ', '2022-10-25', '2022-12-09'),
(3, 'Season November', '2022-11-10', '2022-12-19'),
(4, 'Christmas', '2022-12-20', '2022-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service` varchar(100) NOT NULL,
  `font_awesome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service`, `font_awesome`) VALUES
(2, 'Free Parking', 'fa fa-car'),
(3, 'Restaurant', 'fa fa-cutlery'),
(4, 'Free WiFi', 'fa fa-wifi ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_features`
--
ALTER TABLE `hotel_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_rates`
--
ALTER TABLE `hotel_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_services`
--
ALTER TABLE `hotel_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hotel_features`
--
ALTER TABLE `hotel_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `hotel_images`
--
ALTER TABLE `hotel_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `hotel_rates`
--
ALTER TABLE `hotel_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `hotel_services`
--
ALTER TABLE `hotel_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
