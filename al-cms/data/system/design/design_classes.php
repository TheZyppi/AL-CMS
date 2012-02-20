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
$sql = mysql_query('SELECT DID, name, data, mobile, standart, aktiv FROM design WHERE mobile="0" AND standart="1" AND aktiv="1"');
while($row = mysql_fetch_object($sql))
{
	$a=$row->aktiv;
	$n=$row->DID;
	$d=$row->data;
}
// Die Hauptdatei vom Design wird reingeladen
	if ( ! $sql || $n=="")
	{
		echo "Sie haben kein Standart Design angegeben.";
		mysql_close();
		exit;
	}
	else {
$pfad=$d;
include(''.$srdp.'design/'.$pfad.'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
	} 
} 	
	private function normal_body ($srdp)
	{
		if (isset($_GET['hpl'])=="" || $_GET['hpl']=="") {
			$this->body($srdp);
		}
		else {
			$hpl=$_GET['hpl'];
			$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.$hpl.'');
			   $reihe2 = mysql_fetch_array($sql, MYSQL_ASSOC);
			if(! $sql || $reihe2['HPLID']!=$hpl)
			{
				$this->body($srdp);
			}
			else {
			if (isset($_GET['plf'])=="" && $_GET['lpl']=="")
		{
			 	$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.$hpl.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
			   
			   if($reihe2['aktiv']==1)
			   {
include(''.$srdp.'design/'.$reihe2['data'].'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
			   	
			   }
			   else {
				   echo "Das Design ist deaktiviert.";
			   }
			   
		}
			else
				{
					if (isset($_GET['plf'])=="") {
						$lpl=$_GET['lpl'];
				$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.$lpl.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
			   
			   if($reihe2['aktiv']==1)
			   {
include(''.$srdp.'design/'.$reihe2['data'].'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
			   	
			   }
			   else {
				   echo "Das Design ist deaktiviert.";
			   }
			
					}
					else if(isset($_GET['lpl'])=="")
					{
		$plf=$_GET['plf'];
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$plf.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
			   
			   if($reihe2['aktiv']==1)
			   {
include(''.$srdp.'design/'.$reihe2['data'].'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
			   	
			   }
			   else {
				   echo "Das Design ist deaktiviert.";
			   }
						
					}
else {
	$this->body($srdp);
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