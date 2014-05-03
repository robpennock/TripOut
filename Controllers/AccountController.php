<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of accountManager
 *
 * @author deon
 */

require_once(dirname(__FILE__). "/../DAOs/RegisteredUserDAO.php");
require_once(dirname(__FILE__). "/../Exceptions/UsernameException.php");
require_once(dirname(__FILE__). "/../Exceptions/LoginException.php");
require_once(dirname(__FILE__). "/../Session/Session.php");

class AccountController {
    //private construct
    private function __construct() {
        
    }

    /**
     * logs in a user; updates the login time
     * @param $username the login username
     * @param $password the login password
     * @throws LoginException if username password pair not found
     * @return the RegisteredUser object if success
     */
    public static function login($username, $password) {

        //checks if the username and password pair exists
        if (($user = RegisteredUserDAO::getByUsernameAndPassword($username, $password) ) == null)
            throw new LoginException();

        //update the login time into the database
        $user->setLastLoginTime(date('Y-m-d H:i:s'));
        
        //saves user login info to SESSION
        $s = Session::getInstance();
        $s->isLogin = TRUE;
        $s->username = $username;
        $s->password = $password;
        
        return RegisteredUserDAO::update($user);
    }

    public static function logout() {
        
        $s = Session::getInstance();
        $s->isLogin = FALSE;
    }

    /**
     * adds a new user to the database
     * @param $user the RegisteredUser object
     * @throws UsernameException if username exists
     * @return the RegisteredUser object if success
     */
    public static function register(RegisteredUser $user) {

        //checks if username already taken
        if ((RegisteredUserDAO::getByUsername($user->getUserName())) != null)
            throw new UsernameException();

        //save the registration time and create the user
        //$currentDate = date('Y-m-d H:i:s');
        $user->setRegTime(date('Y-m-d H:i:s'));
        return RegisteredUserDAO::create($user);
    }
    
    public static function isLogin() {
        $s = Session::getInstance();
        if (isset($s->isLogin))
            return $s->isLogin;
        else
            return false;
    }
    
    /**
     * checks if username is not used; username has to be unique
     * @param $username the new username
     * @return true if not taken; else false
     */
    public static function isUsernameValid($username) {

        if (RegisteredUserDAO::getByUsername($username))
            return false; //username taken
        else
            return true; //useranme is not used
    }
    
    /**
     * checks if password is valid; currently requires at least 4 characters
     * @param $password the new password
     * @return true if success; else false
     */
    public static function isPasswordValid($password) {

        if (strlen($password) < 4) //at least 4 characters for now
            return false;
        else
            return true;
    }
    
    /*
     * gets the loggedin user object
     * 
     * @return RegisteredUser object if success; otherwise returns null.
     */
    public static function getLoggedinUser() {
        $s = Session::getInstance();
        if (self::isLogin() == TRUE) {
            return RegisteredUserDAO::getByUsername($s->username);
        }
        return null;
    }
    
    public static function delete(RegisteredUser $user){
        
        return RegisteredUserDAO::delete($user->getUserID());
    }

}

?>
