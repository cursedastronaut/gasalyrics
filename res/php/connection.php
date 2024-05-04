<?php
include_once("config.php");

class GasaLyricsDB {
	//Sends the SQL command in $sql and returns its result.
	function askSQL($sql) {
		$db = mysql_connect(GASALYRICS_URL, GASALYRICS_DBUSERNAME, GASALYRICS_DBPASSWORD) or die("erreur de connexion au serveur");
		mysql_select_db(GASALYRICS_DBNAME, $db);
		
		//UTF-8 characters
		mysql_query("SET NAMES 'utf8';")							or die('FATAL: <br>'. mysql_error());
		mysql_query("SET CHARACTER SET 'utf8';")					or die('FATAL: <br>'.$sql_utf8.'<br>'.mysql_error());
		mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'")	or die("Cannot set UTF8 encoding. Exiting.");

		$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		mysql_close();
		return $result;
	}

	//Returns all informations about the albums
	function getAlbums() {
		$sql = "SELECT * from Album";
		$result = $this->askSQL($sql);
		
		if ($result->num_rows < 0)
			return -1;
		return $result;
	}

	//Returns each song id, title, original title, and the id of its album.
	function getSongs($albumId = -1, $songId = -1) {
		//Checks if songId is valid (proper int, and > 0)
		if (intval($songId) != 0 && is_int(intval($songId))) {
			$songId = intval($songId);
			//Select all song titles, their id, and album ids (including Symlinks).
			$sql = "SELECT Songs.idSongs, Songs.titleSongs, Songs.titleOriginalSongs,	Songs.albumIdSongs from Songs LEFT JOIN Symlink ON Symlink.idSongs = Songs.idSongs ";
			//If the album id is specified, we just list all the songs of the album.
			if ($albumId != -1 && $songId == -1)
				$sql = $sql . " AND Symlink.idAlbum = " . $albumId . " WHERE Songs.albumIdSongs=" . $albumId . " OR Symlink.idAlbum = "
                . $albumId . "  ";
			//If the song id is specified, we return its informations
			if ($songId != -1)
				$sql = $sql . " WHERE Songs.idSongs=" . $songId;

			$sql = $sql . "\n ORDER BY titleSongs;";
			$result = $this->askSQL($sql); 
			if ($result->num_rows < 0)
				return -1;
			return $result;
		}
		else
			return -1;
	}

	//Returns every Lyrics linked with a specific songId.
	function getLyrics($songId) {
		if (intval($songId) != 0 && is_int(intval($songId))) {
			$songId = intval($songId);
		
			$sql = "SELECT * from Lyrics WHERE idSongsLyrics=" . $songId;
			$result = $this->askSQL($sql);
			if ($result->num_rows < 0)
				return -1;
			return $result;
		}
	}

	//Returns the name of the language whose id is the parameter.
	function langToDisplayName($lang) {
		
		$sql = "SELECT nameLang from Languages WHERE langLyrics='" . $lang . "';";
		$result = $this->askSQL($sql);
		if ($result->num_rows < 0)
			return "Unknown language";

		$output = mysql_fetch_assoc($result);

		return $output["nameLang"];
	}

	//Gets the album titles
	function getAlbumTitle($albumId, $getShortTitle = false) {
		if (is_null($albumId))
			return -1;
		
		$sql = "SELECT ";
		if (!$getShortTitle)
			$sql = $sql . "titleAlbum";
		else
			$sql = $sql . "shortTitle";
		$sql = $sql . " from Album WHERE idAlbum=" . $albumId;

		$result = $this->askSQL($sql);

		if ($result->num_rows < 0)
			return -1;
		$title = -1;
		while ($row =  mysql_fetch_assoc($result)) {
			if (!$getShortTitle)
				$title= $row["titleAlbum"];
			else
				$title= $row["shortTitle"];
		}
		return $title;
	}

	function Error404($whatFailed = "Page") {
		echo "<h1>Error 404: " . $whatFailed . " not found.</h1>";
		echo "<title>Error 404: " . $whatFailed . " not found.</title>";
	}

	//Returns everything of an album whose id is specified in the parameter.
	function getAlbumById($albumId) {
		
		$sql = "SELECT * FROM Album WHERE idAlbum=" . $albumId;

		$result = $this->askSQL($sql);

		$row = -1; //I'll be the first to admit, I don't know why this works.

		if ($result->num_rows < 0)
			return -1;
		
		$row = mysql_fetch_assoc($result);
		return $row;
	}

	function transformToEntities($str, $deleteNewLine) {
		$result = "";
		for ($i = 0; $i < strlen($str); $i++) {
			if ($str[$i] == '\n') {
				if (false) {	$result .= "";	}
				else				{	$result .= "<br>"; }
			} else {
				$result .= "&#" . ord($str[$i]) . ";";
			}
		}
		return $result;
	}

	function getWebsiteURL() {
		return GASALYRICS_WEBURL;
	}

}

?>
