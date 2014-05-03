<!-- Author: Robin Pennock-->
<?php
    require_once("../Controllers/AccountController.php");
    require_once("../Models/RegisteredUser.php");
    require_once '../Controllers/SearchController.php';
    require_once '../Session/Session.php';

    $s = Session::getInstance();
    $s->start();
    if(AccountController::isLogin()){
        echo '<script>var loggedOn = true;</script>';
    }
    function do_alert($msg) 
    {   echo
        "<script type=\"text/javascript\">".
        "alert('$msg');".
        "top.location = 'signUp.php';".
        "</script>"; 
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pass1=$_POST['InputPassword'];
        $pass2=$_POST['ConfirmPassword'];
        $userEmail = $_POST['InputEmail'];
        $userName = $_POST['InputUsername'];
        $blank = "";
       
        //****fallback for safari support*****//
        //make sure fields are filled out
        if((strcmp( $userName , $blank )=== 0)||(strcmp( $userEmail , $blank )=== 0) || (strcmp( $pass1 , $blank )=== 0) || (strcmp( $pass2 , $blank )=== 0)){
            $msg = "Error: Username, Email, and Password fields must be filled out";
            do_alert($msg);
            //exit;
        }
        //compare password fields for validation
        else if(strcmp($pass1, $pass2)!=0){
            $msg = "Error: password fields do not match.";
            do_alert($msg);
            //exit;
        }
        //check for password length of at least 6 characters
        else if(strlen ( $pass1 )<6){
            $msg = "Error: password must be at least 6 characters in length";
            do_alert($msg);
            //exit;
        }
        //now register the user
        else{
            $user = new RegisteredUser();
            $user->setUserName($_POST['InputUsername']); //getting from the POST
            $user->setEmail($_POST['InputEmail']);
            $user->setPassword($_POST['InputPassword']); 
        }
        //create new account for $user
        try{
            $result = AccountController::register($user);
         }
        catch(AccountException $e){
            echo $e;
            exit;
        }
        try{
            $log = AccountController::login($user->getUserName(), $user->getPassword());
         }
        catch(LoginException $e){
            echo $e;
        }
        
        catch(AccountException $e){
            echo $e . $e;
        }
        $msg = "Account successfully created. Please sign in";
        do_alert($msg);
        header('Location: ../index.php');
        exit;
    }?>
<html>
    <head>
         <!--<link rel ="stylesheet" type ="text/css" href ="../css/bootstrap.css"> -->
        <link rel ="stylesheet" type ="text/css" href ="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap-responsive.css">
        <link rel ="stylesheet" type ="text/css" href ="../css/index.css">

        <script src="../js/bootstrap.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/jquery.js"></script>
        <script src="../js/signup.js"></script>
        <!-- Add jQuery library -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <title></title>
    </head>
    <body>
        
        <!--script below checks to see if passwords match -->
        <!-- logic courtesy of
             http://www.sitepoint.com/using-the-html5-constraint-api-for-form-validation/-->
       

    <!-- Borrowed from Marcians original signup page

    <div class="row" align="center">
        <!-- <div class="span6"> -->

        <div class ="container">
          <nav class="navbar navbar-inverse" role="navigation">
                <a class="navbar-brand" href="../index.php" id ="logo">TRIP OUT!</a>
                <ul class="nav navbar-nav">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="reviewSearch.php">Write a Review</a></li>
                    <li><a href="createDestination.php">Create a Destination</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>

                    <form class="navbar-form navbar-right">
                        <a type="submit" class="btn btn-default fancybox fancybox.iframe"  href="signIn.php" id ="signInButton">Sign In</a>;
                    </form>;
            </nav>
        <div align="center" style="margin: 0 auto;border:2px solid; border-radius:25px; display: block;
        text-align: center; float: center; width: 30%; height: 65%">
         <h3>Sign Up</h3>
         <!-- form needed for sending POST -->
         <form name="ValidationForm" class="form-horizontal" action="signUp.php" method="POST" >
             <div class="control-group">
                 <label class="control-label" for="InputUsername">Username:</label>
                     <div class="controls">
                         <input type="text" name="InputUsername" id="InputUsername" placeholder="username" required>
                     </div>
             </div>
             <div class="control-group">
                 <label class="control-label" for="InputEmail">Email:</label>
                     <div class="controls">
                         <input type="email" name="InputEmail" id="InputEmail" placeholder="email" required>
                     </div>
             </div>
             <div class="control-group">
                 <label class="control-label" for="InputPassword">Password:</label>
                     <div class="controls">
                         <input type="password" name="InputPassword" id="InputPassword" placeholder="password" required>
                     </div>
             </div>
             <div class="control-group">
                 <label class="control-label" for="ConfirmPassword">Confirm Password:</label>
                     <div class="controls">
                         <input type="password" name="ConfirmPassword" id="ConfirmPassword" placeholder="confirm password" required>
                     </div>
             </div>
                <br>
                <input id="submit_sign_up" class="btn btn-primary" type="submit" value="submit" /> | <a name ="privacyPolicy" class="fancybox fancybox.iframe" href ="privacyPolicy.html">Privacy Policy</a>
                
           </form>
        </div>
            <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
            <div class ="footer">
                SFSU-FAU-FULDA joint SW Engineering Project Fall 2013 | <a id="privacyPolicy" class="fancybox fancybox.iframe" href ="privacyPolicy.html">Privacy Policy</a>
            </di
        </div>
        <!--FANCY BOX FILES-->
       <!-- Add jQuery library -->
       <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
       <!-- Add fancyBox -->
       <link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
       <script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".fancybox").fancybox({
                    "width":500,
                    "height":200,
                    "afterClose":function(){
                        parent.location.reload(true);
                    }
                });
                
                if(loggedOn == true){
                    var pathname = window.location.pathname;
                    pathname = pathname.replace("Views/signUp.php", "index.php");
                    parent.window.location.href = pathname;
                }
            });
        </script>
    </body>            
</html>
