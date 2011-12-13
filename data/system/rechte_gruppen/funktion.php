<?php
/* 
Diese Datei enthält 1 Funktion:

- Plugin_Funktion Aktiv/Rechte Checker

*/

// Wichtige Daten werden aus der URL und Session ausgelesen
$group=$user->data['group_id'];

include ('../../../config/dbcon.php');

// Es wird überprüft ob oben oder in der Funktion eine Plugin FunktionsID angegeben wurde
if ($plf=="") {
echo "Es wurde keine Plugin Funktion angegeben.";
exit;	
}
else {
db_con();
	if (preg_match ("/^([0-9]+)$/",$plf)) {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE PLFID = ".mysql_real_escape_string($plf)." AND ".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLFID, group_id, Y_N FROM plugin_funktion_rechte WHERE PLID=".mysql_real_escape_string($plf)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	}
	else {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE Funktionsname = ".mysql_real_escape_string($plf)." AND ".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLFID, group_id, Y_N FROM plugin_funktion_rechte WHERE PLID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	}
// Prüfung ob das Plugin aktiv ist

if ($reihe['aktiv']==1) {
	// Prüfung ob die Gruppe das Plugin ausführen darf
if ($group==$reihe2['group_id']) {
	if($reihe2['Y_N']==1) {
		// Es wird geguckt ob eine Funktionsdatei vorhanden ist.
		if ($reihe['datei']=="")
		{
			echo "Funktionsdatei konnte nicht geladen werden.";
		}
		else {
		include($reihe['datei']); // Funktionsdatei wird reingeladen
		$reihe['Funktionsname'](); // Funktion wird ausgeführt
		}
		}
		else {
			// Wenn die Gruppe es nicht benutzen darf
			exit;
			}	
	}
	else {
		echo "Sie duerfen die Funktion nicht benutzen.";
		exit;
		}
	
	}
	else {
	// Wenn es nicht aktiv ist
	exit;	
		}
	
		}	

?>