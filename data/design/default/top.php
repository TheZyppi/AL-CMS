<?php
/*Inhaltsbereich*/
$plugin=$_GET['pl']; // Fragt nach ob ein Plugin geladen werden soll

if($plugin=="") {
	plugin(startseite); // Plugin Startseite wird standartgemäß geladen wenn keine ANgaben gemacht wurden
	}
	else { 
		plugin($plugin); // Wenn ein Plugin Angegeben wurde wird es hier geladen	
		}
		?>