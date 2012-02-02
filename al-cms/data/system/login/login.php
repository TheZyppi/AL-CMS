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

function login()
{

// Benutzer und Passwort aus POST-Request holen...
$benutzer = ( isset($_POST['benutzer']) ) ? $_POST['benutzer'] : '';
// Hat der Benutzer abgeschickt?
$absenden = ( isset($_POST['absenden']) ) ? true : false;

if( $absenden )
{
  db_con(); // Führt die Funktion db_con aus
   $sql = "SELECT UID, Username, GID, Passwort, Passwort_Salt FROM benutzer WHERE Username = \"".$benutzer."\" LIMIT 1"; // Fragt den Datensatz vom Benutzer X ab
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC) or die (mysql_error());
   $passsalt=$reihe['Passwort_Salt']; // Passwort wird aus der Datenbank geholt
  $passsaltc=sha1($passsalt); // Salt Gecryptet
  $passn=$_POST['passwort']; // Passwort Normal
  $passnc=sha1($passn); //Passwort Gecryptet
  $passall="$passnc $passsaltc"; // Passwort in SHA1 und SALT in SHA1 werden zusammengefügt
   $passwort = ( isset($_POST['passwort']) ) ? sha1($passall) : ''; //Hier werden die beiden SHA1 gecrypteten Passwörter nochmals zusammen SHA1 gecryptet
   if( $reihe['Passwort'] == $passwort ) // Schaut nach ob das Passwort auch mit dem Eingegebenden überinstimmt
   {
      session_regenerate_id(); // Generiert aus Sicherheitsgründen eine neue Session
      $ses=session_id(); // Fragt die aktuelle Session ID des Benutzers ab
      $ipadresse =$_SERVER['REMOTE_ADDR']; // Fragt die aktuelle IP-Adresse des Benutzers ab
      $_SESSION['benutzer'] = $benutzer; // Trage Benutzer in die Session ein
      $_SESSION['login'] = true; // Trage Login-Status ein
      $_SESSION['gruppe'] = $reihe['GID']; // Die Gruppen ID wird in die Session abgespeichert
      $_SESSION['uid'] = $reihe['UID']; // BenutzerID wird in der Session abgespeichert
      
        db_con();
       $sql1 = "UPDATE benutzer SET Session_ID='$ses', IP_Adresse='$ipadresse' WHERE Username = '$benutzer' LIMIT 1";
      $ergebnis=mysql_query($sql1);
      // Wichtig ist, dass die Eintragungen in die Session vor der Ausgabe stattfinden.
      // Mit der ersten Ausgabe werden die Header bereits gesendet und können dann nicht mehr
      // verändert werden.
      $eingeloggt = true;
      die("Du wurdest erfolgreich eingeloggt.");
   }
   else
   {
      die("Falsches Passwort");
   }
}

if( !$absenden )
{
   // Der Benutzer hat nicht abgeschickt. Loginformular anzeigen.

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
          "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Login</title>
</head>
<body>
<h1>Login</h1>
<?php
echo $_SESSION['gruppe'];
echo "<p>";
?>
Bitte gib deinen Benutzernamen und dein Passwort ein. (Groß- und Kleinschreibung beachten!)<br />
<form action="index.php?pl=1&plf=login" method="post">
<strong>Benutzername:</strong> <input type="text" name="benutzer" /><br />
<strong>Passwort:</strong> <input type="password" name="passwort" /><br />
<input type="submit" name="absenden" value="Login" />
</form>
</body>
</html>
<?php

}
}
?>