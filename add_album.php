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
		<h1>Add an album</h1>
		
		<?php
		include_once("res/php/connection.php");
		$gs = new GasaLyricsDB();
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$sql = "INSERT INTO Album (titleAlbum, iconLinkAlbum, shortTitle) VALUES ('" . $_POST["titleAlbum"] . "','" . $_POST["iconLink"] . "','" . $_POST["titleShort"] . "')";
			$result = $gs->askSQL($sql);
		}
		?>
		<h1>Add lyrics</h1>
		<form id="songToAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >
			Titre de l'Album
			<input type="text" name="titleAlbum"><br>
			Titre court de l'Album
			<input type="text" name="titleShort"><br>
			Lien vers l'icône de l'Album (res/jpg/album_list/...)
			<input type="text" name="iconLink"><br>
			<button type="submit">Submit</button>
		</form>

	</body>
</html>

