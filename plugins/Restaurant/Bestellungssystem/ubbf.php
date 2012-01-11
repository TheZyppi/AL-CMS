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
	else {
		
	if(isset($_POST['datum'])=="")
	{
		echo "Sie haben kein Datum angegeben.";
		exit;
	}
	else {
		$datum=explode( '.', $_POST['datum'] );
	}
	if(isset($_POST['uhrzeit'])=="")
	{
	echo "Sie haben keine Uhrzeit angegeben.";
	exit;
	}
	else {
	$uhrzeit=explode( ':', $_POST['uhrzeit'] );	
	}
	// Hier wird nach der normalisierung der Daten die Daten mit mktime in timestamp umgewandelt.
	$datum_u_t=mktime( $uhrzeit[4], $uhrzeit[5], 0, $datum[1], $datum[0], $datum[2] );

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
		</tr>
		</tr>
		<tr>
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
	$tichids=array();
	
	// While-Schleife zum Befüllen des Arrays
	while ($zeile = mysql_fetch_array($tischa))
		{
		array_push($tichids, $zeile['TID']);
			
		}

	$tische=mysql_query("SELECT TID, RAID, TBezeichnung, TMaxPersonen FROM Tische"); 
	
		while ($zeile2 = mysql_fetch_assoc( $tische))
		{
		if (in_array($zeile2['TID'], $tichids)) {
					
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
		<h3>Rauume:</h3>
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
	$rauuma=mysql_query("SELECT Reservierungen.RID, Reservierungen.maxtime, Reservierungen_Rauume.RID, Reservierungen_Rauume.RAID
	 FROM Reservierungen, Reservierungen_Rauume WHERE Reservierungen.RID=Reservierungen_Rauume.RID AND Reservierungen.maxtime <= ".$datum_u_t."");
	
	// Array für die RAIDs			
	$rauumids=array();
	
	// While-Schleife zum Befüllen des Arrays
	while ($zeile = mysql_fetch_array($rauuma))
		{
		array_push($rauumids, $zeile['RAID']);
			
		}
	// Räume Abfrage
	$rauume=mysql_query("SELECT RAID, Name, RBeschreibung FROM Rauume"); 
	
		while ($zeile2 = mysql_fetch_assoc($rauume))
		{
		if (in_array($zeile2['RAID'], $rauumids)) {
					
} 
	// Wenn keine Räume mehr vorhanden sind	
		else if($rauumids=="") {
		echo "Keine Räume mehr vorhanden.";	
		}
		// Hier werden die Räume angezeigt die noch frei sind.
else {
			echo '<input type="checkbox"  name="raum[]" value='. $zeile2['RAID'] .'>'. $zeile2['Name'].'  <br>';	
		}
			}
		// ENDE VON OBERABFRAGE RÄUME
		
		// ENDE VOM FORMULAR DER ABSENDE BUTTON WIRD EINGEFÜGT 
		echo '
		</td>
		</tr>
		<tr>
		<td colspan=2 align="center">
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