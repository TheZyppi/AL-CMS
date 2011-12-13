<!DOCTYPE xhtml PUBLIC "-//W3C//DTDB XHTML 1.0 Strict// EN" "http://www.w3.org/TR/xhtml/
  DTD/xhtml1-strict.dtd">

<html>
<!-- Head Bereich fängt an -->
<head>
<!-- CSS Datein werden eingefügt -->

  <link rel="stylesheet" title="Normal" href="../../css/seite.css" type="text/css">
<!-- Meta Daten werden eingefügt + Titel -->
   <?php
   include('../../confids/config.php');
   echo "<title>". $titlep."</title>";

   include ('../meta/meta.htm');
?>
</head>
<!-- Head Bereich Ende -->

<!-- Body Bereich Anfang -->
<body>
<!-- Beginn des Inhalsbereichs -->
<div id=top>
<div id="obermens"></div>
<!--Menü-->
<?php
include ('../menues/menuerror.htm');
?>
<!--Menü Ende-->


<div id=logo> <!-- Logo -->
</div> <!-- Logo Ende-->


<div id=utost> <!-- Anstandhalter -->
</div>
<div id=texte>

<h3>Fehler: Adresse ist nicht G&uuml;ltig! </h3><P> 
<a href="../../index.php" ><font color=red>Zur Homepage zur&uuml;ckkehren</font></a>
</div> 


 <!--Food-->
<?php
include ('../foot/fooderror.php');
?>
<!--Food Ende-->

</div> <!-- Ende des Inhalsbereichs -->
</div>
</body>
</html>
