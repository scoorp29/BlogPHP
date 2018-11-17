<?php
session_start();
?>
<?php
include('function/article.php');
?>
<?php
include('function/paging.php');
?>
<?php
include('header.php');
?>

<?php
$Parsedown = new Parsedown();
?>
<?php
$Parsedown->setSafeMode(true);
?>

    <!--Main layout-->
    <main class="mt-5 pt-5">
        <div class="container">

            <!--Display message-->
            <?php
            if (isset($_SESSION['alerte_error_article'])) {
                echo "<p class=\"alert alert-danger\" data-dismiss=\"alert\">" . $_SESSION['alerte_error_article'] . "</p>";
                unset($_SESSION['alerte_error_article']);
            }

            if (isset($_SESSION['alerte_error_delete'])) {
                echo "<p class=\"alert alert-danger\" data-dismiss=\"alert\">" . $_SESSION['alerte_error_delete'] . "</p>";
                unset($_SESSION['alerte_error_delete']);
            }

            if (isset($_SESSION['alerte_error_signout'])) {
                echo "<p class=\"alert alert-danger\" data-dismiss=\"alert\">" . $_SESSION['alerte_error_signout'] . "</p>";
                unset($_SESSION['alerte_error_signout']);
            }

            if (isset($_SESSION['alerte_error_comment'])) {
                echo "<p class=\"alert alert-danger\" data-dismiss=\"alert\">" . $_SESSION['alerte_error_comment'] . "</p>";
                unset($_SESSION['alerte_error_comment']);
            }

            if (isset($_SESSION['alerte_article_submit'])) {
                echo "<p class=\"alert alert-success\" data-dismiss=\"alert\">" . $_SESSION['alerte_article_submit'] . "</p>";
                unset($_SESSION['alerte_article_submit']);
            }

            if (isset($_SESSION['alerte_delete'])) {
                echo "<p class=\"alert alert-success\" data-dismiss=\"alert\">" . $_SESSION['alerte_delete'] . "</p>";
                unset($_SESSION['alerte_delete']);
            }

            if (isset($_SESSION['alerte_article_update'])) {
                echo "<p class=\"alert alert-success\" data-dismiss=\"alert\">" . $_SESSION['alerte_article_update'] . "</p>";
                unset($_SESSION['alerte_article_update']);
            }


            if (isset($_SESSION['alerte_signout'])) {
                echo "<p class=\"alert alert-success\" data-dismiss=\"alert\">" . $_SESSION['alerte_signout'] . "</p>";
                unset($_SESSION['alerte_signout']);
            }
            if (isset($_SESSION['alerte_sign_up'])) {
                echo "<p class=\"alert alert-success\" data-dismiss=\"alert\">" . $_SESSION['alerte_sign_up'] . "</p>";
                unset($_SESSION['alerte_sign_up']);
            }
            if (isset($_SESSION['alerte_sign_in'])) {
                echo "<p class=\"alert alert-success\" data-dismiss=\"alert\">" . $_SESSION['alerte_sign_in'] . "</p>";
                unset($_SESSION['alerte_sign_in']);
            }
            if (isset($_SESSION['alerte_comment_submit'])) {
                echo "<p class=\"alert alert-success\" data-dismiss=\"alert\">" . $_SESSION['alerte_comment_submit'] . "</p>";
                unset($_SESSION['alerte_comment_submit']);
            }
            ?>
            <!--Display message end-->


            <?php

            $edit_id = $_GET['edit'];


            if (!empty($_GET['edit'])) {
                $mode_edition = 1;
                $edit = $bdd->prepare("SELECT * FROM article WHERE id = :id ");
                $edit->bindParam(":id", $edit_id);
                $edit->execute();

                if ($edit->rowCount() == 1) {
                    $edit = $edit->fetch();
                } else {
                    die('This article doesn\'t exist !');

                }
            }
            ?>



            <?php
            if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
                ?>

                <div class="custom-edit">
                    <!--Add new article-->
                    <div class="wow fadeIn">
                        <!--Section heading-->
                        <?php
                        if ($mode_edition == 0) {
                            ?>
                            <h2 class="h1 text-center mb-5">Create Article</h2>
                            <?php
                        } else {
                            ?>
                            <h2 class="h1 text-center mb-5">Update Article</h2>
                            <?php
                        }
                        ?>

                    </div>

                    <form action="function/article.php" method="POST" class="text-center" style="color: #757575;"
                          enctype="multipart/form-data">

                        <div class="form-group purple-border">
                            <input class="d-none" name="mod_edit" placeholder="Title" value="<?= $mode_edition ?>"/>
                            <input class="d-none" name="edit_id" placeholder="Title" value="<?= $edit['id'] ?>"/>

                            <!-- Username -->
                            <label for="replyFormName">Current Username : </label>
                            <?php
                            if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
                                echo "<strong style=\"color:#000; \"> " . $_SESSION['username'] . " </strong>";
                            } else {
                                echo "<input type=\"texte\" class=\"form-control\" name=\"username\">";
                            }
                            ?>
                        </div>

                        <div class="form-group purple-border">
                            <input class="form-control" type="text" name="article_title"
                                   placeholder="Title" value="<?= $edit['title'] ?>"/><br/>
                        </div>

                        <div class="file-field md-form-2 pb-5">
                            <div mdbBtn floating="true" size="md" color="amber" mdbWavesEffect>
                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                <input type="file" name="image" mdbFileSelect (uploadOutput)="onUploadOutput($event)"
                                       [uploadInput]="uploadInput">
                            </div>
                        </div>

                        <!-- Upload file version 2
                        <div class="input-group w-50 pb-5">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="image">
                                <label class="custom-file-label" for="inputGroupFile01 "></label>
                            </div>
                        </div>
                        Upload file version 2 end-->

                        <div class="form-group purple-border">
                    <textarea class="form-control" rows="10" name="article_content"
                              placeholder="Article content"><?= $edit['content'] ?></textarea><br/>
                        </div>

                        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
                        <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

                        <!-- Save up button -->
                        <?php
                        if ($mode_edition == 0) {
                            ?>
                            <button class="btn btn-primary btn-md" type="submit">Create</button>
                            <?php
                        } else {
                            ?>
                            <button class="btn btn-success" type="submit">Update
                                <i class="fa fa-refresh ml-2"></i>
                            </button>
                            <a href="index.php" class="btn btn-danger">Quit edit mode
                                <i class="fa fa-trash ml-2"></i>
                            </a>
                            <?php
                        }
                        ?>
                    </form>
                </div>
                <?php
            }
            ?>

            <!-- Section: Blog v.1 -->
            <section class="my-5">

                <!-- Section heading -->
                <h2 class="h1-responsive font-weight-bold text-center my-5">My posts</h2>
                <!-- Section description -->
                <p class="text-center w-responsive mx-auto mb-5">Duis aute irure dolor in reprehenderit in voluptate
                    velit
                    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa
                    qui officia deserunt mollit anim id est laborum.</p>

                <hr class="my-5">
                <?php
                echo "<p class=\"parag\"><strong style=\"color:#0b51c5;\">($nb_total_articles)</strong> articles in total</p>";
                echo "<hr class=\"my-5\">";
                echo "<p class=\"parag\">Page <b>$page_num</b> on $last_page</a></p>";
                ?>


                <?php


                $req = $bdd->query($sql);
                if (!empty($req)) {
                    while ($a = $req->fetch()) {
                        ?>

                        <?php
                        if ($a['id'] % 2 == true) {
                            ?>


                            <hr class="my-5">
                            <!-- Grid row -->
                            <div class="row">

                                <!-- Grid column -->
                                <div class="col-lg-5">

                                    <!-- Featured image -->
                                    <div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
                                        <img class="img-fluid" src="<?= $a['image'] ?>" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col-lg-7">

                                    <!-- Post title -->
                                    <h3 class="font-weight-bold mb-3"><strong></strong><?= $a['title'] ?></strong></h3>
                                    <!-- Excerpt -->
                                    <p><?= $Parsedown->text(strip_tags($a['content'])) ?></p>

                                    <a href="/single-article.php?id=<?= $a['id'] ?>" target="_blank"
                                       class="btn btn-primary">View comments
                                        <i class="fa fa-play ml-2"></i>
                                    </a>
                                    <?php
                                    if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
                                        ?>
                                        <a class="btn btn-success" href="index.php?edit=<?= $a['id'] ?>">Update
                                            <i class="fa fa-refresh ml-2"></i>
                                        </a>
                                        <a class="btn btn-danger" href="function/delete.php?id=<?= $a['id'] ?>">Delete
                                            <i class="fa fa-trash ml-2"></i>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <!-- Grid column -->

                            </div>
                            <!-- Grid row -->
                            <?php
                        } else {
                            ?>

                            <hr class="my-5">

                            <!-- Grid row -->
                            <div class="row">

                                <!-- Grid column -->
                                <div class="col-lg-7">

                                    <!-- Post title -->
                                    <h3 class="font-weight-bold mb-3"><strong><?= $a['title'] ?></strong></h3>
                                    <!-- Excerpt -->
                                    <p><?= $Parsedown->text(strip_tags($a['content'])) ?></p>

                                    <!-- Read more button -->
                                    <a href="/single-article.php?id=<?= $a['id'] ?>" target="_blank"
                                       class="btn btn-primary">View comments
                                        <i class="fa fa-play ml-2"></i>
                                    </a>

                                    <?php
                                    if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
                                        ?>

                                        <a class="btn btn-success" href="index.php?edit=<?= $a['id'] ?>">Update
                                            <i class="fa fa-refresh ml-2"></i>
                                        </a>
                                        <a class="btn btn-danger" href="function/delete.php?id=<?= $a['id'] ?>">Delete
                                            <i class="fa fa-trash ml-2"></i>
                                        </a>
                                        <?php
                                    }
                                    ?>

                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col-lg-5">

                                    <!-- Featured image -->
                                    <div class="view overlay rounded z-depth-2">
                                        <img class="img-fluid" src="<?= $a['image'] ?>" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                </div>
                                <!-- Grid column -->

                            </div>
                            <!-- Grid row -->
                            <?php
                        }
                    }
                }
                ?>

            </section>
            <!-- Section: Blog v.1 -->

            <!--Pagination-->

            <?php
            if ($nb_total_articles > 5) {
                ?>
                <?php
                echo '<div id="pagination">' . $pagination . '</div>';
                $req->closeCursor();
                ?>
                <?php
            }
            ?>

            <!--Pagination-->

            </section>
            <!--Section: Cards-->

        </div>
    </main>
    <!--Main layout-->

<?php
include("footer.php");
?>