<?php
/* 
Diese Datei enthält 1 Funktion:

- Plugin Aktiv/Rechte Checker

*/
// Wichtige Daten werden aus der URL und Session ausgelesen
$group=$_SESSION['gruppe'];
// Die Datei zum Datenbank Connecten wird reingeladen

// Es wird nachgeguckt ob eine PluginID angegeben wurde.
if (isset($_GET['pl'])=="") {
// Wenn kein Plugin anegeben wurde

// Verbindung zur Datenbank wird aufgebaut in dem die Funktion db_con aufgerufen wird.
	db_con();
	// Abfrage um herauszufinden was das Standart Plugin ist.
	$splugin="SELECT * FROM al_config WHERE CID='3'";
	$ergebnis = mysql_query($splugin);
   	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	// Abfrage um den Titel des Standart Plugin zu laden
	$spluginl = "SELECT * FROM plugins WHERE PLID=".mysql_real_escape_string($reihe['funktion'])." LIMIT 1";
   	$ergebnis2 = mysql_query($spluginl);
   	$reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);	
	// Der Titel vom Standart Plugin wird angezeigt.
	include (''.$srdp.'plugins/'.$reihe2['hdatei'].'');
	exit;
}
else {
$pl=$_GET['pl'];	
db_con();
	if (preg_match ("/^([0-9]+)$/",$pl)) {
		$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLID= ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
      $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	  // Überprüfung ob es das Plugin überhaupt gibt	
   if($pl==$reihe['PLID'])
   {
$sql2 = "SELECT PLID, GID, Y_N FROM rechte_plugins WHERE PLID=".mysql_real_escape_string($pl)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
$plid=$reihe['PLID'];   	
   }
   // Wenn es das Plugin nicht gibt wird ein Fehler ausgegeben
else {
	echo "Kein Plugin mit dem angebenen Namen gefunden";
}

	}
	else {
$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLName = ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
    // Überprüfung ob es das Plugin überhaupt gibt
      if($pl==$reihe['PLID'])
   {
$sql2 = "SELECT PLID, GID, Y_N FROM rechte_plugins WHERE PLID=".mysql_real_escape_string($reihe['PLID'])."";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
$plid=$reihe['PLID'];
   }
      // Wenn es das Plugin nicht gibt wird ein Fehler ausgegeben
   
	  else {
	  	echo "Kein Plugin mit der Angegeben ID gefunden.";
	  }
	}
// Prüfung ob das Plugin aktiv ist
if ($reihe['aktiv']==1) {
	// Prüfung ob die Gruppe das Plugin ausführen darf
if ($group==$reihe2['GID']) {
	if($reihe2['Y_N']==1) {
		// Prüft ob eine Pluginfunktion angegeben wurde oder nicht
		if (isset($_GET['plf'])=="")
		{
			include(''.$srdp.'plugins/'.$reihe['hdatei'].'');
		}
		// Wenn eine Plugin Funktion angeben wurde wird else ausgeführt
		else {
			// Ruft aus der URL die Pluginfunktion auf
			$plf=$_GET['plf'];
			// Das Plugin Funktionssystem wird ausgeführt
			$this->funktion($srdp);
		}
		
		}
	// Wenn die Gruppe das Plugin nicht benutzen darf
		else {
			echo "Sie duerfen das Plugin nicht benutzen!";
			exit;
			}	
	}
// Wenn keine Gruppe angegeben wurde
	else {
		echo "Um dieses Plugin nutzen zu können bitte einloggen!";
		exit;
		}
	
	}
// Wenn das Plugin deaktiviert wurde.
	else {
		echo "Plugin ist deaktiviert";
		exit;
		}
		}


?>