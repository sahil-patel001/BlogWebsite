<?php echo view('templetes/userheader'); ?>
<br>
<br>
<?php $session = session(); ?>
<?php if(isset($_SESSION['deleteImg'])){?>
<h5 class="text-success text-center"><?php echo $session->get('deleteImg'); ?></h5>
<?php } $session->remove('deleteImg'); ?>
<?php if(isset($_SESSION['error'])){?>
<h5 class="text-success text-center"><?php echo $session->get('error'); ?></h5>
<?php } $session->remove('error'); ?>
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
            <div class="d-flex">
                <?php foreach($img as $dataImg) { ?>
                <div class="p-2 me-2" style="position: relative;">
                    <?php $imgURL = base_url('./upload').'/'.$dataImg['img']; ?>
                    <img src="<?php echo $imgURL ?>" class="mb-2"
                        style="width: 100px; height: 100px; objectfit: cover;">
                    <a style="position: absolute; top: 8px; right: 8px; z-index: 100;"
                        href="<?php echo base_url('user/deleteImage?id='.$dataImg['img_id'].'&bid='.$data['bid']) ?>"><button
                            onClick="return confirm('Are you sure?')" type="button"><i class="bi bi-x"></i></button></a>
                </div>
                <?php } ?>
            </div>
            <input type="file" accept="image/*" name="img[]" class="form-control" value="" multiple>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 pe-3" for="description">Description: </label>
            <small class="form-text text-muted">( Character: Min=30 And Max=1000 )</small>
            <textarea type="text" minlength="30" maxlength="1000" rows="10" class="form-control" name="description"
                id="description" required><?php echo $data['b_description'] ?></textarea>
        </div>

        <button type="submit" name="update" class="btn btn-primary mb-3">Update</button>
        <div class="col-12">
            <a href="<?php echo base_url('user/poststatus') ?>" class="btn btn-primary"><i
                    class="bi bi-arrow-left-circle-fill"></i></a>
        </div>
    </form>
    <?php } ?>
</div>
<br>
<?php echo view('templetes/footer'); ?>