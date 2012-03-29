<?php
// Data-Right-Security-Open-Check
if (!defined('ON_ALCMS') || isset($_SESSION['group'])=="")
{
	echo "Error: You are not use ALCMS!";
	exit;
}
else {
$plf=$_GET['plf'];
if (preg_match ("/^([0-9]+)$/",$plf)) {
$sql1="SELECT PLFID, PPLFID FROM panel_plf_order WHERE PLFID=".mysql_real_escape_string($plf)."";
$q1=@mysql_query($sql1);
}
else {
	$sql = "SELECT PLFID, funktionsname, data, nf, aktiv FROM plugin_funktion WHERE funktionsname = '".mysql_real_escape_string($plf)."' LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   $sql1="SELECT PLFID, PPLFID FROM panel_plf_order WHERE PLFID=".$reihe['PLFID']."";
   $q1=@mysql_query($sql1);
}
if(!$q1)
{
	echo "This Panel Funktions are not exist.";
}
else {
	$row1=mysql_fetch_array($q1);
	$sql2="SELECT PPLFID, name, data, funktion FROM panel_plf WHERE PPLFID=".$row1['PPLFID']."";
	$q2=@mysql_query($sql2);
	if(!$sql2)
	{
		echo"No Funktion found.";
	}
	else {
		$row2=mysql_fetch_array($q2);
		include(''.$srdp.'system/panel/'.$row2['data'].'');
		$row2['funktion']($srdp);
	}
}
}
?>