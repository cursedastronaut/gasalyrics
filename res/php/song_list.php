<main>
<h1>Choose your song:</h1>
	<?php

	include_once("res/php/connection.php");

	$result = $gs->getSongs($_GET["album_id"]);
	if ($result != -1) {
		while ($row =  mysql_fetch_assoc($result)) {
			echo "<a href='index.php?song_id=" . $row["idSongs"] . "' class='song'>" . $row["titleSongs"] . "</a>";
		}
	}
	?>
</main>
