<?php
session_start();
include ("userdata.php");
$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt


if(isset($_GET['anmelden'])) {   //Prüfung: alle Parameter müssen übergeben werden
    $email = $_POST['email'];   //eingegebene Werte werden den Variablen übergeben
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM USER WHERE email = :email");   //Datenbankabfrage wird vorbereitet, User mit zugehöriger E-Mail Adresse wird selektiert
    $result = $statement->execute(array('email' => $email));   //Datenbankabfrage wird ausgeführt
    $user = $statement->fetch();



    if ($user !== false) {   //wenn Datenbankabfrage ausgeführt wird, dann ...
    }if (password_verify($passwort, $user['passwort'])) {   //Prüfung: User-Passwort = eingegebenes Passwort?
        $_SESSION ['user_id'] = $user['ID'];   //ID des Users wird als Session-Variable user_id definiert
        $_SESSION ['login'] = "1";
        header('location:Profilseite1.php');
    } else {
        echo "<br><br><br><div class=\"alert alert-warning alert-dismissible\" role=\"alert\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
        <strong>Warning!</strong>Deine E-Mail oder dein Passwort war ungültig.</div>";
    }
}
?>






