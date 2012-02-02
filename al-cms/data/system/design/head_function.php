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

function head(&$srdp) {
	// Root Daten Pfad
	$rsp=$srdp;
	// Die login_pruefen.php wird eingefügt
include(''.$rsp.'system/login/login_pruefen.php');
	/* Die Funktion login_pruefen wird ausgeführt. Sie muss über allen HTML-Befehlen
	 * stehen, da es ansonsten zu Fehlern führen kann.
	 */
	login_pruefen();
// Fügt die Head_classes.php ein.
include('head_classes.php');
// Der Head Bereich beginnt
echo '
<!DOCTYPE xhtml PUBLIC "-//W3C//DTDB XHTML 1.0 Strict// EN" "http://www.w3.org/TR/xhtml/
  DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
';
// Meta Daten werden gelanden
$objhead->meta($rsp);
// Title wird angezeigt
$objhead->title($rsp);
// CSS Scripte für das Design werden gelanden
$objhead->css_script($rsp);
echo'
</head>
';

	
	}
?>