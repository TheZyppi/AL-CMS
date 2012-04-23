<?php
if ($_POST['bankleitzahl']=="" || $_POST['kontonummer']=="")
{
	echo "Sie haben keine Bank Daten angegeben.";
}
else {
	$bea="INSERT INTO reservierung_bezahlung (RID, BAID, bz1, bz2) VALUES ('".$_POST['rida']."', '".$_POST['bezahlung']."', '".$_POST['kontonummer']."', '".$_POST['bankleitzahl']."')";
$beq=mysql_query($bea) or die(mysql_error());
echo "Bestellung erfolgreich!";
}

?>