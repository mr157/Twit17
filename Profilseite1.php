<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Die 3 Meta-Tags oben *müssen* zuerst im head stehen; jeglicher sonstiger head-Inhalt muss *nach* diesen Tags kommen -->
    <title>Twitter</title>

    <!-- Das neueste kompilierte und minimierte CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Optionales Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- Das neueste kompilierte und minimierte JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="CSS.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>







<body>

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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Einstellungen <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="Profilverwaltung.php">Profilverwaltung</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Persönliche Informationen</li>
                        <li><a href="#">Kontaktdaten</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="Backend/logout.php">Abmelden</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>



<br><br><br><br>



<!-- Profilbild laden -->
<?php
include('Backend/session.php');
include ('Backend/userdata.php');
$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
$IDSESSION = $_SESSION ["user_id"];

$sql = "SELECT * FROM USER WHERE ID = :userid";
$query = $pdo->prepare($sql);
$query->execute(array('userid' => $IDSESSION));
while ($zeile = $query->fetchObject()) {
    $profilbildurl = $zeile->datei;
}
?>



<!-- Profilbild anzeigen -->
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




<!-- Tweet-Datei Upload-Funktion -->
<?php
$upload_folder = 'upload/';
$filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));
$new_path = $upload_folder.$filename.'.'.$extension;
$dateiURL = $filename.'.'.$extension;
move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
?>



<br>
<legend></legend>
<br><br><br>




<!--Seitenleisten auf der Profilseite-->
<div class="col-xs-6 col-sm-3 sidebar-offcanvas follower" id="sidebar">
    <div class="list-group">
        <a href="#" class="list-group-item active">Nutzer, denen ich folge</a>
        <a href="#" class="list-group-item">User 1</a>
        <a href="#" class="list-group-item">User 2</a>
        <a href="#" class="list-group-item">User 3</a>
        <a href="#" class="list-group-item">User 4</a>
        <a href="#" class="list-group-item">User 5</a>
    </div>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


<div class="col-xs-6 col-sm-3 sidebar-offcanvas follower" id="sidebar">
    <div class="list-group">
        <a href="#" class="list-group-item active">Follower</a>
        <a href="#" class="list-group-item">User 1</a>
        <a href="#" class="list-group-item">User 2</a>
        <a href="#" class="list-group-item">User 3</a>
        <a href="#" class="list-group-item">User 4</a>
        <a href="#" class="list-group-item">User 5</a>
    </div>
</div>





<br><br><br><br><br><br><br><br><br><br><br><br><br><br>




<!-- Ausgabe Userliste -->
<?php
include('Backend/session.php');
include ('Backend/userdata.php');

$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
$sql = "SELECT ID, vorname, nachname FROM USER ORDER BY ID";
$query = $pdo->prepare($sql);
$query->execute();
echo "<div class=\"Suche1\"><b>Liste aller registrierten User:</b>";
while ($zeile = $query->fetchObject()) {
    echo "<div class=\"Suche2\">Name: $zeile->vorname, $zeile->nachname &ensp; ID: <a href='Profilseite2.php?userid=$zeile->ID'>$zeile->ID</a></div>";
}
?>




<!-- Backend php-file einbinden -->
<?php
include('Backend/tweeten.php');
?>

<!--Formular von Tweets-->
<div class="formular">
    <form enctype="multipart/form-data" action="?tweeten=1" method="post">
        Überschrift:<br />
        <input type="text" name="tw_headline" style="width: 300px"/> <br> <br />
        <textarea name="tw_text" cols="25" rows="5" style="width: 300px"/> </textarea> <br>
        <input type="file" name="datei" /> <br>
        <input type="submit" value="Tweeten" class="btn-success"/>
        </form>
</div>




<!--Ausgabe von Tweets-->
<div class="tweet">
    <?php
    $IDSESSION = $_SESSION ["user_id"];
    $pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
    $sql = "SELECT * FROM TWEET WHERE tw_user_id = $IDSESSION";
    $query = $pdo->prepare($sql);
    $query->execute();
    while ($zeile = $query->fetchObject()) {
        echo "<div class=\"tweet-einzeln\"><h5 class='headline'>$zeile->tw_headline</h5>";
        echo "Autor: <a href='Profilseite2.php?userid=$zeile->tw_user_id'>$zeile->tw_user_id</a><br>";
        echo "<i>$zeile->tw_date</i><br><br>";
        echo "$zeile->tw_text<br>";
        $bild = $zeile->tw_file;
        if (!empty($bild)) {
            echo "<img src='upload/$zeile->tw_file' style='width: 25%; height: 25%; margin-left: 368px; margin-top: -60px; margin-bottom: 10px'>";
        }
        echo"</div>";
        echo "<a href='Backend/tweeten_delete.php?loeschen=$zeile->ID_tweet'>Diesen Tweet löschen</a><br><br>";

    }
    ?>
</div>




<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

















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









<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



</body>



</html>