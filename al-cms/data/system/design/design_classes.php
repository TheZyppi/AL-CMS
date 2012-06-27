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
private static function css($rsp) {
				// Abfrage welches Design aktiv ist
$sql = mysql_query('SELECT DID, name, data, mobile, standart, aktiv FROM design WHERE mobile="0" AND standart="1" AND aktiv="1"');
$row = mysql_fetch_array($sql);

	$a=$row['aktiv'];
	$n=$row['DID'];
	$d=$row['data'];

// Die Hauptdatei vom Design wird reingeladen
	if (!$sql || $n=="" || $sql==false || $row==false)
	{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"You havent a standart design for your page.");	
	}
	else {
$pfad=$d;
$path=$pfad;
design::path_order_design($path);
return $path;
	} 
} 	
	private static function css_head_plugin_normal($rsp)
{
	$hpl=$_GET['hpl'];
		 	$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.mysql_real_escape_string($hpl).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.mysql_real_escape_string($reihe['DID']).'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
$path=$reihe2['data'];
$this->path_order_design($path);
return $path;
}

	private function css_head_lower_plugin_normal($rsp)
{
	$lpl=$_GET['lpl'];
				$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.mysql_real_escape_string($lpl).'') or die(mysql_error());
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.mysql_real_escape_string($reihe['DID']).'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
$path=$reihe2['data'];
$this->path_order_design($path);
return $path;
}

	private static function css_plugin_funktion_normal($rsp)
	{
			$plf=$_GET['plf'];
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.mysql_real_escape_string($plf).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
			   	$sql2 = mysql_query('SELECT DID, data, aktiv FROM design WHERE DID='.mysql_real_escape_string($reihe['DID']).'');
			   	$reihe2 = mysql_fetch_array($sql2, MYSQL_ASSOC);
$path=$reihe2['data'];
$this->path_order_design($path);
return $path;
	}

	// Search for Plugins (Head, Lower and Functions)
private static function plugin_search()
{
		if (isset($_GET['hpl'])=="" || $_GET['hpl']=="") {
			return false;
		}
		else if(isset($_GET['hpl'])!="" && isset($_GET['lpl'])=="" && isset($_GET['plf'])=="")
	{
		$hpl=$_GET['hpl'];
	if (preg_match ("/^([0-9]+)$/",$hpl)) {
				$name_check=mysql_query("SELECT HPLID, name FROM head_plugins WHERE HPLID='".mysql_real_escape_string($hpl)."'");
				$name_array=mysql_fetch_array($name_check);
				$plugin=$name_array['name'];
				return $plugin;
	}
	else {
		$sql3=mysql_query("SELECT HPLID, name FROM head_plugins WHERE name='".mysql_real_escape_string($hpl)."'");
		$row=mysql_fetch_array($sql3);
				$plugin=$hpl;
				return $plugin;
	}
	}
else if(isset($_GET['plf'])=="" && isset($_GET['lpl'])!="" && isset($_GET['hpl'])!="")
			{
					$lpl=$_GET['lpl'];
	if (preg_match ("/^([0-9]+)$/",$lpl)) {
				$name_check=mysql_query("SELECT LPLID, name FROM lower_plugins WHERE LPLID='".mysql_real_escape_string($lpl)."'");
				$name_array=mysql_fetch_array($name_check);
				$plugin=$name_array['name'];
				return $plugin;
	}
	else {
		$sql3=mysql_query("SELECT LPLID, name FROM lower_plugins WHERE name='".mysql_real_escape_string($lpl)."'");
		$row=mysql_fetch_array($sql3);
				$plugin=$hpl;
				return $plugin;
	}
			}
			else if(isset($_GET['lpl'])=="" && isset($_GET['plf'])!="" && isset($_GET['hpl'])!="" || isset($_GET['lpl'])!="" && isset($_GET['plf'])!="" && isset($_GET['hpl'])!=""){
				$plf=$_GET['plf'];
	if (preg_match ("/^([0-9]+)$/",$plf)) {
				$name_check=mysql_query("SELECT PLFID, funktionsname FROM plugin_funktion WHERE PLFID='".mysql_real_escape_string($plf)."'");
				$name_array=mysql_fetch_array($name_check);
				$plugin=$name_array['funktionsname'];
				return $plugin;
	}
	else {
		$sql3=mysql_query("SELECT PLFID, name FROM plugin_funktion WHERE funktionsname='".mysql_real_escape_string($plf)."'");
		$row=mysql_fetch_array($sql3);
				$plugin=$hpl;
				return $plugin;
	}
				}
else {
	return false;
}
			
}
public static function css_script($rsp)
	{	
	if (isset($_GET['hpl'])=="" || $_GET['hpl']=="") {
return design::css($rsp);
}
else {

		if (isset($_GET['plf'])=="" && isset($_GET['lpl'])=="")
		{
			$hpl=$_GET['hpl'];
		if (preg_match ("/^([0-9]+)$/",$hpl)) {
		 	$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.mysql_real_escape_string($hpl).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
	}
	else {
		$sql3=mysql_query("SELECT HPLID, name FROM head_plugins WHERE name='".mysql_real_escape_string($hpl)."'");
		$row=mysql_fetch_array($sql3);
			$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.mysql_real_escape_string($row['HPLID']).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
	}
		if($reihe['HPLID']!=$hpl || $reihe['HPLID']==false || !$sql || $sql==false || !$sql3 || $sql3==false)
		{
		return	design::css($rsp);
		}
		else {
		return design::css_head_plugin_normal($rsp);	
		}
		}
		// Wenn eine Plugin Funktion angeben wurde wird else ausgeführt
		else {
			
			if(isset($_GET['plf'])=="" && isset($_GET['lpl'])!="" && isset($_GET['hpl'])!="")
			{
				$lpl=$_GET['lpl'];
			if (preg_match ("/^([0-9]+)$/",$lpl)) {
				$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.mysql_real_escape_string($lpl).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
else {
		$sql3=mysql_query("SELECT LPLID, name FROM lower_plugins WHERE name='".mysql_real_escape_string($lpl)."'");
		
		$row=mysql_fetch_array($sql3);
	$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.mysql_real_escape_string($row['LPLID']).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
}
		if($sql==false || $reihe['LPLID']!=$lpl || $reihe['LPLID']==false)
		{
			return design::css($rsp);
		}
		else {
		return	design::css_head_lower_plugin_normal($rsp);
		}
			}
			else if(isset($_GET['lpl'])=="" && isset($_GET['plf'])!="" && isset($_GET['hpl'])!=""){
				$plf=$_GET['plf'];
			if (preg_match ("/^([0-9]+)$/",$plf)) {
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.mysql_real_escape_string($plf).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
				else {
					$sql3=mysql_query("SELECT PLFID, funktionsname FROM plugin_funktion WHERE funktionsname='".mysql_real_escape_string($plf)."'");
					$row=mysql_fetch_array($sql3);
					$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.mysql_real_escape_string($row['PLFID']).'');
			   		$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
		if(!$sql || $reihe['PLFID']!=$plf || $sql==false)
		{
		return	design::css($rsp);
		}
		else {
		return design::css_plugin_funktion_normal($rsp);	
		}
			}		
			else if($_GET['plf']!="" && $_GET['lpl']!="" && isset($_GET['hpl'])!="")
			{
$plf=$_GET['plf'];
		if (preg_match ("/^([0-9]+)$/",$plf)) {
			
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.mysql_real_escape_string($plf).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
				else {
					$sql3=mysql_query("SELECT PLFID, funktionsname FROM plugin_funktion WHERE funktionsname='".mysql_real_escape_string($plf)."'");
					$row=mysql_fetch_array($sql3);
					$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.mysql_real_escape_string($row['PLFID']).'');
			   		$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
		if(!$sql || $reihe['PLFID']!=$plf || $sql==false)
		{
		return	design::css($rsp);
		}
		else {
		return design::css_plugin_funktion_normal($rsp);	
		}
			}
		}
	}
	}
// Give use the path to the design
	public static function path_order_design($path)
{
	return $path;
}
public function plugin_check()
{
	$plugin=$this->plugin_search();
	if($plugin==false)
	{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"Error!.");
	}
	else {
		return $plugin;
	}
}
private function body($srdp) {
				// Abfrage welches Design aktiv ist
$sql = mysql_query('SELECT DID, name, data, mobile, standart, aktiv FROM design WHERE mobile="0" AND standart="1" AND aktiv="1"');
if (!$sql || $sql==false)
	{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"You havent a standart design for your page.");
			}
else {
$row = mysql_fetch_array($sql);

	$a=$row['aktiv'];
	$n=$row['DID'];
	$d=$row['data'];

// Die Hauptdatei vom Design wird reingeladen
	if (!$row || $row==false)
	{		
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"You havent a standart design for your page.");
	} 
	else {
$pfad=$d;
// Head Include
design::load_head("".$srdp."design/".$pfad."/head_main.tpl", $srdp);
//Body-Head
design::load_body_head("".$srdp."design/".$pfad."body_head.tpl", $srdp);

design::load_body_footer("".$srdp."design/".$pfad."body_head.tpl", $srdp);
design::settemplate($srdp);
design::assign("css", require_once("".$srdp."design/".design::css_script($srdp)."css/index.php"));
design::assign("title", "");
//require_once(''.$srdp.'design/'.$pfad.'index.php');
// Die Head Funktion wird reingeladen dient dazu den Header darzustellen
//include('head_function.php');
	} 
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
require_once(''.$srdp.'design/'.$reihe2['data'].'index.php');	
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
			   
require_once(''.$srdp.'design/'.$reihe2['data'].'index.php');
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
			   
require_once(''.$srdp.'design/'.$reihe2['data'].'index.php');
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
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"ERROR: Head Plugin Name not found!");				}
else {
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
}
	}
	else {
		$sql3=mysql_query("SELECT HPLID, name FROM head_plugins WHERE name='".mysql_real_escape_string($hpl)."'");
		if(!$sql3 || $sql3==false)
		{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"ERROR: Head Plugin Name not found!");
		}
		else {
		$row=mysql_fetch_array($sql3);
			if($row['name']!=$hpl || $row['name']==false)
			{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"ERROR: Head Plugin Name not found!");
			}
else {
	$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.mysql_real_escape_string($row['HPLID']).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
}
		}
	}
			$sql = mysql_query('SELECT DID, HPLID FROM design_head_plugin_order WHERE HPLID='.mysql_real_escape_string($reihe['HPLID']).'');
			if(!$sql || $sql==false)
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
				if(!$sql || $sql==false)
					{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"ERROR: Lower Plugin not found!");
					}
				else {
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
			   	}
else {
		$sql3=mysql_query("SELECT LPLID, name FROM lower_plugins WHERE name='".mysql_real_escape_string($lpl)."'");
			if(!$sql3 || $sql==false)
					{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"ERROR: Lower Plugin Name not found!");
					}
					else {
		$row=mysql_fetch_array($sql3);
						if($row['name']!=$lpl || $row['name']==false)
			{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"ERROR: Lower Plugin Name not found!");
			}
else {
					}
	$sql = mysql_query('SELECT DID, LPLID FROM design_lower_plugin_order WHERE LPLID='.mysql_real_escape_string($row['LPLID']).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
					}
					}
		if(!$sql || $reihe['LPLID']!=$lpl || $sql==false)
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
			   	if(!$sql || $sql==false)
					{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"ERROR: Plugin Function not found!");
					}
					else {
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
					}
				}
				else {
					$sql3=mysql_query("SELECT PLFID, funktionsname FROM plugin_funktion WHERE funktionsname='".mysql_real_escape_string($plf)."'");
					if(!$sql3 || $sql3==false)
					{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"ERROR: Plugin Function not found!");
					}
					else {
					$row=mysql_fetch_array($sql3);
							if($row['funktionsname']!=$plf)
					{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"ERROR: Plugin Function Name not found!");
					}
					}
					$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.mysql_real_escape_string($row['PLFID']).'');
			   		$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
		if(!$sql || $reihe['PLFID']!=$plf || $reihe==false || $sql==false)
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
				$sql = mysql_query('SELECT DID, PLFID FROM design_plugin_funktion_order WHERE PLFID='.mysql_real_escape_string($plf).'');
			   	$reihe = mysql_fetch_array($sql, MYSQL_ASSOC);
				}
				else {
					$sql3=mysql_query("SELECT PLFID, name FROM plugin_funktion WHERE funktionsname=".mysql_real_escape_string($plf)."");
					$row=mysql_fetch_array($sql3);
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
		}
		
	}

	}
	public function body_normal($srdp)
	{
		$this->normal_body($srdp);
	}
	

    private static $languageDir = "language/";

    private static $leftDelimiter = '{$';

    private static $rightDelimiter = '}';

    private static $leftDelimiterF = '{';

    private static $rightDelimiterF = '}';

   	private static$leftDelimiterC = '\{\*';

   	private static $rightDelimiterC = '\*\}';

    private static $leftDelimiterL = '\{L_';

    private static $rightDelimiterL = '\}';

    private static $templateFile = "";
        
    private static $template_plugin_File = "";

    private static $template_head_File = "";
	
	private static $template_body_head_File = "";
	
	private static $template_body_plugin_File = "";

	private static $template_body_foot_File = "";

    private static $languageFile = "";

    private static $templateName = "";

    private static $template = "";
	
	private static $template_head = "";
	
	private static $template_body_head = "";

	private static $template_body_plugin = "";

	private static $template_body_footer = "";
	
	private static $array;

    public function __construct($tpl_dir = "", $lang_dir = "") {
       
        if (!empty($tpl_dir) ) {
            $this->templateDir = $tpl_dir;
        }

       
        if ( !empty($lang_dir) ) {
            $this->languageDir = $lang_dir;
        }
    }
// This load is for Error Loads for the AL-CMS
    public static function load($file, $rsp)    {
        design::$templateName = $file;
        design::$templateFile = $file;

        if(isset(design::$templateFile) ) {
            if( file_exists(design::$templateFile) ) {
                design::$template = file_get_contents(design::$templateFile);
            } else {
            	echo "1";
                return false;
            }
        } else {
        	echo "2";
           return false;
        }
 
        design::parseFunctions();
    }
// This load the Head files
    public static function load_head($file, $rsp)    {
        design::$templateName = $file;
        design::$template_head_File = $file;

        if(isset(design::$template_head_File) ) {
            if( file_exists(design::$template_head_File) ) {
                design::$template_head = file_get_contents(design::$template_head_File);
            } else {
            	echo "1";
                return false;
            }
        } else {
        	echo "2";
           return false;
        }
 
        design::parseFunctions();
    }

public static function load_body_head($file, $rsp)    {
        design::$templateName = $file;
        design::$template_body_head_File = $file;

        if(isset(design::$template_body_head_File) ) {
            if( file_exists(design::$template_body_head_File) ) {
                design::$template_body_head  = file_get_contents(design::$template_body_head_File);
            } else {
            	echo "1";
                return false;
            }
        } else {
        	echo "2";
           return false;
    }
 
        design::parseFunctions();
    }

public static function load_body_plugin($file, $rsp)    {
        design::$templateName = $file;
        design::$template_body_plugin_File = $file;

        if(isset(design::$template_body_plugin_File)) {
            if( file_exists(design::$template_body_plugin_File) ) {
                design::$template_body_plugin  = file_get_contents(design::$template_body_plugin_File);
            } else {
            	echo "1";
                return false;
            }
        } else {
        	echo "2";
           return false;
   }
 
        design::parseFunctions();
    }
		
public static function load_body_footer($file, $rsp)    {
        design::$templateName = $file;
        design::$template_body_foot_File = $file;

        if(isset(design::$template_body_foot_File) ) {
            if( file_exists(design::$template_body_foot_File) ) {
                design::$template_body_footer  = file_get_contents(design::$template_body_foot_File);
            } else {
            	echo "1";
                return false;
            }
        } else {
        	echo "2";
           return false;
   }
 
        design::parseFunctions();
    }

   public static function assign($replace, $replacement) {
   	if($replacement==false || $replacement=="")
	{
		 design::$template = str_replace( design::$leftDelimiter .$replace.design::$rightDelimiter,
                                    "", design::$template );
	}
	else {
      design::$template = str_replace( design::$leftDelimiter .$replace.design::$rightDelimiter,
                                    $replacement, design::$template );
	}
	}
    public static function loadLanguage($files) {
        design::$languageFiles = $files;

        for( $i = 0; $i < count( design::$languageFiles ); $i++ ) {
            if ( !file_exists( design::$languageDir .design::$languageFiles[$i] ) ) {
                return false;
            } else {
                 include_once( design::$languageDir .design::$languageFiles[$i] );
            }
        }

        design::$replaceLangVars($lang);

        return $lang;
    }


    private static function replaceLangVars($lang) {
        design::$template = preg_replace("/\{L_(.*)\}/isUe", "\$lang[strtolower('\\1')]", design::$template);
    }

    private static function parseFunctions() {
      
        while( preg_match( "/" .design::$leftDelimiterF ."include file=\"(.*)\.(.*)\""
                           .design::$rightDelimiterF ."/isUe", design::$template) )
        {
            design::$template = preg_replace( "/" .design::$leftDelimiterF ."include file=\"(.*)\.(.*)\""
                                            .design::$rightDelimiterF."/isUe",
                                            "file_get_contents(\$this->templateDir.'\\1'.'.'.'\\2')",
                                            design::$template );
        }


        design::$template = preg_replace( "/" .design::$leftDelimiterC ."(.*)" .design::$rightDelimiterC ."/isUe",
                                        "", design::$template );
    }
	
	public static function settemplate($srdp)
	{
		if(design::$template_head=="" || design::$template_head==false)
		{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"No template head set.");	
		}
		else if(design::$template_body_head=="" || design::$template_body_head==false)
		{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"No template body head set.");	
		}
		else if(design::$template_body_plugin=="" || design::$template_body_plugin==false)
		{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"No template body plugin set.");	
		}
		else if(design::$template_body_footer=="" || design::$template_body_footer==false)
		{
design::load("data/default-scripts/error/error.tpl", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"No template body foot set.");	
		}
		else {
		design::$template="".design::$template_head."".design::$template_body_head."".design::$template_body_plugin."".design::$template_body_footer."";
		}
		}
                public static function assignEach($name, $array) {
                        $this->array = $array;
                        $this->template = preg_replace_callback('/<each="' . $name . '">(.*?)<\/each>/ms', array($this, 'eachCallback'), $this->template);
                        return $this;
                }               
                private static function eachCallback($matches) {
                        foreach($this->array as $value) {
                                $cache = $matches[0];
                                foreach($value as $key => $subValue)
                                        $cache = str_replace($this->leftDelimiter . $key . $this->rightDelimiter, $subValue, $cache);
                                $return .= $cache;
                        }
                        return $return;
                }
		
    public static function display($srdp) {
        echo design::$template;
	}
 }
 $designsys = new design();
?>