<?php
if ($user->data['is_registered'])
    {
    	if ($auth->acl_get('a_') || $auth->acl_getf_global('m_'))
{

if ($auth->acl_get('a_'))
{

if ($vbids=$_GET['vbid'])
{
//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist

$del1="DELETE FROM vip_bestellungen WHERE vbid=$vbids";
$a=mysql_query($del1) or die ("Fehler beim Eintragen! 1");
$del2="DELETE FROM vip_bezahlung WHERE vbid=$vbids";
$b=mysql_query($del2) or die ("Fehler beim Eintragen! 1");
	$ausgabe="
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Eingetragen</h2></div>
  		<div class=vipfmitte>				
		VIP-Bestellung wurde storniert/gelöscht.
		</div>
		</div>";	
		echo $ausgabe;
}
else if ($vipids=$_GET['vipid'])
{
//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
   
$abfrage1="SELECT * FROM vip_benutzer WHERE vipid=$vipids";


$db_erg6 = mysql_query( $abfrage1 );
if ( ! $db_erg6 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
	
while ($a1 = mysql_fetch_array( $db_erg6, MYSQL_ASSOC))
{
	
	$v_user_idls=$a1['v_u_user_id'];
}

// Löscht den VIP-User aus der Datenbank
	$del1="DELETE FROM vip_benutzer WHERE vipid=$vipids";
	$a=mysql_query($del1) or die ("Fehler beim Eintragen! 1");
$db_link2 = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt
$db_sel2 = mysql_select_db( $forumdb ) 
or die("Verbidnung zur Datenbank fehlgeschlagen");
	//PHPBB LÖSCH EINTRÄGE
	$del2="DELETE FROM phpbb_user_group WHERE group_id = 8 AND user_id = '".$v_user_idls."' LIMIT 1"; // Löscht aus der Tabelle phpbb_user_group den Benutzer den VIP Rang
	$b=mysql_query($del2) or die ("Fehler beim Eintragen! 2");	
	$del3="UPDATE phpbb_users SET group_id='2' WHERE user_id='". $v_user_idls ."'";
	$c=mysql_query($del3) or die ("Fehler beim Eintragen! 3");

		$ausgabe="
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Eingetragen</h2></div>
  		<div class=vipfmitte>				
		Benutzer wurde als VIP entfernt.
		</div>
		</div>";	
		echo $ausgabe;
	}
else if ($vcids=$_GET['vcid'])
{
	
	$del1="DELETE FROM vip_cash WHERE vcid=$vcids";
	
}
else {
	echo "Sie haben nichts zum löschen ausgewählt!";
	}

}

else if ($auth->acl_getf_global('m_'))
{
	echo "Sie haben keine Berechtigungen Sachen zu löschen.";
}
}
else 
{

if ($vbids=$_GET['vbid'])
{	
$userid=$user->data['user_id'];
//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
   
$abfrage1="SELECT vip_bestellungen.vbid, vip_bestellungen.sid, vip_bestellungen.v_user_id, vip_bestellungen.v_name, vip_bestellungen.v_nachname, vip_bestellungen.v_email, vip_bestellungen.vdate, vip_angebote.vaid, vip_angebote.vatitle, vip_angebote.vapreis, vip_angebote.vadauer, vip_bestellungen_liste.vbid, vip_bestellungen_liste.vaid
FROM vip_bestellungen, vip_angebote, vip_bestellungen_liste
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
	
	if ($userid==$a1['v_user_id'])
	{	
//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist

$del1="DELETE FROM vip_bestellungen WHERE vbid=$vbids";
$a=mysql_query($del1) or die ("Fehler beim Eintragen! 1");
$del2="DELETE FROM vip_bezahlung WHERE vbid=$vbids";
$b=mysql_query($del2) or die ("Fehler beim Eintragen! 1");
	$ausgabe="
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Eingetragen</h2></div>
  		<div class=vipfmitte>				
		VIP-Bestellung wurde storniert/gelöscht.
		</div>
		</div>";	
		echo $ausgabe;
	}
	else {
		echo "
<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-Löschen</h2></div>
  		<div class=vipfmitte>				
		Das ist nicht ihre Bestellung!.<p>
		</div>
		</div>		
		";
		}
	}
	
		
	}
	else {
echo "Ihn gehört diese Bestellung nicht, deswegen können Sie die auch nicht löschen!";
	}
}
	}
?>