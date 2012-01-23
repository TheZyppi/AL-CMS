<?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is a free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */

db_con();
$query="SELECT * FROM sendeplan";
		$db_erg2 = mysql_query( $query);
		if ( ! $db_erg2 )
		{	
  		die('Ungültige Abfrage: ' . mysql_error());
		}

			
while ($zeile2 = mysql_fetch_array( $db_erg2))
		{
			echo '<table border=0>
			<tr>
			<td>';
		echo '<a href="edit.php?said='.$zeile2['SAID'].'">'.$zeile2['SAID'].' '.$zeile2['showname'].'</a>';
		echo '</td>
		<td>
		<a href="delete.php?said='.$zeile2['SAID'].'">Loeschen</a>
		</td>
		</tr></table>';
		}	

?>