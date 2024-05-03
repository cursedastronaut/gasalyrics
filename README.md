# GasaLyrics - 가사Lyrics
It's a website to display songs.

## Requirements
This website runs on the french ISP's server ("Free"). Since this service comes with the ISP for free, and it has been used for small websites since 2008, the requirements are quite outdated.
- PHP `4.4.3-dev`
- MySQL `5.0.83`
- Apache MySQL client `5.1.61`

## Database
The database is formed this way:
![Conceptual data model](res/sql/mcd.png)
### Translation
Règles Lyrics: Rules of table Lyrics
`langLyrics` is expressed by two characters representing the language code.
Example: English -> en; French -> fr

`contentLyrics` is encoded using HTML entities to avoid compatibility issues with database handling of UTF-8 characters. (Free's MySQL replaces unknown characters by interrogation points).

Règles Songs: Rules of table Songs
`titleOriginalSongs` must also be encoded to HTML entities.

### Creating the tables

```sql
-- Création de la table Album
CREATE TABLE IF NOT EXISTS `Album` (
	`idAlbum` INT(11) NOT NULL AUTO_INCREMENT,
	`titleAlbum` VARCHAR(128),
	`iconLinkAlbum` TEXT,
	`shortTitle` VARCHAR(50),
	PRIMARY KEY  (`idAlbum`)
);

-- Création de la table Languages
CREATE TABLE IF NOT EXISTS `Languages` (
	`idLang` INT(11) NOT NULL AUTO_INCREMENT,
	`langLyrics` VARCHAR(3) NOT NULL,
	`nameLang` TEXT NOT NULL,
	PRIMARY KEY  (`idLang`),
	UNIQUE KEY `langLyrics` (`langLyrics`)
);

-- Création de la table Lyrics
CREATE TABLE IF NOT EXISTS `Lyrics` (
	`idLyrics` INT(11) NOT NULL AUTO_INCREMENT,
	`langLyrics` VARCHAR(128),
	`contentLyrics` TEXT,
	`idSongsLyrics` INT(11) NULL,
	PRIMARY KEY  (`idLyrics`)
);

-- Création de la table `Songs`
CREATE TABLE IF NOT EXISTS `Songs` (
	`idSongs` INT(11) NOT NULL AUTO_INCREMENT,
	`titleSongs` VARCHAR(128),
	`titleOriginalSongs` VARCHAR(4096),
	`albumIdSongs` INT(11) NULL,
	PRIMARY KEY  (`idSongs`)
);

-- Création de la table `Symlink`
CREATE TABLE IF NOT EXISTS `Symlink` (
	`idSymlink` INT(11) NOT NULL AUTO_INCREMENT,
	`idSongs` INT(11) NOT NULL,
	`idAlbum` INT(11) NOT NULL,
	PRIMARY KEY  (`idSymlink`),
	KEY `idSongs` (`idSongs`)
);
```

## Configure the SQL access
Edit `res/php/config.php`, you can see an example in `res/php/config_example.php` ([See here](res/php/config_example.php)).