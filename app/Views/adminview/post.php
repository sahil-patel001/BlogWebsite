<?php echo view('templetes/adminheader'); ?>
<br>
<br>
<?php $session=session(); ?>
<?php $admin = $session->get('admin'); ?>
<h2 class="text-primary text-center">
    <div><?php echo "Hello ".$admin; ?></div>
</h2>
<br>
<div class="container">
    <hr>
</div>
<br>
<br>
<div class="container">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Detail</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php foreach($pending_post as $data){ ?>
        <tbody>
            <tr>
                <td><?php echo $data['b_title'] ?></td>
                <td><?php echo $data["b_description"] ?></td>
                <td><a href="admin/detailpost?id=<?php echo $id = $data["bid"] ?>" class="btn btn-primary">Detail Post</a></td>
                <?php if($data['status']=='pending') {?>
                <td class="d-flex align-content-center">
                    <a href="admin/approve?id=<?php echo $id = $data["bid"] ?>"><button class="me-2 btn btn-primary"><i
                                class="bi bi-check-lg"></i></button></a>
                    <a href="admin/decline?id=<?php echo $id = $data["bid"] ?>"><button class="me-2 btn btn-danger"><i
                                class="bi bi-x-lg"></i></button></a>
                </td>
                <?php } else{ 
                    if($data['status']=='rejected') { ?>
                <td>
                    <?php echo '<div class="alert alert-danger">'.$data['status'].'</div>' ?>
                </td>
                <?php } else { ?>
                <td>
                    <?php echo '<div class="alert alert-success">'.$data['status'].'</div>' ?>
                </td>
                <?php } ?>
                <?php } ?>
            </tr>
        </tbody>
        <?php
     } ?>
    </table>
</div>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>
<?php echo view('templetes/footer'); ?>
<br>
<br>