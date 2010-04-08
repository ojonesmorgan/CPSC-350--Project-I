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

DROP DATABASE IF EXISTS musicdb2;
CREATE DATABASE IF NOT EXISTS musicdb2;
GRANT ALL PRIVILEGES ON musicdb2.* to 'team3'@'localhost' identified by 'team3';
use musicdb2;

-- --------------------------------------------------------

--
-- Table structure for table `band`
--

CREATE TABLE IF NOT EXISTS `band` (
  `band_id` int(11) NOT NULL AUTO_INCREMENT,
  `bandName` varchar(30) NOT NULL,
  `bandCity` varchar(40) NOT NULL,
  `bandState` varchar(25) NOT NULL,
  `bandDescription` blob NOT NULL,
  `bandPhoto` varchar(100) NOT NULL,
  PRIMARY KEY (`band_id`)
  
 
 
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

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
  FOREIGN KEY (`band_id`) REFERENCES band (`band_id`),
  FOREIGN KEY (`genre_id`) REFERENCES genre (`genre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `band_genre`
--


--

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
 FOREIGN KEY (`venueAddress_id`) REFERENCES venue_address (`address_id`),
  FOREIGN KEY (`venueZipCode`) REFERENCES venue_zip_code (`zip_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- --------------------------------------------------------

--
-- Table structure for table `comments`
--


DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` blob NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reply` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `band_id` varchar(60) NOT NULL,
  `venue_id` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`email`) REFERENCES users (`email`),
  FOREIGN KEY (`band_id`) REFERENCES band (`band_id`),
  FOREIGN KEY (`venue_id`) REFERENCES venue (`venue_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE `votes`
(
  `id` int(11) NOT NULL,
  `vote` int(11) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  FOREIGN KEY (`id`) REFERENCES comments (`id`),
  FOREIGN KEY (`email`) REFERENCES users (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

--
-- Dumping data for table `votes`
--


-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--


DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings`
(
  `rating` int(11) NOT NULL DEFAULT '0',
  `band_id` varchar(60) NOT NULL,
  `venue_id` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  FOREIGN KEY (`band_id`) REFERENCES band (`band_id`),
  FOREIGN KEY (`venue_id`) REFERENCES venue (`venue_id`),
  FOREIGN KEY (`email`) REFERENCES users (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

DROP TABLE IF EXISTS audio;
DROP TABLE IF EXISTS tracks;
DROP TABLE IF EXISTS track_bands;
DROP TABLE IF EXISTS track_albums;

CREATE TABLE tracks
(
	genre_id int(11) NOT NULL,
	title varchar(100) NOT NULL,
	year varchar(4) NOT NULL,
	composer varchar(500) NOT NULL,
	description blob NOT NULL,
	PRIMARY KEY (track_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE track_bands
(
	track_band_id int(11) NOT NULL AUTO_INCREMENT,
	track_id int(11) NOT NULL,
	band_id int(11) NOT NULL,
	PRIMARY KEY (track_band_id),
	FOREIGN KEY (band_id) REFERENCES band (band_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE audio
(
	mp3_name varchar(50) NOT NULL,
	track_id int(11) NOT NULL,
	email varchar(50) NOT NULL,
	play_count int(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (mp3_name),
	FOREIGN KEY (track_id) REFERENCES tracks (track_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

ALTER TABLE comments MODIFY band_id int(11) NOT NULL;
ALTER TABLE comments MODIFY venue_id int(11) NOT NULL;
ALTER TABLE comments ADD track_id int(11) NOT NULL;
ALTER TABLE comments ADD FOREIGN KEY (track_id) REFERENCES tracks (track_id);

ALTER TABLE ratings MODIFY band_id int(11) NOT NULL;
ALTER TABLE ratings MODIFY venue_id int(11) NOT NULL;
ALTER TABLE ratings ADD track_id int(11) NOT NULL AFTER venue_id;
ALTER TABLE ratings ADD FOREIGN KEY (track_id) REFERENCES tracks (track_id);

DROP TABLE IF EXISTS audio;
DROP TABLE IF EXISTS tracks;
DROP TABLE IF EXISTS track_bands;
DROP TABLE IF EXISTS track_albums;

CREATE TABLE tracks
(
	genre_id int(11) NOT NULL,
	title varchar(100) NOT NULL,
	year varchar(4) NOT NULL,
	composer varchar(500) NOT NULL,
	description blob NOT NULL,
	PRIMARY KEY (track_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE track_bands
(
	track_band_id int(11) NOT NULL AUTO_INCREMENT,
	track_id int(11) NOT NULL,
	band_id int(11) NOT NULL,
	PRIMARY KEY (track_band_id),
	FOREIGN KEY (band_id) REFERENCES band (band_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE audio
(
	mp3_name varchar(50) NOT NULL,
	track_id int(11) NOT NULL,
	email varchar(50) NOT NULL,
	play_count int(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (mp3_name),
	FOREIGN KEY (track_id) REFERENCES tracks (track_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

ALTER TABLE comments MODIFY band_id int(11) NOT NULL;
ALTER TABLE comments MODIFY venue_id int(11) NOT NULL;
ALTER TABLE comments ADD track_id int(11) NOT NULL;
ALTER TABLE comments ADD FOREIGN KEY (track_id) REFERENCES tracks (track_id);

ALTER TABLE ratings MODIFY band_id int(11) NOT NULL;
ALTER TABLE ratings MODIFY venue_id int(11) NOT NULL;
ALTER TABLE ratings ADD track_id int(11) NOT NULL AFTER venue_id;
ALTER TABLE ratings ADD FOREIGN KEY (track_id) REFERENCES tracks (track_id);

--
-- Dumping data for table `ratings`
--
CREATE INDEX band_index ON band(bandName);
CREATE INDEX venue_index ON venue(venueName);
