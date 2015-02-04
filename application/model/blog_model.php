<?php

	class BlogModel
	{
		public function getPosts()
		{
			$sql = "SELECT id, post, name FROM blog";
			
			$query = $this->db->prepare($sql);
        	$query->execute();

        	return $query->fetchAll();
		}

		public function addPost($post, $name)
   		{
	        $sql = "INSERT INTO blog (post, name) VALUES (:post, :name)";
	        $query = $this->db->prepare($sql);
	        $parameters = array(':post' => $post, ':name' => $name);

	        $query->execute($parameters);
    	}

    	public function deletePost($post_id)
    	{
	        $sql = "DELETE FROM blog WHERE id = :post_id";
	        $query = $this->db->prepare($sql);
	        $parameters = array(':post_id' => $post_id);

	        $query->execute($parameters);
    	}

    	public function getPost($post_id)
    	{
	        $sql = "SELECT id, post FROM blog WHERE id = :post_id LIMIT 1";
	        $query = $this->db->prepare($sql);
	        $parameters = array(':post_id' => $post_id);

	        $query->execute($parameters);

	        return $query->fetch();
    	}

    	public function updatePost($post, $post_id)
    	{
	        $sql = "UPDATE blog SET post = :post WHERE id = :post_id";
	        $query = $this->db->prepare($sql);
	        $parameters = array(':post' => $post, ':post_id' => $post_id);

	        $query->execute($parameters);
    	}


	}