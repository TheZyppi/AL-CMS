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
$lpl=$_GET['lpl'];
$panel_head_a1="SELECT PMHID, LPLID FROM panel_menu_head_plugin WHERE LPLID=".$lpl."";
$panel_head_q1=@mysql_query($panel_head_a1);
if(!$panel_head_q1)
{
	echo "The Panel havent a Menu.";
}
else {
	$reihe=mysql_fetch_array($panel_head_q1);
	$panel_head_a2="SELECT PMHID, name FROM panel_menu_head WHERE PMHID=".$reihe['PMHID']."";
	$panel_head_q2=mysql_query($panel_head_a2);
	if(!$panel_head_q2)
	{
		echo "No Menu have found for the Panel.";
	}
	else {
	$reihe2=mysql_fetch_array($panel_head_q2);
	$panel_head_a3="SELECT PMHID, name, url, class FROM panel_menu_head_hp FROM PMHID PMHID=".$reihe2['PMHID']."";
	$panel_head_q3=mysql_query($panel_head_a3);
	if(!$panel_head_q3)
	{
		echo "No Menu Points are found.";
	}	
	else {
		while($row = @mysql_fetch_object($panel_head_q3))
		{
			if($row->class!="")
			{
				echo '<td><a href="'.$row->url.'" class="'.$row->class.'">'.$row->name.'</a></td>';
			}
			else {
			echo '<td><a href="'.$row->url.'">'.$row->name.'</a></td>';
			}
		}
	}
	}
}
?>