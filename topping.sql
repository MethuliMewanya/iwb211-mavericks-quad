-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2018 at 03:20 AM
-- Server version: 5.6.36-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE Database maverick;

-- --------------------------------------------------------



CREATE TABLE IF NOT EXISTS `topping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `topping`
--

INSERT INTO topping (id, name, price) VALUES
(1, 'Chocolate', 200.00),
(2, 'Vanila', 200.00),
(3, 'Strawberry', 250.00),
(4, 'Mint Chocolate Chip', 250.00),
(5, 'Cookies n Cream', 250.00),
(6, 'Butterscotch', 250.00),
(7, 'Strawberry Cheesecake', 250.00),
(8, 'Rum Raisin', 250.00),
(9, 'Sprinkles', 50.00),
(10, 'Hot Fudge', 50.00),
(11, 'Maraschino Cherries', 50.00),
(12, 'Whipped Cream', 50.00),
(13, 'Crushed Nuts', 50.00),
(14, 'Crushed Oreo', 70.00),
(15, 'Brownie Bites', 100.00),
(16, 'Gummy Bears', 50.00);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

