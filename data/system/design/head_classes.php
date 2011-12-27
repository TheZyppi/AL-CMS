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
		include_once('data/system/rechte_gruppen/plugin_classes.php');
	$pluginsys->stitle();
	}
// Meta System vom Head und dem Rechte Gruppe System
	public function meta()
	{
		include_once('data/system/rechte_gruppen/plugin_classes.php');
	$pluginsys->meta();
	}
	public function css_script()
	{
		include_once('data/system/rechte_gruppen/plugin_classes.php'); 
		include (''.$pfad.'css/index.php');
	}
	
	}	

$objhead = new headp();

?>