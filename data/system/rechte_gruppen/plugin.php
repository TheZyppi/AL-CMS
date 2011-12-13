<?php
/* 
Diese Datei enthält 1 Funktion:

- Plugin Aktiv/Rechte Checker

*/

// Wichtige Daten werden aus der URL und Session ausgelesen
$group=$user->data['GID'];

include ('../../../config/dbcon.php');

// Es wird nachgeguckt ob eine PluginID angegeben wurde.
if ($pl=="") {
echo "Es wurde keine Plugin Angegeben.";
exit;
}
else {	
db_con_sn();
	if (preg_match ("/^([0-9]+)$/",$pl)) {
		$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLID= ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLID, GID, Y_N FROM rechte_plugins WHERE PLID=".mysql_real_escape_string($pl)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
$plid=$reihe['PLID'];
	}
	else {
$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLName = ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLID, GID, Y_N FROM rechte_plugins WHERE PLID=".mysql_real_escape_string($reihe['PLID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
$plid=$reihe['PLID'];
	}
// Prüfung ob das Plugin aktiv ist

if ($reihe['aktiv']==1) {
	// Prüfung ob die Gruppe das Plugin ausführen darf
if ($group==$reihe2['GID']) {
	if($reihe2['Y_N']==1) {
		include($reihe['datei']);
		}
		else {
			echo "Sie duerfen das Plugin nicht benutzen!";
			exit;
			}	
	}
	else {
		echo "Um dieses Plugin nutzen zu können bitte einloggen!";
		exit;
		}
	
	}
	else {
		echo "Plugin ist deaktiviert";
		exit;
		}
		}


?>