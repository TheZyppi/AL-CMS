<?php
function comment_post($srdp)
{
	if (isset($_POST['submit']))
	{
		if ($_POST['comment']=="")
		{
			echo "SIe haben kein Komment eingetragen.";
		}
		else
			{
		$time=time();
		$comp=mysql_query("INSERT INTO comments (NID, UID, comment, ctime) VALUES ('".$_GET['nid']."', '1', '".$_POST['comment']."', '".$time."')");
		echo 'Sie haben den Kommentar erfolgreich erstellt.';
		}
		}
	else {
echo '
<form method="post" action="index.php?hpl='.$_GET['hpl'].'&plf='.$_GET['plf'].'&nid='.$_GET['nid'].'">
<table border=0 width=650>
<tr>
<td colspan=2>
<br><p>
Comment:
</td>
</tr>
<tr>
<td colspan=2>
<textarea name=comment rows=10 cols=20 maxlength=1600></textarea>
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
';
	}
}
?>