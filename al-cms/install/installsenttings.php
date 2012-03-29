<?php
include('../data/config/dbcon.php');
db_con();
$install1=mysql_query("INSERT INTO `al_config` (
`name`, 
`funktion`, 
`aktiv`) 
VALUES (
'Title from the Page', '".$_POST['tpage']."', '1'
);
");
$install2=mysql_query("INSERT INTO `al_config` (
`name`, 
`funktion`, 
`aktiv`) 
VALUES (
'Standart URL Path to the Page', '".$_POST['upath']."', '1'
);
");
$install3=mysql_query("INSERT INTO `al_config` (
`name`, 
`funktion`, 
`aktiv`) 
VALUES (
'Standart Plugin ID', '".$_POST['spid']."', '1'
);
");
$install4=mysql_query("INSERT INTO `al_config` (
`name`, 
`funktion`, 
`aktiv`) 
VALUES (
'Design Path', '".$_POST['sdpath']."', '1'
);
");
echo "<font color=green>Config ready!</font>";
echo '<form method="post" action="'; print $_SERVER['PHP_SELF']; echo'">';
	echo '
		<input type="submit" value="Go" name="madeuser">
		</form>
		';
?>