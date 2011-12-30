<?php
// Es wird geguckt ob er eingeloggt ist
	
$user_id=$user->data['user_id'];
$group_id=$user->data['group_id'];
$user_name=$user->data['user_name'];

  if ($user->data['is_registered'])
{
	
if($_POST['submit'])
{
	if($_POST['title']=="") {
		echo "Sie haben kein Titel fuer das Ticket angegeben.";
		}
	else if($_POST['text']=="") {
		echo "Sie haben keinen Text fuer das Ticket geschrieben.";
		}
		else {
		
//Config.php wird hinzugefügt
include('../confids/config.php');

$n_user_id=$user->data['user_id'];
$verbindung = mysql_connect($host, $be, $pass)
    or die ("Verbindung zum MySQL-Server fehlgeschlagen!");

mysql_select_db($db, $verbindung);

$commenteintragen = "INSERT INTO tickets (tkid, sid, 	t_user_id, t_group_id, ttitle, ttext)
        VALUES ('".mysql_real_escape_string($_POST['auswahl'])."', '1', '".mysql_real_escape_string($user_id)."', '".mysql_real_escape_string($group_id)."', '".mysql_real_escape_string($_POST['title'])."', '".mysql_real_escape_string($_POST['text'])."')";

$ausgabe="<center>Sie haben das Ticket erfolgreich erstellt. </center>";

mysql_query($commenteintragen) or die ("Fehler beim Eintragen!");

mysql_close($verbindung);
echo $ausgabe;
}
}
// Comment Forumlar
		print("<form method=post action=index.php?mode=eintragen&tkid=");
 		print(htmlspecialchars($tickekatid));
  		print(">");
echo "
<table border=0 width=650>
<tr>
<td width=50%>
Titel:<p>
</td>
<td>";
//Config.php wird hinzugefügt
include('../confids/config.php');

$n_user_id=$user->data['user_id'];
$verbindung = mysql_connect($host, $be, $pass)
    or die ("Verbindung zum MySQL-Server fehlgeschlagen!");

mysql_select_db($db, $verbindung);
		$ticketk="select * from ticketkategorie";


		$db_erg = mysql_query( $ticketk );
		if ( ! $db_erg )
		{	
  		die('Ungültige Abfrage: ' . mysql_error());
		}
		echo "
		<select name=auswahl size=1>
		<option value=>Auswahl</option>
		";

		while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
		{
		
		echo "<option value=". $zeile['tkid'] .">". $zeile['tktitle']."</option>";	
		
		}
echo "
</td>
</tr>
<tr>
<td width=50%>
<input type=text name=title size=40 maxlength=40 class=inputan>
</td>
</tr>
<tr>
<td colspan=2>
<br><p>
Text:
</td>
</tr>
<tr>
<td colspan=2>
<textarea name=text rows=20 cols=75 maxlength=1600></textarea>
</td>
</tr>
<tr>
<td colspan=2 align=center>
<br>
<p>


	
<input type=submit value=speichern name=submit>

</form>
</td>
</tr>
</table>
";


}

?>