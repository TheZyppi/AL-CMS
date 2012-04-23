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

 function site_read()
 {
 	if(isset($_GET['stid'])=="")
	{
		echo "Error: No Side ID.";
	}
	else {
		$na=mysql_query("SELECT STID, title, text, date FROM site WHERE STID='".mysql_real_escape_string($_GET['stid'])."'");
		$naa=mysql_fetch_array($na);
		if($_GET['stid']!=$naa['STID'])
		{
			echo "Error: No site found!";
			exit;
		}
		else {
			echo '
			<table border="0" width="650">
			<tr>
			<td>
			'.$naa['text'].'
			</td>
			</tr>
			</table>
			';
		}
	}
 }
?>