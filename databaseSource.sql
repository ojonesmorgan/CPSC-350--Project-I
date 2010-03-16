-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2010 at 08:43 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `musicdb`
--
CREATE DATABASE IF NOT EXISTS musicdb;
GRANT ALL PRIVILEGES ON musicdb.* to 'music'@'localhost' identified by 'music';
use musicdb;
-- --------------------------------------------------------

--
-- Table structure for table `band`
--

CREATE TABLE IF NOT EXISTS `band` (
  `bandName` varchar(60) NOT NULL,
  `bandState` varchar(60) NOT NULL,
  `bandCity` varchar(60) NOT NULL,
  `bandGenre` varchar(60) NOT NULL,
  `bandDescription` blob NOT NULL,
  `bandPhoto` varchar(100) NOT NULL,
  PRIMARY KEY (`bandName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `band`
--

REPLACE INTO `band` (`bandName`, `bandState`, `bandCity`, `bandGenre`, `bandDescription`, `bandPhoto`) VALUES
('Test Band 10', 'Kentucky', '2', '2', 0x5468697320697320612074657374206465736372697074696f6e20666f7220546573742042616e642031, 'karl.jpg'),
('Test Band K', 'New York,', 'New York,', 'Pip', 0x5468697320697320612074657374206465736372697074696f6e20666f7220546573742042616e642032, 'karl.jpg'),
('Test Band L', 'Georgia', 'Orange', 'Kids', 0x546869732069732061206465736372697074696f6e, 'asdfasdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

REPLACE INTO `users` (`name`, `email`, `password`, `admin`) VALUES
('user', 'user@mail', 'ee11cbb19052e40b07aac0ca060c23ee', 0);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
  `venueName` varchar(60) NOT NULL,
  `venueState` varchar(60) NOT NULL,
  `venueCity` varchar(80) NOT NULL,
  `venueStreet` varchar(100) NOT NULL,
  `venueDescription` blob NOT NULL,
  `venuePicture` varchar(100) NOT NULL,
  `venueMap` varchar(150) NOT NULL,
  PRIMARY KEY (`venueName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

REPLACE INTO `venue` (`venueName`, `venueState`, `venueCity`, `venueStreet`, `venueDescription`, `venuePicture`, `venueMap`) VALUES
('Test Venue 1', 'Virginia', 'Stafford', 'Jefferson Davis Hwy', 0x5468697320697320612074657374206465736372697074696f6e20666f722056656e75652031, 'File Path for venue Picture here', 'url for map link for venue here'),
('Test Venue 2', 'Ohio', 'Cleveland', 'Made Up Street Rd', 0x5468697320697320612074657374206465736372697074696f6e20666f7220546573742056656e75652032, 'Test Venue 2 Picture path here', 'Test Venue 2 url map link here.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
