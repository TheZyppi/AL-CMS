<?php
// Die dbcon.php wird eingefügt
db_con();
// Abfrage welches Design aktiv ist
$sql = "SELECT DID, DName, DDatei, aktiv FROM design WHERE aktiv=1";
$ergebnis = mysql_query($sql);
$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC) or die (mysql_error());	
// Die Hauptdatei vom Design wird reingeladen
$pfad=$reihe['DDatei'];
include(''.$srdp.'design/'.$pfad.'index.php');
$test2=$srdp;
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');

?>