<?php

require_once '../DAOs/DestinationDAO.php';
require_once '../Controllers/KeywordController.php';
require_once '../Controllers/DestinationController.php';

//$dest = DestinationDAO::getByID(23);
//KeywordController::createFromDestination($dest);

$dest = new Destination();
$dest->setName("Burger Palace");
$dest->setAddress("321 Hungy Blvd.");
$dest->setAvgRating(0);
$dest->setNumImages(1);
$dest->setNumVideos(0);
$dest->setType(2);
$dest->setDescription("We got dem burgers.");
$dest->setImageUrl("../media/images/hp9.JPG");
$dest->setCity("Reno");
$dest->setState("Nevada");
$dest->setzipCode("9xxxx");
$dest->setnumReviews(0);
$dest->setWebsite("http://burger.com");
$dest->setPhoneNumber("5555555555");
DestinationController::create($dest);



?>
