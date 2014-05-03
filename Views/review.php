<!-- Author:Matthew Rutherford 
Made by Modifying signIn.php-Rob Pennock-->

<!--This php block is called when a review is submitted it takes the post variables
and puts them into a review model.  this model is used by reviewController to add a review
to the Database-->
<?php

    require_once("../Controllers/ReviewController.php");
    require_once("../Models/Review.php");
    require_once '../Session/Session.php';
    require_once '../Controllers/AccountController.php';
    
    $s = Session::getInstance();
    $s->start();
    if(AccountController::isLogin()){
        $user = AccountController::getLoggedinUser();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rev = new Review();
        $rev->setDestId($_POST['destinationID']);
        $rev->setComment($_POST['review']);
        $rev->setTitle($_POST['reviewTitle']);
        $rev->setUserId($user->getUserID());
        $rev->setRating($_POST['rating']);
        
        try{
            ReviewController::add($rev);
         }
        catch(ReviewException $e){
            echo $e;
            exit;
        }
        echo "Review posted";
        exit;
    }
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $dest=$_GET['destid'];
    }
 
 
    ?>
<html>
    <head>
        <title>TRIP OUT!</title> 
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap.css">
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap-responsive.css">
        <link rel ="stylesheet" type ="text/css" href ="../rateit/src/rateit.css"> 
        
        <script src="../js/bootstrap.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/jquery.js"></script>
        <script src="../rateit/src/jquery.rateit.js"></script>
        <!-- Add jQuery library -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    </head>
    <body>
        
    <div class="container">
         <div class="span5">
             <?php if(isset($_GET['failed'])):?>
                <p style="color:red;">File upload failed, but review has been posted</p>
            <?php exit; endif;?>
                <h3>Write a Review!</h3>
                <form name="logon" action="../Controllers/UploadController.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="destinationID" value="<?php echo $dest;?>">
                    Title: <input type="text" name="reviewTitle">
                    <input type="range" min="0" max="5" value="0" step="0.5" name="rating" id="backing2">
                    <span class="rateit" data-rateit-backingfld="#backing2"></span><br/><br>
                    Review: <textarea name="review"rows="4" cols="50"></textarea><br>
                    <hr>
                    <p>Upload Media(Optional)</p> 
                    Media Title: <input type="text" name="fileTitle"><br>
                    <input type=file  name="file" value="Browse"><br>
                    <input class="btn btn-primary" type="submit" id="editButton" value="Submit">
                    
                </form>
         </div>
    </div>
    </body>
</html>

