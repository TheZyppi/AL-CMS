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

function news_edit()
{
	if(isset($_POST['edit_news']))
	{
		if($_POST['title']=="")
		{
			echo "Error: No Titlename.";
			exit;
		}
		else if($_POST['text']=="")
		{
			echo "Error: No Text.";
			exit;
		}
		else {
		$una=mysql_query("UPDATE news SET title='".$_POST['title']."', text='".$_POST['text']."' WHERE NID='".$_GET['nid']."'");
			echo "Updated secssusfull.";
		}
	}
	else {
	if(isset($_GET['nid'])=="")
	{
		echo "No News ID.";
	}
	else {
		$checka=mysql_query("SELECT NID FROM news WHERE NID='".mysql_real_escape_string($_GET['nid'])."'");
		if(! $checka)
		{
			echo "Error: Wrong NID!";
			exit;
		}
		else {
	$rowd=mysql_fetch_array($checka);
	if($rowd['NID']!=$_GET['nid'])
			{
				echo "Error no NID ".$_GET['nid']." found!";
				exit;
			}
	else {
		$na=mysql_query("SELECT NID, title, text, date FROM news WHERE NID='".mysql_real_escape_string($_GET['nid'])."'");
		if(! $na)
		{
		echo "Error no News ID ".$_GET['nid']." found!";	
		}
		$naa=mysql_fetch_array($na);
	echo '<form method="post" action="index.php?hpl='.$_GET['hpl'].'&plf='.$_GET['plf'].'&nid='.$_GET['nid'].'">
<table border=0 width=650>
<tr>
<td>
Titel:
</td>
<td>
<input type="text" name="title" size="40" value="'.$naa['title'].'">
</td>
<tr>
<td colspan=2>
Text:
</td>
</tr>
<tr>
<td colspan=2>
<textarea name="text" rows=20 cols=50 maxlength=1600>'.$naa['text'].'</textarea>
</td>
</tr>
<tr>
<td colspan=2 align=center>
<br>
<p>
<input type=submit value=speichern name=edit_news>
</form>
</td>
</tr>
</table>';
	}
	}
	}
	}
}
?>