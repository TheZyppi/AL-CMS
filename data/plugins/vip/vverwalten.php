  <?php

if ($user->data['is_registered'])
    {
    	if ($auth->acl_get('a_') || $auth->acl_getf_global('m_'))
{

if ($auth->acl_get('a_'))
{
//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
   
$vip_bestellungen_abfrage= "SELECT * FROM vip_benutzer"; // Abfrage für die News Abfrage sortiert nach Datum und Zeit


$db_erg = mysql_query( $vip_bestellungen_abfrage );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysql_error());
}

//VIP-Bestellungen-Anzeigen
echo "<div id=vipall>";
echo "<div class=vipoben><h2>VIP-Benutzer-Liste</h2></div>";
while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
{

echo "<div class=vipmitte>
<table border=0>
<tr>
<td width=20>
". $zeile['vipid']  ." 
</td>
<td width=20>
". $zeile['vbid']  ."
</td>
<td width=30> 
"; $userid=$zeile['v_u_user_id']; 

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
echo "
</td>
<td width=20>
 "; 
 $edates=$zeile['edate'];  
if ($edates=='0')
{
echo "Lebenslaenglich";
	
	}
	else { 
 $dates= date("d.m.Y",$edates);
 echo "". $dates ."";
 }
 echo "
 </td>
 </tr>
 </table>
</div>";
}
echo "</div>";
mysql_free_result( $db_erg );

}

else if ($auth->acl_getf_global('m_'))
{
	echo "Sie haben keine Berechtigung VIP-Bestellungen zu bearbeiten!";
}
}
else {
echo "Sie haben keine Berechtigung VIP-Bestellungen zu bearbeiten!";
}
}
?>