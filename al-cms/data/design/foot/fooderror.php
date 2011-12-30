<div id=foot>
<?php
//Config wird eingefügt
include('../../confids/config.php');
include('../../confids/configtitle.php');


$db_link = mysql_connect ($host, $be, $pass);


$db_sel2 = mysql_select_db( $db )
   or die("Verbindung zur Datenbank fehlgeschlagen");
   
$versionsabfrage_hp_user = "SELECT * FROM hpversion WHERE hpvid='1'"; // Abfrage für die Versions Anzeige der Homepage

$db_erg2 = mysql_query( $versionsabfrage_hp_user );
if ( ! $db_erg2 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}



/*while ($zeile = mysql_fetch_array( $db_erg2, MYSQL_ASSOC))
{

echo "<font color=#f2c777>". $zeile['hversion'] . "</font>";
echo "<font color=#f2c777> $titlep </font>"; // <font color=.....> </font> Farbanzeige Fix für Opera und Google Chrome
*/
echo '<table width="100%" border="0" align="center" class="foot">
  <tr>
    <th width="26%" align="left" scope="col"><font color="#FFFFFF">COPYRIGHT&copy; BY </font><a style="color:#FFFFFF; text-decoration:none;" href="test.html">SUNRISNING NETWORK </a>
    <font color="#FFFFFF">|</font><a style="color:#FFFFFF; text-decoration:none;" href="datenschutz.php">  DATENSCHUTZ </a><font color="#FFFFFF">|</font> <a style="color:#FFFFFF; text-decoration:none;" href="impressum.php"> IMPRESSUM </a><font color="#FFFFFF">|</font></th>
  </tr>
</table>';
// }

 ?>
</div>