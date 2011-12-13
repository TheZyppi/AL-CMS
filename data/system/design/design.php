<?php
	// Die dbcon.php wird eingefügt
	include ('../../config/dbcon.php');
	// Die Funktion db_con wird ausgeführt
	db_con();
	// Abfrage welches Design aktiv ist
$sql = "SELECT DID, DDName, DDatei, aktiv FROM design WHERE aktive=1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
// Die Hauptdatei vom Design wird reingeladen
$pfad=$reihe['DDatei'];
include('".$pfad."/index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
// Die Body Funktion wird reingeladen sie dient dazu den Body anzuzeigen
include('body_function.php');
// Die Foot Funktion wird reingeladen sie dient dazu den Foot anzuzeigen
include('foot_function.php');
?>