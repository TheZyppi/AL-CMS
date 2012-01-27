<?php
function logout()
{
	
	  // Benutzer will sich ausloggen
   session_start(); // Zu löschende Session starten
   // Löschen aller Session-Daten
   $_SESSION = array(); // Auf ein leeres Array setzen
   // Wenn die Session-ID über Cookies gespeichert wurden, Cookies löschen
   if( isset($_COOKIE[session_name()]) )
   {
      setCookie(session_name(), "", time()-42000, "/");
   }
   session_destroy();
   die("Du wurdest ausgeloggt."); 
   
}

?>