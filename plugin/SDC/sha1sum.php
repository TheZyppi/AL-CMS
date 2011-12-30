<?php

/*
 * SHA1SUM Dient dazu um von jeder Datei des AL-CMS eine SHA1 Summe zu bilden
 * um Veränderungen am System zu bemerken. 
 */

 
 if($datei!=$dateipfad)
 {
 	// Dient dazu einen SHA1 Hash von der Datei zu machen und dann in der Datenbank abzuspeichern.
 	sha1_file($dateipf);
	 
 }
 

?>