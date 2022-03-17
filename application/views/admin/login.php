<?php include 'include/header.php'; ?>
<style type="text/css">
  .header_top,
  .sidebar
  {
    display: none;
  }
  .login_page {
  padding-top: 14%;
  padding-bottom: 14%;
}
</style>
<div class="login_page">
  <div class="login_logo text-center">
    <img src="<?=site_url('assets/site/');?>img/logo.png">
  </div>
  <div class="login_box1">
    <div class="login_hedding">
      <h4>Login</h4>
    </div>
    <form role="form" method="POST" id="loginForm" onsubmit="adminLogin(event);" >
      <div class="formn_me">
        <div class="form-group">
          <label>Email </label>
          <div class="icon_us">
            <i class="la la-envelope"></i>
            <input type="email" name="email" placeholder="Enter Email" class="form-control" required id="email" >
          </div>
        </div>
        <div class="form-group">
          <label>Password</label>
          <div class="icon_us">
            <i class="la la-unlock"></i>
            <input type="password" name="password" placeholder="Password" class="form-control" required id="password" >
          </div>
        </div>
        <div class="remnper">
          <!-- <div class="pull-left">
            <label class="checkbox-inline">
            <input type="checkbox" name="remember" id="remember" value="1">
            Remember Me
            </label>
            </div> -->
          <div class="pull-right">
            <a href="#">
            Forgot password?
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12" id="responseMessage">
          </div>
        </div>
        <div class="btnloggib ">
          <button type="submit" class="btn btn_theme2 btn-lg btn-block btn_submit">Login</button>
        </div>
      </div>
    </form>
  </div>
  <!-- <div class="donit">
    <p>
       if you don't have account? <a href="jvascript:void(0)" onclick="alert('coming soon!')" >Sign Up</a>
    </p>
    </div> -->
</div>

<?php include 'include/footer.php'; ?>

<script>
  $("#email").val('admin@gmail.com');
  $("#password").val('12312312');
  function adminLogin(e){
    e.preventDefault();
    if(check_form()){
      $.ajax({
        url: BASE_URL + 'Admin-Login',
        type: 'POST',
        data: new FormData($('#loginForm')[0]),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function( xhr ) {
          $(".btn_submit").attr('disabled' , true);
          $(".btn_submit").html(LOADING);
          $("#responseMessage").html('');
          $("#responseMessage").hide();
        }
      })
      .done(function(response) {
        response = JSON.parse(response);
        if(response.status == 1){
          $('form#loginForm').trigger("reset");
        }
        $("#responseMessage").html(response.responseMessage);
        $("#responseMessage").show();
        window.location.href = response.redirect;
      })
      .fail(function(error) {
        alert( "Server error, please try again later." );
      })
      .always(function() {
        $(".btn_submit").attr('disabled' , false);
        $(".btn_submit").html('Login');
      });
    }
  }

  function check_form(){
    return true;
    /* Check for valid email and both passwords min8 char */
  }
</script>