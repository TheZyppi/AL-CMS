<?php
// Data-Right-Security-Open-Check
if (!defined('ON_ALCMS') || isset($_SESSION['group'])=="")
{
	echo "Error: You are not use ALCMS!";
	exit;
}
else {
function show_bestellungen($srdp)
{
	$sb=$_GET['sb'];
	$sba="SELECT RID, RName, RVorname, 	ROrt, RPLZ, RAdresse, Email FROM reservierungen_non_reg WHERE RID='".$sb."'";
	$sbq=mysql_query($sba);
	$row=mysql_fetch_array($sbq);
	echo '
	<table border=0 width=650>
	<tr>
	<td>
	Bestellungs-Nummer: '.$row['RID'].'
	</td>
	</tr>
	<tr>
	<td height="50">
	</td>
	</tr>
	<tr>
	<td>
	Name: '.$row['RName'].' Vorname: '.$row['RVorname'].'
	</td>
	</tr>
	<tr>
	<td height="20">
	</td>
	</tr>
	<tr>
	<td>
	Adresse: '.$row['RAdresse'].'
	</td>
	</tr>
	<tr>
	<td>
	PLZ: '.$row['RPLZ'].'
	</td>
	</tr>
	<tr>
	<td>
	Ort: '.$row['ROrt'].'
	</td>
	</tr>
	<tr>
	<td>
	Email: '.$row['Email'].'
	</td>
	</tr>
	';
		$sbt="SELECT reservierungen_tisch.RID, reservierungen_tisch.TID, tische.TBezeichnung FROM reservierungen_tisch, tische WHERE reservierungen_tisch.TID=tische.TID AND reservierungen_tisch.RID='".$sb."'";
	$sbtq=mysql_query($sbt);
	while($row2=mysql_fetch_array($sbtq))
	{
	echo '
	<tr>
	<td>
	Tisch: '.$row2['TBezeichnung'].'
	</td>
	</tr>
	';	
	}
	echo '</table>';
}
function list_bestellungen($srdp)
{
	$lba="SELECT RID, RName, RVorname, 	ROrt, RPLZ, RAdresse, Email FROM reservierungen_non_reg";
	$lbq=mysql_query($lba);
	echo '<table border="0" width="650">';
	while ($row1=mysql_fetch_array($lbq)) {
	echo '
	<tr>
	<td>
	<a href="index.php?hpl=2&lpl=1&plf=10&sb='.$row1['RID'].'">Bestellung: '.$row1['RID'].'</a> 
	</td>
	</tr>
	<tr>
	<td height="20">
	</td>
	</tr>
	';	
	}
	echo '</table>';
}
}
?>