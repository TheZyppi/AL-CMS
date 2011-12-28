<?php
/*
Standartindex-Datei
*/

/*
 *Standart Root DATA Pfad
 * Das ist der Standartpfad der in jeder Index Datei egal in welchem Ordner sie liegt
 * passend angegeben werden muss, damit die Daten geladen werden könne.
 * Heißt:
 * Das Designsystem, Plugin-, Funktionssystem und Gruppen und Rechtesystem sind davon abhängig.
 *  
 */
$srdp="data/";

// Include Datein
include('/data/system/design/design.php');
// Der Headbereich wird ausgeführt.
head();
// Body-Bereich
body();
// Foot-Bereich
foot();
?>