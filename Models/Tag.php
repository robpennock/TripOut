<?php

/**
 * Description of tag
 *
 * @author Jung Hwan Kim
 */
class Tag {
    
    private $destId;
    private $keywordId;
    
    public function setDestId($destId){
        $this->destId = $destId;
    }
    public function setKeywordId($keywordId){
        $this->keywordId = $keywordId;
    }
    
    public function getDestId(){
        return $this->destId;
    }
    public function getKeywordId(){
        return $this->keywordId;
    }
    public function __toString() {
        $s = "";
        $s .= "<table>\n";
        $s .= "<tr><td colspan=2><hr></td></tr>\n";
        foreach (get_class_vars(get_class($this)) as $name => $value) {
            $s .= "<tr><td>$name:</td><td>" . $this->$name . "</td></tr>\n";
        }
        $s .= "<tr><td colspan=2><hr></td></tr>\n";
        $s .= "</table>\n";
        return $s;
    }
    
    //put your code here
}

?>
