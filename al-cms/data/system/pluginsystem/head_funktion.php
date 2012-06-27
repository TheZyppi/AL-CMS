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
// Es wird überprüft ob oben oder in der Funktion eine Plugin FunktionsID angegeben wurde
if (isset($_GET['plf'])=="" || $_GET['plf']=="") {
echo "Es wurde keine Plugin Funktion angegeben.";
mysql_close();
exit;	
}
else {
$hpl=$_GET['hpl'];
$plf=$_GET['plf'];
db_con();
if (preg_match ("/^([0-9]+)$/",$hpl)) {
		$sql = "SELECT HPLID, name, data, sysp, aktiv FROM head_plugins WHERE HPLID= ".mysql_real_escape_string($hpl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
      $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	  $hplid=$reihe['HPLID'];
}
else {
	$sql = "SELECT HPLID, name, data, sysp, aktiv FROM head_plugins WHERE name = '".mysql_real_escape_string($hpl)."'";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   $hplid=$reihe['HPLID'];	
}
	if (preg_match ("/^([0-9]+)$/",$plf)) {
$sql = "SELECT PLFID, funktionsname, data, nf, aktiv FROM plugin_funktion WHERE PLFID = ".mysql_real_escape_string($plf)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   if ($plf==$reihe['PLFID'])
   {
   	$sql3 = "SELECT PLFID, HPLID FROM head_plugin_funktion WHERE PLFID = ".mysql_real_escape_string($plf)." AND HPLID=".mysql_real_escape_string($hplid)." LIMIT 1";
   $ergebnis3 = mysql_query($sql3);
   $reihe3 = mysql_fetch_array($ergebnis3, MYSQL_ASSOC);
   if ($reihe3['PLFID']!=$plf && $reihe3['HPLID']!=$hpl || ! $ergebnis3)
   {
   	echo "Die Funktion wurde keinem Head Plugin zugeweisen.";	
 }
else {
$sql2 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rights WHERE PLFID=".mysql_real_escape_string($plf)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC); 	
}
   }
else {
	echo "Keine Funktion mit der ID gefunden.";
	exit;
}
	}
	else {
$sql = "SELECT PLFID, funktionsname, data, nf, aktiv FROM plugin_funktion WHERE funktionsname = '".mysql_real_escape_string($plf)."'LIMIT 1";
   $ergebnis = mysql_query($sql);
     $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   if ($plf==$reihe['funktionsname'])
   {
   		$sql3 = "SELECT HPLID, PLFID FROM head_plugin_funktion WHERE PLFID = ".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
   $ergebnis3 = mysql_query($sql3);
   $reihe3 = mysql_fetch_array($ergebnis3, MYSQL_ASSOC);
   if ($reihe3['PLFID']!=$plf && $reihe3['HPLID']!=$hpl || ! $ergebnis3)
   {
   	echo "Die Funktion wurde keinem Head Plugin zugeweisen.";	
 }
else {	
$sql2 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rights WHERE PLFID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   }
   }
else {
	echo "Keine Funktion mit diesem Namen gefunden.";
	exit;
}
	}
// Prüfung ob das Plugin aktiv ist

if ($reihe['aktiv']==1) {
	// Prüfung ob die Gruppe das Plugin ausführen darf
	$sqlg = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rights WHERE PLFID=".mysql_real_escape_string($reihe['PLFID'])." AND GID=".$group."";
	$ergebnisg = mysql_query($sqlg);
	$reiheg = mysql_fetch_array($ergebnisg, MYSQL_ASSOC);
	if(! $ergebnisg || $reiheg['GID']!=$group)
	{
	echo "Auf ihre Gruppe wurde keine Berechtigung gesetzt.";
		mysql_close();
		exit;
	}
else
{
	if($reiheg['Y_N']==1) {
		// Überprüft ob es ein Systemplugin ist oder nicht
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
		if ($reihep['sysp']==1)
		{
		// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['data']=="")
		{
			echo "Funktionsdatei konnte nicht geladen werden.";
		}
		else {
			if($reihe['nf']==1)
			{
		include_once(''.$srdp.'system/'.$reihe['data'].''); // Funktionsdatei wird reingeladen
		}
			else {
		include_once(''.$srdp.'system/'.$reihe['data'].'');
		$reihe['funktionsname']($srdp);
			}
		}	
		}
		else {
	
		// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['data']=="")
		{
			echo "Funktionsdatei konnte nicht geladen werden.";
		}
		else {
			if($reihe['nf']==1)
			{
				include_once(''.$srdp.'plugins/'.$reihe['data'].'');
			}
		else {
		include_once(''.$srdp.'plugins/'.$reihe['data'].''); // Funktionsdatei wird reingeladen
		$reihe['funktionsname']($srdp); // Funktion wird ausgeführt
		}
		}
		}
		}
		else {
			// Wenn die Gruppe es nicht benutzen darf
			echo "Ihre Gruppe hat nicht die Berechtigung diese Funktion zu Benutzen.";
			mysql_close();
			exit;
			}	
		}
	}
	else {
	// Wenn es nicht aktiv ist
	mysql_close();
	exit;	
		}
		}	
mysql_close();
}
?>