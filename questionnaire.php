<?php
include("config.php");
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
                    <a class="nav-link" href="logout.php">LOG OUT</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <div class="container m-5 p-3">
            <div class="container">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="card ">
            <div class="card-header">Personal Info</div>
            <div class="card-block">
                Gender:
                <br />
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" /> Male
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" /> Female
                    </label>
                </div>
                <br />
                <br />

                Age Group:
                <br />
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" />Under 18
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" />18-25
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" />25-50
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" />Over 50
                    </label>
                </div>
                <br />
                <br />
            </div>
        </div>

        <div class="card ">
            <div class="card-header">Experience Rating</div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-5">
                        <span style="font-size:22px;">Stay:</span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-7">
                        <div id="rate1" style="margin-top:6px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-5">
                        <span style="font-size:22px;">Food:</span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-7">
                        <div id="rate2" style="margin-top:6px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-5">
                        <span style="font-size:22px;">Service:</span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-7">
                        <div id="rate3" style="margin-top:6px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card ">
            <div class="card-header">Travel Satisfaction</div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <span style="font-size:22px;">Travel:</span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="decrease1" style="width:100%; max-width:35px;">-</button>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <div style="width:100%;" id="progress1"></div>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="increase1" style="width:100%; max-width:35px;">+</button>
                    </div>
                </div>
                <div class="clearfix"><br /></div>
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <span style="font-size:22px;">Transfer:</span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="decrease2" style="width:100%; max-width:35px;">-</button>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <div style="width:100%;" id="progress2"></div>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="increase2" style="width:100%; max-width:35px;">+</button>
                    </div>
                </div>
                <div class="clearfix"><br /></div>
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <span style="font-size:22px;">Checkin:</span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="decrease3" style="width:100%; max-width:35px;">-</button>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <div style="width:100%;" id="progress3"></div>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="increase3" style="width:100%; max-width:35px;">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- you need to include the shieldui css and js assets in order for the components to work -->
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>

<script type="text/javascript">
    jQuery(function ($) {
        $('#rate1').shieldRating({
            max: 7,
            step: 0.1,
            value: 0,
            markPreset: false
        });

        $('#rate2').shieldRating({
            max: 7,
            step: 0.1,
            value: 0,
            markPreset: false
        });

        $('#rate3').shieldRating({
            max: 7,
            step: 0.1,
            value: 0,
            markPreset: false
        });

        var progress1 = $("#progress1").shieldProgressBar({
            value: 50,
            text: {
                enabled: true,
                template: "{0} %"
            }
        }).swidget();

        var progress2 = $("#progress2").shieldProgressBar({
            value: 50,
            text: {
                enabled: true,
                template: "{0} %"
            }
        }).swidget();

        var progress3 = $("#progress3").shieldProgressBar({
            value: 50,
            text: {
                enabled: true,
                template: "{0} %"
            }
        }).swidget();


        $("#increase1").shieldButton({
            events: {
                click: function () {
                    progress1.value(progress1.value() + 10);
                }
            }
        });
        $("#decrease1").shieldButton({
            events: {
                click: function () {
                    progress1.value(progress1.value() - 10);
                }
            }
        });

        $("#increase2").shieldButton({
            events: {
                click: function () {
                    progress2.value(progress2.value() + 10);
                }
            }
        });
        $("#decrease2").shieldButton({
            events: {
                click: function () {
                    progress2.value(progress2.value() - 10);
                }
            }
        });

        $("#increase3").shieldButton({
            events: {
                click: function () {
                    progress3.value(progress3.value() + 10);
                }
            }
        });
        $("#decrease3").shieldButton({
            events: {
                click: function () {
                    progress3.value(progress3.value() - 10);
                }
            }
        });
    });
</script>

<style>
    .slider {
        width: 100%;
    }
</style>



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