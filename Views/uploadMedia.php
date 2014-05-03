<!-- Author:Matthew Rutherford 
Made by Modifying signIn.php-Rob Pennock and file uploading tutorial on W3 Schools

This class deals with displaying the buttons to upload data, and handling the uploading to the server, and telling the database
where it is stored at-->
<?php
require_once '../Session/Session.php';
require_once '../Controllers/AccountController.php';
require_once"../Models/Destination.php";
//when coming from another page, it sends the destination that needs to be uploaded
if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $dest=$_GET['destid'];
}
//checks if user is logged in, if they aren't this exits
$s = Session::getInstance();
    $s->start();
    if(AccountController::isLogin()){
        $user = AccountController::getLoggedinUser();
    }
    else
    {
         echo "Please log in before uploading media";
         exit;
    }
?>
<html>
    <head>
        <title>TRIP OUT!</title>    
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap.css">
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap-responsive.css">
        <script src="../js/bootstrap.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/jquery.js"></script>
        <!-- Add jQuery library -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    </head>
    <div class="container">
     <div class="row">
         <div class="span5">
             <?php if(isset($_GET['failed'])):?>
                <p style="color:red;">File upload failed</p>
            <?php endif; ?>
                <h3>Upload pictures or videos</h3>
                <p>
                <!--This form sends the file that is chosen to UploadController along with the title that a user inputs, and the 
                destinationID to upload the image or video to-->
                <form action="../Controllers/UploadController.php" method="post" enctype="multipart/form-data">
                <!-- php code echos the a destinationID which to UploadController knows what destination to upload to-->
                <input type="hidden" name="destinationID" value="<?php echo $dest;?>">
                Title: <input type="text" name="fileTitle">
                <input type="file" name="file" id="file"><br>
                <input type="submit" name="submit" value="Submit">
                </form>
         </div>
     </div>
    </div>
</html>

