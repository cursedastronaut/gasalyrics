<main>
	<?php
	
	include_once("res/php/connection.php");
	
	$result = $gs->getSongs(-1, $_GET["song_id"]);
	if ($result == -1) {
		$gs->Error404("Song");
	}

	
	$row = mysql_fetch_assoc($result);
	$album = $gs->getAlbumById($row["albumIdSongs"]);
	
	if ($row["titleOriginalSongs"] == "" || $row["titleOriginalSongs"] == NULL)
		$toshow = $row["titleSongs"];
	else
		$toshow = $row["titleOriginalSongs"];


	$toshow = $gs->transformToEntities($toshow, false);
	$titleSongEnglish = $gs->transformToEntities($row["titleSongs"], false);

	echo ""
	. "<!-- Head - Partie 'Meta' -->"
	. "<meta property='og:type' content='website'>"
	. "<meta property='og:title' content='" . $toshow . " - GasaLyrics'>"
	. "<meta property='og:description' content='" . $toshow
	. " (" . $titleSongEnglish . ") on GasaLyrics, in the album " . $album['titleAlbum']
	. ".'>"
	. "<meta property='og:image' content='" . $gs->getWebsiteURL() . $album['iconLinkAlbum'] . "'>"
	. "<meta name='theme-color' content='#0094FF'>";

	echo "<h1>" . $row["titleSongs"] . "</h1>";
	if (!is_null($row["titleOriginalSongs"]))
		echo "<h2>" . $row["titleOriginalSongs"] . "</h2>";

	echo "<title>" . $row["titleSongs"] . " - GasaLyrics</title>";

	$result = $gs->getLyrics($_GET["song_id"]);
	for ($i = 0; $row =  mysql_fetch_assoc($result); $i+=1) {
		echo "<center><lyrics>" . "<button class='language' onclick='toggleDisplay(`lyrics-p" . $i . "`)'>" . $gs->langToDisplayName($row["langLyrics"]) . "</button>";
		echo "<p id='lyrics-p" . $i . "'>" . $row["contentLyrics"] . "</p></lyrics></center>";
	}
	?>

	<script src="./res/js/song.js"></script>

</main>