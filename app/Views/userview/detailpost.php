<?php echo view('templetes/userheader'); ?>
<br>
<br>
<?php foreach($detail->getResult('array') as $data){
    $title = $data['b_title'];
    $image = $data['b_image'];
    $description = $data['b_description'];
} ?>
<h1 class="display-3 text-center" style="font-weight: bold; color: #32608f"><?php echo $title; ?></h1>
<br>
<div class="container">
    <p style="font-size: 18px; color: #000000"><?php echo $description; ?></p>
</div>
<?php echo view('templetes/footer'); ?>