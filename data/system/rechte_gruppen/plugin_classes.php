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
	private function title()
	{
		include('title.php');
	}
	
	public function stitle()
	{
		$this->title();
	}
	
	private function meta()
	{
		include('meta.php');
	}
}

	$pluginsys = new pluginsystem();
?>