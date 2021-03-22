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
    <title>RPS - Online Result Board</title>

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
                    <a class="nav-link" aria-current="page" href="home.php">Home</a>
                    <a class="nav-link active" aria-current="page" href="result_board.php">Online Result</a>
                    <a class="nav-link" href="logout.php">LOG OUT</a>
                </nav>
            </div>
        </header>

        <main>
            <div class="table-responsive-md">
                <table class="table table-light table-striped w-50 mx-auto">
                    <thead>
                        <tr>
                            <th scope="col">Question Paper ID</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['only_student'])) {
                            $student_id_use = $_SESSION['student_id'];
                            $sql2 = "SELECT * FROM result_board WHERE student_id = '$student_id_use'";
                            $result2 = mysqli_query($db, $sql2);

                            if (mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    $exam_id = $row2['exam_id'];
                                    $student_id = $row2['student_id'];
                                    $firstname = $row2['firstname'];
                                    $lastname = $row2['lastname'];
                                    $subject_name = $row2['subject_name'];
                                    $marks = $row2['marks'];
                                    $sql1 = "SELECT * FROM give_exam WHERE id = '$exam_id'";
                                    $result1 = mysqli_query($db, $sql1);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $question_paper_id = $row1['question_paper_id'];
                        ?>
                                    <tr>
                                        <td><?php echo $question_paper_id ?></td>
                                        <td><?php echo $student_id ?></td>
                                        <td><?php echo $firstname ?></td>
                                        <td><?php echo $lastname ?></td>
                                        <td><?php echo $subject_name ?></td>
                                        <td><?php echo $marks ?></td>
                                    </tr>
                                <?php
                                }
                            }
                            unset($_SESSION['only_student']);
                        } else {
                            $sql = "SELECT * FROM result_board";
                            $result = mysqli_query($db, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $exam_id = $row['exam_id'];
                                    $student_id = $row['student_id'];
                                    $firstname = $row['firstname'];
                                    $lastname = $row['lastname'];
                                    $subject_name = $row['subject_name'];
                                    $marks = $row['marks'];
                                    $sql1 = "SELECT * FROM give_exam WHERE id = '$exam_id'";
                                    $result1 = mysqli_query($db, $sql1);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $question_paper_id = $row1['question_paper_id'];
                                ?>
                                    <tr>
                                        <td><?php echo $question_paper_id ?></td>
                                        <td><?php echo $student_id ?></td>
                                        <td><?php echo $firstname ?></td>
                                        <td><?php echo $lastname ?></td>
                                        <td><?php echo $subject_name ?></td>
                                        <td><?php echo $marks ?></td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
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
    if (isset($_SESSION['exam_status']) && $_SESSION['exam_status'] == "complete") { ?>
        <script>
            swal("Paper Submitted!", "Result will be in Result Board!", "success");
        </script>
    <?php
        unset($_SESSION['exam_status']);
    }
    ?>

</body>

</html>