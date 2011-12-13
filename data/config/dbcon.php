<?php
//Die Datei wird zum Verbinden mit dem MySQL-Server eingesetzt

function db_con() {
include('configs.php');
mysql_connect($adresse, $user, $pass); // Verbindung aufbauen
mysql_select_db($db); // Datenbank wählen	
	}

?>