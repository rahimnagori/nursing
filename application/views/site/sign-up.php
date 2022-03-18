<div class="inner_cont">
   <div class="container">
      <h4>Sign Up</h4>
      <p>
         <span><a href="<?= site_url(); ?>">Home</a></span>
         <span>Sign Up</span>
      </p>
   </div>
</div>
<div class="pad_sec sign_up_sec">
   <div class="container">
      <div class="logi_des">
         <div class="login_box1">
            <div class="login_hedding">
               <h4>Sign Up</h4>
            </div>
            <div class="formn_me">
               <form id="signUpForm" name="signUpForm" onsubmit="sign_up_user(event);" >
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>First Name </label>
                           <div class="icon_us">
                              <i class="la la-user"></i>
                              <input type="text" name="first_name" placeholder="First Name" class="form-control" required="" >
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Last Name </label>
                           <div class="icon_us">
                              <i class="la la-user"></i>
                              <input type="text" name="last_name" placeholder="Last Name" class="form-control" required="">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Username </label>
                           <div class="icon_us">
                              <i class="la la-user"></i>
                              <input type="text" name="username" placeholder="Username" class="form-control" required="">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Email Address </label>
                           <div class="icon_us">
                              <i class="la la-envelope"></i>
                              <input type="email" name="email" placeholder="Email Address" class="form-control" required="">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Password</label>
                           <div class="icon_us">
                              <i class="la la-unlock"></i>
                              <input type="password" name="password" placeholder="Password" class="form-control" required="">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Confirm Password</label>
                           <div class="icon_us">
                              <i class="la la-unlock"></i>
                              <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required="">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Job Title </label>
                     <div class="icon_us">
                        <i class="la la-briefcase"></i>
                        <select name="job_title" id="" class="form-control" required="" onchange="change_job_title(this.value);" >
                           <option value="nursing">Nursing</option>
                           <option value="health care assistant">Health Care Assistant</option>
                           <option value="support worker">Support Worker</option>
                           <option value="other">Other</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group responseMessage" id="otherJobField"></div>
                  <!-- <div class="form-group">
                     <label>Address </label>
                     <div class="icon_us">
                        <i class="la la-map-marker"></i>
                        <input type="text" name="" placeholder="Address" class="form-control">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Telephone Number </label>
                           <div class="icon_us">
                              <i class="la la-mobile"></i>
                              <input type="text" name="" placeholder="Telephone Number" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>National Insurance Number </label>
                           <div class="icon_us">
                              <i class="la la-mobile"></i>
                              <input type="text" name="" placeholder="National Insurance Number" class="form-control">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Upload CV </label>
                     <div class="icon_us">
                        <i class="la la-cloud-upload"></i>
                        <input type="file" name="" placeholder="" class="form-control">
                     </div>
                  </div>
                  <div class="remnper">
                     <label class="checkbox-inline">
                        <input type="checkbox" name="remember" id="remember" value="1">
                        Do you have the right to work in the UK: <b>Yes/No</b>
                     </label>
                  </div> -->
                  <?=$this->session->flashdata('responseMessage');?>
                  <div class="responseMessage" id="responseMessage" ></div>
                  <div class="btnloggib">
                     <button class="btn btn_theme2 btn-lg btn-block btn_submit" type="submit">Submit</button>
                  </div>
               </form>
            </div>
         </div>
         <div class="donit">
            <p>
               if you have account? <a href="<?= site_url('Login'); ?>">Login</a>
            </p>
         </div>
      </div>
   </div>
</div>

<script>
   function sign_up_user(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Register',
      data: new FormData($('#signUpForm')[0]),
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
        $(".btn_submit").prop('disabled', false);
        $(".btn_submit").html(' Add ');
        if (response.status == 1) location.reload();
        $("#responseMessage").html(response.responseMessage);
        $("#responseMessage").show();
      }
    });
  }

  function change_job_title(job_title){
   if(job_title == 'other'){
      $("#otherJobField").html(`
         <div class="icon_us">
            <i class="la la-briefcase"></i>
            <input type="text" name="other_job_title" placeholder="Other Job..." class="form-control" required="">
         </div>
      `);
      $("#otherJobField").show();
   }else{
      $("#otherJobField").html('');
      $("#otherJobField").hide();
   }
  }
</script>