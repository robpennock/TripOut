<!DOCTYPE html>
<?php
    require_once("../db.php");
    $logonSuccess = false;
    // verify user's credentials
    //setcookie('user', NULL,time() + 86400,'/');
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $logonSuccess = (UserDB::getInstance()->verify_user_credentials($_POST['user'], $_POST['userpassword']));
        if($logonSuccess == true){
            session_start();
            $_SESSION['user'] = $_POST['user'];
            setcookie('user', $_SESSION['user'], time() + 86400, '/');
            session_id();
            header('Location: index.php');
            exit;
        }
    else header('Location: index.php');
    }
?>

<html>
    <head>
        <title>Vertical Prototype</title>    
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap.css">
        <style type ="text/css">
            body{
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap-responsive.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
    </head>
    <body> 
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/script.js"></script>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="index.php">TRIP OUT! Vertical Prototype</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li class="active"><a href="#" id ="homeLink"> <span class="glyphicon glyphicon-home"></span> Home</a></li>
                            <li><a href="#" id ="aboutLink">About</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                        <ul class ="nav pull-right">
                            <?php
                            if(isset($_COOKIE['user'])){
                             echo '   
                                <li class ="dropdown">
                                    <a href="#" class ="dropdown-toggle" data-toggle="dropdown">Utility<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" id="editReviewLink">Edit Review List</a></li>
                                        <li><a href="#logoutLink">Logout</a></li>
                                    </ul>
                                </li>';
                            }
                            ?>
                        </ul>
                        <ul class ="nav pull-right">
                            <?php
                                if(!isset($_COOKIE["user"])){
                                    echo '<li id ="signIn_Or_UserID"><a href="#" id ="signInUpLink">Sign In/Up</a></li>'; 
                                }else{
                                    echo  '<li><a>welcome ' . $_COOKIE['user'] . '!</li>';
                                }
                            ?>
                        </ul>
                        <a class="btn btn-primary pull-right" href ="">button</a>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container" id="mainContent">
            <script>
                $('#mainContent').load('main.html');
            </script>
        </div>
    </body>
</html>
sfsuswe.com ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDJ8ndsn10bjHrsY1U4kQmoWfmPreAO9wCRaKxW7KPY0W7Ly+2sH6i9UGFlBsZ2Z+ommcw6MiNjx0qlKBhzr8wRypLaCGJjijuh7BPEkN9IwA1sBWcaVCU8ZawIGF79NvDP+o1vI8VEILleKBQxA76buR2eYGWgNt2Lv/lzKh0DYyas5tM2J1h2pbi2ZmsHyg9eg5NPn/2j8t2aBmOrNez1KwZ4DxjA+QjALPJDWJadoZCgEnursh67HZRXs60+XU3kIpVqcnknI/tKebyf3DOrDT/fKSaCNRl0bSP1mEJyeWGFdOw8uh06PFKJ5Ctn82bq+bYwC1H1U3ABn9Nvyjm3
