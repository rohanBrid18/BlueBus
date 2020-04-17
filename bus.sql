-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 17, 2020 at 03:33 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(3) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(3, 'Daily Buses'),
(4, 'Weekly Buses'),
(5, 'Night Buses');

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

DROP TABLE IF EXISTS `cost`;
CREATE TABLE IF NOT EXISTS `cost` (
  `cost_id` int(11) NOT NULL AUTO_INCREMENT,
  `start` varchar(255) NOT NULL,
  `stopage` varchar(255) NOT NULL,
  `category` int(3) NOT NULL,
  `cost` int(3) NOT NULL,
  PRIMARY KEY (`cost_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`cost_id`, `start`, `stopage`, `category`, `cost`) VALUES
(3, 'Mumbai', 'Panvel', 3, 30),
(4, 'Mumbai', 'Lonavala', 3, 100),
(5, 'Mumbai', 'Pune', 3, 200),
(6, 'Mumbai', 'Panvel', 5, 30),
(7, 'Mumbai', 'Chiplun', 5, 150),
(8, 'Mumbai', 'Ratnagiri', 5, 250),
(9, 'Mumbai', 'Goa', 5, 500),
(10, 'Mumbai', 'Surat', 3, 300),
(11, 'Mumbai', 'Vadodara', 3, 400),
(12, 'Mumbai', 'Udaipur', 3, 700),
(13, 'Mumbai', 'Jaipur', 3, 1000),
(14, 'Mumbai', 'Delhi', 3, 1200),
(15, 'Mumbai', 'Pune', 4, 200),
(16, 'Mumbai', 'Kolhapur', 4, 500),
(17, 'Mumbai', 'Mysore', 4, 800),
(18, 'Mumbai', 'Bangalore', 4, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(3) NOT NULL AUTO_INCREMENT,
  `bus_id` int(3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `passenger_count` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `cost` int(3) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `bus_id`, `user_id`, `passenger_count`, `source`, `destination`, `date`, `cost`) VALUES
(25, 3, 0, 0, 'Delhi', 'Mumbai', '2020-04-11', 0),
(28, 3, 0, 2, 'Delhi', 'Mumbai', '2020-04-11', 0),
(32, 3, 0, 4, 'Mumbai', 'Delhi', '2020-04-14', 300),
(33, 3, 0, 2, 'Mumbai', 'Jaipur', '2020-04-14', 2000),
(34, 1, 31, 2, 'Mumbai', 'Pune', '2020-04-12', 400),
(35, 1, 31, 1, 'Mumbai', 'Lonavala', '2020-04-12', 100),
(36, 2, 31, 2, 'Mumbai', 'Chiplun', '2020-04-13', 300),
(39, 3, 31, 1, 'Mumbai', 'Udaipur', '2020-04-16', 700),
(41, 3, 31, 2, 'Mumbai', 'Vadodara', '2020-04-17', 800),
(42, 1, 31, 2, 'Mumbai', 'Lonavala', '2020-04-16', 200),
(43, 2, 31, 2, 'Mumbai', 'Ratnagiri', '2020-04-16', 500),
(44, 4, 31, 3, 'Mumbai', 'Kolhapur', '2020-04-16', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(3) NOT NULL AUTO_INCREMENT,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_source` varchar(255) NOT NULL,
  `post_destination` varchar(255) NOT NULL,
  `post_via` varchar(255) NOT NULL,
  `post_via_time` varchar(255) NOT NULL,
  `post_query_count` int(3) NOT NULL,
  `max_seats` int(3) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_source`, `post_destination`, `post_via`, `post_via_time`, `post_query_count`, `max_seats`) VALUES
(1, 3, 'Mumbai to Pune', 'Vivek Travels', '2020-04-11', 'bus2.jpg', 'Runs daily Lowest fare among all', 'Mumbai', 'Pune', 'Mumbai Panvel Lonavala Pune', '15:00 15:30 16:30 17:30', 1, 55),
(2, 5, 'Mumbai to Goa', 'RB Travels', '2020-04-01', 'bus1.jpg', 'Runs daily Lowest fares among all', 'Mumbai', 'Goa', 'Mumbai Panvel Chiplun Ratnagiri Goa', '21:00 22:00 3:00 5:00 9:00', 2, 35),
(3, 3, 'Mumbai to Delhi', 'RB Travels', '2018-04-26', 'bus3.jpg', 'Runs daily \r\nLowest fare among all', 'Mumbai', 'Delhi', 'Mumbai Surat Vadodara Udaipur Jaipur Delhi', '3:00 5:00 7:00 12:00 18:00 20:00', 1, 30),
(4, 4, 'Mumbai to Bangalore', 'Vivek', '2018-05-18', 'bus4.jpg', 'Runs only on Tuesday', 'Mumbai', 'Bangalore', 'Mumbai Pune Kolhapur Mysore Bangalore', '12:00 2:00 5:00 7:00 9:30', 6, 55);

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

DROP TABLE IF EXISTS `query`;
CREATE TABLE IF NOT EXISTS `query` (
  `query_id` int(3) NOT NULL AUTO_INCREMENT,
  `query_bus_id` int(3) NOT NULL,
  `query_user` varchar(255) NOT NULL,
  `query_email` varchar(255) NOT NULL,
  `query_date` date NOT NULL,
  `query_content` text NOT NULL,
  `query_replied` varchar(255) NOT NULL,
  PRIMARY KEY (`query_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `query`
--

INSERT INTO `query` (`query_id`, `query_bus_id`, `query_user`, `query_email`, `query_date`, `query_content`, `query_replied`) VALUES
(6, 2, 'Rohan', 'bridrohan1122@gmail.com', '2018-03-17', 'Great Services', 'no'),
(13, 4, '(unknown)', 'unknown@gmail.com', '2018-03-18', 'Good service', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

DROP TABLE IF EXISTS `seats`;
CREATE TABLE IF NOT EXISTS `seats` (
  `bus_id` int(3) NOT NULL,
  `max_seats` int(3) NOT NULL,
  `available_seats` int(3) NOT NULL,
  PRIMARY KEY (`bus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phoneno` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_phoneno`, `user_image`, `user_role`) VALUES
(2, 'admin', 'admin', 'admin', 'admin', 'support@admin.com', '9999999999', 'user_default.jpg', 'admin'),
(31, 'rb18', 'rohan@1812', 'Rohan', 'Brid', 'bridrohan1122@gmail.com', '7506190431', 'user_default.jpg', 'subscriber');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
