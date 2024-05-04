<div class="sidebar">
	<?php
		include_once("res/php/connection.php");
		$gs_nav = new GasaLyricsDB();
		$albums = $gs_nav->getAlbums();

		if ($albums != -1) {
			while ($row = mysql_fetch_assoc($albums)) {
				echo	"<a href='index.php?album_id=" . $row["idAlbum"] . "'>"
				.		"" . $row["shortTitle"]
				.		"</a>";
			}
		}
	?>
</div>