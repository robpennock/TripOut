<?php

/**
 * Description of KeywordController
 *
 * @author michael
 */
require_once '../DAOs/KeywordDAO.php';
require_once '../Models/Keyword.php';
require_once '../DAOs/TagDAO.php';
require_once '../Models/Tag.php';

class KeywordController {
    
    
    //creates keywords and tags in the database based on given destinations
    public static function createFromDestination(Destination $dest){
        
        //can't create tags without a destination ID
        if(!$dest->getDestId())
            throw new Exception("Can't create keyword without dest_id");
        
        //parse variables with possibly multiple words into arrays of single words. 
        $name = explode(" ", $dest->getName());
        $city = explode(" ", $dest->getCity());
        $state = explode(" ", $dest->getState());
        
        $keywords = array_merge($name, $city, $state);
        
        //create keywords
        foreach($keywords as $word){
            $keyword = KeywordDAO::create($word);
            
            if ($keyword == null){ //keyword already exists
                //get existing keyword
                $keyword = KeywordDAO::getByWord($word);
            }
            
            //construct tag object
            $tag = new Tag();
            $tag->setKeywordId($keyword->getKeywordId());
            $tag->setDestId($dest->getDestId());
            
            //if tag does not already exist
            if(!TagDAO::doesExist($tag))
                //create tag
                $tag = TagDAO::create($tag);   
        }
        
        
    }
}

?>
