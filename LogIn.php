<!DOCTYPE html>
<html lang="de" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Die 3 Meta-Tags oben *müssen* zuerst im head stehen; jeglicher sonstiger head-Inhalt muss *nach* diesen Tags kommen -->
    <title>Twit17 - Anmeldeseite</title>

    <!-- Das neueste kompilierte und minimierte CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Optionales Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- Das neueste kompilierte und minimierte JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS.css">
    <link href="Footer.css" rel="stylesheet">
</head>


<body>



<?php
include "Backend/login.php"
?>

<!-- Navigationsleiste -->
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
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" action="?anmelden=1" method="post">
                <div class="form-group">
                    <input type="text" placeholder="Email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Passwort" name="passwort" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Anmelden</button>
                <input type="button"  class="btn btn-success btn-registrieren" onclick="location.href='Registrierung.php';" value="Registrieren" </input>
            </form>
        </div>
    </div>
</nav>



<!-- Karusel -->
<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#bs-carousel" data-slide-to="1"></li>
        <li data-target="#bs-carousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item slides active">
            <div class="slide-1"></div>
            <div class="hero">
                <hgroup>
                    <h1>Bleibe immer informiert!</h1>
                    <h3>Registrier dich am besten gleich</h3>
                </hgroup>
            </div>
        </div>
        <div class="item slides">
            <div class="slide-2"></div>
            <div class="hero">
                <hgroup>
                    <h1>Wir sind neu!</h1>
                    <h3>Entdecke eine neue Welt</h3>
                </hgroup>
            </div>
        </div>
        <div class="item slides">
            <div class="slide-3"></div>
            <div class="hero">
                <hgroup>
                    <h1>Wir sind einfach!</h1>
                    <h3>Blogging mal anders</h3>
                </hgroup>
            </div>
        </div>
    </div>
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


