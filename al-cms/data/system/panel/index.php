<?php
if(isset($_GET['hpl'])=="" || $_GET['hpl'] && isset($_GET['lpl'])=="" || $_GET['lpl'])
{
	echo "No Plugin!";
}
else if(isset($_GET['hpl'])=="")
{
	echo "No Head Plugin use.";
}
else if(isset($_GET['lpl'])=="")
{
	echo "No Panel in use.";
}
else {
	$hpl=$_GET['hpl'];
	$lpl=$_GET['lpl'];
	// Check the lpl 
	if (preg_match ("/^([0-9]+)$/",$lpl)) {
	$sql1=mysql_query("SELECT PID, LPLID, name, data, sp, aktiv FROM panel WHERE LPLID=".mysql_real_escape_string($lpl)."");
	}
	else {
		$sql = "SELECT LPLID, name, data, aktiv FROM lower_plugins WHERE name = '".mysql_real_escape_string($lpl)."'";
   $ergebnis = mysql_query($sql) or die (mysql_error());
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);	
		$sql1=mysql_query("SELECT PID, LPLID, name, data, sp, aktiv FROM panel WHERE LPLID=".$reihe['LPLID']."");
	}
	if(!$sql1)
	{
		echo "This panel are not exist.";
	}
	else {
		$reihe=mysql_fetch_array($sql1);
		if(!$reihe['aktiv']!=1)
		{
			echo "This panel is not akivated.";
		}
		else {
			$sql2="SELECT PID, GID FROM panel_group WHERE PID=".$reihe['PID']."";
			$reihe2=mysql_fetch_array($sql2);
			$group=$_SESSION['group'];
			if($reihe2['GID']!=$group)
			{
				echo "Your Group ist not allowed to use it.";
			}
			else {
		include("panel_classes.php");
				$panelsys->panel_index($srdp);
			}	
		}
	}
}
?>