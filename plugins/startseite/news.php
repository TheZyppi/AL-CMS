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

function news_lesen()
{
$nid=$_GET['nid'];
	db_con();
$query="SELECT * FROM news WHERE NID = ".mysql_real_escape_string($nid)."";
$result=mysql_query($query) or die(mysql_error());
$reihe = mysql_fetch_array($result, MYSQL_ASSOC) or die (mysql_error());	

echo '<table border=0>
			<tr>
			<td>';
		echo ''.$reihe['NID'].' '.$reihe['title'].'</a>';
		echo '</td></tr><tr>
		<td>
		'.$reihe['text'].'
		</td>
		</tr>
		</table>';
}
?>