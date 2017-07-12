<?php

include ("userdata.php");
$pdo = new PDO($dsn, $dbuser, $dbpass);   //Datenbankzugriff wird erzeugt

?>



<!DOCTYPE html>
<html>
<head>
    <title>Twit17 - Registrierungs-Seite</title>
</head>
<body>



<?php

if(isset($_GET['registrieren'])) {    //Prüfung: alle Parameter müssen übergeben werden
    $error = false;
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $geburtstag = $_POST['geburtstag'];
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];



    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {   //Prüfung: handelt es sich um eine E-Mail Adresse?
        echo '<br><br><br>Bitte geben Sie eine gültige E-Mail Adresse ein.<br>';
        $error = true;
    }



    if(strlen($passwort) == 0) {   //Prüfung: wurde ein Passwort eingegeben?
        echo 'Bitte geben Sie ein Passwort ein.<br>';
        $error = true;
    }


    if($passwort != $passwort2) {   //Prüfung: wurde das Passwort richtig bestätigt?
        echo 'Achten Sie darauf, dass die Passwörter übereinstimmen.<br>';
        $error = true;
    }


    if(!$error) {    //wenn alle bisherigen Kriterien erfüllt werden, wird folgender Datenbankzugriff erzeugt
        $statement = $pdo->prepare("SELECT * FROM USER WHERE email = :email");   //neue Datenbankabfrage wird vorbereitet
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false) {   //wenn die E-Mail bereits vorhanden ist, gibt es diesen User bereits
            echo 'Die von Ihnen gewählte E-Mail Adresse wird bereits verwendet.<br>';
            $error = true;
        }
    }


    if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);   //Passwort wird in einen Hash-Wert umgewandelt
        $statement = $pdo->prepare("INSERT INTO USER (vorname, nachname, geburtstag, email, passwort) VALUES (:vorname, :nachname, :geburtstag, :email, :passwort)");
        $result = $statement->execute(array('vorname' => $vorname, 'nachname' => $nachname, 'geburtstag' => $geburtstag, 'email' => $email, 'passwort' => $passwort_hash));   //User Datensätze werden in die Datenbank gespeichert

        if($result) {
            echo '<br><br><br>Dein Account wurde erfolgreich angelegt. <a href="/~ks178/LogIn.php">Melde dich gleich an!</a>';
        } else {
            echo '<br><br><br>Leider ist ein Fehler aufgetreten, versuche es bitte erneut.<br>';
        }
    }
}

?>




</body>
</html>