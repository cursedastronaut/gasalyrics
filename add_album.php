<html>
	<head>
		<title>Add an album - GasaLyrics</title>
		<?php include("res/html/meta.html") ?>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./res/css/navbar.css"		type="text/css">
		<link rel="stylesheet" href="./res/css/song_list.css"	type="text/css">
		<link rel="stylesheet" href="./res/css/song.css"		type="text/css">
		<link rel="stylesheet" href="./res/css/managing.css"	type="text/css">
	</head>
	<body>
		<?php include_once("res/php/navbar.php") ?>
		<h1>Add an album</h1>
		
		<?php
		include_once("res/php/connection.php");
		$gs = new GasaLyricsDB();
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$gs->askSQL(
				"INSERT INTO Album (titleAlbum, iconLinkAlbum, shortTitle) VALUES ('" 
				. $gs->sanitize($_POST["titleAlbum"]) 
				. "','" . $gs->sanitize($_POST["iconLink"]) . "','"
				. $gs->sanitize($_POST["titleShort"]) . "');"
				, $_POST["username"], $_POST["password"]
			);
		}
		?>
		<h1>Add an album</h1>

		<form id="songToAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >
			<button type="submit">Submit</button>
			<label for="username">Username</label>
			<input type="text" name="username"><br>
			<label for="password">Password</label>
			<input type="password" name="password"><br>
			<br>
			<label for="titleAlbum">Full album title</label>
			<input type="text" name="titleAlbum"><br>
			<label for="titleShort">Short album title</label>
			<input type="text" name="titleShort"><br>
			<label for="iconLink">Link to the Album Icon (res/jpg/album_list/...)</label>
			<input type="text" name="iconLink"><br>
		</form>

	</body>
</html>

