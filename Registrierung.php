<!DOCTYPE html>
<html lang="de" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Die 3 Meta-Tags oben *müssen* zuerst im head stehen; jeglicher sonstiger head-Inhalt muss *nach* diesen Tags kommen -->
    <title>Twitter</title>

    <!-- Das neueste kompilierte und minimierte CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Optionales Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- Das neueste kompilierte und minimierte JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="CSS.css" rel="stylesheet">
    <link href="Footer.css" rel="stylesheet">
</head>
<body>



<!--Navigationsleiste-->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Navigation ein-/ausblenden</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="LogIn.php">Willkommen bei Twit17</a>
        </div>
    </div>
</nav>



<?php
include "Backend/registrieren.php"
?>

<!--Registrierungsforumlar-->
<div class="container">
    <form class="form-horizontal" action="?register=1" method="post">
        <legend>Profil anlegen</legend>



        <br><br>

        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Name</label>
            <div class="col-md-4">
                <input  name="vorname" type="text" placeholder="Vorname" class="form-control input-md">
                <input  name="nachname" type="text" placeholder="Nachname" class="form-control input-md">
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Geburtstag</label>
            <div class="col-md-4">
                <input name="geburtstag" type="date" placeholder="YYYY-MM-DD" class="form-control input-md">
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">E-Mail Adresse</label>
            <div class="col-md-4">
                <input  name="email" type="text" placeholder="E-Mail Adresse " class="form-control input-md">
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-4 control-label" for="passwordinput">Passwort</label>
            <div class="col-md-4">
                <input  name="passwort" type="password" placeholder="Passwort" class="form-control input-md">
                <input  name="passwort2" type="password" placeholder="Passwort bestätigen" class="form-control input-md">
                <hr>
                <button type="submit" class="btn btn-success-registrieren">Registrieren</button>
            </div>
        </div>

    </form>
</div>







<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p class="text-muted"><a href="Impressum.php"> Impressum</a></p>
    </div>
</footer>








<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




</body>

</html>



