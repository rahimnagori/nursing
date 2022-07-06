<style>
    #guest-application-form {
        display: none;
    }

    .job_com1 {
        min-height: 125px;
    }
</style>

<div class="pad_sec">
    <div class="container">
        <div class="white_box2 job_deshhh">
            <a class="job_com1" href="#">
                <div class="com_img">
                    <img src="<?= site_url('assets/site/'); ?>img/logo.png">
                </div>
                <div class="commodo_de">
                    <h3><?= $jobDetails['title']; ?></h3>
                    <h2>#<?= $jobDetails['job_ref']; ?></h2>
                    <div class="star_5">
                        <span class="active fa fa-star"></span>
                        <span class="active fa fa-star"></span>
                        <span class="active fa fa-star"></span>
                        <span class="active fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>

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
                <div class="row d_flex">
                    <div class="col-sm-4">
                        <h4><span><i class="fa fa-map-marker"></i>Work Location</span><?= $jobTypes[$jobDetails['job_type']]; ?> </h4>
                    </div>
                    <div class="col-sm-4">
                        <h4><span><?= $this->config->item('CURRENCY'); ?></i>Salary </span> <?= $this->config->item('CURRENCY'); ?> <?= $jobDetails['salary']; ?> / <?= $paymentTypes[$jobDetails['payment_type']]; ?> </h4>
                    </div>
                    <div class="col-sm-4">
                        <h4><span><i class="fa fa-graduation-cap"></i>Qualification</span><?= $jobDetails['qualification']; ?></h4>
                    </div>
                    <div class="col-sm-4">
                        <h4><span><i class="fa fa-calendar"></i> Posted </span><?= date("d M, Y", strtotime($jobDetails['created'])); ?></h4>
                    </div>
                    <div class="col-sm-4">
                        <h4><span><i class="fa fa-calendar"></i> Last Date </span><?= date("d M, Y", strtotime($jobDetails['last_date'])); ?></h4>
                    </div>
                    <div class="col-sm-4">
                        <h4><span><i class="fa fa-map-marker"></i> Address </span> <?= $jobDetails['address']; ?></h4>
                    </div>
                </div>
                <h3>Job Description</h3>
                <?= $jobDetails['description']; ?>
            </div>
        </div>
        <div class="text-right">
            <?php
            if ($this->session->userdata('id') && $userDetails['resume']) {
                if ($isJobApplied) {
                    echo "<a >You have already applied for this job.</a>";
                } else {
            ?>
                    <button class="btn btn_theme2 btn_r btn_submit" type="button" onclick="apply();">Apply Now</button>
                <?php
                }
            }
            if (!$this->session->userdata('id')) {
                ?>
                <button class="btn btn_theme2 btn_r btn_submit" data-toggle="modal" data-target="#applyConfirmationModal">Apply</button>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- Modal -->
    <div id="applyConfirmationModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Apply for this Job</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <p><a href="<?= site_url('Sign-Up'); ?>">Sign Up</a> and Apply</p>
                        <p>Or Apply as a Guest</p>
                        <button class="btn btn_theme2" onclick="$('#guest-application-form').show();"> Apply </button>
                    </div>
                    <div id="guest-application-form">
                        <form role="form" method="POST" id="guestApplicationForm" name="guestApplicationForm" onsubmit="apply_as_guest(event);">
                            <div class="formn_me">
                                <!-- <div class="form-group">
                                    <label>Username </label>
                                    <div class="icon_us">
                                        <i class="la la-user"></i>
                                        <input type="text" name="username" placeholder="Enter Username" class="form-control" required>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label>Name </label>
                                    <div class="icon_us">
                                        <i class="la la-user"></i>
                                        <input type="hidden" id="job_id" name="job_id" required value="<?= $jobDetails['id']; ?>">
                                        <input type="text" name="name" placeholder="Enter Name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email </label>
                                    <div class="icon_us">
                                        <i class="la la-envelope"></i>
                                        <input type="email" name="email" placeholder="Enter Email" class="form-control" required id="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Resume / CV </label>
                                    <div class="icon_us">
                                        <i class="la la-file"></i>
                                        <input type="file" name="resume" class="form-control" required accept=".pdf, .doc, .docx">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Supporting Document </label>
                                    <div class="icon_us">
                                        <i class="la la-file"></i>
                                        <input type="file" name="document" class="form-control" accept=".pdf, .doc, .docx">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" id="responseMessageSecond"></div>
                                </div>
                                <div class="btnloggib ">
                                    <button type="submit" class="btn btn_theme2 btn-lg btn-block btn_submit_apply">Apply</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= site_url('assets/site/js/job-details.js'); ?>"></script>