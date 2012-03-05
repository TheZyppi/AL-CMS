<?php
$configd='
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
$user="'.$usera.'"; //Benutzername
$pass="'.$passa.'"; //Passwort
$db="'.$dba.'"; //Datenbank
$adresse="'.$ada.'"; //Adresse
mysql_connect($adresse, $user, $pass); // Verbindung aufbauen
mysql_select_db($db); // Datenbank wählen	
	}
?>
'; // Dateiinhalt
$dname = "../data/config/dbcon.php"; // Name der Datei
// Datei öffnen,
// wenn nicht vorhanden dann wird die Datei erstellt.
$ow = fOpen($dname , "a+");
if (! $ow)
{
echo "Please but this in the file (/data/config/dbcon.php)<p>";
echo  '<textarea cols=70 rows=35>'.$text.'</textarea>';
}
else {
// Dateiinhalt in die Datei schreiben
$write=fWrite($ow , $configd);
if (! $write)
{
echo "Please but this in the file (/data/config/dbcon.php)<p>";
echo  '<textarea cols=70 rows=35>'.$text.'</textarea>';
}
else {
fClose($ow); // Datei schließen
echo "<font color=green>Config ready!</font>";
echo '<form method="post" action="'; print $_SERVER['PHP_SELF']; echo'">';
	echo '
		<input type="submit" value="Go" name="installdb">
		</form>
';

}
}
?> 