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

 // Funktion Head_admin 
function head_admin(&$srdp)
{
	// Root Daten Pfad
	$rsp=$srdp;
	// Datein für den Header werden reingeladen
	
	// Die login_pruefen.php wird eingefügt
include(''.$rsp.'system/login/login_pruefen.php');
	
	// Funktion login_pruefen wird ausgeführt
	login_pruefen();
	
	//HTML Head Struktur fängt an
echo '<!DOCTYPE xhtml PUBLIC "-//W3C//DTDB XHTML 1.0 Strict// EN" "http://www.w3.org/TR/xhtml/
DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>';
include(''.$rsp.'system/admin/meta.php'); // Meta Daten vom Adminpanel werden reingeladen
echo '<title>Admin-Panel</title>'; // Titel des Admin-Panels
include(''.$rsp.'system/admin/css/index.php'); // CSS Scripte werden reingeladen
echo '</head>'; // Head Ende
}
?>