<?php

require_once '../Controllers/ReviewController.php';
require_once '../Models/Destination.php';
require_once '../Models/Review.php';


$reviews = array();

$dest = new Destination();
$dest->setDestId(24);

if(!$reviews = ReviewController::getDestinationReviews($dest)){
    echo "ERROR <br>";
}

foreach($reviews as $rev){
    echo $rev;
}

echo DestinationController::getById(24);

?>
