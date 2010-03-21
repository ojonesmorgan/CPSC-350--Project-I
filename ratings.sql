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
