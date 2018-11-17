<?php
session_start();
include('connect-db.php');

if (isset($_GET['id']) AND !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);

    //For display article info
    $article = $bdd->prepare("SELECT * FROM article WHERE id = :id");

    $article->bindParam(":id", $get_id);
    $article->execute();

    if ($article->rowCount() == 1) {
        $article = $article->fetch();
        $id = $article['id'];
        $image = $article['image'];
        $title = $article['title'];
        $content = $article['content'];
    } else {
        die('This article doesn\'t exist !');
    }

    //For display comment info
    $comment = $bdd->query("SELECT * FROM comment WHERE  id_article = '$get_id'");

    $count = $comment->rowCount();

    $_SESSION['test'] = $count;

} else {
    die('Erreur');
}


$bdd = NULL;