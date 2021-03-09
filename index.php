<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT * FROM user_table WHERE username= '$username' AND password= '$password' LIMIT 1";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    // If mysqli_result matched $username and $password, table row must be 1 row
    if ($count == 1 && $row["validity"] == "valid") {
        global $showmsg;
        $showmsg = "Login successful";

        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: home.php');
    } else if ($count == 1 && $row["validity"] == "pending") {
        $showmsg = "Login failed. Contact authority for validation";
    } else {
        $showmsg = "Login failed. Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPS - Log In</title>

    <!-- Styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">

    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="icon/logo.png" id="icon" alt="User Icon">
            </div>

            <!-- Login Form -->
            <form action="index.php" method="post">
                <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username" required>
                <input type="text" id="password" class="fadeIn third" name="password" placeholder="Password" required>
                <div class="container form-check fadeIn fourth">
                    <div class="row justify-content-md-center">
                        <div class="col-md-4">
                            <input type="checkbox" class="form-check-input" id="Check">
                            <label class="form-check-label" for="Check">Remember me</label>
                        </div>
                    </div>
                </div>
                <div class="fadeIn fifth mb-3">
                    <input type="submit" id="login" value="Log In"><br>
                    <a class="underlineHover" href="#">Forgot Password?</a>
                </div>
                <div class="mb-2 fadeIn fifth bg-danger text-white rounded w-75 mx-auto">
                    <?php
                    global $showmsg;
                    echo $showmsg;
                    ?>
                </div>
            </form>

            <!-- SIGN UP -->
            <div id="formFooter" class="fadeIn sixth">
                <form action="signup.php">
                    <p class="my-0">Don't have an account?</p>
                    <input type="submit" id="signup" value="SIGN UP">
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>

    <?php
    session_start();
    if ($_SESSION['msg'] == "signupdoneforstudent") {
    ?>
        <script>
            swal("SIGN UP COMPLETE!", "Contact Authority for Validation!", "success");
        </script>
    <?php
        session_destroy();
    } else if ($_SESSION['msg'] == "signupdone") {
    ?>
        <script>
            swal("SIGN UP COMPLETE!", "Please LOG IN Now!", "success");
        </script>
    <?php

    }

    ?>
</body>

</html>