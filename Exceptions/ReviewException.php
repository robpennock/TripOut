<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WrongUsernameException
 *
 * @author deon
 */
class ReviewException extends Exception {

    // custom string representation of object
    public function __toString() {
        return "<b style='color:red'> Review Error: </b>";
    }

}

?>
