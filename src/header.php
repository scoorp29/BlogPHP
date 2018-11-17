<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>My Blog</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="/css/style-3.css" rel="stylesheet">

</head>

<body>

<!--Main Navigation-->
<header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
        <div class="container">

            <a class="navbar-brand waves-effect" href="index.php" target="_blank">
                <strong class="blue-text">My Blog</strong>
            </a>
            <?php
            if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
                ?>
                <a class="navbar waves-effect" href="all-articles.php" target="_blank">
                    <strong class="blue-text">All Articles</strong>
                </a>
                <?php
            }
            ?>

            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">

                <?php
                if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
                    echo "<li class=\"nav-item\"><span class=\"nav-link\">Hello <strong> " . $_SESSION['username'] . " </strong></span></li>";
                    echo "<li class=\"nav-item\"><a href=\"function/sign-out.php\" class=\"nav-link waves-effect\" target=\"_blank\">Sign out</a></li>";
                } else {
                    echo "<li class=\"nav-item\"><a href=\"sign-in.php\" class=\"nav-link waves-effect\" target=\"_blank\">Sign in</a></li>";
                    echo "<li class=\"nav-item\"><a href=\"sign-up.php\" class=\"nav-link waves-effect\" target=\"_blank\">Sign up</a></li>";
                }
                ?>
            </ul>

        </div>
    </nav>
    <!-- Navbar -->

</header>
<!--Main Navigation-->
<body>