<div class="inner_cont">
   <div class="container">
      <h4>Login</h4>
      <p>
         <span><a href="<?= site_url(); ?>">Home</a></span>
         <span>Login</span>
      </p>
   </div>
</div>
<div class="pad_sec logoi_sec">
   <div class="container">
      <div class="logi_des">
         <div class="login_box1">
            <div class="login_hedding">
               <h4>Login</h4>
            </div>
            <div class="formn_me">
               <form id="loginForm" name="loginForm" onsubmit="log_user_in(event);" >
                  <div class="form-group">
                     <label>Username </label>
                     <div class="icon_us">
                        <i class="la la-envelope"></i>
                        <input type="text" name="username" placeholder="Username" class="form-control" required="">
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <div class="icon_us">
                        <i class="la la-unlock"></i>
                        <input type="password" name="password" placeholder="Password" class="form-control" required="">
                     </div>
                  </div>
                  <div class="remnper">
                     <div class="pull-left">
                        <label class="checkbox-inline">
                           <input type="checkbox" name="" id="remember" value="1">
                           Remember Me
                        </label>
                     </div>
                     <div class="pull-right">
                        <a href="#">
                           Forgot password?
                        </a>
                     </div>
                  </div>
                  <?=$this->session->flashdata('responseMessage');?>
                  <div class="responseMessage" id="responseMessage" ></div>
                  <div class="btnloggib ">
                     <button class="btn btn_theme2 btn-lg btn-block btn_submit" type="submit">Login</button>
                  </div>
               </form>
            </div>
         </div>
         <div class="donit">
            <p>
               if you don't have account? <a href="<?= site_url('Signup'); ?>">Sign Up</a>
            </p>
         </div>
      </div>
   </div>
</div>

<script>
   function log_user_in(e) {
    e.preventDefault();
    alert('over here');
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Log-In',
      data: new FormData($('#loginForm')[0]),
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
</script>