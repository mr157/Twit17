<!-- Das neueste kompilierte und minimierte CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- Optionales Theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<!-- Das neueste kompilierte und minimierte JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>





<?php

session_start();
$_SESSION = array();
session_destroy();   //Session wird zerstört
echo "<div class=\"alert alert-success\" role=\"alert\">
        <a href=\"../Profilseite1.php\" class=\"alert-link\">Sie haben sich ausgeloggt. Weiter zum Login-Bereich.</a>
        </div>";
exit ();

?>

