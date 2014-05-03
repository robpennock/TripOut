<?php

require_once '../Session/Session.php';
require_once '../Models/RegisteredUser.php';
require_once '../Controllers/AccountController.php';

$s = Session::getInstance();
$s->start();

//$user = new RegisteredUser();
//$user->setUserName("deon");
//$user->setPassword("pass");

//AccountController::register($user);


echo "<br>" . "<br>";
echo "Before Login: " . "<br>";
echo "isLogin = " . $s->isLogin . "<br>";
echo "username = " . $s->username . "<br>";
echo "passwrd = " . $s->password . "<br>";

echo "Is Login? ------- " . AccountController::isLogin() . "<br>";

echo "<br>" . "<br>";

//AccountController::logout();
try{
    echo AccountController::login("mike", "hell");
}
catch(LogicException $e){
    echo "bad login credentials";
    exit;
}

catch(AccountException $e){
    echo "account exception";
    exit;
}

echo "<br>" . "<br>";
echo "After Login: " . "<br>";
echo "isLogin = " . $s->isLogin . "<br>";
echo "username = " . $s->username . "<br>";
echo "passwrd = " . $s->password . "<br>";

echo "Is Login? ------- " . AccountController::isLogin() . "<br>";

//AccountController::logout();

echo "<br>" . "<br>";
echo "After Logout: " . "<br>";
echo "isLogin = " . $s->isLogin . "<br>";
echo "username = " . $s->username . "<br>";
echo "passwrd = " . $s->password . "<br>";

echo "Is Login? ------- " . AccountController::isLogin() . "<br>";

echo "<br>" . "<br>";
echo "Get Loggedin User: " . "<br>";
echo AccountController::getLoggedinUser();
?>