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

 /*
  * Das Datum und Uhrzeit aus der UBDF.php werden wegen den Sonderzeichen erstmal "normalisiert",
  * um mit mktime weiter verarbeitet werden zu können.
  */
 	if ($_POST['datum']=="" && $_POST['uhrzeit']=="")
 	{
 		echo "Sie haben vergessen ein Datum und die Uhrzeit anzugeben.";
		exit;
 	}
	else if($_POST['datum']=="")
	{
		echo "Sie haben kein Datum angegeben.";
		exit;
	}
	else if($_POST['uhrzeit']=="") 
	{
	echo "Sie haben keine Uhrzeit angegeben.";
	exit;
	}
	else {
	$datum=explode( '.', $_POST['datum'] );
	$uhrzeit=explode( ':', $_POST['uhrzeit'] );	
	
	// Hier wird nach der normalisierung der Daten die Daten mit mktime in timestamp umgewandelt.
	$datum_u_t=mktime( $uhrzeit[0], $uhrzeit[1], 0, $datum[1], $datum[0], $datum[2] );
	$time=mktime( $uhrzeit[0], $uhrzeit[1], 0, 0, 0, 0);
	$dauer="2";
	$timer= strtotime("+". $dauer. " hours" ,$time);
//ANFANG FORMULAR FÜR DIE DATENEINGABE
$hpl=$_GET['hpl'];
echo '<form method="post" action=index.php?hpl='.$hpl.'>';
	echo '
	<table border=0 width="650">
		<tr>
		<td width="20%">
		Name:<p>
		</td>
		<td width="20%">
		<input type="text" name="name" size="40" maxlength="25">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Vorname:<p>
		</td>
		<td width="50%">
		<input type="text" name="vorname" size="40" maxlength="25">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Adresse:<p>
		</td>
		<td width="20%">
		<input type="text" name="adresse" size="40" maxlength="40">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Postleitzahl:<p>
		</td>
		<td width="20%">
		<input type="text" name="postleitzahl" size="40" maxlength="40">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Ort:<p>
		</td>
		<td width="20%">
		<input type="text" name="ort" size="40" maxlength="40">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Email:<p>
		</td>
		<td width="20%">
		<input type="text" name="email" size="40" maxlength="40">
		</td>
		</tr>
		<tr>
		<td height=20px>
		</td>
		</tr>
		<tr>
		<td colspan=2 align="center">
		<h3>Tische:</h3>
		</td>
		</tr>
		<tr>
		<td height=20px> 
		</td>
		</tr>
		<tr>
		<td colspan=2 align="center">
		';


// OBERABFRAGE VON TISCHE 
	
	

	$tische=mysql_query("SELECT TID, RAID, TBezeichnung, TMaxPersonen FROM tische"); 
	
		while ($zeile2 = mysql_fetch_assoc( $tische))
		{

			echo '<input type="checkbox"  name="tisch[]" value='.$zeile2['TID'] .'>'. $zeile2['TBezeichnung'].' '. $zeile2['TMaxPersonen'].'  <br>';	
		}
			
		
// OBERABFRAGE FÜR RÄUME

// HTML Für die Anzeige das hier die Räume aufgelistet werden
		echo '
		</td>
		</tr>
		<td colspan=2 align="center">
		<h3>Raeume:</h3>
		</td>
		</tr>
		<tr>
		<td height=20px> 
		</td>
		</tr>
		<tr>
		<td colspan=2 align="center">
		';
	
		
		

	// Räume Abfrage
	$raume=mysql_query("SELECT RAID, Name, RBeschreibung FROM raeume"); 
	
		while ($zeile2 = mysql_fetch_assoc($raume))
		{
				echo '<input type="checkbox"  name="raum[]" value='.$zeile2['RAID'] .'>'.$zeile2['Name'].'  <br>';	
		}
		// ENDE VON OBERABFRAGE RÄUME
		
		// ENDE VOM FORMULAR DER ABSENDE BUTTON WIRD EINGEFÜGT 
		echo '
		</td>
		</tr>
		<tr>
		<td colspan=2 align="center">
		<INPUT name="time" TYPE="HIDDEN" value='.$timer.'>
		<br>
		<p>
		<input type="submit" value="Absenden" name="sumbitz">
		</form>
		</td>
		</tr>
		</table>
';
	}
?>