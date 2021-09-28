<?php echo view('templetes/userheader'); ?>
<br>
<br>
<h1 class="text-secondary text-center">Add Post</h1>
<br>
<div class="col-lg-6 m-auto">
    <form action="<?php echo site_url("User/save"); ?>" method="post" enctype='multipart/form-data'>
        <div class="form-group mb-3">
            <label class="mb-2" for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Blog Title" required>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2" for="img">Images: </label><br>
            <input type="file" accept="image/*" name="img[]" class="form-control" value="" multiple require>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 pe-3" for="description">Description: </label>
            <small class="form-text text-muted">( Character: Min=30 And Max=100 )</small>
            <textarea type="text" minlength="30" maxlength="1000" rows="10" class="form-control" name="description"
                id="description" required></textarea>
        </div>
        <button type="submit" name="post" class="btn btn-primary">Post</button>
    </form>
</div>
<?php echo view('templetes/footer'); ?>