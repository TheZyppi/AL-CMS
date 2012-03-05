<?php
echo '<form method="post" action='; print $_SERVER['PHP_SELF']; echo ' >';
     
echo '
<strong>Benutzername:</strong> <input type="text" name="benutzer" /><br />
<strong>Passwort:</strong> <input type="password" name="passwort" /><br />
<strong>Passwort Wiederholen:</strong> <input type="password" name="passwort2" /><br />
<input type="submit" name="installmadeuser" value="Regestrieren" />
</form>

';
?>