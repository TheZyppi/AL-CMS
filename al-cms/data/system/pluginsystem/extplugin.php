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
// Data-Right-Security-Open-Check
if (!defined('ON_ALCMS') || isset($_SESSION['group'])=="")
{
	echo "Error: You are not use ALCMS!";
	exit;
}
else {
 $group=$_SESSION['gruppe'];
// Die Datei zum Datenbank Connecten wird reingeladen

// Es wird nachgeguckt ob eine PluginID angegeben wurde.
if ($plugin==0) {
// Wenn kein Plugin anegeben wurde
	echo "Sie haben kein Plugin angegeben.";
	exit;
}
else {
$pl=$plugin;
db_con();
	if (preg_match ("/^([0-9]+)$/",$pl)) {
		$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLID= ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
      $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	  // Überprüfung ob es das Plugin überhaupt gibt	
   if($pl==$reihe['PLID'])
   {
$sql2 = "SELECT PLID, GID, Y_N FROM rechte_plugins WHERE PLID=".mysql_real_escape_string($pl)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
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
$sql2 = "SELECT PLID, GID, Y_N FROM rechte_plugins WHERE PLID=".mysql_real_escape_string($reihe['PLID'])."";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
$plid=$reihe['PLID'];
   }
      // Wenn es das Plugin nicht gibt wird ein Fehler ausgegeben
   
	  else {
	  	echo "Kein Plugin mit dem angebenen Namen gefunden";
	  }
	}
// Prüfung ob das Plugin aktiv ist
if ($reihe['aktiv']==1) {
	// Prüfung ob die Gruppe das Plugin ausführen darf
if ($group==$reihe2['GID']) {
	if($reihe2['Y_N']==1) {
		// Prüft ob eine Pluginfunktion angegeben wurde oder nicht
		if (isset($_GET['plf'])=="")
		{
			include(''.$srdp.'plugins/'.$reihe['hdatei'].'');
		}
		// Wenn eine Plugin Funktion angeben wurde wird else ausgeführt
		else {
			// Ruft aus der URL die Pluginfunktion auf
			$plf=$_GET['plf'];
			// Das Plugin Funktionssystem wird ausgeführt
			$this->funktion($srdp);
		}
		
		}
	// Wenn die Gruppe das Plugin nicht benutzen darf
		else {
			echo "Sie duerfen das Plugin nicht benutzen!";
			mysql_close();
			exit;
			}	
	}
// Wenn keine Gruppe angegeben wurde
	else {
		echo "Auf ihre Gruppe wurde keine Berechtigung gesetzt.";
		mysql_close();
		exit;
		}
	
	}
// Wenn das Plugin deaktiviert wurde.
	else {
		echo "Plugin ist deaktiviert";
		mysql_close();
		exit;
		}
		return $plugin;
		}
		}
?>