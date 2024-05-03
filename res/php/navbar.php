<header>
	<a href="index.php">
		<button class="logo">&nbsp;
		</button>
	</a>
	<?php
	include_once("res/php/connection.php");
	$gs_nav = new GasaLyricsDB();
	$albums = $gs_nav->getAlbums();

	while ($row = mysql_fetch_assoc($albums)) {
		echo	"<button onclick='location.href=`index.php?album_id=" . $row["idAlbum"] . "`'>"
		.		"	" . $row["shortTitle"]
		.		"</button>";
	}
	?>
</header>