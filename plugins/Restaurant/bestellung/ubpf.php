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

 if ($_POST['bezahlung']=="")
 {
 	echo "Sie haben keine Bezahlungsart angegeben.";
	exit;
 }
 else {
     $sql = "SELECT BADatei FROM bezahlung_arten WHERE BAID=".$_POST['bezahlung']."";
$ergebnis = mysql_query($sql);
$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC) or die (mysql_error());
include($reihe['BADatei']);
 }

?>