<?php

require_once(dirname(__FILE__). "/../dbConnect.php");
require_once dirname(__FILE__). '/../Models/RegisteredUser.php';

//
//singleton class  
class RegisteredUserDAO {

    //private construct
    private function __construct() {
        
    }

    /**
     * creates a new user account; returns a new user id.
     * @param $user is the new RegisteredUser object
     * @return the $user object with a new user id; return null if failed
     */
    public static function create(RegisteredUser $user) {

        $db = dbConnect::getInstance();
        //query
        $q = "INSERT INTO registered_user (user_name, password, reg_time, "
                . "last_login_time, email, num_reviews) VALUES ('"
                . $user->getUserName() . "', '" . $user->getPassword() . "', '"
                . $user->getRegTime() . "', '" . $user->getLastLoginTime() . "', '"
                . $user->getEmail() . "', '" . $user->getNumReviews() . "')";

        if (!$db->query($q))
            return null;
        $user->setUserID($db->insert_id);

        return $user;
    }

    /**
     * searches the registered_user table by id
     * @param $id the user id
     * @return a RegisteredUser object if found; else return null
     */
    public static function getByID($id) {

        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM registered_user WHERE user_id =" . $id;

        if (!$result = $db->query($q))
            return null;

        $arr = mysqli_fetch_array($result);
        $ru = new RegisteredUser();
        $ru->setUserID($arr["user_id"]);
        $ru->setUserName($arr["user_name"]);
        $ru->setPassword($arr["password"]);
        $ru->setRegTime($arr["reg_time"]);
        $ru->setLastLoginTime($arr["last_login_time"]);
        $ru->setEmail($arr["email"]);
        $ru->setNumReviews($arr["num_reviews"]);

        return $ru;
    }

    /**
     * searches the registered_user table by username; userful for retrieving password
     * @param $username is the username for the user account
     * @return a RegisteredUser object if found; else return null
     */
    public static function getByUsername($username) {

        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM registered_user WHERE user_name = '" . $username . "'";

        $result = $db->query($q);

        if (!($arr = mysqli_fetch_array($result)))
            return null;

        $ru = new RegisteredUser();
        $ru->setUserID($arr["user_id"]);
        $ru->setUserName($arr["user_name"]);
        $ru->setPassword($arr["password"]);
        $ru->setRegTime($arr["reg_time"]);
        $ru->setLastLoginTime($arr["last_login_time"]);
        $ru->setEmail($arr["email"]);
        $ru->setNumReviews($arr["num_reviews"]);

        return $ru;
    }

    /**
     * searches the registered_user table by email; userful for retrieving password
     * @param $email is the email for the user account
     * @return a RegisteredUser object if found; else return null
     */
    public static function getByEmail($email) {

        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM registered_user WHERE email =" . $email;

        if (!$result = $db->query($q))
            return null;

        $arr = mysqli_fetch_array($result);
        $ru = new RegisteredUser();
        $ru->setUserID($arr["user_id"]);
        $ru->setUserName($arr["user_name"]);
        $ru->setPassword($arr["password"]);
        $ru->setRegTime($arr["reg_time"]);
        $ru->setLastLoginTime($arr["last_login_time"]);
        $ru->setEmail($arr["email"]);
        $ru->setNumReviews($arr["num_reviews"]);

        return $ru;
    }

    /**
     * searches the registered_user table by email; userful for retrieving password
     * @param $email is the email for the user account
     * @return a RegisteredUser object if found; else return null
     */
    public static function getByUsernameAndPassword($username, $password) {

        $db = dbConnect::getInstance();
        //query
        $q = "SELECT * FROM registered_user WHERE user_name = '" . $username . "' AND password = '" . $password . "'";

        if (!$result = $db->query($q))
            return null;

        if (!($arr = mysqli_fetch_array($result)))
                return null;
        
        $ru = new RegisteredUser();
        $ru->setUserID($arr["user_id"]);
        $ru->setUserName($arr["user_name"]);
        $ru->setPassword($arr["password"]);
        $ru->setRegTime($arr["reg_time"]);
        $ru->setLastLoginTime($arr["last_login_time"]);
        $ru->setEmail($arr["email"]);
        $ru->setNumReviews($arr["num_reviews"]);

        return $ru;
    }

    public static function update(RegisteredUser $user) {

        $db = dbConnect::getInstance();
        //query
        $q = "UPDATE registered_user SET  user_name = '" . $user->getUserName() . "', password = '" . $user->getPassword()
                . "', reg_time = '" . $user->getRegTime() . "', last_login_time = '" . $user->getLastLoginTime()
                . "', email = '" . $user->getEmail() . "', num_reviews = '" . $user->getNumReviews()
                . "' WHERE user_id = " . $user->getUserID() . "";

        if (!$db->query($q))
            return null;

        return $user;
    }

    public static function delete($id) {

        $db = dbConnect::getInstance();

        $q = "DELETE FROM registered_user WHERE user_id = " . $id;

        if ($db->query($q))
            return true;
        else
            return false;
    }

}

?>
