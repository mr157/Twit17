<?php


include "session.php";
$tw_user_id = $_SESSION ["user_id"];






echo $tw_user_id;


$upload_folder = '../upload/';
$filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));
$new_path = $upload_folder.$filename.'.'.$extension;
$dateiURL = $filename.'.'.$extension;
move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);


include("userdata.php");
try {
    $pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt
    $statement = $pdo->prepare("UPDATE USER SET datei = :datei WHERE ID = :twid");
    $result = $statement->execute(array('datei' => $dateiURL, 'twid' => $tw_user_id));
    header ('location: ../Profilseite1.php');
} catch (PDOException $e) {
    echo "Beim Upload ist ein Fehler passiert.";
}

echo $dateiURL;