<?php

if ($user->data['is_registered'])
    {
    	if ($auth->acl_get('a_') || $auth->acl_getf_global('m_'))
{

if($_POST['submit'])
{
		// Abfrage ob alles eineben wurde oder nicht.
		if ($_POST['vbide']=="" && $_POST['cash']=="" && $_POST['summe']=="" && $_POST['auswahl']=="")
		{
		echo "		
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Cash-Inn</h2></div>
  		<div class=vipfmitte>		
		Sie haben vergessen alles einzugeben. Bitte f&uuml;llen Sie das ganze Formular aus.
		</div>
		</div>";
		}		
		// Ausgabe wenn man nur den Vornamen vergessen hat einzugeben.
		else if ($_POST['vbide']=="")
		{
		echo "
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Cash-Inn</h2></div>
  		<div class=vipfmitte>
  		Sie haben vergessen die Bestellungsnummer einzugeben.
  		</div>
  		</div>";	
		}
		// Ausgaben wenn man vergessen hat den Nachnamen einzugeben.
		else if ($_POST['cash']=="") 
		{
		echo "
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Cash-Inn</h2></div>
  		<div class=vipfmitte>
  		Sie haben vergessen das Geld einzugeben.
  		</div>
  		</div>";	
		}
		// Ausgaben wenn man vergessen hat die Email-Adresse einzugeben.
		else if ($_POST['summe']=="")
		{
		echo "
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Cash-Inn</h2></div>
  		<div class=vipfmitte>
  		Sie haben vergessen die Summe des Geldes einzugeben.
  		</div>
  		</div>";	
		}
		else if ($_POST['auswahl']=="")
		{
		echo "
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-PayPal</h2></div>
  		<div class=vipfmitte>
  		Sie haben vergessen eine Kategorie anzugeben.
  		</div>
  		</div>";	
		}
		// Ausgabe wenn alle Daten stimmen.
		else {
		//Config.php wird hinzugefügt
		include('../confids/config.php');

		$v_user_id=$user->data['user_id'];
		$v_username=$user->data['username'];
		$id=$_POST['vbide'];
		$cash=$_POST['cash'];
		$summe=$_POST['summe'];
		$auswahl=$_POST['auswahl'];

		$verbindung = mysql_connect($host, $be, $pass)
    	or die ("Verbindung zum MySQL-Server fehlgeschlagen!");
		mysql_select_db($db, $verbindung);

		// Bestellung wird eingetragen
		$eintrag1="INSERT INTO vip_cash (vbid, v_a_user_id, vcash, sum, vbaid) VALUES 
		('". $id ."', '". $v_user_id ."', '". $cash ."', '". $summe ."', '". $auswahl ."')";
	$a=mysql_query($eintrag1) or die ("Fehler beim Eintragen! 1");

$ausgabe="
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Eingetragen</h2></div>
  		<div class=vipfmitte>				
		Cash wurde erfolgreich eingetragen.<p>
		</div>
		</div>";	
		
	echo $ausgabe;

		}
		}

		else {
	
		
 		
  		echo '
  		<div id=vipall>
  		<div class=vipoben><h2>VIP-Cash-Inn</h2></div>
  		<div class=vipfmitte>
  		<p><br><p><br>
  		<form method=post action=index.php?mode=ceintragen>
		<table border=0 width="650">
		<tr>
		<td width="20%">		Bestellungs-ID:<p>
		</td>
		<td width="20%">
		<input type="text" name="vbide" size="40" maxlength="11" class="inputan">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Cash:<p>
		</td>
		<td width="50%">
		<input type="text" name="cash" size="40"  class="inputan">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Summe:<p>
		</td>
		<td width="20%">
		<input type="text" name="summe" size="40" maxlength="6" class="inputan">
		</td>
		</tr>
		<tr>
		<td width="20%">
		';
		//Config.php wird hinzugefügt
		include('../confids/config.php');
		
		$verbindungt = mysql_connect($host, $be, $pass)
    	or die ("Verbindung zum MySQL-Server fehlgeschlagen!");
		mysql_select_db($db, $verbindungt);
		
		//Verbindungsaufbau zur MySQL Datenbank
		$db_sel = mysql_select_db( $db, $verbindungt) 
		or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist

		$vipangebote="select * from vip_bezahlungs_arten"; 

		$db_erg = mysql_query( $vipangebote );
		if ( ! $db_erg )
		{	
  		die('Ungültige Abfrage: ' . mysql_error());
		}
		echo '
		<select name="auswahl" size="1">
		<option value="" >Auswahl</option>
		';

		while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
		{
		echo "<option value=". $zeile['vbaid'] .">". $zeile['vbatitle']."</option>";	

		}
		echo '
		</td>
		</tr>
		<tr>
		<td width="20%">
		<td colspan=2 align="center">
		<br>
		<p>
		<input type="submit" value="Absenden" name="submit">
		</form>
		</td>
		</tr>
		</table>
		</div>
		</div>';
		}
		}
		else if ($auth->acl_getf_global('m_'))
{
	echo "Sie haben keine Berechtigung Geld einzutragen.";
}
}
else {
	echo "Sie haben keine Berechtigung Geld einzutragen.";
	}
?>
 