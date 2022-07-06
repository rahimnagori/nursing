<div class="inner_cont">
   <div class="container">
      <h4>Forget Password</h4>
      <p>
         <span><a href="<?= site_url(); ?>">Home</a></span>
         <span>Forget</span>
      </p>
   </div>
</div>
<div class="pad_sec logoi_sec">
   <div class="container">
      <div class="logi_des">
         <div class="login_box1">
            <div class="login_hedding">
               <h4>Reset Password</h4>
            </div>
            <div class="formn_me">
               <form id="resetPasswordForm" name="resetPasswordForm" onsubmit="reset_user(event);">
                  <div class="form-group">
                     <label>Username or Email </label>
                     <div class="icon_us">
                        <i class="la la-envelope"></i>
                        <input type="text" name="username" placeholder="Username or Email" class="form-control" required="">
                     </div>
                  </div>
                  <div class="remnper">
                     <div class="pull-right">
                        Remember Password? Try
                        <a href="<?= site_url('Login'); ?>">
                           Login
                        </a>
                     </div>
                  </div>
                  <?= $this->session->flashdata('responseMessage'); ?>
                  <div class="responseMessage" id="responseMessage"></div>
                  <div class="btnloggib ">
                     <button class="btn btn_theme2 btn-lg btn-block btn_submit" type="submit">Reset</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   function reset_user(e) {
      e.preventDefault();
      $.ajax({
         type: 'POST',
         url: BASE_URL + 'Reset-Password',
         data: new FormData($('#resetPasswordForm')[0]),
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
            $(".btn_submit").html(' Reset ');
            $("#resetPasswordForm")[0].reset();
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
         }
      });
   }
</script>