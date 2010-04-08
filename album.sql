DROP TABLE IF EXISTS album_track;
DROP TABLE IF EXISTS album;

CREATE TABLE `album` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `band_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `artwork` varchar(100) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE album_track
(
	album_track_id int(11) NOT NULL AUTO_INCREMENT,
	album_id int(11) NOT NULL,
	track_id int(11) NOT NULL,
	track_number int(11) NOT NULL,
	PRIMARY KEY (album_track_id),
	FOREIGN KEY (album_id) REFERENCES album (album_id),
	FOREIGN KEY (track_id) REFERENCES tracks (track_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

ALTER TABLE comments ADD COLUMN album_id int(11) NOT NULL;
ALTER TABLE comments ADD FOREIGN KEY (album_id) REFERENCES album (album_id);
ALTER TABLE ratings ADD COLUMN album_id int(11) NOT NULL AFTER track_id;
ALTER TABLE ratings ADD FOREIGN KEY (album_id) REFERENCES album (album_id);
