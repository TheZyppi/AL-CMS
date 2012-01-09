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

 // Wird ausgeführt wenn man das Datum + die Uhrzeit für die Bestellung angegeben hat.
if(isset($_POST['submit']))
{
	include('ubbf.php');
}
// Wird dann ausgeführt wenn man die eigentliche Bestellung abschickt.
else if(isset($_POST['sumbit2'])) {
	include('ubsf.php');
}
// Die Standartseite die gelanden wird wenn nichts von dem beiden oben zutrifft.
else {
	include('ubdf.php');
}

?>