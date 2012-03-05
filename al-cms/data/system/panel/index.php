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
	$sql1=mysql_query("SELECT PID, LPLID, name, data, sp, aktiv FROM panel WHERE LPLID=".$lpl."");
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
		include(''.$srdp.'/system/panel/'.$reihe['data'].'');	
		}
	}
}
?>