
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
    <link href="Footer.css" rel="stylesheet">
</head>

<?php
include "Backend/session.php"
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

<?php
include "Backend/verwalten.php"
?>

<!-- Fixierte Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Navigation ein-/ausblenden</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Willkommen</a>
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
                        <li><a href="LogIn.php">Abmelden</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


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



<div class="container">
    <form class="form-horizontal" action="?verwalten=1" method="post">
        <legend>Mein Profil verwalten</legend>

        <!--Profilbild-->
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


        <br><br>

        <!--Formular Daten ändern-->
        <div class="container">

        <div class="form-group">
            <label class="col-md-4 control-label">E-Mail Adresse ändern</label>
            <div class="col-md-4">
                <input  name="email"  type="email" placeholder="aktuelle E-Mail Adresse " class="form-control input-md">
                <input  name="email1" type="email" placeholder="neue E-Mail Adresse " class="form-control input-md">
                <input  name="email2" type="email" placeholder="neue E-Mail Adresse bestätigen " class="form-control input-md">
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-4 control-label">Passwort ändern</label>
            <div class="col-md-4">
                <input  name="passwort" type="password" placeholder="aktuelles Passwort" class="form-control input-md">
                <input  name="passwort1" type="password" placeholder="neues Passwort" class="form-control input-md">
                <input  name="passwort2" type="password" placeholder="neues Passwort bestätigen" class="form-control input-md">
            </div>
        </div>
            <button type="submit" class="btn btn-success-registrieren2">Speichern</button><br><br>
    </form>


</div>


<!--Button Account löschen-->
<form action="/~ks178/Backend/user_delete.php">
    <br><br><input type="submit" class="btn btn-success-löschen" value="Account löschen">
</form>

<br><br><br>






<?php
include "Backend/session.php"
?>



<div class="formular2">
    <form enctype="multipart/form-data" action="Backend/profilbild_wechseln.php" method="post">
        <strong>Profilbild ändern:</strong><br><br>
        <input type="file" name="datei" /> <br>
        <input type="submit" value="Tweeten" class="btn-success"/>
    </form>
</div>


<br><br><br><br><br>









<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




</body>

</html>
