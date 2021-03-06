<?php echo view('templetes/adminheader'); ?>
<br>
<br>
<?php $session=session(); ?>
<?php $admin = $session->get('admin'); ?>
<?php if(isset($_SESSION['error'])){?>
<h4 class="text-danger text-center"><?php echo $session->get('error');?></h4>
<?php } $session->remove('error'); ?>
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
    <table id="myTable" class="display text-center">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Detail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pending_post as $data){ ?>
            <tr>
                <td><?php echo $data['b_title'] ?></td>
                <td>
                    <?php if(strlen($data['b_description'])<=200)
                    {
                        echo $data['b_description'];
                    }
                    else
                    {
                        $y=substr($data['b_description'],0,200) . '...';
                        echo $y;
                    } ?>
                </td>
                <td>
                    <?php $imgURL = base_url('./upload').'/'.$data['img']; ?>
                    <img src="<?php echo $imgURL ?>" style="width: 100px; height: 100px; objectfit: cover;">
                </td>
                <td><a href="admin/detailpost?id=<?php echo $id = $data["bid"] ?>" class="btn btn-primary">Detail
                        Post</a></td>

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
    $('#myTable').DataTable();
});
</script>
<?php echo view('templetes/footer'); ?>
<br>
<br>