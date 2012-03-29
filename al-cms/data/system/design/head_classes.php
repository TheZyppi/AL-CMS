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

 
 /* 
 * Headclasses.php
 * Dient dazu um die Oberste HTML Struktur aufzubauen.
 */

 // Title + Meta System werden reingeladen
// Data-Right-Security-Open-Check
if (!defined('ON_ALCMS') || isset($_SESSION['group'])=="")
{
	echo "Error: You are not use ALCMS!";
	exit;
}
else {
	class headp {

// Title System vom Head und dem Rechte Gruppe System
	public function title($rsp)
	{
		include('title.php');	
	}
// Meta System vom Head und dem Rechte Gruppe System
	public function meta($rsp)
	{
		include('meta.php');
	}
// Public Funktion für das Laden der CSS Scripte
private function css($rsp) {
				// Abfrage welches Design aktiv ist
$sql = mysql_query('SELECT DID, name, data, mobile, standart, aktiv FROM design WHERE mobile="0" AND standart="1" AND aktiv="1"');
while($row = mysql_fetch_array($sql))
{
	$a=$row['aktiv'];
	$n=$row['DID'];
	$d=$row['data'];
}
// Die Hauptdatei vom Design wird reingeladen
	if ( ! $sql || $n=="")
	{
		mysql_close();
		echo "Sie haben kein Standart Design angegeben.";
		exit;
	}
	else {
$pfad=$d;
include(''.$rsp.'design/'.$pfad.'css/index.php');
	} 
} 	
	private function css_head_plugin_normal($rsp)
{
	$hpl=$_GET['hpl'];
		 	$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.$hpl.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
include(''.$rsp.'design/'.$reihe2['data'].'css/index.php');
}

	private function css_head_lower_plugin_normal($rsp)
{
	$lpl=$_GET['lpl'];
				$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.$lpl.'') or die(mysql_error());
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'') or die(mysql_error());
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
			   
include(''.$rsp.'design/'.$reihe2['data'].'css/index.php');
}

	private function css_plugin_funktion_normal($rsp)
	{
			$plf=$_GET['plf'];
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$plf.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
			   
include(''.$rsp.'design/'.$reihe2['data'].'css/index.php');
	}

	public function css_script($rsp)
	{
		
	if (isset($_GET['hpl'])=="" || $_GET['hpl']=="") {
$this->css($rsp);
}
else {

		if (isset($_GET['plf'])=="" && isset($_GET['lpl'])=="")
		{
			$hpl=$_GET['hpl'];
		if (preg_match ("/^([0-9]+)$/",$hpl)) {
		 	$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.$hpl.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
	}
	else {
		$sql3=mysql_query("SELECT HPLID, name FROM head_plugins WHERE name='".$hpl."'");
		$row=mysql_fetch_array($sql3);
			$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.$row['HPLID'].'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
	}
		if($reihe['HPLID']!=$hpl)
		{
			$this->css($rsp);
		}
		else {
		$this->css_head_plugin_normal($rsp);	
		}
		}
		// Wenn eine Plugin Funktion angeben wurde wird else ausgeführt
		else {
			
			if(isset($_GET['plf'])=="" && isset($_GET['lpl'])!="" && isset($_GET['hpl'])!="")
			{
				$lpl=$_GET['lpl'];
			if (preg_match ("/^([0-9]+)$/",$lpl)) {
				$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.$lpl.'') or die(mysql_error());
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	}
else {
		$sql3=mysql_query("SELECT LPLID, name FROM lower_plugins WHERE name='".$lpl."'");
		$row=mysql_fetch_array($sql3);
	$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.$row['LPLID'].'') or die(mysql_error());
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
}
		if(! $sql || $reihe['LPLID']!=$lpl)
		{
			$this->css($rsp);
		}
		else {
			$this->css_head_lower_plugin_normal($rsp);
		}
			}
			else if(isset($_GET['lpl'])=="" && isset($_GET['plf'])!="" && isset($_GET['hpl'])!=""){
				$plf=$_GET['plf'];
			if (preg_match ("/^([0-9]+)$/",$plf)) {
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$plf.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
				else {
					$sql3=mysql_query("SELECT PLFID, funktionsname FROM plugin_funktion WHERE funktionsname='".$plf."'") or die (mysql_error());
					$row=mysql_fetch_array($sql3);
					$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$row['PLFID'].'');
			   		$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
		if(! $sql || $reihe['PLFID']!=$plf)
		{
			$this->css($rsp);
		}
		else {
		$this->css_plugin_funktion_normal($rsp);	
		}
			}		
			else if($_GET['plf']!="" && $_GET['lpl']!="" && isset($_GET['hpl'])!="")
			{
$plf=$_GET['plf'];
		if (preg_match ("/^([0-9]+)$/",$plf)) {
			
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$plf.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
				else {
					$sql3=mysql_query("SELECT PLFID, funktionsname FROM plugin_funktion WHERE funktionsname='".$plf."'") or die (mysql_error());
					$row=mysql_fetch_array($sql3);
					$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$row['PLFID'].'');
			   		$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
		if(! $sql || $reihe['PLFID']!=$plf)
		{
			$this->css($rsp);
		}
		else {
		$this->css_plugin_funktion_normal($rsp);	
		}
			}
		}	
	}
	}
	}	

$objhead = new headp();
}
?>