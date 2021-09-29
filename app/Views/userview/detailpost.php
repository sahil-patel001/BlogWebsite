<?php echo view('templetes/userheader'); ?>
<br>
<br>
<?php foreach($detail->getResult('array') as $data){
    $title = $data['b_title'];
    $description = $data['b_description'];
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
<div class="container d-flex">
    <a href="/user"><button class="btn-lg btn-primary"><i class="bi bi-arrow-left-circle-fill"></i></button></a>
</div>
<br>
<br>

<?php echo view('templetes/footer'); ?>