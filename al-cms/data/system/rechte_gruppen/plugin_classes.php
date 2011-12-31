<?php

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