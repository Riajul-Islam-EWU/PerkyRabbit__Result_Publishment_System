<?php
include("config.php");
session_start();

$totalquestions = $_SESSION['questionnumber'];
$subject_code = $_SESSION['code'];
$question_paper_id = $_SESSION['question_paper_id'];
$counter = 0;

$sql1 = "SELECT * FROM subjects WHERE subject_code = '$subject_code' LIMIT 1";
$result1 = mysqli_query($db, $sql1);
$row1 = mysqli_fetch_array($result1);

// Inserting data into Database
if (isset($_POST['btn_submit_questionnaire'])) {

    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $option = $_POST['option'];


    for ($i = 0; $i < $totalquestions; $i++) {
        $send_question = $question[$i];
        $send_answer = $answer[$i];
        $query = "INSERT INTO questionnaire (question_paper_id, question, answer) VALUES ('$question_paper_id', '$send_question', '$send_answer')";
        mysqli_query($db, $query);

        $sql2 = "SELECT * FROM questionnaire WHERE question = '$send_question' LIMIT 1";
        $result2 = mysqli_query($db, $sql2);
        $row2 = mysqli_fetch_array($result2);
        $question_id = $row2['id'];

        for ($j = 0; $j < 4; $j++) {
            $send_option = $option[$counter];
            $query1 = "INSERT INTO question_options (question_id, option) VALUES ('$question_id', '$send_option')";
            mysqli_query($db, $query1);
            $counter++;
        }
    }
    $_SESSION['questionnaire_status'] = "created";
    $_SESSION['question_paper_id_show'] = $question_paper_id;
    header("Location: manage_questionnaire.php");
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPS - Questionnaire </title>

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
                    <a class="nav-link" href="manage_questionnaire.php">Manage Questionnaire</a>
                    <a class="nav-link" href="logout.php">LOG OUT</a>
                </nav>
            </div>
        </header>

        <main>
            <form action="" method="POST" id="form1">
                <h3 class="justify-content-md-center">Make Qustionnaire for <?php echo $row1['subject_name']; ?></h3>
                <?php
                for ($i = 0; $i < $_SESSION['questionnumber']; $i++) { ?>
                    <div class="container border border-info rounded">
                        <div class="row">
                            <div class="col"><br>
                                <label for="textarea" class="bg-success p-2 rounded">
                                    <h4>Question: <?php echo $k = $i + 1; ?></h4>
                                </label><br> <br>
                                <textarea type="text" class="form-control" name="question[]" placeholder="Type question here..." required></textarea><br>
                            </div>
                        </div>

                        <div class="row">
                            <?php
                            for ($j = 1; $j <= 4; $j++) { ?>
                                <div class="col">
                                    <input class="form-control mb-3" type="input" name="option[]" id="" placeholder="Option <?php echo $j ?>" required>
                                </div><?php
                                    }
                                        ?>
                            <div class="col">
                                <select class="form-control" name="answer[]" required>
                                    <option value="" selected disabled>Please Select Answer</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                </select>
                            </div>
                        </div>
                    </div><br><br>
                <?php
                }
                ?>
                <div class="container mb-5">
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <input type="submit" class="btn btn-danger mt-3" name="btn_submit_questionnaire" value="Submit Questionnaire" form="form1">
                        </div>
                    </div>
                </div>
            </form>
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