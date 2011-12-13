<?php

if ($user->data['is_registered'])
    {
    	if ($auth->acl_get('a_') || $auth->acl_getf_global('m_'))
{

if ($auth->acl_get('a_'))
{
	
$vbids=$_GET['vbid'];	
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
	  	echo '
  		<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-NR:
  		';		
echo " ". $a1['vbid'] ." ";
	echo '</h2></div>
	<p><br>
	<div class=vipoben>
';
// Test Anfang
echo '	<table border=0>
	<tr>
	<td width=10%>
	</td>
	<td width=20%>
<h3>Benutzername: </h3>
</td>
<td width=20%>
';
// Satus Abfrage ID wird in der Status Tabelle abgefragt und durch den Status Titel ersetzt. ANFANG
$userid=$a1['v_user_id'];

 //Config wird eingefügt
include('../../forum/config.php');

$db_link11 = mysql_connect ($dbhost, $dbuser, $dbpasswd); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel11 = mysql_select_db( $dbname ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist

$usera="select * from phpbb_users where user_id=$userid"; 
$db_erg11 = mysql_query( $usera );
if ( ! $db_erg11 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
while ($a11 = mysql_fetch_array( $db_erg11, MYSQL_ASSOC))
{
	$user=$a11['username'];
	echo "". $user ."";
	}
mysql_free_result( $db_erg11 );



echo '
</td>
<td width=20%>
<h3>Status:</h3>
</td>
<td width=20%>
';
// Satus Abfrage ID wird in der Status Tabelle abgefragt und durch den Status Titel ersetzt. ANFANG
$sidls=$a1['sid'];

//Config wird eingefügt
include('../confids/config.php');


$db_link10 = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel10 = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist

$sidab="select * from status where sid=$sidls"; 
$db_erg10 = mysql_query( $sidab );
if ( ! $db_erg10 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
while ($a10 = mysql_fetch_array( $db_erg10, MYSQL_ASSOC))
{
	$sidll=$a10['stitle'];
	echo "". $sidll."";
	}
mysql_free_result( $db_erg10 );
echo '
</td>
</tr>	
</table>
';
// Test Ende
	echo '
	</div>
  		<div class=vipfmitte>
  		<p><br><p><br>
		<table border=0 width="650">
		<tr>
		<td width="20%">		Vorname:<p>
		</td>
		<td width="20%">
';		
echo " ". $a1['v_name'] ." ";
	echo '	</td>
		</tr>
		<tr>
		<td width="20%">
		Nachname:<p>
		</td>
		<td width="50%">
';		
echo " ". $a1['v_nachname'] ." ";
echo '		</td>
		</tr>
		<tr>
		<td width="20%">
		Mailadresse:<p>
		</td>
		<td width="20%">
';		
echo " ". $a1['v_email'] ." ";
echo '		</td>
		</tr>
		<tr>
		<td width="20%">
		Datum:<p>
		</td>
		<td width="20%">
';		
echo " ". $a1['vdate'] ." ";
echo '		</td>
		</tr>
		<tr>
		<td width="20%">
		Angebot:<p>
		</td>
		<td width="20%">
';		
echo " ". $a1['vatitle'] ." f&uuml;r ". $a1['vapreis'] ." &#128;";
		
echo '		
		</td>
		</tr>
		<tr>
		<td height=20px>
		</td>
		</tr>	
		<tr><td width="20%">
		Bezahlungsart:<p>
		</td>
		<td width="20%">
		';
		
// Abfrage 2 dient dazu um zu gucken mit was bezahkt wurde.
$abfrage2="SELECT vip_bestellungen.vbid, vip_bezahlungs_arten.vbaid, vip_bezahlungs_arten.vbatitle, vip_bezahlung.vbid, vip_bezahlung.vbaid FROM vip_bestellungen, vip_bezahlungs_arten, vip_bezahlung WHERE vip_bestellungen.vbid=vip_bezahlung.vbid and vip_bezahlungs_arten.vbaid=vip_bezahlung.vbaid and vip_bestellungen.vbid
 ='$vbids' LIMIT 1";


$db_erg7 = mysql_query( $abfrage2 );
if ( ! $db_erg7 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
	
	
	
while ($a2 = mysql_fetch_array( $db_erg7, MYSQL_ASSOC))
		{
			$bart=$a2['vbatitle'];
			echo "". $bart ."";
			}
		echo '</td>
		</tr>
		<tr>
		<td height=20px>
		</td>
		</tr>
		<tr><td width="20%">
		Ausgabe:<p>
		</td>
		<td width="20%">
		';
		
// Abfrage 2 dient dazu um zu gucken mit was bezahkt wurde.
$abfrage3="SELECT vip_bestellungen.vbid, vip_bezahlungs_arten.vbaid, vip_bezahlung.vbid, vip_bezahlung.vbaid, vip_bezahlung.b1
FROM vip_bestellungen, vip_bezahlungs_arten, vip_bezahlung
WHERE vip_bestellungen.vbid = vip_bezahlung.vbid AND vip_bezahlungs_arten.vbaid = vip_bezahlung.vbaid
AND vip_bestellungen.vbid ='$vbids'";
// AND vip_bezahlungs_arten.vbaid = vip_bezahlung.vbaid


$db_erg8 = mysql_query( $abfrage3 );
if ( ! $db_erg8 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
	
	
	
while ($a3 = mysql_fetch_array( $db_erg8, MYSQL_ASSOC))
		{
			echo " ". $bart .": ". $a3['b1'] ."<br>";
			}
		echo "
		</td>
		</tr>		
		<tr>
		<td height=20>
		</td>
		</tr>
		<tr>
		<td>
		<a href=index.php?mode=veintragen&vbid=$vbids>VIP Eintragen/verlaengern</a>
		</td>
		<td>
		<a href=index.php?mode=delete&vbid=$vbids>VIP Bestellung loeschen</a>
		</td>
		</tr>
		</table>
		</div>
		</div>";
	
}
}
else if ($auth->acl_getf_global('m_'))
{
	echo "Sie haben keine Berechtigung VIP-Bestellungen zu bearbeiten!";
}
}
else {
$vbids=$_GET['vbid'];	
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
	  	echo '
  		<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-NR:
  		';		
echo " ". $a1['vbid'] ." ";
	echo '</h2></div>
	<p><br>
	<div class=vipoben>
';
// Test Anfang
echo '	<table border=0>
	<tr>
	<td width=10%>
	</td>
	<td width=20%>
<h3>Benutzername: </h3>
</td>
<td width=20%>
';
// Satus Abfrage ID wird in der Status Tabelle abgefragt und durch den Status Titel ersetzt. ANFANG
$userid=$a1['v_user_id'];

 //Config wird eingefügt
include('../../forum/config.php');

$db_link11 = mysql_connect ($dbhost, $dbuser, $dbpasswd); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel11 = mysql_select_db( $dbname ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist

$usera="select * from phpbb_users where user_id=$userid"; 
$db_erg11 = mysql_query( $usera );
if ( ! $db_erg11 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
while ($a11 = mysql_fetch_array( $db_erg11, MYSQL_ASSOC))
{
	$user=$a11['username'];
	echo "". $user ."";
	}
mysql_free_result( $db_erg11 );



echo '
</td>
<td width=20%>
<h3>Status:</h3>
</td>
<td width=20%>
';
// Satus Abfrage ID wird in der Status Tabelle abgefragt und durch den Status Titel ersetzt. ANFANG
$sidls=$a1['sid'];

//Config wird eingefügt
include('../confids/config.php');


$db_link10 = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel10 = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist

$sidab="select * from status where sid=$sidls"; 
$db_erg10 = mysql_query( $sidab );
if ( ! $db_erg10 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
while ($a10 = mysql_fetch_array( $db_erg10, MYSQL_ASSOC))
{
	$sidll=$a10['stitle'];
	echo "". $sidll."";
	}
mysql_free_result( $db_erg10 );
echo '
</td>
</tr>	
</table>
';
// Test Ende
	echo '
	</div>
  		<div class=vipfmitte>
  		<p><br><p><br>
		<table border=0 width="650">
		<tr>
		<td width="20%">		Vorname:<p>
		</td>
		<td width="20%">
';		
echo " ". $a1['v_name'] ." ";
	echo '	</td>
		</tr>
		<tr>
		<td width="20%">
		Nachname:<p>
		</td>
		<td width="50%">
';		
echo " ". $a1['v_nachname'] ." ";
echo '		</td>
		</tr>
		<tr>
		<td width="20%">
		Mailadresse:<p>
		</td>
		<td width="20%">
';		
echo " ". $a1['v_email'] ." ";
echo '		</td>
		</tr>
		<tr>
		<td width="20%">
		Datum:<p>
		</td>
		<td width="20%">
';		
echo " ". $a1['vdate'] ." ";
echo '		</td>
		</tr>
		<tr>
		<td width="20%">
		Angebot:<p>
		</td>
		<td width="20%">
';		
echo " ". $a1['vatitle'] ." f&uuml;r ". $a1['vapreis'] ." &#128;";
		
echo '		
		</td>
		</tr>
		<tr>
		<td height=20px>
		</td>
		</tr>	
		<tr><td width="20%">
		Bezahlungsart:<p>
		</td>
		<td width="20%">
		';
		
// Abfrage 2 dient dazu um zu gucken mit was bezahkt wurde.
$abfrage2="SELECT vip_bestellungen.vbid, vip_bezahlungs_arten.vbaid, vip_bezahlungs_arten.vbatitle, vip_bezahlung.vbid, vip_bezahlung.vbaid FROM vip_bestellungen, vip_bezahlungs_arten, vip_bezahlung WHERE vip_bestellungen.vbid=vip_bezahlung.vbid and vip_bezahlungs_arten.vbaid=vip_bezahlung.vbaid and vip_bestellungen.vbid
 ='$vbids' LIMIT 1";


$db_erg7 = mysql_query( $abfrage2 );
if ( ! $db_erg7 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
	
	
	
while ($a2 = mysql_fetch_array( $db_erg7, MYSQL_ASSOC))
		{
			$bart=$a2['vbatitle'];
			echo "". $bart ."";
			}
		echo '</td>
		</tr>
		<tr>
		<td height=20px>
		</td>
		</tr>
		<tr><td width="20%">
		Ausgabe:<p>
		</td>
		<td width="20%">
		';
		
// Abfrage 2 dient dazu um zu gucken mit was bezahkt wurde.
$abfrage3="SELECT vip_bestellungen.vbid, vip_bezahlungs_arten.vbaid, vip_bezahlung.vbid, vip_bezahlung.vbaid, vip_bezahlung.b1
FROM vip_bestellungen, vip_bezahlungs_arten, vip_bezahlung
WHERE vip_bestellungen.vbid = vip_bezahlung.vbid
AND vip_bezahlungs_arten.vbaid = vip_bezahlung.vbaid
AND vip_bestellungen.vbid ='$vbids'";


$db_erg8 = mysql_query( $abfrage3 );
if ( ! $db_erg8 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
	
	
	
while ($a3 = mysql_fetch_array( $db_erg8, MYSQL_ASSOC))
		{
			echo " ". $bart .": ". $a3['b1'] ."<br>";
			}
		echo "
		</td>
		</tr>
		<tr>
		<td height=20>
		</td>
		</tr>
		<tr>
		<td>
		<a href=index.php?mode=delete&vbid=$vbids>VIP Bestellung loeschen</a>
		</td>
		</tr>
		</table>
		</div>
		</div>";
	
}
else {
	echo "Fehler!<p> Das ist nicht deine Bestellung!";
	}

}

}
}








?>