-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2016 at 06:14 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `base`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `role` varchar(64) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created`, `modified`, `status`) VALUES
(1, 'UsmanAliMaan', 'be8c6ab7b760e49a12225eb9c5df5aeb7216f17e', 'usmanalimaan@outlook.com', 'king', '2016-09-20 09:24:17', '2016-09-20 09:24:17', 1),
(2, 'Faizan', 'd9cb3b012a429a54780e40e316807d08f86284cc', 'Shaah@yahoo.co.uk', 'king', '2016-09-20 09:26:19', '2016-09-21 14:29:12', 1),
(3, 'FaizanShah', '5d7263027dd2d8b9b313013afa5f68d2fdb8999b', 'fazdfi@loutlook.com', 'queen', '2016-09-20 13:20:56', '2016-09-21 14:23:21', 1),
(4, 'assssjdkljls', NULL, 'ase@as.com', NULL, '2016-09-20 14:32:45', '2016-09-20 14:57:09', 0),
(5, 'QERTYERWER', '1a93697e5b977c36e1a8c43b125d28b485aff3de', 'ASDSADSDAD@asd.com', NULL, '2016-09-20 14:36:26', '2016-09-20 14:57:19', 0),
(6, 'Usman23', '1ea6ea4cb6572ec65e61d0cce848b59813f36843', 'sjkdfuewoi@123.com', NULL, '2016-11-20 17:51:03', '2016-11-20 17:51:03', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
