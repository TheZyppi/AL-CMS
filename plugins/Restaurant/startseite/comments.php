<?php
function comments($srdp)
{
	$coma="SELECT PCOID, NID, UID, comment, ctime FROM comments WHERE NID='".$_GET['nid']."'";
	$comq=mysql_query($coma);
	while($row2=mysql_fetch_array($comq))
	{
		echo '
		<table>
		<tr>
		<td>
		';
		echo $row2['comment'];
		echo '
		</td>
		</tr>
		';		
	}
	echo "</table>";
	echo pluginsystem::funktionin($srdp, 'comment_post', 'h', 'Startseite', '');
}

?>
