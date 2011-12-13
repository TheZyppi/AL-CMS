<?php
function head_html()
{
	// Dient zum Überprüfen ob der Benutzer eingeloggt ist oder nicht
	include('../login/login_pruefen.php');
	login_pruefen();
// Fügt die Head_classes.php ein.
include('head_classes.php');
// Der Head Bereich beginnt
echo '
<head>
';
$objhead->meta();
echo "<title>".$objhead->title(), $pltitle."</title>";
$objhead->css_script();
echo'
</head>
';


	
}


?>