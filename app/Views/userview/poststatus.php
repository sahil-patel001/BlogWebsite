<?php echo view('templetes/userheader'); ?>
<br>
<br>
<div class="container">

    <h2 class="text-secondary text-center mt-4 mb-4">Post Status</h2>
    <hr>
    <?php $session = session(); ?>
    <h5 class="text-success text-center"><?php echo $session->get('post'); ?></h5>
    <?php $session->remove('post'); ?>
    <h5 class="text-danger text-center"><?php echo $session->get('err'); ?></h5>
    <?php $session->remove('err'); ?>
    <br>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">All Post</div>
                <div class="col text-right">

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="<?php echo site_url("user/poststatus"); ?>" method="get">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Title</th>
                            <!-- <th>Image</th> -->
                            <th>Description</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Status</th>
                        </tr>
                        <?php
                            foreach($post_data as $data)
                            {
                                echo '
                                <tr>
                                    <td>'.$data["b_title"].'</td>
                                    <td>'.$data["b_description"].'</td>
                                    <td><button class="btn-primary"><i class="bi bi-pencil-square"></i></button></td>
                                    <td><button class="btn-danger"><i class="bi bi-trash-fill"></i></button></td>
                                    <td></td>
                                </tr>';
                            }

                        ?>
                    </table>
            </div>
            <div>
                <?php

                    if($pagination_link)
                    {
                        $pagination_link->setPath('User/poststatus');

                        echo $pagination_link->links();
                    }
                    
                    ?>

            </div>
            </form>
        </div>
    </div>

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
<br>
<br>