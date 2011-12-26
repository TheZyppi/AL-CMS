<?php

function head() {
$sql = "SELECT DID, DName, DDatei, aktiv FROM design WHERE aktiv=1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
include('head_main.php');
head_main(); // head_main Funktion wird ausgeführt
	}
?>