<?php
session_start();
?>
<?php

if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
    ?>

    <?php
    include('header.php');
    ?>
    <?php
    include('function/article.php');
    ?>

    <br>
    <br>
    <div class="card mb-3 wow fadeIn">
        <div class="card-body">
            <div class="list-group">

                <?php
                while ($a = $article->fetch()) {
                    ?>
                    <button type="button" class="list-group-item list-group-item-action"><?= $a['title'] ?>
                        <br>
                        <a href="/single-article.php?id=<?= $a['id'] ?>" target="_blank" class="btn btn-primary">View
                            comments
                            <i class="fa fa-play ml-2"></i>
                        </a>
                        <a class="btn btn-success" href="index.php?edit=<?= $a['id'] ?>">Update
                            <i class="fa fa-refresh ml-2"></i>
                        </a>
                        <a class="btn btn-danger" href="function/delete.php?id=<?= $a['id'] ?>">Delete
                            <i class="fa fa-trash ml-2"></i>
                        </a>
                    </button>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    include("footer.php");
    ?>

    <?php
} else {

}
?>