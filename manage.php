<html>
	<head>
		<title>GasaLyrics</title>
		<?php include("res/html/meta.html") ?>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./res/css/navbar.css"		type="text/css">
		<link rel="stylesheet" href="./res/css/song_list.css"	type="text/css">
		<link rel="stylesheet" href="./res/css/song.css"		type="text/css">
		<link rel="stylesheet" href="./res/css/managing.css"	type="text/css">
		<link rel="stylesheet" href="./res/css/footer.css"		type="text/css">
	</head>
	<body>
		<div class="flex">
			<div style="width: 100%;">
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
			</div>
			<?php include("res/php/albums.php"); ?>
		</div>
		<?php include("res/php/footer.php"); ?>
	</body>
</html>

