-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2015 at 08:05 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1-log
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `NotificationManager`
--

--
-- Dumping data for table `Configurations`
--

INSERT INTO `Configurations` (`Key`, `Value`) VALUES
('GOOGLE_CLIENT_ID', ''),
('GOOGLE_CLIENT_SECRET', ''),
('GOOGLE_REDIRECT_URL', ''),
('MINIFY_HTML', 'true'),
('SHOW_PHP_ERRORS', 'true');

--
-- Dumping data for table `DeliveryStatus`
--

INSERT INTO `DeliveryStatus` (`Id`, `Name`) VALUES
(1, 'NOT_SEND'),
(2, 'SENDING'),
(3, 'SENT');

--
-- Dumping data for table `Localizations`
--

INSERT INTO `Localizations` (`Id`, `Name`) VALUES
(1, 'IT'),
(2, 'EN'),
(3, 'ES'),
(4, 'DE'),
(5, 'FR'),
(6, 'RU');

--
-- Dumping data for table `NotificationStatus`
--

INSERT INTO `NotificationStatus` (`Id`, `Name`) VALUES
(1, 'DRAFT'),
(2, 'PUBLISHED');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
