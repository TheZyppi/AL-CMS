<?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) 2011-2012 Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is a free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */

if (isset($_GET['pl'])=="") {
// Wenn kein Plugin anegeben wurde

// Verbindung zur Datenbank wird aufgebaut in dem die Funktion db_con aufgerufen wird.
	db_con();
	// Abfrage um herauszufinden was das Standart Plugin ist.
	$splugin="SELECT * FROM al_config WHERE CID='3'";
	$ergebnis = mysql_query($splugin);
   	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	// Abfrage um den Titel des Standart Plugin zu laden
	$spluginl = "SELECT PLID, titled FROM plugin_title WHERE PLID=".mysql_real_escape_string($reihe['funktion'])." LIMIT 1";
   	$ergebnis2 = mysql_query($spluginl) or die (mysql_error());
   	$reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);	
	// Der Titel vom Standart Plugin wird angezeigt.
	include (''.$rsp.'plugins/'.$reihe2['titled'].'');
	mysql_close();
	exit;
}
else {
$pl=$_GET['pl'];	
db_con();
	if (preg_match ("/^([0-9]+)$/",$pl)) {
		$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLID= ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
      $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	  // Überprüfung ob es das Plugin überhaupt gibt	
   if($pl==$reihe['PLID'])
   {
$spluginl = "SELECT PLID, titled FROM plugin_title WHERE PLID=".mysql_real_escape_string($pl)." LIMIT 1";
   	$ergebnis2 = mysql_query($spluginl) or die (mysql_error());
   	$reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	$plid=$reihe['PLID'];	
	   }
   // Wenn es das Plugin nicht gibt wird ein Fehler ausgegeben
else {
	echo "Kein Plugin mit der Angegeben ID gefunden.";
}

	}
	else {
$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLName = '".mysql_real_escape_string($pl)."'";
   $ergebnis = mysql_query($sql) or die (mysql_error());
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
    // Überprüfung ob es das Plugin überhaupt gibt
      if($pl==$reihe['PLName'])
   {
$spluginl = "SELECT PLID, titled FROM plugin_title WHERE PLID=".mysql_real_escape_string($reihe['PLID'])." LIMIT 1";
   	$ergebnis2 = mysql_query($spluginl) or die (mysql_error());
   	$reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	$plid=$reihe2['PLID'];	
   }
      // Wenn es das Plugin nicht gibt wird ein Fehler ausgegeben
   
	  else {
	  	echo "Kein Plugin mit dem angebenen Namen gefunden";
	  }
	}
	if (isset($_GET['plf'])=="")
		{
			include(''.$rsp.'plugins/'.$reihe2['titled'].'');
		}
		// Wenn eine Plugin Funktion angeben wurde wird else ausgeführt
		else {
			$plf=$_GET['plf'];
			if (preg_match ("/^([0-9]+)$/",$plf)) {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE PLFID = ".mysql_real_escape_string($plf)." AND PLID=".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT * FROM plugin_funktion_title WHERE PLFID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);

	}
	else {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE Funktionsname = '".mysql_real_escape_string($plf)."' AND PLID=".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT * FROM plugin_funktion_title WHERE PLFID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	}
	if ($reihe2['titled']=="")
		{
			echo "Title konnte nicht geladen werden.";
		}
		else {
		include(''.$rsp.'plugins/'.$reihe['titled'].''); // Funktionsdatei wird reingeladen
		}
		}
}
mysql_close();
?>