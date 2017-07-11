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
</head>




<?php

include('Backend/session.php');
include ('Backend/userdata.php');

$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
$fremduserid = $_GET ['userid'];          //Fremduser-ID wird mit Methode GET geholt
$IDSESSION = $_SESSION ["user_id"];


$statement = $pdo->prepare("SELECT * FROM USER WHERE ID = :IDSESSION");
$result = $statement->execute(array('IDSESSION' => $IDSESSION));
$user = $statement->fetch();
$vorname = $user['vorname'];  //Vorname des eingeloggten Users wird zur Begrüßung in der Navigationsleiste angezeigt


//Tweets des Fremdusers werden geladen und angezeigt
$sql = "SELECT * FROM USER WHERE ID = :fremduserid";
$query = $pdo->prepare($sql);
$query->execute(array('fremduserid' => $fremduserid));
while ($zeile = $query->fetchObject()) {
    $profilbildurl = $zeile->datei;
    $fremduser = $zeile->ID;
}




//Follow-Beziehung von eingeloggtem User und Fremduser wird untersucht
$pdo = new PDO($dsn, $dbuser, $dbpass);
$sql = ("SELECT * FROM FOLLOWER WHERE ID_user = :IDSESSION and ID_follower = :fremduser");
$query = $pdo->prepare($sql);
$query->execute(array('IDSESSION' => $IDSESSION, 'fremduser' => $fremduser));
while ($zeile = $query->fetchObject()) {
    $beziehungvorhanden = 1; }

?>


<body>



<!--Navigationsleiste-->
<?php
include('nav_bar.php')

?>


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


<!-- Follow und UnFollow Button -->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="well well-sm">
                <div class="media">
                    <div class="media-body">


                        <?php if ($beziehungvorhanden == 0) {   //wenn keine Beziehung vorhanden ist
                        echo '<a href="Backend/folgen.php?userid=' . $fremduser .'" class="btn btn-xs btn-default follow"><span class="glyphicon glyphicon-heart"></span> Follow </a>';
                        } ?>

                        <?php if ($beziehungvorhanden == 1) {   //wenn bereits eine Beziehung vorhanden ist
                            echo '<a href="Backend/entfolgen.php?userid=' . $fremduser .'" class="btn btn-xs btn-default entfollow"><span class="glyphicon glyphicon-ban-circle"></span> Unfollow </a>';
                        } ?>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<br>
<legend></legend>
<br>



<div class="container">
    <div class="row">

        <div class="col-md-8">

            <!-- Ausgabe der Tweets des Fremdusers -->
            <div class="tweet">
                <?php
                $pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
                $sql = "SELECT * FROM TWEET INNER JOIN USER ON TWEET.tw_user_id=USER.ID WHERE TWEET.tw_user_id = $fremduserid";   //Auswahl aller Tweets, bei denen die tw_user_id der Fremduser-ID entspricht
                $query = $pdo->prepare($sql);
                $query->execute();
                while ($zeile = $query->fetchObject()) {


                    //Ausgabe der Tweets
                    echo " <div class=\" row panel panel-primary\">";
                    echo " <div class=\"panel-heading\">$zeile->tw_headline";
                    echo "<img class='col-md-1' src='upload/$zeile->datei' style='width: 8%; height: 8%;'/></div>";
                    echo " <div class=\"col-md-12 panel-body\">";
                    echo " <div class=\"col-md-10\">";
                    echo "      Autor: <a href='Profilseite2.php?userid=$zeile->tw_user_id'>$zeile->vorname</a><br>";
                    echo "      <i>$zeile->tw_date</i><br><br>";
                    echo "      $zeile->tw_text<br></div>";
                    $bild = $zeile->tw_file;
                    if (!empty($bild)) {
                        echo "<div class='col-md-2'> <img src='upload/$zeile->tw_file' style='width: 100%; height: 100%;'></div>";
                    }
                    echo "</div></div>";

                }
                ?>
            </div>

        </div>
     </div>
</div>











</body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




</html>