<?php
/*
Hauptdatei jedes Designs. Die Datei dient dazu um alle Datein in ihre verscheidenen Bereiche head, body und foot einzuteilen.
*/

/*Head*/
function head_main() {
	// Die Standart Head datei wird includiert um das ausführen des Heads ermöglichen
	include('../../system/design/head_function.php');
	// Die Head Funktion wird ausgeführt
	head();
	}

/*Body*/
function body_main() {
	include(top.php);
	}
/*Foot*/
function foot_main() {
	include();
	}
?>