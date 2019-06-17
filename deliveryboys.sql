-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2019 at 05:09 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deliveryboys`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `name`, `value`, `updated_at`) VALUES
(1, 'logo', 'deliveryboyslogo_latest_5d00a85540a4e.png', '2019-02-14 11:52:12'),
(2, 'twilio_key', 'ACda0183987121979e5b3d4324e0ab1b9e', '2019-02-15 09:40:08'),
(3, 'twilio_secret', 'af5ad4c685069fa1547baf48304bc174', '2019-02-15 09:40:08'),
(4, 'twilio_number', '+17137011590', '2019-02-15 09:40:35'),
(5, 'app_name', 'A2Z Delivery', '2019-05-14 15:38:21'),
(6, 'app_contact_number', '+91 8238136154,+91 8264402443,+91 9067771020', '2019-05-14 15:38:21'),
(7, 'app_address', 'Qaraar Restaurant , Railway Station Road', '2019-05-14 15:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_to` varchar(255) NOT NULL,
  `user_from` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `mediaUrl` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `order_id`, `user_to`, `user_from`, `message`, `mediaUrl`, `created_at`, `updated_at`) VALUES
(1, '0', 'admin', '', 'hello', '', '2019-06-14 11:39:02', '0000-00-00 00:00:00'),
(2, '0', 'admin', '', 'hello', '', '2019-06-14 11:41:48', '0000-00-00 00:00:00'),
(3, '0', 'admin', '', 'gdfg', '', '2019-06-14 11:41:52', '0000-00-00 00:00:00'),
(4, 'ORDA2Z_00000008', 'admin', '', 'gdfg', '', '2019-06-14 11:42:27', '0000-00-00 00:00:00'),
(5, 'ORDA2Z_00000008', 'admin', '', 'fdsf', '', '2019-06-14 11:42:29', '0000-00-00 00:00:00'),
(6, 'ORDA2Z_00000008', 'admin', '', 'dfsd', '', '2019-06-14 11:44:59', '0000-00-00 00:00:00'),
(7, 'ORDA2Z_00000008', 'admin', '', 'hfgh', '', '2019-06-14 11:48:12', '0000-00-00 00:00:00'),
(8, 'ORDA2Z_00000008', 'admin', '', 'dfsf', '', '2019-06-14 11:59:04', '0000-00-00 00:00:00'),
(9, 'ORDA2Z_00000008', 'admin', '', 'df', '', '2019-06-14 12:03:16', '0000-00-00 00:00:00'),
(10, 'ORDA2Z_00000008', 'admin', '', 'df', 'http://localhost/assets/img/chat-attachments/1 (3)_5d0340c44bf9e.jpg', '2019-06-14 12:07:56', '0000-00-00 00:00:00'),
(11, 'ORDA2Z_00000008', 'admin', '', 'hello', 'http://localhost/assets/img/chat-attachments/1 (4)_5d0340dd2f8e4.jpg', '2019-06-14 12:08:21', '0000-00-00 00:00:00'),
(12, 'ORDA2Z_00000008', 'admin', '', 'hello', '', '2019-06-14 12:09:51', '0000-00-00 00:00:00'),
(13, 'ORDA2Z_00000008', 'admin', '', 'hello', 'http://localhost/assets/img/chat-attachments/1 (4)_5d034141acc9c.jpg', '2019-06-14 12:10:01', '0000-00-00 00:00:00'),
(14, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', 'fsdfsd', '', '2019-06-14 12:28:44', '0000-00-00 00:00:00'),
(15, 'ORDA2Z_00000001', 'admin@a2zdeliveryboys.in', '', 'hi', '', '2019-06-14 12:29:26', '0000-00-00 00:00:00'),
(16, 'ORDA2Z_00000001', 'admin@a2zdeliveryboys.in', '', 'hello', 'http://localhost/assets/img/chat-attachments/1 (3)_5d0345d78f34d.jpg', '2019-06-14 12:29:35', '0000-00-00 00:00:00'),
(17, 'ORDA2Z_00000001', 'admin@a2zdeliveryboys.in', '', 'hello', 'http://localhost/assets/img/chat-attachments/1 (3)_5d03460a0a8fa.jpg', '2019-06-14 12:30:26', '0000-00-00 00:00:00'),
(18, 'ORDA2Z_00000001', 'admin@a2zdeliveryboys.in', '', 'hello', 'assets/img/chat-attachments/1 (3)_5d03475d8cef8.jpg', '2019-06-14 12:36:05', '0000-00-00 00:00:00'),
(19, 'ORDA2Z_00000001', 'admin@a2zdeliveryboys.in', '', 'fgd', 'assets/img/chat-attachments/1 (4)_5d03476a5f153.jpg', '2019-06-14 12:36:18', '0000-00-00 00:00:00'),
(20, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', '', 'assets/img/chat-attachments/A2Z Delivery Boys_5d0371af71abd.png', '2019-06-14 15:36:39', '0000-00-00 00:00:00'),
(21, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', '', 'assets/img/chat-attachments/A2Z Delivery Boys_5d0371af91694.png', '2019-06-14 15:36:39', '0000-00-00 00:00:00'),
(22, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', '', 'assets/img/chat-attachments/green_grass_wallpaper-800x600 (1)_5d03720dbcb7f.jpg', '2019-06-14 15:38:13', '0000-00-00 00:00:00'),
(23, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', '', 'assets/img/chat-attachments/green_grass_wallpaper-800x600 (1)_5d03727f6919c.jpg', '2019-06-14 15:40:07', '0000-00-00 00:00:00'),
(24, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', '', 'assets/img/chat-attachments/green_grass_wallpaper-800x600 (1)_5d037282d7801.jpg', '2019-06-14 15:40:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryboys`
--

CREATE TABLE `deliveryboys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliveryboys`
--

INSERT INTO `deliveryboys` (`id`, `name`, `contact`) VALUES
(4, 'Hasanali Abbasbhai Maknojjiya', '+91 9725760815');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_from` varchar(255) NOT NULL,
  `order_to` varchar(255) NOT NULL,
  `bill_to` varchar(400) NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` enum('P','D','R','C') NOT NULL,
  `delivery_charge` double NOT NULL DEFAULT '0',
  `special_note` text NOT NULL,
  `customer_phone_number` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_from`, `order_to`, `bill_to`, `order_no`, `created_at`, `order_status`, `delivery_charge`, `special_note`, `customer_phone_number`) VALUES
(1, 'Marine Drive, Churchgate, Mumbai, Maharashtra, India', 'Panchgani, Maharashtra, India', 'Akbar', 'ORDA2Z_00000001', '2019-06-13 15:16:04', 'P', 457.66, 'special order', '8530706924'),
(2, 'Sola Bridge, Shenbhai Nagar, Thaltej, Ahmedabad, Gujarat, India', 'Mehsana, Gujarat, India', 'Ak', 'ORDA2Z_00000002', '2019-06-13 17:37:58', 'P', 180.17, 'Cool', '8530706924'),
(3, 'iqra english medium school chadotar', 'SIDHPUR, Ahmedabad - Palanpur Highway Road, Siddhpur, Gujarat, India', 'Ak', 'ORDA2Z_00000003', '2019-06-14 09:44:29', 'P', 87.39, '', '8530706924'),
(4, 'Maktabah Jafariyah , Sidhpur', 'chadotar', 'Ak', 'ORDA2Z_00000004', '2019-06-14 10:20:37', 'P', 75.19, '', '8530706924'),
(5, 'Dr. Lavista 144, CuauhtÃ©moc, 06720 Cuauhtemoc, CDMX, Mexico', 'Chadotar, Gujarat 385001, India', 'akbar', 'ORDA2Z_00000005', '2019-06-14 10:21:41', 'P', 45, '', ''),
(6, 'Palani, Tamil Nadu, India', 'Deep Cove, North Vancouver, BC, Canada', 'akbar', 'ORDA2Z_00000006', '2019-06-14 10:23:59', 'P', 39, 'test', 'husen'),
(7, 'Palani, Tamil Nadu, India', 'Deep Cove, North Vancouver, BC, Canada', 'akbar', 'ORDA2Z_00000007', '2019-06-14 10:26:17', 'P', 39, 'test', 'husen'),
(8, 'Palani, Tamil Nadu, India', 'Deep Cove, North Vancouver, BC, Canada', 'akbar', 'ORDA2Z_00000008', '2019-06-14 10:29:17', 'P', 39219.25, 'test', 'husen'),
(9, 'Santalpur, Gujarat, India', 'Chandisar, Gujarat, India', 'Maherali', 'ORDA2Z_00000009', '2019-06-14 15:50:41', 'P', 379.52, 'Special note', '+919662414962');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `items` longtext NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `items`, `order_id`) VALUES
(1, 'a:3:{s:4:\"item\";a:2:{i:0;s:12:\"mumbai halwa\";i:1;s:8:\"stoberry\";}s:3:\"qty\";a:2:{i:0;s:2:\"10\";i:1;s:2:\"20\";}s:4:\"note\";a:2:{i:0;s:4:\"cool\";i:1;s:5:\"testy\";}}', 1),
(2, 'a:3:{s:4:\"item\";a:2:{i:0;s:6:\"item 2\";i:1;s:6:\"item 3\";}s:3:\"qty\";a:2:{i:0;s:1:\"5\";i:1;s:2:\"20\";}s:4:\"note\";a:2:{i:0;s:6:\"test 2\";i:1;s:6:\"test 2\";}}', 2),
(3, 'a:3:{s:4:\"item\";a:2:{i:0;s:6:\"item 3\";i:1;s:8:\"stoberry\";}s:3:\"qty\";a:2:{i:0;s:1:\"5\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:6:\"test 3\";i:1;s:6:\"test 2\";}}', 3),
(4, 'a:3:{s:4:\"item\";a:1:{i:0;s:0:\"\";}s:3:\"qty\";a:1:{i:0;s:0:\"\";}s:4:\"note\";a:1:{i:0;s:0:\"\";}}', 4),
(5, 'a:3:{s:4:\"item\";a:1:{i:0;s:0:\"\";}s:3:\"qty\";a:1:{i:0;s:0:\"\";}s:4:\"note\";a:1:{i:0;s:0:\"\";}}', 5),
(6, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"item 3te\";i:1;s:6:\"item 2\";}s:3:\"qty\";a:2:{i:0;s:1:\"4\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:7:\"test 23\";i:1;s:6:\"test 3\";}}', 6),
(7, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"item 3te\";i:1;s:6:\"item 2\";}s:3:\"qty\";a:2:{i:0;s:1:\"4\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:7:\"test 23\";i:1;s:6:\"test 3\";}}', 7),
(8, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"item 3te\";i:1;s:6:\"item 2\";}s:3:\"qty\";a:2:{i:0;s:1:\"4\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:7:\"test 23\";i:1;s:6:\"test 3\";}}', 8),
(9, 'a:3:{s:4:\"item\";a:2:{i:0;s:19:\"SAMSUNG LED 32 Inch\";i:1;s:16:\"N.K. Refined Oil\";}s:3:\"qty\";a:2:{i:0;s:3:\"2kg\";i:1;s:6:\"12 Ltr\";}s:4:\"note\";a:2:{i:0;s:39:\"Please parcel and deliver it carefully.\";i:1;s:14:\"Raj Industries\";}}', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin@a2zdeliveryboys.in', 'e6869a201b61fbf015db8b616ca8864a', '2019-02-14 05:32:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryboys`
--
ALTER TABLE `deliveryboys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orde_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `deliveryboys`
--
ALTER TABLE `deliveryboys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
