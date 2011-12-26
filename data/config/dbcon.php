<?php
//Die Datei wird zum Verbinden mit dem MySQL-Server eingesetzt
// Verbindungsdaten zum MySQL-Server

// Standart-URLs die wärend der Installation automatisch ausgefüllt werden
$surl="http://127.0.0.1/restaurant-cms-p/al-cms/"; // Standart-URL zum CMS
$scurl="http://127.0.0.1/restaurant-cms-p/al-cms/data/config/"; // Standart-URL zur Config-DB-Connector

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