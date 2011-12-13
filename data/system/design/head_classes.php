<?php

	class headp {
	public function meta()
	{
	// Datein für die Head werden geladen
	include('../../meta/meta.php');
	}
	public function title()
	{
	include ('../../dbcon.php');	
	db_con();
	$title="SELECT * FROM Einstellungen WHERE EID=1";
	$ergebnis = mysql_query($title);
	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
	echo $reihe['text'];
	}
	public function css_script()
	{ 
		include ('".$pfad."css/index.php');
	}
	
	}	

$objhead = new headp();

?>