<?php echo view('templetes/adminheader'); ?>
<br>
<br>
<div class="container">
<h2 class="text-secondary text-center">Messages</h2>
    <hr>
    <br>
    <br>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">Messages From Users</div>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <?php $counter = 1; ?>
                    <tr>
                        <th>No.</th>
                        <th>Subject</th>
                        <th>Sent By</th>
                        <th>Details</th>
                    </tr>
                    <?php
                            foreach($receive_msg as $data)
                            { 
                                ?>
                    <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $data['subject'] ?></td>
                        <td><?php echo $data["sendBy"] ?></td>
                        <td><a href="detail?id=<?php echo $data['cid']; ?>"><button class="btn btn-primary"><i class="bi bi-envelope-fill"></i></button></a></td>
                    </tr>

                    <?php
                            $counter++;
                            }
                        ?>
                </table>
            </div>
            <div>
                <?php

                    if($pagination_link)
                    {
                        $pagination_link->setPath('Admin/contact');

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