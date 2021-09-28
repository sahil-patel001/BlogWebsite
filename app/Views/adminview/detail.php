<?php echo view('templetes/adminheader'); ?>
</br>
</br>
<div class="container">
    <h1 class="text-secondary text-center">Detail Message</h1>
    <hr>
    <br>
    <br>
    <div class="card col-lg-6 m-auto">
        <div class="card-header">
            Message
        </div>
        <div class="card-body">
            <?php foreach($detail->getResult('array') as $data) { ?>
            <h5 class="card-title"><?php echo $data['subject'] ?></h5>
            <p class="card-text"><?php echo $data['message'] ?></p>
            <a href="contact" class="btn btn-primary">Go Back</a>
            <?php } ?>
        </div>
    </div>
</div>
<?php echo view('templetes/footer'); ?>