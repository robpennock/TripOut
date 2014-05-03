<?php

require_once("../dbConnect.php");
require_once '../Models/Review.php';

//
//singleton class
class ReviewDAO {

    //private construct
    private function __construct() {
        
    }

    /**
     * creates a new user account; returns a new user id.
     * @param $user is the new RegisteredUser object
     * @return the $user object with a new user id; return null if failed
     */
    public static function create(Review $rev) {

        $db = dbConnect::getInstance();
        //query
        $q = "INSERT INTO review (user_id, dest_id, rating, "
                . "num_yes_helpful, num_no_helpful, comment, time, title) VALUES ('"
                . $rev->getUserId() . "', '" . $rev->getDestId() . "', '"
                . $rev->getRating() . "', '" . $rev->getNumYesHelpful() . "', '"
                . $rev->getNumNoHelpful() . "', '" . $rev->getComment() . "', '"
                . $rev->getTime() . "', '" . $rev->getTitle() . "')";

        if (!$db->query($q))
            return null;

        return $rev;
    }

    /**  
     * gets the user review for the destination
     */
    public static function getByUserIdAndDestId($uid, $did) {

        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM review WHERE user_id = "
                . $uid . " AND dest_id = " . $did;
        
        $result = $db->query($q);
        
        if(!$arr = mysqli_fetch_array($result))
                return null;

        
        $rev = new Review();
        $rev->setComment($arr["comment"]);
        $rev->setDestId($arr["dest_id"]);
        $rev->setUserId($arr["user_id"]);
        $rev->setNumNoHelpful($arr["num_no_helpful"]);
        $rev->setNumYesHelpful($arr["num_yes_helpful"]);
        $rev->setRating($arr["rating"]);
        $rev->setTime($arr["time"]);
        $rev->setTitle($arr["title"]);

        return $rev;
    }

    /**
     * gets all the reviews for the destination
     */
    public static function getByDestId($id) {

        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM review WHERE dest_id = " . $id;

        if (!$result = $db->query($q))
            return null;

        $revs = array();

        while ($row = mysqli_fetch_array($result)) {
            $rev = new Review();
            $rev->setComment($row["comment"]);
            $rev->setDestId($row["dest_id"]);
            $rev->setUserId($row["user_id"]);
            $rev->setNumNoHelpful($row["num_no_helpful"]);
            $rev->setNumYesHelpful($row["num_yes_helpful"]);
            $rev->setRating($row["rating"]);
            $rev->setTime($row["time"]);
            $rev->setTitle($row["title"]);
            $revs[] = $rev;
        }

        return $revs;
    }

    public static function update(Review $rev) {

        $db = dbConnect::getInstance();
        //query
        $q = "UPDATE review SET  rating = '" . $rev->getRating() . "', num_yes_helpful = '" . $rev->getNumYesHelpful()
                . "', num_no_helpful = '" . $rev->getNumNoHelpful() . "', comment = '" . $rev->getComment()
                . "', time = '" . $rev->getTime() . "' WHERE user_id = " . $rev->getUserID() . " AND dest_id = " . $rev->getDestId();

        if (!$db->query($q))
            return null;

        return $rev;
    }

    public static function delete(Review $rev) {

        $db = dbConnect::getInstance();

        $q = "DELETE FROM review WHERE dest_id = " . $rev->getDestId()
                . " AND user_id = " . $rev->getUserId();

        if ($db->query($q))
            return true;
        else
            return false;
    }

}

?>
