<?php
session_start();
include ("userdata.php");
$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt


if(isset($_GET['login'])) {   //Prüfung: alle Parameter müssen übergeben werden
    $email = $_POST['email'];   //eingegebene Werte werden den Variablen übergeben
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM USER WHERE email = :email");   //Datenbankabfrage wird vorbereitet
    $result = $statement->execute(array('email' => $email));   //Datenbankabfrage wird ausgeführt
    $user = $statement->fetch();



    if ($user !== false) {   //wenn Datenbankabfrage ausgeführt wurde, dann ...
    }if (password_verify($passwort, $user['passwort'])) {   //Prüfung: User-Passwort = eingegebenes Passwort?
        $_SESSION ['user_id'] = $user['ID'];   //ID des Users wird als Session-Variable user_id definiert
        $_SESSION ['login'] = "1";
            die('Login erfolgreich.<br> Weiter zu <a href="/~ks178/Profilseite1.php">deinem Profil</a>');
    } else {
        $errorMessage = "<br><br><br><br><br><br>E-Mail oder Passwort war ungültig<br>";
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<?php
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>


</body>
</html>