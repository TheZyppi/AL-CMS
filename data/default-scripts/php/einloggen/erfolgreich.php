<!DOCTYPE xhtml PUBLIC "-//W3C//DTDB XHTML 1.0 Strict// EN" "http://www.w3.org/TR/xhtml/
  DTD/xhtml1-strict.dtd">
  

 <html xmlns="http://www.w3.org/1999/xhtml">
<!-- Head Bereich fängt an -->
<head>
<!-- CSS Datein werden eingefügt -->
<link rel="stylesheet" title="Normal" href="css/seite.css" type="text/css">
<!-- Meta Daten werden eingefügt + Titel -->
   
   <?php
   include('confids/configtitle.php');
   echo "<title>".$titlep, $home."</title>";
   include ('data/meta/meta.htm');
   ?>


</head>
<!-- Head Bereich Ende -->

<!-- Body Bereich Anfang -->
<body>
<!-- Beginn des Inhalsbereichs -->
<div id=top>
<?php
 define('IN_PHPBB', true);
    $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../forum/';
    $phpEx = substr(strrchr(__FILE__, '.'), 1);
    require($phpbb_root_path . 'common.' . $phpEx);

    // Start session management
    $user->session_begin();
    $auth->acl($user->data);
    
    $test=$user->data['username'];
echo $test;
?>
</div>
</body>
</html>