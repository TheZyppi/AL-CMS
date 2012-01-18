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
 	if (isset($_POST['datum'])=="" && isset($_POST['uhrzeit'])=="")
 	{
 		echo "Sie haben vergessen ein Datum und die Uhrzeit anzugeben.";
		exit;
 	}
	else if(isset($_POST['datum'])=="")
	{
		echo "Sie haben kein Datum angegeben.";
		exit;
	}
	else if(isset($_POST['uhrzeit'])=="") 
	{
	echo "Sie haben keine Uhrzeit angegeben.";
	exit;
	}
	else {
	$datum=explode( '.', $_POST['datum'] );
	$uhrzeit=explode( ':', $_POST['uhrzeit'] );	
	
	// Hier wird nach der normalisierung der Daten die Daten mit mktime in timestamp umgewandelt.
	$datum_u_t=mktime( $uhrzeit[0], $uhrzeit[1], $uhrzeit[2], $datum[1], $datum[0], $datum[2] );
	$time=mktime( $uhrzeit[0], $uhrzeit[1], $uhrzeit[2], 0, 0, 0);
	$dauer="2";
	$timer= strtotime("+". $dauer. " hours" ,$time);
//ANFANG FORMULAR FÜR DIE DATENEINGABE
echo '<form method="post" action="'; print $_SERVER['PHP_SELF']; echo'">';

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
		<h3>Art des Zimmers</h3>
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
	
	// Abfrage um herauszufinden, welche Resavierungen es an dem Tag für welchen Tisch gab und welche frei sind.
	$tischa=mysql_query("SELECT Reservierungen.RID, Reservierungen.maxtime, Reservierungen_Tisch.RID, Reservierungen_Tisch.TID
	 FROM Reservierungen, Reservierungen_Tisch WHERE Reservierungen.RID=Reservierungen_Tisch.RID AND Reservierungen.maxtime <= ".$datum_u_t."");
	
	// Array für die TIDs			
	$tischids=array();
	
	// While-Schleife zum Befüllen des Arrays
	while ($zeile = mysql_fetch_array($tischa))
		{
		array_push($tichids, $zeile['TID']);
			
		}

	$tische=mysql_query("SELECT TID, RAID, TBezeichnung, TMaxPersonen FROM Tische"); 
	
		while ($zeile2 = mysql_fetch_assoc( $tische))
		{
		if (in_array($zeile2['TID'], $tischids)) {
					
} 
		
		else if($tischids=="") {
		echo "Keine Tische mehr vorhanden.";	
		}
else {
			echo '<input type="checkbox"  name="tisch[]" value='. $zeile2['TID'] .'>'. $zeile2['TBezeichnung'].' '. $zeile2['TMaxPersonen'].'  <br>';	
		}
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
	
		
		
	// Abfrage um herauszufinden, welche Resavierungen es an dem Tag für welche Räume gab und welche frei sind.
	$rauma=mysql_query("SELECT Reservierungen.RID, Reservierungen.maxtime, Reservierungen_Raeume.RID, Reservierungen_Raeume.RAID
	 FROM Reservierungen, Reservierungen_Raeume WHERE Reservierungen.RID=Reservierungen_Raeume.RID AND Reservierungen.maxtime <= ".$datum_u_t."");
	
	// Array für die RAIDs			
	$raumids=array();
	
	// While-Schleife zum Befüllen des Arrays
	while ($zeile = mysql_fetch_array($rauma))
		{
		array_push($raumids, $zeile['RAID']);
			
		}
	// Räume Abfrage
	$raume=mysql_query("SELECT RAID, Name, RBeschreibung FROM Raeume"); 
	
		while ($zeile2 = mysql_fetch_assoc($raume))
		{
		if (in_array($zeile2['RAID'], $raumids)) {
					
} 
	// Wenn keine Räume mehr vorhanden sind	
		else if($raumids=="") {
		echo "Keine Räume mehr vorhanden.";	
		}
		// Hier werden die Räume angezeigt die noch frei sind.
else {
			echo '<input type="checkbox"  name="raum[]" value='.$zeile2['RAID'] .'>'. $zeile2['Name'].'  <br>';	
		}
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
		<input type="submit" value="Absenden" name="submit2">
		</form>
		</td>
		</tr>
		</table>
';
	}


?>