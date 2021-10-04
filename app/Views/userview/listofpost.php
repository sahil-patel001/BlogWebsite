<?php echo view('templetes/userheader'); ?>
<br>
<br>
<h2 class="text-primary text-center">
    <?php $session = session(); ?>
    <?php $user = $session->get('user') ?>
    <div>Hello <?php if(isset($session)) { echo $user; } ?></div>
</h2>
<br>
<br>
<div class="container d-flex justify-content-center">
    <div class="row col-lg-11 d-flex">
        <?php foreach($all_data->getResult('array') as $data) { 
        $imgURL = base_url('./upload').'/'.$data['img']; ?>

        <div class="card ms-5 mb-5 me-5" style="width: 18rem;">
            <div style="height: 100%">
                <div>
                    <img style="height: 262px; weight: 262px; object-fit: cover;" src="<?php echo $imgURL; ?>"
                        class="card-img-top">
                </div>
                <div class="card-body">
                    <div style="height: 55px">
                        <h5 class="card-title"><?php echo $data['b_title']; ?></h5>
                    </div>
                    <p>By - <?php echo $data['fname'] ?></p>
                    <p class="card-text">For getting more information about this blog, Please click on the button
                        given below.</p>
                    <div class="d-flex justify-content-between" style="margin-bottom: 10px">
                        <a href="user/detail?id=<?php echo $id = $data["bid"] ?>" class="btn btn-primary">Detail
                            Blog</a>
                        <a href="user/like?id=<?php echo $id = $data["bid"] ?>"><?php if($data['islike'] == 'Yes') { ?><button
                                class="btn btn-outline-danger" data="<?php echo $data['bid'] ?>"><i
                                    class="bi bi-heart-fill"></i></button><?php } else { ?><button
                                class="btn btn-outline-primary likebtn" data="<?php echo $data['bid'] ?>"><i
                                    class="bi bi-heart"></i></button><?php } ?></a>

                    </div>
                    <div class="d-flex justify-content-end">
                        Total Likes: <?php  ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</div>
</div>

</div>
<?php echo view('templetes/footer'); ?>