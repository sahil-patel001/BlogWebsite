<?php echo view('templetes/adminheader'); ?>
<br>
<br>
<?php foreach($detail->getResult('array') as $data){
    $title = $data['b_title'];
    $description = $data['b_description'];
    $user = $data['fname'];
} ?>
<h1 class="display-3 text-center" style="font-weight: bold; color: #32608f"><?php echo $title; ?></h1>
<br>
<div class="container">
    <h4 class="text-muted">Snapshots</h4>
</div>
<br>
<div class="container d-flex justify-content-between">
    <?php foreach($detail->getResult('array') as $data){
    $imgURL = base_url('./upload').'/'.$data['img']; ?>
    <a data-fancybox="gallery" href="<?php echo $imgURL ?>">
        <img src="<?php echo $imgURL ?>">
    </a>
    <?php } ?>
</div>
<br>
<br>
<div class="container">
    <h4 class="text-muted">About</h4>
</div>
<br>
<div class="container">
    <p style="font-size: 18px; color: #000000"><?php echo $description; ?></p>
</div>
<br>
<div class="container">
    <h4 class="text-muted">Added By</h4>
</div>
<br>
<div class="container">
    <p style="font-size: 18px; color: #000000"><?php echo $user; ?></p>
</div>
<br>
<div class="container d-flex justify-content-between">
    <div>
        <a href="/admin"><button class="btn-lg btn-primary"><i class="bi bi-arrow-left-circle-fill"></i></button></a>
    </div>
    <div>
        <?php if($data['status']=='pending') { ?>
        <a href="approve?id=<?php echo $id = $data["bid"] ?>"><button class="me-2 btn btn-primary"><i
                    class="bi bi-check-lg"></i></button></a>
        <a href="decline?id=<?php echo $id = $data["bid"] ?>"><button class="me-2 btn btn-danger"><i
                    class="bi bi-x-lg"></i></button></a>
        <?php } else { 
            if($data['status']=='rejected') { 
                echo '<div class="alert alert-danger">'.$data['status'].'</div>';
            } else {
                echo '<div class="alert alert-success">'.$data['status'].'</div>';
            }
        }?>

    </div>
</div>
<br>
<br>

<?php echo view('templetes/footer'); ?>