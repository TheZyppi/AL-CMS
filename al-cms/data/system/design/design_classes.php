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
while($row = @mysql_fetch_array($sql))
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
include(''.$srdp.'design/'.$pfad.'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
	} 
} 	
	private function body_head_plugin_normal($srdp)
{
	$hpl=$_GET['hpl'];
	if (preg_match ("/^([0-9]+)$/",$hpl)) {
		 	$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.$hpl.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
	}
	else {
		$sql3=mysql_query("SELECT HPLID, name FROM head_plugins WHERE name=".$hpl."");
		$row=mysql_fetch_array($sql3);
			$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.$row['HPLID'].'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
	}
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
include(''.$srdp.'design/'.$reihe2['data'].'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');	
}

	private function body_head_lower_plugin_normal($srdp)
{
	$lpl=$_GET['lpl'];
	if (preg_match ("/^([0-9]+)$/",$lpl)) {
				$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.$lpl.'') or die(mysql_error());
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	}
else {
		$sql3=mysql_query("SELECT LPLID, name FROM lower_plugins WHERE name=".$lpl."");
		$row=mysql_fetch_array($sql3);
	$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.$row['LPLID'].'') or die(mysql_error());
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
}
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'') or die(mysql_error());
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
			   
include(''.$srdp.'design/'.$reihe2['data'].'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
}

	private function body_plugin_funktion_normal($srdp)
	{
			$plf=$_GET['plf'];
				if (preg_match ("/^([0-9]+)$/",$plf)) {
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$plf.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
				else {
					$sql3=mysql_query("SELECT PLFID, name FROM plugin_funktion WHERE funktionsname=".$plf."");
					$row=mysql_fetch_array($sql3);
					$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$row['PLFID'].'');
			   		$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.$reihe['DID'].'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
			   
include(''.$srdp.'design/'.$reihe2['data'].'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
include('head_function.php');
	}

	private function normal_body($srdp)
	{
		if (isset($_GET['hpl'])=="" || $_GET['hpl']=="" || $_GET['hpl']==false) {
$this->body($srdp);
}
else {

		if (isset($_GET['plf'])=="" && isset($_GET['lpl'])=="")
		{
			$hpl=$_GET['hpl'];
			if (preg_match ("/^([0-9]+)$/",$hpl)) {
		 	$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.mysql_real_escape_string($hpl).'');
				if(!$sql || $sql==false)
				{
					echo "ERROR: Head Plugin not found!";
		     		exit;
				}
else {
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
}
	}
	else {
		$sql3=mysql_query("SELECT HPLID, name FROM head_plugins WHERE name='".mysql_real_escape_string($hpl)."'");
		if(!$sql3 || $sql3==false)
		{
		echo "ERROR: Head Plugin Name not found!";
		exit;	
		}
		else {
		$row=mysql_fetch_array($sql3);
			if($row['name']!=$hpl || $row['name']==false)
			{
		echo "ERROR: Head Plugin Name not found!";
		exit;
			}
else {
	$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.mysql_real_escape_string($row['HPLID']).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
}
		}
	}
			$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.mysql_real_escape_string($reihe['HPLID']).'');
			if(!$sql)
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
				if (preg_match ("/^([0-9]+)$/",$lpl)) {
				$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.mysql_real_escape_string($lpl).'');
				if(!$sql)
					{
						echo "ERROR: Lower Plugin not found!";
						exit;
					}
				else {
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
			   	}
else {
		$sql3=mysql_query("SELECT LPLID, name FROM lower_plugins WHERE name='".mysql_real_escape_string($lpl)."'");
			if(!$sql3)
					{
						echo "ERROR: Lower Plugin Name not found!";
						exit;
					}
					else {
		$row=mysql_fetch_array($sql3);
						if($row['name']!=$lpl)
			{
		echo "ERROR: Lower Plugin Name not found!";
		exit;
			}
else {
					}
	$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.mysql_real_escape_string($row['LPLID']).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
					}
					}
		if(! $sql || $reihe['LPLID']!=$lpl)
		{
			$this->body($srdp);
		}
		else {
			$this->body_head_lower_plugin_normal($srdp);
		}
			}
			else if(isset($_GET['lpl'])=="" && isset($_GET['plf'])!="" && isset($_GET['hpl'])!=""){
				$plf=$_GET['plf'];
				if (preg_match ("/^([0-9]+)$/",$plf)) {
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.mysql_real_escape_string($plf).'');
			   	if(!$sql)
					{
						echo "ERROR: Plugin Function not found!";
						exit;
					}
					else {
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
					}
				}
				else {
					$sql3=mysql_query("SELECT PLFID, funktionsname FROM plugin_funktion WHERE funktionsname='".mysql_real_escape_string($plf)."'");
					if(!$sql3)
					{
						echo "ERROR: Plugin Function not found!";
						exit;
					}
					else {
					$row=mysql_fetch_array($sql3);
							if($row['funktionsname']!=$plf)
					{
						echo "ERROR: Plugin Function Name not found!";
						exit;
					}
					}
					$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.mysql_real_escape_string($row['PLFID']).'');
			   		$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
		if(! $sql || $reihe['PLFID']!=$plf)
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
			if (preg_match ("/^([0-9]+)$/",$plf)) {
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$plf.'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
				else {
					$sql3=mysql_query("SELECT PLFID, name FROM plugin_funktion WHERE funktionsname=".$plf."");
					$row=mysql_fetch_array($sql3);
					$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.$row['PLFID'].'');
			   		$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
		if(! $sql || $reihe['PLFID']!=$plf)
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