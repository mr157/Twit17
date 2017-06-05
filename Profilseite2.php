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
$fremduserid = $_GET ['userid'];

$sql = "SELECT * FROM USER WHERE ID = :fremduserid";
$query = $pdo->prepare($sql);
$query->execute(array('fremduserid' => $fremduserid));
while ($zeile = $query->fetchObject()) {
    $profilbildurl = $zeile->datei;
}
?>

<body>



<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
</div>


<!-- Navigationsbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Navigation ein-/ausblenden</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="Profilseite1.php">Willkommen</a>
        </div>
    </div>
</nav>


<br><br><br><br>


<!-- Profilbild -->
<div class="container">
    <div class="row">
        <div class="profile-header-container">
            <div class="profile-header-img">
                <?php
                echo "<img class='img-circle' src='upload/$profilbildurl' style='width: 15%; height: 15%;'/>";?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="well well-sm">
                <div class="media">
                    <div class="media-body">
                            <a href="#" class="btn btn-xs btn-default follow"><span class="glyphicon glyphicon-heart"></span> Follow </a>
                            <a href="#" class="btn btn-xs btn-default entfollow"><span class="glyphicon glyphicon-ban-circle"></span> Unfollow </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<br>
<legend></legend>
<br>


<!-- Ausgabe der Tweets -->
<div class="tweet">
    <?php
    $pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
    $sql = "SELECT * FROM TWEET WHERE tw_user_id = $fremduserid";
    $query = $pdo->prepare($sql);
    $query->execute();
    while ($zeile = $query->fetchObject()) {
        echo "<div class=\"tweet-einzeln\"><h5 class='headline'>$zeile->tw_headline</h5>";
        echo "Autor: <a href='Profilseite2.php?userid=$zeile->tw_user_id'>$zeile->tw_user_id</a><br>";
        echo "<i>$zeile->tw_date</i><br><br>";
        echo "$zeile->tw_text<br>";
        $bild = $zeile->tw_file;
        if (!empty($bild)) {
            echo "<img src='upload/$zeile->tw_file' style='width: 25%; height: 25%; margin-left: 380px; margin-top: -60px; margin-bottom: 10px'>";
        }
        echo"</div>";
        echo "<a href='Backend/tweeten_delete.php?loeschen=$zeile->ID_tweet'>löschen</a>";
    }
    ?>
</div>











<nav>
    <ul class="pagination">
        <li>
            <a href="#" aria-label="Zurück">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
            <a href="#" aria-label="Weiter">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>





</body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




</html>