<?php echo view('templetes/adminheader'); ?>
</br>
</br>
<div class="container">
    <h1 class="text-secondary text-center">Edit User</h1>
    <hr>
    </br>
    </br>
    <div class="col-lg-6 m-auto">
        <?php foreach($user as $data) { ?>
        <form class="row g-3" action="<?php echo site_url('Admin/edit?id='.$data['uid']) ?>" method="post">
        
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
                <input type="email" class="form-control" value=<?php echo $data['email']; ?> placeholder="example@email.com" name="email" id="" required>
            </div>
            <label for="account" class="form-lable">Create an account as: </label>
            <div class="d-flex">
                <div class="form-check" style="padding-left: 5%">
                    <input class="form-check-input" type="radio" name="account" value="User" id="User" checked>
                    <label class="form-check-label" for="User">
                        User
                    </label>
                </div>
                <div class="form-check" style="padding-left: 5%">
                    <input class="form-check-input" type="radio" name="account" value="Admin" id="Admin">
                    <label class="form-check-label" for="Admin">
                        Admin
                    </label>
                </div>
            </div>
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Phone Number: </label>
                <input type="tel" maxlength="10" value=<?php echo $data['phone']; ?> class="form-control" name="phone" id="" required>
            </div>
            <div class="col-12">
                <button type="submit" name="" class="btn btn-primary" onclick="">Update</button>
            </div>
            
        </form>
        <?php } ?>
        <br>
        <br>
    </div>
</div>
<?php echo view('templetes/footer'); ?>