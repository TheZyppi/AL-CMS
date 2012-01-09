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
	$datum=explode( '.', $_POST['datum'] );
	$uhrzeit=explode( ':', $_POST['uhrzeit'] );
	
	// Hier wird nach der normalisierung der Daten die Daten mit mktime in timestamp umgewandelt.
	$datumt=mktime( 0, 0, 0, $datum[1], $datum[0], $datum[2] );
	$uhrzeitt=mktime( $uhrzeit[0], $uhrzeit[1], 0, 0, 0, 0 );
	
	

?>