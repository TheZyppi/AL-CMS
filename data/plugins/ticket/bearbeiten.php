<?php
     if ($user->data['is_registered'])
    {

$tids=$_GET['tid'];
//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass);

$db_sel = mysql_select_db( $db )
   or die("Auswahl der Datenbank fehlgeschlagen");
   



$query="SELECT * FROM tickets WHERE tid = '".mysql_real_escape_string($tids)."'";
$result=mysql_query($query);
$num=mysql_numrows($result);
$user_id=$user->data['user_id'];
$t_user_id=mysql_result($result,$i,"t_user_id");
$titles=mysql_result($result,$i,"ttitle");
$texts=mysql_result($result,$i,"ttext");

// Ticket wird auf User überprüft
if ($t_user_id==$user_id) {
	
	



 if($_POST['submit'])
{

$ttitle=mysql_real_escape_string($_POST['ttitle']);
$ttext=mysql_real_escape_string($_POST['ttext']);

//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass);

$db_sel = mysql_select_db( $db )
   or die("Auswahl der Datenbank fehlgeschlagen");


$news_update="UPDATE tickets SET ttitle='$ttitle', ttext='$ttext' WHERE tid='".mysql_real_escape_string($tids)."'";
$ausgabe="<center>Sie haben das Ticket ". $ttitle ." erfolgreich erstellt. </center>";
mysql_query($news_update);
echo $ausgabe;
mysql_close();
}
else {
		print("<form method=post action=index.php?mode=bearbeiten&tid=");
 		print(htmlspecialchars($tids));
  		print(">");
echo '
<input type=hidden name=nid value="'.$tids.'">
<table border=0 width=650>
<tr>
<td width=50% colspan=2>
Titel:<p> 
</td>
</tr>
<tr>
<td width=50%>
<input type=text name=ttitle class=inputan size=50 value="'.$titles.'"><br>
</td>
</tr>
<tr>
<td colspan=2>
<br><p>
Text:
</td>
</tr>
<tr>
<td>
';
	$verbindungt = mysql_connect($host, $be, $pass)
    	or die ("Verbindung zum MySQL-Server fehlgeschlagen!");
		mysql_select_db($db, $verbindungt);
		
		//Verbindungsaufbau zur MySQL Datenbank
		$db_sel = mysql_select_db( $db, $verbindungt) 
		or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist

		$vipangebote="select * from ticketkategorie"; 

		$db_erg = mysql_query( $vipangebote );
		if ( ! $db_erg )
		{	
  		die('Ungültige Abfrage: ' . mysql_error());
		}
		echo "
		<select name=auswahl size=1>
		<option value= >Auswahl</option>
		";

		while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
		{
		
		echo "<option value=". $zeile['tid'] .">". $zeile['tktitle']."</option>";	
		
		}
			
echo "
</td>
<tr>
<td colspan=2>
<textarea name=ttext rows=20 cols=75>".$texts."</textarea><p>
</td>
</tr>
<tr>
<td colspan=2 align=center>
<input type=submit value=Update name=submit>
</td>
</tr>
</table>
</form>
";
 }
 }
 else {
 	echo "Das ist nicht ihr Ticket.";
 	}

 
}
else 
{
	echo "Sie sind nicht eingeloggt.";
	}

?>