<div class="container">
    <div class="login-default-box">
        <h1>Upload photo</h1>
        <form action="<?php echo URL; ?>photos/addPhoto" method="post" enctype="multipart/form-data">
            <label>Select file to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" required />
            <input type="submit" class="login-submit-button" value="Upload Image" name="submit" />
        </form>
	        <?php foreach ($this->photos as $photo) { ?>
				<img src="../images/<?php echo $photo->filename?>" style="width:304px; display:block;">
				<a href="<?php echo URL . 'photos/deletePhoto/' . htmlspecialchars($photo->id, ENT_QUOTES, 'UTF-8'); ?>">delete</a>
			<?php } ?> 
    </div>
</div>
