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

// Wichtige Daten werden aus der URL und Session ausgelesen
$group=$_SESSION['group'];
// Die Datei zum Datenbank Connecten wird reingeladen

// Es wird nachgeguckt ob eine PluginID angegeben wurde.
if (isset($_GET['lpl'])=="") {
	echo "Kein Unteres Plugin ausgewaehlt.";
}
else {
$lpl=$_GET['lpl'];
db_con();
	if (preg_match ("/^([0-9]+)$/",$lpl)) {
		$sql = "SELECT LPLID, name, data, aktiv FROM lower_plugins WHERE LPLID= ".mysql_real_escape_string($lpl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);   
	  // Überprüfung ob es das Plugin überhaupt gibt	
   if(! $ergebnis || $reihe['LPLID']!=$lpl)
   {
   	echo "Kein Plugin mit der Angegeben ID gefunden.";
	mysql_close();
	exit;
   }
   // Wenn es das Plugin nicht gibt wird ein Fehler ausgegeben
else {
$sql2 = "SELECT LPLID, GID, Y_N FROM lower_plugin_rights WHERE LPLID=".mysql_real_escape_string($lpl)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
$lpla=$reihe['LPLID']; 
}
	}
	else {
$sql = "SELECT LPLID, name, data, aktiv FROM lower_plugins WHERE name = '".mysql_real_escape_string($lpl)."'";
   $ergebnis = mysql_query($sql) or die (mysql_error());
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
    // Überprüfung ob es das Plugin überhaupt gibt
      if($lpl==$reihe['name'])
   {
$sql2 = "SELECT LPLID, GID, Y_N FROM lower_plugin_rights WHERE LPLID=".mysql_real_escape_string($reihe['LPLID'])."";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
$lpla=$reihe['LPLID'];
   }
      // Wenn es das Plugin nicht gibt wird ein Fehler ausgegeben
	  else {
	  	echo "Kein Lower-Plugin mit dem angebenen Namen gefunden";
	  	mysql_close();
	  	exit;
	  }
	}
	$hpl=$_GET['hpl'];
if (preg_match ("/^([0-9]+)$/",$hpl)) {
	$sqlh = "SELECT HPLID, name, data, sysp, aktiv FROM head_plugins WHERE HPLID= ".mysql_real_escape_string($hpl)." LIMIT 1";
   $ergebnish = mysql_query($sqlh);
	$reiheh = mysql_fetch_array($ergebnish, MYSQL_ASSOC);   
	$hpla=$reiheh['HPLID'];
	}
else {
$sqlh = "SELECT HPLID, name, data, sysp, aktiv FROM head_plugins WHERE name = '".mysql_real_escape_string($hpl)."'";
   $ergebnish = mysql_query($sqlh) or die (mysql_error());
   $reiheh = mysql_fetch_array($ergebnish, MYSQL_ASSOC);	
    $hpla=$reiheh['HPLID'];	
}
	$sqlhl = "SELECT LPLID, HPLID FROM head_plugin_lower_plugin WHERE LPLID=".mysql_real_escape_string($lpl)." AND HPLID=".mysql_real_escape_string($hpla)."";
	$ergebnishl = mysql_query($sqlhl);
	$reihehl = mysql_fetch_array($ergebnishl, MYSQL_ASSOC);
	if(! $ergebnishl || $reihehl['HPLID']!=$hpl || $reihehl['LPLID']!=$lpl)
	{
		echo "Die Head Plugin und Lower Plugin ID passen nicht zusammen.";
	}
	else {
// Prüfung ob das Plugin aktiv ist
if ($reihe['aktiv']==1) {
	// Abfrage ob für die Gruppe Berechtigung vergeben wurde das Plugin auszuführen
	$sqlg = "SELECT LPLID, GID, Y_N FROM lower_plugin_rights WHERE LPLID=".mysql_real_escape_string($lpla)." AND GID=".$group."";
	$ergebnisg = mysql_query($sqlg);
	$reiheg = mysql_fetch_array($ergebnisg, MYSQL_ASSOC);
	// Überprüfung ob die Gruppe das Plugin ausführen darf
   if (! $ergebnisg || $reiheg['GID']!=$group)
   {
   	echo "Auf ihre Gruppe wurde keine Berechtigung gesetzt.";
   	mysql_close();
	exit;
   }
   else {
   	// Prüfung ob die Gruppe das Plugin ausführen darf
	if($reiheg['Y_N']==1) {
		// Prüft ob eine Pluginfunktion angegeben wurde oder nicht
		if (isset($_GET['plf'])=="")
		{
			$hpl=$_GET['hpl'];
if (preg_match ("/^([0-9]+)$/",$hpl)) {
		$sqlp = "SELECT HPLID, name, data, sysp, aktiv FROM head_plugins WHERE HPLID= ".mysql_real_escape_string($hpl)." LIMIT 1";
   $ergebnisp = mysql_query($sqlp);
      $reihep = mysql_fetch_array($ergebnisp, MYSQL_ASSOC);
}
else {
	$sqlp = "SELECT HPLID, name, data, sysp, aktiv FROM head_plugins WHERE name = '".mysql_real_escape_string($hpl)."'";
   $ergebnisp = mysql_query($sqlp) or die (mysql_error());
   $reihep = mysql_fetch_array($ergebnisp, MYSQL_ASSOC);
}
			// Überprüft ob es ein Systemplugin ist oder nicht
			if ($reihep['sysp']==1)
			{
			// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['data']=="")
		{
			echo "Plugindatei konnte nicht geladen werden.";
		}
		else {
		include(''.$srdp.'system/'.$reihe['data'].''); // Funktionsdatei wird reingeladen
		}	
		}
		else {
		// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['data']=="")
		{
			echo "Plugindatei konnte nicht geladen werden.";
		}
		else {
		include(''.$srdp.'plugins/'.$reihe['data'].''); // Funktionsdatei wird reingeladen
		}
		}
		}
		// Wenn eine Plugin Funktion angeben wurde wird else ausgeführt
		else {
			// Show the number or name from the Head Plugin Funktionsname
			$plf=$_GET['plf'];
			// The Funktion from Head Plugin run now
			$this->lower_funktion($srdp);		
		}
		
		}
	// Wenn die Gruppe das Plugin nicht benutzen darf
		else {
			echo "Sie duerfen das Plugin nicht benutzen!";
			mysql_close();
			exit;
			}	
	}

	}
// Wenn das Plugin deaktiviert wurde.
	else {
		echo "Plugin ist deaktiviert";
		mysql_close();
		exit;
		}
		}
		}	
?>