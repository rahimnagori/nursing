<div class="inner_cont">
   <div class="container">
      <h4>Reset Password</h4>
   </div>
</div>
<div class="pad_sec logoi_sec">
   <div class="container">
      <div class="logi_des">
         <div class="login_box1">
            <div class="login_hedding">
               <h4>Enter New Password</h4>
            </div>
            <div class="formn_me">
               <form id="newPasswordForm" name="newPasswordForm" onsubmit="update_password(event);">
                  <div class="form-group">
                     <label>New Password</label>
                     <div class="icon_us">
                        <i class="la la-unlock"></i>
                        <input type="password" name="password" placeholder="Password" class="form-control" required="">
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Confirm New Password</label>
                     <div class="icon_us">
                        <i class="la la-unlock"></i>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required="">
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
   function update_password(e) {
      e.preventDefault();
      $.ajax({
         type: 'POST',
         url: BASE_URL + 'Update-Password',
         data: new FormData($('#newPasswordForm')[0]),
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
            $("#newPasswordForm")[0].reset();
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
         }
      });
   }
</script>