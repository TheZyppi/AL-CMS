<?php
// Data-Right-Security-Open-Check
if (!defined('ON_ALCMS') || isset($_SESSION['group'])=="")
{
	echo "Error: You are not use ALCMS!";
	exit;
}
else {
class panel {
	
	private function menu_head($srdp)
	{
		include('menu_head.php');
	}
	public function panel_index($srdp)
	{
		include('panel_index.php');
	}
	private function plf($srdp)
	{
		include('plf.php');
	}
	private function panel_info($srdp)
	{
		include('panel_info.php');
	}
}
$panelsys= new panel();
}
?>