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
 * SHA1SUM Dient dazu um von jeder Datei des AL-CMS eine SHA1 Summe zu bilden
 * um Veränderungen am System zu bemerken. 
 */

 
 if($datei!=$dateipfad)
 {
 	// Dient dazu einen SHA1 Hash von der Datei zu machen und dann in der Datenbank abzuspeichern.
 	sha1_file($dateipf);
	 
 }
 

?>