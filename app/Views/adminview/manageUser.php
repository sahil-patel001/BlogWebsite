<?php echo view('templetes/adminheader'); ?>
<br>
<?php $session=session(); ?>
<?php if(isset($_SESSION['error'])){?>
<h4 class="text-danger text-center"><?php echo $session->get('error');?></h4>
<?php } $session->remove('error'); ?>
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
    <table id="user" class="display text-center">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
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
                            onClick="return confirm('Are you sure?')"><i class="bi bi-trash-fill"></i></button></a>
                </td>
            </tr>  
            <?php
                }
            ?>
        </tbody>
    </table>
    <br>
    <a href="<?php echo site_url('admin/addUser'); ?>"><button class="btn btn-primary">Add User</button></a>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#user').DataTable();
});
</script>
<br>
<?php echo view('templetes/footer'); ?>
<br>