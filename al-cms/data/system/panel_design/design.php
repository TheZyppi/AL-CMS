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

// Die dbcon.php wird eingefügt
db_con();
// Abfrage welches Design aktiv ist
$sql = "SELECT DID, DName, DDatei, aktiv FROM panel_design";
$ergebnis = mysql_query($sql);
$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC) or die (mysql_error());	

// Die Hauptdatei vom Design wird reingeladen
	if ($reihe['aktiv']==1)
	{
$pfad=$reihe['DDatei'];
include(''.$srdp.'panel_design/'.$pfad.'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
	}
	else {
		echo "Sie haben kein Standart Design angegeben.";
	}
?>