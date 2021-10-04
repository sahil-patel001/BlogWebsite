<?php echo view('templetes/adminheader'); ?>
</br>
</br>
<div class="container">
    <h1 class="text-secondary text-center">Edit Admin</h1>
    <hr>
    </br>
    </br>
    <div class="col-lg-6 m-auto">
        <?php foreach($admin as $data) { ?>
        <form class="row g-3" action="<?php echo base_url('Admin/editAdmin?id='.$data['aid']) ?>" method="post">

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">First Name: </label>
                <input type="text" class="form-control" value=<?php echo $data['fname']; ?> name="fname" id="" required>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Last Name: </label>
                <input type="text" class="form-control" value=<?php echo $data['lname']; ?> name="lname" id="" required>
            </div>
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Email: </label>
                <input type="email" class="form-control" value=<?php echo $data['email']; ?>
                    placeholder="example@email.com" name="email" id="" required>
            </div>
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Phone Number: </label>
                <input type="tel" maxlength="10" value=<?php echo $data['phone']; ?> class="form-control" name="phone"
                    id="" required>
            </div>
            <div class="col-12">
                <button type="submit" name="update" class="btn btn-primary" onclick="">Update</button>
            </div>
        </form>
        <div class="col-12" style="margin-top: 12px">
            <a href="adminManagement" class="btn btn-primary">Go Back</a>
        </div>
        <?php } ?>
        <br>
        <br>
    </div>
</div>
<?php echo view('templetes/footer'); ?>