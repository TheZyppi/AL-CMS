<?php
if($_POST['submit'])
{
		// Abfrage ob alles eineben wurde oder nicht.
		if ($_POST['paypal_email']=="" && $_POST['v_name']=="" && $_POST['v_nachname']=="" && $_POST['v_email']=="" && $_POST['auswahl']=="")
		{
		echo "		
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-PayPal</h2></div>
  		<div class=vipfmitte>		
		Sie haben vergessen alles einzugeben. Bitte f&uuml;llen Sie das ganze Formular aus.
		</div>
		</div>";
		}		
		// Ausgabe wenn man nur den Vornamen vergessen hat einzugeben.
		else if ($_POST['v_name']=="")
		{
		echo "
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-PayPal</h2></div>
  		<div class=vipfmitte>
  		Sie haben vergessen ihren Vornamen anzugeben.
  		</div>
  		</div>";	
		}
		// Ausgaben wenn man vergessen hat den Nachnamen einzugeben.
		else if ($_POST['v_nachname']=="") 
		{
		echo "
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-PayPal</h2></div>
  		<div class=vipfmitte>
  		Sie haben vergessen Nachnamen anzugeben.
  		</div>
  		</div>";	
		}
		// Ausgaben wenn man vergessen hat die Email-Adresse einzugeben.
		else if ($_POST['v_email']=="")
		{
		echo "
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-PayPal</h2></div>
  		<div class=vipfmitte>
  		Sie haben vergessen ihre Email anzugeben.
  		</div>
  		</div>";	
		}
		// Ausgabe wenn man vergessen hat ein Angebot auszuwählen.
		else if ($_POST['auswahl']=="")
		{
		echo "
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-PayPal</h2></div>
  		<div class=vipfmitte>
  		Sie haben vergessen ein Angebot anzugeben.
  		</div>
  		</div>";	
		}
		// Ausgabe wenn man vergessen hat seine Paypal-Email-Adresse anzugeben.
		else if ($_POST['paypal_email']=="")
		{
		echo "
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-PayPal</h2></div>
  		<div class=vipfmitte>
  		Sie haben vergessen ihre Paypal-Email anzugeben.
  		</div>
  		</div>";	
		}
		// Ausgabe wenn alle Daten stimmen.
		else {
		//Config.php wird hinzugefügt
		include('../confids/config.php');

		//VBAID wird von der URL übernommen
		$vbaid=$_GET['vbaid'];
		$v_user_id=$user->data['user_id'];
		$v_username=$user->data['username'];

		$verbindung = mysql_connect($host, $be, $pass)
    	or die ("Verbindung zum MySQL-Server fehlgeschlagen!");
		mysql_select_db($db, $verbindung);

		// Bestellung wird eingetragen
		$vipbestellung = "INSERT INTO vip_bestellungen (sid, v_user_id, v_name, v_nachname, `v_email`)
		VALUES ('1','". $v_user_id ."'  , '". $_POST['v_name'] ."' ,'". $_POST['v_nachname'] ."', '". $_POST['v_email'] ."')"; // VKID =1 FÜR MINECRAFT wenn andere noch WoW dann Tabelle
		$a=mysql_query($vipbestellung) or die ("Fehler beim Eintragen! 1");

		// Bestellungs ID wird abgefragt

		$vipbestellungsid=mysql_insert_id();

		// Die Paypal Email-Adresse wird eingetragen deswegen wird auch nur die Spalte b1 benutzt.

		$vipbb="INSERT INTO vip_bezahlung (vbid, vbaid, b1) VALUES 
		('". $vipbestellungsid ."', '". $vbaid ."' , '". $_POST['paypal_email'] ."')";
		$b=mysql_query($vipbb) or die ("Fehler beim Eintragen! 2" . mysql_error());

		// Die Ware/Angebot wird eingetragen + Bestellungs ID

		$vbl="INSERT INTO vip_bestellungen_liste (vbid, vaid) VALUES ('". $vipbestellungsid ."', '". $_POST['auswahl'] ."')";
		$c=mysql_query($vbl) or die ("Fehler beim Eintragen! 3" . mysql_error());

		// Ausgabe wenn alles erfolgreich eingetragen wurde.

		$ausgabe="
		<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-PayPal</h2></div>
  		<div class=vipfmitte>				
		". $v_username ." vielen Dank f&uuml;r ihre Bestellung. <p> Sie m&uuml;ssen nur noch bezahlen:<p>
		<form action=https://www.paypal.com/cgi-bin/webscr method=post>
<input type=hidden name=cmd value=_s-xclick>
<input type=hidden name=hosted_button_id value=8GXCALXR7GY3S>
<input type=image src=https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donateCC_LG.gif border=0 name=submit alt=Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.>
<img alt= border=0 src=https://www.paypalobjects.com/de_DE/i/scr/pixel.gif width=1 height=1>
</form>

		</div>
		</div>";



		mysql_close($verbindung);
		echo $ausgabe;
		}
		}

		else {
		$vbaids=$_GET['vbaid'];	
		print("<form method=post action=index.php?vbaid=");
 		print(htmlspecialchars($vbaids));
  		print(">");
  
  		echo '
  		<div id=vipall>
  		<div class=vipoben><h2>VIP-Bestellung-Paypal</h2></div>
  		<div class=vipfmitte>
  		<p><br><p><br>
		<table border=0 width="650">
		<tr>
		<td width="20%">
		</td>
		<td width="20%">
		<input type="text" name="v_name" size="40" maxlength="25" class="inputan">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Nachname:<p>
		</td>
		<td width="50%">
		<input type="text" name="v_nachname" size="40" maxlength="25" class="inputan">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Mailadresse:<p>
		</td>
		<td width="20%">
		<input type="text" name="v_email" size="40" maxlength="40" class="inputan">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Paypal-Mail:<p>
		</td>
		<td width="20%">
		<input type="text" name="paypal_email" size="40" maxlength="40" class="inputan">
		</td>
		</tr>
		<tr>
		<td height=20px>
		</td>
		</tr>
		<tr>
		<td colspan=2 align="center">
		<h3>Angebots-Auswahl</h3>
		</td>
		</tr>
		<tr> <!-- Abstandshalter zwischen Normalen-Daten und Ukash angaben -->
		<td height=20px> 
		</td>
		</tr>
		<tr>
		<td colspan=2 align="center">
		';
		$verbindungt = mysql_connect($host, $be, $pass)
    	or die ("Verbindung zum MySQL-Server fehlgeschlagen!");
		mysql_select_db($db, $verbindungt);
		
		//Verbindungsaufbau zur MySQL Datenbank
		$db_sel = mysql_select_db( $db, $verbindungt) 
		or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist

		$vipangebote="select * from vip_angebote WHERE aaz=1"; 

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
		
		echo "<option value=". $zeile['vaid'] .">". $zeile['vatitle'].", ". $zeile['vapreis']." &#128;</option>";	
		
		}
			
	
		echo '
		</td>
		</tr>
		<tr>
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
?>