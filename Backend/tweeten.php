<?php


include ("userdata.php");
$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt

?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
$showFormular = true;

if(isset($_GET['tweeten'])) {    //Prüfung: alle Parameter müssen übergeben werden
    $error = false;
    $tw_headline = $_POST['tw_headline'];
    $tw_text = $_POST['tw_text'];


    if(strlen($tw_headline) == 0) {   //Prüfung: wurde eine Überschrift eingegeben?
        echo 'Bitte eine Überschrift eingeben<br>';
        $error = true;
    }

    if(strlen($tw_text) == 0) {   //Prüfung: wurde ein Tweet-Text eingegeben?
        echo 'Bitte einen Tweet-Text eingeben<br>';
        $error = true;
    }




    if(!$error) {
        $tw_user_id = $_SESSION ["user_id"];
        $pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
        $statement = $pdo->prepare("INSERT INTO TWEET (tw_headline, tw_text, tw_user_id, tw_date, tw_file) VALUES (:tw_headline, :tw_text, :tw_user_id, NOW(), :tw_file)");
        $result = $statement->execute(array('tw_headline' => $tw_headline, 'tw_text' => $tw_text, 'tw_user_id' => $tw_user_id, 'tw_file' => $dateiURL));
        $user = $statement->fetch();
    }
}

if($showFormular) {
    ?>



    <?php
}



?>

</body>
</html>