<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author Deon
 */
class Session {

    const STARTED = TRUE;
    const NOT_STARTED = FALSE;

    private static $instance;
    private $state = self::NOT_STARTED; //session state

    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct() {
        
    }

    public function start() {
        if (!isset($_SESSION)) {
            $this->state = session_start();
        }
        return $this->state;
    }

    /*
     *    Stores datas in the session.
     *    Example: $instance->foo = 'bar';
     *    
     *    @param 
     *    @param    value    Your datas.
     *    @return    void
     */

    public function __set($name, $value) {
        $_SESSION[$name] = $value;
    }

    /**
     *    Gets datas from the session.
     *    Example: echo $instance->foo;
     *    
     *    @param    name    Name of the datas to get.
     *    @return    mixed    Datas stored in session.
     * */
    public function __get($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    public function __isset($name) {
        return isset($_SESSION[$name]);
    }

    public function __unset($name) {
        unset($_SESSION[$name]);
    }

    /**
     *    Destroys the current session.
     *    
     *    @return    bool    TRUE is session has been deleted, else FALSE.
     * */
    public function destroy() {
        if ($this->state == self::SESSION_STARTED) {
            $this->state = !session_destroy();
            unset($_SESSION);

            return !$this->state;
        }

        return self::NOT_STARTED;
    }

}
