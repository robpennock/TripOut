
<?php require_once("../DAOs/testDAO.php"); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $destination = testDAO::getDestinationsById(1);
        print $destination['name'] . "<br>";
        print $destination['address'] . "<br>";
        print $destination['city'] . "<br>";
        ?>
    </body>
</html>
