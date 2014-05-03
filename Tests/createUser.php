<?php
    require_once("../Controllers/AccountController.php");
    require_once("../Models/RegisteredUser.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = new RegisteredUser();
        $user->setUserName($_POST['userName']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setNumReviews(0);
        
        try{
            $result = AccountController::register($user);
         }
        catch(UsernameException $e){
            echo $e;
            exit;
        }
        header('Location: listAll.php');
        exit;
    }?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap.css">
        <link rel ="stylesheet" type ="text/css" href ="../css/custom.css">
        <title></title>
    </head>
    <body padding-left="3px">
        
        <form action="createUser.php" method="POST" id="createNewUser">
            Your name: <input type="text" name="userName"/><br/><br>
            Password: <input type="password" name="password"/><br/><br>
            Email: <input type="text" name="email"/><br><br>
            <input class ="btn btn-primary" type="submit"/>
    </body>
</html>
