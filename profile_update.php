<?php
include("config.php");
session_start();
$_SESSION['id'] = "";
$username = $_SESSION['username'];
$sql1 = "SELECT * FROM user_table WHERE username = '$username' LIMIT 1";
$result1 = mysqli_query($db, $sql1);
$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
$value_firstname = $row1['firstname'];
$value_lastname = $row1['lastname'];
$user_id = $row1["user_id"];
$sql2 = "SELECT * FROM student_table WHERE student_user_id = '$user_id' LIMIT 1";
$result2 = mysqli_query($db, $sql2);
$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$value_id = $row2["student_user_id"];
$value_fathername = $row2["father_name"];
$value_mothername = $row2["mother_name"];
$value_contactnumber = $row2["contact_number"];
$value_address = $row2["address"];
$value_class = $row2["class"];
$value_birthdate = $row2["birth_date"];
$_SESSION['id'] = $value_id;
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perky Rabbit RPS</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Icons -->
    <link rel="icon" href="icon/Softkit_logo_32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="icon/Softkit_logo_16x16.png" sizes="16x16" type="image/png">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container-fluid d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-5">
            <div>
                <h3 class="float-md-start mb-0">Perky Rabbit</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    <a class="nav-link" aria-current="page" href="profile.php">Profile</a>
                    <a class="nav-link" aria-current="page" href="logout.php">LOG OUT</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <div class="container">
                <form action="profile.php" method="POST">
                    <table class=" table  table-light table-hover table-striped">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Father's Name</th>
                            <th>Mother's Name</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Class</th>
                            <th>Birth Date</th>
                            <th>Update Information</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="firstname" value="<?php echo $value_firstname ?>"></td>
                            <td><input type="text" class="form-control" name="lastname" value="<?php echo $value_lastname ?>"></td>
                            <td><input type="text" class="form-control" name="fathername" value="<?php echo $value_fathername ?>"></td>
                            <td><input type="text" class="form-control" name="mothername" value="<?php echo $value_mothername ?>"></td>
                            <td><input type="text" class="form-control" name="contactnumber" value="<?php echo $value_contactnumber ?>"></td>
                            <td><input type="text" class="form-control" name="address" value="<?php echo $value_address ?>"></td>
                            <td><input type="text" class="form-control" name="class" value="<?php echo $value_class ?>"></td>
                            <td><input type="text" class="form-control" name="birthdate" value="<?php echo $value_birthdate ?>"></td>
                            <td><button type="submit" class="text-white btn btn-primary" name="btnupdate">Update</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>

        <footer class="mt-auto text-white-50">
            <p><i style="font-size:24px" class="fa">&#xf1f9;</i> <a href="https://perkyrabbit.space/" class="text-white">Perky Rabbit</a> by <a href="https://www.facebook.com/ritewu2014/" class="text-white">Riajul Islam Tonmoy</a></p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
</body>

</html>