<?php
session_start();
?>

<?php
include("header.php");
?>

<main class="mt-5 pt-5">
    <!-- Material form login -->
    <div class="card">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Sign up</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-1 pt-0">

            <?php
            if (isset($_SESSION['alerte_error_sign_up'])) {
                echo "<p class=\"alert alert-danger\" data-dismiss=\"alert\">" . $_SESSION['alerte_error_sign_up'] . "</p>";
                unset($_SESSION['alerte_error_sign_up']);
            }
            ?>

            <!-- Form -->
            <form action="function/sign-up.php" method="post" class="text-center" style="color: #757575;">

                <!-- Email -->
                <div class="md-form">
                    <input type="text" id="materialLoginForm" class="form-control" name="username" required>
                    <label for="materialLoginFormEmail">Username</label>
                </div>

                <!-- Password -->
                <div class="md-form">
                    <input type="password" id="materialLoginFormPassword" class="form-control" name="password" required>
                    <label for="materialLoginFormPassword">Password</label>
                </div>

                <!-- Sign in button -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">
                    Sign up
                </button>

            </form>
            <!-- Form -->

        </div>

    </div>
    <!-- Material form login -->
</main>

<?php
include("footer.php");
?>

