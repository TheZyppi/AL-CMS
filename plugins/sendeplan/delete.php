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
db_con();
$said=$_GET['said'];
$sql = "DELETE from sendeplan WHERE SAID = ".mysql_real_escape_string($said)."";
if (@mysql_query($sql)) {
echo("<p>Sendung mit der SAID: $said erfolgreich gel&ouml;scht!</p>");
} else {
echo("<p>Fehler beim löschen: " . mysql_error() . "</p>");
}

?>