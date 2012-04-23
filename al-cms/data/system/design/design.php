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

db_con();
$dv_a = "SELECT CID, name, funktion FROM al_config WHERE CID='5' LIMIT 1";
	$dv_q = mysql_query($dv_a);
   $row = mysql_fetch_array($dv_q, MYSQL_ASSOC);
   // Check the stade of Developmentsade or normale stade
if($row['funktion']=='1')
{
include('design_classes.php');
$sql2 = "SELECT PLFID, aktiv FROM plugin_funktion WHERE PLFID='5' LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
if (! $ergebnis2 || $reihe2['PLFID']!='5')
{
echo "Es wurde keine Mobile Funktion deklariert.";
mysql_close();
exit;	
}   
else {
   if($reihe2['aktiv']==1)
   {
   	// Mobile System wird geladen
   }
   else {
  $designsys->body_normal($srdp);
   }
}
}
else {
ini_set('display_errors', 'off');
include('design_classes.php');
$sql2 = "SELECT PLFID, aktiv FROM plugin_funktion WHERE PLFID='5' LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
if (! $ergebnis2 || $reihe2['PLFID']!='5')
{
echo "Es wurde keine Mobile Funktion deklariert.";
mysql_close();
exit;	
}   
else {
   if($reihe2['aktiv']==1)
   {
   	// Mobile System wird geladen
   }
   else {
  $designsys->body_normal($srdp);
   }
}	
}
?>