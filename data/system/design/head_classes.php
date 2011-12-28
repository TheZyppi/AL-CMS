<?php

/*
 * Headclasses.php
 * Dient dazu um die Obesreten HTML und eitenstruktur aufzubauen.
 */
 // Title + Meta System werden reingeladen

	class headp {

// Title System vom Head und dem Rechte Gruppe System
	public function title()
	{
$pl=$_GET['pl']; // Plugin
$plf=$_GET['plf']; // Plugin Funktion

/* Es wird nachgeguckt ob eine PluginID angegeben wurde, da immer ein Plugin geladen werden muss.
 * Wenn dieses nicht gegeben ist wird das Standartplugin geladen was in den Einstellugen vordefiniert ist.
 */
if ($pl=="") {
// Wenn kein Plugin anegeben wurde

// Verbindung zur Datenbank wird aufgebaut in dem die Funktion db_con aufgerufen wird.
	db_con();
	// Abfrage um herauszufinden was das Standart Plugin ist.
	$splugin="SELECT * FROM al_config WHERE CID='3'";
	$ergebnis = mysql_query($splugin);
   	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	// Abfrage um den Titel des Standart Plugin zu laden
	$spluginl = "SELECT PLID, titled FROM plugins_title WHERE PLID=".mysql_real_escape_string($reihe['funktion'])." LIMIT 1";
   	$ergebnis2 = mysql_query($spluginl) or die (mysql_error());
   	$reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);	
	// Der Titel vom Standart Plugin wird angezeigt.
	include ($reihe2['titled']);
	exit;
}
else {	
// Wenn keine Plugin Funktion angegeben wurde
	if ($plf=="")
	{
		// Wenn keine Plugin Funktion angegeben wurde
		exit;
	}
	else {
		// Fragt den Status von Parents ab
			if (preg_match ("/^([0-9]+)$/",$plf)) {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE PLFID = ".mysql_real_escape_string($plf)." AND ".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
   // Schaut nach ob es diese Funktion überhaupt gibt
        if($plf==$reihe['PLFID'])
   {
$sql2 = "SELECT * FROM plugin_funktion_title WHERE PLID=".mysql_real_escape_string($plf)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   }
		else {
			echo "Keine Plugin Funktion gefunden.";
		}
	}
	else {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE Funktionsname = ".mysql_real_escape_string($plf)." AND ".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
      // Schaut nach ob es diese Funktion überhaupt gibt
        if($plf==$reihe['PLFID'])
   {
$sql2 = "SELECT * FROM plugin_funktion_title WHERE PLID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   }
		else {
			echo "Keine Plugin Funktion gefunden.";
		}
	}
		// Fragt ab ob die Funktion Parntsist oder nicht.
		if ($reihe['parent']==1) {
			include($reihe2['titled']);
		}
		// Wenn die Funktion kein Parent ist dann wird der Plugin Title genommen.
		else {
	// Überprüfung ob das Plugin als ID angegeben wurde oder als Name.
	if (preg_match ("/^([0-9]+)$/",$pl)) {
		$sql = "SELECT PLID, PLName, hdatei,  aktiv FROM plugins WHERE PLID= ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
    // Schaut nach ob es dieses Plugin überhaupt gibt
        if($pl==$reihe['PLID'])
   {
$sql2 = "SELECT PLID, titled FROM plugins_title WHERE PLID=".mysql_real_escape_string($pl)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   }
else {
	echo "Kein Plugin gefunden.";
}
   if ($reihe2['titled']=="")
   {
   // Wenn keine Title Datei angegeben wurde
   }
   else {
   include($reihe2['titled']);
   }
	}
	// Wenn keine PluginID angegebn wurde sondern stattdessen der Plugin Name
	else {
$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLName = ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
       // Schaut nach ob es dieses Plugin überhaupt gibt
        if($pl==$reihe['PLID'])
   {
$sql2 = "SELECT PLID, GID, Y_N FROM rechte_plugins WHERE PLID=".mysql_real_escape_string($reihe['PLID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   }
		else {
			echo "Kein Plugin gefunden.";
		}
     if ($reihe2['titled']=="")
   {
   // Wenn keine Title Datei angegeben wurde
   }
   else {
   include($reihe2['titled']);
   }
	}
		}
		
	}
		
}
	}
// Meta System vom Head und dem Rechte Gruppe System
	public function meta()
	{
$pl=$_GET['pl']; // Plugin
$plf=$_GET['plf']; // Plugin Funktion
include('data/config/dbcon.php');

if ($pl=="") {
	// Wenn kein Plugin anegeben wurde

// Verbindung zur Datenbank wird aufgebaut in dem die Funktion db_con aufgerufen wird.
	db_con();
	// Abfrage um herauszufinden was das Standart Plugin ist.
	$splugin="SELECT * FROM al_config WHERE CID='3'";
	$ergebnis = mysql_query($splugin);
   	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	// Abfrage um den Titel des Standart Plugin zu laden
	$spluginl = "SELECT PLID, metad FROM plugin_meta WHERE PLID=".mysql_real_escape_string($reihe['funktion'])." LIMIT 1";
   	$ergebnis2 = mysql_query($spluginl);
   	$reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);	
	// Der Meta vom Standart Plugin wird angezeigt.
	include ($reihe2['metad']);
	exit;
}
else {
	if ($plf=="")
	{
		// Wenn keine Plugin Funktion angegeben wurde
		exit;
	}
	else {
// Wenn keine Plugin Funktion angegeben wurde
	if ($plf=="")
	{
		// Wenn keine Plugin Funktion angegeben wurde
		exit;
	}
	else {
		// Fragt den Status von Parents ab
			if (preg_match ("/^([0-9]+)$/",$plf)) {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE PLFID = ".mysql_real_escape_string($plf)." AND ".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   // Schaut nach ob es diese Funktion überhaupt gibt
     if($plf==$reihe['PLFID'])
   {
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT * FROM plugin_funktion_meta WHERE PLID=".mysql_real_escape_string($plf)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   }
	 else {
	 	echo "Keine Plugin Funktion gefunden.";
	 }
	}
	else {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE Funktionsname = ".mysql_real_escape_string($plf)." AND ".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
    // Schaut nach ob es diese Funktion überhaupt gibt
     if($plf==$reihe['PLID'])
   {
$sql2 = "SELECT * FROM plugin_funktion_meta WHERE PLID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   }
	 else {
	 	echo "Keine Plugin Funktion gefunden.";
	 }
	}
		// Fragt ab ob die Funktion Parnt ist oder nicht.
		if ($reihe['parent']==1) {
			include($reihe2['metad']);
		}
		// Wenn die Funktion kein Parent ist dann wird der Plugin Meta genommen.
		else {
	// Überprüfung ob das Plugin als ID angegeben wurde oder als Name.
	if (preg_match ("/^([0-9]+)$/",$pl)) {
		$sql = "SELECT PLID, PLName, hdatei,  aktiv FROM plugins WHERE PLID= ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
 // Schaut nach ob es dieses Plugin überhaupt gibt
        if($pl==$reihe['PLID'])
   {
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLID, metad FROM plugin_meta WHERE PLID=".mysql_real_escape_string($pl)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   }
else {
	echo "Kein Plugin gefunden.";
}
   if ($reihe2['metad']=="")
   {
   // Wenn keine Meta Datei angegeben wurde
   }
   else {
   include($reihe2['metad']);
   }
	}
	// Wenn keine PluginID angegebn wurde sondern stattdessen der Plugin Name
	else {
$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLName = ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
    // Schaut nach ob es dieses Plugin überhaupt gibt
            if($pl==$reihe['PLID'])
   {
$sql2 = "SELECT * FROM plugin_meta WHERE PLID=".mysql_real_escape_string($reihe['PLID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   }
			else {
				echo "Kein Plugin gefunden.";
			}
     if ($reihe2['metad']=="")
   {
   // Wenn keine Meta Datei angegeben wurde
   }
   else {
   include($reihe2['metad']);
   }
	}
		}
		}
	}
}
	}
	public function css_script()
	{
		
		include (''.$pfad.'css/index.php');
	}
	
	}	

$objhead = new headp();

?>