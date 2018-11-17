<?php
session_start();
include('injecting-check.php');
include('connect-db.php');

//Retrieving variables
if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
    if (isset($_POST['comment_content'])) {
        if (!empty($_POST['comment_content'])) {
            $id_article = htmlspecialchars($_POST['id_article']);
            $username = $_SESSION['username'];
            $comment_content = htmlspecialchars($_POST['comment_content']);

        } else {
            $_SESSION['alerte_error_comment'] = "Please complete all fields!";
        }
    }
}

if (isset($_POST['username'], $_POST['comment_content'])) {
    if (!empty($_POST['username']) AND !empty($_POST['comment_content'])) {
        $id_article = htmlspecialchars($_POST['id_article']);
        $username = htmlspecialchars($_POST['username']);
        $comment_content = htmlspecialchars($_POST['comment_content']);
    } else {
        $_SESSION['alerte_error_comment'] = "Please complete all fields!";
    }

}

function insertComment($id_article, $username, $comment_content, $bdd)
{
    $stmt = $bdd->prepare("INSERT INTO comment(id_article, username, content) VALUES (:id_article, :username, :content)");

    $stmt->bindParam(":id_article", $id_article);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":content", $comment_content);

    if (isset($stmt)) {
        $stmt->execute();
    } else {
        $_SESSION['alerte_error_comment'] = "Un error occured when you try to add comment!";
    }
}

if (!isset($_SESSION['alerte_error_comment'])) {
    insertComment($id_article, $username, $comment_content, $bdd);
    $_SESSION['alerte_comment_submit'] = "Comment has been created!";
    header('Location:/single-article.php?id=' . $id_article . '#comment');
} else {
    header('Location:/single-article.php?id=' . $id_article);
}
