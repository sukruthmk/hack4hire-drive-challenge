-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2014 at 03:04 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `driveu`
--

-- --------------------------------------------------------

--
-- Table structure for table `drive_files`
--

CREATE TABLE IF NOT EXISTS `drive_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `modifiedtime` datetime NOT NULL,
  `icon` varchar(30) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `source` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `drive_files`
--

INSERT INTO `drive_files` (`id`, `name`, `path`, `modifiedtime`, `icon`, `type`, `size`, `source`) VALUES
(57, 'Startups at  Bangalore Hack for Hire Dec 2016', 'https://docs.google.com/spreadsheets/d/1k7t2C1nnZEeyM-57Cf1-H9jVCyuuMEAqafzFdfDmh7A/edit?usp=drivesdk', '2014-12-05 12:44:49', 'https://ssl.gstatic.com/docs/d', 'application/vnd.google-apps.spreadsheet', '', 'googledrive'),
(58, 'Untitled presentation', 'https://docs.google.com/presentation/d/10ooltLKOpHw_p_9hC3zwaHmoAFo12r6SrB6ePOEMpG8/edit?usp=drivesdk', '2013-03-25 07:00:40', 'https://ssl.gstatic.com/docs/d', 'application/vnd.google-apps.presentation', '', 'googledrive'),
(59, 'Getting Started.pdf', '/Getting Started.pdf', '2010-10-11 16:30:34', 'page_white_acrobat', 'application/pdf', '124.8 KB', 'dropbox'),
(60, 'Kaththi (2014)[Lotus DVDRip - x264 - 2CDRip - 1.4GB - Esubs - Tamil].mkv', '/Personal Movies/Kaththi/Kaththi (2014)[Lotus DVDRip - x264 - 2CDRip - 1.4GB - Esubs - Tamil].mkv', '2014-11-26 16:05:25', 'page_white_film', 'video/x-matroska', '1.4 GB', 'dropbox'),
(61, 'Kaththi (2014)[Lotus DVDRip - x264 - 2CDRip - 1.4GB - Esubs - Tamil].srt', '/Personal Movies/Kaththi/Kaththi (2014)[Lotus DVDRip - x264 - 2CDRip - 1.4GB - Esubs - Tamil].srt', '2014-11-26 10:16:46', 'page_white', 'application/octet-stream', '153.9 KB', 'dropbox'),
(62, 'How to use the Photos folder.rtf', '/Photos/How to use the Photos folder.rtf', '2010-10-11 16:30:34', 'page_white_word', 'application/rtf', '959 bytes', 'dropbox'),
(63, 'Boston City Flow.jpg', '/Photos/Sample Album/Boston City Flow.jpg', '2013-04-19 00:54:22', 'page_white_picture', 'image/jpeg', '331.8 KB', 'dropbox'),
(64, 'Costa Rican Frog.jpg', '/Photos/Sample Album/Costa Rican Frog.jpg', '2013-04-19 00:54:22', 'page_white_picture', 'image/jpeg', '346.3 KB', 'dropbox'),
(65, 'Pensive Parakeet.jpg', '/Photos/Sample Album/Pensive Parakeet.jpg', '2013-04-19 00:54:22', 'page_white_picture', 'image/jpeg', '468.8 KB', 'dropbox'),
(66, 'How to use the Public folder.rtf', '/Public/How to use the Public folder.rtf', '2010-10-11 16:30:34', 'page_white_word', 'application/rtf', '1 KB', 'dropbox'),
(67, 'suk.lnk', '/suk/suk.lnk', '2010-10-12 01:07:26', 'page_white', 'application/octet-stream', '355 bytes', 'dropbox');

-- --------------------------------------------------------

--
-- Table structure for table `drive_tokens`
--

CREATE TABLE IF NOT EXISTS `drive_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(40) NOT NULL,
  `request_token` varchar(255) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `source` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `drive_tokens`
--

INSERT INTO `drive_tokens` (`id`, `userid`, `request_token`, `access_token`, `source`) VALUES
(1, '13084467', '', 'm34C7xSyUC8AAAAAAAAN_NF4jET7bZNtslmbhoh6vmBpHnTfKTahFXO4LN1vtIUB', NULL),
(2, '13084467', '', 'm34C7xSyUC8AAAAAAAAN_qubTk3R4c33KUKCjBVVDsnj4RwGPsqmrQSAcbOP-c0w', NULL),
(3, '13084467', '', 'm34C7xSyUC8AAAAAAAAOAA-gTj031oeubb8aR4aW61F8arYUQKduHZfP0JCoQ4Yb', 'dropbox'),
(4, '13084467', '', 'm34C7xSyUC8AAAAAAAAOApGLkYLaQzeHF03e3ys6IYWQAmeknTJaxGlC3P8xLRQX', 'dropbox'),
(5, '13084467', '', 'm34C7xSyUC8AAAAAAAAOBKB-fPAMhuGUOWpXxeJpROv1kmK-FN73_lIKDmtrImzO', 'dropbox'),
(6, '13084467', '', 'm34C7xSyUC8AAAAAAAAOBuVzNM5N2ubS2EeB1HTQPapERL2vh0Pvfy6BaikQGHFU', 'dropbox'),
(7, '13084467', '', 'm34C7xSyUC8AAAAAAAAOCCDvCNzvj3pouCzWxtmlaE45-QCd-gyOuuAh3YK94Gz2', 'dropbox'),
(8, '13084467', '', 'm34C7xSyUC8AAAAAAAAOCsPMrKyxW4Exbk5WYRB-pmiAE7jijHKm6VALpdsbx-hH', 'dropbox'),
(9, '13084467', '', 'm34C7xSyUC8AAAAAAAAODvd5a38VZFuJsLmibIYKgpEJbljgKG8loXbV0Pswjq1E', 'dropbox'),
(10, '13084467', '', 'm34C7xSyUC8AAAAAAAAOEAMqK4EnMWAX0s9kui5fdeWeX5Pk1T6WcU6FQQQkWmbr', 'dropbox'),
(11, '13084467', '', 'm34C7xSyUC8AAAAAAAAOEji0UpfjUyP2Ww7NbTpTUfC4Iz9zJ4LZJ2jbp-ZvRNw9', 'dropbox'),
(12, '13084467', '', 'm34C7xSyUC8AAAAAAAAOFDp4sia-OfZUtcS3o7Ut2iuUJZk4U38aCgO3ErE_YpVp', 'dropbox'),
(13, '13084467', '', 'm34C7xSyUC8AAAAAAAAOFtG3S8dY5rCk0lteze_1LcKPO_Eob_ONLOxtRXyFGAwL', 'dropbox');

-- --------------------------------------------------------

--
-- Table structure for table `drive_users`
--

CREATE TABLE IF NOT EXISTS `drive_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `source` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `drive_users`
--

INSERT INTO `drive_users` (`id`, `userid`, `name`, `email`, `source`) VALUES
(1, '13084467', 'sukruth krishna', 'sukruthkrishna@gmail.com', 'dropbox'),
(2, '13084467', 'sukruth krishna', 'sukruthkrishna@gmail.com', 'dropbox'),
(3, '13084467', 'sukruth krishna', 'sukruthkrishna@gmail.com', 'dropbox'),
(4, '13084467', 'sukruth krishna', 'sukruthkrishna@gmail.com', 'dropbox'),
(5, '13084467', 'sukruth krishna', 'sukruthkrishna@gmail.com', 'dropbox'),
(6, '13084467', 'sukruth krishna', 'sukruthkrishna@gmail.com', 'dropbox'),
(7, '13084467', 'sukruth krishna', 'sukruthkrishna@gmail.com', 'dropbox'),
(8, '13084467', 'sukruth krishna', 'sukruthkrishna@gmail.com', 'dropbox'),
(9, '13084467', 'sukruth krishna', 'sukruthkrishna@gmail.com', 'dropbox'),
(10, '13084467', 'sukruth krishna', 'sukruthkrishna@gmail.com', 'dropbox'),
(11, '13084467', 'sukruth krishna', 'sukruthkrishna@gmail.com', 'dropbox');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
