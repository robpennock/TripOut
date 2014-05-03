<?php
session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
        <script src="../js/script.js"></script>
        <div class="container">
            <?php
            echo "<h3>Hello " . $_SESSION['user'] . "</h3>";
            ?>

            <table class="std" border ="black" width="100%">
                <tr>
                    <th>Destination ID</th>
                    <th>City</th>
                    <th>Review</th>
                    <th colspan="3">Actions</th>
                </tr>
                <?php
                    require_once("../db.php");

                    $userID = UserDB::getInstance()->get_user_id_by_name($_SESSION['user']);
                    $result = UserDB::getInstance()->get_reviews_by_user_id($userID);
                    while ($row = mysqli_fetch_array($result)):
                        echo "<tr><td>" . htmlentities($row['dest_id']) . "</td>";
                        echo "<td>city</td>"; 
                        echo "<td>" . htmlentities($row['comment']) . "</td>";
                        $reviewID = $row['review_id'];
                        //The loop is left open
                ?>
                <td>
                    <form name="editReview" action="editReview.php" method="GET">
                        <input type ="hidden" name="reviewID" value="<?php echo $reviewID; ?>">
                        <input type="submit" name="editReview" value="Edit"/>
                    </form>
                </td>
                <td>
                    <form name="deleteReview" action="deleteReview.php" method="POST">
                        <input type="hidden" name="reviewID" value="<?php echo $reviewID; ?>"/>
                        <input type="submit" name="deleteReview" value="Delete"/>
                    </form>
                </td>

                <?php
                    echo "</tr>\n";
                    endwhile;
                    mysqli_free_result($result);
                ?>
            </table>

            <form name="addNewWish" action="editReview.php">
                <input class ="btn btn-default" type="submit" value="Add Review"/>
            </form>

            <form name="backToMainPage" action="index.php">
                <input class ="btn btn-default"type="submit" value="Back To Main Page"/>
            </form>
        </div>
