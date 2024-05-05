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
				<h1>Add a song</h1>
				
				<?php
				include_once("res/php/connection.php");
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$gs = new GasaLyricsDB();
					echo $_POST["titleText"] . "<br>" . $_POST["titleOrText"] ."<br>" . $_POST["albumText"] . "<br>" . $_POST["langCode"] . "<br>" . $_POST["inputText1"] . "<br>" . $_POST["inputText2"];
					echo "<br><br>";
					$sql = "INSERT INTO Songs (titleSongs, titleOriginalSongs, albumIdSongs) VALUES ('" . $gs->sanitize($_POST["titleText"]) . "','" . $gs->sanitize($_POST["titleOrText"]) . "'," . $gs->sanitize($_POST["albumText"]) . ")";
					$result = $gs->askSQL($sql, $_POST["username"], $_POST["password"]);
					$sql = "SELECT idSongs FROM Songs WHERE titleSongs='" . $gs->sanitize($_POST["titleText"]) . "' AND titleOriginalSongs='" . $gs->sanitize($_POST["titleOrText"]) . "' AND albumIdSongs=" . $gs->sanitize($_POST["albumText"]);
					$result = $gs->askSQL($sql);
					$row =  mysql_fetch_assoc($result);
					$numSong = $row["idSongs"];
					for ($numInputText = 1; !is_null($_POST["inputText" . ($numInputText)]); $numInputText++) 
					{
						$sql = "INSERT INTO Lyrics (idLang, contentLyrics, idSongsLyrics) VALUES ("
						. intval(str_replace("lang_", "", $gs->sanitize($_POST["langCode" . $numInputText])))
						. ", '" . $gs->sanitize($_POST["inputText" . $numInputText]) . "',  " . $numSong . ")";
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
					<label for="langCode1">Language</label>
					<select type="text" name="langCode1"><br>
					<?php
						$gs = new GasaLyricsDB();
						$languages = $gs->getLanguages();
						echo $languages;
						if ($languages != -1) {
							while ($row = mysql_fetch_assoc($languages)) {
								echo	"<option value='lang_" . $row["idLang"] . "'>"
								.		"" . $row["nameLang"]
								.		"</option>";
							}
						}
					?>
					</select>
					<label for="inputText1">Lyrics</label>
					<textarea type="text" name="inputText1" id="lyric1"></textarea><br>
				</form>
				<button class="add-language" onclick="createInput()">Add a language</button>
			</div>
			<?php include("res/php/albums.php"); ?>
		</div>
		<?php include("res/php/footer.php"); ?>
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

		const select = document.createElement("select");
		select.setAttribute("type", `text`);
		select.setAttribute("name", `langCode${clickCount}`);
		formElm.appendChild(select);

		// Copy options from langCode1 select
		const langCode1Select = document.querySelector('select[name="langCode1"]');
		const options = langCode1Select.querySelectorAll('option');
		options.forEach(option => {
			const clonedOption = option.cloneNode(true);
			select.appendChild(clonedOption);
		});

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

