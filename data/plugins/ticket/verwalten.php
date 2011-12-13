<?php
/*Verwaltung der einzelnden Tickets*/

// Überprüfung ob man eingeloggt ist
    if ($user->data['is_registered'])
    {
$ticketid=$_GET['tid']; 	
$user_id=$user->data['user_id'];
$user_name=$user->data['user_name'];

// Admin Verwaltung der Tickets
	if ($auth->acl_get('a_') || $auth->acl_getf_global('m_'))
	{

//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
   
$ticket= "SELECT * FROM tickets WHERE tid=".mysql_real_escape_string($ticketid)." LIMIT 1"; 
$ergebnis = mysql_query($ticket);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   
$ticketc= "SELECT * FROM ticketcomment WHERE tid=".mysql_real_escape_string($ticketid).""; 
$ergebnis = mysql_query($ticketc);


if($reihe['tid']==$ticketid) {


$usera="select * from forum.phpbb_users where user_id=".$reihe['t_user_id'].""; 
$db_erg11 = mysql_query( $usera );
if ( ! $db_erg11 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
while ($a11 = mysql_fetch_array( $db_erg11, MYSQL_ASSOC))
{
	$user=$a11['username'];
	
	}
mysql_free_result( $db_erg11 );
// Ticket
echo "<div id=ticketa><table border=0 rules=groups>";
echo "<tr><td background=../images/tboben.gif height=25px width=680px colspan=3><center>";
echo "".$reihe['ttitle']." - ".$user."";
echo "</center></td></tr>";
echo "<tr bgcolor=#131313><td width=680 height=150 style=padding-left:20px colspan=2>";
echo nl2br($reihe['ttext']);
echo "</td></tr><tr><td height=20></td></tr>";
echo "</table>";

// Comments
while ($reihe2 = mysql_fetch_array( $ergebnis, MYSQL_ASSOC))
{
	$statusid=$reihe2['sid'];
	$usera="select * from forum.phpbb_users where user_id=".$reihe2['t_user_id'].""; 
$db_erg11 = mysql_query( $usera );
if ( ! $db_erg11 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
$a11 = mysql_fetch_array( $db_erg11, MYSQL_ASSOC);
	$user=$a11['username'];
	
	
echo "<table border=0>";
echo "<tr height=20><td></td></tr>";
echo "<tr><td background=../images/tboben.gif height=25px width=680px colspan=3>";
echo "".$reihe2['tcdate']." - ".$user."";
echo "</td></tr>";
echo "<tr><td bgcolor=#191919>";
echo nl2br($reihe2['tctext']);
echo "</td></tr>";
echo "</table>";
}
// Comment erstellen

if($_POST['submit'])
{
	$ticket2= "SELECT * FROM tickets WHERE tid=".mysql_real_escape_string($ticketid)." LIMIT 1"; 
$ergebnis5 = mysql_query($ticket2);
   $reihe5 = mysql_fetch_array($ergebnis5, MYSQL_ASSOC);
   $sidae=$reihe5['sid'];
   
	if ($sidae != $_POST['auswahl']) {
		$statusid = "UPDATE tickets SET sid=".$_POST['auswahl']." WHERE tid=".$ticketid."";
		mysql_query($statusid) or die (mysql_error());
		echo "Erfolgreich geupdtate.";
		echo "<a href=index.php?mode=verwalten&tid=".$ticketid.">Zurueck</a></div>";
		

		}
		else {

if($_POST['text']=="") {
		echo "Sie haben keinen Text fuer das Ticket geschrieben.";
		}
		else {
//Config.php wird hinzugefügt
include('../confids/config.php');

$n_user_id=$user->data['user_id'];
$verbindung = mysql_connect($host, $be, $pass)
    or die ("Verbindung zum MySQL-Server fehlgeschlagen!");

mysql_select_db($db, $verbindung);

$commenteintragen = "INSERT INTO ticketcomment (tid, t_user_id, tctext)
        VALUES ('".mysql_real_escape_string($ticketid)."','".mysql_real_escape_string($user_id)."', '".mysql_real_escape_string($_POST['text'])."')";

$ausgabe="<center>Sie haben das Ticket erfolgreich kommentiert. </center></div>";
mysql_query($commenteintragen) or die (mysql_error());

mysql_close($verbindung);
echo $ausgabe;
echo "<a href=index.php?mode=verwalten&tid=".$ticketid.">Zurueck</a>";
}
}
}
else {
	

// Comment Forumlar
		print("<form method=post action=index.php?mode=verwalten&tid=");
 		print(htmlspecialchars($ticketid));
  		print(">");
echo "
<table border=0 width=650>
<tr>
<td colspan=2>
<br><p>
Antworten:
</td>
</tr>
<tr>
<td colspan=2>
<textarea name=text rows=5 cols=40 maxlength=1600></textarea>
</td>
</tr>
<tr>
<td colspan=2 align=center>
<br>
</td>
</tr>
<tr>
<td>
<p>";
$ticket= "SELECT * FROM tickets WHERE tid=".mysql_real_escape_string($ticketid)." LIMIT 1"; 
$ergebnis2 = mysql_query($ticket);
   $reihe3 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
		$status="select * from status where sid=".$reihe3['sid'].""; 
		$ergebnis3 = mysql_query($status);
   $reihe4 = mysql_fetch_array($ergebnis3, MYSQL_ASSOC);
		$status2="select * from status";


		$db_erg = mysql_query( $status2 );
		if ( ! $db_erg )
		{	
  		die('Ungültige Abfrage: ' . mysql_error());
		}
		echo "
		<select name=auswahl size=1>
		<option value=".$reihe4['sid']." >".$reihe4['stitle']."</option>
		";

		while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
		{
		
		echo "<option value=". $zeile['sid'] .">". $zeile['stitle']."</option>";	
		
		}

echo "
	</td>
	</tr>
	<tr>
	<td colspan=2 align=center>
<input type=submit value=speichern name=submit>
</td>
</tr>
</table>
</form>
</div>
";
}
}
else {
	echo "Dieses Ticket gibt es nicht!";
	}
}
// User Verwaltung der Tickets
else {
	
//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
   
$ticket= "SELECT * FROM tickets WHERE tid=".mysql_real_escape_string($ticketid)." LIMIT 1"; 
$ergebnis = mysql_query($ticket);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   
$ticketc= "SELECT * FROM ticketcomment WHERE tid=".mysql_real_escape_string($ticketid).""; 
$ergebnis = mysql_query($ticketc);


if($reihe['tid']==$ticketid) {


$usera="select * from forum.phpbb_users where user_id=".$reihe['t_user_id'].""; 
$db_erg11 = mysql_query( $usera );
if ( ! $db_erg11 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
while ($a11 = mysql_fetch_array( $db_erg11, MYSQL_ASSOC))
{
	$user=$a11['username'];
	
	}
mysql_free_result( $db_erg11 );
// Ticket
echo "<div id=ticketa><table border=0 rules=groups>";
echo "<tr><td background=../images/tboben.gif height=25px width=680px colspan=3><center>";
echo "".$reihe['ttitle']." - ".$user."";
echo "</center></td></tr>";
echo "<tr bgcolor=#131313><td width=680 height=150 style=padding-left:20px colspan=2>";
echo nl2br($reihe['ttext']);
echo "</td></tr><tr><td height=20></td></tr>";
echo "</table>";

// Comments
while ($reihe2 = mysql_fetch_array( $ergebnis, MYSQL_ASSOC))
{
	$statusid=$reihe2['sid'];
	$usera="select * from forum.phpbb_users where user_id=".$reihe2['t_user_id'].""; 
$db_erg11 = mysql_query( $usera );
if ( ! $db_erg11 )
{
  die('Ungültige Abfrage: ' . mysql_error());
}
$a11 = mysql_fetch_array( $db_erg11, MYSQL_ASSOC);
	$user=$a11['username'];
	
	
echo "<table border=0>";
echo "<tr height=20><td></td></tr>";
echo "<tr><td background=../images/tboben.gif height=25px width=680px colspan=3>";
echo "".$reihe2['tcdate']." - ".$user."";
echo "</td></tr>";
echo "<tr><td bgcolor=#191919>";
echo nl2br($reihe2['tctext']);
echo "</td></tr>";
echo "</table>";
}
// Comment erstellen

if($_POST['submit'])
{
	$ticket2= "SELECT * FROM tickets WHERE tid=".mysql_real_escape_string($ticketid)." LIMIT 1"; 
$ergebnis5 = mysql_query($ticket2);
   $reihe5 = mysql_fetch_array($ergebnis5, MYSQL_ASSOC);
   $sidae=$reihe5['sid'];
   
	if ($sidae != $_POST['auswahl']) {
		$statusid = "UPDATE tickets SET sid=".$_POST['auswahl']." WHERE tid=".$ticketid."";
		mysql_query($statusid) or die (mysql_error());
		echo "Erfolgreich geupdtate.<p>";
		echo "<a href=index.php?mode=verwalten&tid=".$ticketid.">Zurueck</a></div>";

		}
		else {

if($_POST['text']=="") {
		echo "Sie haben keinen Text fuer das Ticket geschrieben.";
		}
		else {
//Config.php wird hinzugefügt
include('../confids/config.php');

$n_user_id=$user->data['user_id'];
$verbindung = mysql_connect($host, $be, $pass)
    or die ("Verbindung zum MySQL-Server fehlgeschlagen!");

mysql_select_db($db, $verbindung);

$commenteintragen = "INSERT INTO ticketcomment (tid, t_user_id, tctext)
        VALUES ('".mysql_real_escape_string($ticketid)."','".mysql_real_escape_string($user_id)."', '".mysql_real_escape_string($_POST['text'])."')";

$ausgabe="<center>Sie haben das Ticket erfolgreich kommentiert. </center></div>";
mysql_query($commenteintragen) or die (mysql_error());

mysql_close($verbindung);
echo $ausgabe;
echo "<a href=index.php?mode=verwalten&tid=".$ticketid.">Zurueck</a>";
}
}
}
else {
	

// Comment Forumlar
		print("<form method=post action=index.php?mode=verwalten&tid=");
 		print(htmlspecialchars($ticketid));
  		print(">");
echo "
<table border=0 width=650>
<tr>
<td colspan=2>
<br><p>
Antworten:
</td>
</tr>
<tr>
<td colspan=2>
<textarea name=text rows=5 cols=40 maxlength=1600></textarea>
</td>
</tr>
<tr>
<td colspan=2 align=center>
<br>
</td>
</tr>
<tr>
<td>
<p>";
$ticket= "SELECT * FROM tickets WHERE tid=".mysql_real_escape_string($ticketid)." LIMIT 1"; 
$ergebnis2 = mysql_query($ticket);
   $reihe3 = mysql_fetch_array($ergebnis2, MYSQL_ASSOC);
		$status="select * from status where sid=".$reihe3['sid'].""; 
		$ergebnis3 = mysql_query($status);
   $reihe4 = mysql_fetch_array($ergebnis3, MYSQL_ASSOC);
		$status2="select * from status";


		$db_erg = mysql_query( $status2 );
		if ( ! $db_erg )
		{	
  		die('Ungültige Abfrage: ' . mysql_error());
		}
		echo "
		<select name=auswahl size=1>
		<option value=".$reihe4['sid']." >".$reihe4['stitle']."</option>
		";

		while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
		{
		
		echo "<option value=". $zeile['sid'] .">". $zeile['stitle']."</option>";	
		
		}

echo "
	</td>
	</tr>
	<tr>
	<td colspan=2 align=center>
<input type=submit value=speichern name=submit>
</td>
</tr>
</table>
</form>
</div>
";
}
}
else {
	echo "Dieses Ticket gibt es nicht!";
	}
}
}
// Fehler ausgabe wenn man nicht eingeloggt ist.
else {
	echo "Um das Ticket angucken bitte einloggen!";
	}
?>