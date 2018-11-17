<?= session_start() ?>
<?php
require('function/single-article.php');
?>
<?php
include('header.php');
?>


<!-- Section: Blog v.4 -->
<section class="my-5">

    <!-- Grid row -->
    <div class="row">

        <!-- Grid column -->
        <div class="">

            <!-- Card -->
            <div class="card card-cascade wider reverse">

                <!-- Card image -->
                <div class="view view-cascade overlay">
                    <img class="card-img-top" src="<?= $image ?>"
                         alt="Sample image">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

                <!-- Card content -->
                <div class="card-body card-body-cascade text-center">

                    <!-- Title -->
                    <h2 class="font-weight-bold">
                        <strong>
                            <?= $title; ?>
                        </strong></h2>
                </div>
                <!-- Card content -->

            </div>
            <!-- Card -->
            <!-- Excerpt -->

            <p class="content-custom">
                <?= $content ?>
            </p>
        </div>


</section>
<!-- Section: Blog v.4 -->

<!--Comments-->
<div class="card card-comments mb-3 wow fadeIn">

    <div class="card-header font-weight-bold"><?= $count ?> comments</div>

    <?

    while ($a = $comment->fetch()) {
        ?>

        <div class="card-body">

            <div class="media d-block d-md-flex mt-4">
                <div class="media-body text-center text-md-left ml-md-3 ml-0">

                    <h5 class="mt-0 font-weight-bold">

                        <i class="fa fa-user"></i>
                        <?= $a['username'] ?>

                    </h5>

                    <i class="fa fa-quote-left"></i>
                    <?= $a['content'] ?>
                    <i class="fa fa-quote-right"></i>

                </div>
            </div>
        </div>
        <hr class="my-5">

        <?php
    }
    ?>

</div>
</div>
<!--/.Comments-->

<!--Reply-->
<div id="comment-message" class="card mb-3 wow fadeIn">
    <div class="card-header font-weight-bold">Leave a comment</div>

    <p>
        <?php
        if (isset($_SESSION['alerte_error_comment'])) {
            echo "<p class=\"alert alert-danger\" data-dismiss=\"alert\">" . $_SESSION['alerte_error_comment'] . "</p>";
            unset($_SESSION['alerte_error_comment']);
        }

        if (isset($_SESSION['alerte_comment_submit'])) {
            echo "<p class=\"alert alert-success\" data-dismiss=\"alert\">" . $_SESSION['alerte_comment_submit'] . "</p>";
            unset($_SESSION['alerte_comment_submit']);
        }
        ?>

    </p>

    <div class="card-body">

        <!-- Default form reply -->
        <form action="function/comment.php" method="post">

            <input class="d-none" name="id_article" value="<?= $id ?>"/>

            <!-- Username -->
            <label for="replyFormName">Username : </label>
            <?php
            if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
                echo "<strong> " . $_SESSION['username'] . " </strong>";
            } else {
                echo "<input type=\"texte\" class=\"form-control\" name=\"username\">";
            }
            ?>
            <br>
            <br>
            <!-- Comment -->
            <div id="comment" class="form-group">
                <?php
                if (isset($_SESSION['alerte_comment_submit'])) {
                    echo "<p class=\"alert alert-success\" data-dismiss=\"alert\">" . $_SESSION['alerte_comment_submit'] . "</p>";
                    unset($_SESSION['alerte_comment_submit']);
                }
                ?>
                <label for="replyFormComment">Your comment :</label>
                <textarea class="form-control" rows="5" name="comment_content" required></textarea>
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-info btn-md" type="submit">Post</button>
            </div>
        </form>
        <!-- Default form reply -->


    </div>
</div>
<!--/.Reply-->

<?php
include("footer.php");
?>


