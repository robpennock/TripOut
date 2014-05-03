<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel ="stylesheet" type ="text/css" href ="css/bootstrap.min.css">
        <title>Vertical Prototype</title>
    </head>
    <body>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <div class ="container">
            <h3>Search Results for <?php echo htmlentities($_GET['tag']); ?>:</h3>
                 <?php
                    //require_once("Includes/db.php");
                    //TODO write city_search db class
                    //local db
                    $con = mysqli_connect("127.0.0.1", "root", "DiamondIce");
                    //remote db
                    //$con = mysqli_connect("sfsuswe.com", "f13g05", "pewpew13");
                    //remote personal db
                    //$con = mysqli_connect("sfsuswe.com", "mdiamo", "DiamondIce");

                    if(!$con){
                        exit('Connect Error(' . mysqli_connect_errno() . ')'. mysqli_connect_errno());
                    }
                    //default client character set
                    mysqli_set_charset($con, 'utf-8');
                    
                    //local db
                    mysqli_select_db($con, "mydb");
                    //remote db
                    //mysqli_select_db($con, "student_f13g05");
                    //remote personal db
                    //mysqli_select_db($con, "student_mdiamo");


                    $tag = mysqli_real_escape_string($con, htmlentities($_GET['tag']));
                    echo $tag;
                    $tags = mysqli_query($con, "SELECT * FROM tag WHERE keyword = '$tag'");
                    $numTags = mysqli_num_rows($tags);
                    echo "<br>number of relevant tags: " . $numTags;
                    if ($numTags < 1) {
                        exit("The search returned no results. Please check the spelling and try again");
                    }
                    for ($i = 1; $i <= $numTags; $i++) {
                        $tagRow = mysqli_fetch_array($tags);
                        $destID = $tagRow['dest_id'];
                        $photo_result = mysqli_query($con, "SELECT rel_url FROM photo WHERE dest_id= '$destID'");
                        $photo_row = mysqli_fetch_array($photo_result);

                        //echo "destination id: " . htmlentities($tagRow['dest_id']);
                        $result = mysqli_query($con, "SELECT name, address, city FROM destination WHERE dest_id= '$destID'");
                        $resultRow = mysqli_fetch_array($result);
                        echo "<p><strong>Destination: </strong>" . htmlentities($resultRow['name']) ."<br>";
                        echo "<p><strong>Address: </strong>" . htmlentities($resultRow['address']) ."<br>";
                        echo "<p><strong>City: </strong>" . htmlentities($resultRow['city']) ."<br>";
                        echo "<img src = '".htmlentities($photo_row["rel_url"]) . "'></img><hr>";
                    }
                        mysqli_free_result($tags);
                ?>

                <?php
                /*
                    $result = mysqli_query($con, "SELECT city FROM destination WHERE dest_id= '$dest'");
                    $row = mysqli_fetch_array($result);    
                    echo htmlentities($row["city"]) . " destinations: <br/><hr/>";

                    mysqli_free_result($result);
                    $result = mysqli_query($con, "SELECT name, address FROM destination WHERE dest_id= '$dest'");
                    $photo_result = mysqli_query($con, "SELECT rel_url FROM photo WHERE dest_id= '$dest'");
                    $photo_row = mysqli_fetch_array($photo_result);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<strong>name:</strong>" . htmlentities($row["name"]) . "<br/>";
                        echo "<strong>address:</strong>" .htmlentities($row["address"]) . "<br/>";
                        echo "<img src = '".htmlentities($photo_row["rel_url"]) . "'></img>";
                        
                    }*/
                    mysqli_close($con);
                ?> 
        </div>
    </body>
</html>
