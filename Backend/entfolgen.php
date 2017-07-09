<!-- Das neueste kompilierte und minimierte CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- Optionales Theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<!-- Das neueste kompilierte und minimierte JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>






<?php


include('session.php');
include('userdata.php');
$IDSESSION = $_SESSION ["user_id"];


$fremduser = $_GET ['userid'];   //Fremduser-ID wird mit Methode GET geholt

$pdo = new PDO($dsn, $dbuser, $dbpass);
$statement = $pdo->prepare("DELETE FROM FOLLOWER WHERE ID_user = :IDSESSION AND ID_follower = :fremduser");   //User-Beziehung wird gelöscht
$result = $statement->execute(array('IDSESSION' => $IDSESSION, 'fremduser' => $fremduser));
$user = $statement->fetch();

echo "<div class=\"alert alert-success\" role=\"alert\">Du folgst dieser Person nicht mehr. <a href='/~ks178/Profilseite1.php'>Zurück zum Profil</a> </div>";


?>