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

 class design {
 	
private function body($srdp) {
				// Abfrage welches Design aktiv ist
$sql = @mysql_query('SELECT DID, name, data, mobile, standart, aktiv FROM design WHERE mobile="0" AND standart="1" AND aktiv="1"');
while($row = @mysql_fetch_object($sql))
{
	$a=$row->aktiv;
	$n=$row->DID;
	$d=$row->data;
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
include(''.$srdp.'design/'.$pfad.'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
	} 
} 	
	private function body_head_plugin_normal($srdp)
{
	$hpl=$_GET['hpl'];
		 	$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.$hpl.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
include(''.$srdp.'design/'.$reihe2['data'].'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');	
}

	private function body_head_lower_plugin_normal($srdp)
{
	$lpl=$_GET['lpl'];
				$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.$lpl.'') or die(mysql_error());
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'') or die(mysql_error());
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
			   
include(''.$srdp.'design/'.$reihe2['data'].'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
}

	private function body_plugin_funktion_normal($srdp)
	{
			$plf=$_GET['plf'];
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$plf.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
			   
include(''.$srdp.'design/'.$reihe2['data'].'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
	}

	private function normal_body($srdp)
	{
		if (isset($_GET['hpl'])=="" || $_GET['hpl']=="") {
$this->body($srdp);
}
else {

		if (isset($_GET['plf'])=="" && isset($_GET['lpl'])=="")
		{
			$hpl=$_GET['hpl'];
			$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.$hpl.'');
			if(! $sql)
			{
				$this->body($srdp);
			}
			else {
	   	$reihe2 = mysql_fetch_array($sql, MYSQL_ASSOC);
		if($reihe2['HPLID']!=$hpl)
		{
			$this->body($srdp);
		}
		else {
		$this->body_head_plugin_normal($srdp);	
		}
		}
		}
		// Wenn eine Plugin Funktion angeben wurde wird else ausgeführt
		else {
			
			if(isset($_GET['plf'])=="" && isset($_GET['lpl'])!="" && isset($_GET['hpl'])!="")
			{
				$lpl=$_GET['lpl'];
			$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.$lpl.'');
	   	$reihe2 = mysql_fetch_array($sql, MYSQL_ASSOC);
		if(! $sql || $reihe2['LPLID']!=$lpl)
		{
			$this->body($srdp);
		}
		else {
			$this->body_head_lower_plugin_normal($srdp);
		}
			}
			else if(isset($_GET['lpl'])=="" && isset($_GET['plf'])!="" && isset($_GET['hpl'])!=""){
				$plf=$_GET['plf'];
			$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$plf.'');
	   	$reihe2 = mysql_fetch_array($sql, MYSQL_ASSOC);
		if(! $sql || $reihe2['PLFID']!=$plf)
		{
			$this->body($srdp);
		}
		else {
		$this->body_plugin_funktion_normal($srdp);	
		}
			}		
			else if($_GET['plf']!="" && $_GET['lpl']!="" && isset($_GET['hpl'])!="")
			{
$plf=$_GET['plf'];
			$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$plf.'');
	   	$reihe2 = mysql_fetch_array($sql, MYSQL_ASSOC);
		if(! $sql || $reihe2['PLFID']!=$plf)
		{
			$this->body($srdp);
		}
		else {
		$this->body_plugin_funktion_normal($srdp);	
		}
				
			}
		}
		
	}

	}
	public function body_normal($srdp)
	{
		$this->normal_body($srdp);
	}
	
 }
 $designsys = new design();
?>