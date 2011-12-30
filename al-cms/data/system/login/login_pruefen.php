<?php
function login_pruefen() {
session_start(); // Zum Starten der Session
if( (isset($_SESSION['benutzer'])) AND (!empty($_SESSION['benutzer'])) )
{
	include('../../config/dbcon.php'); // Fügt die Datei dbcon.php hinzu
   // Benutzername vorhanden; $_SESSION['login'] prüfen
   $be=$_SESSION['benutzer']; // Holt aus der aktuellen Session den Benutzername
	db_con(); // Führt die Funktion db_con aus
   $sql = "SELECT Session_ID, IP_Adresse FROM Benutzer WHERE Username = \"".$be."\" LIMIT 1"; // Fragt den Datensatz vom Benutzer X ab
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
    $ipadresse =$_SERVER['REMOTE_ADDR'];// Fragt die aktuelle IP-Adresse des Benutzers ab
   if( (isset($_SESSION['login'])) AND ($_SESSION['login'] == true ) AND ($reihe['Session_ID']==session_id()) AND ($reihe['IP_Adresse']==$ipadresse))
   {
      // Man ist eingeloggt. Nun muss man eigentlich nichts machen.
   }
   else
   {
      // Kein Loginstatus in der Session abgespeichert. Daher ist man nicht eingeloggt.
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