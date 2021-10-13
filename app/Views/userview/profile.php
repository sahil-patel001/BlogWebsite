<?php echo view('templetes/userheader'); ?>
</br>
<?php $session=session(); ?>
<?php $session->set('add','User Added Successfully.'); ?>
<?php if(isset($_SESSION['update'])){?>
<h4 class="text-success text-center"><?php echo $session->get('update');?></h4>
<?php } $session->remove('update'); ?>
<?php if(isset($_SESSION['change'])){?>
<h4 class="text-success text-center"><?php echo $session->get('change');?></h4>
<?php } $session->remove('change'); ?>
<?php if(isset($_SESSION['error'])){?>
<h4 class="text-success text-center"><?php echo $session->get('error');?></h4>
<?php } $session->remove('error'); ?>

<br>
<div class="container">
    <h1 class="text-secondary text-center">User Profile</h1>
    <hr>
    </br>
    <div class="col-lg-6 m-auto">
        <?php foreach($user->getResult('array') as $data) {?>
        <form class="row g-3" action="<?php echo site_url('User/update?id='.$data['uid']) ?>" method="post">
            <div class="d-flex justify-content-center">
                <img src="https://static.thenounproject.com/png/363633-200.png" alt="UserProfileImage">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">First Name: </label>
                <input type="text" value="<?php echo $data['fname'] ?>" class="form-control" name="fname">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Last Name: </label>
                <input type="text" value="<?php echo $data['lname'] ?>" class="form-control" name="lname">
            </div>
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Email: </label>
                <input type="email" value="<?php echo $data['email'] ?>" class="form-control"
                    placeholder="example@email.com" name="email" disabled>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password: </label>
                <input type="password" value="<?php echo $data['password'] ?>" class="form-control" name="password" disabled>
            </div>
            <div class="col-md-6" style="margin-top: 47px">
                <a href="password?id=<?php echo $data['uid'] ?>" class="btn btn-primary">Change password?</a>
            </div>
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Phone Number: </label>
                <input type="tel" value="<?php echo $data['phone'] ?>" maxlength="10" class="form-control" name="phone">
            </div>
            <div class="col-12" style="margin-bottom: 20px">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        <?php } ?>
        <br>
        <br>
    </div>
</div>
<?php echo view('templetes/footer'); ?>