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

 function site_add()
 {
if(isset($_POST['site_add']))
	{
		if($_POST['title']=="")
		{
			echo "Error: No Titlename.";
			exit;
		}
		else if($_POST['site']=="")
		{
			echo "Error: No Text.";
			exit;
		}
		else {
			$time=time();
		$na=mysql_query("INSERT INTO site (title, text, date) VALUES ('".mysql_real_escape_string($_POST['title'])."', '".mysql_real_escape_string($_POST['site'])."', ".mysql_real_escape_string($time).")");
		echo "Sucsess!";	
		}
	}
	else {
 	echo '<form method="post" action="index.php?hpl='.$_GET['hpl'].'&plf='.$_GET['plf'].'">
<table border=0 width=650>
<tr>
<td>
Titel:
</td>
<td>
<input type="text" name="title" size="40">
</td>
<tr>
<td colspan=2>
Text:
</td>
</tr>
<tr>
<td colspan=2>
<textarea name="site" rows=20 cols=50 maxlength=1600></textarea>
</td>
</tr>
<tr>
<td colspan=2 align=center>
<br>
<p>
<input type=submit value=speichern name=site_add>
</form>
</td>
</tr>
</table>';
	}
 }
?>