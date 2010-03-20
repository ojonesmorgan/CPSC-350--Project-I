DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` blob NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reply` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bandName` varchar(60) NOT NULL,
  `venueName` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`email`) REFERENCES users (`email`),
  FOREIGN KEY (`bandName`) REFERENCES band (`bandName`),
  FOREIGN KEY (`venueName`) REFERENCES venue (`venueName`),
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `votes`;
CREATE TABLE `votes`
(
  `id` int(11) NOT NULL,
  `vote` int(11) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  FOREIGN KEY (`id`) REFERENCES comments (`id`),
  FOREIGN KEY (`email`) REFERENCES users (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;
