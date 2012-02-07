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

// Die dbcon.php wird eingefügt
db_con();
// Abfrage welches Design aktiv ist
$sql = mysql_query('SELECT DID, name, data, aktiv FROM design');
while($row = mysql_fetch_object($sql))
{
	$a=$row->aktiv;
	$n=$row->DID;
	$d=$row->data;
}
// Die Hauptdatei vom Design wird reingeladen
	if ( ! $sql || $a==0 || $n=="")
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
?>