<?php
require_once '../Session/Session.php';
require_once '../Controllers/AccountController.php';
require_once '../Controllers/MediaController.php';
require_once"../Models/Destination.php";
require_once"../DAOs/DestinationDAO.php";
require_once '../Models/Image.php';
require_once '../Models/Video.php';
require_once("../Controllers/ReviewController.php");
require_once("../Models/Review.php");
//Starts the session and sets what user is logged in
$s = Session::getInstance();
    $s->start();
    if(AccountController::isLogin()){
        $user = AccountController::getLoggedinUser();
    }
//This checks if an file is trying to be uploaded, this won't be needed as much if it wasn't in the display file
 function do_alert($msg) {   
    echo
    "<script type=\"text/javascript\">".
    "alert('$msg');".
    "top.location = 'signUp.php';".
    "</script>"; 
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_POST['destName'])){
        echo "testing";
        $destin = new Destination();
        $destin->setName($_POST['destName']);
        $destin->setType($_POST['destType']);
        $destin->setAddress($_POST['destAddress']);
        $destin->setCity($_POST['destCity']);
        $destin->setState($_POST['destState']);
        $destin->setZipCode($_POST['destZip']);
        $destin->setPhoneNumber($_POST['destPhone']);
        $destin->setWebsite($_POST['destWebsite']);
        $destin->setDescription($_POST['destDescription']);
        
        
        try{
            $result = DestinationController::create($destin);
         }
        catch(DestinationException $e){
            $msg = "Error creating destination";
            do_alert($msg);
            echo $e;
            exit;
        }
       // $destinationId=$result->getDestId();
        //header('Location: destinationDetail.php?destinationId=' . $destinationId);
        exit;
        }
    //checks if it is a review that has been posted SIMILAR CHECK CAN BE DONE FOR CREATE DESTINATION
    if(isset($_POST['review'])){
        //creates review model and puts all needed information into it
        $rev = new Review();
        $rev->setDestId($_POST['destinationID']);
        $rev->setComment($_POST['review']);
        $rev->setTitle($_POST['reviewTitle']);
        $rev->setUserId($user->getUserID());
        $rev->setRating($_POST['rating']);
        //adds the new review
        try{
            ReviewController::add($rev);
         }
        catch(ReviewException $e){
            echo $e;
            exit;
        }
        echo "Review posted";
        if(!isset($_FILES["file"]["type"]))
            exit;
    }
 
    //Gets the destination and the number of videos and images it has uploaded to it
   if(!isset($_FILES["file"]["size"]))
   {
       echo "File too big, please try again with smaller file.";
       header('Location: ' . $_SERVER['HTTP_REFERER']);
       exit;
   }
    $destin = DestinationDAO::getByID($_POST['destinationID']);
    $imageNum= $destin->getNumImages();
    $videoNum= $destin->getNumVideos();
    //THese two variables hold what kind of images will be allowed when uploaded
   $allowedImgExts = array("gif", "jpeg", "jpg", "png");
   $allowedVidExts = array("mov","mp4");
   //this gets the file type(the parts after the ".") and then sets it to a variable
   $temp = explode(".", $_FILES["file"]["name"]);
   $extension = end($temp);
   //this checks if the image being uploaded is an image of either gif, jpeg....
   //
   //(strcasecmp($_FILES["file"]["type"],"image/pjpeg")==0)
   //it also checks that the extension gotten in the line above is a valid one
   
       
   if($_FILES["file"]["type"]!="");
   {
   if (((strcasecmp($_FILES["file"]["type"],"image/gif")==0)
   || (strcasecmp($_FILES["file"]["type"],"image/jpeg")==0)
   || (strcasecmp($_FILES["file"]["type"],"image/jpg")==0)
   || (strcasecmp($_FILES["file"]["type"],"image/pjpeg")==0)
   || (strcasecmp($_FILES["file"]["type"],"image/x-png")==0)
   || (strcasecmp($_FILES["file"]["type"],"image/png")==0))
   && in_array($extension, $allowedImgExts)
   && $_FILES["file"]["size"]<5242880)
     {
       //checks if there was any error with the posting of the file
     if ($_FILES["file"]["error"] > 0)
       {
       echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
       }
       //if no errors we can now attempt to upload the image
     else
     {
         // create new directory with 777 permissions if it does not exist yet using appropriate destinationID
        // owner will be the user/group the PHP script is run under
            $dir = "../media/images/".$_POST['destinationID'];
            if ( !file_exists($dir) ) {
                mkdir ($dir, 0777);
            }
            //$path holds what the name of the file will be on the server, and where it will be uploaded to
            //this uses the number of images uploaded on this destination to determine its name
        $path="../media/images/".$_POST['destinationID']."/".$imageNum.".".$extension;
        //checks if image of this name exists yet
        if (file_exists($path))
        {
            echo $_FILES["file"]["name"] . " already exists. ";
        }
       else
       {
           //THIS MOVES THE TEMPORARY IMAGE TO THE SERVER USING THE $path
            if(move_uploaded_file($_FILES["file"]["tmp_name"],
            $path));
            //checks to see if there is a main image set, if not then this becomes it(NOT WORKING YET)
            if($destin->getImageUrl()=="")
                $destin->setImageUrl ($path);
                 echo "File Successfully Uploaded";
            //Create new image model that holds all the info that the database will need
            $img=new Image();
            $img->setDestId($_POST['destinationID']);
            $img->setUserId($user->getUserID());
            $img->setRelUrl($path);
            $img->setTitle($_POST["fileTitle"]);
            $img->setDescription("test descr");
            //tries to add image to the database
            try{
                MediaController::addImage($img);
            }
            catch(ReviewException $e){
                echo $e;
                exit;
            }
        }
       }
     }
     //this whole if block almost the same as the image block except the file types are different
     //to upload videos, which also means the video functions are used instead of the image
     //a a directory is made in videos instead of images, the video model is used
     else if(((strcasecmp($_FILES["file"]["type"],"video/mov")==0)
        || (strcasecmp($_FILES["file"]["type"],"video/wmv")==0)     
        || (strcasecmp($_FILES["file"]["type"],"video/mp4")==0))
        && in_array($extension, $allowedVidExts)
        && $_FILES["file"]["size"]<5242880)
     {
     if ($_FILES["file"]["error"] > 0)
       {
       echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
       }
     else
     {
            $dir = "../media/videos/".$_POST['destinationID'];
            if ( !file_exists($dir) ) {
                mkdir ($dir, 0777);
            }
        $path="../media/videos/".$_POST['destinationID']."/".$videoNum.".".$extension;
        if (file_exists($path))
        {
            echo $_FILES["file"]["name"] . " already exists. ";
        }
       else
       {
            if(move_uploaded_file($_FILES["file"]["tmp_name"],
            $path));
                 echo "File Successfully Uploaded";
            $vid=new Video();
            $vid->setDestId($_POST['destinationID']);
            $vid->setUserId($user->getUserID());
            $vid->setRelUrl($path);
            $vid->setTitle($_POST['fileTitle']);
            $vid->setDescription("test descr");
            try{
                MediaController::addVideo($vid);
            }
            catch(ReviewException $e){
                echo $e;
                exit;
            }
        }
       }
     }
   else
     {
     if(isset($_POST['review']))
        echo " No file uploaded";
     elseif($_FILES["file"]["size"]>5242880)
       echo "File too big";
     else
        echo "Invalid File";
     header('Location: ' . $_SERVER['HTTP_REFERER']."&failed=yes");
     exit;
     }
   }
}


?>