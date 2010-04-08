-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2010 at 12:56 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `musicdb2`
--

DROP DATABASE IF EXISTS musicdb2;
CREATE DATABASE IF NOT EXISTS musicdb2;
GRANT ALL PRIVELEGES ON musicdb2.* to 'team3'@'localhost' identified by 'team3';
USE musicdb2;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `band_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `artwork` varchar(100) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `band_id`, `name`, `artwork`) VALUES
(1, 4, 'The Fame Monster', ''),
(2, 4, 'The Fame', ''),
(5, 1, 'Black Heart', '');

-- --------------------------------------------------------

--
-- Table structure for table `album_track`
--

CREATE TABLE IF NOT EXISTS `album_track` (
  `album_track_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `track_number` int(11) NOT NULL,
  PRIMARY KEY (`album_track_id`),
  KEY `album_id` (`album_id`),
  KEY `track_id` (`track_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `album_track`
--

INSERT INTO `album_track` (`album_track_id`, `album_id`, `track_id`, `track_number`) VALUES
(2, 1, 25, 6),
(3, 1, 27, 1),
(6, 1, 28, 2),
(7, 1, 29, 3),
(9, 1, 30, 4),
(10, 1, 31, 5),
(11, 1, 32, 7),
(12, 1, 33, 8);

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE IF NOT EXISTS `audio` (
  `mp3_name` varchar(50) NOT NULL,
  `track_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `play_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mp3_name`),
  KEY `track_id` (`track_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audio`
--

INSERT INTO `audio` (`mp3_name`, `track_id`, `email`, `play_count`) VALUES
('45895080-27', 27, 'mmartin3@umw.edu', 2),
('76318970-34', 34, 'mmartin3@umw.edu', 1),
('losecontrol', 1, '', 7),
('telephone', 25, '', 5);

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
  PRIMARY KEY (`band_id`),
  KEY `band_index` (`bandName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `band`
--

INSERT INTO `band` (`band_id`, `bandName`, `bandCity`, `bandState`, `bandDescription`, `bandPhoto`) VALUES
(1, 'Kish Mauve', 'London', 'England', '', 'Pictures/KishMauve.jpg'),
(2, 'band 2', '', '', '', ''),
(3, 'band 3', '', '', '', ''),
(4, 'Lady Gaga', '', '', '', 'Pictures/ladygaga_vmas.png'),
(5, 'BeyoncÃ©', '', '', '', 'Pictures/beyonce.png');

-- --------------------------------------------------------

--
-- Table structure for table `band_genre`
--

CREATE TABLE IF NOT EXISTS `band_genre` (
  `band_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`band_id`,`genre_id`),
  KEY `genre_id` (`genre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `band_genre`
--

INSERT INTO `band_genre` (`band_id`, `genre_id`) VALUES
(1, 1),
(1, 2),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(4, 1),
(4, 2),
(4, 5),
(5, 1),
(5, 6),
(5, 7),
(5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` blob NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reply` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `band_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `band_id` (`band_id`),
  KEY `venue_id` (`venue_id`),
  KEY `track_id` (`track_id`),
  KEY `album_id` (`album_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `date`, `time`, `reply`, `email`, `band_id`, `venue_id`, `track_id`, `album_id`) VALUES
(1, 0x49206c696b65207468656d2e, '2010-03-25', '13:59:41', 0, 'mmartin3@umw.edu', 1, 0, 0, 0),
(2, 0x617765736f6d65, '2010-04-02', '01:30:31', 0, 'mmartin3@umw.edu', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(25) NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre`) VALUES
(1, 'pop'),
(2, 'electropop'),
(3, ''),
(4, 'synthpop'),
(5, 'electronic'),
(6, 'r&amp;b'),
(7, 'soul'),
(8, 'hip-hop'),
(9, 'genre 1'),
(10, 'genre 3'),
(11, 'genre 4'),
(12, 'genre 2');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `rating` int(11) NOT NULL DEFAULT '0',
  `band_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  KEY `band_id` (`band_id`),
  KEY `venue_id` (`venue_id`),
  KEY `email` (`email`),
  KEY `track_id` (`track_id`),
  KEY `album_id` (`album_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating`, `band_id`, `venue_id`, `track_id`, `album_id`, `email`) VALUES
(1, 0, 1, 0, 0, 'mmartin3@umw.edu'),
(5, 1, 0, 0, 0, 'mmartin3@umw.edu'),
(5, 0, 0, 1, 0, 'mmartin3@umw.edu'),
(4, 0, 0, 1, 0, 'guy@someemail.com'),
(5, 0, 0, 25, 0, 'mmartin3@umw.edu'),
(3, 5, 0, 0, 0, 'mmartin3@umw.edu'),
(5, 4, 0, 0, 0, 'mmartin3@umw.edu'),
(5, 0, 0, 28, 0, 'mmartin3@umw.edu'),
(5, 0, 0, 27, 0, 'mmartin3@umw.edu'),
(5, 0, 0, 0, 1, 'mmartin3@umw.edu'),
(5, 0, 0, 0, 2, 'mmartin3@umw.edu'),
(4, 0, 0, 29, 0, 'mmartin3@umw.edu'),
(3, 0, 0, 34, 0, 'mmartin3@umw.edu');

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE IF NOT EXISTS `tracks` (
  `track_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `year` varchar(4) NOT NULL,
  `composer` varchar(500) NOT NULL,
  `description` blob NOT NULL,
  PRIMARY KEY (`track_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`track_id`, `genre_id`, `title`, `year`, `composer`, `description`) VALUES
(1, 1, 'Lose Control', '2009', 'Jim Eliot', 0x46726f6d2074686520616c62756d202671756f743b426c61636b2048656172742e2671756f743b),
(25, 1, 'Telephone', '2009', 'Lady Gaga/BeyoncÃ© Knowles/Rodney Jerkins', ''),
(26, 3, 'blah', '', '', ''),
(27, 1, 'Bad Romance', '2009', 'Lady Gaga/RedOne', ''),
(28, 1, 'Alejandro', '2009', 'Lady Gaga/RedOne', ''),
(29, 1, 'Monster', '2009', 'Lady Gaga/RedOne', ''),
(30, 1, 'Speechless', '2009', 'Lady Gaga/Ron Fair', ''),
(31, 1, 'Dance in the Dark', '2009', 'Lady Gaga/Fernando Garibay', ''),
(32, 1, 'So Happy I Could Die', '2009', 'Lady Gaga/RedOne', ''),
(33, 1, 'Teeth', '2009', 'Lady Gaga/Teddy Riley', ''),
(34, 3, 'Video Phone', '2009', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `track_albums`
--

CREATE TABLE IF NOT EXISTS `track_albums` (
  `track_album_id` int(11) NOT NULL AUTO_INCREMENT,
  `track_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `track_number` int(11) NOT NULL,
  PRIMARY KEY (`track_album_id`),
  KEY `track_id` (`track_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `track_albums`
--


-- --------------------------------------------------------

--
-- Table structure for table `track_bands`
--

CREATE TABLE IF NOT EXISTS `track_bands` (
  `track_band_id` int(11) NOT NULL AUTO_INCREMENT,
  `track_id` int(11) NOT NULL,
  `band_id` int(11) NOT NULL,
  PRIMARY KEY (`track_band_id`),
  KEY `band_id` (`band_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `track_bands`
--

INSERT INTO `track_bands` (`track_band_id`, `track_id`, `band_id`) VALUES
(1, 1, 1),
(4, 26, 3),
(8, 27, 4),
(18, 25, 4),
(19, 25, 5),
(23, 29, 4),
(25, 28, 4),
(27, 30, 4),
(29, 31, 4),
(31, 32, 4),
(33, 33, 4),
(35, 34, 5),
(37, 34, 4);

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

INSERT INTO `users` (`name`, `email`, `password`, `admin`) VALUES
('Some Guy', 'guy@someemail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0),
('Matt Martin', 'mmartin3@umw.edu', '81dc9bdb52d04dc20036dbd8313ed055', 1);

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
  KEY `venueAddress_id` (`venueAddress_id`),
  KEY `venueZipCode` (`venueZipCode`),
  KEY `venue_index` (`venueName`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_id`, `venueName`, `venueAddress_id`, `venueZipCode`, `venueDescription`, `venuePicture`, `venueMap`) VALUES
(1, 'sfdsafa', 2, '12345', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `venue_address`
--

CREATE TABLE IF NOT EXISTS `venue_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `street` varchar(25) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `venue_address`
--

INSERT INTO `venue_address` (`address_id`, `number`, `street`) VALUES
(1, 0, ''),
(2, 0, '');

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

INSERT INTO `venue_zip_code` (`zip_code`, `city`, `state`) VALUES
('12345', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL,
  `vote` int(11) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  KEY `id` (`id`),
  KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `vote`, `email`) VALUES
(2, 1, 'guy@someemail.com'),
(1, 1, 'guy@someemail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album_track`
--
ALTER TABLE `album_track`
  ADD CONSTRAINT `album_track_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`),
  ADD CONSTRAINT `album_track_ibfk_2` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`track_id`);

--
-- Constraints for table `audio`
--
ALTER TABLE `audio`
  ADD CONSTRAINT `audio_ibfk_1` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`track_id`);

--
-- Constraints for table `track_albums`
--
ALTER TABLE `track_albums`
  ADD CONSTRAINT `track_albums_ibfk_1` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`track_id`);

--
-- Constraints for table `track_bands`
--
ALTER TABLE `track_bands`
  ADD CONSTRAINT `track_bands_ibfk_1` FOREIGN KEY (`band_id`) REFERENCES `band` (`band_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
