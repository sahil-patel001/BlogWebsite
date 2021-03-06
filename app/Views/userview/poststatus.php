<?php echo view('templetes/userheader'); ?>
<br>
<div class="container">
    <?php $session = session(); ?>
    <?php if(isset($_SESSION['update'])){?>
    <h5 class="text-success text-center"><?php echo $session->get('update'); ?></h5>
    <?php } $session->remove('update'); ?>
    <?php if(isset($_SESSION['delete'])){?>
    <h5 class="text-success text-center"><?php echo $session->get('delete'); ?></h5>
    <?php } $session->remove('delete'); ?>
    <?php if(isset($_SESSION['error'])){?>
    <h5 class="text-success text-center"><?php echo $session->get('error'); ?></h5>
    <?php } $session->remove('error'); ?>
    <h1 class="text-secondary text-center mt-4 mb-4">Post Status</h1>
    <hr>
    <?php if(isset($_SESSION['post'])){?>
    <h5 class="text-success text-center"><?php echo $session->get('post'); ?></h5>
    <?php } $session->remove('post'); ?>
    <?php if(isset($_SESSION['err'])){?>
    <h5 class="text-danger text-center"><?php echo $session->get('err'); ?></h5>
    <?php } $session->remove('err'); ?>
    <br>
    <table id="postTable" class="display text-center">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($post->getResult('array') as $data){ ?>
            <tr>
                <td><?php echo $data["b_title"] ?></td>
                <td><?php echo $data["b_description"] ?></td>
                <td class="d-flex">
                    <a href="edit?id=<?php echo $data['bid'] ?>" class="btn btn-primary me-2"><i
                            class="bi bi-pencil-square"></i></a>
                    <a href="delete?id=<?php echo $data['bid'] ?>"><button class="btn btn-danger"
                            onClick="return confirm('Are you sure?')"><i class="bi bi-trash-fill"></i></button></a>
                </td>
                <td><?php if($data['status']=='pending'){ echo '<h6 class="alert alert-warning">Pending</h6>';} elseif($data['status']=='rejected') { echo '<h6 class="alert alert-danger">Rejected</h6>';} else {echo '<h6 class="alert alert-success">Approved</h6>';};?>
                </td>
            </tr>
            <?php
            } ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#postTable').DataTable();
});
</script>
</div>
<?php echo view('templetes/footer'); ?>
<br>
<br>