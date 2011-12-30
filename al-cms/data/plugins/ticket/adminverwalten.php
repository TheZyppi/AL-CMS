<?php
     if ($user->data['is_registered'])
    {
	if ($auth->acl_get('a_') || $auth->acl_getf_global('m_'))
	{
//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
   
$ticketvvip= "SELECT *
FROM `tickets`
WHERE t_group_id =8"; 
$ticketvuser= "SELECT *
FROM `tickets`
WHERE t_group_id =2;";

$db_erg = mysql_query( $ticketvvip );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
//VIP
echo "<div id=ticketall>";
echo "<div class=ticketoben>VIP</div>";
while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
{
	$sids="select * from status where sid=".$zeile['sid'].""; 
$db_erg13 = mysql_query( $sids );
if ( ! $db_erg13 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
$a13 = mysql_fetch_array( $db_erg13, MYSQL_ASSOC);
if($zeile['sid']==1 || $zeile['sid']==2 ) {
echo "<div class=ticketmitte><a href=index.php?mode=verwalten&tid=".$zeile['tid']."> " . $zeile['ttitle'] ."</a> ".$a13['stitle']."  <a href=index.php?mode=loeschen&tid=".$zeile['tid'].">Loeschen</a></div>";
}
else {
	// Nichts
	}
	}
echo "</div>";
$db_erg2 = mysql_query( $ticketvuser );
if ( ! $db_erg2 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
//VIP
echo "<div id=ticketall>";
echo "<div class=ticketoben>User</div>";
while ($zeile2 = mysql_fetch_array( $db_erg2, MYSQL_ASSOC))
{
	$sids="select * from status where sid=".$zeile2['sid'].""; 
$db_erg12 = mysql_query( $sids );
if ( ! $db_erg12 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
$a12 = mysql_fetch_array( $db_erg12, MYSQL_ASSOC);
if($zeile2['sid']==1 || $zeile2['sid']==2 ) {
echo "<div class=ticketmitte><a href=index.php?mode=verwalten&tid=".$zeile2['tid']."> " . $zeile2['ttitle'] ."</a> ".$a12['stitle']."  <a href=index.php?mode=loeschen&tid=".$zeile2['tid'].">Loeschen</a></div>";
}
else {
	// Nichts
	}
	}
echo "</div>";

}
else {
	echo "Dies ist nicht erlaubt!";
	}
	}
	else {
		echo "Bitte loggen Sie sich ein!";
		}
 ?>