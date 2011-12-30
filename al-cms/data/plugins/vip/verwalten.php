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
   
$vip_bestellungen_abfrage= "SELECT vbid, v_user_id, sid, vdate  FROM vip_bestellungen WHERE sid=1 or sid=2"; // Abfrage für die News Abfrage sortiert nach Datum und Zeit


$db_erg = mysql_query( $vip_bestellungen_abfrage );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysql_error());
}

//VIP-Bestellungen-Anzeigen
echo "<div id=vipall>";
echo "<div class=vipoben><h2>VIP-Bestellungen</h2></div>";
while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
{
$sidl=$zeile['sid'];
$uid=$zeile['v_user_id'];

// Satus Abfrage ID wird in der Status Tabelle abgefragt und durch den Status Titel ersetzt. ANFANG

//Config wird eingefügt
include('../confids/config.php');


$db_link3 = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel3 = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist

$sida="select * from status where sid=$sidl"; 
$db_erg3 = mysql_query( $sida );
if ( ! $db_erg3 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
while ($zeilet = mysql_fetch_array( $db_erg3, MYSQL_ASSOC))
{
	$sidt=$zeilet['stitle'];
	}
mysql_free_result( $db_erg3 );

// Satus Abfrage ID wird in der Status Tabelle abgefragt und durch den Status Titel ersetzt. ENDE

 //Config wird eingefügt
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
			<li><a href=index.php?mode=ansehen&vbid=". $zeile['vbid']  .">". $zeile['vbid']  ." " . $username ." " . $sidt ." ". $zeile['vdate']  ."</a></li></ul></div>";
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
//Config wird eingefügt
include('../confids/config.php');

$userid=$user->data['user_id'];
$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
   
$vip_bestellungen_abfrage= "SELECT vbid, v_user_id, sid, vdate  FROM vip_bestellungen WHERE  v_user_id=$userid"; // Abfrage für die News Abfrage sortiert nach Datum und Zeit


$db_erg = mysql_query( $vip_bestellungen_abfrage );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysql_error());
}

//VIP-Bestellungen-Anzeigen
echo "<div id=vipall>";
echo "<div class=vipoben><h2>VIP-Bestellungen</h2></div>";
while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
{
$sidl=$zeile['sid'];
$uid=$zeile['v_user_id'];

// Satus Abfrage ID wird in der Status Tabelle abgefragt und durch den Status Titel ersetzt. ANFANG

//Config wird eingefügt
include('../confids/config.php');


$db_link3 = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel3 = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist

$sida="select * from status where sid=$sidl"; 
$db_erg3 = mysql_query( $sida );
if ( ! $db_erg3 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
while ($zeilet = mysql_fetch_array( $db_erg3, MYSQL_ASSOC))
{
	$sidt=$zeilet['stitle'];
	}
mysql_free_result( $db_erg3 );

// Satus Abfrage ID wird in der Status Tabelle abgefragt und durch den Status Titel ersetzt. ENDE

 //Config wird eingefügt
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
			<li><a href=index.php?mode=ansehen&vbid=". $zeile['vbid']  .">". $zeile['vbid']  ." " . $username ." " . $sidt ." ". $zeile['vdate']  ."</a></li></ul></div>";
}
echo "</div>";
mysql_free_result( $db_erg );
}
}
?>