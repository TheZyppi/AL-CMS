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
	
	$date=explode( '.', $_POST['datum'] );
	$anfang=explode( ':', $_POST['anfang']);
	$ende=explode( ':', $_POST['ende'] );
	
	$datetime=mktime( 0, 0, 0, $date[1], $date[0], $date[2]);
	$anfangtime=mktime( $anfang[0], $anfang[1], 0, 0, 0, 0);
	$endetime=mktime( $ende[0], $ende[1], 0, 0, 0, 0);
	
	$seintragen="INSERT INTO sendeplan (dj, showname, time, end, date) VALUES ('".$_POST['dj']."', '".$_POST['showname']."', '".$anfangtime."', '".$endetime."', '".$datetime."')";
 	$sa=mysql_query($seintragen) or die (mysql_error());
	$ausgabe='Erfolgreich eingetragen. Datum: '.date("d.m.Y", $datetime).' Anfang: '.date("H:i", $anfangtime).' Ende: '.date("H:i", $endetime).' ';
	mysql_close();
	echo $ausgabe;
	}
}
else {
	echo '<form method="post" action="'; print $_SERVER['PHP_SELF']; echo'">';
	echo '
	<table border=0 width="650">
		<tr>
		<td width="20%">
		DJ:<p>
		</td>
		<td width="20%">
		<input type="text" name="dj" size="40" maxlength="25">
		</td>
		</tr>
		<td width="20%">
		Show-Name:<p>
		</td>
		<td width="20%">
		<input type="text" name="showname" size="40" maxlength="25">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Anfang:<p>
		</td>
		<td width="20%">
		<input type="text" name="anfang" size="40" maxlength="25">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Ende:<p>
		</td>
		<td width="20%">
		<input type="text" name="ende" size="40" maxlength="25">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Datum:<p>
		</td>
		<td width="20%">
		<input type="text" name="datum" size="40" maxlength="25">
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