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

function news_delete()
{
	if(isset($_GET['nid'])=="")
	{
		echo "No News ID.";
	}
	else {
		$checka=mysql_query("SELECT NID FROM news WHERE NID='".mysql_real_escape_string($_GET['nid']."'"));
		if(! $checka)
		{
			
		}
		else {
	$row=mysql_fetch_array($checka);
	if($rowd['NID']!=$_GET['nid'])
			{
				echo "Error no NID ".$_GET['nid']." found!";
				exit;
			}
	else {
		$dela="DELETE FROM news WHERE NID='".mysql_real_escape_string($_GET['nid'])."'";
		$delq=mysql_query($dela);
		if(! $delq)
		{
			echo "Error can't delete the News.";
		}
		else {
			echo "Succses!";
		}
	}
	}
	}
}
?>