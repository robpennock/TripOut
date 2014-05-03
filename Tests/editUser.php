<?php 
require_once("../DAOs/RegisteredUserDAO.php");
require_once("../Models/RegisteredUser.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = RegisteredUserDAO::getByID($_POST['userId']);
    if($user == null){
        echo "error <br>";
        exit;
    }
    $user->setUserName($_POST['name']);
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    
    $user2 = RegisteredUserDAO::update($user);
    if($user2 == null){
        echo "Edit Failed! <br>";
        echo "Name: ". $user->getUserName() . "<br>";
        echo "Email: ". $user->getEmail() . "<br>";
        echo "Password: ". $user->getPassword() . "<br>";
        exit;
    }
    
    header('Location: listAll.php');
}

elseif(array_key_exists('userID', $_GET)){
    $user = RegisteredUserDAO::getByID($_GET['userID']);
    //echo "Name: ". $user->getUserName() . "<br>";
    //echo "Email: ". $user->getEmail() . "<br>";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap.css">
        <link rel ="stylesheet" type ="text/css" href ="../css/custom.css">
        <title></title>
    </head>
    <body>
        <form name="editUser" action="editUser.php" method="POST">
            <input type="hidden" name="userId" value="<?php echo $user->getUserID();?>">
            Name: 
            <input type="text" name="name" value="<?php echo $user->getUserName();?>">
            <br>
            Email:
            <input type="text" name="email" value="<?php echo $user->getEmail();?>">
            <br>
            Password:
            <input type="text" name="password" value="<?php echo $user->getPassword();?>">
            <br>
            <input type="submit" name="save" value="Save Changes">
            <br>
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
