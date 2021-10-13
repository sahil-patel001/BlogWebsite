<?php echo view('templetes/userheader'); ?>
<br>
<br>
<?php $session = session(); ?>
<?php if(isset($session)){?>
<h5 class="text-success text-center"><?php echo $session->get('deleteImg'); ?></h5>
<?php } $session->remove('deleteImg'); ?>
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
                <div class="d-flex border rounded border-dark mb-3 p-2 me-2" style="width: fit-content">
                    <div><?php echo $dataImg['img']; ?></div>
                    <a href="<?php echo base_url('user/deleteImage?id='.$dataImg['img_id'].'&bid='.$data['bid']) ?>"
                        class="btn-sm btn-primary ms-3"><i class="bi bi-x"></i></a>
                </div>
                <?php } ?>
            </div>
            <?php //$imgURL = base_url('./upload').'/'.$data['img']; ?>
            <!-- <img src="<?php //echo $imgURL ?>" class="mb-2" style="width: 100px; height: 100px; objectfit: cover;"> -->
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
<br>
<?php echo view('templetes/footer'); ?>