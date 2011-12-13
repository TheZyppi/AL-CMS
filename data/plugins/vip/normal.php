  <?php

//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
   
$vip_bestellungen_abfrage= "SELECT * FROM vip_bezahlungs_arten"; // Abfrage für die News Abfrage sortiert nach Datum und Zeit


$db_erg = mysql_query( $vip_bestellungen_abfrage );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysql_error());
}

//VIP-Bestellungen-Anzeigen
echo "<div id=vipall>";
echo "<div class=vipoben><h2>VIP-Bezahlungs-Arten</h2></div>";
while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
{

echo "<div class=vipmitte>
<table border=0>
<tr>
<td>
<a href=index.php?vbaid=". $zeile['vbaid'] ."><img src=". $zeile['vbimage'] ." wdth=200 height=100 border=0></a>
</td>
</tr>
</table>
</div>";
}
echo "</div>";
mysql_free_result( $db_erg );

?>