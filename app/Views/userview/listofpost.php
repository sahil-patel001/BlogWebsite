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
                    <img src="<?php echo $imgURL; ?>" class="card-img-top">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['b_title']; ?></h5>
                    <p class="card-text">For getting more information about this blog, Please click on the button given
                        below.</p>
                    <div class="d-flex justify-content-between">
                        <a href="user/detail?id=<?php echo $id = $data["bid"] ?>" class="btn btn-primary">Detail
                            Blog</a>
                        <button class="btn btn-outline-primary"><i class="fa fa-thumbs-o-up"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <script>
        $("button").click(function() {
            $(this).find("i").removeClass("fa fa-thumbs-o-up").addClass("fa fa-thumbs-up");
        });
        </script>
        <?php } ?>
    </div>
    <?php

                    // if($pagination_link)
                    // {
                    //     $pagination_link->setPath('User');

                    //     echo $pagination_link->links();
                    // }
                    
                    ?>

</div>
</div>
</div> -->

</div>
<?php echo view('templetes/footer'); ?>