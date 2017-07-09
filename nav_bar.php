
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Navigation ein-/ausblenden</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Willkommen &nbsp;<?PHP echo $vorname; ?></a>
</div>
<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
        <li><a href="Profilseite1.php">Profil</a></li>
        <li><a href="Galerie.php">Galerie</a></li>
        <li><a href="Profilseite3.php">Tweets meiner Freunde</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Einstellungen <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="Profilverwaltung.php">Profilverwaltung &nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true"</span></a></li>
                <li role="separator" class="divider"></li>
                <li><a href="Backend/logout.php">Abmelden &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-log-out" aria-hidden="true"</span></a></li>
            </ul>
        </li>
    </ul>
</div>
</div>
</nav>

