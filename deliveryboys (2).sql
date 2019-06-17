-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 17, 2019 at 07:28 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

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

DROP TABLE IF EXISTS `app_settings`;
CREATE TABLE IF NOT EXISTS `app_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `user_to` varchar(255) NOT NULL,
  `user_from` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `mediaUrl` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `order_id`, `user_to`, `user_from`, `message`, `mediaUrl`, `created_at`) VALUES
(1, '0', 'admin', '', 'hello', '', '2019-06-14 11:39:02'),
(2, '0', 'admin', '', 'hello', '', '2019-06-14 11:41:48'),
(3, '0', 'admin', '', 'gdfg', '', '2019-06-14 11:41:52'),
(4, 'ORDA2Z_00000008', 'admin', '', 'gdfg', '', '2019-06-14 11:42:27'),
(5, 'ORDA2Z_00000008', 'admin', '', 'fdsf', '', '2019-06-14 11:42:29'),
(6, 'ORDA2Z_00000008', 'admin', '', 'dfsd', '', '2019-06-14 11:44:59'),
(7, 'ORDA2Z_00000008', 'admin', '', 'hfgh', '', '2019-06-14 11:48:12'),
(8, 'ORDA2Z_00000008', 'admin', '', 'dfsf', '', '2019-06-14 11:59:04'),
(9, 'ORDA2Z_00000008', 'admin', '', 'df', '', '2019-06-14 12:03:16'),
(10, 'ORDA2Z_00000008', 'admin', '', 'df', 'http://localhost/assets/img/chat-attachments/1 (3)_5d0340c44bf9e.jpg', '2019-06-14 12:07:56'),
(11, 'ORDA2Z_00000008', 'admin', '', 'hello', 'http://localhost/assets/img/chat-attachments/1 (4)_5d0340dd2f8e4.jpg', '2019-06-14 12:08:21'),
(12, 'ORDA2Z_00000008', 'admin', '', 'hello', '', '2019-06-14 12:09:51'),
(13, 'ORDA2Z_00000008', 'admin', '', 'hello', 'http://localhost/assets/img/chat-attachments/1 (4)_5d034141acc9c.jpg', '2019-06-14 12:10:01'),
(14, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', 'fsdfsd', '', '2019-06-14 12:28:44'),
(15, 'ORDA2Z_00000001', 'admin@a2zdeliveryboys.in', '', 'hi', '', '2019-06-14 12:29:26'),
(16, 'ORDA2Z_00000001', 'admin@a2zdeliveryboys.in', '', 'hello', 'http://localhost/assets/img/chat-attachments/1 (3)_5d0345d78f34d.jpg', '2019-06-14 12:29:35'),
(17, 'ORDA2Z_00000001', 'admin@a2zdeliveryboys.in', '', 'hello', 'http://localhost/assets/img/chat-attachments/1 (3)_5d03460a0a8fa.jpg', '2019-06-14 12:30:26'),
(18, 'ORDA2Z_00000001', 'admin@a2zdeliveryboys.in', '', 'hello', 'assets/img/chat-attachments/1 (3)_5d03475d8cef8.jpg', '2019-06-14 12:36:05'),
(19, 'ORDA2Z_00000001', 'admin@a2zdeliveryboys.in', '', 'fgd', 'assets/img/chat-attachments/1 (4)_5d03476a5f153.jpg', '2019-06-14 12:36:18'),
(20, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', '', 'assets/img/chat-attachments/A2Z Delivery Boys_5d0371af71abd.png', '2019-06-14 15:36:39'),
(21, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', '', 'assets/img/chat-attachments/A2Z Delivery Boys_5d0371af91694.png', '2019-06-14 15:36:39'),
(22, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', '', 'assets/img/chat-attachments/green_grass_wallpaper-800x600 (1)_5d03720dbcb7f.jpg', '2019-06-14 15:38:13'),
(23, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', '', 'assets/img/chat-attachments/green_grass_wallpaper-800x600 (1)_5d03727f6919c.jpg', '2019-06-14 15:40:07'),
(24, 'ORDA2Z_00000008', 'admin@a2zdeliveryboys.in', '', '', 'assets/img/chat-attachments/green_grass_wallpaper-800x600 (1)_5d037282d7801.jpg', '2019-06-14 15:40:10'),
(25, 'ORDA2Z_00000021', '1', '4', 'Hello', '', '2019-06-17 11:28:04'),
(26, 'ORDA2Z_00000021', '4', '1', 'Going well ', 'assets/img/chat-attachments/80_5d072c1a66e76.png', '2019-06-17 11:28:50'),
(29, 'ORDA2Z_00000021', '1', '4', 'How are you?', '', '2019-06-17 11:49:04'),
(30, 'ORDA2Z_00000021', '4', '1', 'Test message', '', '2019-06-17 11:53:02'),
(31, 'ORDA2Z_00000021', '4', '1', 'Well', '', '2019-06-17 11:54:06'),
(32, 'ORDA2Z_00000021', '1', '4', 'I am good. tell me about yours', '', '2019-06-17 11:55:23'),
(33, 'ORDA2Z_00000022', '1', '3', 'Hello', '', '2019-06-17 12:55:06'),
(34, 'ORDA2Z_00000022', '1', '3', 'How are you?', '', '2019-06-17 12:55:22'),
(35, 'ORDA2Z_00000022', '3', '1', 'I am good', '', '2019-06-17 12:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryboys`
--

DROP TABLE IF EXISTS `deliveryboys`;
CREATE TABLE IF NOT EXISTS `deliveryboys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliveryboys`
--

INSERT INTO `deliveryboys` (`id`, `name`, `contact`) VALUES
(4, 'Hasanali Abbasbhai Maknojjiya', '+91 9725760815');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_from` varchar(255) NOT NULL,
  `order_to` varchar(255) NOT NULL,
  `bill_to` varchar(400) NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` enum('P','D','R','C') NOT NULL,
  `delivery_charge` double NOT NULL DEFAULT '0',
  `special_note` text NOT NULL,
  `customer_phone_number` varchar(30) NOT NULL,
  `deliveryboy_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_from`, `order_to`, `bill_to`, `order_no`, `created_at`, `order_status`, `delivery_charge`, `special_note`, `customer_phone_number`, `deliveryboy_id`) VALUES
(1, 'Marine Drive, Churchgate, Mumbai, Maharashtra, India', 'Panchgani, Maharashtra, India', 'Akbar', 'ORDA2Z_00000001', '2019-06-13 15:16:04', 'P', 457.66, 'special order', '8530706924', 0),
(2, 'Sola Bridge, Shenbhai Nagar, Thaltej, Ahmedabad, Gujarat, India', 'Mehsana, Gujarat, India', 'Ak', 'ORDA2Z_00000002', '2019-06-13 17:37:58', 'P', 180.17, 'Cool', '8530706924', 0),
(3, 'iqra english medium school chadotar', 'SIDHPUR, Ahmedabad - Palanpur Highway Road, Siddhpur, Gujarat, India', 'Ak', 'ORDA2Z_00000003', '2019-06-14 09:44:29', 'P', 87.39, '', '8530706924', 0),
(4, 'Maktabah Jafariyah , Sidhpur', 'chadotar', 'Ak', 'ORDA2Z_00000004', '2019-06-14 10:20:37', 'P', 75.19, '', '8530706924', 0),
(5, 'Dr. Lavista 144, CuauhtÃ©moc, 06720 Cuauhtemoc, CDMX, Mexico', 'Chadotar, Gujarat 385001, India', 'akbar', 'ORDA2Z_00000005', '2019-06-14 10:21:41', 'P', 45, '', '', 0),
(6, 'Palani, Tamil Nadu, India', 'Deep Cove, North Vancouver, BC, Canada', 'akbar', 'ORDA2Z_00000006', '2019-06-14 10:23:59', 'P', 39, 'test', 'husen', 0),
(7, 'Palani, Tamil Nadu, India', 'Deep Cove, North Vancouver, BC, Canada', 'akbar', 'ORDA2Z_00000007', '2019-06-14 10:26:17', 'P', 39, 'test', 'husen', 0),
(8, 'Palani, Tamil Nadu, India', 'Deep Cove, North Vancouver, BC, Canada', 'akbar', 'ORDA2Z_00000008', '2019-06-14 10:29:17', 'P', 39219.25, 'test', 'husen', 0),
(9, 'Santalpur, Gujarat, India', 'Chandisar, Gujarat, India', 'Maherali', 'ORDA2Z_00000009', '2019-06-14 15:50:41', 'P', 379.52, 'Special note', '+919662414962', 0),
(10, 'Mehsana, Gujarat, India', 'Adalaj Circle, Adalaj, Gujarat, India', 'akbar', 'ORDA2Z_00000010', '2019-06-17 09:32:20', 'P', 155.02, 'Test', '8530706924', 0),
(11, 'Mehsana, Gujarat, India', 'Adalaj Circle, Adalaj, Gujarat, India', 'akbar', 'ORDA2Z_00000011', '2019-06-17 09:34:51', 'P', 155.02, 'Test', '8530706924', 0),
(12, 'Mehsana, Gujarat, India', 'Adalaj Circle, Adalaj, Gujarat, India', 'akbar', 'ORDA2Z_00000012', '2019-06-17 09:35:18', 'P', 155.02, 'Test', '8530706924', 0),
(13, 'Mehsana, Gujarat, India', 'Adalaj Circle, Adalaj, Gujarat, India', 'akbar', 'ORDA2Z_00000013', '2019-06-17 09:35:29', 'P', 155.02, 'Test', '8530706924', 0),
(14, 'Devpura, Gujarat, India', 'Kirtistambh Circle, Chaman Bagh, Palanpur, Gujarat, India', 'MD', 'ORDA2Z_00000014', '2019-06-17 09:59:35', 'P', 330.57, 'Special test note', '9865324578', 4),
(15, 'Devpura, Gujarat, India', 'Kirtistambh Circle, Chaman Bagh, Palanpur, Gujarat, India', 'MD', 'ORDA2Z_00000015', '2019-06-17 10:06:19', 'P', 330.57, 'Special test note', '9865324578', 4),
(16, 'Devpura, Gujarat, India', 'Kirtistambh Circle, Chaman Bagh, Palanpur, Gujarat, India', 'MD', 'ORDA2Z_00000016', '2019-06-17 10:06:41', 'P', 330.57, 'Special test note', '9865324578', 4),
(17, 'Devpura, Gujarat, India', 'Kirtistambh Circle, Chaman Bagh, Palanpur, Gujarat, India', 'MD', 'ORDA2Z_00000017', '2019-06-17 10:07:06', 'P', 330.57, 'Special test note', '9865324578', 4),
(18, 'Devpura, Gujarat, India', 'Kirtistambh Circle, Chaman Bagh, Palanpur, Gujarat, India', 'MD', 'ORDA2Z_00000018', '2019-06-17 10:07:33', 'P', 330.57, 'Special test note', '9865324578', 4),
(19, 'Devpura, Gujarat, India', 'Kirtistambh Circle, Chaman Bagh, Palanpur, Gujarat, India', 'MD', 'ORDA2Z_00000019', '2019-06-17 10:08:39', 'P', 330.57, 'Special test note', '9865324578', 4),
(20, 'Devpura, Gujarat, India', 'Kirtistambh Circle, Chaman Bagh, Palanpur, Gujarat, India', 'MD', 'ORDA2Z_00000020', '2019-06-17 10:10:52', 'P', 330.57, 'Special test note', '9865324578', 4),
(21, 'Devpura, Gujarat, India', 'Kirtistambh Circle, Chaman Bagh, Palanpur, Gujarat, India', 'MD', 'ORDA2Z_00000021', '2019-06-17 10:11:19', 'P', 330.57, 'Special test note', '9865324578', 4),
(22, 'Deesa, Gujarat, India', 'Palanpur, Gujarat, India', 'Ak', 'ORDA2Z_00000022', '2019-06-17 12:31:33', 'P', 78.3, 'test note', '8530706924', 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `items` longtext NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orde_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

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
(9, 'a:3:{s:4:\"item\";a:2:{i:0;s:19:\"SAMSUNG LED 32 Inch\";i:1;s:16:\"N.K. Refined Oil\";}s:3:\"qty\";a:2:{i:0;s:3:\"2kg\";i:1;s:6:\"12 Ltr\";}s:4:\"note\";a:2:{i:0;s:39:\"Please parcel and deliver it carefully.\";i:1;s:14:\"Raj Industries\";}}', 9),
(10, 'a:3:{s:4:\"item\";a:1:{i:0;s:6:\"item 2\";}s:3:\"qty\";a:1:{i:0;s:1:\"4\";}s:4:\"note\";a:1:{i:0;s:6:\"test 2\";}}', 10),
(11, 'a:3:{s:4:\"item\";a:1:{i:0;s:6:\"item 2\";}s:3:\"qty\";a:1:{i:0;s:1:\"4\";}s:4:\"note\";a:1:{i:0;s:6:\"test 2\";}}', 11),
(12, 'a:3:{s:4:\"item\";a:1:{i:0;s:6:\"item 2\";}s:3:\"qty\";a:1:{i:0;s:1:\"4\";}s:4:\"note\";a:1:{i:0;s:6:\"test 2\";}}', 12),
(13, 'a:3:{s:4:\"item\";a:1:{i:0;s:6:\"item 2\";}s:3:\"qty\";a:1:{i:0;s:1:\"4\";}s:4:\"note\";a:1:{i:0;s:6:\"test 2\";}}', 13),
(14, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"stoberry\";i:1;s:5:\"Apple\";}s:3:\"qty\";a:2:{i:0;s:1:\"3\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:5:\"Testy\";i:1;s:4:\"Nice\";}}', 14),
(15, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"stoberry\";i:1;s:5:\"Apple\";}s:3:\"qty\";a:2:{i:0;s:1:\"3\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:5:\"Testy\";i:1;s:4:\"Nice\";}}', 15),
(16, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"stoberry\";i:1;s:5:\"Apple\";}s:3:\"qty\";a:2:{i:0;s:1:\"3\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:5:\"Testy\";i:1;s:4:\"Nice\";}}', 16),
(17, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"stoberry\";i:1;s:5:\"Apple\";}s:3:\"qty\";a:2:{i:0;s:1:\"3\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:5:\"Testy\";i:1;s:4:\"Nice\";}}', 17),
(18, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"stoberry\";i:1;s:5:\"Apple\";}s:3:\"qty\";a:2:{i:0;s:1:\"3\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:5:\"Testy\";i:1;s:4:\"Nice\";}}', 18),
(19, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"stoberry\";i:1;s:5:\"Apple\";}s:3:\"qty\";a:2:{i:0;s:1:\"3\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:5:\"Testy\";i:1;s:4:\"Nice\";}}', 19),
(20, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"stoberry\";i:1;s:5:\"Apple\";}s:3:\"qty\";a:2:{i:0;s:1:\"3\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:5:\"Testy\";i:1;s:4:\"Nice\";}}', 20),
(21, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"stoberry\";i:1;s:5:\"Apple\";}s:3:\"qty\";a:2:{i:0;s:1:\"3\";i:1;s:1:\"4\";}s:4:\"note\";a:2:{i:0;s:5:\"Testy\";i:1;s:4:\"Nice\";}}', 21),
(22, 'a:3:{s:4:\"item\";a:2:{i:0;s:8:\"stoberry\";i:1;s:5:\"Apple\";}s:3:\"qty\";a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}s:4:\"note\";a:2:{i:0;s:6:\"test 3\";i:1;s:5:\"Testy\";}}', 22);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `contact`, `type`, `created_at`) VALUES
(1, 'admin@a2zdeliveryboys.in', 'e6869a201b61fbf015db8b616ca8864a', 'Admin', '', 1, '2019-02-14 05:32:50'),
(3, 'akbarmaknojiya@gmail.com', '81196613eb5939db8c152c2b1b78afe4', 'Akbar Husen', '+918530706924', 2, '2019-06-17 06:44:20');

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
