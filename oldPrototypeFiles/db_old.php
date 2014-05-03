<?php

class UserDB extends mysqli {

    // single instance of self shared among all instances
    private static $instance = null;
    private $user = "f13g05";
    private $pass = "pewpew13";
    private $dbName = "student_f13g05";
    private $dbHost = "sfsuswe.com";
  
    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    // private constructor
    private function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }

    public function get_user_id_by_name($name) {
        $name = $this->real_escape_string($name);
        $user = $this->query("SELECT user_id FROM registered_user WHERE user_name = '"
                        . $name . "'");

        if ($user->num_rows > 0){
            $row = $user->fetch_row();
            return $row[0];
        } else
            return null;
    }
    
    /* TODO: GET REVIEW BY USER ID*/
    public function get_reviews_by_user_id($userID) {
        return $this->query("SELECT review_id, comment, dest_id FROM review WHERE user_id=" . $userID);
    }
    
    
    public function create_user($name, $password) {
        $name = $this->real_escape_string($name);
        $password = $this->real_escape_string($password);
        $this->query("INSERT INTO registered_user (user_name, password) VALUES ('" . $name
                . "', '" . $password . "')");
    }

    public function verify_user_credentials($name, $password) {
        $name = $this->real_escape_string($name);
        $password = $this->real_escape_string($password);
        $result = $this->query("SELECT 1 FROM registered_user WHERE user_name = '"
                        . $name . "' AND password = '" . $password . "'");
        return $result->data_seek(0);
    }

    function insert_review($userID, $comment, $destinationID){
        $comment = $this->real_escape_string($comment);
        $destinationID = $this->real_escape_string($destinationID);
        //$destinationID = $this->real_escape_string($destinationID);
        $this->query("INSERT INTO review (user_id, comment, dest_id)" .
                " VALUES (" . $userID . ", '" . $comment . "', '" . $destinationID . "')");
    } 
    
    public function update_review($reviewID, $comment, $destinationID) {
        $comment = $this->real_escape_string($comment);
        $this->query("UPDATE review SET comment = '" . $comment . "', dest_id= " . $destinationID . " WHERE review_id = ". $reviewID); 
    }    
    public function get_review_by_review_id($reviewID) {
        return $this->query("SELECT review_id, user_id, comment, dest_id FROM review WHERE review_id = " . $reviewID);
    }
    
    public function delete_review($reviewID) {
        $this->query("DELETE FROM review WHERE review_id = " . $reviewID);
    }
}

?>