<?php
session_start();


// Deleting Session
if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
    $_SESSION = array();
    session_destroy();

    $_SESSION['alerte_signout'] = "You are successful sign out!";
    header("Location:/index.php");
} else {
    $_SESSION['alerte_error_signout'] = "Error !";
    header("Location:/index.php");
}
