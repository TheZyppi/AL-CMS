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
function news_admin($srdp, $testnid)
{

     echo '<a href="index.php?hpl=4&plf=news_edit&nid='.mysql_real_escape_string($testnid).'">Bearbeiten</a> <a href="index.php?hpl=4&plf=news_delete&nid='.mysql_real_escape_string($testnid).'">Loeschen</a>';
 
}
?>