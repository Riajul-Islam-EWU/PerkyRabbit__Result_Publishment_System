<?php
include("config.php");
session_start();

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPS - Select Question Paper</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Icons -->
    <link rel="icon" href="icon/Softkit_logo_32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="icon/Softkit_logo_16x16.png" sizes="16x16" type="image/png">

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container-fluid d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Perky Rabbit</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    <a class="nav-link" href="logout.php">LOG OUT</a>
                </nav>
            </div>
        </header>

        <main class="text-white-50">
            <div class="container">

                <form action="#" method="POST">
                    <div class="row justify-content-md-center">
                        <div class="col-md-4">
                            <label for="search_question_paper_student">
                                <h5 class="text-warning border border-warning rounded p-2">Search by Question Paper Code</h5>
                            </label>
                            <input type="text" class="form-control w-75 m-auto" name="search_question_paper_student" placeholder="Please input question paper code" required>
                        </div>
                    </div><br>

                    <div class="row justify-content-md-center">
                        <div class="col-md-4">
                            <label for="verify_password">
                                <h5 class="text-warning border border-warning rounded p-2">Input Password</h5>
                            </label>
                            <input type="password" class="form-control w-75 m-auto" name="verify_password" placeholder="Please input password for verification" required><br>
                            <input class="btn btn-outline-info" type="submit" value="Start Exam" name="btnstartexam">
                        </div>
                    </div><br>
                </form>

                <?php
                if (isset($_POST['btnstartexam'])) {
                    $_SESSION['search_question_paper_student'] = $_POST['search_question_paper_student'];
                    $question_paper_number = $_SESSION['search_question_paper_student'];
                    $verify_password = $_POST['verify_password'];

                    $sql1 = "SELECT * From user_table WHERE username = '$username' LIMIT 1";
                    $result1 = mysqli_query($db, $sql1);
                    $row1 = mysqli_fetch_array($result1);
                    $id = $row1['user_id'];

                    $sql2 = "SELECT * From question_paper WHERE id = '$question_paper_number' LIMIT 1";
                    $result2 = mysqli_query($db, $sql2);
                    $row2 = mysqli_fetch_array($result2);

                    if ($row1['password'] == $verify_password && !empty($row2['id'])) {
                        $query = "INSERT INTO give_exam (student_user_id, question_paper_id, status) VALUES ('$id', '$question_paper_number', 'started')";
                        mysqli_query($db, $query);
                        header('location: view_questionnaire_student.php');
                    } else if ($row1['password'] != $verify_password) {
                        echo '<h5 class="text-danger rounded p-2">INCORRECT PASSWORD</h5>';
                    } else {
                        echo '<h5 class="text-danger rounded p-2">QUESTION PAPER NOT FOUND</h5>';
                    }
                }
                ?>

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
</body>

</html>