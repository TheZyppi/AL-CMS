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
//$pl=$_GET['pid'];
db_con();
$query="SELECT * FROM news";
		$db_erg2 = mysql_query( $query);
		if ( ! $db_erg2 )
		{	
  		die('Ungültige Abfrage: ' . mysql_error());
		}

		echo '<table border=0>';	
while ($zeile2 = mysql_fetch_array( $db_erg2))
		{
			echo '
			<tr>
			<td>';
		echo '<a href="index.php?pl=1&plf=news_lesen&nid='.$zeile2['NID'].'">'.$zeile2['NID'].' '.$zeile2['title'].'</a>';
		echo '</td></tr><tr>
		<td>
		'.$zeile2['text'].'
		</td>
		</tr>';
		}	
echo '</table>';
?>