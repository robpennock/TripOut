<?php
//
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of keywordDAO
 *
 * @author deon
 */
require_once("../dbConnect.php");

class KeywordDAO {

    //private construct
    private function __construct() {
        
    }

    /**
     * creates a new user account; returns a new user id.
     * @param $user is the new RegisteredUser object
     * @return the $user object with a new user id; return null if failed
     */
    public static function create($word) {

        $db = dbConnect::getInstance();
        //query
        $q = "INSERT INTO keyword (word) VALUES ('"
                . $word . "')";
                
        if (!($db->query($q))) return null;
        
        $key = new Keyword();
        $key->setWord($word);
        $key->setKeywordId($db->insert_id);

        return $key;
    }

    /**
     * searches the registered_user table by id
     * @param $id the user id
     * @return a RegisteredUser object if found; else return null
     */
    public static function getByID($id) {

        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM keyword WHERE keyword_id =" . $id;

        if (!$result = $db->query($q)) return null;
        
        $arr = mysqli_fetch_array($result);
        $key = new Keyword();
        $key->setKeywordId($arr["keyword_id"]);
        $key->setWord($arr["word"]);
        
        return $key;
    }
    
    public static function getByWord($word) {

        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM keyword WHERE word = '" . $word . "'";

        if (!$result = $db->query($q)) return null;
        
        $arr = mysqli_fetch_array($result);
        $key = new Keyword();
        $key->setKeywordId($arr["keyword_id"]);
        $key->setWord($arr["word"]);
        
        return $key;
    }
    
    public static function update(Keyword $key){

        $db = dbConnect::getInstance();
        //query
        $q = "UPDATE keyword SET word = '" . $key->getWord() . "' WHERE keyword_id = " . $key->getKeywordId() . "";

        if(!$db->query($q)) return null;

        return $key;
    }
    
    public static function delete($id) {
        
        $db = dbConnect::getInstance();
        
        $q = "DELETE FROM keyword WHERE keyword_id = " . $id;
        
        if ($db->query($q))
            return true;
        else
            return false;
    }
}
