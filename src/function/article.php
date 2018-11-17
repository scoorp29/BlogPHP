<?php
session_start();
include('injecting-check.php');
include('connect-db.php');
include('vendor/autoload.php');

use \League\HTMLToMarkdown\HtmlConverter;

$converter = new HtmlConverter(array('strip_tags' => true));
//Initialize table

//Table comment
$table_c = "comment";
$columns_c = "
  id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
  id_article INT (11) NOT NULL, 
  username VARCHAR( 50 ) NOT NULL,
  content VARCHAR( 1000 ) NOT NULL
  ";

if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
    //Create table
    createTable($db, $table_c, $columns_c, $createTable, $bdd);

    //Add foreigen key to table comment
    $bdd->query("ALTER TABLE `comment` ADD CONSTRAINT `fk_article` FOREIGN KEY (`id_article`) REFERENCES `article`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;");
    $bdd->query("ALTER TABLE comment CONVERT TO CHARACTER SET utf8;");
}
//Table comment end

//Table Article
$table_a = "article";
$columns_a = "
    id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR( 150 ) NOT NULL,
    title VARCHAR( 150 ) NOT NULL,
    content VARCHAR( 1000 ) NOT NULL,
    author INT( 11 ) NOT NULL";

if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
    //Create table
    createTable($db, $table_a, $columns_a, $createTable, $bdd);

    //Add foreigen key to table article
    $bdd->query("ALTER TABLE `article` ADD CONSTRAINT `fk_author` FOREIGN KEY (`author`) REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;");
    $bdd->query("ALTER TABLE article CONVERT TO CHARACTER SET utf8;");
}
//Table Article end
//Initialize table end

//Select All article
$article = $bdd->query("SELECT * FROM article ORDER BY id DESC");

//Feature display user author
//$user_author = $bdd->query("SELECT `username` FROM user INNER JOIN article ON user.id = article.author");


//Retrieving variables
if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
    if (isset($_POST['mod_edit'], $_POST['edit_id'])) {
        if (!empty($_POST['mod_edit']) AND !empty($_POST['edit_id'])) {
            $mode_edition = $_POST['mod_edit'];
            $edit_id = $_POST['edit_id'];
        }
    }
}

if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
    if (isset($_POST['article_title'], $_POST['article_content'], $_FILES['image'])) {
        if (!empty($_POST['article_title']) AND !empty($_POST['article_content']) AND !empty($_FILES['image'])) {
            $author = $_SESSION['id'];
            $article_title = htmlspecialchars($_POST['article_title']);
            $article_content = $converter->convert($_POST['article_content']);

            //Upload image
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];

            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed = array('jpg', 'png', 'gif');
            if (!in_array($ext, $allowed)) {
                $_SESSION['alerte_error_article'] = "Error! Choose PNG or JPEG!";
            }

            if ($file_size > 5000000) {
                $_SESSION['alerte_error_article'] = "Maximum size exceeded (<5MB)!";
            }

            if (empty($_SESSION['alerte_error_article']) == true) {
                move_uploaded_file($file_tmp, "../upload/" . $file_name);
            }
            //Upload image end

            $image = "upload/" . $file_name;

        } else {
            $_SESSION['alerte_error_article'] = "Please complete all fields!";
        }
    }
}

if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];

    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $allowed = array('jpg', 'png', 'gif');
    if (!in_array($ext, $allowed)) {
        $_SESSION['alerte_error_article'] = "Error! Choose PNG or JPEG!";
    }

    if ($file_size > 5000000) {
        $_SESSION['alerte_error_article'] = "Maximum size exceeded (<5MB)!";
    }

    if (empty($_SESSION['alerte_error_article']) == true) {
        move_uploaded_file($file_tmp, "../upload/" . $file_name);
    }
}


function insertArticle($article_title, $image, $article_content, $author, $bdd)
{
    $stmt = $bdd->prepare("INSERT INTO article (title, image, content, author) VALUES (:title, :image, :content, :author)");

    $stmt->bindParam(":title", $article_title);
    $stmt->bindParam(":image", $image);
    $stmt->bindParam(":content", $article_content);
    $stmt->bindParam(":author", $author);


    if (isset($stmt)) {
        $stmt->execute();
        $stmt->closeCursor();
    } else {
        $_SESSION['alerte_error_article'] = "Un error occured when you try to add article!";
    }
}

function editArticle($edit_id, $article_title, $image, $article_content, $bdd)
{
    $update_article = $bdd->prepare("UPDATE `article` SET `title` = :title , `image` = :image , `content` = :content WHERE `article`.`id` = :id");

    $update_article->bindParam(":id", $edit_id);
    $update_article->bindParam(":image", $image);
    $update_article->bindParam(":title", $article_title);
    $update_article->bindParam(":content", $article_content);

    if (isset($update_article)) {
        $update_article->execute();
        $update_article->closeCursor();
    } else {
        $_SESSION['alerte_error_article'] = "Un error occured when you try to add article!";
    }
}

if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
    if (isset($_POST['article_title'], $_POST['article_content'])) {
        if (!empty($_POST['article_title']) AND !empty($_POST['article_content'])) {
            if (empty($_SESSION['alerte_error_article'])) {
                if ($mode_edition == 0) {
                    insertArticle($article_title, $image, $article_content, $author, $bdd);
                    $_SESSION['alerte_article_submit'] = "Article has been created!";
                    header('Location:/index.php');
                } else {
                    editArticle($edit_id, $article_title, $image, $article_content, $bdd);
                    header('Location:/index.php?edit=' . $edit_id);
                    $_SESSION['alerte_article_update'] = "Article has been update!";
                }
            } else {
                header('Location:/index.php');
            }
        } else {
            $_SESSION['alerte_error_article'] = "Un error occured ! Try again !";
            header('Location:/index.php');
        }
    }
}