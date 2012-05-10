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
$path=$pfad;
$this->path_order_design($path);
return $path;
	} 
} 	
	private function css_head_plugin_normal($rsp)
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

	private function css_plugin_funktion_normal($rsp)
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
private function plugin_search()
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
public function css_script($rsp)
	{	
	if (isset($_GET['hpl'])=="" || $_GET['hpl']=="") {
return $this->css($rsp);
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
		return	$this->css($rsp);
		}
		else {
		return $this->css_head_plugin_normal($rsp);	
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
			return $this->css($rsp);
		}
		else {
		return	$this->css_head_lower_plugin_normal($rsp);
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
		if(! $sql || $reihe['PLFID']!=$plf)
		{
		return	$this->css($rsp);
		}
		else {
		return $this->css_plugin_funktion_normal($rsp);	
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
		return	$this->css($rsp);
		}
		else {
		return $this->css_plugin_funktion_normal($rsp);	
		}
			}
		}
	}
	}
// Give use the path to the design
	public function path_order_design($path)
{
	return $path;
}
public function plugin_check()
{
	$plugin=$this->plugin_search();
	if($plugin==false)
	{
		return "Error!";
	}
	else {
		return $plugin;
	}
}
// Private Header Template Variable

    private $templateDir = "data/design/";

    private $languageDir = "language/";

    private $leftDelimiter = '{$';

    private $rightDelimiter = '}';

    private $leftDelimiterF = '{';

    private $rightDelimiterF = '}';

   	private $leftDelimiterC = '\{\*';

   	private $rightDelimiterC = '\*\}';

    private $leftDelimiterL = '\{L_';

    private $rightDelimiterL = '\}';

    private $templateFile = "";

    private $languageFile = "";

    private $templateName = "";

    private $template = "";


    public function __construct($tpl_dir = "", $lang_dir = "") {
       
        if ( !empty($tpl_dir) ) {
            $this->templateDir = $tpl_dir;
        }

       
        if ( !empty($lang_dir) ) {
            $this->languageDir = $lang_dir;
        }
    }

    public function load($file, $rsp)    {
        $this->templateName = $file;
        $this->templateFile = $this->templateDir.$this->css_script($rsp).$file;

        if(isset($this->templateFile) ) {
            if( file_exists($this->templateFile) ) {
                $this->template = file_get_contents($this->templateFile);
            } else {
                return false;
            }
        } else {
           return false;
        }

        $this->parseFunctions();
    }

   public function assign($replace, $replacement) {
      $this->template = str_replace( $this->leftDelimiter .$replace.$this->rightDelimiter,
                                    $replacement, $this->template );
    }
   

    public function loadLanguage($files) {
        $this->languageFiles = $files;

        for( $i = 0; $i < count( $this->languageFiles ); $i++ ) {
            if ( !file_exists( $this->languageDir .$this->languageFiles[$i] ) ) {
                return false;
            } else {
                 include_once( $this->languageDir .$this->languageFiles[$i] );
            }
        }

        $this->replaceLangVars($lang);

        return $lang;
    }


    private function replaceLangVars($lang) {
        $this->template = preg_replace("/\{L_(.*)\}/isUe", "\$lang[strtolower('\\1')]", $this->template);
    }

    private function parseFunctions() {
      
        while( preg_match( "/" .$this->leftDelimiterF ."include file=\"(.*)\.(.*)\""
                           .$this->rightDelimiterF ."/isUe", $this->template) )
        {
            $this->template = preg_replace( "/" .$this->leftDelimiterF ."include file=\"(.*)\.(.*)\""
                                            .$this->rightDelimiterF."/isUe",
                                            "file_get_contents(\$this->templateDir.'\\1'.'.'.'\\2')",
                                            $this->template );
        }


        $this->template = preg_replace( "/" .$this->leftDelimiterC ."(.*)" .$this->rightDelimiterC ."/isUe",
                                        "", $this->template );
    }

    public function display() {
        echo $this->template;
    }
	}
$objhead = new headp();
?>