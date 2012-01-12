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
/* Hier her werden die Bestellungsdaten versand und danach wird die.
 * Bezahlungsart abgefragt
 */
else if(isset($_POST['sumbit2'])) {
	include('ubpaf.php');
}
 /*Ausgewählte Bezahlungsart wird angezeigt
  *Bezahlungsdaten werden eingegeben 
  */
 else if(isset($_POST['sumbit3'])) {
	include('ubpf.php');
}
// Beendung der Bestellung in dem die Bezahlungsdaten eingetragen werden.
else if(isset($_POST['sumbit4'])) {
	include('ubef.php');
}
// Die Standartseite die gelanden wird wenn nichts von dem beiden oben zutrifft.
else {
	include('ubdf.php');
}

?>