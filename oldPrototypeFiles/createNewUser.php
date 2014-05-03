<?php
    require_once("Includes/db.php");
    
    /** other variables */
    $userNameIsUnique = true;
    $passwordIsValid = true;				
    $userIsEmpty = false;					
    $passwordIsEmpty = false;				
    $password2IsEmpty = false;	
    
    /** Check that the page was requested from itself via the POST method. */
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /** Check whether the user has filled in the wisher's name in the text field "user" */    
        if ($_POST["user"]=="") {
            $userIsEmpty = true;
        }

        $userID = UserDB::getInstance()->get_user_id_by_name($_POST["user"]);
        if ($userID) {
           $userNameIsUnique = false;
        }
        if ($_POST["password"]=="") {
            $passwordIsEmpty = true;
        }
        if ($_POST["password2"]=="") {
            $password2IsEmpty = true;
        }
        if ($_POST["password"]!=$_POST["password2"]) {
            $passwordIsValid = false;
        }
        
        if (!$userIsEmpty && $userNameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid) {
            UserDB::getInstance()->create_user($_POST['user'], $_POST['password']);
           
            session_start();
            $_SESSION['user'] = $_POST['user'];
           
            header('Location: editReviewList.php' );
            exit;
        }
    } 
?>

        <script src="js/script.js"></script>
        <h3>Register to Trip Out:</h3>
        <form action="createNewUser.php" method="POST" id="createNewUser">
            Your name: <input type="text" name="user"/><br/>
            <?php
                if ($userIsEmpty) {
                    echo ("Enter your name, please!");
                    echo ("<br/>");
                }                
                if (!$userNameIsUnique) {
                    echo ("The person already exists. Please check the spelling and try again");
                    echo ("<br/>");
                }
            ?> 
            Password: <input type="password" name="password"/><br/>
            <?php
                if ($passwordIsEmpty) {
                    echo ("Enter the password, please!");
                    echo ("<br/>");
                }                
            ?>
            Please confirm your password: <input type="password" name="password2"/><br/>
            <?php
                if ($password2IsEmpty) {
                    echo ("Confirm your password, please");
                    echo ("<br/>");    
                }                
                if (!$password2IsEmpty && !$passwordIsValid) {
                    echo  ("The passwords do not match!");
                    echo ("<br/>");  
                }                 
            ?>
            <input class ="btn btn-primary" type="submit" id="register" value="Register"/>
        </form>
