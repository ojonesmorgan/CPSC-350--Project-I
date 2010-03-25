DROP DATABASE musicdb2;
CREATE DATABASE IF NOT EXISTS musicdb2;
GRANT ALL PRIVILEGES ON musicdb2.* to 'music'@'localhost' identified by 'music';
USE musicdb2;

CREATE TABLE IF NOT EXISTS `band` (`band_id` int(11) NOT NULL AUTO_INCREMENT,`bandName` varchar(30) NOT NULL,`bandState` varchar(25) NOT NULL,`bandDescription` blob NOT NULL,`bandPhoto` varchar(100) NOT NULL,PRIMARY KEY (`band_id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `band_genre` (`band_id` int(11) NOT NULL,`genre_id` int(11) NOT NULL,PRIMARY KEY (`band_id`,`genre_id`),FOREIGN KEY (`band_id`) REFERENCES band (`band_id`),FOREIGN KEY (`genre_id`) REFERENCES genre (`genre_id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `genre` ( `genre_id` int(11) NOT NULL AUTO_INCREMENT, `genre` varchar(25) NOT NULL, PRIMARY KEY (`genre_id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` ( `name` varchar(40) NOT NULL, `email` varchar(50) NOT NULL, `password` varchar(100) NOT NULL, `admin` tinyint(4) NOT NULL, PRIMARY KEY (`email`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `venue` ( `venue_id` int(11) NOT NULL AUTO_INCREMENT, `venueName` varchar(30) NOT NULL, `venueAddress_id` int(11) NOT NULL, `venueZipCode` char(5) NOT NULL, `venueDescription` blob NOT NULL, `venuePicture` varchar(100) NOT NULL, `venueMap` varchar(150) NOT NULL, PRIMARY KEY (`venue_id`), FOREIGN KEY (`venueAddress_id`) REFERENCES venue_address (`address_id`), FOREIGN KEY (`venueZipCode`) REFERENCES venue_zip_code (`zip_code`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `venue_address` ( `address_id` int(11) NOT NULL AUTO_INCREMENT, `number` int(11) NOT NULL, `street` varchar(25) NOT NULL, PRIMARY KEY (`address_id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `venue_zip_code` ( `zip_code` char(5) NOT NULL, `city` varchar(30) NOT NULL, `state` varchar(25) NOT NULL, PRIMARY KEY (`zip_code`)) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `comments` (`id` int(11) NOT NULL AUTO_INCREMENT, `comment` blob NOT NULL, `date` date NOT NULL, `time` time NOT NULL, `reply` int(11) NOT NULL, `email` varchar(50) NOT NULL, `band_id` varchar(60) NOT NULL, `venue_id` varchar(60) NOT NULL, PRIMARY KEY (`id`), FOREIGN KEY (`email`) REFERENCES users (`email`), FOREIGN KEY (`band_id`) REFERENCES band (`band_id`), FOREIGN KEY (`venue_id`) REFERENCES venue (`venue_id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `votes` (`id` int(11) NOT NULL, `vote` int(11) NOT NULL DEFAULT '0', `email` varchar(50) NOT NULL, FOREIGN KEY (`id`) REFERENCES comments (`id`), FOREIGN KEY (`email`) REFERENCES users (`email`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

CREATE TABLE IF NOT EXISTS `event` (`event_id` int(11) NOT NULL AUTO_INCREMENT, `eventName` varchar(50), `band_id` int(11) NOT NULL, `venue_id` int(11) NOT NULL, `eventDate` DATE NOT NULL,`eventTime` time NOT NULL, `eventDescription` blob NOT NULL, PRIMARY KEY (`event_id`), FOREIGN KEY (`band_id`) REFERENCES band (`band_id`), FOREIGN KEY (`venue_id`) REFERENCES venue (`venue_id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ratings` (`rating` int(11) NOT NULL DEFAULT '0', `band_id` varchar(60) NOT NULL, `venue_id` varchar(60) NOT NULL, `email` varchar(50) NOT NULL, FOREIGN KEY (`band_id`) REFERENCES band (`band_id`), FOREIGN KEY (`venue_id`) REFERENCES venue (`venue_id`), FOREIGN KEY (`email`) REFERENCES users (`email`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;


