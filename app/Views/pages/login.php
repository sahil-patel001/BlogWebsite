<?php echo view('templetes/header'); ?>
</br>
</br>
<div class="container">
    <h1 class="text-secondary text-center">Login Page</h1>
    <hr>
    <?php
        if(isset($_SESSION['success'])){
    ?>
    <div class="alert alert-success" role="alert"><?php echo $_SESSION['success'] ?></div>
    <?php
        }
        // unset($_SESSION['success']);
    ?>
    </br>
    </br>
    <div class="col-lg-6 m-auto">
        <form class="row g-3" action="<?php echo site_url('Login/loginAuth') ?>" method="post">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email: </label>
                <input type="email" class="form-control" placeholder="example@email.com" name="email" id="" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password: </label>
                <input type="password" class="form-control" name="password" id="" required>
            </div>
            <?php
                if(isset($_SESSION['msg'])){
            ?>
            <div class="alert alert-danger" role="alert"><?php echo $_SESSION['msg'] ?></div>
            <?php
                }
                // unset($_SESSION['msg']);
            ?>
            <div class="col-12">
                <button type="submit" name="" class="btn btn-primary" onclick="">Login</button>
            </div>
            <div class="col-12 mt-5 d-flex justify-content-center">
                <a class="border border-primary p-2" href="/signup">Not have an account? click here</a>
            </div>
        </form>
    </div>
</div>
<?php echo view('templetes/footer'); ?>