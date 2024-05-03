<!--Selection of Album-->
<form id="songToAdd" action="manage.php?" method="POST" >
    <label for="albums">Choose an album</label>
	<select id="albums" name="albums">
		<?php
			include_once("connection.php");
			$gs = new GasaLyricsDB();

			$sql = "SELECT idAlbum, titleAlbum FROM Album;";
			$result = $gs->askSQL($sql);
			while ($row =  mysql_fetch_assoc($result)) {
				echo "<option value='album_" . $row["idAlbum"] . "'>" . $row["titleAlbum"] . "</option>";
			}
		?>
	</select>
	<input type="submit" onclick="updateAction();">
</form>

<script>
	function updateAction() {
		var selectElement = document.getElementById("albums");
		var selectedOption = selectElement.options[selectElement.selectedIndex];
		var lastCharacter = selectedOption.value.slice(-1);
		document.getElementById("songToAdd").action = "manage.php?album_id=" + lastCharacter;
	}
</script>
