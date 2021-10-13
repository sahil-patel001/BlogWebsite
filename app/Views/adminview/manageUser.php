<?php echo view('templetes/adminheader'); ?>
<br>
<div class="container">
    <h2 class="text-secondary text-center mt-4 mb-4">Manage User</h2>
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
                <div class="col">List Of All Users</div>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-body text-center">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if(empty($all_user)){
                        echo "<h5 class='alert alert-secondary'>No Data Found.</h5>";
                    } else {
                        foreach($all_user as $data)
                        { 
                            ?>
                    <tr>
                        <td><?php echo $data['uid'] ?></td>
                        <td><?php echo $data["fname"] . ' ' . $data["lname"] ?></td>
                        <td><?php echo $data["email"] ?></td>
                        <td><?php echo $data["phone"] ?></td>
                        <td class="d-flex justify-content-center">
                            <a href="fetchuser?id=<?php echo $data['uid'] ?>"><button class="me-2 btn btn-primary"><i
                                        class="bi bi-pencil-square"></i></button></a>
                            <a href="deleteuser?id=<?php echo $data['uid'] ?>"><button class="btn btn-danger"
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
                        $pagination_link->setPath('Admin/userManagement');

                        echo $pagination_link->links();
                    }
                    
                    ?>

            </div>
        </div>
    </div>
    <br>
    <br>
    <a href="<?php echo site_url('admin/addUser'); ?>"><button class="btn btn-primary">Add User</button></a>

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