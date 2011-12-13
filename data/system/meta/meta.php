<?php
$pl=$_GET['pl'];
include('../config/dbcon.php');
db_con();
if ($pl=="") {
	// Wenn nichts angegeben wird auch nichts ausgegeben
}
else {
	// Es wird überprüft ob Buchstaben enthalten sind oder nicht da man auch Plugins per Name aktiviren kann
if (preg_match ("/^([0-9]+)$/",$pl)) {
$meta="SELECT MAID, plid, mdatei FROM meta WHERE plid=".mysql_real_escape_string($pl)." LIMITED 1";
$ergebnis = mysql_query($meta);
$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
// Die Meta Daten Datei vom Plugin wird reingeladen
$reihe['mdatei'];
}
else {
$plugin="SELECT * FROM plugin WHERE PLName=".mysql_real_escape_string($pl)." LIMITED 1";
$ergebnis2 = mysql_query($plugin);
$reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
$meta="SELECT MAID, plid, mdatei FROM meta WHERE plid=".mysql_real_escape_string($reihe2['PLID'])." LIMITED 1";
$ergebnis = mysql_query($meta);
$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
// Die Meta Daten Datei vom Plugin wird reingeladen
$reihe['mdatei'];
}
}
?>