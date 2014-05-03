<?php
    require_once '../Session/Session.php';
    require_once '../Controllers/AccountController.php';
    require_once("../DAOs/DestinationDAO.php");
    require_once("../DAOs/ImageDAO.php");

    $s = Session::getInstance();
    $s->start();
    if(AccountController::isLogin()){
        $user = AccountController::getLoggedinUser();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && array_key_exists('logout', $_POST)) {
        AccountController::logout();
    }
    
    $destin = DestinationDAO::getByID($_GET['destinationId']);
    $images = ImageDAO::getByDestId($destin->getDestId());
?>
<html>
    <head>
        <title>TRIP OUT!</title>    
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap.css">
        <link rel ="stylesheet" type ="text/css" href ="../css/index.css">
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap-responsive.css">
        <script src="../js/bootstrap.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/jquery.js"></script>
        
        <!--FANCY BOX FILES-->
        <!-- Add jQuery library -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <!-- Add mousewheel plugin (this is optional) -->
        <script type="text/javascript" src="../fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <!-- Add fancyBox -->
        <link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <!-- Optionally add helpers - button, thumbnail and/or media -->
        <link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <!--END FANCYBOX FILES-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body> 
        <div class ="container">
           <!-- BEGIN BANNER -->
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
            <?php if (AccountController::isLogin()): ?>
                <form class = "navbar-form navbar-right" style ="color:white;" action ="../index.php" method="post">
                    Hello, <?php echo $user->getUserName(); ?> | 
                    <input class = "btn btn-default" type="submit" name = "logout" value ="logout"></input>
                </form>
             <?php else: ?>
                <form class="navbar-form navbar-right">
                    <a type="submit" class="btn btn-default fancybox fancybox.iframe" href="signIn.php" id ="signInButton">Sign In</a>;
                    <a type="submit" class="btn btn-default" href="signUp.php" id ="registerButton">Register</a>;
                </form>;
            <?php endif ?>
        </nav>
            <!-- END BANNER -->
            <div class ="row" align ="center">
                <div class ="col-md-3">
                </div>
                <div class ="col-md-2">
                    <a class="btn btn-default" href = "destinationDetail.php?destinationId=<?php echo $destin->getDestId();?>" > Back to Destination</a>
                </div>
                <div class ="col-md-3">
                    <a href ="">All</a> | 
                    <a href ="">Images</a> | 
                    <a href ="">Videos</a>
                </div>
            </div>
            <hr>
            <table align="center" cellpadding="10px">
                <tr>
                    <td colspan ="4"><?php echo $destin->getName(); ?> - images</td>
                    <!--<td colspan="1"style="text-align:right;">Showing 1-10 of 200</td>-->
                </tr>
                <?php
                    $numImages = $destin->getNumImages();
                    $imageIndex = 0;
                    $rowImages = 0;
                    $numRows = ceil($numImages/5);
                  
                    for($j=1; $j<$numImages; $j++):
                ?>
                    <?php if ($j == 1 || $j%6 == 0): ?>
                        <tr>
                    <?php endif ?>
                    <td>
                        <a href="<?php echo $images[$imageIndex]->getRelUrl();?>">
                            <img src="<?php echo $images[$imageIndex]->getRelUrl();?>" alt="" class="img-thumbnail" height="140px" width ="140px">
                        </a>
                    </td>  
                    <?php if($j%5 == 0): ?>
                        </tr>
                    <?php endif ?>
                    <?php 
                        $imageIndex++;
                    endfor ?>
            </table>
            <!-- BEGIN FOOTER -->
            <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
                <div class ="footer">
                    SFSU-FAU-FULDA joint SW Engineering Project Fall 2013 | <a name ="privacyPolicy" class="fancybox fancybox.iframe" href ="privacyPolicy.html">Privacy Policy</a>
                </div>
            </nav>
            <!-- END FOOTER -->
        </div>
    </body>
    
    <!--js for fancy box-->
    <script type="text/javascript">
	$(document).ready(function() {
                $("a[href$='.jpg']").attr('rel', 'gallery').fancybox();
                $(".fancybox").fancybox({
                      "width":500,
                      "height":200,
                      "afterClose":function(){ //refresh the page with username after signing in
                          parent.location.reload(true);
                      }
                  });
	});
    </script>
</html>

