<style type="text/css">
  footer {
    display: none;
  }

  .main_nav2 {
    background: #fff;
  }

  body {
    background: #f1f1f1;
  }

  .ema_viii2 .form_1 {
    max-width: 650px;
    width: 100%;
    margin: 0 auto;
    padding: 40px 20px;
    background: #fff;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.03);
  }

  .ema_viii2 .form_1 .icon_img img {
    width: 100px;
    margin-bottom: 30px;
  }

  .heade_login h4 {
    font-size: 24px;
    font-family: 'MuktaSB';
    margin-bottom: 10px;
    color: #333;
  }

  .ema_viii2 .form_1 p {
    color: #6a6a6a;
    font-size: 16px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
  }

  .top_bar2 {
    padding-top: 15px;
    padding-bottom: 15px;
  }

  .ligin_us2 ul {
    float: right;
  }

  .ligin_us2>ul>li {
    display: inline-block;
    margin: 0 8px;
  }

  .main_nav2 .ligin_us2 li.user_dropp>a {
    padding: 8px 0;
    display: inline-block;
  }

  .img_radiuus {
    padding-left: 45px;
    position: relative;
    display: inline-block;
  }

  .img_radiuus img {
    border: 1px solid #0c1f38;
    border-radius: 100%;
    height: 40px;
    left: 0;
    object-fit: cover;
    position: absolute;
    top: -8px;
    width: 40px;
  }

  .ligin_us2 ul {
    float: right;
  }

  .main_nav2 .ligin_us2 li.user_dropp .dropdown-menu {
    min-width: 270px;
    border-radius: 0;
    padding: 0;
    margin: 0;
  }

  .main_nav2 .ligin_us2 li.user_dropp .dropdown-menu {
    left: auto;
    right: 0;
  }

  .main_nav2 .ligin_us2 li.user_dropp .dropdown-menu li a {
    padding: 8px 10px;
    font-size: 16px;
    border-bottom: 1px solid #e1e1e1;
    text-align: left;
  }

  .main_nav2 .ligin_us2 li.user_dropp .dropdown-menu li a i {
    font-size: 21px;
    vertical-align: middle;
  }

  .ligin_us2>ul>li>a {
    color: #333;
    font-size: 16px;
  }

  .main_nav2 .ligin_us2 li.user_dropp>a {
    background: transparent !important;
  }

  .top_bar2>.container>.row {
    display: flex;
    align-items: center;
  }

  .ema_viii2 .form_1 p b,
  .ema_viii2 .form_1 p a {
    color: #000;
  }

  .ema_viii {
    min-height: calc(100vh - 160px);
    display: flex;
    align-items: center;
    width: 100%;
    justify-content: center;
    flex-wrap: wrap;
  }

  .login_page {
    padding: 40px 0;
  }

  @media(max-width: 767px) {
    .img_radiuus {
      font-size: 0;
    }
  }
</style>
<div class="login_page sec_pad">
  <div class="container">
    <div class="ema_viii">
      <div class="ema_viii2">
        <div class="form_1">
          <div class="icon_img">
            <img src="<?=site_url('assets/site/');?>img/missing-email.png" class="img_r">
          </div>
          <div class="heade_login">
            <h4>Email Verification </h4>
          </div>
          <div class="msg">
            <div class="alert alert-success">Please verify your email first to complete registration.</div>
          </div>
          <p>You need to verify your email address. We've sent an email to <b><u>
                <?=$userDetails['email'];?>
          </u></b> to verify your address. Please click the link in that email to continue.</p>
          <p>Click <a href="javascript:void(0);" onclick="resend_verification_link();">here</a> to resend verification link.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function resend_verification_link() {
    $.ajax({
      url: BASE_URL + 'Resend-Email-Verification',
      type: 'POST',
      dataType: 'JSON',
      beforeSend: function () {
        $('#responseMessage').html('');
      }
    })
    .done(function(response) {
      $('#responseMessage').html(response.responseMessage);
    })
    .fail(function(error) {
      alert( "Server error, please try again later." );
    })
    .always(function() {
      
    });
  }
  
  <?php
    if($userDetails['is_email_verified']){
  ?>
      setTimeout(function(){
        window.location.href = BASE_URL + 'Profile';
      }, 5000);
  <?php
    }
  ?>
</script>