<?php echo view('templetes/userheader'); ?>
<br>
<br>
<h1 class="text-secondary text-center">Edit Post</h1>
<div class="container">
    <hr>
</div>
<br>
<div class="col-lg-6 m-auto">
    <?php foreach($post as $data) { ?>
    <form action="<?php echo site_url("User/editpost?id=".$data['bid']); ?>" method="post"
        enctype='multipart/form-data'>

        <div class="form-group mb-3">
            <label class="mb-2" for="title">Title</label>
            <input type="text" class="form-control" value="<?php echo $data['b_title'] ?>" name="title" id="title"
                placeholder="Blog Title" required>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2" for="img">Images: </label><br>
            <input type="file" accept="image/*" name="img[]" class="form-control" value="" multiple>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 pe-3" for="description">Description: </label>
            <small class="form-text text-muted">( Character: Min=30 And Max=100 )</small>
            <textarea type="text" minlength="30" maxlength="1000" rows="10" class="form-control" name="description"
                id="description" required><?php echo $data['b_description'] ?></textarea>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>
    <?php } ?>
</div>
<?php echo view('templetes/footer'); ?>