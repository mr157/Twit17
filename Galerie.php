<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Die 3 Meta-Tags oben *müssen* zuerst im head stehen; jeglicher sonstiger head-Inhalt muss *nach* diesen Tags kommen -->
    <title>Twitter2</title>

    <!-- Das neueste kompilierte und minimierte CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Optionales Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- Das neueste kompilierte und minimierte JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="CSS.css" rel="stylesheet">
</head>



<?php

include('Backend/session.php');
include ('Backend/userdata.php');

$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
$IDSESSION = $_SESSION ["user_id"];


$statement = $pdo->prepare("SELECT * FROM USER WHERE ID = :IDSESSION");
$result = $statement->execute(array('IDSESSION' => $IDSESSION));
$user = $statement->fetch();
$vorname = $user['vorname'];  //Vorname des eingeloggten Users wird zur Begrüßung in der Navigationsleiste angezeigt

?>



<body>



<br><br><br>







<!--Navigationsleiste-->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Navigation ein-/ausblenden</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Willkommen &nbsp;<?PHP echo $vorname; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="Profilseite1.php">Profil</a></li>
                <li><a href="Galerie.php">Galerie</a></li>
                <li><a href="Profilseite3.php">Tweets meiner Freunde</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Einstellungen <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="Profilverwaltung.php">Profilverwaltung &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true"</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="Backend/logout.php">Abmelden &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-log-out" aria-hidden="true"</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>






<div class="container">
    <legend>Meine Galerie</legend>
    <div class="row">


<?php
include('Backend/session.php');
include ('Backend/userdata.php');

$IDSESSION = $_SESSION ["user_id"];
$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
$sql = "SELECT * FROM TWEET WHERE tw_user_id = $IDSESSION";   //Inhalte der eingeloggten USER-ID werden ausgewählt
$query = $pdo->prepare($sql);
$query->execute();
while ($zeile = $query->fetchObject()) {
    $bild = $zeile->tw_file;
    if (!empty($bild AND $bild !==".")) {

        echo "<div class=\"col-md-4 spacer\"> <img class='img-responsive' src='upload/$zeile->tw_file'></div>";   //Ausgabe aller hochgeladenen Bild-Dateien

    }
}

?>

</div></div>






</body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




</html>

