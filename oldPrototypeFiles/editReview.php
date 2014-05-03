<?php
    /* * Start session */
    session_start();
    if (!array_key_exists("user", $_SESSION)) {
        header('Location: index.php');
        exit;
    }
    /** Create a new database object */
    require_once("../db.php");

    /** Retrieve the ID of the wisher who is trying to add a wish */
    $userID = UserDB::getInstance()->get_user_id_by_name($_SESSION['user']);
    /** Initialize $wishDescriptionIsEmpty */
    $reviewIsEmpty = false;

    /** Checks that the Request method is POST, which means that the data
     * was submitted from the form for entering the wish data on the editWish.php
     * page itself */
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        /** Checks whether the $_POST array contains an element with the "back" key */
        if (array_key_exists("back", $_POST)) {
            /** The Back to the List key was pressed.
             * Code redirects the user to the editWishList.php */
            header('Location: editReviewList.php');
            exit;
        }
        /** Checks whether the element with the "review" key in the $_POST array is empty,
         * which means that no description was entered.
         */ 
        else if ($_POST['description'] == "") {
            $reviewIsEmpty = true;
        }
        /** The "review" key in the $_POST array is NOT empty, so a description is entered.
         * Adds the review description and destination to the database via UserDB.insert_review
         */ 
        else if ($_POST['reviewID'] == "") {
            UserDB::getInstance()->insert_review($userID, $_POST['description'], $_POST['destID']);
            header('Location: editReviewList.php');
            exit;
        } else if ($_POST['reviewID'] != "") {
            UserDB::getInstance()->update_review($_POST['reviewID'], $_POST['description'], $_POST['destID']);
            header('Location: editReviewList.php');
            exit;
        }
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/bootstrap.css" type="text/css" rel="stylesheet" media="all" />
    </head>
    <body>
        <script src="js/script.js"></script>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST")
                $review = array("review_id" => $_POST['reviewID'],
                    "comment" => $_POST['description'], "dest_id" => $_POST['destID']);
            else if (array_key_exists("reviewID", $_GET)) {
                $review = mysqli_fetch_array(UserDB::getInstance()->get_review_by_review_id($_GET['reviewID']));
                echo "yes reviewID array key exists<br>";
                echo htmlentities($review['review_id']);
            } else
                $review = array("review_id" => "", "comment" => "", "dest_id" => "");
        ?>
        <div class="container">
            <form name="editReview" action="editReview.php" method="POST">
                <input type="hidden" name="reviewID" value="<?php echo $review['review_id']; ?>" />
                <label>Enter destination ID</label>
                <input type="text" name="destID"  value="<?php echo $review['dest_id']; ?>" /><br/>
                <?php
                if ($reviewIsEmpty)
                    echo '<div class="error">Please enter destination</div>';
                ?>
                
                <label>Enter comment:</label>
                <input type="text" name="description"  value="<?php echo $review['comment']; ?>" /><br/>
                <?php
                    if ($reviewIsEmpty)
                        echo '<div class="error">Please enter comment</div>';
                ?>
                <br/>
                <br/>
                <input type="submit" name="saveReview" value="Save Changes"/>
                <input type="submit" name="back" value="Back to the List"/>
            </form>
        </div>
    </body>
</html>
