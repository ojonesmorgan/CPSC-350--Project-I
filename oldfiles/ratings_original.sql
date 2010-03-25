DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings`
(
  `rating` int(11) NOT NULL DEFAULT '0',
  `bandName` varchar(60) NOT NULL,
  `venueName` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  FOREIGN KEY (`bandName`) REFERENCES band (`bandName`),
  FOREIGN KEY (`venueName`) REFERENCES venue (`venueName`),
  FOREIGN KEY (`email`) REFERENCES users (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;
