<?php
// Data-Right-Security-Open-Check
if (!defined('ON_ALCMS') || isset($_SESSION['group'])=="")
{
	echo "Error: You are not use ALCMS!";
	exit;
}
else {
echo '
<table border=0>
<tr>
';
$this->menu_head($srdp);
echo '
</tr>
<tr>
<td height=40>
</td>
</tr>
<tr>
<td>
';
if(isset($_GET['plf'])=="")
{
	$this->panel_info($srdp);
}
else {
	$this->plf($srdp);
}
echo'
</td>
</tr>
</table>
';
}
?>