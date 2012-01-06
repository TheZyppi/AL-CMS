<?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is a free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */

/* 
Diese Datei enthält 1 Funktion:

- Plugin_Funktion Aktiv/Rechte Checker

*/

// Wichtige Daten werden aus der URL und Session ausgelesen
$group=$_SESSION['gruppe'];

// Es wird überprüft ob oben oder in der Funktion eine Plugin FunktionsID angegeben wurde
if (isset($_GET['plf'])=="") {
echo "Es wurde keine Plugin Funktion angegeben.";
mysql_close();
exit;	
}
else {
$pl=$_GET['pl'];
$plf=$_GET['plf'];
db_con();
if (preg_match ("/^([0-9]+)$/",$pl)) {
		$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLID= ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
      $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	  $plid=$reihe['PLID'];
}
else {
	$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLName = '".mysql_real_escape_string($pl)."'";
   $ergebnis = mysql_query($sql) or die (mysql_error());
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   $plid=$reihe['PLID'];	
}
	if (preg_match ("/^([0-9]+)$/",$plf)) {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE PLFID = ".mysql_real_escape_string($plf)." AND PLID=".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rechte WHERE PLID=".mysql_real_escape_string($plf)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	}
	else {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE Funktionsname = '".mysql_real_escape_string($plf)."' AND PLID=".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rechte WHERE PLID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	}
// Prüfung ob das Plugin aktiv ist

if ($reihe['aktiv']==1) {
	// Prüfung ob die Gruppe das Plugin ausführen darf
if ($group==$reihe2['GID']) {
	if($reihe2['Y_N']==1) {
		// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['hdatei']=="")
		{
			echo "Funktionsdatei konnte nicht geladen werden.";
		}
		else {
		include(''.$rsdp.'plugins/'.$reihe['hdatei'].''); // Funktionsdatei wird reingeladen
		$reihe['Funktionsname'](); // Funktion wird ausgeführt
		}
		}
		else {
			// Wenn die Gruppe es nicht benutzen darf
			echo "Ihre Gruppe hat nicht die Berechtigung diese Funktion zu Benutzen.";
			mysql_close();
			exit;
			}	
	}
// Wenn keine Berechtigung vergeben wurde
	else {
		echo "Auf ihre Gruppe wurde keine Berechtigung gesetzt.";
		mysql_close();
		exit;
		}
	
	}
	else {
	// Wenn es nicht aktiv ist
	mysql_close();
	exit;	
		}
	
		}	
mysql_close();
?>