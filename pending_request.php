<?php
include("config.php");
session_start();
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

        .table td {
            text-align: center;
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
                    <a class="nav-link" href="logout.php">LOG OUT</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <div class="container">
                <table class=" table table-bordered table-light table-hover table-striped">
                    <tr>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Status</th>
                        <th>Update Status</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM user_table WHERE validity = 'pending'";
                    $result = mysqli_query($db, $sql);
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $value_firstname = $row["firstname"];
                            $value_lastname = $row["lastname"];
                            $value_username = $row["username"];
                            $value_validity = $row["validity"];
                            $value_user_id = $row["user_id"];
                    ?>
                            <tr>
                                <td><span><?php echo $value_firstname . " " . $value_lastname ?></span></td>
                                <td><?php echo $value_username ?></td>
                                <td><?php echo $value_validity ?></td>
                                <td><a href="pending_request.php?update=<?php echo $value_user_id ?>" class="btn btn-success">Approve</a></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <td colspan="4">
                            <?php echo "No pending Request"; ?>
                        </td>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </main>

        <footer class="mt-auto text-white-50">
            <p><i style="font-size:24px" class="fa">&#xf1f9;</i> <a href="https://perkyrabbit.space/" class="text-white">Perky Rabbit</a> by <a href="https://www.facebook.com/ritewu2014/" class="text-white">Riajul Islam Tonmoy</a></p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <?php
    if (isset($_SESSION['msg']) && $_SESSION['msg'] == "updatedone") {
    ?>
        <script>
            swal("Update Done!", "Student now able to LOG IN!", "success");
        </script>
    <?php
        unset($_SESSION['msg']);
    }
    ?>
    <?php
    if (isset($_GET['update'])) {
        $value_user_id = $_GET['update'];
        $sql = "UPDATE user_table SET validity = 'valid' WHERE user_id = '$value_user_id'";
        $updatequery = mysqli_query($db, $sql);
        if ($updatequery) {
            $_SESSION['msg'] = "updatedone";
            header('location: pending_request.php');
        }
    }
    ?>
</body>

</html>