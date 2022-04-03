<div class="dasboadd">

   <div class="container">
      <div class="row">
         <div class="col-sm-3">
            <?php include 'include/sidebar.php'; ?>
         </div>
         <div class="col-sm-9">
            <div class="right_box">
               <h4 class="hedding_right">Profile</h4>
               <div class="card_bodym">
                  <form id="userUpdateForm" name="userUpdateForm" onsubmit="update_user(event);" >
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label>First Name</label>
                              <span class="form-control"><?= $userDetails['first_name']; ?></span>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label>Last Name</label>
                              <span class="form-control"><?= $userDetails['last_name']; ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <span class="form-control"><?= $userDetails['email']; ?></span>
                     </div>
                     <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" placeholder="Address" class="form-control" value="<?= $userDetails['address']; ?>" required>
                     </div>
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label>Phone</label>
                              <input type="text" name="phone" placeholder="Phone" class="form-control" value="<?= $userDetails['phone']; ?>" required>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label>National Insurance Number</label>
                              <input type="text" name="national_insurance_number" placeholder="National Insurance Number" class="form-control" value="<?= $userDetails['national_insurance_number']; ?>" required>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group">
                           <div class="col-sm-12">
                              <label>Resume <small>(Uploading new resume will remove the old)</small></label>
                              <input type="file" name="resume" accept=".doc, .docx, .pdf" >
                              <input type="hidden" name="old_resume" value="<?=$userDetails['resume'];?>" >
                              <?php
                                 if(empty($userDetails['resume'])){
                              ?>
                                 <a href="#" >No resume uploaded yet</a>
                              <?php
                                 }else{
                              ?>
                                 <a href="<?=site_url($userDetails['resume']);?>" download >View Resume</a>
                              <?php
                                 }
                              ?>
                           </div>
                        </div>
                     </div>
                     <div class="remnper">
                        <label class="checkbox-inline">
                           <input type="checkbox" name="uk_work_permit" id="remember" value="1" <?= ($userDetails['uk_work_permit']) ? 'checked' : ''; ?>>
                           Do you have the right to work in the UK: <b>Yes/No</b>
                        </label>
                     </div>
                     <?=$this->session->flashdata('responseMessage');?>
                     <div class="responseMessage" id="responseMessage" ></div>
                     <div class="form-group">
                        <label><button class="btn btn_theme2 btn-lg btn_submit">Update</button></label>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   function update_user(e) {
      e.preventDefault();
      $.ajax({
         type: 'POST',
         url: BASE_URL + 'Update-User',
         data: new FormData($('#userUpdateForm')[0]),
         dataType: 'JSON',
         processData: false,
         contentType: false,
         cache: false,
         beforeSend: function(xhr) {
            $(".btn_submit").attr('disabled', true);
            $(".btn_submit").html(LOADING);
            $("#responseMessage").html('');
            $("#responseMessage").hide();
         },
         success: function(response) {
            if (response.isResumeUploaded == 1) location.reload();
            $(".btn_submit").prop('disabled', false);
            $(".btn_submit").html(' Update ');
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
         }
      });
   }
</script>