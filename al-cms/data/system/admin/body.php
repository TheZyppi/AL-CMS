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

 // Funktion Body_admin
 function body_admin(&$srdp)
 {
 	// Datein die Benötigt werden werden reingeladen
 	
 	// Gruppen ID wird von der Session geladen
 	$group=$_SESSION['gruppe'];
	// Abfrage ob der Benutzer eingeloggt ist oder nicht.
	if ($group==1)
	{
	echo "Bitte loggen Sie sich ein.";	
	}
	else {
		
	
 	// Abfrage ob die Gruppe vom Benutzer das darf oder nicht.
 	$dapu="SELECT PLID, GID, Y_N FROM rechte_plugins WHERE PLID='5'";
	$ergebnis = mysql_query($dapu);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   	
	// Fragt ab ob die Gruppe eingetragen ist für die Admin-Panel Nutzung
 	if ($group==$reihe['GID'])
	{
	// Fragt ab ob die Gruppe berechtigt ist das Admin-Panel zu benutzen
	if ($reihe['Y_N']==1)
	{
		
	}	
	else {
		echo "Sie sind nicht berechtigt das Admin-Panel zu benutzen.";
	}
	}
	else {
		echo "Ihre Gruppe hat keine Berechtigung darauf vergeben bekommen.";
	}
 }
 }
?>