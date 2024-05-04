<html>
	<head>
		<?php include("res/html/meta.html") ?>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./res/css/navbar.css"		type="text/css">
		<link rel="stylesheet" href="./res/css/song_list.css"	type="text/css">
		<link rel="stylesheet" href="./res/css/song.css"		type="text/css">
		<link rel="stylesheet" href="./res/css/album_list.css"	type="text/css">
		<link rel="stylesheet" href="./res/css/footer.css"		type="text/css">
	</head>
	<body>
		<?php
		include_once("res/php/navbar.php");
		$gs = new GasaLyricsDB();

		if (!is_null($_GET["song_id"]))
		{
			include_once("res/php/lyrics.php");
		}
		else if (!is_null($_GET["album_id"]))
		{
			$albumTitle = $gs->getAlbumTitle($_GET["album_id"], false);
			if ($albumTitle != -1) {
				echo "<title>" . $albumTitle . " - GasaLyrics</title>";
				include_once("res/php/song_list.php");
			}
			else {
				$gs->Error404("Album");
			}
		}
		else {
			$result = $gs->getAlbums();
			while ($row =  mysql_fetch_assoc($result)) {
				echo "<a href='index.php?album_id=" . $row["idAlbum"] . "' class='album_block';>"
				. "<center><div class='ablum_icon' style='background:url(" . $row["iconLinkAlbum"]. ");background-size:contain;'></div></center>"
				. $row["titleAlbum"] . "</a>";
			}
			echo "<title>GasaLyrics</title>";
		}
		include("res/php/footer.php");
		?>
	</body>
</html>

