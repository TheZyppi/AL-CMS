<?php
//Die Datei wird zum Verbinden mit dem MySQL-Server eingesetzt
// Verbindungsdaten zum MySQL-Server

// DB_CON Funktion dient dazu um sich mit dem MySQL-Server zu verbinden und zur Datenbank
function db_con() {
$user="root"; //Benutzername
$pass=""; //Passwort
$db="restaurantcms"; //Datenbank
$adresse="localhost"; //Adresse
mysql_connect($adresse, $user, $pass); // Verbindung aufbauen
mysql_select_db($db); // Datenbank wählen	
	}
?>