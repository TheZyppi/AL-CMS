<?php

/*
 * Headclasses.php
 * Dient dazu um die Obesreten HTML und eitenstruktur aufzubauen.
 */

 // Title + Meta System werden reingeladen
 include('../rechte_gruppen/plugin_classes.php');
	class headp {
	public function meta()
	{
	// Datein für die Head werden geladen
	include('../../meta/meta.php');
	}
	public function title()
	{
	$pluginsys->title();
	}
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