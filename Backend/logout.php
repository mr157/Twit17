<?php

session_start();
$_SESSION = array();
session_destroy();   //Session wird zerstört
echo ("Sie haben sich ausgeloggt.<br>");
die('Weiter zum <a href="/~ks178/LogIn.php">LogIn-Bereich</a>');   //User muss sich neu anmelden und wird zur Anmeldeseite weitergeleitet
exit ();

?>


