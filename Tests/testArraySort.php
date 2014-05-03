<?php

$destIds = array();
$destinations = array();
$test = array(1, 4, 3, 4, 1, 2, 1, 4, 6, 7, 6, 7, 4, 4, 7);
$destIds = array_merge($destIds, $test);

$destIds = array_count_values($destIds);
foreach($destIds as $id => $count){
    echo "Dest ". $id . " appears ". $count . " times. <br>";
}
        
//sort in descending value
echo "<br> After Sorting <br>";
//array_flip($destIds);
arsort($destIds);

foreach($destIds as $id => $count){
    echo "Dest ". $id . " appears ". $count . " times. <br>";
}

foreach($destIds as $id => $count){
    $destinations[] = $id;
}

echo "<br> After saving to new array <br>";

foreach($destinations as $id){
    echo "Destination ". $id . "<br>";
}

?>


