<?php echo view('templetes/adminheader'); ?>
</br>
</br>
<div class="container">
    <h2 class="text-secondary text-center">Reported Blog</h2>
    <hr>
    <br>
</div>
<div class="container">
    <table id="report" class="display text-center" cellspacing="0" width="100%">
        <?php $counter = 1; ?>
        <thead>
            <tr>
                <th>No.</th>
                <th>Reported By</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($report as $data)
                { 
            ?>
            <tr>
                <td><?php echo $counter ?></td>
                <td><?php echo $data['fname'] ?></td>
                <td><?php echo $data['reason'] ?></td>
            </tr>
            <?php
                $counter++;
                }
            ?>
        </tbody>
    </table>
</div>
</br>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#report').DataTable();
});
</script>
<?php echo view('templetes/footer'); ?>