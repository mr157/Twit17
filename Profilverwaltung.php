<!DOCTYPE html>
<html lang="de" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
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
include "Backend/session.php";
include ('Backend/userdata.php');
$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
$IDSESSION = $_SESSION ["user_id"];


$statement = $pdo->prepare("SELECT * FROM USER WHERE ID = :IDSESSION");
$result = $statement->execute(array('IDSESSION' => $IDSESSION));
$user = $statement->fetch();
$vorname = $user['vorname'];  //Vorname des eingeloggten Users wird zur Begrüßung in der Navigationsleiste angezeigt
?>




<body>


<?php
include "Backend/verwalten.php"
?>

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

        <!--Profilbild anzeigen-->
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


        <div class="abstandhalter"></div>



        <!--Button Profilbild wechseln-->
        <button type="button" class="btn btn-success-registrieren" data-toggle="modal" data-target="#Profilbildwechseln">Profilbild ändern</button>





<br><br>




        <!--Formular Daten ändern-->
<div class="row">
        <div class="form-group">
            <label class="col-md-4 control-label">E-Mail Adresse ändern</label>
            <div class="col-md-4">
                <input  name="email"  type="email" placeholder="aktuelle E-Mail Adresse " class="form-control input-md">
                <input  name="email1" type="email" placeholder="neue E-Mail Adresse " class="form-control input-md">
                <input  name="email2" type="email" placeholder="neue E-Mail Adresse bestätigen " class="form-control input-md">
            </div>
        </div>



</div>

        <div class="abstandhalter"></div>
        <div class="abstandhalter"></div>




        <div class="row">

        <div class="form-group">
            <label class="col-md-4 control-label">Passwort ändern</label>
            <div class="col-md-4">
                <input  name="passwort" type="password" placeholder="aktuelles Passwort" class="form-control input-md">
                <input  name="passwort1" type="password" placeholder="neues Passwort" class="form-control input-md">
                <input  name="passwort2" type="password" placeholder="neues Passwort bestätigen" class="form-control input-md">
                <hr>
                <button type="submit" class="btn btn-success-registrieren">Speichern</button><br><br><br>
                <a href="#"data-toggle="modal" data-target="#Accountdelete">Account löschen </a>

                <!-- Modal -->
                <div id="Accountdelete" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Account löschen</h4>
                            </div>
                            <div class="modal-body">
                                <p>Willst du wirklich deinen Account löschen?</p>
                            </div>
                            <div class="modal-footer">
                                <input type="button"  class="btn btn-success btn-registrieren" onclick="location.href='Backend/user_delete.php';" value="Account löschen" </input>
                                <button type="button" class="btn btn-success-registrieren" data-dismiss="modal">Abbrechen</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
</div>










<br><br><br>









<?php
include "Backend/session.php"
?>



<!--Profilbild ändern-->
<div id="Profilbildwechseln" class="modal fade" role="dialog">
    <div class="modal-dialog">


        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Lade dein Profilbild hoch</h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="Backend/profilbild_wechseln.php" method="post">
                    <strong>Profilbild ändern:</strong><br><br>
                    <input type="file" name="datei" /> <br>
                    <input type="submit" value="Bild hochladen" class="btn btn-success-registrieren"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success-registrieren" data-dismiss="modal">Abbrechen</button>
            </div>
        </div>

    </div>
</div>







<br><br><br><br><br>









<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




</body>

</html>
