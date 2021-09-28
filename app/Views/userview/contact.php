<?php echo view('templetes/userheader'); ?>
<br>
<br>
<h1 class="text-secondary text-center">Contact Page</h1>
<div class="container">
    <hr>
</div>
<br>
<?php $session = session(); ?>
<?php if(isset($session)) { ?>
<h5 class="text-success text-center"><?php echo $session->get('send'); ?></h5>
<?php } 
$session->remove('send'); ?>
<?php if(isset($session)) { ?>
<h5 class="text-success text-center"><?php echo $session->get('unsend'); ?></h5>
<?php } 
$session->remove('unsend'); ?>
<div class="col-lg-6 m-auto">
    <form action="<?php echo site_url("User/contact"); ?>" method="post" enctype='multipart/form-data'>
        <div class="form-group mb-3">
            <label class="mb-2" for="subject">Subject:</label>
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject Title" required>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 pe-3" for="message">Message: </label>
            <small class="form-text text-muted">( Enter Your Message Here )</small>
            <textarea type="text" minlength="10" maxlength="1000" rows="10" class="form-control" name="message"
                id="message" required></textarea>
        </div>
        <button type="submit" name="send" class="btn btn-primary">Send</button>
    </form>
</div>
<?php echo view('templetes/footer'); ?>
<br>
<br>