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


class pluginsystem {
	
	public function funktion($srdp)
	{
		include('funktion.php');
	}
	
	public function show()
	{
		include('show.php');
	}
	
	public function plugin($srdp)
	{	
		include('plugin.php');
	}

}

	$pluginsys = new pluginsystem();
?>