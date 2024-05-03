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
		<h1>Add a song</h1>
		
		<?php
		include_once("res/php/connection.php");
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$gs = new GasaLyricsDB();
			echo $_POST["titleText"] . "<br>" . $_POST["titleOrText"] ."<br>" . $_POST["albumText"] . "<br>" . $_POST["langCode"] . "<br>" . $_POST["inputText1"] . "<br>" . $_POST["inputText2"];
			echo "<br><br>";
			$sql = "INSERT INTO Songs (titleSongs, titleOriginalSongs, albumIdSongs) VALUES ('" . $_POST["titleText"] . "','" . $_POST["titleOrText"] . "'," . $_POST["albumText"] . ")";
			$result = $gs->askSQL($sql);
			$sql = "SELECT idSongs FROM Songs WHERE titleSongs='" . $_POST["titleText"] . "' AND titleOriginalSongs='" . $_POST["titleOrText"] . "' AND albumIdSongs=" . $_POST["albumText"];
			$result = $gs->askSQL($sql);
			$row =  mysql_fetch_assoc($result);
			$numSong = $row["idSongs"];
			for ($numInputText = 1; !is_null($_POST["inputText" . ($numInputText)]); $numInputText++) 
			{
				$sql = "INSERT INTO Lyrics (langLyrics, contentLyrics, idSongsLyrics) VALUES ('" . $_POST["langCode" . $numInputText] . "', '" . $_POST["inputText" . $numInputText] . "',  " . $numSong . ")";
				$result = $gs->askSQL($sql);
				echo $sql . "<br>";
			}
		}
		?>
		<h1>Add lyrics</h1>
		<form id="songToAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >
			Titre anglais
			<input type="text" name="titleText"><br>
			Titre orignal
			<input type="text" id="title0" name="titleOrText"><br>
			Numéro de l'album
			<input type="text" name="albumText"><br>
			<hr>
			Code de langue
			<input type="text" name="langCode1"><br>
			Paroles
			<textarea type="text" id="lyric1" name="inputText1"></textarea><br>
			<button type="submit">Submit</button>
		</form>
		<button onclick="createInput()">Click me</button>

	</body>

	<script>
	let clickCount = 1;
	let formElm = document.getElementById("songToAdd");

	function createInput() {
		clickCount++;

		const input = document.createElement("input");
		input.setAttribute("name", `langCode${clickCount}`);
		formElm.appendChild(input);

		const textArea = document.createElement("textarea");
		textArea.setAttribute("name", `inputText${clickCount}`);
		textArea.setAttribute(`id`, `lyric${clickCount}`);
		formElm.appendChild(textArea);

		
	}
	</script>
	<script src="./res/js/add.js">
	</script>
</html>

