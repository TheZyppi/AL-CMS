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

/*
 * Standart-CSS Include Datei eines jeden Designs
 * 
 * Dient dazu die einzelnden CSS Datein für das Design bereitzustellen.
 * Es können soviele Datein hinzugefügt werden wie man möchte.
 * 
 * 
 */

// Datenbank Verbindung wird aufgebaut
db_con();
		// Abfrage welches Design aktiv ist
$sql = "SELECT DID, DName, DDatei, aktiv FROM design WHERE aktiv=1";
$ergebnis = mysql_query($sql);
$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC) or die (mysql_error());	
// Die Hauptdatei vom Design wird reingeladen
$pfad=$reihe['DDatei'];
 
 // Abfrage zum Design Pfad
$dp="SELECT * FROM al_config WHERE CID='4'";
	$ergebnis2 = mysql_query($dp);
   	$reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	$pfad2=$reihe2['funktion'];
	
echo'<link rel="stylesheet" title="Normal" href="'.$pfad2.''.$pfad.'css/seite.css" type="text/css">';
?>