<style>
   .sec_btn {
      padding: 10px 15px;
   }
</style>
<div class="dasboadd">
   <div class="container">
      <div class="row">
         <div class="col-sm-3">
            <?php include 'include/sidebar.php'; ?>
         </div>
         <div class="col-sm-9">
            <div class="right_box">
               <h4 class="hedding_right">Job Details</h4>
               <div class="back_bk">
                  <a href="<?= site_url('User-Jobs'); ?>"><i class="fa fa-arrow-left"></i> Back</a>
               </div>
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
                        <input type="hidden" id="job_id" name="job_id" required value="<?= $jobDetails['id']; ?>">
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
                     ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="<?= site_url('assets/site/js/job-details.js'); ?>"></script>