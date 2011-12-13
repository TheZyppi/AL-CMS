<?php
if ($user->data['is_registered'])
    {
    	    	$ticketid=$_GET['tid']; 	
$user_id=$user->data['user_id'];

//Config wird eingefügt
include('../confids/config.php');


$db_link = mysql_connect ($host, $be, $pass); // MySQL Daten von der Config werden eingefügt

//Verbindungsaufbau zur MySQL Datenbank
$db_sel = mysql_select_db( $db ) 
or die("Verbidnung zur Datenbank fehlgeschlagen"); // Ausgabe wenn die Verbindung zur Datenbank fehlgeschlagen ist
$ticket= "SELECT * FROM tickets WHERE tid=".mysql_real_escape_string($ticketid)." LIMIT 1"; 
$ergebnis = mysql_query($ticket);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
   
if ($auth->acl_get('a_') || $auth->acl_getf_global('m_'))
	{
		if($ticketid==$reihe['tid']) {	
		$ticketl= "DELETE FROM tickets WHERE tid='$ticketid'"; 
		$b=mysql_query($ticketl) or die ("Fehler beim Eintragen!" . mysql_error());	
		
		$ticketcl= "DELETE FROM ticketcomment WHERE tid='$ticketid'"; 
		$c=mysql_query($ticketl) or die ("Fehler beim Eintragen!" . mysql_error());	
 $ausgabe="Du hast das Ticket erfolgreich geloescht.";
 echo $ausgabe;
		}
		else {
				echo "Dieses Ticket exestiert nicht!";
			}
			
		}
		else {
if($ticketid==$reihe['tid']) {	

if($user_id==$reihe['t_user_id']) {	

		$ticketl= "DELETE FROM tickets WHERE tid=".mysql_real_escape_string($ticketid)." LIMIT 1"; 
		$ergebnis2 = mysql_query($ticketl);
		$ticketcl= "DELETE FROM ticketcomment WHERE tid='$ticketid'"; 
		$c=mysql_query($ticketl) or die ("Fehler beim Eintragen!" . mysql_error());
 $ausgabe="Du hast das Ticket erfolgreich geloescht.";
 echo $ausgabe;
 
		}
		else {
	echo "Das ist nicht ihr Ticket.";
	}
}


else {
	echo "Dieses Ticket exestiert nicht!";
	}		
}			
			}
			else {
				echo "Bitte loggen sie sich ein.";
				}
?>