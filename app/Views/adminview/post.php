<?php echo view('templetes/adminheader'); ?>
<br>
<br>
<h2 class="text-primary text-center"><?php if(isset($_SESSION['admin'])) { echo "Hello Admin ".$_SESSION['admin']; unset($_SESSION['admin']);}else{ echo "Hello Admin";} ?></h2>
<br>
<br>
<h1>approve the post here</h1>
<?php echo view('templetes/footer'); ?>