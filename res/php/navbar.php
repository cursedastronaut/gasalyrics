<header>
	<a href="index.php">
		<button class="logo">&nbsp;
		</button>
	</a>
	<?php
	include_once("res/php/connection.php");
	/*
	$gs_nav = new GasaLyricsDB();
	$albums = $gs_nav->getAlbums();
	if ($albums != -1) {
		while ($row = mysql_fetch_assoc($albums)) {
			echo	"<a href='index.php?album_id=" . $row["idAlbum"] . "'>"
			.		"" . $row["shortTitle"]
			.		"</a>";
		}
	}*/
	?>
	<button onclick="
	document.getElementsByClassName('sidebar')[0].style.display =
	(
		document.getElementsByClassName('sidebar')[0].style.display == 'none' 
		|| 
		document.getElementsByClassName('sidebar')[0].style.display == ''
	) ? 'block' : 'none';">
		Albums
	</button>
</header>