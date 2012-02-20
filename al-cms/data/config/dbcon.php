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

//Die Datei wird zum Verbinden mit dem MySQL-Server eingesetzt
// Verbindungsdaten zum MySQL-Server

// DB_CON Funktion dient dazu um sich mit dem MySQL-Server zu verbinden und zur Datenbank
function db_con() {
$user="root"; //Benutzername
$pass=""; //Passwort
$db="alcms3"; //Datenbank
$adresse="localhost"; //Adresse
mysql_connect($adresse, $user, $pass); // Verbindung aufbauen
mysql_select_db($db); // Datenbank wählen	
	}
?>