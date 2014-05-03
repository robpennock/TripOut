<script src=".../js/script.js"></script>
 <div class="container">
     <div class="row">
         <div class="span5">
                <h3>Sign In</h3>
                <p>
                <form name="logon" action="index.php" method="POST" >
                    Username: <input type="text" name="user"><br>
                    Password  <input type="password" name="userpassword"><br>
                    <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
                            if (!$logonSuccess)
                            echo "Invalid name and/or password";
                        }
                    ?>
                    <input class="btn btn-default" type="submit" id="editButton" value="Sign In">
                </form>
                </p>
         </div>
         <div class ="span5">
                <h3>Haven't Tripped Out?</h3>
                <p><button type ="button" class="btn btn-primary" id="registerButton">Register Now!</p>
         </div>
     </div>
</div>
       

