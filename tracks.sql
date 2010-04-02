DROP TABLE IF EXISTS audio;
DROP TABLE IF EXISTS tracks;
DROP TABLE IF EXISTS track_bands;

CREATE TABLE tracks
(
	track_id int(11) NOT NULL AUTO_INCREMENT,
	genre_id int(11) NOT NULL,
	track_number int(11) NOT NULL,
	title varchar(100) NOT NULL,
	year varchar(4) NOT NULL,
	composer varchar(500) NOT NULL,
	description blob NOT NULL,
	PRIMARY KEY (track_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE track_bands
(
	track_id int(11) NOT NULL,
	band_id int(11) NOT NULL,
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