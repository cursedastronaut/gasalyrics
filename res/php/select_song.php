<!--Selection of Songs-->
<form id="songToAdd" action="manage.php?" method="POST" >
    <label for="songs">Choose a song</label>
	<select id="songs" name="songs">
		<?php
			include_once("connection.php");
			$gs = new GasaLyricsDB();

            //No need to check if album_id is null as this page is only included if it is.
			$sql = "SELECT idSongs, titleSongs FROM Songs WHERE albumIdSongs=" . $_GET["album_id"] . ";";
			$result = $gs->askSQL($sql);
			while ($row =  mysql_fetch_assoc($result)) {
				echo "<option value='song_" . $row["idSongs"] . "'>" . $row["idSongs"] . ". " . $row["titleSongs"] . "</option>";
			}
		?>
	</select>
	<input type="submit" onclick="updateAction();">
</form>

<script>
    function updateAction() {
        var selectElement = document.getElementById("songs");
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var value = selectedOption.value;

        // Extract the number from the value
        var match = value.match(/\d+/); // Match one or more digits
        var songId = match ? match[0] : ""; // Extract the first matched number, if any

        document.getElementById("songToAdd").action = "manage.php?song_id=" + songId;
    }
</script>
