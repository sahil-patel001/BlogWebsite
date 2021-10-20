<?php echo view('templetes/userheader'); ?>
<br>
<br>
<?php $session=session(); ?>
<?php if(isset($_SESSION['match'])){?>
<h4 class="text-danger text-center"><?php echo $session->get('match');?></h4>
<?php } $session->remove('match'); ?>
<?php if(isset($_SESSION['new'])){?>
<h4 class="text-danger text-center"><?php echo $session->get('new');?></h4>
<?php } $session->remove('new'); ?>
<?php if(isset($_SESSION['error'])){?>
<h4 class="text-danger text-center"><?php echo $session->get('error');?></h4>
<?php } $session->remove('error'); ?>
<?php if(isset($_SESSION['current'])){?>
<h4 class="text-danger text-center"><?php echo $session->get('current');?></h4>
<?php } $session->remove('current'); ?>
<?php if(isset($_SESSION['empty'])){?>
<h4 class="text-danger text-center"><?php echo $session->get('empty');?></h4>
<?php } $session->remove('empty'); ?>
<?php if(isset($_SESSION['change'])){?>
<h4 class="text-success text-center"><?php echo $session->get('change');?></h4>
<?php } $session->remove('change'); ?>

<h1 class="text-secondary text-center">Change Password</h1>
<div class="container">
    <hr>
</div>
<br>
<div class="col-lg-6 m-auto">
    <?php $session = session(); ?>
    <form action="<?php echo site_url("User/changePassword?id=" . $session->get('id')); ?>" method="post" enctype='multipart/form-data'>
        <div class="form-group mb-3">
            <label class="mb-2" for="title">Enter Current Password: </label>
            <input type="password" class="form-control" name="current" id="current" required>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2" for="title">Enter New Password: </label>
            <input type="password" class="form-control" name="new" id="new" required>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2" for="title">Confirm New Password: </label>
            <input type="password" class="form-control" name="confirm" id="confirm" required>
        </div>
        <button type="submit" name="post" class="btn btn-primary">Change Password</button>
    </form>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function() {
    $(document).on('click', '#pwd', function() {
        var data = {
            'current': $('#current').val(),
            'new': $('#new').val(),
            'confirm': $('#confirm').val(),
        }
        $.ajax({
            type: "POST",
            url: "<?php //echo base_url('User/changePassword?id='. $session->get('id')); ?>",
            data: data,
            success: function(response) {
                console.log(url);
                // alertify.set('notifier', 'position', 'top-left');
                // alertify.success(response.status);
            }
        });
    })
})
</script> -->
<?php echo view('templetes/footer'); ?>