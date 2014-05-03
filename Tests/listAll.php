<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->

<?php require_once("../dbConnect.php"); 

 require_once '../DAOs/DestinationDAO.php';
 require_once '../DAOs/RegisteredUserDAO.php';

?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel ="stylesheet" type ="text/css" href ="../css/bootstrap.css">
        <link rel ="stylesheet" type ="text/css" href ="../css/custom.css">
        <title></title>
    </head>
    <body padding-left="30px">
        
        <!-- Registered Users CRUD Table -->
        <h2>Users</h2>
        <table class="table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users = dbConnect::getInstance()->query("SELECT * FROM registered_user");
                while($row = mysqli_fetch_array($users)):
                    echo "<tr><td>".$row['user_name']."</td>";
                    echo "<td>". $row['email'] . "</td>";
                    $id = $row['user_id'];
                ?>
                
                <td>
                    <form name="editUser" action="editUser.php" method="GET">
                        <input type="hidden" name="userID" value="<?php echo $id; ?>">
                        <input type="submit" name="editUser" value="Edit">
                    </form>
                </td>
                
                <td>
                    <form name="deleteUser" action="deleteUser.php" method="POST">
                        <input type="hidden" name="userId" value="<?php echo $id; ?>">
                        <input type="submit" name="editUser" value="Delete">
                    </form>
                </td>
                <?php 
                echo "</tr>";
                endwhile; ?>
            </tbody>
        </table>
        
        <form name="createUser" action="createUser.php" method="GET">
                <input class ="btn-primary" type="submit" value="Add User"/>
            </form>
        
        <!-- Reviews CRUD Table -->
        <h2>Reviews</h2>
        <table class="table-bordered">
            <thead>
                <tr>
                    <th>Destination</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>User Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $reviews = dbConnect::getInstance()->query("SELECT * FROM review");
                while($row = mysqli_fetch_array($reviews)):
                    $dest = DestinationDAO::getByID($row['dest_id']);
                    $user = RegisteredUserDAO::getByID($row['user_id']);
                    echo "<tr><td>".$dest->getName()."</td>";
                    echo "<td>". $row['rating'] . "</td>";
                    echo "<td>". $row['comment'] . "</td>";
                    echo "<td>". $user->getUserName() . "</td>";
                    $userId = $row['user_id'];
                    $destId = $row['dest_id'];
                ?>
                
                <td>
                    <form name="editReview" action="editReview.php" method="GET">
                        <input type="hidden" name="reviewId" value="<?php echo $id; ?>">
                        <input type="submit" name="editReivew" value="Edit">
                    </form>
                </td>
                
                <td>
                    <form name="deleteReview" action="deleteReview.php" method="POST">
                        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                        <input type="hidden" name="destId" value="<?php echo $destId; ?>">
                        <input type="submit" name="deleteReview" value="Delete">
                    </form>
                </td>
                <?php 
                echo "</tr>";
                endwhile; ?>
            </tbody>
        </table>
        
        <form name="createReview" action="createReview.php" method="GET">
                <input class ="btn-primary" type="submit" value="Write Review"/>
            </form>
    </body>
</html>
