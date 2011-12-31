<?php
/*
Standartindex-Datei
*/

/*
 * WICHTIG FÜR ALLE ENTICKLER!
 * 
 *Standart Root DATA Pfad
 * Das ist der Standartpfad der in jeder Index Datei egal in welchem Ordner sie liegt
 * passend angegeben werden muss, damit die Daten geladen werden könne.
 * Heißt:
 * Das Designsystem, Plugin-, Funktionssystem und Gruppen und Rechtesystem sind davon abhängig.
 *  
 */
$srdp="data/";

// Include Datein
include(''.$srdp.'config/dbcon.php'); // Der Datenbank-Connctor wird eingefügt
include(''.$srdp.'system/design/design.php'); //Designsystem wird reingeladen
//include(''.$srdp.'system/rechte_gruppen/plugin_classes.php'); // Plugin-System wird reingelanden

// Der Headbereich wird ausgeführt.
head($srdp);
// Body-Bereich
body($srdp);
?>