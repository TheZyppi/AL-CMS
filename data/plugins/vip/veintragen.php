<?php

if ($user->data['is_registered'])
    {
    	if ($auth->acl_get('a_') || $auth->acl_getf_global('m_'))
{

if ($auth->acl_get('a_'))
{
	
$vbids=$_GET['vbid'];
$userid=$user->data['user_id'];
	
	//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
      
$abfrage1="SELECT vip_bestellungen.vbid, vip_bestellungen.sid, vip_bestellungen.v_user_id, vip_bestellungen.v_name, vip_bestellungen.v_nachname, vip_bestellungen.v_email, vip_bestellungen.vdate, vip_angebote.vaid, vip_angebote.vatitle, vip_angebote.vapreis, vip_angebote.vadauer, vip_bestellungen_liste.vbid, vip_bestellungen_liste.vaid
FROM  vip_bestellungen, vip_angebote, vip_bestellungen_liste
WHERE vip_bestellungen.vbid = vip_bestellungen_liste.vbid
AND vip_angebote.vaid = vip_bestellungen_liste.vaid
AND vip_bestellungen.vbid ='$vbids'";


$db_erg6 = mysql_query( $abfrage1 );
if ( ! $db_erg6 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
while ($a1 = mysql_fetch_array( $db_erg6, MYSQL_ASSOC))
{	
$dauer=$a1['vadauer'];
$benutzerid=$a1['v_user_id'];
}
$abfrage2="SELECT * FROM vip_benutzer WHERE v_u_user_id=$benutzerid";
$db_erg7 = mysql_query( $abfrage2 );
if ( ! $db_erg7 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
while ($a2 = mysql_fetch_array( $db_erg7, MYSQL_ASSOC))
{	
$benutzerids=$a2['v_u_user_id'];
$vvipid=$a2['vipid'];
$vedate=$a2['edate'];
$vvbid=$a2['vbid'];
}
if ($benutzerids==$benutzerid)// Wenn das zutrifft ist der Benutzer bereits als VIP regestreiert und der Account wird nur geupdatet.
{
if ($dauer==0) // Wenn man Lebenslänglich bestellt hat muss kein Datum für das Ende des VIP Accounts berechnet werden.
{
	
	if ($vbids==$vvbid)
	{
		echo "
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Eingetragen</h2></div>
  		<div class=vipfmitte>				
		VIP Account wurde bereits eingetragen/verlaengert!
		</div>
		</div>";	
		
		}
else {
$eintrag1="UPDATE vip_benutzer SET vbid='$vbids', edate='0', ul='1' WHERE vipid='$vvipid'";
	$a=mysql_query($eintrag1) or die ("Fehler beim Eintragen! 1");
// Die Bestellung wird als Abgeschlossen makiert.
$eintrag2="UPDATE vip_bestellungen SET sid='3' WHERE vbid='$vvbid'";
	$b=mysql_query($eintrag2) or die ("Fehler beim Eintragen! 2");
		$ausgabe="
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Eingetragen</h2></div>
  		<div class=vipfmitte>				
		VIP Account wurde erfolgreich auf Lebenslaenglich verlaengert.
		</div>
		</div>";	
		
		echo $ausgabe;
		}
	}	
	
else {
		if ($vbids==$vvbid)
	{
		echo "
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Eingetragen</h2></div>
  		<div class=vipfmitte>				
		VIP Account wurde bereits eingetragen/verlaengert!
		</div>
		</div>";	
		
		}
else {

$datere= strtotime("+". $dauer. " month" ,$vedate);
$dates= date("Y-m-d",$datere);
$eintrag1="UPDATE vip_benutzer SET vbid='$vbids', edate='$datere' WHERE vipid='$vvipid'";
$a=mysql_query($eintrag1) or die ("Fehler beim Eintragen! 1");
// Die Bestellung wird als Abgeschlossen makiert.
$eintrag2="UPDATE vip_bestellungen SET sid='3' WHERE vbid='$vvbid'";
	$b=mysql_query($eintrag2) or die ("Fehler beim Eintragen! 2");
	
$ausgabe="
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Eingetragen</h2></div>
  		<div class=vipfmitte>				
		VIP Account wurde verlaengert.<p>
		". $dates ."
		</div>
		</div>";	
		
		echo $ausgabe;
		}
}
}

	else {
if ($dauer==0) // Wenn man Lebenslänglich bestellt hat muss kein Datum für das Ende des VIP Accounts berechnet werden.
{
$eintrag1="INSERT INTO vip_benutzer (vbid, v_u_user_id, v_a_user_id, ul) VALUES ('". $vbids ."', '". $benutzerid ."', '". $userid ."', '1')";
$a=mysql_query($eintrag1) or die ("Fehler beim Eintragen! 1");
// Die Bestellung wird als Abgeschlossen makiert.
$eintrag4="UPDATE vip_bestellungen SET sid='3' WHERE vbid='$vbids'";
	$d=mysql_query($eintrag4) or die ("Fehler beim Eintragen! 4");
// Fügt den Benutzer in die Gruppe VIP ein
$db_link2 = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt
$db_sel2 = mysql_select_db( $forumdb ) 
or die("Verbidnung zur Datenbank fehlgeschlagenll");
$eintrag2="INSERT INTO phpbb_user_group (group_id, user_id, group_leader, user_pending) 
VALUES ('8', '". $benutzerid ."', '0', '0')";
$b=mysql_query($eintrag2) or die ("Fehler beim Eintragen! 1");
// Macht den Benutzer zur hauptgruppe VIP
$eintrag3="UPDATE phpbb_users SET group_id='8' WHERE user_id='". $benutzerid ."'";
$c=mysql_query($eintrag3) or die ("Fehler beim Eintragen! 1");

		$ausgabe="
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Eingetragen</h2></div>
  		<div class=vipfmitte>				
		Benutzer wurde als VIP eingetragen.
		</div>
		</div>";	
		
		echo $ausgabe;
	}
else {
$jetzt = mktime();
$dater= strtotime("+". $dauer. " month" ,$jetzt);
$dates= date("Y-m-d",$dater);
$eintrag1="INSERT INTO vip_benutzer (vbid, v_u_user_id, v_a_user_id, edate) VALUES ('". $vbids ."', '". $benutzerid ."', '". $userid ."', '". $dater ."')";
$a=mysql_query($eintrag1) or die ("Fehler beim Eintragen! 1");
$eintrag4="UPDATE vip_bestellungen SET sid='3' WHERE vbid='$vbids'";
	$b=mysql_query($eintrag4) or die ("Fehler beim Eintragen! 2");
$db_link2 = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt
$db_sel2 = mysql_select_db( $forumdb ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
// Fügt den Benutzer in die Gruppe VIP ein
$eintrag2="INSERT INTO phpbb_user_group (group_id, user_id, group_leader, user_pending) 
VALUES ('8', '". $benutzerid ."', '0', '0')";
$b=mysql_query($eintrag2) or die ("Fehler beim Eintragen! 1");
// Macht den Benutzer zur hauptgruppe VIP
$eintrag3="UPDATE phpbb_users SET group_id='8' WHERE user_id='". $benutzerid ."'";
$c=mysql_query($eintrag3) or die ("Fehler beim Eintragen! 1");
// Die Bestellung wird als Abgeschlossen makiert.
	
$ausgabe="
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Eingetragen</h2></div>
  		<div class=vipfmitte>				
		Benutzer wurde als VIP eingetragen.<p>
		". $dates ."
		</div>
		</div>";	
		
		echo $ausgabe;
}
}//ENDE
}
else if ($auth->acl_getf_global('m_'))
{
	echo "Sie haben keine Berechtigung VIP-Benutzer einzutragen!";
}
}
else {
 echo "Sie haben keine rechte sich als VIP Benutzer einzutragen!";
}
}



?>