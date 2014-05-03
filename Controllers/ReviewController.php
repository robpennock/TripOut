<?php

require_once("../DAOs/ReviewDAO.php");
require_once '../Exceptions/ReviewException.php';
require_once '../Controllers/DestinationController.php';

class ReviewController {

    //private construct

    private function __construct() { 
        
    }

    /**
     * adds a review to the database; currently only one review per destinatin is allowed
     * increments number of reviews for destination and updates average rating for destination
     * @param $rev the Review object
     * @throws ReviewException if review already exists, or rating is missing
     * @return the review object if success
     */
    public static function add(Review $rev) {
        
        if (ReviewDAO::getByUserIdAndDestId($rev->getUserId(), $rev->getDestId()))
            throw new ReviewException("Review already exists <br>"); //review exists
        
        if (!$rev->getRating())
            throw new ReviewException("Missing rating <br>");
       
        //save the review time
        $rev->setTime(date("Y-m-d H:i:s"));
        
        if (!$rev = ReviewDAO::create($rev))
            throw new ReviewException("Review could not be added to database");
        
        $dest = DestinationController::getById($rev->getDestId());
        //increment numReviews of destination
        $dest = DestinationController::incrementNumReviews($dest);
        //calculate and update avg_rating of destination
        DestinationController::calcAvgRating($dest);
        
        return $rev;
    }
    
    /**
     * retrieves all reviews for a given destination
     * @param $dest the Destination object
     * @return array of Review objects if success. Empty array or null upon failure.
     */
    public static function getDestinationReviews(Destination $dest) {

        return ReviewDAO::getByDestId($dest->getDestId());
    }
    
    public static function delete(Review $rev){
        
        if(!$rev = ReviewDAO::delete($rev))
                return $rev;
        
        $dest = DestinationController::getById($rev->getDestId());
        
        //calculate and update average rating of destination
        DestinationController::calcAvgRating($dest);
        
        return $rev;
    }

}

?>
