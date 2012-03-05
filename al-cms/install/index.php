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

 if(isset($_POST['installdb']))
 {
include ('install_db.php');
 }
 else if (isset($_POST['installconfig']))
 {
 	if($_POST['db']=="")
	{
		echo "No Database";
		exit();
	}
	else if ($_POST['user']=="")
	{
		echo "No User";
		exit();
	}
	else if ($_POST['adress']=="")
	{
		echo "No Adress";
		exit();
	}
	else {
		$ada=$_POST['adress'];
		$usera=$_POST['user'];
		$passa=$_POST['passwort'];
	$mysqlcon=@mysql_connect($ada, $usera, $passa);
		if(!$mysqlcon)
		{
			echo "NO MYSQL CONNECTION.";
			exit();
		}
		else {
			$dba=$_POST['db'];
			$dbcon=mysql_select_db($dba);
		if(! $dbcon)
		{
			echo "NO DATABASE CONNECTION.";
			exit();
		}
		else {
 	include('installconfig.php');
		}
		}
	}
 }
 else if(isset($_POST['senttings']))
 {
 	include('senttings.php');
 }
 else if(isset($_POST['installsenttings']))
 {
 	include('installsenttings.php');
 }
 else if(isset($_POST['madeuser']))
 {
 	include('madeuser.php');
 }
 else if(isset($_POST['installmadeuser']))
 {
 	include('installmadeuser.php');
 }
 else {
     echo '<form method="post" action='; print $_SERVER['PHP_SELF']; echo ' >';
     
echo '<table border=0 width="650">
<tr>
		<td width="20%">
		Adress:<p>
		</td>
		<td width="20%"> 
		<input type="text" name="adress" size="40">
		</td>
		</tr>
		<tr>
		<tr>
		<td width="20%">
		User:<p>
		</td>
		<td width="20%"> 
		<input type="text" name="user" size="40">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Passwort:<p>
		</td>
		<td width="20%"> 
		<input type="text" name="passwort" size="40">
		</td>
		</tr>
		<td width="20%">
		Database:<p>
		</td>
		<td width="20%"> 
		<input type="text" name="db" size="40">
		</td>
		</tr>
		<tr>
		<td>
		<input type="submit" value="Weiter" name="installconfig">
		</form>
		</td>
		</tr>
</table>';
 }
 ?>