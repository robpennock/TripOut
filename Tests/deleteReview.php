<?php

require_once("../DAOs/ReviewDAO.php");
require_once '../Models/Review.php';

$review = new Review();
$review->setDestId($_POST['destId']);
$review->setUserId($_POST['userId']);
$result = ReviewDAO::delete($review);
if($result == false)
    echo "Failed to delete review " . $review;
else
    header('Location: listAll.php');

?>

