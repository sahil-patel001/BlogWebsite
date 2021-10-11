<?php echo view('templetes/userheader'); ?>
<br>
<br>
<h1 class="text-secondary text-center">Add Post</h1>
<div class="container">
    <hr>
</div>
<br>
<div class="col-lg-6 m-auto">
    <form id="addpost" enctype='multipart/form-data'>
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
<script>
$(document).ready(function() {
    $(document).on('click', '#post', function() {
        var form_data = new FormData();

        // Read selected files
        var totalfiles = document.getElementById('img').files.length;
        for (var index = 0; index < totalfiles; index++) {
            form_data.append("img[]", document.getElementById('img').files[index]);
        }

        var data = {
            'title': $('#title').val(),
            'img': $('#img').val(),
            'description': $('#description').val(),
        }
        $.ajax({
            method: "POST",
            url: "<?php echo base_url('user/save') ?>",
            contentType: "multipart/form-data",
            data: data,
            success: function(response) {
                $('#addpost').val('');
            }
        });
    })
})
</script>
<?php echo view('templetes/footer'); ?>