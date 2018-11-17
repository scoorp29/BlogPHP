<?php
session_start();
include('article.php');
if (isset($_GET['id']) AND !empty($_GET['id'])) {
    $suppr_id = htmlspecialchars($_GET['id']);
} else {
    $_SESSION['alerte_error_delete'] = "Erreur delete article!";
}

//Delete comment or drop foreigenkey
function deleteComment($suppr_id, $bdd)
{
    $suppr_c = $bdd->prepare('DELETE FROM comment WHERE id_article = :id');
    $suppr_c->bindParam(":id", $suppr_id);
    $suppr_c->execute();

    if (isset($suppr_c)) {
        $suppr_c->execute();
    }
}

function deleteArticle($suppr_id, $bdd)
{
    $suppr = $bdd->prepare('DELETE FROM article WHERE id = :id');
    $suppr->bindParam(":id", $suppr_id);
    $suppr->execute();

    if (isset($suppr_c)) {
        $suppr_c->execute();
    }
}

if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
    if (!isset($_SESSION['alerte_erreur_delete'])) {
        //First drop comment because foreigenkey
        deleteComment($suppr_id, $bdd);
        deleteArticle($suppr_id, $bdd);
        $_SESSION['alerte_delete'] = "Article has been delete!";
        header("Location:/index.php");
    }
} else {
    echo "You are not allowed to access this file!";
    echo "<br><a href=\"/index.php\">Go home</a>";
}
