-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2010 at 10:06 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: 'musicdb2'
--

CREATE DATABASE IF NOT EXISTS musicdb2;
GRANT ALL PRIVILEGES ON musicdb2.* to 'music'@'localhost' identified by 'music';
use musicdb2;

-- --------------------------------------------------------

--
-- Table structure for table `band`
--

CREATE TABLE IF NOT EXISTS `band` (
  `band_id` int(11) NOT NULL AUTO_INCREMENT,
  `bandName` varchar(30) NOT NULL,
  `bandZipCode` char(5) NOT NULL,
  `bandDescription` blob NOT NULL,
  `bandPhoto` varchar(100) NOT NULL,
  PRIMARY KEY (`band_id`),
  KEY `bandZipCode` (`bandZipCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `band`
--


-- --------------------------------------------------------

--
-- Table structure for table `band_genre`
--

CREATE TABLE IF NOT EXISTS `band_genre` (
  `band_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`band_id`,`genre_id`),
  KEY `genre_id` (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `band_genre`
--


-- --------------------------------------------------------

--
-- Table structure for table `band_zip_code`
--

CREATE TABLE IF NOT EXISTS `band_zip_code` (
  `zip_code` char(5) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(25) NOT NULL,
  PRIMARY KEY (`zip_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `band_zip_code`
--


-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(25) NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `genre`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` tinyint(4) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--


-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
  `venue_id` int(11) NOT NULL AUTO_INCREMENT,
  `venueName` varchar(30) NOT NULL,
  `venueAddress_id` int(11) NOT NULL,
  `venueZipCode` char(5) NOT NULL,
  `venueDescription` blob NOT NULL,
  `venuePicture` varchar(100) NOT NULL,
  `venueMap` varchar(150) NOT NULL,
  PRIMARY KEY (`venue_id`),
  KEY `venueAddress_id` (`venueAddress_id`,`venueZipCode`),
  KEY `venueAddress_id_2` (`venueAddress_id`),
  KEY `venueZipCode` (`venueZipCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `venue`
--


-- --------------------------------------------------------

--
-- Table structure for table `venue_address`
--

CREATE TABLE IF NOT EXISTS `venue_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `street` varchar(25) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `venue_address`
--


-- --------------------------------------------------------

--
-- Table structure for table `venue_zip_code`
--

CREATE TABLE IF NOT EXISTS `venue_zip_code` (
  `zip_code` char(5) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(25) NOT NULL,
  PRIMARY KEY (`zip_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue_zip_code`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `band`
--
ALTER TABLE `band`
  ADD CONSTRAINT `band_ibfk_2` FOREIGN KEY (`band_id`) REFERENCES `band_genre` (`band_id`),
  ADD CONSTRAINT `band_ibfk_1` FOREIGN KEY (`bandZipCode`) REFERENCES `band_zip_code` (`zip_code`);

--
-- Constraints for table `genre`
--
ALTER TABLE `genre`
  ADD CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `band_genre` (`genre_id`);

--
-- Constraints for table `venue`
--
ALTER TABLE `venue`
  ADD CONSTRAINT `venue_ibfk_2` FOREIGN KEY (`venueZipCode`) REFERENCES `venue_zip_code` (`zip_code`),
  ADD CONSTRAINT `venue_ibfk_1` FOREIGN KEY (`venueAddress_id`) REFERENCES `venue_address` (`address_id`);