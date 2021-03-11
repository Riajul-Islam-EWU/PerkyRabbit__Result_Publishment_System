<?php
include("config.php");
session_start();
$username = $_SESSION['username'];
$sql = "SELECT * FROM user_table WHERE username = '$username' LIMIT 1";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$test_id = $row["user_id"];
$sql2 = "SELECT * FROM student_table WHERE student_user_id = '$test_id' LIMIT 1";
$result2 = mysqli_query($db, $sql2);
$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$value_fathername = $row2["father_name"];
$value_mothername = $row2["mother_name"];
$value_contactnumber = $row2["contact_number"];
$value_address = $row2["address"];
$value_class = $row2["class"];
$value_birthdate = $row2["birth_date"];
$value_profilepicture = $row2["profile_picture"];
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

        .propic {
            height: 200px;
            width: 200px;
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
                    <a class="nav-link" aria-current="page" href="profile_update.php">Update Info</a>
                    <a class="nav-link" href="logout.php">LOG OUT</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <div class="container">
                <table class=" table  table-light table-hover table-striped">
                    <div>
                        <img src="<?php echo $value_profilepicture ?>" alt="Profile Picture Photo" class="propic img-thumbnail img-fluid rounded mx-auto d-block">
                    </div><br>
                    <tr>
                        <th>Name</th>
                        <th>Father's Name</th>
                        <th>Mother's Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Class</th>
                        <th>Birth Date</th>
                    </tr>
                    <tr>
                        <td><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
                        <td><?php echo $value_fathername ?></td>
                        <td><?php echo $value_mothername ?></td>
                        <td><?php echo $value_contactnumber ?></td>
                        <td><?php echo $value_address ?></td>
                        <td><?php echo $value_class ?></td>
                        <td><?php echo $value_birthdate ?></td>
                    </tr>
                </table>
            </div>
        </main>

        <footer class="mt-auto text-white-50">
            <p><i style="font-size:24px" class="fa">&#xf1f9;</i> <a href="https://perkyrabbit.space/" class="text-white">Perky Rabbit</a> by <a href="https://www.facebook.com/ritewu2014/" class="text-white">Riajul Islam Tonmoy</a></p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <?php
    if (isset($_SESSION['updatemsg']) && $_SESSION['updatemsg'] == "updatedone") {
    ?>
        <script>
            swal("Update Done!", "Profile Information Updated!", "success");
        </script>
    <?php
        unset($_SESSION['updatemsg']);
    }
    ?>
</body>

</html>