<?php

include('session.php');
include ("userdata.php");
$IDSESSION = $_SESSION ["user_id"];   //Variable IDSESSION wird mit dem Wert der angemeldeten user_id definiert
$tweetID = $_GET['loeschen'];

if(isset($_GET['loeschen'])) {


    $pdo = new PDO($dsn, $dbuser, $dbpass);   //neuer Datenbankzugriff wird erzeugt
    $statement = $pdo->prepare("DELETE FROM TWEET WHERE ID_tweet = :tweetID");   //Auswahl des zu löschenden Tweets
    $result = $statement->execute(array('tweetID' => $tweetID));
    $user = $statement->fetch();
}
header('location: ../Profilseite1.php');
?>
