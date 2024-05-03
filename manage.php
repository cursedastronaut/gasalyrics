<html>
	<head>
		<title>GasaLyrics</title>
		<?php include("res/html/meta.html") ?>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./res/css/navbar.css"		type="text/css">
		<link rel="stylesheet" href="./res/css/song_list.css"	type="text/css">
		<link rel="stylesheet" href="./res/css/song.css"		type="text/css">
	</head>
	<body>
		<?php include_once("res/php/navbar.php") ?>

		
		<?php
			if (!is_null($_GET["song_id"])) {
				include_once("res/php/edit_song.php");
			} else if (!is_null($_GET["album_id"])) {
				include_once("res/php/select_song.php");
			} else {
				include_once("res/php/select_album.php");
			}
		?>

	</body>
</html>

