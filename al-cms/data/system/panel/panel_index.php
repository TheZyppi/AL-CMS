<?php
$lpl=$_GET['lpl'];
$plf=$_GET['plf'];

echo '
<table border=0>
<tr>
'.$this->menu_head($srdp).'
</tr>
<tr>
<td height=40>
</td>
</tr>
<tr>
';
if(isset($_GET['plf'])=="")
{
	echo "Welcome to the Panel......";
}
else {
	$this->plf($srdp);
}
echo'
</tr>
</table>
';
?>