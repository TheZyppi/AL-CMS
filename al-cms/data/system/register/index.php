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
if (!defined('ON_ALCMS') || isset($_SESSION['group'])=="")
{
	echo "Error: You are not use ALCMS!";
	exit;
}
else {
function register()
{
$absenden = ( isset($_POST['absenden']) ) ? true : false;
if( $absenden )
{
	$b=$_POST['benutzer'];
	$a="SELECT username FROM user WHERE username='".$b."'";
	   $ergebnis = mysql_query($a);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
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
	
	else if ($b==$reihe['username'])
	{
		echo "Dieser Benutzer exestiert bereits"; 
	}
	else {
include('passgen.php');
  db_con();
  $passsalt=generatePW(18); // Normal Salt
  $passsaltc=sha1(strtoupper($passsalt)); // Salt Gecryptet
  $passn=$_POST['passwort']; // Passwort Normal
  $passnc=sha1(strtoupper($passn)); //Passwort Gecryptet
  $passall="$passnc $passsaltc"; // Passwort in SHA1 und SALT in SHA1 werden zusammengefügt
  $pass=sha1($passall); //Hier werden die beiden SHA1 gecrypteten Passwörter nochmals zusammen SHA1 gecryptet
  $timenow=time(); // Time Now
// Hier wird nun der Benutzer Eingetragen und der entstandene SHA1 Wert der aus dem Gecrypteten Passwort + Salt besteht wird nun hier eingetragen + der ungecryptete Salt Wert  
  $eintragen = "INSERT INTO user (GID, username, passwort, passwort_salt, time_reg) 
    VALUES ('2', '". $_POST['benutzer']."', '". $pass."', '".$passsalt."', '".$timenow."')"; 

$ausgabe="<center>Erfolg!</center>";

mysql_query($eintragen) or die (mysql_error());

echo $ausgabe;
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
<title>Regestrieren</title>
</head>
<body>
<h1>Regestrieren</h1>
Bitte gib deinen Benutzernamen und dein Passwort ein.<br />
<form action="index.php?hpl=1&plf=register" method="post">
<strong>Benutzername:</strong> <input type="text" name="benutzer" /><br />
<strong>Passwort:</strong> <input type="password" name="passwort" /><br />
<strong>Passwort Wiederholen:</strong> <input type="password" name="passwort2" /><br />
<input type="submit" name="absenden" value="Regestrieren" />
</form>
</body>
</html>
<?php

}
}
}
?>