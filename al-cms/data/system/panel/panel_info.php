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
// Data-Right-Security-Open-Check
if (!defined('ON_ALCMS') || isset($_SESSION['group'])=="")
{
	echo "Error: You are not use ALCMS!";
	exit;
}
else {
 $lpl=$_GET['lpl'];
 $pinfo=mysql_query("SELECT PID, LPLID, name, data, sp, aktiv FROM panel WHERE LPLID='".$lpl."'");
 $row=mysql_fetch_array($pinfo);
 echo 'Welcome in the '.$row['name'].'.<p> ID: '.$row['PID'].'<br> Path: '.$row['data'].'<br>';
 if($row['sp']==1)
 {
 	echo "Spezial Panel: Yes";
 }
 else {
     echo "Sepzial Panel: No";
}
}
?>