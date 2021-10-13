<?php echo view('templetes/adminheader'); ?>
</br>
</br>
<?php $session=session(); ?>
<?php if(isset($_SESSION['error'])){?>
<h4 class="text-danger text-center"><?php echo $session->get('error');?></h4>
<?php } $session->remove('error'); ?>
<div class="container">
    <h1 class="text-secondary text-center">Edit User</h1>
    <hr>
    </br>
    </br>
    <div class="col-lg-6 m-auto">
        <?php foreach($user as $data) { ?>
        <form class="row g-3" action="<?php echo base_url('Admin/editUser?id='.$data['uid']) ?>" method="post">
        
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
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Phone Number: </label>
                <input type="tel" maxlength="10" value=<?php echo $data['phone']; ?> class="form-control" name="phone" id="" required>
            </div>
            <div class="col-12">
                <button type="submit" name="update" class="btn btn-primary" onclick="">Update</button>
            </div>
            
        </form>
        <?php } ?>
        <div class="col-12" style="margin-top: 12px">
            <a href="userManagement" class="btn btn-primary">Go Back</a>
        </div>
        <br>
        <br>
    </div>
</div>
<?php echo view('templetes/footer'); ?>