<?php
$group=$user->data['group_id'];

include ('../../../config/dbcon.php');

// Es wird nachgeguckt ob eine PluginID angegeben wurde.
if ($pl=="") {
// Wenn kein Plugin anegeben wurde
exit;
}
else {	
db_con();
	if (preg_match ("/^([0-9]+)$/",$pl)) {
		$sql = "SELECT PLID, PLName, hdatei,  aktiv FROM plugins WHERE PLID= ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLID, titled FROM plugins_title WHERE PLID=".mysql_real_escape_string($pl)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
   if ($reihe2['titled']=="")
   {
   // Wenn keuine Title Datei angegeben wurde
   }
   else {
   include($reihe2['titled']);
   }
	}
	else {
$sql = "SELECT PLID, PLName, hdatei, aktiv FROM plugins WHERE PLName = ".mysql_real_escape_string($pl)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLID, GID, Y_N FROM rechte_plugins WHERE PLID=".mysql_real_escape_string($reihe['PLID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
     if ($reihe2['titled']=="")
   {
   // Wenn keuine Title Datei angegeben wurde
   }
   else {
   include($reihe2['titled']);
   }
	}
}
if ($plf=="") {
// Wenn kein Plugin Funktion agegeben wurde
exit;
}
else {
	
	if (preg_match ("/^([0-9]+)$/",$plf)) {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE PLFID = ".mysql_real_escape_string($plf)." AND ".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rechte WHERE PLID=".mysql_real_escape_string($plf)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	}
	else {
$sql = "SELECT PLFID, PLID, Funktionsname, hdatei, aktiv FROM plugin_funktion WHERE Funktionsname = ".mysql_real_escape_string($plf)." AND ".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rechte WHERE PLID=".mysql_real_escape_string($reihe['PLFID'])." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
	}
	
}

?>