<?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is free software, you can you can redistribute it and/or modify
 *it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */


session_start();
$absenden = ( isset($_POST['absenden']) ) ? true : false;
if( $absenden )
{
	if($_POST['benutzer']=="") {
		echo "Es wurde noch kein Benutzername angegeben";
		exit;
		}
	else if($_POST['passwort']=="") {
		echo "Es wurde noch kein Passwort angegeben";
		exit;
		}
	else if($_POST['passwort']!=$_POST['passwort2']) {
		echo "Die Passwörter stimmen nicht überein!";
		exit;
		}
		
				
include('../../config/dbcon.php');
include('passgen.php');
  db_con();
  $passsalt=generatePW(18); // Normal Salt
  $passsaltc=sha1($passsalt); // Salt Gecryptet
  $passn=$_POST['passwort']; // Passwort Normal
  $passnc=sha1($passn); //Passwort Gecryptet
  $passall="$passnc $passsaltc"; // Passwort in SHA1 und SALT in SHA1 werden zusammengefügt
  $pass=sha1($passall); //Hier werden die beiden SHA1 gecrypteten Passwörter nochmals zusammen SHA1 gecryptet
// Hier wird nun der Benutzer Eingetragen und der entstandene SHA1 Wert der aus dem Gecrypteten Passwort + Salt besteht wird nun hier eingetragen + der ungecryptete Salt Wert  
  $eintragen = "INSERT INTO Benutzer (GID, Username, Passwort, Passwort_Salt) 
    VALUES ('2', '". $_POST['benutzer']."', '". $pass."', '".$passsalt."')"; 

$ausgabe="<center>Erfolg!</center>";

mysql_query($eintragen) or die ("Fehler beim Eintragen!");

echo $ausgabe;
}

if( !$absenden )
{
   // Der Benutzer hat nicht abgeschickt. Loginformular anzeigen.

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
          "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Regestrieren</title>
</head>
<body>
<h1>Regestrieren</h1>
Bitte gib deinen Benutzernamen und dein Passwort ein. (Groß- und Kleinschreibung beachten!)<br />
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
<strong>Benutzername:</strong> <input type="text" name="benutzer" /><br />
<strong>Passwort:</strong> <input type="password" name="passwort" /><br />
<strong>Passwort Wiederholen:</strong> <input type="password" name="passwort2" /><br />
<input type="submit" name="absenden" value="Regestrieren" />
</form>
</body>
</html>
<?php

}


?>