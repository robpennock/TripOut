<?php

/**
 * Description of tagDAO
 *
 * @author deon
 */
require_once("../dbConnect.php");
require_once '../Models/Tag.php';

class TagDAO {

    //private construct
    private function __construct() {
        
    }

    /**
     * creates a new user account; returns a new user id.
     * @param $user is the new RegisteredUser object
     * @return the $user object with a new user id; return null if failed
     */
    public static function create(Tag $tag) {

        $db = dbConnect::getInstance();
        //query
        $q = "INSERT INTO tag (dest_id, keyword_id) VALUES ('"
                . $tag->getDestId() . "', '" . $tag->getKeywordId() . "')";

        if (!$db->query($q)) return null;

        return $tag;
    }

    /**
     * searches the registered_user table by id
     * @param $id the user id
     * @return a RegisteredUser object if found; else return null
     */
    public static function getByKeywordID($id) {

        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM tag WHERE keyword_id =" . $id;

        if (!$result = $db->query($q)) return null;
        
        $tags = array();
        
        while($row = mysqli_fetch_array($result)){
            $tag = new Tag();
            $tag->setDestId($row["dest_id"]);
            $tag->setKeywordId($row["keyword_id"]);
            $tags[] = $tag;
        }
        
        return $tags;
    }
    
    //Checks if an entry with a given keyword_id and dest_id already exists
    public static function doesExist(Tag $tag){
        $db = dbConnect::getInstance();
        $q = "SELECT * FROM tag WHERE keyword_id = '" . $tag->getKeywordId()
                . "' AND dest_id = '" . $tag->getDestId() . "'";
        
        $result = $db->query($q);
        
        if(!mysqli_fetch_array($result))
            return false;
        else
            return true;
        
    }
    
    public static function delete(Tag $tag) {

        $db = dbConnect::getInstance();

        $q = "DELETE FROM tag WHERE dest_id = " . $tag->getDestId()
                . " AND keyword_id = " . $tag->getKeywordId();

        if ($db->query($q))
            return true;
        else
            return false;
    }
}
