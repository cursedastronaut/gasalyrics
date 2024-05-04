<?php
header('Content-type: text/html; charset=utf-8');
echo('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> ');
include_once("res/php/config.php");
$db = mysql_connect(GASALYRICS_URL, GASALYRICS_DBUSERNAME, GASALYRICS_DBPASSWORD) or die("erreur de connexion au serveur");
//mysql_set_charset("utf8");
mysql_select_db(GASALYRICS_DBNAME, $db);
$sql = "SET NAMES 'utf8';";
$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

$sql ="SET CHARACTER SET 'utf8';";
$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

//$sql ="SET SESSION collation_connection = 'latin1_general_ci';";
//$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'") or die("fuck.");

$sql = "INSERT INTO TemporaryTest ( test ) VALUES ('내나라');";
$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$sql = "SELECT * FROM TemporaryTest";
$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
mysql_close();
$row = mysql_fetch_assoc($result);
echo $row["test"] . "<br>";
?>