<?php
echo '<form method="post" action='; print $_SERVER['PHP_SELF']; echo ' >';
     
echo '<table border=0 width="650">
<tr>
		<td width="20%">
		Title Page:<p>
		</td>
		<td width="20%"> 
		<input type="text" name="tpage" size="40">
		</td>
		</tr>
		<tr>
		<tr>
		<td width="20%">
		URL-Path:<p>
		</td>
		<td width="20%"> 
		<input type="text" name="upath" size="40">
		</td>
		</tr>
		<tr>
		<td width="20%">
		Standart Plugin ID:<p>
		</td>
		<td width="20%"> 
		<input type="text" name="spid" size="40">
		</td>
		</tr>
		<td width="20%">
		Standart Design Path::<p>
		</td>
		<td width="20%"> 
		<input type="text" name="sdpath" size="40">
		</td>
		</tr>
		<tr>
		<td>
		<input type="submit" value="Go" name="installsenttings">
		</form>
		</td>
		</tr>
</table>';
?>