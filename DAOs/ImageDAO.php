<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImageDAO
 *
 * @author Jung Hwan Kim
 */
require_once("../dbConnect.php");
require_once '../Models/Image.php';

class ImageDAO {
    
    private function __construct(){
    }

    /**
     * creates a new user account; returns a new user id.
     * @param $user is the new image object
     * @return the $image object with a new user id; return null if failed
     */
    public static function create(Image $image) {
        $db = dbConnect::getInstance();
        $q = "INSERT INTO image (user_id, dest_id, rel_url, "
                . "title, description, upload_time) VALUES ('"
                . $image->getUserId() . "', '" . $image->getDestId() . "', '"
                . $image->getRelUrl() . "', '" . $image->getTitle() . "', '"
                . $image->getDescription() . "', '" . $image->getUploadTime() . "')";


        if (!$db->query($q))
            return null;
       

        return $image;
    }

    /**
     * searches the registered_user table by id
     * @param $id the user id
     * @return a Image object if found; else return null
     */
    public static function getByDestId($integer) {
        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM image WHERE dest_id =" . $integer;

        if (!$result = $db->query($q))
            return null;
        $images = array();
        while($arr = mysqli_fetch_array($result)) {
            $image = new Image();
            $image->setUserId($arr["user_id"]);
            $image->setDestId($arr["dest_id"]);
            $image->setRelUrl($arr["rel_url"]);
            $image->setTitle($arr["title"]);
            $image->setDescription($arr["description"]);
            $image->setUploadTime($arr["upload_time"]);
            $images[] = $image;
        }

        return $images;
    }
    
     public static function delete(Image $img) {

        $db = dbConnect::getInstance();

        $q = "DELETE FROM image WHERE dest_id = " . $img->getDestId()
                . " AND user_id = " . $img->getUserId();

        if ($db->query($q))
            return $img;
        else
            return false;
    }

}

?>
