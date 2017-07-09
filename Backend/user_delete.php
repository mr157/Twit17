<?php


include('session.php');
include ("userdata.php");
$IDSESSION = $_SESSION ["user_id"];   //Variable IDSESSION wird mit dem Wert der angemeldeten user_id definiert




    $pdo = new PDO($dsn, $dbuser, $dbpass);   //neuer Datenbankzugriff wird erzeugt
    $statement = $pdo->prepare("DELETE FROM USER WHERE ID = :IDSESSION");   //Datenbankzugriff wird vorbereitet (Lösche alle Werte des Users mit der angemeldeten ID)
    $result = $statement->execute(array('IDSESSION' => $IDSESSION));
    $user = $statement->fetch();
    echo "<a href=\"../LogIn.php\>Schade! Du hast deinen Account erfolgreich gelöscht - weiter zur Startseite.</a>";
    exit ();

?>
