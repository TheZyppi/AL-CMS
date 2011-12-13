 <?php
//Config wird eingefügt
include('confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
   
$helpverwalten= "SELECT * FROM help WHERE hkid='$hkid'"; // Abfrage für die Tutorials


$db_erg = mysql_query( $helpverwalten );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysql_error());
}

echo '<table border="0" rules="groups">';
while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
{
 echo "<tr>";
 echo "<td  background=images/links.gif height=50 width=20 >";
  echo "</td>";


  print("<td bgcolor=#0c0c0c height=50px width=400px ><a href=\"help.php?hid=");
  print(htmlspecialchars($zeile["hid"]) . "\" class=menuhelp>" .
      htmlspecialchars($zeile["htitle"]));
  print("</a></td>");

 echo "<td background=images/rechts.gif height=50 width=20>";
  echo "</td>";
echo "</tr>";
 
 //Zeilenabstand zu anderen News
  echo "<tr>";
  echo "<td height=40>". "</td>";
  echo "</tr>";
  
  echo "</td>";
  echo "</tr>";
}
 echo "</table>";

mysql_free_result( $db_erg );


 ?>