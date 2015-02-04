<div class="container">
    <h2>You are in the View: application/view/blog/edit.php (everything in this box comes from that file)</h2>
    <!-- add song form -->
    <div>
        <h3>Edit a post</h3>
        <form action="<?php echo URL; ?>blog/updatepost" method="POST">
            <label>Post</label>
            <input autofocus type="text" name="post" value="<?php echo htmlspecialchars($this->blog->post, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($this->blog->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="submit" name="submit_update_post" value="Update" />
        </form>
    </div>
</div>

