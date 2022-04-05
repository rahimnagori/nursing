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
                    if ($this->session->userdata('id') && $userDetails['resume']) {
                        if ($isJobApplied) {
                            echo "<p>You have already applied for this job.</p>";
                        } else {
                    ?>
                            <button class="btn btn_theme2 btn_r btn_submit" type="button" onclick="apply();">Apply Now</button>
                        <?php
                        }
                    }
                    if (!$this->session->userdata('id')) {
                        ?>
                        <button class="btn btn_theme2 btn_r btn_submit" onclick="login();">Login to Apply</button>
                    <?php
                    }
                    ?>
                    <!-- <button class="btn btn_theme2 btn_r"> <i class="fa fa-heart-o"></i> Save</button> -->
                </div>
            </a>
            <div class="detaidl">
                <?php
                if ($this->session->userdata('id')) {
                    if (!$userDetails['resume']) {
                        echo "<p><a href='" . site_url('Profile') . "'>Upload</a> resume to start applying.</a>";
                    }
                }
                ?>
                <div class="responseMessage" id="responseMessage"></div>
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
            data: {
                id: <?= $jobDetails['id']; ?>
            },
            dataType: 'json',
            beforeSend: function(xhr) {
                $(".btn_submit").attr('disabled', true);
                $(".btn_submit").html(LOADING);
                $("#job-listings").html(LOADING);
                $("#responseMessage").hide();
            },
            success: function(response) {
                $("#responseMessage").html(response.responseMessage);
                $("#responseMessage").show();
                if (response.status == 1) {
                    $(".btn_submit").html(' Applied ');
                } else if (response.status == 3) {
                    $(".btn_submit").html(' Already applied ');
                } else {
                    $(".btn_submit").html(' Apply ');
                    $(".btn_submit").prop('disabled', false);
                }
            }
        });
    }

    function login(){
        window.location.href = "../Login";
    }
</script>