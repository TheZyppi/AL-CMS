<?php

class pluginsystem {


	public function funktion()
	{
		include('funktion.php');
	}
	
	public function show()
	{
		include('show.php');
	}
	
	public function plugin()
	{
		
		include('plugin.php');
	}

}

	$pluginsys = new pluginsystem();
?>