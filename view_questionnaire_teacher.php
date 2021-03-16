<?php
include("config.php");
session_start();

$value = 0;

$search_id = $_SESSION['search_question_paper'];

$sql1 = "SELECT * FROM question_paper WHERE id = '$search_id' LIMIT 1";
$result1 = mysqli_query($db, $sql1);
$row1 = mysqli_fetch_array($result1);

$subject_code = $row1['subject_code'];

$sql2 = "SELECT * FROM subjects WHERE subject_code = '$subject_code' LIMIT 1";
$result2 = mysqli_query($db, $sql2);
$row2 = mysqli_fetch_array($result2);

$sql3 = "SELECT * FROM questionnaire WHERE question_paper_id = '$search_id'";
$result3 = mysqli_query($db, $sql3);
$counter = mysqli_num_rows($result3);

$question_id = array();
$question = array();
$option = array();
if (mysqli_num_rows($result3) > 0) {
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $question_id[] = $row3['id'];
        $question[] = $row3['question'];
        $answer[] = $row3['answer'];
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPS - View Questionnaire </title>

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
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-5 border border-warning rounded p-2">
                        <h5 class="text-warning">View Qustionnaire for <?php echo $row2['subject_name']; ?></h5>
                        <h5 class="text-warning">Subject Code: <?php echo $row1['subject_code']; ?></h5>
                        <h5 class="text-warning">Question Paper Code: <?php echo $search_id; ?></h5>
                    </div>
                </div>
            </div>

            <?php
            for ($i = 0; $counter > $i; $i++) {
                $value = $i + 1; ?>
                <br>
                <div class="container mb-3">
                    <div class="row justify-content-md-center">
                        <?php echo "<h5 class=" . '"col-md-2 border border-info rounded"> Question No: ' . $value . "</h5>"; ?>
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
                                    while ($row4 = mysqli_fetch_assoc($result4)) {
                                        $option = $row4['option'];
                                ?>
                                        <div class="col border border-success rounded m-1">Option <?php echo ": " . $value . " " . $option; ?></div>
                                <?php
                                    }
                                }
                                ?>
                                <div class="col border border-danger rounded m-1"> Answer: <?php echo $answer[$i]; ?></div>
                            </div>
                        </div>
                    </div>
                </div><?php
                    }
                        ?>

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