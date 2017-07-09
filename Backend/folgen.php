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


//Follow-Beziehung von eingeloggtem User und Fremduser wird untersucht
$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
$sql = ("SELECT * FROM FOLLOWER WHERE ID_user = :IDSESSION AND ID_follower = :fremduser");
$query = $pdo->prepare($sql);
$query->execute(array('IDSESSION' => $IDSESSION, 'fremduser' => $fremduser));
while ($zeile = $query->fetchObject()) {
    $beziehungvorhanden = 1; }





//Wenn keine Beziehung besteht, wird eine Beziehung angelegt
if ($beziehungvorhanden == 0) {
    $pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
    $statement = $pdo->prepare("INSERT INTO FOLLOWER (ID_user, ID_follower) VALUES (:IDSESSION, :fremduser)");
    $result = $statement->execute(array('IDSESSION' => $IDSESSION, 'fremduser' => $fremduser));
    $user = $statement->fetch();
    echo "<div class=\"alert alert-success\" role=\"alert\">Du folgst nun dieser Person. <a href='/~ks178/Profilseite1.php'>Zurück zum Profil</a> </div>";
}


//Wenn eine Beziehung bereits besteht, wird der User darauf aufmerksam gemacht
if ($beziehungvorhanden == 1) {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Du folgst dieser Person bereits. <a href='/~ks178/Profilseite1.php'>Zurück zum Profil</a></div>";
}





?>


