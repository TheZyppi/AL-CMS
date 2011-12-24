<?php

/*
 * Headclasses.php
 * Dient dazu um die Obesreten HTML und eitenstruktur aufzubauen.
 */

 // Title + Meta System werden reingeladen
 include('../rechte_gruppen/plugin_classes.php');
	class headp {

// Title System vom Head und dem Rechte Gruppe System
	public function title()
	{
	$pluginsys->title();
	}
// Meta System vom Head und dem Rechte Gruppe System
	public function meta()
	{
	$pluginsys->meta();
	}
	public function css_script()
	{ 
		include ('".$pfad."css/index.php');
	}
	
	}	

$objhead = new headp();

?>