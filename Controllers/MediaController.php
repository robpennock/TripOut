<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mediaController
 * This file user shall control the media such as video or image
 * add video, add image, delte video, delte video depending on destination.
 * 
 * @author Jung Hwan Kim
 */
require_once '../Models/Image.php';
require_once '../Models/Video.php';
require_once '../DAOs/ImageDAO.php';
require_once '../DAOs/VideoDAO.php';
require_once '../Controllers/DestinationController.php';


class MediaController {

    private function __construct() {
        
    }

/************************************************************************/
// methods for image
    public static function addImage(Image $img) {

//        if (ImageDAO::getByDestId($img->getDestId()))
//            throw new ImageException("Image already exists <br>"); //review exists
        //save the image time
        $img->setUploadTime(date("Y-m-d H:i:s"));

        if (!$img = ImageDAO::create($img))
            throw new ImageException("Image could not be added to database");

        $dest = DestinationController::getById($img->getDestId());
        //increment num of destination
        $dest = DestinationController::incrementNumImages($dest);

        return $img;
    }
    
    
    public static function getDestinationImages(Destination $dest) {

        return ImageDAO::getByDestId($dest->getDestId());
    }

    public static function deleteImage(Image $img) {

        if (!$img = ImageDAO::delete($img))
            return $img;

        $dest = DestinationController::getById($img->getDestId());
    
        return $img;
    }
      
    /************************************************************************/
    // methods for video
    public static function addVideo(Video $vid) {

//        if (VideoDAO::getByDestId($vid->getDestId()))
//            throw new VideoException("The Video already exists <br>"); //review exists
        //save the video time
        $vid->setUploadTime(date("Y-m-d H:i:s"));

        if (!$vid = VideoDAO::create($vid))
            throw new VideoException("Review could not be added to database");

        $dest = DestinationController::getById($vid->getDestId());
        //increment number of video at the destination
        $dest = DestinationController::incrementNumVideos($dest);

        return $vid;
    }

    public static function getDestinationVideos(Destination $dest) {

        return VideoDAO::getByDestId($dest->getDestId());
    }

    public static function deleteVideo(Video $vid) {

        if (!$vid = VideoDAO::delete($vid))
            return $vid;

        $dest = DestinationController::getById($vid->getDestId());
        $dest = DestinationController::incrementNumVideos($dest);
        

        return $vid;
    }

}
?>
