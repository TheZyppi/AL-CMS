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
   
$vip_bestellungen_abfrage= "SELECT *  FROM vip_benutzer WHERE `edate` <= UNIX_TIMESTAMP() AND ul='0'"; // Abfrage für die News Abfrage sortiert nach Datum und Zeit


$db_erg = mysql_query( $vip_bestellungen_abfrage );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysql_error());
}

//VIP-Bestellungen-Anzeigen
echo "<div id=vipall>";
echo "<div class=vipoben><h2>VIP-Abgelaufen</h2></div>";
while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
{
$uls=$zeile['ul'];
$edates=$zeile['edate'];
$uid=$zeile['v_u_user_id'];

mysql_free_result( $db_erg );


include('../../forum/config.php');

$db_link2 = mysql_connect ($dbhost, $dbuser, $dbpasswd); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel2 = mysql_select_db( $dbname ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
   
$usera="select * from phpbb_users where user_id=$uid"; 
$resultth=mysql_query($usera);
$num=mysql_numrows($resultth);
$username=mysql_result($resultth,$i,"username");

$db_erg2 = mysql_query( $usera );
if ( ! $db_erg2 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
// Die UserID wird nun als Benutzername angezeigt ENDE


echo "<div class=vipmitte><ul>
			<li><a href=index.php?mode=delete&vipid=". $zeile['vipid']  .">". $zeile['vipid']  ." " . $username ."</a></li></ul></div>";
}
echo "</div>";


}

else if ($auth->acl_getf_global('m_'))
{
	echo "Sie haben keine Berechtigung VIP_Accounts anzugucken!";
}
}
else {
echo "Sie haben keine Berechtigung VIP_Accounts anzugucken!"; 
}
}
?>