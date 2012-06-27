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
db_con();
$sql = "SELECT HPLID, aktiv FROM head_plugins WHERE HPLID='1' LIMIT 1";
	$ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);

$sql2 = "SELECT PLFID, funktionsname, data, aktiv FROM plugin_funktion WHERE PLFID='1' LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   
	$sql3 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rights WHERE PLFID='1'";
	$ergebnis3 = mysql_query($sql3);
   $reihe3 = mysql_fetch_array($ergebnis3, MYSQL_ASSOC);
   
   $group=$_SESSION['group'];
      $sql1 = "SELECT HPLID, GID, Y_N FROM head_plugin_rights WHERE HPLID='1' AND GID=".$group."";
   		$db_erg2 = mysql_query( $sql1);
		   $reihe1 = mysql_fetch_array($db_erg2, MYSQL_ASSOC);
		if ($reihe1['GID']!=$group || ! $db_erg2 )
		{	
  	echo "Sie haben keine Berechtigungen darauf bekommen.";
	echo $_SESSION['group'];
		}
		else 
		{
	if($reihe1['Y_N']==1)
	{

if ($reihe['aktiv']==0 && $reihe2['aktiv']==0)
{
if($reihe3['GID']==$group)
{
	if($reihe3['Y_N']==1)
	{
		echo "Sie sind im Offline Modus online.";
	$this->head_plugin($srdp);	
	}
	else {
		echo "Die Seite ist im Offline Modus, Sie sind nicht Berechtigt diese zu benutzen.";
	}
}
else {
	echo "Ihre Gruppe hat keine Berechtigungen fuer den Offline Modus erhalten.";
}
}
else {
$this->head_plugin($srdp);
}
	}
	else {
		echo "Sie sind nicht Berechtigt diese Seite zu benutzen.";
		echo $_SESSION['group'];
	}
}
}	
?>