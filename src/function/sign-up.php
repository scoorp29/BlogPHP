<?php
session_start();
include('connect-db.php');
include('injecting-check.php');

//Table info
$table = "user";
$columns = "id INT( 11 ) AUTO_INCREMENT PRIMARY KEY, username VARCHAR( 50 ) NOT NULL, password VARCHAR( 255 ) NOT NULL";

//Create table
createTable($db, $table, $columns, $createTable, $bdd);
$bdd->query("ALTER TABLE user CONVERT TO CHARACTER SET utf8;");

//Retrieving variables
if (isset($_POST['username'], $_POST['password'])) {
    if (!empty($_POST['username']) AND !empty($_POST['password'])) {
        //POST Protect from RSS
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        //Protect from sql inject
        if (false !== $pos = multi_strpos($username, $checks)) {
            $_SESSION['alerte_error_sign_up'] = "Character string are not allowed !(INSERT, UPDATAE, DROP, SELECT) ";
        }
    } else {
        $_SESSION['alerte_error_sign_up'] = "Please complete all fields!";
    }
}

//Function insert user
function insertUser($username, $password, $bdd)
{
    $stmt = $bdd->prepare('INSERT INTO user (username, password) VALUES (:username, :password)');

    //Password protect
    if (strlen($password) < 8) {
        $_SESSION['alerte_error_sign_up'] = "Password must be at least 8 characters";
    } else {
        //Crypted password
        $password_protect = password_hash($password, PASSWORD_BCRYPT, array("cost" => 9));
    }


    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password_protect);


    //Check if user exists
    $req = $bdd->query("SELECT username FROM user WHERE username='$username'");
    $chk_pseudo = $req->fetch(PDO::FETCH_ASSOC);

    if ($chk_pseudo == '1' || $chk_pseudo > '1') {
        $_SESSION['alerte_error_sign_up'] = "This username already exists";
    }

    if (!isset($stmt)) {
        $_SESSION['alerte_error_sign_up'] = "Un error occured when you try to create account!";
    } else
        $stmt->execute();

}

/*function listUser($bdd)
{
    $stmt = $bdd->query("SELECT * FROM user");
    echo "<br>User list : <br>";
    while ($row = $stmt->fetch()) {
        echo $row['id']."\t";
        echo $row['username']."\t";
        echo $row['password'] . "<br>";
    }
}*/

//listUser($bdd);
insertUser($username, $password, $bdd);
//Insert User and Redirect to sign-in page
if (!isset($_SESSION['alerte_error_sign_up'])) {
    $_SESSION['alerte_sign_up'] = "Account created successfully. Sign in.";
    header("Location:/index.php");
} else
    header("Location:/sign-up.php");

//Close connexion db
$bdd = NULL;