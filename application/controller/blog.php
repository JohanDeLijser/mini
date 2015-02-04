<?php

class blog extends Controller
{
    
    public function index()
    {
    	$this->model = $this->loadModel('blog');
    	$this->view->post = $this->model->getPosts();
        $this->view->render('blog/index');
    }

   
    public function addPost()
    {
        $this->model = $this->loadModel('blog');

        if (isset($_POST["submit_add_post"])) {
            $this->model->addPost($_POST["post"], $_POST["name"]);
        }

        header('location: ' . URL . 'blog/index');
    }

   
    public function deletePost($post_id)
    {
         $this->model = $this->loadModel('blog');

        if (isset($post_id)) {
            $this->model->deletePost($post_id);
        }
        
        header('location: ' . URL . 'blog/index');
    }

    
    public function editPost($post_id)
    {
         $this->model = $this->loadModel('blog');

        if (isset($post_id)) {
            $this->view->blog = $this->model->getPost($post_id);
            $this->view->render('blog/edit');

        } 
        else {
    
            header('location: ' . URL . 'blog/index');
        }
    }

    
    public function updatePost()
    {
        $this->model = $this->loadModel('blog');
       
        if (isset($_POST["submit_update_post"])) {
           
            $this->model->updatePost($_POST["post"], $_POST['post_id']);
        }

        header('location: ' . URL . 'blog/index');
    }


}
  