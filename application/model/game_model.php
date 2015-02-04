<?php

class GameModel
{

    //This method is not working yet. But you will need to write it.
    public function getRandomPhoto()
    {
        $sql = "SELECT * FROM photos ORDER BY RAND() LIMIT 0,1;";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getPhotoLatlng($id)
    {
        $sql = "SELECT * FROM photos WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getPoints($km)
    {
        if ($km >= 0 && $km <= 10) {$points = 100;} 
        else if ($km > 11 && $km <= 20) {$points = 90;} 
        else if ($km > 21 && $km <= 30) {$points = 80;} 
        else if ($km > 31 && $km <= 40) {$points = 70;} 
        else if ($km > 41 && $km <= 50) {$points = 60;} 
        else if ($km > 51 && $km <= 100) {$points = 50;} 
        else if ($km > 101 && $km <= 200) {$points = 40;} 
        else if ($km > 201 && $km <= 300) {$points = 30;} 
        else if ($km > 301 && $km <= 400) {$points = 20;} 
        else if ($km > 401 && $km <= 500) {$points = 10;} 
        else if ($km > 501 && $km <= 600) {$points = 8;} 
        else if ($km > 601 && $km <= 300) {$points = 6;} 
        else if ($km > 701 && $km <= 300) {$points = 4;} 
        else if ($km > 801 && $km <= 300) {$points = 2;} 
        else if ($km > 901 && $km <= 1000) {$points = 1;} 
        else { $points = 0;}

        return $points;
    }

    public function getDistance($markerlat, $markerlon, $photolat, $photolon)
    {
        $delta_lat = $photolat - $markerlat;
        $delta_lon = $photolon - $markerlon;

        $earth_radius = 6372.795477598;

        $alpha    = $delta_lat / 2;
        $beta     = $delta_lon / 2;
        $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($markerlat)) * cos(deg2rad($photolat)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
        $c        = asin(min(1, sqrt($a)));
        $distance = 2 * $earth_radius * $c;
        $distance = round($distance, 4);
        return $distance;
    }

     
}
