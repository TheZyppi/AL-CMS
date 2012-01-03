<?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is free software, you can you can redistribute it and/or modify
 *it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */


$group=$user->data['group_id'];

include ('../../../config/dbcon.php');



// Es wird nachgeguckt ob eine PluginID angegeben wurde.
if ($plf=="") {
echo "Es wurde keine Funktion angegeben.";
exit;
}
else {	
db_con();
$sql = "SELECT PLFID, PLID, Funktionsname, datei, aktiv FROM plugin_funktion WHERE PLFID = ".mysql_real_escape_string($plf)." AND ".mysql_real_escape_string($plid)." LIMIT 1";
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
$sql2 = "SELECT PLFID, GID, Y_N FROM plugin_funktion_rechte WHERE PLID=".mysql_real_escape_string($plf)." LIMIT 1";
	$ergebnis2 = mysql_query($sql2);
   $reihe2 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
}

?>