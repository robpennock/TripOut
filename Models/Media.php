<?php

/**
 * Description of media
 *
 * @author Jung Hwan Kim
 */
class Media {
    private $userId;
    private $destId;
    private $relUrl;
    private $title;
    private $description;
    private $uploadTime;
    
    public function setUserId($userId){
        $this->userId = $userId;
    }
    public function setDestId($destId){
        $this->destId = $destId;
    }
    public function setRelUrl($relUrl){
        $this->relUrl = $relUrl;
    }
    public function setTitle($title){
        $this->title  = $title;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setUploadTime($uploadTime){
        $this->uploadTime = $uploadTime;
    }
    
    public function getUserId(){
        return $this->userId;
    }
    public function getDestId(){
        return $this->destId;
    }
    public function getRelUrl(){
        return $this->relUrl;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getDescription(){
        return$this->description;
    }
    public function getUploadTime(){
        return $this->uploadTime;
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
