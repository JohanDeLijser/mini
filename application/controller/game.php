<?php

class Game extends Controller
{
    //init varibles for calculating distance
    public $measure_unit  = 'kilometers';
    public $measure_state = false;
    public $measure       = 0;

    /*public function __construct()
    {
        parent::__construct();

        Auth::handleLogin();
    }*/
    /**
     * PAGE: index
     * This method handles showing the image upload form
     */
    public function index()
    {
        $this->model = $this->loadModel('Game');
        $this->view->game = $this->model->getRandomPhoto();
        $this->view->render('game/index');
    }

    public function result()
    {
        $markerlat = $_POST['inputLat'];
        $markerlon = $_POST['inputLng'];

        $this->model = $this->loadModel('Game');
        $this->view->game = $this->model->getPhotoLatlng($_POST['id']);

        $photolat = $this->view->game->latitude;
        $photolon = $this->view->game->longitude;

        $distance           = $this->model->getDistance($markerlat, $markerlon, $photolat, $photolon);
        $this->view->points = $this->model->getPoints($distance);

        $this->view->positions = array($markerlat, $markerlon, $photolat, $photolon);

        $this->view->render('game/result');
    }

}