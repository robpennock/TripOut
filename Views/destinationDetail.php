<!DOCTYPE HTML>
<?php
    require_once("../Controllers/ReviewController.php");
    require_once("../Models/Destination.php");
    require_once("../DAOs/DestinationDAO.php");
    require_once '../Session/Session.php';
    require_once '../Controllers/AccountController.php';
    $destin = DestinationDAO::getByID($_GET['destinationId']);
    $reviews = ReviewController::getDestinationReviews($destin);
    //Assigning type numbers into real category names
    
    $s = Session::getInstance();
    $s->start();
    
    if(AccountController::isLogin()){
        $user = AccountController::getLoggedinUser();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && array_key_exists('logout', $_POST)) {
        AccountController::logout();
    }
 function showType ($type) {
     if ($type == 0){
         return 'All';
     }
     else if ($type == 1) {
         return 'Attraction';
     }
     else if ($type == 2) {
         return 'Restaurant';
     }
     else if ($type == 3) {
         return 'Hotel';
     }
     else if ($type == 4) {
         return 'Shopping';
     }
     else if ($type == 5) {
         return 'Event';
     }
     else {
         return '---';
     }
}
    ?>

<!-- Author:Matthew Rutherford 
Nav bar: Marcian Diamond/Help with Fancy Box
Stars:Khine-->


<html>
	<head>
            
            <link rel="shortcut icon" href="../media/assets/images/TripoutIcon.ico">
            <title><?php echo $destin->getName(); ?></title> 
            <link rel ="stylesheet" type="text/css" href ="../css/destinationDetail.css" /> 
            <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap.css">
            <link rel ="stylesheet" type ="text/css" href ="../css/index.css">
            <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap-responsive.css"> 
            <link rel ="stylesheet" type ="text/css" href ="../rateit/src/rateit.css"> 
            
            <script src="../js/jquery.js"></script>
            <script src="../rateit/src/jquery.rateit.js"></script>
            <script src="../js/bootstrap.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/script.js"></script>
           

            <!--FANCY BOX FILES-->
            <!-- Add jQuery library -->
            <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
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
            <!--Script for google maps-->
            <script type="text/javascript"
                 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVHTyMX77urThNZcVZHjBcso6gtZNlnk4&sensor=false">
            </script>
            <script type="text/javascript">
                var geocoder;
              function initialize() {
                geocoder = new google.maps.Geocoder();
                var address ="<?php echo $destin->getAddress(); ?>, <?php echo $destin->getCity(); ?>";
                var mapOptions = {
                  center: new google.maps.LatLng(-34.397, 150.644),
                  zoom: 15
                };
                geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
              } else {
                alert("Geocode was not successful for the following reason: " + status);
              }
            });
                var map = new google.maps.Map(document.getElementById("map-canvas"),
                    mapOptions);
              }
              google.maps.event.addDomListener(window, 'load', initialize);
        </script>
	</head>
	<body>
            <!--container holds all the content of the page-->
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
                            <input class = "btn btn-default" type="submit" name = "logout" value ="logout">
                        </form>
                     <?php else: ?>
                        <form class="navbar-form navbar-right">
                            <a type="submit" class="btn btn-default fancybox fancybox.iframe"  href="signIn.php" id ="signInButton">Sign In</a>;
                            <a type="submit" class="btn btn-default" href="signUp.php" id ="registerButton">Register</a>;
                        </form>;
                    <?php endif ?>
                </nav>
                <!-- END BANNER -->
                <!--Photo is the main photo of the destination and has buttons for uploading media or seeing more-->
                <div id ='tooper'>
		<div id = 'photo' class='top'>
                    <div id="mainphoto">
                        <?php if(!$destin->getImageUrl()==""): ?>
                            <a href="<?php echo $destin->getImageUrl()?>" class="fancybox"title="get image title">
                                <img src="<?php echo $destin->getImageUrl()?>" alt="" class="img-thumbnail" width ="300px">
                            </a>
                        <?php  else:?>
                            <img src="http://placehold.it/300x150">
                        <?php endif ?> 
                    </div>
                    <div id="media">
                        <?php  if(AccountController::isLogin()):?>
                        <a class="btn btn-primary fancybox fancybox.iframe" href="uploadMedia.php?destid=<?php echo $destin->getDestId()?>">Upload Picture/Video</a>
                        <?php  else:?>
                        <a class="btn btn-primary fancybox fancybox.iframe" href="signIn.php?loggedin=false&message=upload">Upload Picture/Video</a>
                        <?php endif; ?>
                        <a class="btn btn-info" href = "mediaViewer.php?destinationId=<?php echo $destin->getDestId();?>" > More Pictures/Videos</a>
                        <!--<a class="btn btn-info" href="mediaViewer.php">More Pictures/Videos</a>-->
                    </div>
		</div>
                <!-- holds all the information about a locations(rating, description, name, ...)-->
		<div id = 'info' class='top'>
                    <h1><?php echo $destin->getName(); ?></h1>
                    <p>
                    <span class="rateit" data-rateit-value="<?php echo $destin->getAvgRating(); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></span><span class="badge badge-info"><?php echo $destin->getNumReviews(); ?></span>
                    </p>
                    <p><b>Category: </b><?php echo showType($destin->getType()); ?></p>
                    <p><b>City: </b><?php echo $destin->getCity(); ?></p>
                    <p><b>Address: </b><?php echo $destin->getAddress(); ?></p>
                    <p><b>Phone Number: </b><?php echo $destin->getPhoneNumber(); ?></p>
                    <p><b>Website: </b><a href=<?php echo $destin->getWebsite(); ?>><?php echo $destin->getWebsite(); ?></a></p>
                    <p style="width:600px;"><b>Description: </b><?php echo $destin->getDescription(); ?></p>
		</div>
                <br>
                </div>
                <p></p>
                <div id="Bottom" style="clear:both;">
                    <div id ='destReviews' style="width:50%;display:inline-block;">
                        <h3>Reviews</h3>
                        <?php  if(AccountController::isLogin()):?>
                        <a class="btn btn-mini btn-primary fancybox fancybox.iframe" href="../Views/review.php?destid=<?php echo $destin->getDestId() ?>" title="Write a review">Write a review!</a>
                        <?php  else:?>
                        <a class="btn btn-mini btn-primary fancybox fancybox.iframe" href="../Views/signIn.php?destid=<?php echo $destin->getDestId() ?>" title="Sign In">Write a review!</a>
                        <?php endif; ?>
                        <p><?php $numRev=$destin->getNumReviews();
                                if($numRev==0)
                                       echo "No Reviews for this destination";
                                elseif($numRev==1)
                                        echo "Showing the only review of this destination";
                                else
                                        echo "Showing 1-".$numRev." of ".$numRev." Reviews";
                                    ?>
                        </p>
                        <ul>
                            <?php
                            foreach($reviews as $rev):
                            ?>
                            <li><p><?php echo $rev->getTitle();?>
                                <span class="rateit" data-rateit-value="<?php echo $rev->getRating(); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></span>
                                    <br/>
                                </p>
                                <p><?php echo $rev->getComment() ?></p>
                                <p class = "byline"><font color="grey">by <?php require_once("../DAOs/RegisteredUserDAO.php");
                                echo RegisteredUserDAO::getByID($rev->getUserId())->getUserName(); ?></font></p>
                                <hr>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <ul class="pager">
                            <li><a href="#">Previous</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                    <div id="map-canvas" style="background-color:#E6E6FA;float:right;display:inline-block;width:40%; height:400px">
                        
                    </div>
                </div>
                <!-- BEGIN FOOTER -->
                <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
                    <div class ="footer">
                        SFSU-FAU-FULDA joint SW Engineering Project Fall 2013 | <a name ="privacyPolicy" class="fancybox fancybox.iframe" href ="privacyPolicy.html">Privacy Policy</a>
                    </div>
                </nav>
                <!-- END FOOTER -->
            </div>
            <!-- END CONTAINER -->
	</body>
         <script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox({
                    "width":500,
                    "heigh":200,
                    "afterClose":function(){
                        parent.location.reload(true);
                    }
                });
	});
        </script>
</html>
