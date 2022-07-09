<?php include 'include/header.php'; ?>
<style type="text/css">
  .header_top,
  .sidebar {
    display: none;
  }

  .login_page {
    padding-top: 14%;
    padding-bottom: 14%;
  }

  .login_box1 {
    background: white;
  }

  .login_hedding h4{
    color: black;
  }
</style>
<div class="login_page">
  <div class="login_logo text-center">
    <img src="<?= site_url('assets/site/'); ?>img/logo.png">
  </div>
  <div class="login_box1">
    <div class="login_hedding">
      <h4>Complete Invitation</h4>
      <div class="msg" id="responseMessage">
        <div class="alert alert-success">Please verify your email by entering the password to complete the joining process.</div>
      </div>
      <p>We have sent password on your email <b><u>
            <?= $adminData['email']; ?>
          </u></b> .</p>
      <p>Click <a href="javascript:void(0);" onclick="resend_joining_password();">here</a> to resend the password.</p>
    </div>
    <form role="form" method="POST" id="loginForm" onsubmit="adminLogin(event);">
      <div class="formn_me">
        <div class="form-group">
          <label>Email </label>
          <div class="icon_us">
            <i class="la la-envelope"></i>
            <input type="email" name="email" placeholder="Enter Email" class="form-control" required id="email">
          </div>
        </div>
        <div class="form-group">
          <label>Password</label>
          <div class="icon_us">
            <i class="la la-unlock"></i>
            <input type="password" name="password" placeholder="Password" class="form-control" required id="password">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12" id="responseMessage"></div>
          <?= $this->session->flashdata('responseMessage'); ?>
        </div>
        <div class="btnloggib ">
          <button type="submit" class="btn btn_theme2 btn-lg btn-block btn_submit">Start Using Application</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php include 'include/footer.php'; ?>

<script>
  function adminLogin(e) {
    e.preventDefault();
    if (check_form()) {
      $.ajax({
          url: BASE_URL + 'Admin-First-Time-Login',
          type: 'POST',
          data: new FormData($('#loginForm')[0]),
          processData: false,
          contentType: false,
          cache: false,
          beforeSend: function(xhr) {
            $(".btn_submit").attr('disabled', true);
            $(".btn_submit").html(LOADING);
            $("#responseMessage").html('');
            $("#responseMessage").hide();
          }
        })
        .done(function(response) {
          response = JSON.parse(response);
          if (response.status == 1) {
            $('form#loginForm').trigger("reset");
          }
          $("#responseMessage").html(response.responseMessage);
          $("#responseMessage").show();
          if (response.status == 1) location.reload();
        })
        .fail(function(error) {
          alert("Server error, please try again later.");
        })
        .always(function() {
          $(".btn_submit").attr('disabled', false);
          $(".btn_submit").html('Start Using Application');
        });
    }
  }

  function resend_joining_password() {
    $.ajax({
        url: BASE_URL + 'Resend-Password',
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function() {
          $('#responseMessage').html('');
        }
      })
      .done(function(response) {
        $('#responseMessage').html(response.responseMessage);
      })
      .fail(function(error) {
        alert("Server error, please try again later.");
      })
      .always(function() {

      });
  }

  <?php
  if ($adminData['is_email_verified']) {
  ?>
    setTimeout(function() {
      window.location.href = BASE_URL + 'Admin';
    }, 5000);
  <?php
  }
  ?>

  function check_form() {
    return true;
    /* Check for valid email and both passwords min8 char */
  }
</script>