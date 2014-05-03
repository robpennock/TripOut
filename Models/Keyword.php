<?php

/**
 * Description of keyword
 *
 * @author Jung Hwan Kim
 */
class Keyword {
    private $keywordId;
    private $word;
    
    public function setKeywordId($keywordId){
        $this->keywordId = $keywordId;
    }
    public function setWord($word){
        $this->word = $word;
    }
    public function getKeywordId(){
        return $this->keywordId;
    }
    public function getWord(){
        return $this->word;
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
}

?>
