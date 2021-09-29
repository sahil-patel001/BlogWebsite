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
                    <a href="user/detail?id=<?php echo $id = $data["bid"] ?>" class="btn btn-primary">Detail Blog</a>
                </div>
            </div>
        </div>

        <?php } ?>
    </div>

    <!-- <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">List Of Blogs</div>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="text-center table table-striped table-bordered">
                    <?php //$counter = 1; ?>
                    <tr>
                        <th>No.</th>
                        <th>Thumbnail</th>
                        <th>Added By</th>
                        <th>Action</th>
                        <th>Detail Post</th>
                    </tr>
                    <?php
                            // foreach($all_data as $data)
                            // { ?>
                    <tr>
                        <td><?php //echo $counter ?></td>
                        <td><?php //echo $data['b_title'] ?></td>
                        <td><?php //echo $data["addedBy"] ?></td>
                        <td><button><i class="bi bi-hand-thumbs-up"></i></button></td>
                        <td><a href="user/detail?id=<?php //echo $id = $data["bid"] ?>"><button class="btn-primary">Click Here</button></a></td>
                    </tr>

                    <?php
                            // $counter++;
                            // }
                        ?>
                </table>
            </div>
            <div>
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

<style>
.pagination li a {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

.pagination li.active a {
    z-index: 1;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
</style>
<?php echo view('templetes/footer'); ?>