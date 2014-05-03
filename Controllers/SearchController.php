<?php

require_once '../Models/Destination.php';
require_once '../DAOs/DestinationDAO.php';
require_once '../Models/Keyword.php';
require_once '../DAOs/KeywordDAO.php';
require_once '../DAOs/TagDAO.php';
require_once '../Models/Tag.php';


class Search {
    
    private $searchString;
    private $destType;
    
    public function __construct($string, $type) {
        $this->searchString = $string;
        $this->destType = $type;
    }
    
    //Returns an array of sorted destination objects sorted by relevence.
    //If nothing found, returns an empty array.
    public function run(){
        
        //initialize array of destination ids
        $destinationIds = array();
        
        //initialize array of destination instances
        $destinations = array();
        
        //save each word of stringSearch into an array as lowercase word
        $keyWords = explode(" ", strtolower($this->searchString));
        
        foreach($keyWords as $word){
            
            //fin the keyword ID associated with the word
            $key = KeywordDAO::getByWord($word);
            
            // get array of destination ids associated with the keyword ID
            $tags = TagDAO::getByKeywordID($key->getKeywordId());
            $ids = array();
            if($tags){
                foreach($tags as $tag){
                    $ids[] = $tag->getDestId();
                }
            }
            
            // merge with existing array of ids
            $destinationIds = array_merge($destinationIds, $ids); 
        }
        
        //count duplicate dest_ids, and consolidate
        $destinationIds = array_count_values($destinationIds);
        
        //sort in descending value by most occurences
        arsort($destinationIds);
        
        //lookup destinations by id and save object to array
        foreach($destinationIds as $destId => $count){
            $destObject = DestinationDAO::getByID($destId);
            if($destObject != null){
                if($this->destType == 0 || $destObject->getType() == $this->destType)
                    $destinations[] = $destObject;
            }
        }
        
        return $destinations;
    }
    
}

?>
