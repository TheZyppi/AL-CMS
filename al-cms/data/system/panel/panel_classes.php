<?php

class panel {
	
	private function menu_head($srdp)
	{
		include('menu_head.php');
	}
	public function panel_index($srdp)
	{
		
	}
	private function plf($srdp)
	{
		include('plf.php');
	}
}
$panelsys= new panel();
?>