<?php
if (isset($_POST['sumbit5']))
{
	$reintragen="INSERT INTO reservierung_bezahlung (RID, BAID, bz1, bz2) VALUES ('".$_POSt['rida']."', '".$_POST['bezahlung']."', '".$_POST['kontonummer']."', '".$_POST['bankleitzahl']."')";
 	$pr=mysql_query($reintragen) or die (mysql_error());
$ausgabe="Bestellung Erfolgreich.";
echo $ausgabe;
}
else {
$hpl=$_GET['hpl'];
echo '<form method="post" action=index.php?hpl='.$hpl.'>';
echo '<table border=0 width="650">
<tr>
		<td width="20%">
		Kontonummer:<p>
		</td>
		<td width="20%">
		<input type="text" name="kontonummer" size="40">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Bankleitzahl:<p>
		</td>
		<td width="20%">
		<input type="text" name="bankleitzahl" size="40">
		</td>
		</tr>
		<tr>
		<td>
		<INPUT name="rida" TYPE="HIDDEN" value='.$_POST['rida'].'>
		<INPUT name="bezahlung" TYPE="HIDDEN" value='.$_POST['bezahlung'].'>
		<input type="submit" value="Bezahlen" name="sumbitv">
		</td>
		</tr>
		</form>
</table>';
}

?>