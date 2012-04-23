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
$sql = "SELECT PLFID, funktionsname, data, aktiv FROM plugin_funktion WHERE PLFID = ".mysql_real_escape_string($funktion)." LIMIT 1";
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
$sql = "SELECT PLFID, funktionsname, data, aktiv FROM plugin_funktion WHERE funktionsname = '".mysql_real_escape_string($funktion)."' LIMIT 1";
   $ergebnis = mysql_query($sql);
     $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   if ($funktion==$reihe['funktionsname'])
   {	
$sql2 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rights WHERE PLFID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   }
else {
	echo "Error: No function found with this name!";
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
	if($h_or_l='h')
	{
	if (preg_match ("/^([0-9]+)$/",$head_plugin))
		{
	$sqlp = "SELECT HPLID, PLFID FROM head_plugin_funktion WHERE HPLID= ".mysql_real_escape_string($head_plugin)." LIMIT 1";
   	$ergebnisp = mysql_query($sqlp);
   	$headrow = mysql_fetch_array($ergebnisp, MYSQL_ASSOC);
	if($headrow['HPLID']!=$head_plugin)
	{
		echo "Error: No HPLID found!";
		exit;
	}
		else {
	if (preg_match ("/^([0-9]+)$/",$funktion))
	{
		$plha=mysql_query("SELECT HPLID, PLFID FROM head_plugin_funktion WHERE HPLID='".mysql_real_escape_string($headrow['HPLID'])."' AND PLFID='".mysql_real_escape_string($funktion)."'");
		$plhaa=mysql_fetch_array($plha);
		if($plhaa['PLID']!=$funktion)
		{
			echo "Error: The Plugin Funktion is not the Funktion for the Head Plugin.";
			exit;
		}
	}
	else {
		$plhan=mysql_query("SELECT PLFID, funktionsname FROM plugin_funktion WHERE funktionsname='".mysql_real_escape_string($funktion)."'") or die(mysql_error());
	$plhaan=mysql_fetch_array($plhan);
	$plha=mysql_query("SELECT HPLID, PLFID FROM head_plugin_funktion WHERE HPLID='".mysql_real_escape_string($headrow['HPLID'])."' AND PLFID='".mysql_real_escape_string($plhaan['PLFID'])."'");
		$plhaa=mysql_fetch_array($plha);
			if($plhaan['PLFID']!=$plhaa['PLFID'])
		{
			echo "Error: The Plugin Funktion is not the Funktion for the Head Plugin.";
			exit;
		}
	}

	}
		}
else {
	$headq=mysql_query("SELECT HPLID, name, sysp FROM head_plugins WHERE name='".mysql_real_escape_string($head_plugin)."'");
	$reihep=mysql_fetch_array($headq);
		$sqlp = "SELECT HPLID, PLFID FROM head_plugin_funktion WHERE HPLID= ".mysql_real_escape_string($reihep['HPLID'])." LIMIT 1";
   $ergebnisp = mysql_query($sqlp);
      $headrow = mysql_fetch_array($ergebnisp, MYSQL_ASSOC);
	   	if($reihep['name']!=$head_plugin)
	{
		echo "Error no Head Plugin Name found!";
		exit;
	}
		else {
	if (preg_match ("/^([0-9]+)$/",$funktion))
	{
		$plha=mysql_query("SELECT HPLID, PLFID FROM head_plugin_funktion WHERE HPLID='".mysql_real_escape_string($headrow['HPLID'])."' AND 'PLFID=".mysql_real_escape_string($funktion)."'");
		$plhaa=mysql_fetch_array($plha);
		if($plhaa['PLID']!=$funktion)
		{
			echo "Error: The Plugin Funktion is not the Funktion for the Head Plugin.";
			exit;
		}
	}
	else {
		$plhan=mysql_query("SELECT PLFID, funktionsname FROM plugin_funktion WHERE funktionsname='".mysql_real_escape_string($funktion)."'");
	$plhaan=mysql_fetch_array($plhan);
	$plha=mysql_query("SELECT HPLID, PLFID FROM head_plugin_funktion WHERE HPLID='".mysql_real_escape_string($headrow['HPLID'])."' AND PLFID='".mysql_real_escape_string($plhaan['PLFID'])."'");
		$plhaa=mysql_fetch_array($plha);
			if($plhaan['PLFID']!=$plhaa['PLFID'])
		{
			echo "Error: The Plugin Funktion is not the Funktion for the Head Plugin.";
			exit;
		}
	}

	}
}		
	}
	else {
	
	if (preg_match ("/^([0-9]+)$/",$lower_plugin))
		{
	$lowerlp = "SELECT LPLID, PLFID FROM lower_plugin_funktion WHERE LPLID= ".mysql_real_escape_string($lower_plugin)." LIMIT 1";
   	$ergebnislower = mysql_query($lowerlp);
   	$reihelower = mysql_fetch_array($ergebnislower, MYSQL_ASSOC);
		if($reihelower['LPLID']!=$lower_plugin)
		{
			echo "Error: No Lower Plugin with this ID found!";
		}
		}
else {
	$lowerq=mysql_query("SELECT LPLID FROM lower_plugin WHERE name='".mysql_real_escape_string($lower_plugin)."'");
	$lowerrow=mysql_fetch_array($lowerq);
		$lowerlp = "SELECT LPLID, PLFID FROM lower_plugin_funktion WHERE LPLID= ".mysql_real_escape_string($lowerrow['LPLID'])." LIMIT 1";
   $ergebnislower = mysql_query($lowerlp);
      $reihelower = mysql_fetch_array($ergebnislower, MYSQL_ASSOC);
      if($lowerrow['name']!=$lower_plugin)
	  {
	  	echo "No Lower Plugin with this name found!";
	  }
}
$l_ha=mysql_query("SELECT HPLID, LPLID FROM head_plugin_lower_plugin WHERE LPLID='".mysql_real_escape_string($reihelower['LPLID'])."'");
$l_har=mysql_fetch_array($l_ha);
	$headq=mysql_query("SELECT HPLID, sysp FROM head_plugins WHERE name='".mysql_real_escape_string($l_har['HPLID'])."'") or die (mysql_error());
	$reihep=mysql_fetch_array($headq);
		$sqlp = "SELECT HPLID, PLFID FROM head_plugin_funktion WHERE HPLID= ".mysql_real_escape_string($reihep['HPLID'])." LIMIT 1";
   $ergebnisp = mysql_query($sqlp);
      $headrow = mysql_fetch_array($ergebnisp, MYSQL_ASSOC);
		
	}
	if($reiheg['Y_N']==1) {
		// Überprüft ob es ein Systemplugin ist oder nicht
		
		if ($reihep['sysp']==1)
		{
		// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['data']=="")
		{
			echo "Funktionsdatei konnte nicht geladen werden.";
		}
		else {
		include(''.$srdp.'system/'.$reihe['data'].''); // Funktionsdatei wird reingeladen
		return $reihe['funktionsname']($srdp, $s); // Funktion wird ausgeführt
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
		return $reihe['funktionsname']($srdp, $s); // Funktion wird ausgeführt
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