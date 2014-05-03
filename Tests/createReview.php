<?php
    require_once("../Controllers/ReviewController.php");
    require_once("../Models/Review.php");
    require_once '../DAOs/RegisteredUserDAO.php';
    require_once '../DAOs/DestinationDAO.php';
    require_once '../Exceptions/ReviewException.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $review = new Review();
        $userId = RegisteredUserDAO::getByUsername($_POST['user'])->getUserID();
        $review->setUserId($userId);
        $review->setRating($_POST['rating']);
        $review->setComment($_POST['comment']);
        $destId = DestinationDAO::getByName($_POST['destination'])->getDestId();
        $review->setDestId($destId);
        
        try{
            $result = ReviewController::add($review);
         }
        catch(Exception $e){
            echo $e . $e->getMessage();
            exit;
        }
        header('Location: listAll.php');
        exit;
    }?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap.css">
        <link rel ="stylesheet" type ="text/css" href ="../css/custom.css">
        <title></title>
    </head>
    <body padding-left="3px">
        
        <form action="createReview.php" method="POST" id="createNewUser">
            Destination: <input type="text" name="destination"/><br/><br>
            Rating: <input type="number" min="1" max="5" name="rating"/><br/><br>
            Comment: <input type="text" name="comment"/><br><br>
            User: <input type="text" name="user"/><br><br>
            <input class ="btn btn-primary" type="submit"/>
    </body>
</html>
