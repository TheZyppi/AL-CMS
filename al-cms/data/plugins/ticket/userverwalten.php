<?php     
     if ($user->data['is_registered'])
    {
    	//Config wird eingefügt
include('../confids/config.php');

$user_id=$user->data['user_id'];
$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
   
$ticketuser= "SELECT * FROM tickets WHERE t_user_id=".mysql_real_escape_string($user_id).""; 
$db_erg = mysql_query( $ticketuser );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
//VIP
echo "<div id=ticketall>";
echo "<div class=ticketoben>Deine Tickets</div>";
while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
{
	$sids="select * from status where sid=".$zeile['sid'].""; 
$db_erg13 = mysql_query( $sids );
if ( ! $db_erg13 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
$a13 = mysql_fetch_array( $db_erg13, MYSQL_ASSOC);

echo "<div class=ticketmitte><a href=index.php?mode=verwalten&tid=".$zeile['tid']."> " . $zeile['ttitle'] ."</a> ".$a13['stitle']." <a href=index.php?mode=bearbeiten&tid=".$zeile['tid'].">Bearbeiten</a> <a href=index.php?mode=loeschen&tid=".$zeile['tid'].">Loeschen</a></div>";
}
echo "</div>";
echo "<a href=index.php?mode=eintragen>Eintragen</a>";


    	}
    	?>