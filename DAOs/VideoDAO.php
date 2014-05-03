<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VideoDAO
 *
 * @author Jung Hwan Kim
 */
require_once("../dbConnect.php");
require_once '../Models/Video.php';

class VideoDAO {

    /**
     * creates a new user account; returns a new user id.
     * @param $user is the new image object
     * @return the $video object with a new user id; return null if failed
     */
    public static function create(Video $video) {
        $db = dbConnect::getInstance();
        $q = "INSERT INTO video (user_id, dest_id, rel_url, "
                . "title, description, upload_time) VALUES ('"
                . $video->getUserId() . "', '" . $video->getDestId() . "', '"
                . $video->getRelUrl() . "', '" . $video->getTitle() . "', '"
                . $video->getDescription() . "', '" . $video->getUploadTime() . "')";


        if (!$db->query($q))
            return null;
       

        return $video;
    }
    /**
     * searches the registered_user table by id
     * @param $id the user id
     * @return a Video object if found; else return null
     */
    public static function getByDestId($integer) {
        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM video WHERE dest_id =" . $integer;

        if (!$result = $db->query($q))
            return null;

        $videos = array();
        while ($arr = mysqli_fetch_array($result)) {
            $video = new Image();
            $video->setUserId($arr["user_id"]);
            $video->setDestId($arr["dest_id"]);
            $video->setRelUrl($arr["rel_url"]);
            $video->setTitle($arr["title"]);
            $video->setDescription($arr["description"]);
            $video->setUploadTime($arr["upload_time"]);
            $videos[] = $video;
        }

        return $videos;
    }
    
     public static function delete(Video $vid) {

        $db = dbConnect::getInstance();

        $q = "DELETE FROM review WHERE dest_id = " . $vid->getDestId()
                . " AND user_id = " . $vid->getUserId();

        if ($db->query($q))
            return true;
        else
            return false;
    }

}

?>
