<?php
include("config.php");

session_start();
$_SESSION['msg'] = "";

$firstname = "";
$lastname = "";
$username = "";
$division = "";
$email = "";
$password_1 = "";
$password_2 = "";
$test1 = "";
$test2 = "";
$errors = array();

// REGISTER USER
if (isset($_POST['signup'])) {
    // receive all input values from the form
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $division = mysqli_real_escape_string($db, $_POST['division']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error into $errors array
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM user_table WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }

        if (count($errors) > 0) :
            foreach ($errors as $error) :
                echo "<center> $error <center/>";
            endforeach;
        endif;
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = $password_1; //encrypt the password before saving in the database

        if ($division == 'student') {
            $query = "INSERT INTO user_table (firstname, lastname, username, division, email, password, validity) 
        	  VALUES('$firstname', '$lastname', '$username', '$division', '$email', '$password', 'pending')";
            mysqli_query($db, $query);

            $user_id_query = "SELECT * FROM user_table WHERE username='$username' LIMIT 1";
            $result_id = mysqli_query($db, $user_id_query);
            $user_id = mysqli_fetch_array($result_id, MYSQLI_ASSOC);
            $useid = $user_id["user_id"];

            $query2 = "INSERT INTO student_table (student_id, student_user_id, father_name, mother_name, contact_number, address, class, birth_date, profile_picture) 
  			  VALUES('NULL', '$useid', 'update name', 'update name', '12345', 'update address', '1', '2020-01-01', 'image/default_propic.jpg')";
            mysqli_query($db, $query2);

            $_SESSION['msg'] = "signupdoneforstudent";
            header('location: index.php');
        } else {
            $query = "INSERT INTO user_table (firstname, lastname, username, division, email, password, validity) 
  			  VALUES('$firstname', '$lastname', '$username', '$division', '$email', '$password', 'valid')";
            mysqli_query($db, $query);
            $_SESSION['msg'] = "signupdone";
            header('location: index.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPS - Sign Up</title>

    <!-- Styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/signup.css">

    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <div class="wrapper">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div>
                <img src="icon/logo.png" id="icon" alt="User Icon">
            </div>

            <!-- Login Form -->
            <form action="signup.php" method="post">
                <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
                <input type="text" id="lastname" name="lastname" placeholder="Last Name" required>
                <input type="text" id="username" name="username" placeholder="User Name" required>
                <input type="email" id="email" name="email" placeholder="riajul@perkyrabbit.com" required>
                <div class="container">
                    <div class="row justify-content-md-center my-2">
                        <div class="col-md-10 form-group">
                            <select class="form-control" id="division" name="division" required>
                                <option value="" selected disabled>Please Select Division</option>
                                <option value="staff">Staff</option>
                                <option value="teacher">Teacher</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="password" id="password1" name="password_1" placeholder="Type Password" required>
                <input type="password" id="password2" name="password_2" placeholder="Retype Password" required>
                <input type="submit" id="signup" name="signup" value="SIGN UP"><br>
            </form>

            <!-- Register -->
            <div id="formFooter">
                <form action="index.php">
                    <p class="my-0">Already have an account?</p>
                    <input type="submit" id="login" value="LOG IN">
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
</body>

</html>