<?php


include "session.php";
$tw_user_id = $_SESSION ["user_id"];  //ID des eingeloggten Users wird der Variable tw_user_id definiert


$upload_folder = '../upload/';                                                          //Ordnerverzeichnis, in welchem die Dateien abgelegt werden
$filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);                      //Definition des Datei-Namens
$extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));        //String wird mit Kleinbuchstaben wiedergegeben, Erweiterung um Extension
$new_path = $upload_folder.$filename.'.'.$extension;                                    //Definition und Erweiterung des Datei-Pfades
$dateiURL = $filename.'.'.$extension;                                                   //dateiURL definiert die Bezeichnung des Dateiuploads
move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);                            //hochgeladene Datei wird in Upload-Ordner verschoben


include("userdata.php");

try {
    $pdo = new PDO($dsn, $dbuser, $dbpass);                                             //Datenbankzugriff wird erzeugt
    $statement = $pdo->prepare("UPDATE USER SET datei = :datei WHERE ID = :twid");      //Profilbild des eingeloggten Users wird geändert
    $result = $statement->execute(array('datei' => $dateiURL, 'twid' => $tw_user_id));
    header ('location: ../Profilseite1.php');                                           //User wird direkt zur Profilseite1.php umgeleitet
} catch (PDOException $e) {                                                             //Tritt im try-block ein fehler auf, springt php direkt in den catch-Block
    echo "Beim Upload ist ein Fehler passiert: {$e->getMessage()}";
}



?>