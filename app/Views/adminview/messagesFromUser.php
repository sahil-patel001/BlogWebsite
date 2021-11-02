<?php echo view('templetes/adminheader'); ?>
<br>
<br>
<?php $session=session(); ?>
<?php if(isset($_SESSION['error'])){?>
<h4 class="text-danger text-center"><?php echo $session->get('error');?></h4>
<?php } $session->remove('error'); ?>
<div class="container">
    <h2 class="text-secondary text-center">Messages</h2>
    <hr>
    <br>
</div>
<div class="container">
    <table id="message" class="display text-center" cellspacing="0" width="100%">
        <?php $counter = 1; ?>
        <thead>
            <tr>
                <th>No.</th>
                <th>Subject</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($receive_msg as $data)
                { 
            ?>
            <tr>
                <td><?php echo $counter ?></td>
                <td><?php echo $data['subject'] ?></td>
                <td><a href="detail?id=<?php echo $data['cid']; ?>"><button class="btn btn-primary"><i
                                class="bi bi-envelope-fill"></i></button></a></td>
            </tr>
            <?php
                $counter++;
                }
            ?>
        </tbody>
    </table>
</div>
<br>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#message').DataTable();
});
</script>
<?php echo view('templetes/footer'); ?>
<br>
<br>