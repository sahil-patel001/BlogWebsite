<?php echo view('templetes/userheader'); ?>
<br>
<br>
<?php $session = session(); ?>
<?php if(isset($_SESSION['err'])){?>
<h5 class="text-success text-center"><?php echo $session->get('err'); ?></h5>
<?php } $session->remove('err'); ?>
<h1 class="text-secondary text-center">Add Post</h1>
<div class="container">
    <hr>
</div>
<br>
<div class="col-lg-6 m-auto">
    <form id="addpost" enctype="multipart/form-data">
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" id="success"
            style="display:none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2" for="title">Title: </label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Blog Title" required>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2" for="img">Images: </label><br>
            <input type="file" accept="image/*" name="img[]" id="img" class="form-control" value="" multiple require>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 pe-3" for="description">Description: </label>
            <small class="form-text text-muted">( Character: Min=30 And Max=100 )</small>
            <textarea type="text" minlength="30" maxlength="1000" rows="10" class="form-control" name="description"
                id="description" required></textarea>
        </div>
        <button type="submit" id='post' class="btn btn-primary">Post</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function() {
    $(document).on('click', '#post', function() {

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('user/save') ?>",
            data: new FormData(document.getElementById("addpost")),
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                swal("Alright!", "You successfully created blog!", "success");
                // var dataResult = JSON.parse(response);
                // if (dataResult.statusCode == 200) {
                //     $('#addpost').find('input').val('');
                //     $('#description').val('');
                //     $("#success").show();
                //     $('#success').html('Message Sent Successfully !');
                // } else if (dataResult.statusCode == 201) {
                //     alert("Error occured !");
                // }
            }
        });
    })
})
</script>
<?php echo view('templetes/footer'); ?>