<?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) 2011-2012 Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is a free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */
// Data-Right-Security-Open-Check
if (!defined('ON_ALCMS') || isset($_SESSION['group'])=="")
{
	echo "Error: You are not use ALCMS!";
	exit;
}
else {
function config_edit ($srdp)
{
$show_config_a=@mysql_query("SELECT CID, name, funktion FROM al_config");
	 echo '<form method="post" action="index.php?hpl=2&lpl=1&plf=6"><table border=0 width="650">';
while ($row = @mysql_fetch_array($show_config_a)) {
     echo '
<tr>
		<td width="20%">';
		echo $row['name'];
		echo'
		</td>
		<td width="20%"> 
		<input type="text" id="';echo $row['CID'];echo'" name="config[';echo $row['CID'];echo']" size="40"';?> value="<?php echo $row['funktion']; ?>"<?php echo'>
		</td>
		</tr>';
}
echo '
<tr>
		<td>
		<input type="submit" value="Update" name="configedit">
		</td>
		</tr>
</table>';
if(isset($_POST['configedit']))
{
	foreach(array_keys($_POST['config']) as $value)
{
	$eintrag2="UPDATE al_config SET funktion='".$_POST['config'][$value]."' WHERE CID='".$value."'";
mysql_query($eintrag2) or die (mysql_error());
echo $_POST['config'];
}			
echo "Erfolg!!!<br>";
}
}
}
?>
