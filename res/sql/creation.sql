CREATE TABLE IF NOT EXISTS `Album` (
	`idAlbum`		INT(11)			NOT NULL auto_increment,
	`titleAlbum`	VARCHAR(128)	COLLATE utf8_unicode_ci DEFAULT NULL,
	`iconLinkAlbum`	TEXT			COLLATE utf8_unicode_ci,
	`shortTitle`	VARCHAR(50)		COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY  (`idAlbum`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS `Languages` (
	`idLang`		INT(11)		NOT NULL auto_increment,
	`langLyrics`	VARCHAR(3)	COLLATE utf8_unicode_ci NOT NULL,
	`nameLang`		TEXT		COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY  (`idLang`),
	UNIQUE KEY `langLyrics` (`langLyrics`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS `Lyrics` (
	`idLyrics`		INT(11) NOT NULL auto_increment,
	`idLang`		INT(11) NOT NULL,
	`contentLyrics` TEXT	CHARACTER SET utf8 COLLATE utf8_unicode_ci,
	`idSongsLyrics` INT(11) DEFAULT NULL,
	PRIMARY KEY  (`idLyrics`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
CREATE TABLE IF NOT EXISTS `Songs` (
	`idSongs`				INT(11)			NOT NULL auto_increment,
	`titleSongs`			VARCHAR(128)	CHARACTER SET utf8 COLLATE utf8_unicode_ci	DEFAULT NULL,
	`titleOriginalSongs`	VARCHAR(4096)	CHARACTER SET utf8 COLLATE utf8_unicode_ci	DEFAULT NULL,
	`albumIdSongs`			INT(11)														DEFAULT NULL,
	PRIMARY KEY  (`idSongs`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS `Symlink` (
	`idSymlink`	INT(11)	NOT NULL auto_increment,
	`idSongs`	INT(11)	NOT NULL,
	`idAlbum`	INT(11)	NOT NULL,
	PRIMARY KEY  (`idSymlink`),
	KEY `idSongs` (`idSongs`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;