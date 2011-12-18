<?php
$pl=$_GET['pl'];
include('../config/dbcon.php');

if ($pl=="") {
	// Wenn kein Plugin anegeben wurde

// Verbindung zur Datenbank wird aufgebaut in dem die Funktion db_con aufgerufen wird.
	db_con();
	// Abfrage um herauszufinden was das Standart Plugin ist.
	$splugin="SELECT * FROM al_config WHERE CID='3'";
	$ergebnis = mysql_query($splugin);
   	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	// Abfrage um den Titel des Standart Plugin zu laden
	$spluginl = "SELECT PLID, metad FROM plugin_meta WHERE PLID=".mysql_real_escape_string($reihe['funktion'])." LIMIT 1";
   	$ergebnis2 = mysql_query($spluginl);
   	$reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);	
	// Der Titel vom Standart Plugin wird angezeigt.
	include ($reihe2['metad']);
	exit;
}
else {
	if ($plf=="")
	{
		// Wenn keine Plugin Funktion angegeben wurde
		exit;
	}
	else {
// Wenn keine Plugin Funktion angegeben wurde
	if ($plf=="")
	{
		// Wenn keine Plugin Funktion angegeben wurde
		exit;
	}
	else {
		// Fragt den Status von Parents ab
			if (preg_match ("/^([0-9]+)$/",$plf)) {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE PLFID = ".mysql_real_escape_string($plf)." AND ".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT * FROM plugin_funktion_meta WHERE PLID=".mysql_real_escape_string($plf)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	}
	else {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE Funktionsname = ".mysql_real_escape_string($plf)." AND ".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT * FROM plugin_funktion_meta WHERE PLID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	}
		// Fragt ab ob die Funktion Parnt ist oder nicht.
		if ($reihe['parent']==1) {
			include($reihe2['metad']);
		}
		// Wenn die Funktion kein Parent ist dann wird der Plugin Meta genommen.
		else {
	// Überprüfung ob das Plugin als ID angegeben wurde oder als Name.
	if (preg_match ("/^([0-9]+)$/",$pl)) {
		$sql = "SELECT PLID, PLName, hdatei,  aktiv FROM plugins WHERE PLID= ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLID, metad FROM plugin_meta WHERE PLID=".mysql_real_escape_string($pl)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   if ($reihe2['metad']=="")
   {
   // Wenn keine Meta Datei angegeben wurde
   }
   else {
   include($reihe2['metad']);
   }
	}
	// Wenn keine PluginID angegebn wurde sondern stattdessen der Plugin Name
	else {
$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLName = ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT * FROM plugin_meta WHERE PLID=".mysql_real_escape_string($reihe['PLID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
     if ($reihe2['metad']=="")
   {
   // Wenn keine Meta Datei angegeben wurde
   }
   else {
   include($reihe2['metad']);
   }
	}
		}
		}
	}
}
?>