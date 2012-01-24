<?php
if (isset($_POST['sumbit5']))
{
	
}
else {
	echo '<form method="post" action="';print $_SERVER['PHP_SELF']; echo'>';
echo '<table border=0 width="650">
<tr>
		<td width="20%">
		Kontonummer:<p>
		</td>
		<td width="20%">
		<input type="text" name="kontonummer" size="40">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Bankleitzahl:<p>
		</td>
		<td width="20%">
		<input type="text" name="bankleitzahl" size="40">
		</td>
		</tr>
		<tr>
		<td>
		<input type="submit" value="Weiter" name="submit5">
		</td>
		</tr>
		</form>
</table>';
}

?>