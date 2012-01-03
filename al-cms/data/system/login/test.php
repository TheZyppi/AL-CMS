<?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is free software, you can you can redistribute it and/or modify
 *it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */


include "login_pruefen.php"; // Datei login_pruefen.php wird geladen
login_pruefen(); // Die Funktion login_pruefen wird ausgeführt

echo session_id();
echo $_SESSION['benutzer'];
echo "<p>";
echo $_SESSION['gruppe'];
?>
<p>
Hier steht dein geschützer Inhalt
