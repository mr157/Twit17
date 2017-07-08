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


<br><br><br><br>



<br>
<legend></legend>
<br>



<div class="container">
    <div class="row">

        <div class="col-md-8">

            <!-- Ausgabe der Tweets -->
            <div class="tweet">
            <?php
            $pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
            $sql = "SELECT * FROM FOLLOWER WHERE ID_user = $IDSESSION";
            $query = $pdo->prepare($sql);
            $query->execute();
            while ($zeile = $query->fetchObject()) {

                $fremduserid = $zeile->ID_follower;


                $pdo2 = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
                $sql2 = "SELECT * FROM TWEET INNER JOIN USER ON TWEET.tw_user_id=USER.ID WHERE TWEET.tw_user_id = $fremduserid";
                $query2 = $pdo2->prepare($sql2);
                $query2->execute();
                while ($zeile2 = $query2->fetchObject()) {

                    echo " <div class=\" row panel panel-primary\">";
                    echo " <div class=\"panel-heading\">$zeile2->tw_headline";
                    echo "<img class='col-md-1' src='upload/$zeile2->datei' style='width: 8%; height: 8%;'/></div>";
                    echo " <div class=\"col-md-12 panel-body\">";
                    echo " <div class=\"col-md-10\">";
                    echo " Autor: <a href='Profilseite2.php?userid=$zeile->tw_user_id'>$zeile2->vorname</a><br>";
                    echo "      <i>$zeile2->tw_date</i><br><br>";
                    echo "      $zeile2->tw_text<br></div>";
                    $bild = $zeile2->tw_file;
                    if (!empty($bild)) {
                        echo "<div class='col-md-2'> <img src='upload/$zeile2->tw_file' style='width: 100%; height: 100%;'></div>";
                    }
                    echo"</div></div>";
                    echo "<br><br>";

    }


}
?>


</div>










</body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




</html>