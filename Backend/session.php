<?PHP
session_start();
if ($_SESSION ["login"]<>"1") {   //wenn Session Variable login nicht gleich 1 ist, wird der User zur Anmeldeseite weitergeleitet
            $_SESSION = array();
            session_destroy();
            header('Location: LogIn.php' );
    }
?>