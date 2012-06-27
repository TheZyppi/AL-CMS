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
// Wichtige Daten werden aus der URL und Session ausgelesen
$group=$_SESSION['group'];
// Die Datei zum Datenbank Connecten wird reingeladen

// Es wird nachgeguckt ob eine PluginID angegeben wurde.
if (isset($_GET['hpl'])=="" || $_GET['hpl']=="" || $_GET['hpl']==false) {
// Wenn kein Plugin anegeben wurde

// Verbindung zur Datenbank wird aufgebaut in dem die Funktion db_con aufgerufen wird.
	db_con();
	// Abfrage um herauszufinden was das Standart Plugin ist.
	$splugin="SELECT * FROM al_config WHERE CID='3'";
	$ergebnis = mysql_query($splugin);
   	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	if ($reihe['funktion']=="" || $ergebnis==false || $reihe==false)
	{
		echo "Sie haben kein Standart-Plugin angegeben.";
		mysql_close();
		exit;
	}
	else {
	$spluginl = "SELECT * FROM head_plugins WHERE HPLID=".mysql_real_escape_string($reihe['funktion'])." LIMIT 1";
   	$ergebnis2 = mysql_query($spluginl);
   	$reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	if ($reihe['funktion']==$reihe2['HPLID'])
	{
	include (''.$srdp.'plugins/'.$reihe2['data'].'');
	}
	else {
		echo "Dieses Plugin Exestiert nicht.";
		mysql_close();
		exit;
	}
	}
}
else {
$hpl=$_GET['hpl'];
db_con();
	if (preg_match ("/^([0-9]+)$/",$hpl)) {
		$sql = "SELECT HPLID, name, data, sysp, aktiv FROM head_plugins WHERE HPLID= ".mysql_real_escape_string($hpl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);   
	  // Überprüfung ob es das Plugin überhaupt gibt	
   if(!$ergebnis || $reihe['HPLID']!=$hpl)
   {
   	echo "Kein Plugin mit der Angegeben ID gefunden.";
	mysql_close();
	exit;
   }
   // Wenn es das Plugin nicht gibt wird ein Fehler ausgegeben
else {
$sql2 = "SELECT HPLID, GID, Y_N FROM head_plugin_rights WHERE HPLID=".mysql_real_escape_string($hpl)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
$plid=$reihe['HPLID']; 
}

	}
	else {
$sql = "SELECT HPLID, name, data, sysp, aktiv FROM head_plugins WHERE name = '".mysql_real_escape_string($hpl)."'";
   $ergebnis = mysql_query($sql) or die (mysql_error());
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
    // Überprüfung ob es das Plugin überhaupt gibt
      if($hpl==$reihe['name'])
   {
$sql2 = "SELECT HPLID, GID, Y_N FROM head_plugin_rights WHERE HPLID=".mysql_real_escape_string($reihe['HPLID'])."";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
$plid=$reihe['HPLID'];
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
	// Abfrage ob für die Gruppe Berechtigung vergeben wurde das Plugin auszuführen
	$sqlg = "SELECT HPLID, GID, Y_N FROM head_plugin_rights WHERE HPLID=".mysql_real_escape_string($reihe['HPLID'])." AND GID=".$group."";
	$ergebnisg = mysql_query($sqlg);
	$reiheg = mysql_fetch_array($ergebnisg, MYSQL_ASSOC);
	// Überprüfung ob die Gruppe das Plugin ausführen darf
   if (!$ergebnisg || $ergebnisg==false || $reiheg['GID']!=$group)
   {
   	return "Auf ihre Gruppe wurde keine Berechtigung gesetzt.";
   }
   else {
   	// Prüfung ob die Gruppe das Plugin ausführen darf
	if($reiheg['Y_N']==1) {
		// Prüft ob eine Pluginfunktion angegeben wurde oder nicht
		if (isset($_GET['plf'])=="" && isset($_GET['lpl'])=="")
		{
			// Überprüft ob es ein Systemplugin ist oder nicht
			if ($reihe['sysp']==1)
			{
			// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['data']=="")
		{
			echo "Plugindatei konnte nicht geladen werden.";
		}
		else {
			if(file_exists(''.$srdp.'design/'.''.design::css_script().'/plugin/'.$reihe['data'].''))
			{
		 design::load_body_plugin(''.$srdp.'design/'.''.design::css_script().'/plugin/'.$reihe['data'].''); // Funktionsdatei wird reingeladen
			}
else {
	return "The File not exist.";
}
		$load_functions=mysql_query("SELECT head_plugin_funktion.HPLID, head_plugin_funktion.PLFID, head_plugin_funktion.load, plugin_funktion.PLFID, plugin_funktion.funktionsname, plugin_funktion.assagin, plugin_funktion.aktiv  FROM head_plugin_funktion, plugin_funktion WHERE head_plugin_funktion.HPLID='".$reihe['HPLID']."' AND head_plugin_funktion.load='1' AND head_plugin_funktion.PLFID=plugin_funktion.PLFID");
		if($load_functions==false || !$load_functions || mysql_num_rows($load_functions)==false)
		{
			return "No functions found!";
		}
		else {
			while($row=mysql_fetch_array($load_functions))
			{
				if($row['assign']=='1')
				{
			design::assign($row['funktionsname'], pluginsystem::funktionin($row['funktionsname']));	
				}
				else {
			design::assignEach($row['funktionsname'], pluginsystem::funktionin($row['funktionsname']));
				}
				}
		}
		}	
		}
		else {
		// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['data']=="")
		{
			echo "Plugindatei konnte nicht geladen werden.";
		}
		else {
		require_once(''.$srdp.'plugins/'.$reihe['data'].''); // Funktionsdatei wird reingeladen
		}
		}
		}
		// Wenn eine Plugin Funktion angeben wurde wird else ausgeführt
		else {
			
			if(isset($_GET['plf'])=="" && isset($_GET['lpl'])!="" && isset($_GET['hpl'])!="")
			{
			// Show the number or name from the Head Plugin Funktionsname
			$lpl=$_GET['lpl'];
			// The Under Group Plugin start now
			$this->lower_plugin($srdp);
			}
			else if(isset($_GET['lpl'])=="" && isset($_GET['plf'])!="" && isset($_GET['hpl'])!="")
			{
			// Show the number or name from the Head Plugin Funktionsname
			$plf=$_GET['plf'];
			// The Funktion from Head Plugin run now
			$this->head_funktion($srdp);
			}		
			else if($_GET['plf']!="" && $_GET['lpl']!="" && isset($_GET['hpl'])!="")
			{
				$plf=$_GET['plf'];
				$lpl=$_GET['lpl'];
				$this->lower_plugin($srdp);
			}
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