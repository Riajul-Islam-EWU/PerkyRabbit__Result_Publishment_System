<?php
include("config.php");
session_start();

if (isset($_POST['btnsearch'])) {
    $_SESSION['search_question_paper'] = $_POST['search_question_paper'];
    header('location: view_questionnaire_teacher.php');
}

if (isset($_POST['btnsubmit'])) {
    $subjectname = $_POST['select_subject'];
    $sql1 = "SELECT * From subjects WHERE subject_name = '$subjectname' ";
    $result1 = mysqli_query($db, $sql1);
    $row1 = mysqli_fetch_array($result1);
    $subjectcode = $row1["subject_code"];
    $_SESSION['code'] = $subjectcode;
    $permission = 1;
} else {
    $subjectcode = "Select subject for code";
    $permission = 0;
}

if (isset($_POST['btncreatequsetion'])) {
    $_SESSION['questionnumber'] = $_POST['questionnumber'];
    $send_subjectcode = $_SESSION['code'];
    $query = "INSERT INTO question_paper (subject_code) VALUES ('$send_subjectcode')";
    if (mysqli_query($db, $query)) {
        $last_id = mysqli_insert_id($db);
    }
    $_SESSION['question_paper_id'] = $last_id;
    header('location: questionnaire.php');
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPS - Manage Questionnaire </title>

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

        <main>
            <div class="container mt-1">

                <form action="#" method="POST">
                    <div class="row justify-content-md-center">
                        <div class="col-md-4">
                            <label for="search_question_paper">
                                <h5 class="text-warning border border-warning rounded p-2">Search by Question Paper Code</h5>
                            </label>
                            <input type="text" class="form-control w-75 m-auto" name="search_question_paper" placeholder="Please input questionnaire code" required><br>
                            <input class="btn btn-outline-info" type="submit" value="VIEW QUESTIONNAIRE" name="btnsearch">
                        </div>
                    </div><br>
                </form>

                <form action="#" method="POST">

                    <div class="row justify-content-md-center">
                        <div class="col-md-4">
                            <label for="select_subject">
                                <h5 class="text-warning border border-warning rounded p-2">Select Subject to Create Questionnaire</h5>
                            </label>
                            <select class="form-control" name="select_subject" required>
                                <option value="" selected disabled>Please Select Subject</option>
                                <?php
                                $sql = "SELECT * From subjects WHERE status = 'active'";
                                $result = mysqli_query($db, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['subject_name'] . "'>" . $row['subject_name'] . "</option>";
                                }
                                ?>
                            </select><br>
                            <input class="btn btn-outline-info" type="submit" value="GET CODE" name="btnsubmit">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col">

                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="col-md-2">
                            <label for="subject_code">
                                <h5 class="text-warning border border-warning rounded p-2">Subject Code</h5>
                            </label>
                            <input class="form-control text-center" type="text" value="<?php echo $subjectcode; ?>" name="subject_code" disabled>
                        </div>
                    </div>

                </form>

                <form action="" method="POST">
                    <?php if ($permission == 1) { ?>
                        <br>
                        <div class="row justify-content-md-center">
                            <div class="col-md-6 mb-5">
                                <label for="questionnumber">
                                    <h5>Input how many questions will be in Questionnaire</h5>
                                </label>
                                <input type="text" class="form-control w-25 m-auto" name="questionnumber" required><br>
                                <input class="btn btn-danger" type="submit" value="Create Questionnaire" name="btncreatequsetion">
                            </div>
                        </div>
                    <?php
                    } ?>
                </form>
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
    if (isset($_SESSION['questionnaire_status']) && $_SESSION['questionnaire_status'] == "created") {
        $question_paper_id_show = $_SESSION['question_paper_id_show'];
    ?>
        <script>
            swal("Questionnaire Created!", "Questionnaire Code: <?php echo $question_paper_id_show ?>", "success");
        </script>
    <?php
        unset($_SESSION['questionnaire_status']);
    }
    ?>
</body>

</html>