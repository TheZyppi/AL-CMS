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

 // Standart Root Data Pfad
define('ON_ALCMS', true);
$srdp="data/";

// Include Datein
include(''.$srdp.'config/dbcon.php'); // Der Datenbank-Connctor wird eingefügt
include(''.$srdp.'system/design/design.php'); //Designsystem wird reingeladen

// Der Headbereich wird ausgeführt.
head($srdp);
// Body-Bereich
body($srdp);
?>