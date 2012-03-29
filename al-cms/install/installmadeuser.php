<?php
include('../data/config/dbcon.php');
db_con();
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

include('passgen.php');
  $passsalt=generatePW(18); // Normal Salt
  $passsaltc=sha1(strtoupper($passsalt)); // Salt Gecryptet
  $passn=$_POST['passwort']; // Passwort Normal
  $passnc=sha1(strtoupper($passn)); //Passwort Gecryptet
  $passall="$passnc $passsaltc"; // Passwort in SHA1 und SALT in SHA1 werden zusammengefügt
  $pass=sha1($passall); //Hier werden die beiden SHA1 gecrypteten Passwörter nochmals zusammen SHA1 gecryptet
  $timenow=time(); // Time Nowesteht wird nun hier eingetragen + der ungecryptete Salt Wert  
 $eintragen = "INSERT INTO user (GID, username, passwort, passwort_salt, time_reg) 
    VALUES ('4', '". $_POST['benutzer']."', '". $pass."', '".$passsalt."', '".$timenow."')"; 

$ausgabe="<center>Your AL-CMS is now ready to use!</center>";

mysql_query($eintragen) or die (mysql_error());

echo $ausgabe;


?>