<!-- author: robin pennock -->

<?php
    require_once("../Controllers/DestinationController.php");
    require_once("../Models/Destination.php");
    require_once("../Controllers/AccountController.php");
    require_once("../Models/RegisteredUser.php");
    require_once("../Session/Session.php");
    
    $s = Session::getInstance();
    $s->start();
    
    function do_alert($msg) 
    {   echo
        "<script type=\"text/javascript\">".
        "alert('$msg');".
        "top.location = 'signIn.php';".
        "</script>"; 
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['InputUsername'];
        $password = $_POST['InputPassword'];
        //reverse logifc for isUsernameValid: see AccountController
        //check if user exists
        try{
            $result = AccountController::login($username, $password);
            echo "<script type=\"text/javascript\"> parent.$.fancybox.close();</script>";
            //('Location: ../index.php');
            exit;
         }
         //error logging in or missmatched username and password fields
        catch(LoginException $e){
            //echo $e;
            $msg = "Login failed. Check username or password.";
            do_alert($msg);
            setcookie("error", $msg);
            header("Location: ". $_SERVER['REQUEST_URI']);
        }
        
        catch(AccountException $e){ 
            //echo $e . $e;
        }
    }?>

<!DOCTYPE html>
<html>
    <head>
        <!--<link rel ="stylesheet" type ="text/css" href ="../css/bootstrap.css"> -->
        <link rel ="stylesheet" type ="text/css" href ="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap-responsive.css">
        <script src="../js/bootstrap.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/jquery.js"></script>
        <link rel ="stylesheet" type ="text/css" href ="../css/custom">
        <!-- Add jQuery library -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="../js/signin.js"></script>
        <title>Sign In</title>
    </head>
    <body>
        <div class ="container">
                <div class="span5">
                    
                   <?php 
                        
                        if(array_key_exists('loggedin', $_GET) && array_key_exists('message', $_GET)){
                            if($_GET['message'] == 'review'){
                                echo '<font color= "red" >' . 'Please sign in to write a review.' .  '</font>';
                            }elseif($_GET['message'] == 'createDestination'){
                                echo '<font color= "red" >' . 'Please sign in to create a destination.' .  '</font>';
                            }elseif($_GET['message'] == 'upload'){
                                echo '<font color= "red" >' . 'Please sign in to upload media.' .  '</font>';
                            }
                            
                        }
                    ?>
                    <h3>Sign In</h3>
                 
                    </p>
                    <form role="form" name="logon" id="logon" action="signIn.php" method="POST" >
                    <div class="form-group">
                      <label for="name">Username</label>
                      <input type="text" class="form-control" name="InputUsername" id="inputUsername" required>
                    </div>
                    <div class="form-group">
                      <label for="pw">Password</label>
                      <input type="password" class="form-control" name="InputPassword" id="InputPassword" required>
                    </div>
                    </div>
                    <button id="submit_sign_in" class="btn btn-primary" type="submit" value="Sign In">Submit</button>
                    <div class ="pull-right">
                    Haven't Tripped Out? <a href ="/signUp.php" id="signUpLink">Sign Up Now</a>
                    </div>
                  </form>
                </div>
            </div>
        </div>
        <script>
            $('#signUpLink').on("click", function(){
                event.preventDefault();
                var pathname = window.location.pathname;
                pathname = pathname.replace("signIn.php", "signUp.php");
                parent.window.location.href = pathname;
            })
            
    
                //event.preventDefault();
                //var pathname = 'test';
                //window.history.go(-1);
                 //pathname = pathname.replace("signIn.php", "signUp.php");
                //parent.window.location.href = pathname;
            
        </script>
    </body>
</html>