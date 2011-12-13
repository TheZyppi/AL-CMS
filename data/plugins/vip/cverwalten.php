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
   
$vip_bestellungen_abfrage= "SELECT * FROM vip_cash"; // Abfrage für die News Abfrage sortiert nach Datum und Zeit


$db_erg = mysql_query( $vip_bestellungen_abfrage );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysql_error());
}

//VIP-Bestellungen-Anzeigen
echo "<div id=vipall>";
echo "<div class=vipoben><h2>VIP-Cash-Liste</h2></div>";
while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
{

echo "<div class=vipmitte>
<table border=0>
<tr>
<td width=20>
". $zeile['vcid']  ." 
</td>
<td width=20>
". $zeile['vbid']  ."
</td>
<td width=150> 
". $zeile['vcash']  ."
</td>
<td width=20>
 ". $zeile['sum']  ."
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