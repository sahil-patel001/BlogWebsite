<?php echo view('templetes/adminheader'); ?>
<br>
<br>
<?php $session=session(); ?>
<?php $admin = $session->get('admin'); ?>
<h2 class="text-primary text-center">
    <div><?php echo "Hello ".$admin; ?></div>
</h2>
<br>
<br>
<h1>approve the post here</h1>
<?php echo view('templetes/footer'); ?>