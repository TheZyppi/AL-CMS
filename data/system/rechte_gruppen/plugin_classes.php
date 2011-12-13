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
	public function title($pl=$plugin)
	{
		include('title.php');
	}	
}

	$pluginsys = new pluginsystem();
?>