<?php echo view('templetes/adminheader'); ?>
<br>
<br>
<?php $session=session(); ?>
<?php $admin = $session->get('admin'); ?>
<h2 class="text-primary text-center">
    <div><?php echo "Hello ".$admin; ?></div>
</h2>
<br>
<br>
<div class="container">

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">List Of Pending Blogs</div>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="post" class="table table-striped table-bordered">
                    <?php $counter = 1; ?>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if(empty($pending_post)){ 
                        echo '<br><h1 class="text-secondary text-center">No Pending Data Found</h1><br>';
                    } else {
                            foreach($pending_post as $data)
                            { 
                                ?>
                    <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $data['b_title'] ?></td>
                        <td><?php echo $data["b_description"] ?></td>
                        <td><?php echo $data["addedBy"] ?></td>
                        <td class="d-flex">
                            <a href="admin/approve?id=<?php echo $id = $data["bid"] ?>"><button
                                    class="me-2 btn-primary"><i class="bi bi-check-lg"></i></button></a>
                            <!-- <a href="admin/decline?id=<?php //echo $id = $data["bid"] ?>"><button class="btn-danger"><i class="bi bi-x-lg"></i></button></a> -->
                        </td>
                    </tr>
                    <?php
                            $counter++;
                            } }
                        ?>
                </table>
                <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

                <script>
                $(document).ready(function() {
                    $('#post').DataTable();
                });
                </script>
            </div>
            <div>
                <?php

                    if($pagination_link)
                    {
                        $pagination_link->setPath('Admin');

                        echo $pagination_link->links();
                    }
                    
                    ?>

            </div>
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