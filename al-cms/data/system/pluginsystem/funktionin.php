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
if (isset($funktion)=="" || $funktion=="" || $funktion=='no')
{
	echo "Sie haben keine Funktion angegeben.";
}
else {
	 $group=$_SESSION['group'];
	db_con();
if (preg_match ("/^([0-9]+)$/",$funktion)) {
$sql = "SELECT PLFID, PLID, funktionsname, data, aktiv FROM plugin_funktion WHERE PLFID = ".mysql_real_escape_string($funktion)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   if ($funktion==$reihe['PLFID'])
   {	
$sql2 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rights WHERE PLFID=".mysql_real_escape_string($funktion)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   }
else {
	echo "Keine Funktion mit der ID gefunden.";
	exit;
}
	}
	else {
$sql = "SELECT PLFID, PLID, funktionsname, data, aktiv FROM plugin_funktion WHERE funktionsname = '".mysql_real_escape_string($funktion)."' LIMIT 1";
   $ergebnis = mysql_query($sql);
     $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   if ($funktion==$reihe['funktionsname'])
   {	
$sql2 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rights WHERE PLFID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
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
		$sqlp = "SELECT PLID, name, data, sysp, aktiv FROM plugins WHERE PLID= ".mysql_real_escape_string($reihe['PLID'])." LIMIT 1";
   $ergebnisp = mysql_query($sqlp);
      $reihep = mysql_fetch_array($ergebnisp, MYSQL_ASSOC);

		if ($reihep['sysp']==1)
		{
		// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['data']=="")
		{
			echo "Funktionsdatei konnte nicht geladen werden.";
		}
		else {
		include(''.$srdp.'system/'.$reihe['data'].''); // Funktionsdatei wird reingeladen
		$reihe['funktionsname']($srdp); // Funktion wird ausgeführt
		}	
		}
		else {
	
		// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['data']=="")
		{
			echo "Funktionsdatei konnte nicht geladen werden.";
		}
		else {
		include(''.$srdp.'plugins/'.$reihe['data'].''); // Funktionsdatei wird reingeladen
		$reihe['funktionsname']($srdp); // Funktion wird ausgeführt
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
}
?>