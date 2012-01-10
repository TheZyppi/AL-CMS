<?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is a free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */

 /*
  * Das Datum und Uhrzeit aus der UBDF.php werden wegen den Sonderzeichen erstmal "normalisiert",
  * um mit mktime weiter verarbeitet werden zu können.
  */
 	if (isset($_POST['datum'])=="" && isset($_POST['uhrzeit'])=="")
 	{
 		echo "Sie haben vergessen ein Datum und die Uhrzeit anzugeben.";
		exit;
 	}
	else {
		
	if(isset($_POST['datum'])=="")
	{
		echo "Sie haben kein Datum angegeben.";
		exit;
	}
	else {
		$datum=explode( '.', $_POST['datum'] );
	}
	if(isset($_POST['uhrzeit'])=="")
	{
	echo "Sie haben keine Uhrzeit angegeben.";
	exit;
	}
	else {
	$uhrzeit=explode( ':', $_POST['uhrzeit'] );	
	}
	// Hier wird nach der normalisierung der Daten die Daten mit mktime in timestamp umgewandelt.
	$datum_u_t=mktime( $uhrzeit[4], $uhrzeit[5], 0, $datum[1], $datum[0], $datum[2] );
	
	
	if($datum_u_t >= $reihe['maxtime'])
	{
		
		
	}
	
	}
	

?>