<?php

require_once '../Controllers/SearchController.php';
$search = new Search("los gatos", 4);
$result = $search->run();

foreach($result as $dest){
    echo $dest . "<br>";
}

//foreach($result as $dest): ?>

<div>
    <p>//<?php 
//    if($dest->getName())
//        echo $dest->getName(); ?></p>
    
</div>

<?php //endforeach; ?>