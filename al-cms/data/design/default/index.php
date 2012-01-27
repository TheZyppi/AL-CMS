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
Hauptdatei jedes Designs. Die Datei dient dazu um alle Datein in ihre verscheidenen Bereiche head und body einzuteilen.
*/ 

/*
 * Es gibt keine Head da der bereits in der Design.php automatisch generiert wird.
 * Zu finden unter /data/system/design finden.
 * 
 */

/*Body*/
function body(&$srdp) {
	//include(''.$srdp.'system/rechte_gruppen/plugin_classes.php'); // Plugin-System wird reingelanden
	include('top.php');
	}
?>