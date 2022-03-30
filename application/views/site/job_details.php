<div class="pad_sec">
    <div class="container">
        <div class="white_box2 job_deshhh">
            <a class="job_com1" href="#">
                <div class="com_img">
                    <img src="<?= site_url('assets/site/'); ?>img/logo.png">
                </div>
                <div class="commodo_de">
                    <h3><?= $jobDetails['title']; ?></h3>
                    <div class="star_5">
                        <span class="active fa fa-star"></span>
                        <span class="active fa fa-star"></span>
                        <span class="active fa fa-star"></span>
                        <span class="active fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <?php
                    if ($this->session->userdata('user_id')) {
                    ?>
                        <button class="btn btn_theme2 btn_r btn_submit" type="button" onclick="apply();">Apply Now</button>
                    <?php
                    }
                    ?>
                    <!-- <button class="btn btn_theme2 btn_r"> <i class="fa fa-heart-o"></i> Save</button> -->
                </div>
            </a>
            <div class="detaidl">
                <div class="row">
                    <div class="col-sm-4">
                        <h4><span><i class="fa fa-map-marker"></i>Location</span><?= $jobDetails['title']; ?> </h4>
                    </div>
                    <div class="col-sm-4">
                        <h4><span><i class="fa fa-usd"></i>Salary </span> $ <?= $jobDetails['salary']; ?> / <?= $paymentTypes[$jobDetails['payment_type']]; ?> </h4>
                    </div>
                    <div class="col-sm-4">
                        <h4><span><i class="fa fa-map-marker"></i>Qualification</span><?= $jobDetails['qualification']; ?></h4>
                    </div>
                    <div class="col-sm-4">
                        <h4><span><i class="fa fa-map-marker"></i> Posted </span><?= date("d M, Y", strtotime($jobDetails['created'])); ?></h4>
                    </div>
                    <div class="col-sm-4">
                        <h4><span><i class="fa fa-map-marker"></i> Last Date </span><?= date("d M, Y", strtotime($jobDetails['last_date'])); ?></h4>
                    </div>
                </div>
                <h3>Job Description</h3>
                <?= $jobDetails['description']; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function apply() {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'Apply',
            data: { id: <?=$jobDetails['id'];?> },
            dataType: 'json',
            // processData: false,
            // contentType: false,
            // cache: false,
            beforeSend: function(xhr) {
                $(".btn_submit").attr('disabled', true);
                $(".btn_submit").html(LOADING);
                // $("#responseMessage").html('');
                // $("#responseMessage").hide();
                $("#job-listings").html(LOADING);
            },
            success: function(response) {
                $(".btn_submit").prop('disabled', false);
                $(".btn_submit").html(' Apply Now ');
            }
        });
    }
</script>