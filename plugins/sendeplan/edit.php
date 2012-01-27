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

if(isset($_POST['submit']))
{
	if($_POST['dj']=="" && $_POST['showname']=="" && $_POST['anfang']=="" && $_POST['ende']=="" && $_POST['datum']=="")
	{
		echo "Sie haben keine Daten eingegebn.";
	}
	else if ($_POST['dj']=="")
	{
		echo "Sie haben nicht ihren Namen angegeben.";
	}
	else if ($_POST['showname']=="")
	{
		echo "Sie haben nicht den Shownamen angegeben.";
	}
	else if ($_POST['anfang']=="")
	{
		echo "Sie haben nicht die Anfangszeit angegeben.";
	}
	else if ($_POST['ende']=="")
	{
		echo "Sie haben nicht das Ende angegeben.";
	}
	else if ($_POST['datum']=="")
	{
		echo "Sie haben nicht das Datum angegeben.";
	}
	else {
		
	db_con();
	$said=$_GET['said'];
	$date=explode( '.', $_POST['datum'] );
	$anfang=explode( ':', $_POST['anfang']);
	$ende=explode( ':', $_POST['ende'] );
	
	$datetime=mktime( 0, 0, 0, $date[1], $date[0], $date[2]);
	$anfangtime=mktime( $anfang[0], $anfang[1], 0, 0, 0, 0);
	$endetime=mktime( $ende[0], $ende[1], 0, 0, 0, 0);
	
	$seintragen="UPDATE sendeplan SET dj='".$_POST['dj']."', showname='".$_POST['showname']."', time='".$anfangtime."', end='".$endetime."', date='".$datetime."' WHERE SAID='".$said."'"; 
 	$sa=mysql_query($seintragen) or die (mysql_error());
	$ausgabe='Erfolgreich eingetragen. Datum: '.date("d.m.Y", $datetime).' Anfang: '.date("H:i", $anfangtime).' Ende: '.date("H:i", $endetime).' ';
	mysql_close();
	echo $ausgabe;
	}
}
else {
	$said=$_GET['said'];
	
	db_con();
$query="SELECT * FROM sendeplan WHERE SAID = ".mysql_real_escape_string($said)."";
$result=mysql_query($query) or die(mysql_error());
$reihe = mysql_fetch_array($result, MYSQL_ASSOC) or die (mysql_error());	

$dj=$reihe['dj'];
$showname=$reihe['showname'];
$time=date("H:i", $reihe['time']);
$end=date("H:i", $reihe['end']);
$date=date("d.m.Y", $reihe['date']);

print("<form method=post action=edit.php?said=");
 		print(htmlspecialchars($said));
  		print(">");
		
	echo '
	<table border=0 width="650">
		<tr>
		<td width="20%">
		DJ:<p>
		</td>
		<td width="20%">
		<input type="text" name="dj" size="40" value='.$dj.'>
		</td>
		</tr>
		<td width="20%">
		Show-Name:<p>
		</td>
		<td width="20%">
		<input type="text" name="showname" size="40" value='.$showname.'>
		</td>
		</tr>
		<tr>
		<td width="20%">
		Anfang:<p>
		</td>
		<td width="20%">
		<input type="text" name="anfang" size="40" value='.$time.'>
		</td>
		</tr>
		<tr>
		<td width="20%">
		Ende:<p>
		</td>
		<td width="20%">
		<input type="text" name="ende" size="40" value='.$end.'
		</td>
		</tr>
		<tr>
		<td width="20%">
		Datum:<p>
		</td>
		<td width="20%">
		<input type="text" name="datum" size="40" value='.$date.'>
		</td>
		</tr>
		<tr>
		<td>
		<input type="submit" value="Absenden" name="submit">
		</form>
		</td>
		</tr>
	</table>';
}
?>