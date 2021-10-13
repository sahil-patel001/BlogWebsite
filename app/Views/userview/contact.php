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
    <form>
        <div class="form-group mb-3">
            <label class="mb-2" for="subject">Subject:</label><span id="error_subject" class="text-danget ms-5"></span>
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject Title" required>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 pe-3" for="message">Message: </label><span id="error_message"
                class="text-danget ms-5"></span>
            <small class="form-text text-muted">( Enter Your Message Here )</small>
            <textarea type="text" minlength="10" maxlength="1000" rows="10" class="form-control" name="message"
                id="message" required></textarea>
        </div>
        <button type="submit" id="send" name="send" class="btn btn-primary">Send</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function() {
    $(document).on('click', '#send', function() {
            var data = {
                'subject': $('#subject').val(),
                'message': $('#message').val(),
            }
            $.ajax({
                method: "POST",
                url: "<?php echo base_url('User/sendMessage') ?>",
                data: data,
                success: function(response) {
                    console.log(response.status);
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success(response.status); 
                }
            });
    })
})
</script>
<?php echo view('templetes/footer'); ?>
<br>
<br>