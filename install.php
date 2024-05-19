<!--
	GASALYRICS INSTALLATION SCRIPT
	Check version in 'res/php/config.php'.
	By @cursedastronaut on GitHub.

	Indentation is using tabs with a size
	equivalent to 4 spaces.
-->

<!--Quick and dirty style, this file shall not call anything else than 'res/php/config.php'.-->
<style>
	file {
		background-color:	black;
		color:				white;
	}
	success {
		color:				green;
		background-color:	black;
	}
</style>


<?php //Installation script
	require_once("res/php/config.php"); //Main configuration file.
	require("res/php/version.php");
	
	//Attempt connecting to the database with res/php/config.php's logins.
	$db =	mysql_connect(GASALYRICS_URL, GASALYRICS_DBUSERNAME, GASALYRICS_DBPASSWORD)
			or die("<b>FATAL:</b>Could not connect to the database, make sure <file>res/php/config.php</file> is correct.");
	
	//Attempting to select res/php/config.php's provided database.
	mysql_select_db(GASALYRICS_DBNAME, $db) or
	die("<b>FATAL:</b>The provided database name in res/php/config.php,"
		. "for value GASALYRICS_DBNAME"
		. "\"" . GASALYRICS_DBNAME . "\" is incorrect or cannot be reached." . mysql_close());
	
	//UTF-8 characters (There should be no SELECT statement, but just in case.)
	mysql_query("SET NAMES 'utf8';")							or die('FATAL: <br>'. mysql_error() . mysql_close());
	mysql_query("SET CHARACTER SET 'utf8';")					or die('FATAL: <br>'.$sql_utf8.'<br>'.mysql_error() . mysql_close());
	mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'")	or die("Cannot set UTF8 encoding. Exiting." . mysql_close());

	//All required tables.
	$tables = array('Album', 'Languages', 'Lyrics', 'Songs', 'Symlink');
	$tableAlreadyExist = false;
	
	//Checking if the tables listed above already exist.
	foreach ($tables as $table) {
		$sql = "SHOW TABLES LIKE '$table'";
		$result = mysql_query($sql);
		if (!$result) {
			mysql_close();
			die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
		}
		$num_rows = mysql_num_rows($result);
		if ($num_rows != 0) {
			echo "<b>FATAL:</b>Table $table exists.<br>";
			if (!$tableAlreadyExist)
				$tableAlreadyExist = true;
		}
	}

	//If one of the required table already exists in the database, we stop. Cannot proceed and overwrite user data!
	if ($tableAlreadyExist) {
		mysql_close();
		die("<b>FATAL:</b> Some tables GasaLyrics would create already exist.");
	}

	//If used pressed the "Proceed with the installation" button.
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$sqlCreation = file_get_contents("res/sql/creation.sql");
		$sqlStatements = explode(";", $sqlCreation);
		
		$sqlError = "<b>FATAL:</b> Could not create a required table. You will need to DROP the tables this script already created after fixing this.<br><b>SQL Error:</b>";
		$sqlLanguagesInsert = file_get_contents("res/sql/languages.sql");

		//Untested! Please execute manually the content of res/sql/creation.sql if it causes a problem.
		// Loop through each SQL statement
		foreach ($sqlStatements as $sql) {
			// Trim any leading or trailing whitespace
			$sql = trim($sql);
			// Check if the statement is not empty
			if (!empty($sql)) {
				// Execute the SQL statement
				mysql_query($sql) or die($sqlError . mysql_error() . "<br><br><b>SQL:</b>" . $sql . mysql_close());
			}
		}
		
		// Split the SQL statements by ';'
		$sqlStatements = explode(';', $sqlLanguagesInsert);
		// Execute each SQL statement
		foreach ($sqlStatements as $sqlStatement) {
			// Trim any whitespace or new lines
			$sqlStatement = trim($sqlStatement);
			
			// Check if the statement is not empty
			if (!empty($sqlStatement)) {
				mysql_query($sqlStatement) or die($sqlStatement . mysql_error() . "<br><br><b>SQL:</b>" . $sqlStatement . mysql_close());
			}
		}
		mysql_close(); //Rest.

		echo	"<br><success>SUCCESS:</success>Successfully created all tables.<br>"
				. "Installation is now complete. Please proceed to <a href='add_album.php'>the Add Album page</a><br>"
				. "to add an album.<br>"
				. "To add a song, go to the <a href='add.php'>Add Song page</a>.<br>"
				. "To edit a song, go to the <a href='manage.php>Manage Songs page</a>.<br>"
				;

		exit();
	} else { //If the user hasn't pressed the "Proceed with the installation" button.
		mysql_close();
		echo "All checks passed. You can proceed with the installation<br>";
	}

?>

<!--HTML part-->
<form id="songToAdd" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >
	<label for="username">Database Username</label>
	<input type="text" name="username"><br>
	<label for="password">Database Password</label>
	<input type="password" name="password"><br>
	<p style="font-size:smaller">
		Those are required to verify you are the person who edited <file>config.php</file>.
		Please enter the same logins as in <file>config.php</file>.
	</p>
	<br>
	<button type="submit">Proceed with the installation of GasaLyrics <?php echo GASALYRICS_VERSION; ?>.</button>
</form>
<h2>Details</h2>
<p>
	Here is what the installation script should do:<br>
	<ul>
		<li>Create table 'Album'</li> 
		<li>Create table 'Languages'</li> 
		<li>Create table 'Lyrics'</li> 
		<li>Create table 'Songs'</li> 
		<li>Create table 'Symlink'</li>
	</ul>
	<br>
	<b>How to add songs?</b>
	<p>Go to <file>add.php</file> after installation.</p>
	<b>How to edit songs?</b>
	<p>Go to <file>manage.php</file> after installation.</p>
</p>