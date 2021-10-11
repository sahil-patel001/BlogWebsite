<?php echo view('templetes/userheader'); ?>
<br>
<div class="container">
    <?php $session = session(); ?>
    <?php if(isset($session)){?>
    <h5 class="text-success text-center"><?php echo $session->get('update'); ?></h5>
    <?php } $session->remove('update'); ?>
    <?php if(isset($session)){?>
    <h5 class="text-success text-center"><?php echo $session->get('delete'); ?></h5>
    <?php } $session->remove('delete'); ?>
    <h1 class="text-secondary text-center mt-4 mb-4">Post Status</h1>
    <hr>
    <h5 class="text-success text-center"><?php echo $session->get('post'); ?></h5>
    <?php $session->remove('post'); ?>
    <h5 class="text-danger text-center"><?php echo $session->get('err'); ?></h5>
    <?php $session->remove('err'); ?>
    <br>
    <table id="postTable" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Status</th>
            </tr>
        </thead>
        <?php foreach($post->getResult('array') as $data){ ?>
        <tbody>
            <tr>
                <td><?php echo $data["b_title"] ?></td>
                <td><?php echo $data["b_description"] ?></td>
                <td><a href="edit?id=<?php echo $data['bid'] ?>" class="btn btn-primary"><i
                            class="bi bi-pencil-square"></i></a></td>
                <td><a href="delete?id=<?php echo $data['bid'] ?>"><button class="btn btn-danger"
                            onClick="return confirm('Are you sure?')"><i class="bi bi-trash-fill"></i></button></a></td>
                <td><?php if($data['status']=='pending'){ echo '<h6 class="alert alert-warning">Pending</h6>';} elseif($data['status']=='rejected') { echo '<h6 class="alert alert-danger">Rejected</h6>';} else {echo '<h6 class="alert alert-success">Approved</h6>';};?>
                </td>
            </tr>
        </tbody>
        <?php
     } ?>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#postTable').DataTable();
});
</script>
</div>
<?php echo view('templetes/footer'); ?>
<br>
<br>

