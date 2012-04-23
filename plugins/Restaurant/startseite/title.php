<?php
$query="SELECT * FROM al_config WHERE CID = 1";
$result=mysql_query($query) or die(mysql_error());
$reihe = mysql_fetch_array($result, MYSQL_ASSOC) or die (mysql_error());
echo "<title>".$reihe['funktion']."</title>";
?>