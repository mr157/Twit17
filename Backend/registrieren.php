<?php


include ("userdata.php");
$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt

?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
</head>
<body>

<?php


if(isset($_GET['register'])) {    //Prüfung: alle Parameter müssen übergeben werden
    $error = false;
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    #$geschlecht = $_POST['geschlecht'];
    $geburtstag = $_POST['geburtstag'];
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];



    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {   //Prüfung: handelt es sich um eine E-Mail Adresse?
        echo '<br><br><br>Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if(strlen($passwort) == 0) {   //Prüfung: wurde ein Passwort eingegeben?
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {   //Prüfung: wurde das Passwort richtig bestätigt?
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }


    if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM USER WHERE email = :email");   //neue Datenbankabfrage wird vorbereitet
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false) {   //wenn die E-Mail bereits vorhanden ist gibt es diesen User bereits
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }


    if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);   //Passwort wird in einen Hash umgewandelt
        $statement = $pdo->prepare("INSERT INTO USER (vorname, nachname, geburtstag, email, passwort) VALUES (:vorname, :nachname, :geburtstag, :email, :passwort)");
        $result = $statement->execute(array('vorname' => $vorname, 'nachname' => $nachname, 'geburtstag' => $geburtstag, 'email' => $email, 'passwort' => $passwort_hash));

        if($result) {
            echo '<br><br><br>Du wurdest erfolgreich registriert. <a href="/~ks178/LogIn.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo '<br><br><br>Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}



?>

</body>
</html>