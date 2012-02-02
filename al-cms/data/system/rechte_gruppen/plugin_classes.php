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

class pluginsystem {
	
	private function funktion($srdp)
	{
		include('funktion.php');
	}
	
	public function show()
	{
		include('show.php');
	}
	private function plugina ($srdp)
	{
		include('pluginm.php');
	}
	public function plugin($srdp)
	{	
		include('plugin.php');
	}
	private function extplugina ($srdp, $plugin=0)
	{
		include('extplugin.php');
	}
	public function extplugin($srdp, $plugin=0)
	{
		$this->extplugina($srdp, $plugin);
	}
}

	$pluginsys = new pluginsystem();
?>