<?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is a free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */

$woche=60*60*24*7;
$now=time();
$alt=$now-$woche; 
db_con(); // Führt die Funktion db_con aus
$sql='DELETE FROM sendeplan WHERE date < '.$alt.'';
$ergebnis = mysql_query($sql);  
$sql1 = mysql_query("SELECT * FROM sendeplan ORDER BY time ASC") or die (mysql_error()); // Fragt den Datensatz vom Benutzer X ab
$sql2 = mysql_query("SELECT * FROM sendeplan ORDER BY time ASC") or die (mysql_error());
$sql3 = mysql_query("SELECT * FROM sendeplan ORDER BY time ASC") or die (mysql_error());
$sql4 = mysql_query("SELECT * FROM sendeplan ORDER BY time ASC") or die (mysql_error());
$sql5 = mysql_query("SELECT * FROM sendeplan ORDER BY time ASC") or die (mysql_error());
$sql6 = mysql_query("SELECT * FROM sendeplan ORDER BY time ASC") or die (mysql_error());
$sql7 = mysql_query("SELECT * FROM sendeplan ORDER BY time ASC") or die (mysql_error());  
// Datum-Daten für die aktuelle Woche ermitteln. 
$montagWoche = date("d.m.Y", time()-((date("N")-1)*86400));
$dienstagWoche = date("d.m.Y", time()-((date("N")-2)*86400));
$mittwochWoche = date("d.m.Y", time()-((date("N")-3)*86400));
$donnerstagWoche = date("d.m.Y", time()-((date("N")-4)*86400));
$freitagWoche = date("d.m.Y", time()-((date("N")-5)*86400));
$samstagWoche = date("d.m.Y", time()-((date("N")-6)*86400));
$sonntagWoche = date("d.m.Y", time()+((7-date("N"))*86400));

echo "Montag, ".$montagWoche." bis Sonntag, ".$sonntagWoche."";
echo '<table border=0>';
	echo '<tr><td>';
				echo "Montag:<p></td>";
while ($zeile2 = mysql_fetch_assoc( $sql1))
		{
			if($montagWoche==date("d.m.Y", $zeile2['date']))
			{
				echo '<tr>';
				echo '<td>';
				echo $zeile2['showname'], date("d.m.Y",$zeile2['date']), date("H:i",$zeile2['time']), date("H:i",$zeile2['end']);
				echo '</td>';
				echo '</tr>';
			}
}
				echo '</tr>';
				echo '<tr><td>';
				echo "Dienstag:<p></td>";
				while ($zeile2 = mysql_fetch_assoc( $sql2))
		{
	
		if($dienstagWoche==date("d.m.Y", $zeile2['date']))
			{
				echo '<tr>';
				echo '<td>';
				echo $zeile2['showname'], date("d.m.Y",$zeile2['date']), date("H:i",$zeile2['time']), date("H:i",$zeile2['end']);
				echo '</td>';
				echo '</tr>';
			}
		}
		echo '</tr>';
		echo '<tr><td>';
		echo "Mittwoch:<p></td>";
			
				while ($zeile2 = mysql_fetch_assoc( $sql3))
		{
		
			if($mittwochWoche==date("d.m.Y", $zeile2['date']))
			{
				echo '<tr>';
				echo '<td>';
				echo $zeile2['showname'], date("d.m.Y",$zeile2['date']), date("H:i",$zeile2['time']), date("H:i",$zeile2['end']);
				echo '</td>';
				echo '</tr>';
			}
		}
				echo '</tr>';
				echo '<tr><td>';
				echo "Donnerstag:<p></td>";
				while ($zeile2 = mysql_fetch_assoc( $sql4))
		{
		
			if($donnerstagWoche==date("d.m.Y", $zeile2['date']))
			{
				echo '<tr>';
				echo '<td>';
				echo $zeile2['showname'], date("d.m.Y",$zeile2['date']), date("H:i",$zeile2['time']), date("H:i",$zeile2['end']);
				echo '</td>';
				echo '</tr>';
			}
			}
		echo '</tr>';
		echo '<tr><td>';
		echo "Freitag:<p></td>";
				
				while ($zeile2 = mysql_fetch_assoc( $sql5))
		{
		
			if($freitagWoche==date("d.m.Y", $zeile2['date']))
			{
				echo '<tr>';
				echo '<td>';
				echo $zeile2['showname'], date("d.m.Y",$zeile2['date']), date("H:i",$zeile2['time']), date("H:i",$zeile2['end']);
				echo '</td>';
				echo '</tr>';
			}
		}
				echo '</tr>';
				echo '<tr><td>';
				echo "Samstag:<p></td>";
				while ($zeile2 = mysql_fetch_assoc( $sql6))
		{
		
			if($samstagWoche==date("d.m.Y", $zeile2['date']))
			{
				echo '<tr>';
				echo '<td>';
				echo $zeile2['showname'], date("d.m.Y",$zeile2['date']), date("H:i",$zeile2['time']), date("H:i",$zeile2['end']);
				echo '</td>';
				echo '</tr>';
			}
		}
		echo '</tr>';
		echo '<tr><td>';
		echo "Sonnatg:<p></td>";
				
				while ($zeile2 = mysql_fetch_assoc( $sql7))
		{
		
			if($sonntagWoche==date("d.m.Y", $zeile2['date']))
			{
				echo '<tr>';
				echo '<td>';
				echo $zeile2['showname'], date("d.m.Y",$zeile2['date']), date("H:i",$zeile2['time']), date("H:i",$zeile2['end']);
				echo '</td>';
				echo '</tr>';
			}
		} 
				echo '</tr>';
echo '</table>';
?>