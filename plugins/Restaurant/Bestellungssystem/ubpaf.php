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
  * Eintragen von den Benutzerdaten aus dem ubbf.php Formular. 
  */
 if (isset($_POST['tisch'])=="" && isset($_POST['raum'])=="" && isset($_POST['name'])=="" && isset($_POST['vorname'])=="" && isset($_POST['postleitzahl'])=="" && isset($_POST['ort'])=="" && isset($_POST['adresse'])=="" && isset($_POST['email']))
 {
 	echo "Sie haben nichts angegeben.";
	exit;
 }
 else if (isset($_POST['name'])=="")
 {
 echo "Sie haben vergessen ihren Namen anzugeben.";
 exit;	
 }
 else if (isset($_POST['vorname'])=="")
 {
 echo "Sie haben vergessen ihren Vornamen anzugeben.";
 exit;	
 }
 else if (isset($_POST['postleitzahl'])=="")
 {
 echo "Sie haben vergessen ihre Postleitzahl anzugeben.";
 exit;	
 }
 else if (isset($_POST['ort'])=="")
 {
 echo "Sie haben vergessen ihren Ort anzugeben.";
 exit;	
 }
 else if (isset($_POST['adresse'])=="")
 {
 echo "Sie haben vergessen ihre Adresse anzugeben.";
 exit;	
 }
 else if (isset($_POST['email'])=="")
 {
 echo "Sie haben vergessen ihre Email-Adresse anzugeben.";
 exit;	
 }
 else {
 	
	/*
  	* Eintragen der Reservierung
  	*/
 	$time=$_POST['time'];
 	$ipadresse =$_SERVER['REMOTE_ADDR']; 
 	$session=session_id();
 
 	// Benutzerdaten werden gesammelt
 	$name=$_POST['name'];
	$vorname=$_POST['vorname'];
	$plz=$_POST['postleitzahl'];
	$ort=$_POST['ort'];
	$adresse=$_POST['adresse'];
	$email=$_POST['email'];
	
 	$reintragen="INSERT INTO reservierungen (Session_ID, IP_Adresse, maxtime, U_N) VALUES ('".$session."', '".$ipadresse."', '".$time."', '1')";
 	$pr=mysql_query($reintragen) or die (mysql_error());
	
	//Reservierungs-ID wird abgefragt
	$rida=mysql_insert_id();
	
	// Eintragen der Benutzer-Daten
	$rnreintragen="INSERT INTO reservierungen_non_reg (RID, RName, RVorname, ROrt, RPLZ, RAdresse, Email) VALUES ('".$rida."', '".$name."', '".$vorname."', '".$ort."', '".$plz."', '".$adresse."', '".$email."')";
 	$pr2=mysql_query($rnreintragen) or die (mysql_error());
	
	
  if (isset($_POST['tisch'])=="") {
  	echo "Sie haben keinen Tisch ausgewählt.";
	exit; 
 }
 else {
     foreach($_POST['tisch'] as $tisch)
{
$eintrag="INSERT INTO reservierungen_tisch(RID, TID)
VALUES ('".$rida."', '".$tisch."')";
mysql_query($eintrag) or die (mysql_error());
}
 }
 
 // Eintragen des Raums
 if (isset($_POST['raum'])=="") {
     
 }
 else {
     foreach($_POST['raum'] as $raum)
{
$eintrag2="INSERT INTO reservierungen_raeume(RID, RAID)
VALUES ('".$rida."', '".$raum."')";
mysql_query($eintrag2) or die (mysql_error());
}
 }
 
 		echo '<form method="post" action="';print $_SERVER['PHP_SELF']; echo'>';
		echo '<table border=0 width="650">
		<tr>
		<td width="20%">
		Bezahlungsarten::<p>
		</td>
		</tr>
		<tr>
		<td>';
		
 		$paa="SELECT * FROM bezahlung_arten";
		$db_erg = mysql_query( $paa );
		if ( ! $db_erg )
		{	
  		die('Ungültige Abfrage: ' . mysql_error());
		}
		while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
		{
		echo '<input type="radio" name="bezahlung" value='. $zeile['BAID'] .'>'. $zeile['BAName'].' <br>';	
		}
		echo '
		</td>
		</tr>
		<tr>
		<td>
		<input type="submit" value="Weiter" name="submit3">
		</td>
		</tr>
		</form>
		</table>
		';	
 }
?>