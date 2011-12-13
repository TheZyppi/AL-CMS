<!DOCTYPE xhtml PUBLIC "-//W3C//DTDB XHTML 1.0 Strict// EN" "http://www.w3.org/TR/xhtml/
  DTD/xhtml1-strict.dtd">
  

<html>
<head>
<!-- CSS Datein werden eingefügt -->
  <link rel="stylesheet" title="Normal" href="../css/seite.css" type="text/css">
   <?php
   include('../confids/configtitle.php');
   echo "<title>". $titlep, $adminindex."</title>";

   include ('../data/meta/metaadmin.htm');
?>
<meta http-equiv="refresh" content="5; URL=../index.php"> 
</head>


<body>
<!-- Beginn des Inhalsbereichs -->
<div id=top>
<div id="obermens"></div>
<!--Menü-->
  <?php

	include ('../data/menues/obenadmin.htm');

?>
<!--Menü Ende-->


<div id=logo> <!-- Logo -->
</div> <!-- Logo Ende-->


<div id=utost> <!-- Anstandhalter -->

</div>


<div id=text> 

Sie sind nicht eingeloggt!<p>
<a href=../login.php>Bitte melden Sie sich an</a>
</div> 




<div id=foot>
<?php
//Config wird eingefügt
include('../confids/config.php');
include('../confids/configtitle.php');

$db_link = mysql_connect ($host, $be, $pass);


$db_sel2 = mysql_select_db( $db )
   or die("Verbindung zur Datenbank fehlgeschlagen");
   
$versionsabfrage_hp_user = "SELECT * FROM hpversion WHERE hpvid='1'"; // Abfrage für die Versions Anzeige der Homepage

$db_erg2 = mysql_query( $versionsabfrage_hp_user );
if ( ! $db_erg2 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}



while ($zeile = mysql_fetch_array( $db_erg2, MYSQL_ASSOC))
{

echo "<font color=#f2c777>". $zeile['hversion'] . "</font>";
echo "<font color=#f2c777> $titlep </font>"; // <font color=.....> </font> Farbanzeige Fix für Opera und Google Chrome
echo "<font color=#f2c777>||</font> <a href=../impressum.php class=linkfoot>Impressum</a> <a href=../datenschutz.php class=linkfoot>Datenschutz</a>";
}

 ?>
</div>

</div> <!-- Ende des Inhalsbereichs -->
</body>
</html>