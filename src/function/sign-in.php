<?php
session_start();
include('connect-db.php');
include('injecting-check.php');


//Retrieving variables
if (isset($_POST['username'], $_POST['password'])) {
    if (!empty($_POST['username']) AND !empty($_POST['password'])) {
        //POST Protect from RSS
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        //Protect from sql inject
        if (false !== $pos = multi_strpos($username, $checks)) {
            $_SESSION['alerte_sign_in_error'] = "Character string are not allowed !";
        }
    } else {
        $_SESSION['alerte_sign_in_error'] = "Please complete all fields!";
    }
}

//  Retrieving the user and his hash pass
$req = $bdd->prepare('SELECT id, password FROM user WHERE username = :username');

if (isset($req)) {
    $req->bindParam(":username", $username);
    $req->execute();
} else {
    $_SESSION['alerte_sign_in_error'] = "Erreur data base!";
}

$result = $req->fetch();

// Comparison of the pass sent via the form with the data base
$isPasswordCorrect = password_verify($_POST['password'], $result['password']);


if ($isPasswordCorrect == true) {
    $_SESSION['id'] = $result['id'];
    $_SESSION['username'] = $username;
    $_SESSION['alerte_sign_in'] = "You are successfully logged!";
    header("Location:/index.php");
} else {
    $_SESSION['alerte_sign_in_error'] = "Wrong username or password !";
    header("Location:/sign-in.php");
}
