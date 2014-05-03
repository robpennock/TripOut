<?php

    require_once 'Session/Session.php';
    require_once 'Models/RegisteredUser.php';
    require_once 'DAOs/RegisteredUserDAO.php';
    require_once 'Controllers/AccountController.php';

    $s = Session::getInstance();
    $s->start();
    if(AccountController::isLogin()){
        $user = AccountController::getLoggedinUser();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && array_key_exists('logout', $_POST)) {
        AccountController::logout();
    }
?>
<html>
    <head>
        <title>TRIP OUT!</title>    
        <link rel ="stylesheet" type ="text/css" href ="css/bootstrap.css">
        <link rel ="stylesheet" type ="text/css" href ="css/bootstrap-responsive.css"> 
        <link rel ="stylesheet" type ="text/css" href ="css/index.css">
        <script src="js/bootstrap.js"></script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Start: Google Analytics Code -->
         <script>
             
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-45881599-1', 'sfsuswe.com');
            ga('send', 'pageview');

         </script>
        <!-- End: Google Analytics Code -->
    </head>
    <body> 
        <!-- using jquery -->
        <!-- just in case we want to use CDN:        
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        -->
        <script src="js/jquery.js"></script>
        <!-- load custom javascript --
        <script>
            $.getScript( "js/script.js");
        </script>-->
        <div class ="container">
            <nav class="navbar navbar-inverse" id="navbar" role="navigation">
                <a class="navbar-brand" href="" id ="logo">TRIP OUT!</a>
                <ul class="nav navbar-nav">
                    <li name = "home" class="active"><a href="">Home</a></li>
                    <li><a href="Views/reviewSearch.php">Write a Review</a></li>
                    <li><a href="Views/createDestination.php" id ="createDestinationLink">Create a Destination</a></li>
                    <li><a href="Views/about.php">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
                    <?php if (AccountController::isLogin()): ?>
                        <form class = "navbar-form navbar-right" style ="color:white;" action ="index.php" method="post">
                            Hello, <?php echo $user->getUserName(); ?> | 
                            <input class = "btn btn-default" type="submit" name = "logout" value ="logout"></input>
                        </form>
                     <?php else: ?>
                        <form class="navbar-form navbar-right">
                            <a type="submit" name ="signIn" class="btn btn-default fancybox fancybox.iframe" href="Views/signIn.php" id ="signInButton">Sign In</a>;
                            <a type="submit" class="btn btn-default" href="Views/signUp.php" id ="registerButton">Register</a>;
                        </form>;
                    <?php endif ?>
            </nav>
            <div class ="home">
                <div class ="overview">
                    <h1>Welcome to Trip Out!</h1>
                    Plan your trip, read reviews, share your experiences
                </div>
                <div class="panel panel-default" style="width:75%;margin-left:auto;margin-right:auto;vertical-align:middle">
                    <div class="panel-heading">Plan Your Trip</div>
                    <div class="panel-body" align="center">
                        <form action='Views/searchResult.php' method="get" class="form-inline" role="form" id ="searchForm">
                            <div style="padding-bottom:10px;">
                                <label class="checkbox-inline">
                                    <input type="radio" id="inlineCheckbox5" name = "type" value="0" checked> All
                                </label>
                                <label class="checkbox-inline">
                                    <input type="radio" id="inlineCheckbox1" name ="type" value="1"> Attractions
                                </label>
                                <label class="checkbox-inline">
                                    <input type="radio" id="inlineCheckbox2" name ="type" value="2"> Restaurants
                                </label>
                                <label class="checkbox-inline">
                                    <input type="radio" id="inlineCheckbox3" name = "type" value="3"> Hotels
                                </label>
                                <label class="checkbox-inline">
                                    <input type="radio" id="inlineCheckbox4" name = "type" value="4"> Shopping
                                </label>
                                <label class="checkbox-inline">
                                    <input type="radio" id="inlineCheckbox6" name = "type" value="5"> Events
                                </label>
                            </div>
                            <div class="form-group" style="width:40%;">
                              <input name="searchString" class="form-control"  placeholder="Enter search keywords" value="">
                            </div>
                            <button type="submit" class="btn btn-default" onClick ="">Search</button>
                        </form>
                    </div>
                </div>
                 <div class ="overview">
                    <h3> SFSU-FAU-FULDA joint SW Engineering Project Fall 2013 </h3>
                </div>
            <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
                <div class ="footer">
                    SFSU-FAU-FULDA joint SW Engineering Project Fall 2013 |  <a name ="privacyPolicy" class="fancybox fancybox.iframe" href ="Views/privacyPolicy.html">Privacy Policy</a>
                </div>
            </nav>
        </div>
        <!--FANCY BOX FILES-->
        <!-- Add jQuery library -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <!-- Add fancyBox -->
        <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".fancybox").fancybox({
                    "width":500,
                    "height":200,
                    "afterClose":function(){
                        parent.location.reload(true);
                    }
                });
	})
        </script>
        <script type="text/javascript" src="js/script.js"></script>

        </body>
</html>
