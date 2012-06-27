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
	return	require_once('head_funktion.php');
	}
	private function lower_funktion($srdp)
	{
	return	require_once('lower_funktion.php');
	}
	public function show()
	{
	return	require_once('show.php');
	}
	private function head_plugin ($srdp)
	{
	return require_once('head_plugin.php');
	}
	private function lower_plugin ($srdp)
	{
	return	require_once('lower_plugin.php');
	}
	public function plugin($srdp)
	{	
	return require_once('plugin.php');
	}
	private function extplugina($srdp, $plugin=0)
	{
	return	require_once('extplugin.php');
	}
	public function extplugin($srdp, $plugin=0)
	{
	return	$this->extplugina($srdp, $plugin);
	}
	public static function funktionin($srdp, $funktion='no', $h_or_l='', $head_plugin='no', $lower_plugin='no', $s='')
	{
	return	require_once('funktionin.php');	
	}


}
$pluginsys = new pluginsystem();
?>