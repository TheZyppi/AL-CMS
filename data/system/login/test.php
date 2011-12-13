<?php

include "login_pruefen.php"; // Datei login_pruefen.php wird geladen
login_pruefen(); // Die Funktion login_pruefen wird ausgeführt

echo session_id();
echo $_SESSION['benutzer'];
echo "<p>";
echo $_SESSION['gruppe'];
?>
<p>
Hier steht dein geschützer Inhalt
