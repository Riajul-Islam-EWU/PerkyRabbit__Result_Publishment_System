<?php
include("config.php");
session_start();

$j = 0;
$option_id = array();

$value_question = 0;

$question_paper_search_id = $_SESSION['search_question_paper_student'];

$sql1 = "SELECT * FROM question_paper WHERE id = '$question_paper_search_id' LIMIT 1";
$result1 = mysqli_query($db, $sql1);
$row1 = mysqli_fetch_array($result1);

$subject_code = $row1['subject_code'];

$sql2 = "SELECT * FROM subjects WHERE subject_code = '$subject_code' LIMIT 1";
$result2 = mysqli_query($db, $sql2);
$row2 = mysqli_fetch_array($result2);

$sql3 = "SELECT * FROM questionnaire WHERE question_paper_id = '$question_paper_search_id'";
$result3 = mysqli_query($db, $sql3);
$counter = mysqli_num_rows($result3);

$question_id = array();
$question = array();
$option = array();
if (mysqli_num_rows($result3) > 0) {
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $question_id[] = $row3['id'];
        $question[] = $row3['question'];
    }
}

if (isset($_POST['btnsubmitpaper'])) {
    $mark_counter = 0;

    for ($i = 0; $i < $counter; $i++) {
        $keep_question_id = $question_id[$i];

        $sql6 = "SELECT * FROM questionnaire WHERE id = '$keep_question_id' LIMIT 1";
        $result6 = mysqli_query($db, $sql6);
        $row6 = mysqli_fetch_assoc($result6);
        $compare_answer = $row6['answer'];

        $selected_radio_option = $_POST['radio_option'][$i];



        $sql9 = "SELECT * FROM give_exam WHERE question_paper_id = '$question_paper_search_id' LIMIT 1";
        $result9 = mysqli_query($db, $sql9);
        $row9 = mysqli_fetch_array($result9);
        $exam_id = $row9['id'];




        $sql5 = "INSERT INTO student_answer ( exam_id, question_paper_id, question_id, student_answer) VALUES ('$exam_id', '$question_paper_search_id', '$keep_question_id', '$selected_radio_option')";
        mysqli_query($db, $sql5);

        if ($compare_answer == $selected_radio_option) {
            $mark_counter++;
        }
    }
    $mark_counter = $mark_counter * 10;
    $subject_name = $row2['subject_name'];
    $username = $_SESSION['username'];

    $sql8 = "SELECT * FROM user_table WHERE username = '$username' LIMIT 1";
    $result8 = mysqli_query($db, $sql8);
    $row8 = mysqli_fetch_array($result8);
    $firstname = $row8['firstname'];
    $lastname = $row8['lastname'];
    $user_id = $row8['user_id'];

    $sql10 = "SELECT * FROM student_table WHERE student_user_id = '$user_id' LIMIT 1";
    $result10 = mysqli_query($db, $sql10);
    $row10 = mysqli_fetch_array($result10);
    $student_user_id = $row10['student_id'];

    $sql7 = "INSERT INTO result_board (exam_id, student_id, firstname, lastname, subject_name, marks) VALUES ('$exam_id', '$student_user_id', '$firstname', '$lastname', '$subject_name', '$mark_counter')";
    mysqli_query($db, $sql7);
    $_SESSION['exam_status'] = "complete";
    $_SESSION['only_student'] = "yes";
    $_SESSION['student_id'] = $student_user_id;
    header('location: result_board.php');
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPS - Give Exam</title>

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
                    <a class="nav-link" href="logout.php">LOG OUT</a>
                </nav>
            </div>
        </header>

        <main class="mb-5">
            <form action="" method="POST">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-5 border border-warning rounded p-2">
                            <h5 class="text-warning">View Qustionnaire for <?php echo $row2['subject_name']; ?></h5>
                            <h5 class="text-warning">Subject Code: <?php echo $row1['subject_code']; ?></h5>
                            <h5 class="text-warning">Question Paper Code: <?php echo $question_paper_search_id; ?></h5>
                        </div>
                    </div>
                </div>

                <?php
                for ($i = 0; $counter > $i; $i++) { ?>
                    <br>
                    <div class="container mb-3">
                        <div class="row justify-content-md-center">
                            <?php echo "<h5 class=" . '"col-md-2 border border-info rounded"> Question No: ' . $value_question = $i + 1 . "</h5>"; ?>
                        </div>
                    </div>
                    <div class="container border border-info rounded">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                echo "<h5>" . $question[$i] . "</h5>";
                                $sql_question_id = $question_id[$i];
                                $sql4 = "SELECT * FROM question_options WHERE question_id = '$sql_question_id'";
                                $result4 = mysqli_query($db, $sql4);
                                ?>
                                <div class="row">
                                    <?php
                                    if (mysqli_num_rows($result4) > 0) {
                                        $value_option = 1;
                                        while ($row4 = mysqli_fetch_assoc($result4)) {
                                            $option = $row4['option'];
                                            $option_id[] = $row4['id'];
                                    ?>
                                            <div class="col border border-success rounded m-1"><?php echo "Option " . $value_option++ . ": " . $option; ?></div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio_option[<?php echo $i ?>]" value="<?php echo $option_id[$j] ?>" required>
                                    <label class="form-check-label">Option 1</label>
                                    <?php $j++; ?>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio_option[<?php echo $i ?>]" value="<?php echo $option_id[$j] ?>">
                                    <label class="form-check-label">Option 2</label>
                                    <?php $j++; ?>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio_option[<?php echo $i ?>]" value="<?php echo $option_id[$j] ?>">
                                    <label class="form-check-label">Option 3</label>
                                    <?php $j++; ?>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio_option[<?php echo $i ?>]" value="<?php echo $option_id[$j] ?>">
                                    <label class="form-check-label">Option 4</label>
                                    <?php $j++; ?>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                <?php
                }
                ?>
                <input class="btn btn-danger mt-5" type="submit" value="Submit Paper" name="btnsubmitpaper">
            </form>
        </main>

        <footer class="mt-auto mb-3 text-white-50">
            <p><i style="font-size:24px" class="fa">&#xf1f9;</i> <a href="https://perkyrabbit.space/" class="text-white">Perky Rabbit</a> by <a href="https://www.facebook.com/ritewu2014/" class="text-white">Riajul Islam Tonmoy</a></p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
</body>

</html>