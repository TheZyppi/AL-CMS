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
$group=$_SESSION['gruppe'];
// Die Datei zum Datenbank Connecten wird reingeladen

// Es wird nachgeguckt ob eine PluginID angegeben wurde.
if (isset($_GET['pl'])=="" || $_GET['pl']=="") {
// Wenn kein Plugin anegeben wurde

// Verbindung zur Datenbank wird aufgebaut in dem die Funktion db_con aufgerufen wird.
	db_con();
	// Abfrage um herauszufinden was das Standart Plugin ist.
	$splugin="SELECT * FROM al_config WHERE CID='3'";
	$ergebnis = mysql_query($splugin);
   	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	if ($reihe['funktion']=="")
	{
		echo "Sie haben kein Standart-Plugin angegeben.";
		mysql_close();
		exit;
	}
	else {
	$spluginl = "SELECT * FROM plugins WHERE PLID=".mysql_real_escape_string($reihe['funktion'])." LIMIT 1";
   	$ergebnis2 = mysql_query($spluginl);
   	$reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	if ($reihe['funktion']==$reihe2['PLID'])
	{
	include (''.$srdp.'plugins/'.$reihe2['hdatei'].'');
	mysql_close();
	exit;
	}
	else {
		echo "Dieses Plugin Exestiert nicht.";
		mysql_close();
		exit;
	}
	}
}
else {
$pl=$_GET['pl'];
db_con();
	if (preg_match ("/^([0-9]+)$/",$pl)) {
		$sql = "SELECT PLID, PLName, hdatei, sysp, aktiv FROM plugins WHERE PLID= ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   
	  // Überprüfung ob es das Plugin überhaupt gibt	
   if(! $ergebnis)
   {
   	echo "Kein Plugin mit der Angegeben ID gefunden.";
	mysql_close();
	exit;
   }
   // Wenn es das Plugin nicht gibt wird ein Fehler ausgegeben
else {
	  	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
$sql2 = "SELECT PLID, GID, Y_N FROM rechte_plugins WHERE PLID=".mysql_real_escape_string($pl)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
$plid=$reihe['PLID']; 
}

	}
	else {
$sql = "SELECT PLID, PLName, hdatei, sysp, aktiv FROM plugins WHERE PLName = '".mysql_real_escape_string($pl)."'";
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
	  	mysql_close();
	  	exit;
	  }
	}
// Prüfung ob das Plugin aktiv ist
if ($reihe['aktiv']==1) {
	// Prüfung ob die Gruppe das Plugin ausführen darf
	$sqlg = "SELECT PLID, GID, Y_N FROM rechte_plugins WHERE PLID=".mysql_real_escape_string($reihe['PLID'])." AND GID=".$group."";
	$ergebnisg = mysql_query($sqlg);
	$reiheg = mysql_fetch_array($ergebnisg, MYSQL_ASSOC);
   if (! $ergebnisg || $reiheg['GID']!=$group)
   {
   	echo "Auf ihre Gruppe wurde keine Berechtigung gesetzt.";
   	mysql_close();
	exit;
   }
   else {
	if($reiheg['Y_N']==1) {
		// Prüft ob eine Pluginfunktion angegeben wurde oder nicht
		if (isset($_GET['plf'])=="")
		{
			// Überprüft ob es ein Systemplugin ist oder nicht
			if ($reihe['sysp']==1)
			{
			// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['hdatei']=="")
		{
			echo "Plugindatei konnte nicht geladen werden.";
		}
		else {
		include(''.$srdp.'system/'.$reihe['hdatei'].''); // Funktionsdatei wird reingeladen
		}	
		}
		else {
	
		// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['hdatei']=="")
		{
			echo "Plugindatei konnte nicht geladen werden.";
		}
		else {
		include(''.$srdp.'plugins/'.$reihe['hdatei'].''); // Funktionsdatei wird reingeladen
		}
		}
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

	}
// Wenn das Plugin deaktiviert wurde.
	else {
		echo "Plugin ist deaktiviert";
		mysql_close();
		exit;
		}
		}
		
?>