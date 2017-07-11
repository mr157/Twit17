<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Die 3 Meta-Tags oben *müssen* zuerst im head stehen; jeglicher sonstiger head-Inhalt muss *nach* diesen Tags kommen -->
    <title>Twit17</title>

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





<!--Navigationsleiste-->
<?php
include('nav_bar.php')

?>


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
        <div class="col-md-12">
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
$upload_folder = 'upload/';                                                             //Ordnerverzeichnis, in welchem die Dateien abgelegt werden
$filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);                      //Definition des Datei-Namens
$extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));        //String wird mit Kleinbuchstaben wiedergegeben, Erweiterung um Extension
$new_path = $upload_folder.$filename.'.'.$extension;                                    //Definition und Erweiterung des Datei-Pfades
$dateiURL = $filename.'.'.$extension;                                                   //dateiURL definiert die Bezeichnung des Dateiuploads
move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);                            //hochgeladene Datei wird in Upload-Ordner verschoben
?>



<br>
<legend></legend>
<br><br><br>









    <div class="row">

        <div class="col-md-4">
            <?php
            include('Backend/session.php');
            include ('Backend/userdata.php');

            //Liste aller registrierten User (eingeloggter User wird nicht angezeigt)
            $pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
            $sql = "SELECT ID, vorname, nachname FROM USER ORDER BY ID";
            $query = $pdo->prepare($sql);
            $query->execute();
            echo "<b>Liste aller registrierten User</b><br><br>";
            while ($zeile = $query->fetchObject()) {
                $sessionuserid = $zeile->ID;            //ID in Datensätzen wird mit $sessionuserid definiert
                if ($IDSESSION !== $sessionuserid) {   //eingeloggter User wird nicht in der Liste ausgegeben
                    echo "<span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"</span> &nbsp;Name: $zeile->vorname, $zeile->nachname &ensp; ID: <a href='Profilseite2.php?userid=$zeile->ID'>$zeile->ID</a><br><br>";
                }
            }
            ?>
        </div>

        <?php
        include('Backend/tweeten.php');
        ?>

        <!-- Formular zur Ausgabe von Tweets -->
        <div class="col-md-8">
            <div class="formular">
                <form enctype="multipart/form-data" action="?tweeten=1" method="post">
                    <strong> Erstelle einen neuen Tweet</strong> <br/><br/>
                    <input type="text" name="tw_headline" placeholder="Überschrift" style="width: 300px"/> <br> <br />
                    <textarea name="tw_text" cols="25" rows="5" style="width: 300px"/> </textarea> <br>
                    <input type="file" name="datei" /> <br>
                    <input type="submit" value="Tweeten" class="btn btn-success-registrieren"/>
                </form>
            </div>
        </div>

    </div>



<!-- Abstandhalter zwischen zwei Rows -->
<div class="row spacer"></div>



    <div class="row">

        <div class="col-md-12">

            <?php
            $IDSESSION = $_SESSION ["user_id"];
            $pdo = new PDO($dsn, $dbuser, $dbpass);
            $sql = "SELECT * FROM TWEET INNER JOIN USER ON TWEET.tw_user_id=USER.ID WHERE TWEET.tw_user_id = $IDSESSION";       //Auswahl aller Tweets, bei denen die tw_user_id der eingeloggten Session-ID entspricht
            $query = $pdo->prepare($sql);
            $query->execute();
            while ($zeile = $query->fetchObject()) {


                //Ausgabe der Tweets
                echo " <div class=\" row panel panel-primary\">";
                echo " <div class=\"panel-heading\">$zeile->tw_headline";
                echo " <img class='col-md-1' src='upload/$zeile->datei' style='width: 5%; height: 5%;'/></div>";
                echo " <div class=\"col-md-12 panel-body\">";
                echo " <div class=\"col-md-10\">";
                echo "      Autor: <a href='Profilseite1.php?userid=$zeile->tw_user_id'>$zeile->vorname</a><br>";
                echo "      <i>$zeile->tw_date</i><br><br>";
                echo "      $zeile->tw_text<br></div>";
                $bild = $zeile->tw_file;
                if (!empty($bild) AND $bild !==".") {
                    echo "<div class='col-md-2'> <img src='upload/$zeile->tw_file' style='width: 100%; height: 100%;'></div>";
                }
                echo "</div></div>";
                echo "<div><a href='Backend/tweeten_delete.php?loeschen=$zeile->ID_tweet'>Tweet löschen</a></div><br><br><br>";   //Übergabe der Tweet-ID zum Löschen-Button, Weiterleitung zur Backend Datei tweeten_delete.php
            }
            ?>

        </div>
    </div>
</div>



















<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



</body>



</html>