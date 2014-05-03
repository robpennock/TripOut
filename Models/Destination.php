<?php

/**
 * Description of destination
 *
 * @author Jung Hwan Kim
 */
class Destination {
    
    private $destId;
    private $type;
    private $name;
    private $address;
    private $avgRating;
    private $numImage;
    private $numVideo;
    private $description;
    private $imageUrl;
    private $numReviews;
    private $city;
    private $state;
    private $zipCode;
    private $website;
    private $phoneNumber;
    
    public function setDestId($destId){
        $this->destId = $destId;
        
    }
    
    public function setType($type){
        $this->type = $type;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setAddress($address){
        $this->address = $address;
    }
    public function setAvgRating($avgRating){
        $this ->avgRating = $avgRating;
    }
    public function setNumImages($numImage){
        $this->numImage = $numImage;
        
    }
    public function setNumVideos($numVideo){
        $this->numVideo = $numVideo;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setImageUrl($imageUrl){
        $this->imageUrl = $imageUrl;
    }
    public function setNumReviews($numReviews){
        $this->numReviews = $numReviews;
    }
    public function setCity($city){
        $this->city= $city;
    }
    public function setState($state){
        $this->state = $state;
    }
    public function setZipCode($zipCode){
        $this->zipCode = $zipCode;
    }
    public function setWebsite($website){
        $this->website = $website;
    }
    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
    }
    
    
    
    
    public function getDestId(){
        return $this->destId;
    }
    public function getType(){
        return $this->type;
    }
    public function getName(){
        return $this->name;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getAvgRating(){
        return $this->avgRating;
    }
    public function getNumImages(){
        return $this->numImage;
    }
    public function getNumVideos(){
        return $this->numVideo;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getImageUrl(){
        return $this->imageUrl;
    }
    public function getNumReviews(){
        return $this->numReviews;
    }
    public function getCity(){
        return $this->city;
    }
    public function getState(){
        return $this->state;
    }
    public function getZipCode(){
        return $this->zipCode;
    }
    public function getWebsite(){
        return $this->website;
    }
    public function getPhoneNumber(){
        return $this->phoneNumber;
    }
    //put your code here
    
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
