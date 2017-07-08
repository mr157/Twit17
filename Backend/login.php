<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Das neueste kompilierte und minimierte CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Optionales Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- Das neueste kompilierte und minimierte JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>


<!--Navigationsleiste-->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"></a>
        </div>
    </div>
</nav>

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
        header('location:Profilseite1.php');
    } else {
        $errorMessage = "<br><br><br><div class=\"alert alert-warning alert-dismissible\" role=\"alert\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
        <strong>Achtung!</strong> E-Mail oder Passwort war ungültig.</div>";
    }
}
?>


<?php
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>


</body>
</html>