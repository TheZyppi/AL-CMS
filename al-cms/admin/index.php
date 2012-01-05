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

/*
Standartindex-Adminpanel-Datei
*/

 // Standart Root Data Pfad
$srdp="../data/";

/*
 * Da das Adminpanel ein Standartdesign beseitzt wird nicht das eigentliche Designsystem gelanden sondern
 * jeglich das Standartdesign vom Adminpanel. 
 */

// Datein die für das Adminpanel wichtig sind werden reingeladen
include(''.$srdp.'config/dbcon.php'); // Der Datenbank-Connctor wird eingefügt
include(''.$srdp.'system/admin/head.php'); // Head wird reingeladen
include(''.$srdp.'system/admin/body.php'); // Body wird reingelanden

// Funktionen werden ausgeführt
head_admin($srdp); // Header vom Adminpanel wird ausgeführt
body_admin($srdp); // Body vom Adminpanel wird ausgeführt
?>