<?php session_start();?>
<?php echo view('templetes/userheader'); ?>
<br>
<?php if(isset($_SESSION['post'])){ ?>
    <h2 class="text-success text-center"><?php echo $_SESSION['post']; ?></h2>
<?php } unset($_SESSION['post'])?>
<?php if(isset($_SESSION['err'])){ ?>
    <h2 class="text-danger text-center"><?php echo $_SESSION['err']; ?></h2>
<?php } unset($_SESSION['err'])?>
<br>
<h2 class="text-primary text-center"><?php if(isset($_SESSION['user'])) { echo "Hello User ".$_SESSION['user']; unset($_SESSION['user']);}else{ echo "Hello User";} ?></h2>
<br>
<br>
<h1>user can see all the post from here</h1>
<?php echo view('templetes/footer'); ?>