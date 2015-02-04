<?php

class Photos extends Controller
{

    /*   public function __construct()
    {
        parent::__construct();

        Auth::handleLogin();
    } */
    /**
     * PAGE: index
     * This method handles showing the image upload form
     */
    public function index()
    {
        $this->model = $this->loadModel('Photos');
        $this->view->photos = $this->model->getAllPhotos();
        
        $this->view->render('photos/index');
    }

    public function succes()
    {
        $this->view->render('photos/succes');
    }

    public function fail()
    {
        $this->view->render('photos/fail');
    }

    /**
     * PAGE: upload
     * This method handles the actual file upload
     */
    public function addPhoto()
    {
        //load the photo model to handle upload
        $photos_model = $this->loadModel('Photos');
        //perform the upload method, put result (true or false) in $upload_succesfull
        $upload_succesfull = $photos_model->uploadPhoto();

        if ($upload_succesfull) {
            header('location: ' . URL . 'photos/succes');
        } else {
            header('location: ' . URL . 'photos/fail');
        }
    }


    public function deletePhoto($photo_id)
    {
         $this->model = $this->loadModel('Photos');

        if (isset($photo_id)) {
            $this->model->deletePhoto($photo_id);
        }
        
        header('location: ' . URL . 'photos/index'); 
    } 
       

}

