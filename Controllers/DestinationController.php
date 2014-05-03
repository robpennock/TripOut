<?php
/**
 * Description of DestinationController
 *
 * @author michael
 */
require_once '../DAOs/DestinationDAO.php';
require_once '../Models/Destination.php';
require_once '../Controllers/KeywordController.php';
require_once '../Controllers/ReviewController.php';
require_once '../Exceptions/DestinationException.php';

class DestinationController{
    
    //Parameter: a destination object
    //This class adds the given destination to the database.
    //Then calls a function to generate keywords for given destination
    private function __construct(){}
    
    public static function create(Destination $dest){
        
        //if certian fields are missing, throw exception
        if( !$dest->getName() || !$dest->getCity()
                || !$dest->getAddress() || !$dest->getState() || !$dest->getType())
            
            throw new DestinationException("Missing Name, Address, City, or State");
        
        // set rating, numReviews, numImages, numVideos to zero
        $dest->setAvgRating(0);
        $dest->setNumReviews(0);
        $dest->setNumImages(0);
        $dest->setNumVideos(0);
        
        // create destination in database, get newly created object back with new ID
        $dest = DestinationDAO::create($dest);
        
        // Pass destination to keyword controller to create keywords
        KeywordController::createFromDestination($dest);
        
        return $dest;
    }
    
    /**
     * 
     * @param int $id
     * @return Destination object for given $id
     */
    public static function getById($id){
        
        return DestinationDAO::getByID($id);
    }
    
    /**
     * increments number of reviews
     * @param Destination object
     * @throws DestinationException if update to database fails
     * @return Destination object with updated numReviews
     */
    public static function incrementNumReviews(Destination $dest){
        
        $num = $dest->getNumReviews();
        $num++;
        $dest->setNumReviews($num);
        
        if(!DestinationDAO::updateNumReviews($dest))
            throw new DestinationException("Could not update numReviews <br>");
        
        return $dest;   
    }
    
    /**
     * calculates avgRating of destination and updates value in database
     * @param Destination object
     * @throws DestinationException if update to database fails
     * @return Destination object with updated avgRating
     */
    public static function calcAvgRating(Destination $dest){
        
        $reviews = array();
        $reviews = ReviewController::getDestinationReviews($dest);
        
        $sum = 0;
        $count = 0;
        foreach($reviews as $rev){
            $sum += $rev->getRating();
            $count++;
        }
        $avg = $sum/$count;
        $dest->setAvgRating($avg);
        
        if(!DestinationDAO::updateAvgRating($dest))
            throw new DestinationException("Could not update avgRating");
         
        return $dest;
           
    }
    
    public static function incrementNumImages(Destination $dest ){
        $num = $dest->getNumImages();
        $num++;
        $dest->setNumImages($num);
        
        if(!DestinationDAO::updateNumImages($dest))
            throw new ImageException("Could not update numImages <br>");
        
        return $dest;
    }
    
    public static function decrementNumImage(Destination $dest){
        $num = $dest->getNumImages();
        $num--;
        $dest->setNumImages($num);
        
        if(!DestinationDAO::updateNumImages($dest))
           throw new ImageException("Could not update numVideos <br>");
        
        return $dest;
    }
    
    public static function incrementNumVideos(Destination $dest ){
        $num = $dest->getNumVideos();
        $num++;
        $dest->setNumVideos($num);
        
        if(!DestinationDAO::updateNumVideos($dest))
            throw new VideoException("Could not update numVideos <br>");
        
        return $dest;
    }
    // decrement number of video for each destination if video is deleted 
    public static function decrementNumVideo(Destination $dest){
        $num = $dest->getNumVideos();
        $num--;
        $dest->setNumVideos($num);
        
        if(!DestinationDAO::updateNumVideos($dest))
           throw new VideoException("Could not update numVideos <br>");
        
        return $dest;
    }
    
    public static function updateImageUrl($dest){
        DestinationDAO::updateImageUrl($dest);
    }
}

?>
