<?php echo view('templetes/userheader'); ?>
<br>
<br>
<h2 class="text-primary text-center">
    <?php $session = session(); ?>
    <?php $user = $session->get('user') ?>
    <div>Hello <?php if(isset($_SESSION['user'])) { echo $user; } ?></div>
</h2>
<br>
<br>
<!-- Model For Report -->
<div class="modal fade" id="reportModel" tabindex="-1" aria-labelledby="reportModelLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Report Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <lable class="mb-2" for="reason">Reason: </lable>
                    <input type="text" id="reason" name="reason" class="form-control"
                        placeholder="Enter the reason why you want to report this post.">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="reportpost" class="btn btn-danger">Report post</button>
            </div>
        </div>
    </div>
</div>

<div class="container d-flex justify-content-center">
    <div class="row col-lg-11 d-flex">
        <?php foreach($all_data->getResult('array') as $data) { 
            $session->set('bid',$data['bid']);
            
            $imgURL = base_url('./upload').'/'.$data['img']; ?>

        <div class="card ms-5 mb-5 me-5" style="width: 18rem;">
            <div style="height: 100%">
                <div>
                    <img style="height: 262px; weight: 262px; object-fit: cover;" src="<?php echo $imgURL; ?>"
                        class="card-img-top">
                </div>
                <div class="card-body">
                    <div style="height: 55px">
                        <h5 class="card-title"><?php echo $data['b_title']; ?></h5>
                    </div>
                    <p>By - <?php echo $data['fname'] ?></p>
                    <p class="card-text">
                        <?php if(strlen($data['b_description'])<=100)
                        {
                            echo $data['b_description'];
                        }
                        else
                        {
                            $y=substr($data['b_description'],0,100) . '...';
                            echo $y;
                        } ?>
                    </p>
                    <div class="d-flex justify-content-between" style="margin-bottom: 10px">
                        <a href="user/detail?id=<?php echo $data["bid"] ?>" class="btn btn-primary">Detail
                            Blog</a>
                        <?php if($data['islike'] == 'Yes') { ?><button
                            class="btn btn-outline-danger bi bi-heart-fill likebtn"
                            id="<?php echo $data["bid"] ?>"></button><?php } else { ?><button
                            class="btn btn-outline-primary bi bi-heart likebtn"
                            id="<?php echo $data["bid"] ?>"></button><?php } ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#reportModel">Report</button>
                        </div>
                        <div class="totalLike" id="<?php echo $data["bid"] ?>">
                            Likes: <?php echo $data['total']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
    $(document).ready(function() {
        $(document).on('click', '#reportpost', function() {
            var data = {
                'reason': $('#reason').val(),
            }
            $.ajax({
                method: "POST",
                url: "<?php echo base_url('user/reportpost') ?>",
                data: data,
                success: function(response) {
                    $('#reportModel').modal('hide');
                    $('#reportModel').find('input').val('');
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success(response.status);
                },
                error: function(error) {
                    alert("Please Enter The Reason!");
                }
            });
        });
    });
    $(document).ready(function() {
        $('.likebtn').click(function(e) {
            e.preventDefault();
            var id = $(this).attr('id');
            var url = "<?php echo base_url('user/like?id=strid')?>";
            url = url.replace('strid', id);
            $.ajax({
                url: url,
                success: function(res) {
                    var x = res;
                    var y = x.replace('"Yes"', 'Yes');
                    if (y == 'Yes') {
                        $('#' + id).removeClass('btn-outline-primary bi bi-heart').addClass(
                            'btn-outline-danger bi bi-heart-fill');
                    } else {
                        $('#' + id).removeClass('btn-outline-danger bi bi-heart-fill')
                            .addClass('btn-outline-primary bi bi-heart');
                    }
                    window.location.reload();
                },
                error: function(error) {}
            });
        })
    });
    //TODO: this is a script for get total likes while using upper script on like or dislike
    // $(document).ready(function() {
    //     $('.likebtn').click(function(e) {
    //         var id = $(this).attr('id');
    //         var url = "<?php //echo base_url('user/totallike?id=strid')?>";
    //         url = url.replace('strid', id);
    //         $.ajax({
    //             url: url,
    //             success: function(res) {

    //             }
    //         }):
    //     })
    // });
    </script>

</div>
<?php echo view('templetes/footer'); ?>