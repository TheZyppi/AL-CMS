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
	
	private function head_funktion($srdp)
	{
		include('head_funktion.php');
	}
	private function lower_funktion($srdp)
	{
		include('lower_funktion.php');
	}
	public function show()
	{
		include('show.php');
	}
	private function head_plugin ($srdp)
	{
		include('head_plugin.php');
	}
	private function lower_plugin ($srdp)
	{
		include('lower_plugin.php');
	}
	public function plugin($srdp)
	{	
		include('plugin.php');
	}
	private function extplugina($srdp, $plugin=0)
	{
		include('extplugin.php');
	}
	public function extplugin($srdp, $plugin=0)
	{
		$this->extplugina($srdp, $plugin);
	}
	private function funktionin($srdp, $funktion='no')
	{
		include('funktionin.php');	
	}

}
$pluginsys = new pluginsystem();
?>