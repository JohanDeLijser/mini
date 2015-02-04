<div class="container">
   
    <div class="box">
        <h3>Add a post</h3>
        <form action="<?php echo URL; ?>blog/addpost" method="POST">
            <label>Name</label>
            <input type="text" name="name" value="" required />
            <label>Post</label>
            <input type="text" name="post" value="" required />
            <input type="submit" name="submit_add_post" value="Submit" />
        </form>
    </div>

    	<h2>Blog Posts</h2>
    <?php foreach ($this->photos as $posts) { ?>
	    <div class="box"> 
	    		<h2><?php echo $posts->name ?></h2>  	
		    	<p><?php echo $posts->post ?></p> 
		    	<a href="<?php echo URL . 'blog/deletepost/' . htmlspecialchars($posts->id, ENT_QUOTES, 'UTF-8'); ?>">delete</a>
		    	<a href="<?php echo URL . 'blog/editpost/' . htmlspecialchars($posts->id, ENT_QUOTES, 'UTF-8'); ?>">edit</a>	
	  	</div>  
  	<?php } ?>
</div>


