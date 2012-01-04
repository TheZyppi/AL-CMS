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
 * Headclasses.php
 * Dient dazu um die Oberste HTML Struktur aufzubauen.
 */

 // Title + Meta System werden reingeladen

	class headp {

// Title System vom Head und dem Rechte Gruppe System
	public function title($rsp)
	{
		include('title.php');	
	}
// Meta System vom Head und dem Rechte Gruppe System
	public function meta($rsp)
	{
		include('meta.php');
	}
// Public Funktion für das Laden der CSS Scripte
	public function css_script($rsp)
	{
		
		// Abfrage welches Design aktiv ist
$sql = "SELECT DID, DName, DDatei, aktiv FROM design WHERE aktiv=1";
$ergebnis = mysql_query($sql);
$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC) or die (mysql_error());	
// Die Hauptdatei vom Design wird reingeladen
$pfad=$reihe['DDatei'];

		include (''.$rsp.'design/'.$pfad.'css/index.php');
	}
	
	}	

$objhead = new headp();

?>