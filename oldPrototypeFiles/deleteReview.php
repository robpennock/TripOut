<?php

    require_once("Includes/db.php");
    UserDB::getInstance()->delete_review($_POST["reviewID"]);
    header('Location: editReviewList.php');

?>
