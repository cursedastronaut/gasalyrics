<?php
	include_once("connection.php");
	$gs = new GasaLyricsDB();

	$sql = "SELECT * FROM Songs WHERE idSongs=" . $_GET["song_id"] . ";";
	$result = $gs->askSQL($sql);
	$song =  mysql_fetch_assoc($result);
?>
<h1>Edit lyrics</h1>
<form id="songToAdd" action="<?php echo htmlspecialchars($_SERVER["manage.php?song_id=" . $_GET["song_id"]]);?>" method="POST" >
	<label for="utilisateur">Utilisateur</label>
	<input type="text" name="username"/><br>
	<label for="password">Mot de passe</label>
	<input type="password" name="password"/><br>
	<br>
	<label for="titleText">Titre anglais</label>
	<input type="text" name="titleText" value="<?php echo $song["titleSongs"]; ?>"><br>
	<label for="titleOrText">Titre orignal</label>
	<input type="text" id="title0" name="titleOrText" value="<?php echo $song["titleOriginalSongs"]; ?>"><br>
	<label for="albumText">Numéro de l'album</label>
	<input type="text" name="albumText" value="<?php echo $song["albumIdSongs"]; ?>"><br>
	<hr>
	<?php
		$sql = "SELECT * FROM Lyrics WHERE idSongsLyrics=" . $_GET["song_id"] . ";";
		$result = $gs->askSQL($sql);

		while ($row =  mysql_fetch_assoc($result)) {
			echo "<label for='langCode" . $row["idLyrics"] . "'>Code de langue</label>";
			echo "<input type='text' name='langCode" . $row["idLyrics"] . "' value='" . $row["langLyrics"] . "'><br>";
			echo "<label for='lyric" . $row["idLyrics"] . "'>Paroles</label>";
			echo "<textarea type='text' id='lyric" . $row["idLyrics"] . "' name='inputText" . $row["idLyrics"] . "'>" . str_replace("<br>", "\n", $row["contentLyrics"]) . "</textarea><br>";
		}
	?>
	<!-- Hidden input field to indicate form submission -->
	<input type="hidden" id="formSubmitted" name="formSubmitted" value="0">

	<!-- Your submit button -->
	<button type="submit" onclick="setFormSubmitted()">Submit</button>
</form>

<script>
	function setFormSubmitted() {
		// Set the value of the hidden input field to 1 indicating form submission
		document.getElementById("formSubmitted").value = "1";
	}
</script>
<!--<button onclick="createInput()">Click me</button>


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
</script>-->

<script src="./res/js/edit.js"></script>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['formSubmitted']) && $_POST['formSubmitted'] == "1") {
		$sql = "UPDATE Songs SET titleSongs='"
		. $gs->sanitize($_POST["titleText"])
		. "', titleOriginalSongs='"
		. $gs->sanitize($_POST["titleOrText"])
		. "', albumIdSongs="
		. $gs->sanitize($_POST["albumText"])
		. " "
		. "WHERE idSongs="
		. $_GET["song_id"]
		. ";";

		$sql_get_lyrics = "SELECT idLyrics FROM Lyrics WHERE idSongsLyrics=" . $_GET["song_id"] . ";";
		$result_get_lyrics = $gs->askSQL($sql_get_lyrics, $_POST["username"], $_POST["password"]);

		while ($row =  mysql_fetch_assoc($result_get_lyrics)) {
			$sqlLyrics = "UPDATE Lyrics SET contentLyrics='" . $gs->sanitize($_POST["inputText" . $row["idLyrics"]]) . "', "
				. "langLyrics='" . $gs->sanitize($_POST["langCode" . $row["idLyrics"]]) . "' "
				. "WHERE idLyrics=" . $row["idLyrics"] . ";";
			$dummy2 = $gs->askSQL($sqlLyrics, $_POST["username"], $_POST["password"]);
		}

		$dummy2 = $gs->askSQL($sql, $_POST["username"], $_POST["password"]);

		echo "done!";
	}
?>

<script src="./res/js/edit.js">
