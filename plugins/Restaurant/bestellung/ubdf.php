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
$hpl=$_GET['hpl'];
echo '<form method="post" action=index.php?hpl='.$hpl.'>';
echo '<table border=0 width="650">
<tr>
		<td width="20%">
		Datum:<p>
		</td>
		<td width="20%">
		<input type="text" name="datum" size="40">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Uhrzeit:<p>
		</td>
		<td width="20%">
		<input type="text" name="uhrzeit" size="40">
		</td>
		</tr>
		<tr>
		<td>
		<input type="submit" value="Weiter" name="submite">
		</form>
		</td>
		</tr>
</table>
';
 
 
?>