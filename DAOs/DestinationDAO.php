<?php
//
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of destinationDAO
 *
 * @author Deon
 */
require_once("../dbConnect.php");
require_once '../Models/Destination.php';

//singleton class
class DestinationDAO {

    //private construct
    private function __construct() {
        
    }

    /**
     * creates a new user account; returns a new user id.
     * @param $user is the new RegisteredUser object
     * @return the $user object with a new user id; return null if failed
     */
    public static function create(Destination $dest) {

        $db = dbConnect::getInstance();
        //query
        $q = "INSERT INTO destination (type, name, address, "
                . "avg_rating, num_images, num_videos, description, image_url, num_reviews, "
                . "city, state, zip_code, website, phone_number) VALUES ('"
                . $dest->getType() . "', '" . $dest->getName() . "', '"
                . $dest->getAddress() . "', '" . $dest->getAvgRating() . "', '"
                . $dest->getNumImages() . "', '" . $dest->getNumVideos() . "', '"
                . $dest->getDescription() . "', '" . $dest->getImageUrl() . "', '"
                . $dest->getNumReviews() . "', '".$dest->getCity() . "', '" 
                . $dest->getState() . "', '" . $dest->getZipCode() . "', '"
                . $dest->getWebsite() . "', '" . $dest->getPhoneNumber() . "')";

        if (!$db->query($q)) return null;
        $dest->setDestId($db->insert_id);

        return $dest;
    }

    /**
     * searches the registered_user table by id
     * @param $id the user id
     * @return a RegisteredUser object if found; else return null
     */
    public static function getByID($id) {

        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM destination WHERE dest_id =" . $id;

        if (!$result = $db->query($q)) return null;
        
        $arr = mysqli_fetch_array($result);
        $dest = new Destination();
        $dest->setDestId($arr["dest_id"]);
        $dest->setType($arr["type"]);
        $dest->setName($arr["name"]);
        $dest->setAddress($arr["address"]);
        $dest->setAvgRating($arr["avg_rating"]);
        $dest->setNumImages($arr["num_images"]);
        $dest->setNumVideos($arr["num_videos"]);
        $dest->setDescription($arr["description"]);
        $dest->setImageUrl($arr["image_url"]);
        $dest->setNumReviews($arr["num_reviews"]);
        $dest->setCity($arr["city"]);
        $dest->setState($arr["state"]);
        $dest->setZipCode($arr["zip_code"]);
        $dest->setWebsite($arr["website"]);
        $dest->setPhoneNumber($arr["phone_number"]);
        
        return $dest;
    }
    
    public static function getByName($name) {

        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM destination WHERE name = '" . $name . "'";

        $result = $db->query($q);
        
        if (!($arr = mysqli_fetch_array($result))) return null;
        
        $dest = new Destination();
        $dest->setDestId($arr["dest_id"]);
        $dest->setType($arr["type"]);
        $dest->setName($arr["name"]);
        $dest->setAddress($arr["address"]);
        $dest->setAvgRating($arr["avg_rating"]);
        $dest->setNumImages($arr["num_images"]);
        $dest->setNumVideos($arr["num_videos"]);
        $dest->setDescription($arr["description"]);
        $dest->setImageUrl($arr["image_url"]);
        $dest->setNumReviews($arr["num_reviews"]);
        $dest->setCity($arr["city"]);
        $dest->setState($arr["state"]);
        $dest->setZipCode($arr["zip_code"]);
        $dest->setWebsite($arr["website"]);
        $dest->setPhoneNumber($arr["phone_number"]);
        
        return $dest;
    }
    
    public static function update(Destination $dest){

        $db = dbConnect::getInstance();
        //query
        $q = "UPDATE destination SET  type = '" . $dest->getType() . "', name = '" . $dest->getName() 
            . "', address = '" . $dest->getAddress() . "', avg_rating = '" . $dest->getAvgRating()
                . "', num_images = '" . $dest->getNumImages() . "', num_videos = '" . $dest->getNumVideos()
                . "', description = '" . $dest->getDescription() . "', num_reviews = '" . $dest->getNumReviews()
                . "', image_url = '" . $dest->getImageUrl() . "', city = '" . $dest->getCity()
                . "', state = '" . $dest->getState() . "', zip_code = '" . $dest->getZipCode()
                . "', website = '" . $dest->getWebsite() . "', phone_number = '" . $dest->getPhoneNumber()
                . "' WHERE dest_id = " . $dest->getDestId() . "";

        if(!$db->query($q)) return null;

        return $dest;
    }
    
    public static function delete($id) {
        
        $db = dbConnect::getInstance();
        
        $q = "DELETE FROM destination WHERE dest_id = " . $id;
        
        if ($db->query($q))
            return true;
        else
            return false;
    }
    
    
    /**
     * searches the destination table by id and updates 'num_reviews'
     * @param Destination object
     * @return true if succesful; else return false
     */
    public static function updateNumReviews(Destination $dest){

        $db = dbConnect::getInstance();
        //query
        $q = "UPDATE destination SET num_reviews = '" . $dest->getNumReviews()
                . "' WHERE dest_id = " . $dest->getDestId() . "";

        if(!$db->query($q)) return false;

        return true;
    }
    
    /**
     * searches the destination table by id and updates 'avg_rating'
     * @param Destination object
     * @return true if succesful; else return false
     */
    public static function updateAvgRating(Destination $dest){

        $db = dbConnect::getInstance();
        //query
        $q = "UPDATE destination SET avg_rating = '" . $dest->getAvgRating()
                . "' WHERE dest_id = " . $dest->getDestId() . "";

        if(!$db->query($q)) return false;

        return true;
    }
    
    /**
     * searches the destination table by id and updates 'num_images'
     * @param Destination object
     * @return true if succesful; else return false
     */
    public static function updateNumImages(Destination $dest){

        $db = dbConnect::getInstance();
        //query
        $q = "UPDATE destination SET num_images = '" . $dest->getNumImages()
                . "' WHERE dest_id = " . $dest->getDestId() . "";

        if(!$db->query($q)) return false;

        return true;
    }
    
    /**
     * searches the destination table by id and updates 'num_videos'
     * @param Destination object
     * @return true if succesful; else return false
     */
    public static function updateNumVideos(Destination $dest){

        $db = dbConnect::getInstance();
        //query
        $q = "UPDATE destination SET num_videos = '" . $dest->getNumVideos()
                . "' WHERE dest_id = " . $dest->getDestId() . "";

        if(!$db->query($q)) return false;

        return true;
    }
    
    public static function updateImageUrl(Destination $dest){

        $db = dbConnect::getInstance();
        //query
        $q = "UPDATE destination SET image_url = '" . $dest->getImageUrl()
                . "' WHERE dest_id = " . $dest->getDestId() . "";

        if(!$db->query($q)) return false;

        return true;
    }
}

?>
