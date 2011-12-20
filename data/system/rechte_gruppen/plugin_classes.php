<?php
$plugin=$_GET['pl'];
$plugin_f=$_GET['plf'];

class pluginsystem {
	
	public function funktion($plf=$plugin_f)
	{
		include('funktion.php');
	}
	
	public function show()
	{
		include('show.php');
	}
	
	public function plugin($pl=$plugin)
	{
		
		include('plugin.php');
	}
	private function title()
	{
		include('title.php');
	}	
	
	private function meta()
	{
		include('meta.php');
	}
}

	$pluginsys = new pluginsystem();
?>