<?php echo view('templetes/adminheader'); ?>
<br>
<div class="container">
    <h2 class="text-secondary text-center mt-4 mb-4">Manage Admin</h2>
    <hr>
    <?php $session = session(); ?>
    <?php if(isset($_SESSION['success'])) { ?>
    <h5 class="text-success text-center"><?php echo $session->get('success'); ?></h5>
    <?php } 
    $session->remove('success'); ?>
    <?php if(isset($_SESSION['delete'])) { ?>
    <h5 class="text-success text-center"><?php echo $session->get('delete'); ?></h5>
    <?php } 
    $session->remove('delete'); ?>
    <br>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">List Of All Admins</div>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-body text-center">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Admin ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if(empty($all_admin)){
                        echo "<h5 class='alert alert-secondary'>No Data Found.</h5>";
                    } else {
                        foreach($all_admin as $data)
                        {
                            ?>
                    <tr>
                        <td><?php echo $data['aid'] ?></td>
                        <td><?php echo $data["fname"] . ' ' . $data["lname"] ?></td>
                        <td><?php echo $data["email"] ?></td>
                        <td><?php echo $data["phone"] ?></td>
                        <td class="d-flex justify-content-center">
                            <a href="fetchadmin?id=<?php echo $data['aid'] ?>"><button class="me-2 btn btn-primary"><i
                                        class="bi bi-pencil-square"></i></button></a>
                            <a href="deleteadmin?id=<?php echo $data['aid'] ?>"><button class="btn btn-danger"
                                    onClick="return confirm('Are you sure?')"><i
                                        class="bi bi-trash-fill"></i></button></a>
                        </td>
                    </tr>

                    <?php
                            } }
                        ?>
                </table>

            </div>

            <div>
                <?php

                    if($pagination_link)
                    {
                        $pagination_link->setPath('Admin/adminManagement');

                        echo $pagination_link->links();
                    }
                    
                    ?>

            </div>
        </div>
    </div>
    <br>
    <br>
    <a href="<?php echo base_url('admin/addAdmin'); ?>"><button class="btn btn-primary">Add Admin</button></a>

</div>
<br>

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