<?php

function head() {
	// Die login_pruefen.php wird eingefügt
//	include('../login/login_pruefen.php');
	/* Die Funktion login_pruefen wird ausgeführt. Sie muss über allen HTML-Befehlen
	 * stehen, da es ansonsten zu Fehlern führen kann.
	 */
	//login_pruefen();
// Fügt die Head_classes.php ein.
include('head_classes.php');
// Der Head Bereich beginnt
echo '
<!DOCTYPE xhtml PUBLIC "-//W3C//DTDB XHTML 1.0 Strict// EN" "http://www.w3.org/TR/xhtml/
  DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
';
//$objhead->meta();
//echo "<title>".$objhead->title()."</title>";
$objhead->css_script();
echo'
</head>
';


	
	}
?>