<?php

class PhotosModel
{

    //This method is not working yet. But you will need to write it.
    public function getAllPhotos()
    {
        $sql = "SELECT * FROM photos";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

        public function deletePhoto($photo_id)
    {
        $sql = "DELETE FROM photos WHERE id = :photo_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':photo_id' => $photo_id);

        $query->execute($parameters);
    }

    public function uploadPhoto()
    {
        $filename = $_FILES["fileToUpload"];
        $target_file = "images/" . basename($_FILES["fileToUpload"]["name"]);

        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check == false) {
                //File is not an image, return false (todo: return an error message)
                return false;
            }
        }

        $exif =  read_exif_data($_FILES["fileToUpload"]["tmp_name"]);

        if (empty($exif['GPSLatitudeRef'])) {     
            return false;
        } else {
            $latitude = $this->gps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
            $longitude = $this->gps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
        } 

        // Check if file already exists
        if (file_exists($target_file)) {
            //File already exists, return false (todo: return an error message)
            return false;
        }
        // Check file size
        if ($filename["size"] > 50000000) {
            //File is to big, return false (todo: return an error message)
            return false;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            //File doesnt have proper extension, return false (todo: return an error message) 
            return false;
        }
        
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //File was succesfully uploaded, return true
            $sql = "INSERT INTO photos (filename, longitude, latitude) VALUES (:filename, :longitude, :latitude)";
            $query = $this->db->prepare($sql);
            $parameters = array(':filename' => $_FILES["fileToUpload"]["name"], ':longitude' => $longitude, ':latitude' => $latitude);
            $query->execute($parameters);

            return true;
        } else {
            //File wasnt uploaded, return false (todo: return an error message)
            return false;
        }
        
    }

    private function gps($coordinate, $hemisphere) {
      for ($i = 0; $i < 3; $i++) {
        $part = explode('/', $coordinate[$i]);
        if (count($part) == 1) {
          $coordinate[$i] = $part[0];
        } else if (count($part) == 2) {
          $coordinate[$i] = floatval($part[0])/floatval($part[1]);
        } else {
          $coordinate[$i] = 0;
        }
      }
      list($degrees, $minutes, $seconds) = $coordinate;
      $sign = ($hemisphere == 'W' || $hemisphere == 'S') ? -1 : 1;
      return $sign * ($degrees + $minutes/60 + $seconds/3600);
    } 
}
