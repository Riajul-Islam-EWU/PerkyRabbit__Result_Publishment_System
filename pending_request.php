<?php
include("config.php");
session_start();
$username = $_SESSION['username'];
$test1 = "staff";
$test2 = "teacher";
$test3 = "student";
?>
<?php
global $notification;
if (isset($_GET['update'])) {
    $value_username = $_GET['update'];
    $sql = "UPDATE user_table SET validity = 'valid' WHERE username = '$value_username'";
    $updatequery = mysqli_query($db, $sql);
    $notification = $updatequery;
    if ($updatequery) {
        $notification = "update done";
    }
}
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

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
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
                <table class=" table table-bordered table-dark">
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
                    ?>
                            <tr>
                                <td><span><?php echo $value_firstname . " " . $value_lastname ?></span></td>
                                <td><?php echo $value_username ?></td>
                                <td><?php echo $value_validity ?></td>
                                <td><a href="pending_request.php?update=<?php echo $value_username ?>" class="btn btn-success">Approve</a></td>
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
            <?php
            global $notification;
            if ($notification) {
                echo "update done";
            }
            ?>
        </main>

        <footer class="mt-auto text-white-50">
            <p><i style="font-size:24px" class="fa">&#xf1f9;</i> <a href="https://perkyrabbit.space/" class="text-white">Perky Rabbit</a> by <a href="https://www.facebook.com/ritewu2014/" class="text-white">Riajul Islam Tonmoy</a></p>
        </footer>
    </div>

</body>

</html>