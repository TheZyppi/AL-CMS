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


function login_pruefen() {
session_start(); // Zum Starten der Session
if( (isset($_SESSION['benutzer'])) AND (!empty($_SESSION['benutzer'])) )
{
	include('../../config/dbcon.php'); // Fügt die Datei dbcon.php hinzu
   // Benutzername vorhanden; $_SESSION['login'] prüfen
   $be=$_SESSION['benutzer']; // Holt aus der aktuellen Session den Benutzername
	db_con(); // Führt die Funktion db_con aus
   $sql = "SELECT GID, Session_ID, IP_Adresse FROM Benutzer WHERE Username = \"".$be."\" LIMIT 1"; // Fragt den Datensatz vom Benutzer X ab
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   if ($be==$reihe['Username'])
   {
    $ipadresse =$_SERVER['REMOTE_ADDR'];// Fragt die aktuelle IP-Adresse des Benutzers ab
   if( (isset($_SESSION['login'])) AND ($_SESSION['login'] == true ) AND ($reihe['Session_ID']==session_id()) AND ($reihe['IP_Adresse']==$ipadresse))
   {
   $gid=$_SESSION['gruppe'];
   	if ($gid==$reihe['GID'])
	{
	// Man ist eingeloggt. Nun muss man eigentlich nichts machen.	
	}
	else {
		session_start(); // Zu löschende Session starten
   // Löschen aller Session-Daten
   $_SESSION = array(); // Auf ein leeres Array setzen
   // Wenn die Session-ID über Cookies gespeichert wurden, Cookies löschen
   if( isset($_COOKIE[session_name()]) )
   {
      setCookie(session_name(), "", time()-42000, "/");
   }
   session_destroy();
    session_start();
    $_SESSION['gruppe'] = 1;
	}
   }
   else
   {
      // Kein Loginstatus in der Session abgespeichert. Daher ist man nicht eingeloggt.
$_SESSION['gruppe'] = 1;
   }
   }
   else {
   session_start(); // Zu löschende Session starten
   // Löschen aller Session-Daten
   $_SESSION = array(); // Auf ein leeres Array setzen
   // Wenn die Session-ID über Cookies gespeichert wurden, Cookies löschen
   if( isset($_COOKIE[session_name()]) )
   {
      setCookie(session_name(), "", time()-42000, "/");
   }
   session_destroy();
    session_start();
    $_SESSION['gruppe'] = 1;
   }

   }
else
{
   // Kein Benutzername in der Session abgespeichert. Daher ist man nicht eingeloggt.
$_SESSION['gruppe'] = 1;
}
}
?>