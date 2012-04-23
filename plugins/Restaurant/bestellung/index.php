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

 // Index Datei vom Bestellungssystem
 
// Data-Right-Security-Open-Check
if (!defined('ON_ALCMS') || isset($_SESSION['group'])=="")
{
	echo "Error: You are not use ALCMS!";
	exit;
}
else {
// Gruppen ID wird von der Session geladen
$group=$_SESSION['group'];
// Abfrage ob der Benutzer eingeloggt ist oder nicht.
// Abfrage ob die Gruppe vom Benutzer das darf oder nicht.
$sql = "SELECT PLFID, funktionsname, data, aktiv FROM plugin_funktion WHERE funktionsname = 'uuser_aktiv' LIMIT 1";
$ergebnis = mysql_query($sql);
$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rights WHERE PLFID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);

// Wenn der Benutzer nicht regestriert ist wird das UFormular gelanden (Unregister Formular)
	if ($group==1)
	{
		// Überprüft ob das Unregestriert Bestellungsformular aktiviert ist.
		if($reihe2['Y_N']==1)
		{
	include('ubf.php');
		}
		else {
			echo "Unregestrierte Benutzung des Bestellsystems ist deaktiviert.";
		}
	}
// Wenn der User eingeloggt ist dann wird das RFormular gelanden (Register Formular)
	else {
include('rbf.php');
 }
 }
?>