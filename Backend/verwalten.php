<?php

session_start();
include ("userdata.php");



?>
<!DOCTYPE html>
<html>
<head>
    <title>Profilverwaltung</title>
</head>


<body>

<?PHP
include('Backend/session.php');
?>


<?php
$showFormular = true;
$IDSESSION = $_SESSION ["user_id"];   //Variable IDSESSION wird mit dem Wert der angemeldeten user_id definiert


if(isset($_GET['verwalten'])) {
    $error = false;
    $email = $_POST['email'];
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $passwort = $_POST['passwort'];
    $passwort1 = $_POST['passwort1'];
    $passwort2 = $_POST['passwort2'];

    if(!filter_var($email1, FILTER_VALIDATE_EMAIL)) {   //Prüfung: handelt es sich um eine E-Mail Adresse?
        echo '<br><br><br>Bitte eine neue gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }

    if(strlen($passwort1) == 0) {   //Prüfung: wurde ein neues Passwort eingegeben?
        echo 'Bitte das neue Passwort angeben<br>';
        $error = true;
    }
    if($passwort1 != $passwort2) {   //Prüfung: wurde das neue Passwort richtig bestätigt?
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    $passwort_hash = password_hash($passwort1, PASSWORD_DEFAULT);   //neues Passwort wird als Hash-Wert der Variable zugewiesen


    if (!$error) {
        $pdo = new PDO($dsn, $dbuser, $dbpass);  //neuer Datenbankzugriff wird erzeugt
        $statement = $pdo->prepare("SELECT * FROM USER WHERE ID = :IDSESSION");
        $result = $statement->execute(array('IDSESSION' => $IDSESSION));
        $user = $statement->fetch();
    }


    if ($user !== false) {
    }
    if (password_verify($passwort, $user['passwort'])) {   //Prüfung: User-Passwort = eingegebenes Passwort?
            $pdo = new PDO($dsn, $dbuser, $dbpass);
            $statement = $pdo->prepare("UPDATE USER SET email= :email, passwort= :passwort WHERE ID = :IDSESSION");  //neue E-Mail und neues Passwort werden für die aktuellen Werte (zugehörig zur angemeldeten ID) überschrieben
            $result = $statement->execute(array('email' => $email1, 'passwort' => $passwort_hash, 'IDSESSION' => $IDSESSION));
            echo "<br><br><br><br><br><br>Erfolgreich!";
    } else {
        $errorMessage = "<br><br><br><br><br><br>E-Mail oder Passwort war ungültig<br>";
    }
}



if($showFormular) {
    ?>
    <?php
}



?>

</body>
</html>