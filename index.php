<?php
/*
Standartindex-Datei
*/

// Include Datein
include('/data/system/design/design.php');
include('/data/system/login/login_pruefen.php');
// Headbereich
login_pruefen();
head();

// Body-Bereich
body();
// Foot-Bereich
foot();
?>