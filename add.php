<html>
	<head>
		<title>GasaLyrics</title>
		<?php include("res/html/meta.html") ?>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./res/css/navbar.css"		type="text/css">
		<link rel="stylesheet" href="./res/css/song_list.css"	type="text/css">
		<link rel="stylesheet" href="./res/css/song.css"		type="text/css">
		<link rel="stylesheet" href="./res/css/managing.css"	type="text/css">
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
			$result = $gs->askSQL($sql, $_POST["username"], $_POST["password"]);
			$sql = "SELECT idSongs FROM Songs WHERE titleSongs='" . $_POST["titleText"] . "' AND titleOriginalSongs='" . $_POST["titleOrText"] . "' AND albumIdSongs=" . $_POST["albumText"];
			$result = $gs->askSQL($sql);
			$row =  mysql_fetch_assoc($result);
			$numSong = $row["idSongs"];
			for ($numInputText = 1; !is_null($_POST["inputText" . ($numInputText)]); $numInputText++) 
			{
				$sql = "INSERT INTO Lyrics (langLyrics, contentLyrics, idSongsLyrics) VALUES ('" . $_POST["langCode" . $numInputText] . "', '" . $_POST["inputText" . $numInputText] . "',  " . $numSong . ")";
				$result = $gs->askSQL($sql, $_POST["username"], $_POST["password"]);
				echo $sql . "<br>";
			}
		}
		?>
		<h1>Add lyrics</h1>
		<form id="songToAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >
			<button type="submit">Submit</button>
			<label for="username">Username</label>
			<input type="text" name="username"><br>
			<label for="password">Password</label>
			<input type="password" name="password"><br>
			<br>
			<label for="titleText">English Title</label>
			<input type="text" name="titleText"><br>
			<label for="titleOrText">Original title</label>
			<input type="text" name="titleOrText" id="title0"><br>
			<label for="albumText">Album number</label>
			<input type="text" name="albumText"><br>
			<hr>
			<label for="langCode1">Language code</label>
			<input type="text" name="langCode1"><br>
			<label for="inputText1">Lyrics</label>
			<textarea type="text" name="inputText1" id="lyric1"></textarea><br>
		</form>
		<button class="add-language" onclick="createInput()">Add a language</button>

	</body>

	<script>
	let clickCount = 1;
	let formElm = document.getElementById("songToAdd");

	function createInput() {
		clickCount++;

		const label = document.createElement("label");
		label.setAttribute("for", `langCode${clickCount}`);
		label.innerHTML = "Language Code";
		formElm.appendChild(label);

		const input = document.createElement("input");
		input.setAttribute("type", `text`);
		input.setAttribute("name", `langCode${clickCount}`);
		formElm.appendChild(input);

		const br = document.createElement("br");
		formElm.appendChild(br);

		const label2 = document.createElement("label");
		label2.setAttribute("for", `inputText${clickCount}`);
		label2.innerHTML = "Lyrics";
		formElm.appendChild(label2);

		const textArea = document.createElement("textarea");
		textArea.setAttribute("name", `inputText${clickCount}`);
		textArea.setAttribute(`id`, `lyric${clickCount}`);
		formElm.appendChild(textArea);
		const br2 = document.createElement("br");
		formElm.appendChild(br2);
		
	}
	</script>
	<script src="./res/js/add.js">
	</script>
</html>

