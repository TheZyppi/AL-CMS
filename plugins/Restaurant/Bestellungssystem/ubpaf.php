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
  * Eintragen von den Benutzerdaten aus dem ubbf.php Formular. 
  */
 if (isset($_POST['tisch'])=="" && isset($_POST['raum'])=="" && isset($_POST['name'])=="" && isset($_POST['vorname'])=="" && isset($_POST['postleitzahl'])=="" && isset($_POST['ort'])=="")
 {
 	echo "Sie haben nichts angegeben.";	
 }
 else if (isset($_POST['name'])=="")
 {
 echo "Sie haben vergessen ihren Namen anzugeben.";	
 }
 else if (isset($_POST['vorname'])=="")
 {
 echo "Sie haben vergessen ihren Vornamen anzugeben.";	
 }
 else if (isset($_POST['postleitzahl'])=="")
 {
 echo "Sie haben vergessen ihre Postleitzahl anzugeben.";	
 }
 else if (isset($_POST['ort'])=="")
 {
 echo "Sie haben vergessen ihren Ort anzugeben.";	
 }
 else {
  if (isset($_POST['tisch'])=="") {
  	echo "Sie haben keinen Tisch ausgewählt.";
	exit; 
 }
 else {
     foreach($_POST['tisch'] as $tisch)
{
$eintrag="INSERT INTO reservierungen_tisch(RID, TID)
VALUES ('".$rid."', '".$tisch."')";
mysql_query($eintrag) or die (mysql_error());
}
 }
 
 // Eintragen des Raums
 if (isset($_POST['raum'])=="") {
     
 }
 else {
     foreach($_POST['raum'] as $raum)
{
$eintrag2="INSERT INTO reservierungen_raeume(RID, RAID)
VALUES ('".$rid."', '".$raum."')";
mysql_query($eintrag2) or die (mysql_error());
}
 }
 $paa="SELECT * FROM";
 }
?>